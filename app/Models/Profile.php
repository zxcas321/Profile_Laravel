<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tagline',
        'bio',
        'photo_url',
        'phone',
        'location',
        'github_url',
        'linkedin_url',
        'website_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
    public function Educations()
    {
        return $this->hasMany(Education::class);
    }
}