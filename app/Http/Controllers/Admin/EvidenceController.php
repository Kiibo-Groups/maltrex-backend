<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Evidence;

use Auth;
use DB;
use Validator;
use Redirect;
use IMS;
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
        return View($this->folder.'index',[
			'data' 	=> Evidence::OrderBy('created_at','DESC')->get(),
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
    
    
}
