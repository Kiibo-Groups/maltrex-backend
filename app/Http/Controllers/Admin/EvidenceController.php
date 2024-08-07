<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Helper;
use Illuminate\Support\Str; 

use App\Models\Evidence;
use App\Models\Concepts;

use Auth;
use DB;
use Validator;
use Redirect;
use IMS;
use ZipArchive;
class EvidenceController extends Controller
{
    public $folder  = "admin/evidence.";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $Evidence =  new Evidence;

        // return response()->json([
        //     'data' 	=> $data,
		// 	'link' 	=> '/evidence/'
        // ]);

        return View($this->folder.'index',[
			'data' 	=> $Evidence->viewEvidence(),
			'link' 	=> '/evidence/'
		]);
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
    
    public function getEvidence($id, $type)
    {
        try {
            $evidence = Evidence::find($id);
            
            $zip = new ZipArchive();
            $destination = 'public/uploads/evidences/downloads';
            $folder_down = "public/uploads/evidences/". $type;
            $url_download = $destination. "/" .$type."_".$id.".zip";
            $pics = [];

            switch ($type) {
                case 'before':
                    $pics = json_decode($evidence->antes, true);
                    break;
                case 'during':
                    $pics = json_decode($evidence->durante, true);
                    break;
                case 'after':
                    $pics = json_decode($evidence->despues, true);
                    break;
                default:
                    $pics = json_decode($evidence->antes, true);
                    break;
            }
  
            if ($pics > 0) {
                // Creamos el archivo 
                $create_file = fopen($destination.'/'.$type.'_'.$id.'.zip', 'w');
                fclose($create_file);
                // Validamos si existe para agregar contenido
                if ($zip->open($destination."/".$type."_".$id.".zip") === TRUE) {
                    // Agregamos las imagenes a la carpeta
                    foreach ($pics as $value) {
                        $zip->addFile($folder_down .'/'.$value, $value);
                    }

                    $zip->close();
                    // Descargamos...
                    return redirect($url_download);
                } else { 
                    // Fallo
                    return redirect(env('admin').'/evidence')->with('error', "El directorio no se pudo leer.");
                }
            }else {
                return redirect(env('admin').'/evidence')->with('error', "El directorio esta vacio.");
            }
 
        } catch (\Throwable $th) {
            return redirect(env('admin').'/evidence')->with('error', $th->getMessage());
        }
    }

    public function viewEvidence($id)
    {
        try {
            $evidence = Evidence::find($id);

            return View($this->folder.'viewChart',[
                'data' 	=> $evidence
            ]);

        } catch (\Throwable $th) {
            return redirect(env('admin').'/evidence')->with('error', $th->getMessage());
        }
    }

    public function printAssignEvidenceFromat($uuid)
    {
        
        $Evidence   =  new Evidence;
        $data       =  $Evidence->getEvidence($uuid);
        // return response()->json([ 
        //     'data' => $Evidence->getEvidence($uuid)
        // ]);

        $pdf = Pdf::loadView($this->folder.'printEvidenceFormat', [
            'data' => $data
        ] );

        // return redirect()->back()->with('status', 'PDF guardado con exito');
        // return $pdf->download('invoice.pdf');
        return $pdf->stream();
    }
}
