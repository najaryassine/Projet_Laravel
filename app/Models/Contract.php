<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = ['project_id', 'freelancer_id', 'client_id', 'project_cost', 'status']; // Change 'user_id' to 'client_id' in the fillable attributes

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id'); // Change the relationship to 'client_id'
    }
}
