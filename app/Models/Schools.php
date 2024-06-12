<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schools extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'director',
        'cct',
        'direccion',
        'email',
        'phone',
        'proveedor',
        'status'
    ];
}
