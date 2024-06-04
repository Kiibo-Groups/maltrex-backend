<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Managers;

use Auth;
use DB;
use Validator;
use Redirect;
use IMS;
class ManagersController extends Controller
{
    public $folder  = "admin/managers.";

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View($this->folder.'index',[
			'data' 	=> Managers::OrderBy('created_at','DESC')->get(),
			'link' 	=> '/managers/'
		]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View($this->folder.'add',[
			'data' 		=> new Managers,
			'form_url' 	=> '/managers',
            'array'		=> []
		]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return response()->json(['data' => $request->all()]);

        try {
            $input = $request->all();
            $lims_settings_data = new Managers;

            if(isset($input['pic_profile']))
            {
                $filename   = time().rand(111,699).'.' .$input['pic_profile']->getClientOriginalExtension(); 
                $input['pic_profile']->move("uploads/pic_profile/", $filename);   
                $input['pic_profile'] = $filename;   
            }
             
            $input['otp'] = 0;
            $lims_settings_data->create($input);
            return redirect(env('admin').'/managers')->with('message', 'Nuevo elemento agregado...');
        } catch (\Exception $th) {
            return redirect(env('admin').'/managers')->with('error', $th->getMessage());
        }
    }
 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        return View($this->folder.'edit',[
			'data' 		=> Managers::find($id),
			'form_url' 	=> '/managers/'.$id, 
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $input = $request->all();
            $lims_settings_data = Managers::find($id);
            
            if(isset($data['pic_profile']))
            {
                @unlink("uploads/pic_profile/".$lims_settings_data->pic_profile);

                $filename   = time().rand(111,699).'.' .$data['pic_profile']->getClientOriginalExtension(); 
                $data['pic_profile']->move("uploads/pic_profile/", $filename);   
                $add->img = $filename;   
            }

            $input['otp'] = 0;
            
            $lims_settings_data->update($input);
            return redirect(env('admin').'/managers')->with('message', 'Elemento actualizado con éxito...');
        } catch (\Exception $th) {
            return redirect(env('admin').'/managers')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Managers::where('id',$id)->delete();
		return redirect(env('admin').'/managers')->with('message','Elemento eliminado con éxito...');
    }

    /**
     * Cambio de status de la Escuela.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $res 			= Managers::find($id);
		$res->status 	= $res->status == 0 ? 1 : 0;
		$res->save();

		return redirect(env('admin').'/managers')->with('message','Estatus actualizado con éxito...');
    }
}
