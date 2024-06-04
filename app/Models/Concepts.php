<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concepts extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'concepto',
        'unidad',
        'precio',
        'labour',
        'status'
    ];
   
}
