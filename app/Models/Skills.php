<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'skill'
    ];

    public function profiles()
    {
        return $this->belongsTo(Profile::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_skills');
    }
}