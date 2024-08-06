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

    public function assignments()
    {
      return $this->belongsTo(Assignments::class);
    } 


    public function viewEvidence()
    {
      $req = Evidence::OrderBy('created_at','DESC')->with(['assignments'])->get();
      $data = [];

      foreach ($req as $key) {
          $getconc = Concepts::find($key->conceptId);
          
          $data[] = [
            'id'  => $key->id,
            'managers_id'   => $key->managers_id,
            'assignments_id'    => $key->assignments_id,
            'conceptId' => $key->conceptId,
            'antes' => $key->antes,
            'durante'   => $key->durante,
            'despues'   => $key->despues,
            'status'    => $key->status,
            'concept'   => $getconc
          ];
      }

      return collect($data);
    }

}
