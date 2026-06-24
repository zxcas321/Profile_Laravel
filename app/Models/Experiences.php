<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'company',
        'position',
        'status',
        'location',
        'description',
        'start_date',
        'end_date',
        'is_current'
    ];

    public function profile(){
        return $this->belongsTo(Profile::class);
    }
}

