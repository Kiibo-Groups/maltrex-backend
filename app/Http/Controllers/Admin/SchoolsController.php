<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Schools;

use Auth;
use DB;
use Validator;
use Redirect;
use IMS;

class SchoolsController extends Controller
{
    public $folder  = "admin/schools.";

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View($this->folder.'index',[
			'data' 	=> Schools::OrderBy('created_at','DESC')->get(),
			'link' 	=> '/schools/'
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
			'data' 		=> new Schools,
			'form_url' 	=> '/schools',
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
        // return response()->json(['data' => $request->all()]);

        try {
            $input = $request->all();
            $lims_settings_data = new Schools;
             
            $lims_settings_data->create($input);
            return redirect(env('admin').'/schools')->with('message', 'Nuevo elemento agregado...');
        } catch (\Exception $th) {
            return redirect(env('admin').'/schools')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
			'data' 		=> Schools::find($id),
			'form_url' 	=> '/schools/'.$id, 
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
            $lims_settings_data = Schools::find($id);
            
            
            $lims_settings_data->update($input);
            return redirect(env('admin').'/schools')->with('message', 'Elemento actualizado con éxito...');
        } catch (\Exception $th) {
            return redirect(env('admin').'/schools')->with('error', $th->getMessage());
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
        Schools::where('id',$id)->delete();
		return redirect(env('admin').'/schools')->with('message','Elemento eliminado con éxito...');
    }

    /**
     * Cambio de status de la Escuela.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $res 			= Schools::find($id);
		$res->status 	= $res->status == 0 ? 1 : 0;
		$res->save();

		return redirect(env('admin').'/schools')->with('message','Estatus actualizado con éxito...');
    }
}
