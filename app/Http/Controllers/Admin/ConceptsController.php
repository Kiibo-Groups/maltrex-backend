<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Concepts;

use Auth;
use DB;
use Validator;
use Redirect;
use IMS;
use Excel;

class ConceptsController extends Controller
{
    public $folder  = "admin/concepts.";

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View($this->folder.'index',[
			'data' 	=> Concepts::OrderBy('created_at','DESC')->get(),
			'link' 	=> '/concepts/'
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
			'data' 		=> new Concepts,
			'form_url' 	=> '/concepts',
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
            $lims_settings_data = new Concepts;
             
            $lims_settings_data->create($input);
            return redirect(env('admin').'/concepts')->with('message', 'Nuevo elemento agregado...');
        } catch (\Exception $th) {
            return redirect(env('admin').'/concepts')->with('error', $th->getMessage());
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
			'data' 		=> Concepts::find($id),
			'form_url' 	=> '/concepts/'.$id, 
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
            $lims_settings_data = Concepts::find($id);
            
            
            $lims_settings_data->update($input);
            return redirect(env('admin').'/concepts')->with('message', 'Elemento actualizado con éxito...');
        } catch (\Exception $th) {
            return redirect(env('admin').'/concepts')->with('error', $th->getMessage());
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
        Concepts::where('id',$id)->delete();
		return redirect(env('admin').'/concepts')->with('message','Elemento eliminado con éxito...');
    }

    /**
     * Cambio de status de la Escuela.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $res 			= Concepts::find($id);
		$res->status 	= $res->status == 0 ? 1 : 0;
		$res->save();

		return redirect(env('admin').'/concepts')->with('message','Estatus actualizado con éxito...');
    }

    public function show()
    {
        return View($this->folder.'up_xls',[
			'data' 		=> new Concepts,
			'form_url' 	=> Asset('/_upload_xls/')
		]);
    }

    public function _upload_xls(Request $request)
    {
        $data = $request->all();
        $lims_data_Concepts = new Concepts;
        

        $array = Excel::toArray(new Concepts, $data['file']);

        $newData = []; 

        for ($i=4; $i < count($array[0]) ; $i++) { 

            $newData  = [
                'titulo'   => ($array[0][$i][3] != '') ? $array[0][$i][3] : 'undefined',
                'concepto' => ($array[0][$i][1] != '') ? $array[0][$i][1] : 'undefined',
                'unidad'   => ($array[0][$i][2] != '') ? $array[0][$i][2] : 'undefined',
                'precio'   => ($array[0][$i][4] != '') ? $array[0][$i][4] : 1,
                'labour'   => ($array[0][$i][5] != '') ? $array[0][$i][5] : 1,
                'status'   => 1
            ];


            $lims_data_Concepts->create($newData);

        }

        // return response()->json([
        //     'newData' => $newData,
        //     'data' => $array
        // ]);

        return redirect('/concepts')->with('message','Información registrada con éxito.');
    }
}