<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\RDOController;

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

Route::resource('roles', RoleController::class);
Route::get('users-management/roles-list/get', [RoleController::class, 'getRoles'])->name("get.roles");
Route::get('/roles/{id}/editPermission', [RoleController::class, 'editPermission'])->name('edit-rolePermission');
Route::post('/roles/addPermission/{id}', [RoleController::class, 'addPermission'])->name('roles.permission.store');
Route::get('user-registration', [UsersController::class, 'userRegistration']);
Route::post('/user-store', [UsersController::class, 'userStore'])->name('userStore');


Route::get('case-register', [CaseController::class, 'caseRegister'])->name("case.register");
Route::post('case-register', [CaseController::class, 'storecaseRegister'])->name("case.store");
Route::resource('cases', CaseController::class);
Route::get('cases-list/get', [CaseController::class, 'getCaseList'])->name("get.cases-list");


Route::get('rdo-cases', [RDOController::class, 'index'])->name("case.list");
Route::get('rdo/cases-list/get', [RDOController::class, 'getCaseList'])->name("rdo.get.cases-list");

// khlklkldf

