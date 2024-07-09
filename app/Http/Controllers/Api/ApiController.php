<?php namespace App\Http\Controllers\api;

use App\Http\Requests;
use App\Http\Controllers\Controller; 
use App\Providers\SocketServer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Contracts\JWTSubject; 

use App\Models\{User, Managers, Assignments, Concepts, Evidence};

use DB;
use Validator;
use Redirect;
use DOMDocument;
use Carbon\Carbon;

class ApiController extends Controller 
{
    public function __construct()
	{
		// $this->middleware('authApi:api',['except' => ['getToken', 'getDevice']]);
	}
 
	public function getDataInit()
	{
		
		try {
			return response()->json([
				'admin'		=> User::where('role',1)->first()
			]);
		} catch (\Exception $th) {
			return response()->json(['data' => 'error', 'error' => $th->getMessage()]);
		}
	}

	public function homepage_init($user_id)
	{
		try {
			$assigns = Managers::find($user_id);
			 
			$data = [ 
				'assign'   => $assigns
			];

			return response()->json(['data' => $data]);
		} catch (\Exception $th) {
			return response()->json(['data' => 'error', 'error' => $th->getMessage()]);
		}
	}


	/**
     * Funciones de inicio de sesion y validacion de usuario
     */

	 public function login(Request $Request)
	 {
		 try {
			 $res = new Managers;
			 return response()->json($res->login($Request->all()));
		 } catch (\Exception $th) {
			 return response()->json(['msg' => 'error', 'error' => $th->getMessage()]);
		 }
	 }
 
	 public function chkUser(Request $Request)
	 {
		 try {
			 $res = new Managers;
			 return response()->json($res->chkUser($Request->all()));
		 } catch (\Exception $th) {
			 return response()->json(['msg' => 'error', 'error' => $th->getMessage()]);
		 }
	 } 
 
	 public function userinfo($id)
	 {
		 try { 
			 $data	= Managers::find($id);
			 $exceptData = ['created_at','updated_at','otp','refered'];
			 // Cambiamos los datos de la imagen		
			 $img_exp = $data->pic_profile;
			 $dat     = collect($data)->except($exceptData)->except('pic_profile');
			 $pic_profile = asset('upload/pic_profile/'.$img_exp);
			 // Agregamos los nuevos datos
			 $dat->put( 'pic_profile' , $pic_profile );
			 
			 return response()->json([
				 'data' => $dat, 
			 ]);
 
			 
		 } catch (\Exception $th) {
			 return response()->json(['data' => 'error', 'error' => $th->getMessage()]);
		 }
	 }

	 public function updateInfo($id,Request $Request)
	{
		try {
			$res = new Managers;
			return response()->json($res->updateInfo($Request->all(),$id));
		} catch (\Exception $th) {
			return response()->json(['data' => 'error', 'error' => $th->getMessage()]);
		}
	}


	 /**
     * Funciones de registro
     */
	public function signup(Request $Request)
	{
		try {
			$res = new Managers;
			return response()->json($res->addNew($Request->all()));
		} catch (\Exception $th) {
			return response()->json(['msg' => 'error', 'error' => $th->getMessage()]);
		}
	} 

	public function sendOTP(Request $Request)
	{
		$phone = $Request->phone;
		$hash  = $Request->hash;

		return response()->json(['otp' => app('App\Http\Controllers\Controller')->sendSms($phone, $hash)]);
	}

		
	/**
	 * Funciones para asignaciones
	 */
	public function getAssignments($user_id)
	{
		try {
			$assigns = Assignments::where('manager_id', $user_id)->where('status',1)->OrderBy('created_at','DESC')->select('uuid')->distinct('uuid')->get();
			$data = [];
			
			foreach ($assigns as $key) {

				// GetConcepts
				$getConc = Assignments::where('uuid', $key->uuid)->where('manager_id', $user_id)->OrderBy('created_at','DESC')->select('uuid','concepts')->get();
				foreach ($getConc as $gtc) {
					$concepts[] = Concepts::find($gtc->concepts);
				}
				
				$getAssign = Assignments::OrderBy('created_at','DESC')->where('uuid', $key->uuid)->where('manager_id', $user_id)->with("School","Manager")->first();
				
				$data[] = [
					'id'        => $getAssign->id,
					'uuid'      => $getAssign->uuid,
					'iva'       => $getAssign->iva,
					'total'     => $getAssign->total,
					'manager_id' => $getAssign->manager_id,
					'status'    => $getAssign->status,
					'school'    => $getAssign->school,
					'manager'   => $getAssign->manager,
					'concepts'  => $concepts,
					'updated_at' => $getAssign->updated_at
				];
				
				$concepts = [];
			}



			return response()->json([
				'assigns' => $assigns,
				'data' => $data
			]);
		} catch (\Exception $th) {
			return response()->json(['data' => 'error', 'error' => $th->getMessage()]);
		}
	}

	public function getEvidences($user_id)
	{
		try {
			$assigns = Assignments::where('manager_id', $user_id)->where('status',3)->OrderBy('created_at','DESC')->select('uuid')->distinct('uuid')->get();
			$data = [];
			
			foreach ($assigns as $key) {

				// GetConcepts
				$getConc = Assignments::where('uuid', $key->uuid)->where('manager_id', $user_id)->OrderBy('created_at','DESC')->select('uuid','concepts')->get();
				foreach ($getConc as $gtc) {
					$concepts[] = Concepts::find($gtc->concepts);
				}
				
				$getAssign = Assignments::OrderBy('created_at','DESC')->where('uuid', $key->uuid)->where('manager_id', $user_id)->with("School","Manager")->first();
				
				$data[] = [
					'id'        => $getAssign->id,
					'uuid'      => $getAssign->uuid,
					'iva'       => $getAssign->iva,
					'total'     => $getAssign->total,
					'manager_id' => $getAssign->manager_id,
					'status'    => $getAssign->status,
					'school'    => $getAssign->school,
					'manager'   => $getAssign->manager,
					'concepts'  => $concepts,
					'updated_at' => $getAssign->updated_at
				];
				
				$concepts = [];
			}



			return response()->json([
				'data' => $data
			]);
		} catch (\Exception $th) {
			return response()->json(['data' => 'error', 'error' => $th->getMessage()]);
		}
	}

	public function CreateEvidence(Request $request)
	{

		$input = $request->all();
		$data = [];

		$data['assignId']	= $input['assignId'];
		$data['assignUuid'] = $input['assignUuid'];
		$data['managerId'] = $input['managerId'];

		$path = '/' . 'uploads/';
		$path_file;


		if ($request->has('picsBefore')) {
			$path_file = 'evidences/before/';
			foreach ($input['picsBefore'] as $key => $value) {
				$picsBeforeBase64 = $value;
				$imageBefore = substr($picsBeforeBase64, strpos($picsBeforeBase64, ",")+1);
				$imagenBeforeDecodificada = base64_decode($imageBefore);	
				$imageBeforName =  substr(md5(time()+$key),0,15) . '.png';
				file_put_contents(public_path($path . $path_file . $imageBeforName), $imagenBeforeDecodificada);
			
				$data['picsBefore'][] =  $imageBeforName;
			}
			
		}

		if ($request->has('picsDuring')) {
			$path_file = 'evidences/during/';
			foreach ($input['picsDuring'] as $key => $value) {
				$picsDuringBase64 = $value;
				$imageDuring = substr($picsDuringBase64, strpos($picsDuringBase64, ",")+1);
				$imagenDuringDecodificada = base64_decode($imageDuring);	
				$imageDuringName =  substr(md5(time()+$key),0,15) . '.png';
				file_put_contents(public_path($path . $path_file . $imageDuringName), $imagenDuringDecodificada);
			
				$data['picsDuring'][] =  $imageDuringName;
			}
			
		}

		if ($request->has('picsAfter')) {
			$path_file = 'evidences/after/';
			foreach ($input['picsAfter'] as $key => $value) {
				$picsAfterBase64 = $value;
				$imageAfter = substr($picsAfterBase64, strpos($picsAfterBase64, ",")+1);
				$imagenAfterDecodificada = base64_decode($imageAfter);	
				$imageAfterName = substr(md5(time()+$key),0,15) . '.png';
				file_put_contents(public_path($path . $path_file . $imageAfterName), $imagenAfterDecodificada);
			
				$data['picsAfter'][] =  $imageAfterName;
			}
			
		}


		$assign = Assignments::where('uuid', $input['assignUuid'])->get();
		foreach ($assign as $key) {	
			$ass = Assignments::find($key->id);
			$ass->status = 3;
			$ass->save();
		}

		$data['picsBefore'] = json_encode($data['picsBefore']);
		$data['picsDuring'] = json_encode($data['picsDuring']);
		$data['picsAfter']  = json_encode($data['picsAfter']);
		

		$lims_data_evidence = new Evidence;
		$evidence = [
			'managers_id' => $data['managerId'],
			'assignments_id' => $data['assignId'],
			'antes' => $data['picsBefore'],
			'durante' => $data['picsDuring'],
			'despues' => $data['picsAfter'],
			'status' => 1
		];

		$lims_data_evidence->create($evidence);

		return response()->json([
			'status' => true,
			'data' => $data
		]);

	}

	
	/**
	 * Funciones para conexiones de valor
	 */
	public function getUser($user)
	{
		try {
			$data = AppUser::where('id',$user)->withCount('userTo')->first();
			$exceptData = ['password','pswfacebook','created_at','updated_at','otp','refered'];
        
			$img_exp = $data->pic_profile;
            $dat     = collect($data)->except($exceptData)->except('pic_profile');
            $pic_profile = asset('upload/users/'.$img_exp);
            $newData = $dat->put( 'pic_profile' , $pic_profile );

			return response()->json([
				'data' => $newData
			]);
		} catch (\Exception $th) {
			return response()->json(['data' => 'error', 'error' => $th->getMessage()]);
		}
	}

	public function getToken(Request $request)
    {
        try {
            $token = new User;
            return response()->json($token->GenToken($request));
        } catch (\Exception $th) {
			return response()->json(['status' => 'ERROR','code' => 500, 'message' => $th->getMessage()], 500);
		}
    }
  
}