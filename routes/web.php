<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController, PanchayatController, UsersController, RoleController, AuthController, CaseController, PoliceStationController, RDOController, OrdersController
};

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Auth::routes();
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Home Route
Route::get('/home', [AdminController::class, 'index'])->name('home');

// District Route
Route::any('/district', [AdminController::class, 'district'])->name('district');

// Profile Route
Route::get('/profile', [UsersController::class, 'profile'])->name('profile');

// User Management Routes
Route::group(['middleware' => ['check.permission:user-management']], function () {
    Route::resource('users', UsersController::class);
    Route::get('users-management/users-list/get', [UsersController::class, 'getUsersList'])->name('get.users-list');
    Route::get('/user-registration', [UsersController::class, 'userRegistration'])->middleware('check.permission:user-management:add-user');
    Route::post('/user-store', [UsersController::class, 'userStore'])->name('userStore')->middleware('check.permission:user-management:add-user');
});

// Role Management Routes
Route::group(['middleware' => ['check.permission:role-management']], function () {
    Route::resource('roles', RoleController::class);
    Route::get('users-management/roles-list/get', [RoleController::class, 'getRoles'])->name('get.roles');
    Route::get('/roles/{id}/editPermission', [RoleController::class, 'editPermission'])->name('edit-rolePermission')->middleware('check.permission:role-management:edit-role');
    Route::post('/roles/addPermission/{id}', [RoleController::class, 'addPermission'])->name('roles.permission.store')->middleware('check.permission:role-management:edit-role');
});

// Case Management Routes
Route::group(['middleware' => ['check.permission:case-management']], function () {
    Route::resource('cases', CaseController::class);
    Route::get('cases-list/get', [CaseController::class, 'getCaseList'])->name('get.cases-list');
    Route::get('/ViewCases/{id}', [CaseController::class, 'ViewCases'])->name('ViewCases')->middleware('check.permission:case-management:case-list');
    Route::get('case-register', [CaseController::class, 'caseRegister'])->name('case.register');
    Route::post('case-register', [CaseController::class, 'storecaseRegister'])->name('case.store');
});

// RDO Cases Routes
Route::group(['middleware' => ['check.permission:case-management']], function () {
    Route::get('rdo-cases', [RDOController::class, 'index'])->name('case.list')->middleware('check.permission:case-management:case-list');
    Route::get('rdo/cases-list/get', [RDOController::class, 'getCaseList'])->name('rdo.get.cases-list');
    Route::get('/ViewRdoCases/{id}', [RDOController::class, 'ViewRdoCases'])->name('ViewRdoCases')->middleware('check.permission:case-management:case-list');
    Route::post('/caseDataRdoApprove', [RDOController::class, 'caseDataRdoApprove'])->name('caseData.Rdo.approve')->middleware('check.permission:case-management:case-list');
    Route::post('/caseDataRdoReject', [RDOController::class, 'caseDataRdoReject'])->name('caseData.Rdo.reject')->middleware('check.permission:case-management:case-list');
    Route::get('rdo-orders', [RDOController::class, 'rdoOders'])->name('orders.list')->middleware('check.permission:case-management:case-list');
    Route::get('rdo/orders-list/get', [RDOController::class, 'getOrderList'])->name('rdo.get.orders-list');
    Route::get('/ViewRdoOrders/{id}', [RDOController::class, 'ViewRdoOrders'])->name('ViewRdoOrders')->middleware('check.permission:case-management:case-list');
});

// Police Station Management Routes
Route::group(['middleware' => ['check.permission:police-station-management']], function () {
    Route::get('/policestation', [PoliceStationController::class, 'index'])->name('policestation');
    Route::post('/policestation', [PoliceStationController::class, 'store'])->name('policestation.store');
    Route::get('/policestation.create', [PoliceStationController::class, 'create'])->name('policestation.create');
    Route::get('getPoliceStationList', [PoliceStationController::class, 'getPoliceStationList'])->name('getPoliceStationList');
    Route::get('/policestation/{id}/edit', [PoliceStationController::class, 'edit']);
    Route::put('/policestation/{id}', [PoliceStationController::class, 'update'])->name('policestation.update');
    Route::delete('/policestation/{id}', [PoliceStationController::class, 'destroy'])->name('policestation.delete');
    Route::post('/get-police-station', [PoliceStationController::class, 'get_police_station'])->name('get-police-station')->middleware('check.permission:police-station-management:police-station-list');
});

// Panchayat Management Routes
Route::group(['middleware' => ['check.permission:panchayat-management']], function () {
    Route::get('/panchayat', [PanchayatController::class, 'index'])
        ->name('panchayat.index')
        ->middleware('check.permission:panchayat-management:panchayat-list');
    Route::get('/panchayat-create', [PanchayatController::class, 'create'])
        ->name('panchayat.create')
        ->middleware('check.permission:panchayat-management:add-panchayat');
    Route::post('/panchayat-store', [PanchayatController::class, 'store'])
        ->name('panchayat.store')
        ->middleware('check.permission:panchayat-management:add-panchayat');
    Route::get('/panchayat-list', [PanchayatController::class, 'list'])
        ->name('getPanchayatList')
        ->middleware('check.permission:panchayat-management:panchayat-list');
    Route::get('/panchayat/{id}/edit', [PanchayatController::class, 'edit'])
        ->name('panchayat.edit')
        ->middleware('check.permission:panchayat-management:edit-panchayat');
    Route::put('/panchayat-update/{id}', [PanchayatController::class, 'update'])
        ->name('panchayat.update')
        ->middleware('check.permission:panchayat-management:edit-panchayat');
    Route::delete('/panchayat/{id}', [PanchayatController::class, 'destroy'])
        ->name('panchayat.delete')
        ->middleware('check.permission:panchayat-management:delete-panchayat');
});
// Orders Management Routes
// Orders Management Routes
Route::group(['middleware' => ['check.permission:orders-management']], function () {
    Route::get('/orders', [OrdersController::class, 'index'])
        ->name('orders.index')
        ->middleware('check.permission:orders-management:orders-list');
    Route::get('/orders-create', [OrdersController::class, 'create'])
        ->name('orders.create')
        ->middleware('check.permission:orders-management:add-orders');
    Route::post('/orders', [OrdersController::class, 'store'])
        ->name('orders.store')
        ->middleware('check.permission:orders-management:add-orders');
    Route::get('/orders-list', [OrdersController::class, 'getOrdersList'])
        ->name('getOrdersList')
        ->middleware('check.permission:orders-management:orders-list');
});


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

Route::get('rdo-orders', [RDOController::class, 'rdoOders'])->name("orders.list");
Route::get('rdo/orders-list/get', [RDOController::class, 'getOrderList'])->name("rdo.get.orders-list");
Route::get('/ViewRdoOrders/{id}',[RDOController::class, 'ViewRdoOrders'])->name('ViewRdoOrders');

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
// No Permission Route
Route::get('/no-permission', function () {
    return view('user.no-permission');
});
