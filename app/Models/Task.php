<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'title',
        'description',
        'assigned_to',
        'due_date',
        'status' => 'not completed', // Remove or change this default value
       
        
    ];

    // Relation One-to-Many avec User (un utilisateur peut avoir plusieurs tâches)
    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Relation One-to-Many avec Project (un projet peut avoir plusieurs tâches)
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }
    
}
