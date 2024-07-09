<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
 
Route::prefix(env('user'))->namespace('User')->group(static function() {
    Route::middleware('auth')->group(static function () {


        /*
        |-----------------------------------------
        |Dashboard and Account Setting & Logout
        |-----------------------------------------
        */
        Route::get('/',[App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dash');
        Route::get('dash',[App\Http\Controllers\Admin\AdminController::class, 'home'])->name('dash');
        Route::get('setting',[App\Http\Controllers\Admin\AdminController::class, 'setting'])->name('setting'); 
        Route::post('/setting',[App\Http\Controllers\Admin\AdminController::class, 'update']); 
        Route::get('account',[App\Http\Controllers\Admin\AdminController::class, 'account'])->name('account'); 
        Route::post('update_account',[App\Http\Controllers\Admin\AdminController::class, 'update_account']);
        Route::get('logout',[App\Http\Controllers\Admin\AdminController::class, 'logout'])->name('logoutAdmin');
        
        /*
        |-----------------------------------------
        |Gestor de SubCuentas de administracion
        |-----------------------------------------
        */ 
        Route::resource('subaccounts','\App\Http\Controllers\Admin\SubAccountController');
        Route::get('subaccounts',[App\Http\Controllers\Admin\SubAccountController::class, 'index'])->name('subaccounts');
        Route::get('subaccounts/delete/{id}',[App\Http\Controllers\Admin\SubAccountController::class, 'delete']);
        Route::get('subaccounts/status/{id}',[App\Http\Controllers\Admin\SubAccountController::class, 'status']);
        

        /*
        |-----------------------------------------
        |Gestor de Escuelas
        |-----------------------------------------
        */  
        Route::resource('schools','\App\Http\Controllers\Admin\SchoolsController');
        Route::get('schools',[App\Http\Controllers\Admin\SchoolsController::class, 'index'])->name('schools');
        Route::get('schools/delete/{id}',[App\Http\Controllers\Admin\SchoolsController::class, 'delete']);
        Route::get('schools/status/{id}',[App\Http\Controllers\Admin\SchoolsController::class, 'status']);
        

        /*
        |-----------------------------------------
        |Gestor de Asignaciones
        |-----------------------------------------
        */  
        Route::resource('assignments','\App\Http\Controllers\Admin\AssignmentsController');
        Route::get('assignments',[App\Http\Controllers\Admin\AssignmentsController::class, 'index'])->name('assignments');
        Route::get('assignments/delete/{id}',[App\Http\Controllers\Admin\AssignmentsController::class, 'delete']);
        Route::get('assignments/status/{id}',[App\Http\Controllers\Admin\AssignmentsController::class, 'status']);
        Route::post('assignments/trashConcept',[App\Http\Controllers\Admin\AssignmentsController::class, 'trashConcept'])->name('assignments.trashConcept');
        Route::get('assignments/print/{uuid}',[App\Http\Controllers\Admin\AssignmentsController::class, 'printAssign'])->name('assignments.print');
        Route::get('assignments/printLabour/{uuid}',[App\Http\Controllers\Admin\AssignmentsController::class, 'printAssignLabour'])->name('assignments.print.labour');
        Route::get('assignments/printCertificate/{uuid}',[App\Http\Controllers\Admin\AssignmentsController::class, 'printAssignCertificate'])->name('assignments.print.certificate');
        

        /*
        |-----------------------------------------
        |Gestor de Jefes de obra
        |-----------------------------------------
        */  
        Route::resource('managers','\App\Http\Controllers\Admin\ManagersController');
        Route::get('managers',[App\Http\Controllers\Admin\ManagersController::class, 'index'])->name('managers');
        Route::get('managers/delete/{id}',[App\Http\Controllers\Admin\ManagersController::class, 'delete']);
        Route::get('managers/status/{id}',[App\Http\Controllers\Admin\ManagersController::class, 'status']);
        

        /*
        |-----------------------------------------
        |Gestor de Conceptos
        |-----------------------------------------
        */  
        Route::resource('concepts','\App\Http\Controllers\Admin\ConceptsController');
        Route::get('concepts',[App\Http\Controllers\Admin\ConceptsController::class, 'index'])->name('concepts');
        Route::get('concepts/delete/{id}',[App\Http\Controllers\Admin\ConceptsController::class, 'delete']);
        Route::get('concepts/status/{id}',[App\Http\Controllers\Admin\ConceptsController::class, 'status']);

        Route::get('concepts/upload_xls',[App\Http\Controllers\Admin\ConceptsController::class, 'upload_xls'])->name('upload_xls');
        Route::post('_upload_xls',[App\Http\Controllers\Admin\ConceptsController::class, '_upload_xls']);
       
        /*
        |-----------------------------------------
        |Gestor de Evidencias
        |-----------------------------------------
        */  
        Route::resource('evidence','\App\Http\Controllers\Admin\ConceptsController');
        Route::get('evidence',[App\Http\Controllers\Admin\EvidenceController::class, 'index'])->name('evidence');
        Route::get('getEvidence/{id}/{type}',[App\Http\Controllers\Admin\EvidenceController::class, 'getEvidence']);
        Route::get('viewEvidence/{id}',[App\Http\Controllers\Admin\EvidenceController::class, 'viewEvidence']);
        

        /*
        |-----------------------------------------
        |Ajustes
        |-----------------------------------------
        */ 
        Route::get('ajustes',[App\Http\Controllers\Admin\AdminController::class, 'ajustes'])->name('ajustes');
        Route::post('update_ajustes',[App\Http\Controllers\Admin\AdminController::class, 'update_ajustes']);
     
    });

});


/*
|--------------------------------------------------------------------------
| Control de fallos
|--------------------------------------------------------------------------
*/
// Route::fallback(function () {
//     return view('errors.404');
// });
