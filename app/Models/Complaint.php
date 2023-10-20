<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'subject',
        'description',
        'submission_date',
        'status',
        'priority',
        'user_id',
    ];


}
