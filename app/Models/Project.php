<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'title',
        'description',
        'github_url',
        'thumbnail_url',
        'is_featured'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'project_skills');
    }
}