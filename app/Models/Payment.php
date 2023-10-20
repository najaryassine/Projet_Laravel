<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'contract_id',
        'amount',
        'payment_date',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'contract_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'contract_id');
    }
}
