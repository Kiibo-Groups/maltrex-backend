<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Managers extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'pic_profile',
        'email',
        'phone',
        'password',
        'otp',
        'address',
        'status'
    ];

    public function login($data)
    {
        $chk = Managers::where('email', $data['email'])->first();

        $msg = "Detalles de acceso incorrectos";
        $user = 0;
        if (isset($chk->id)) // Validamos si existe el email
        {
            if ($chk->password == $data['password']) { // Validamos la contraseña
                $msg = 'done';
                $user = $chk->id;
            }else {
                $msg = "La contraseña no coincide con el email";
            }
        }else {
            $msg = "El email no es válido.";
        }


        return ['msg' => $msg, 'user_id' => $user];
    }

    public function chkUser($data)
    {

        if (isset($data['user_id']) && $data['user_id'] != 'null') {
            // Intentamos con el id
            $res = Managers::find($data['user_id']);

            if (isset($res->id)) {
                return ['msg' => 'user_exist', 'id' => $res->id, 'data' => $res,'role' => 'user'];
            } else {
                return ['msg' => 'not_exist'];
            }
        }
    }

    
    public function updateInfo($data, $id)
    {
        $count = Managers::where('id',$id)->count();

        if ($count >= 1) {
            $add                = Managers::find($id);
            $add->name          = $data['name']; 
            $add->email         = $data['email']; 
            $add->phone         = $data['phone'];

            if (isset($data['password'])) {
                $add->password    = $data['password'];
            } 
            $add->save();

            return ['msg' => 'done', 'user_id' => $add->id, 'data' => $add];
        } else {
            return ['msg' => 'Opps! Este correo electrónico ya existe.'];
        }
    }


}
