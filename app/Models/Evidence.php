<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    use HasFactory;

    protected $fillable = [
        'managers_id',
        'assignments_id',
        'conceptId',
        'antes',
        'durante',
        'despues',
        'status'
    ];
    
}
