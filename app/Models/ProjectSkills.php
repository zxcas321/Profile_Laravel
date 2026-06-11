<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectSkill extends Pivot
{
    protected $table = 'project_skills';

    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'skill_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}