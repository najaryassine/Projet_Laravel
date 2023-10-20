<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Payment;


class PaymentController extends Controller
{
    public function session(Request $request, $contract_id)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
        // Fetch the contract by its ID
        $contract = Contract::find($contract_id);
        if ($contract->status === 'Pending') {
            $contract->status = 'accepted';
            $contract->save();
        }

        $product_name = $contract->client->name;
        $total = $contract->project_cost;
        
        $unit_amount = intval($total * 100); // Convert total to cents

        $productItems[] = [
            'price_data' => [
                'product_data' => [
                    'name' => $product_name,
                ],
                'currency'     => 'USD',
                'unit_amount'  => $unit_amount,
            ],
            'quantity' => 1  // assuming quantity is 1 for each contract
        ];

        $checkoutSession = \Stripe\Checkout\Session::create([
            'line_items' => [$productItems],
            'mode' => 'payment',
            'allow_promotion_codes' => true,
            'metadata' => [
                'contract_id' => $contract->id
            ],
            'customer_email' => "asma.bouchelliga@esprit.tn", // $user->email,
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);

        // Create a new payment record
        $payment = new Payment();
        $payment->contract_id = $contract->id;
        $payment->amount = $total; // Adjust this if the payment amount needs to be modified
        $payment->payment_date = now(); // Use the current date and time
        $payment->save();

        return redirect()->away($checkoutSession->url);
    }

    public function success()
    {
        return view('frontoffice.payment.success', [
            'message' => "Thank you for your payment! Your transaction was successful. We appreciate your trust in us and will process your order promptly. If you have any questions or need further assistance, please don't hesitate to reach out. Have a great day!"
        ]);
    }

    public function index()
    {
        $payments = Payment::all();
        return view('admin.paying.index', compact('payments'));
    }
}
