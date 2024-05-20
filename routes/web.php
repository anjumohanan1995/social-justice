<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\PanchayatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\PoliceStationController;
use App\Http\Controllers\RDOController;
use App\Http\Controllers\OrdersController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('home');

Route::any('/district',[App\Http\Controllers\AdminController::class, 'district'])->name("district");

Route::resource('users', UsersController::class);
Route::get('users-management/users-list/get', [UsersController::class, 'getUsersList'])->name("get.users-list");

//profile
Route::get('/profile', [UsersController::class, 'profile'])->name('profile');

Route::resource('roles', RoleController::class);
Route::get('users-management/roles-list/get', [RoleController::class, 'getRoles'])->name("get.roles");
Route::get('/roles/{id}/editPermission', [RoleController::class, 'editPermission'])->name('edit-rolePermission');
Route::post('/roles/addPermission/{id}', [RoleController::class, 'addPermission'])->name('roles.permission.store');
Route::get('/user-registration', [UsersController::class, 'userRegistration']);
Route::post('/user-store', [UsersController::class, 'userStore'])->name('userStore');


Route::get('case-register', [CaseController::class, 'caseRegister'])->name("case.register");
Route::post('case-register', [CaseController::class, 'storecaseRegister'])->name("case.store");
Route::resource('cases', CaseController::class);
Route::get('cases-list/get', [CaseController::class, 'getCaseList'])->name("get.cases-list");
Route::get('/ViewCases/{id}',[CaseController::class, 'ViewCases'])->name('ViewCases');


Route::get('rdo-cases', [RDOController::class, 'index'])->name("case.list");
Route::get('rdo/cases-list/get', [RDOController::class, 'getCaseList'])->name("rdo.get.cases-list");
Route::get('/ViewRdoCases/{id}',[RDOController::class, 'ViewRdoCases'])->name('ViewRdoCases');
Route::post('/caseDataRdoApprove',[RDOController::class, 'caseDataRdoApprove'])->name('caseData.Rdo.approve');
Route::post('/caseDataRdoReject',[RDOController::class, 'caseDataRdoReject'])->name('caseData.Rdo.reject');

//police station

Route::get('/policestation',[PoliceStationController::class,'index'])->name('policestation');
Route::post('/policestation',[PoliceStationController::class, 'store'])->name('policestation.store');
Route::get('/policestation.create',[PoliceStationController::class, 'create'])->name('policestation.create');
Route::get('getPoliceStationList',[PoliceStationController::class, 'getPoliceStationList'])->name('getPoliceStationList');
Route::get('/policestation/{id}/edit',[PoliceStationController::class, 'edit']);
Route::put('/policestation/{id}',[PoliceStationController::class, 'update'])->name('policestation.update');
Route::delete('/policestation/{id}',[PoliceStationController::class,'destroy' ])->name('policestation/delete');
//police station

//Panchayat

Route::get('/panchayat',[PanchayatController::class,'index'])->name('panchayat.index');
Route::get('/panchayat-create',[PanchayatController::class, 'create'])->name('panchayat.create');
Route::post('/panchayat-store',[PanchayatController::class, 'store'])->name('panchayat.store');
Route::get('/panchayat-list',[PanchayatController::class, 'list'])->name('getPanchayatList');
Route::get('/panchayat/{id}/edit',[PanchayatController::class, 'edit'])->name('panchayat.edit');
Route::put('/panchayat-update/{id}',[PanchayatController::class, 'update'])->name('panchayat.update');
Route::delete('/panchayat/{id}',[PanchayatController::class,'destroy' ])->name('panchayat/delete');

//Panchayat

//finding policestation based on district

Route::post('/get-police-station',[PoliceStationController::class, 'get_police_station'])->name('get-police-station');

// orders module
Route::get('/orders',[OrdersController::class,'index'])->name('orders.index');
Route::get('/orders-create',[OrdersController::class, 'create'])->name('orders.create');
Route::post('/orders',[OrdersController::class, 'store'])->name('orders.store');
Route::get('/orders-list',[OrdersController::class, 'getOrdersList'])->name('getOrdersList');
