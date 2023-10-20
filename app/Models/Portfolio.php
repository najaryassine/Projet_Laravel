<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portfolio extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'date',
        'technologies',
        'client',
        'statut',
        'freelancer_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'freelancer_id')->where('role', '2');
    }

}
