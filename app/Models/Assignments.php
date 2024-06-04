<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'school_id',
        'manager_id',
        'concepts',
        'unidad',
        'cantidad', 
        'precio_unit',
        'iva',
        'total',
        'status'
    ];

    public function School()
    {
      return $this->belongsTo(Schools::class);
    }

    public function Manager()
    {
      return $this->belongsTo(Managers::class);
    }

    public function getTotal($input)
    {
      $Subtotal = 0;
      $iva = 0;
      $total = 0;

      for ($x=0; $x < count($input['cantidad']) ; $x++) { 
        $concepto = Concepts::find($input['concepts'][$x]);
        $Subtotal += ($input['cantidad'][$x] * $concepto->precio);
      } 

      $iva      = ($Subtotal * 16) / 100;
      $total    = $Subtotal + $iva;

      return [
        'subTotal' => $Subtotal,
        'iva'   => $iva,
        'total' => $total, 
      ];
    }
}
