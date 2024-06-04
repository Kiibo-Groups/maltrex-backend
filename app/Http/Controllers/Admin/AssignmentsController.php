<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Helper;
use Illuminate\Support\Str;

use App\Models\Assignments;
use App\Models\Schools;
use App\Models\Managers;
use App\Models\Concepts;

use Auth;
use DB;
use Validator;
use Redirect;
use IMS; 

class AssignmentsController extends Controller
{
    public $folder  = "admin/assignments.";

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $assigns = Assignments::OrderBy('created_at','DESC')->select('uuid')->distinct('uuid')->get();

        $data = [];

        foreach ($assigns as $key) {

            $getAssign = Assignments::OrderBy('created_at','DESC')->where('uuid',$key->uuid)->with("School","Manager")->first();

            $data[] = [
                'id'        => $getAssign->id,
                'uuid'      => $getAssign->uuid,
                'iva'       => $getAssign->iva,
                'total'     => $getAssign->total,
                'manager_id' => $getAssign->manager_id,
                'status'    => $getAssign->status,
                'school'    => $getAssign->school,
                'manager'   => $getAssign->manager,
                'updated_at' => $getAssign->updated_at
            ];
            
        }


        // return response()->json([
        //     'data' 	=> $data
        // ]);

        return View($this->folder.'index',[
			'data' 	=> (count($data) > 0) ? $data : Assignments::with("School","Manager")->get(),
            'link' 	=> '/assignments/'
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
			'data' 		=> new Assignments,
            'schools' => Schools::where('status',1)->OrderBy('created_at','DESC')->get(),
            'managers' => Managers::where('status',1)->OrderBy('created_at','DESC')->get(),
            'concepts' => Concepts::where('status',1)->OrderBy('created_at','DESC')->get(),
			'form_url' 	=> '/assignments',
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
        try {
            $input = $request->all();
            $lims_assigns_data = new Assignments;
            $data = [];
            // Obtenemos concepto

            $concepts = [];
            $uuid = str_random(2).uniqid().now()->timestamp;
        
            for ($i=0; $i < count($input['concepts']) ; $i++) { 
                 
                $concepto = Concepts::find($input['concepts'][$i]);
 
                $data = [
                    'uuid'          => $uuid,
                    'school_id'     => $input['school_id'],
                    'manager_id'    => $input['manager_id'],
                    'concepts'      => $input['concepts'][$i],
                    'cantidad'      => $input['cantidad'][$i],
                    'unidad'        => $concepto->unidad,
                    'precio_unit'   => $concepto->precio,
                    'iva'           => $lims_assigns_data->getTotal($input)['iva'],
                    'total'         => $lims_assigns_data->getTotal($input)['total'],
                    'status'        => $input['status']
                ];

                $lims_assigns_data->create($data);
            } 
            return redirect(env('admin').'/assignments')->with('message', 'Nuevo elemento agregado...');
        } catch (\Exception $th) {
            return redirect(env('admin').'/assignments')->with('error', $th->getMessage());
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
        $assignment = Assignments::find($id);

        // Retornamos todas las que se hubieran querido eliminar pero no paso.
        $conceptDel = Assignments::where('status',3)->get();
        foreach ($conceptDel as $key) {
            $assigns = Assignments::find($key->id);
            $assigns->status = 1;
            $assigns->save();
        }
       
        return View($this->folder.'edit',[
			'data'    => $assignment,
            'assigns' => Assignments::where('uuid', $assignment->uuid)->OrderBy('created_at','DESC')->with("School","Manager")->get(),
            'schools' => Schools::where('status',1)->OrderBy('created_at','DESC')->get(),
            'managers' => Managers::where('status',1)->OrderBy('created_at','DESC')->get(),
            'concepts' => Concepts::where('status',1)->OrderBy('created_at','DESC')->get(),
			'form_url' 	=> '/assignments/'.$id, 
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
            $lims_assigns_data = Assignments::find($id);

            // Limpiamos
            Assignments::where('uuid',$lims_assigns_data->uuid)->delete();

            $data = [];
            $concepts = []; 
            for ($i=0; $i < count($input['concepts']) ; $i++) { 
                 
                $concepto = Concepts::find($input['concepts'][$i]);
 
                $data = [
                    'uuid'          => $lims_assigns_data->uuid,
                    'school_id'     => $input['school_id'],
                    'manager_id'    => $input['manager_id'],
                    'concepts'      => $input['concepts'][$i],
                    'cantidad'      => $input['cantidad'][$i],
                    'unidad'        => $concepto->unidad,
                    'precio_unit'   => $concepto->precio,
                    'iva'           => $lims_assigns_data->getTotal($input)['iva'],
                    'total'         => $lims_assigns_data->getTotal($input)['total'],
                    'status'        => $input['status']
                ];

                $lims_assigns_data->create($data);
            } 
             
            // return response()->json([
            //     'data' => $data
            // ]);

            return redirect(env('admin').'/assignments')->with('message', 'Elemento actualizado con éxito...');
        } catch (\Exception $th) {
            return redirect(env('admin').'/assignments')->with('error', $th->getMessage());
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
        $concept = Assignments::find($id);
        Assignments::where('uuid',$concept->uuid)->delete();
		return redirect(env('admin').'/assignments')->with('message','Elemento eliminado con éxito...');
    }

    /**
     * Cambio de status de la Escuela.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $res 			= Assignments::find($id);

        $assigns        = Assignments::where('uuid',$res->uuid)->get();
        foreach ($assigns as $key) {
            $resT 			= Assignments::find($key->id);
            $resT->status 	= $resT->status == 0 ? 1 : 0;
            $resT->save();
        }
		
		return redirect(env('admin').'/assignments')->with('message','Estatus actualizado con éxito...');
    }

    /**
     * Eliminacion de un concepto
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trashConcept(Request $request)
    {

        $input = $request->all();

        $concept = Assignments::find($input['conceptId']);

        $concept->status = 3; // Eliminado desde edit
        $concept->save();

        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Impresion del documento
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function printAssign($uuid)
    {
        $assigns = Assignments::where('uuid', $uuid)->OrderBy('created_at','DESC')->with("School","Manager")->get()->toArray();
        $dat     = Assignments::where('uuid', $uuid)->with("School","Manager")->first();
        $lims_assigns_data = new Assignments;
        $input = [];
        $concepts = [];
        $subTotal = 0;
        $counterId = 1;

        foreach ($assigns as $key) {
            $input['cantidad'][] = $key['cantidad'];
            $input['concepts'][] = $key['concepts'];


            $getconc = Concepts::find($key['concepts']);

            $totals = ($key['cantidad'] * $key['precio_unit']);
            $concepts[] = [
                'id'       => $counterId,
                'concepto' => $getconc->concepto,
                'unidad'   => $getconc->unidad,
                'cantidad' => $key['cantidad'],
                'precio_unit' => $key['precio_unit'],
                'total'     => $totals
            ];

            $subTotal += $totals;
            $counterId++;
        }


        // Obtenemos fecha actual
        $fecha = date(now());
        $fechaSegundos =  strtotime($fecha);

        $dia = date('j' , $fechaSegundos);
        $mes = date('F' , $fechaSegundos);
        $año = date('Y' , $fechaSegundos);


        // return response()->json([ 
        //     'date'   => "El día ".$dia." de ".$mes." del ".$año,
        //     'school' => $dat->school->name,
        //     'concepts' => $concepts,    
        //     'subTotal' => $subTotal,
        //     'iva'   => $lims_assigns_data->getTotal($input)['iva'],
        //     'total' => $lims_assigns_data->getTotal($input)['total'], 
        // ]);

        $pdf = Pdf::loadView($this->folder.'print', [ 
            'date'   => "El día ".$dia." de ".$mes." del ".$año,
            'school' => $dat->school->name,
            'concepts' => $concepts,    
            'subTotal' => $subTotal,
            'iva'   => $lims_assigns_data->getTotal($input)['iva'],
            'total' => $lims_assigns_data->getTotal($input)['total'], 
        ]);
        return $pdf->download('invoice.pdf');
    }
}