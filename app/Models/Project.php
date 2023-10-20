<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'image', 'client_id', 'cost', 'status', 'required_skills', 'category'];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function getRequiredSkillsAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setRequiredSkillsAttribute($value)
    {
        $this->attributes['required_skills'] = json_encode($value);
    }
    public function tasks()
{
    return $this->hasMany(Task::class, 'project_id');
}
public function applicants()
{
    return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id')->wherePivot('role', 'freelancer');
}
}
