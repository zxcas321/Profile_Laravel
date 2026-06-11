<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'institution',
        'degree',
        'field_of_study',
        'started_at',
        'ended_at',
        'grade',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'date',
            'ended_at'   => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}