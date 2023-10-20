@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <div class="card" style="margin: 20px;">
        <div class="card-header">Payments List</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Amount</th>
                        <th>Payment Date</th>
                        <th>Contract ID</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->id }}</td>
                            <td>{{ $payment->amount }}</td>
                            <td>{{ $payment->payment_date }}</td>
                            <td>{{ $payment->contract_id }}</td>
                            <td>{{ $payment->created_at }}</td>
                            <td>{{ $payment->updated_at }}</td>
                            <td>
                                <!-- Add any other actions such as delete etc. -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
