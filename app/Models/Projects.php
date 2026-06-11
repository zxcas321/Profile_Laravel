<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'demo_url',
        'github_url',
        'thumbnail_url',
        'is_featured',
        'started_at',
        'ended_at',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'started_at'  => 'date',
            'ended_at'    => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'project_skills')
                    ->using(ProjectSkill::class)
                    ->withPivot('id');
    }
}