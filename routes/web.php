<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FixedAssetController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\APIErpController;
use App\Http\Controllers\DetailPengajuanPinjamanController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PengajuanPinjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\ReportVesselController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\SetTypeTugBargeController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StockTakeController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VesselController;
use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LockScreenController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Models\Department;

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
    return redirect('login');
});

// CONTROLLER LOGIN
Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('/login/proses', 'proses');
    Route::get('logout', 'logout')->name('logout');
});

// RESET PASSWORD
Route::get('reset_password', [PasswordController::class, 'index'])->name('reset_password.index');
Route::post('reset_password_save', [PasswordController::class, 'reset_password_save'])->name('reset_password_save');

// MIDDLEWARE AUTH
Route::group(['middleware' => ['auth']], function () {


    // =================================MODULE FIXED ASSET=======================================
    // Master Fixed Assets
    Route::resource('fixed_assets', FixedAssetController::class);
    Route::get('/fixed_asset/json', [FixedAssetController::class, 'json']);
    Route::post('fixed_asset_import', [FixedAssetController::class, 'import'])->name('fixed_asset.import');
    Route::get('fixed_asset_export', [FixedAssetController::class, 'export'])->name('fixed_asset.export');
    Route::get('generate/{fix_asset}', [FixedAssetController::class, 'generate'])->name('generate.qr_code');
    Route::put('fa_import_nbv', [FixedAssetController::class, 'import_nbv'])->name('fa_nbv.import');

    // Set Type Tug and Barge
    Route::get('/settype_tugbarge', [SetTypeTugBargeController::class, 'index'])->middleware('auth');
    Route::get('/settype_tugbarge/json', [SetTypeTugBargeController::class, 'json'])->middleware('auth');
    Route::get('/settype_tugbarge/data_db', [SetTypeTugBargeController::class, 'data_db'])->middleware('auth');
    Route::get('/settype_tugbarge/data_db2', [SetTypeTugBargeController::class, 'data_db2'])->middleware('auth');

    // GET TUG BARGE FIXED ASSET
    Route::match(['get', 'post'], '/scan_vessels_get_tugbarge_testing', [ReportVesselController::class, 'json_testing'])->middleware('auth');
    Route::match(['get', 'post'], '/report_vessels_get_tug', [ReportVesselController::class, 'get_asset_tug_json'])->middleware('auth');
    Route::match(['get', 'post'], '/get_barge', [ReportVesselController::class, 'get_barge'])->middleware('auth');
    Route::match(['get', 'post'], '/report_vessels_get_barge', [ReportVesselController::class, 'get_asset_barge_json'])->middleware('auth');

    // SCANNER
    Route::get('scan_form', [ScanController::class, 'index']);
    Route::get('scan_edit_form/{fix_asset}', [ScanController::class, 'show_edit'])->name('scan.edit');
    Route::post('get_scan_qrcode', [ScanController::class, 'get_scan_qrcode']);
    Route::put('update_scan_asset', [ScanController::class, 'update_scan_asset'])->name('update_scan_asset.update');

    // STOCK TAKE
    Route::get('/print_stock_take/{id}', [StockTakeController::class, 'print_stock_take'])->name('print.stock_take');
    Route::get('stock_takes', [StockTakeController::class, 'index']);
    Route::get('/stock_takes/json', [StockTakeController::class, 'json']);

    // LOG Trans Assets
    Route::get('log_trans_asset_view', [FixedAssetController::class, 'log_trans_asset_view'])->name('log_trans_asset_view')->middleware('auth');
    Route::get('log_trans_asset_json', [FixedAssetController::class, 'log_trans_asset_json'])->name('log_trans_asset_json')->middleware('auth');

    // REPORT VESSEL
    Route::get('/scan_vessels', [ReportVesselController::class, 'index'])->middleware('auth');
    // Route::get('/scan_vessels/scan', [BarcodeController::class, 'scan_vessels'])->middleware('auth');

    // Form Asset Kategori Per Kapal
    Route::match(['get', 'post'], 'form_asset_view', [FixedAssetController::class, 'form_asset_view'])->name('form_asset_view')->middleware('auth');
    // Route::get('form_asset_view_json', [FixedAssetController::class, 'form_asset_view_json'])->name('form_asset_view_json')->middleware('auth');
    // Route::get('get_mapping_assets_json', [FixedAssetController::class, 'get_mapping_assets_json'])->name('get_mapping_assets_json')->middleware('auth');

    // =================================END MODULE FIXED ASSET=======================================


    // =================================MODULE FILLING DOCUMENT==============================================
    // Document
    Route::get('documents', [DocumentController::class, 'index'])->middleware('auth');
    Route::get('document/edit/{id}', [DocumentController::class, 'edit'])->name('document.edit')->middleware('auth');
    Route::put('document/update/{id}', [DocumentController::class, 'update'])->name('document.update')->middleware('auth');
    Route::delete('document/destroy/{id}', [DocumentController::class, 'destroy'])->name('document.destroy')->middleware('auth');
    Route::get('document/json', [DocumentController::class, 'json'])->middleware('auth');
    Route::post('document_import', [DocumentController::class, 'import'])->name('document.import')->middleware('auth');
    Route::put('update_doc_status', [DocumentController::class, 'update_doc_status'])->name('update_doc_status.import')->middleware('auth');

    //Pengajuan Pinjaman
    Route::resource('pengajuan_pinjamans', PengajuanPinjamanController::class)->middleware('auth');
    Route::get('/pengajuan_pinjaman/json', [PengajuanPinjamanController::class, 'json'])->middleware('auth');
    Route::get('/pengajuan_pinjaman/approve/{id}', [PengajuanPinjamanController::class, 'approve'])->name('pengajuan_pinjaman.approve')->middleware('auth');
    Route::get('/pengajuan_pinjaman/reject/{id}', [PengajuanPinjamanController::class, 'reject'])->name('pengajuan_pinjaman.reject')->middleware('auth');
    Route::get('/pengajuan_pinjaman/document_tersedia', [PengajuanPinjamanController::class, 'document_tersedia'])->name('pengajuan_pinjaman.document_tersedia')->middleware('auth');
    Route::get('/pengajuan_pinjaman/detail/{id}', [PengajuanPinjamanController::class, 'detail'])->name('pengajuan_pinjaman.detail')->middleware('auth');

    //Detail Pengajuan Pinjaman
    Route::get('/detail_pengajuan_pinjaman', [DetailPengajuanPinjamanController::class, 'index'])->middleware('auth');
    Route::get('/detail_pengajuan_pinjaman/json/{id_pengpinj}', [DetailPengajuanPinjamanController::class, 'json'])->name('detail_pengajuan_pinjaman')->middleware('auth');

    //Pinjaman
    Route::resource('pinjamans', PinjamanController::class)->middleware('auth');
    Route::get('/pinjaman/json', [PinjamanController::class, 'json'])->middleware('auth');
    Route::get('/pinjaman/perpanjang/{id}', [PinjamanController::class, 'perpanjang'])->name('pinjaman.perpanjang')->middleware('auth');
    Route::get('/pinjaman/kembalikan/{id}', [PinjamanController::class, 'kembalikan'])->name('pinjaman.kembalikan')->middleware('auth');

    //Pengembalian
    Route::resource('pengembalians', PengembalianController::class)->middleware('auth');
    Route::get('/pengembalian/json', [PengembalianController::class, 'json'])->middleware('auth');

    // CHANGE PASSWORD USER
    Route::get('change_password_view', [PasswordController::class, 'change_password_view'])->name('change_password_view');
    Route::put('change_password_update/{id}', [PasswordController::class, 'change_password_update'])->name('change_password_update');

    // =================================END MODULE FILLING DOCUMENT==============================================

});

// MIDDLEWARE ADMIN
Route::group(['middleware' => ['is_Admin']], function () {
    // DASHBOARD
    Route::get('home_admin', [DashboardController::class, 'home_admin']);

    // USER
    Route::resource('users', UserController::class)->middleware('auth');
    Route::get('/user/json', [UserController::class, 'json'])->middleware('auth');
    Route::put('user/update/{id}', [UserController::class, 'update'])->name('user.update')->middleware('auth');
    Route::put('user/change_password/{id}', [UserController::class, 'change_password'])->name('user.change_password')->middleware('auth');
    Route::post('user_import', [UserController::class, 'import'])->name('user.import');
    Route::get('user_export', [UserController::class, 'export'])->name('user.export')->middleware('auth');
    // SETUP IMPORT USER
    Route::get('import_user_no_auth', [UserController::class, 'import_user_no_auth']);

    // Fixed Asset Staging from ERP
    Route::get('fixed_assets_stg_index', [APIErpController::class, 'fixed_assets_stg_index']);
    Route::get('fixed_assets_stg_json', [APIErpController::class, 'fixed_assets_stg_json']);
    Route::get('fixed_assets_stg_save', [APIErpController::class, 'fixed_assets_stg_save']);


    // Document Staging from ERP
    Route::get('doc_stg_index', [APIErpController::class, 'doc_stg_index']);
    Route::get('doc_stg_json', [APIErpController::class, 'doc_stg_json']);
    Route::get('doc_stg_save', [APIErpController::class, 'doc_stg_save']);

    // Employee Staging from ERP
    Route::get('employees_stg_index', [APIErpController::class, 'employees_stg_index']);
    Route::get('employees_stg_json', [APIErpController::class, 'employees_stg_json']);
    Route::get('employees_stg_save', [APIErpController::class, 'employees_stg_save']);

    // Customer Staging from ERP
    Route::get('customers_stg_index', [APIErpController::class, 'customers_stg_index']);
    Route::get('customers_stg_json', [APIErpController::class, 'customers_stg_json']);
    Route::get('customers_stg_save', [APIErpController::class, 'customers_stg_save']);

    // Vendor Staging from ERP
    Route::get('vendors_stg_index', [APIErpController::class, 'vendors_stg_index']);
    Route::get('vendors_stg_json', [APIErpController::class, 'vendors_stg_json']);
    Route::get('vendors_stg_save', [APIErpController::class, 'vendors_stg_save']);

    // Site Staging from ERP
    Route::get('sites_stg_index', [APIErpController::class, 'sites_stg_index']);
    Route::get('sites_stg_json', [APIErpController::class, 'sites_stg_json']);
    Route::get('sites_stg_save', [APIErpController::class, 'sites_stg_save']);

    // Vessel Staging from ERP
    Route::get('vessels_stg_index', [APIErpController::class, 'vessels_stg_index']);
    Route::get('vessels_stg_json', [APIErpController::class, 'vessels_stg_json']);
    Route::get('vessels_stg_save', [APIErpController::class, 'vessels_stg_save']);

    // VESSEL
    Route::get('vessels', [VesselController::class, 'index']);
    Route::get('vessel/json', [VesselController::class, 'json']);
    Route::get('vessel_export', [VesselController::class, 'export'])->name('vessel.export');

    // LOCATION
    Route::get('locations', [LocationController::class, 'index']);
    Route::get('location/json', [LocationController::class, 'json']);
    Route::post('location/store', [LocationController::class, 'store'])->name('location.store');
    Route::post('location_import', [LocationController::class, 'import'])->name('location.import');
    Route::get('location/insert_general', [LocationController::class, 'insert_general']);

    //Employee
    Route::get('employees', [EmployeeController::class, 'index']);
    Route::get('employee/json', [EmployeeController::class, 'json']);
    Route::post('employee/store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::put('employee/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');

    //Vendor
    Route::get('vendors', [VendorController::class, 'index']);
    Route::get('vendor/json', [VendorController::class, 'json']);


    // ROOM
    Route::get('rooms', [RoomController::class, 'index']);
    Route::post('room/store', [RoomController::class, 'store'])->name('room.store');
    Route::get('/room/json', [RoomController::class, 'json']);
    Route::post('room_import', [RoomController::class, 'import'])->name('room.import');
    Route::get('room_import_template', [RoomController::class, 'room_import_template'])->name('room_import_template');
    Route::get('room_export', [RoomController::class, 'export'])->name('room.export');

    // SITE
    Route::get('sites', [SiteController::class, 'index']);
    Route::get('/site/json', [SiteController::class, 'json']);
    Route::post('site_import', [SiteController::class, 'import'])->name('site.import');
    Route::post('site/store', [SiteController::class, 'store'])->name('site.store');
    Route::get('site_export', [SiteController::class, 'export'])->name('site.export');

    // ASSET CATEGORY
    Route::get('asset_category', [AssetCategoryController::class, 'index']);
    Route::get('/asset_category/json', [AssetCategoryController::class, 'json']);
    Route::post('asset_category/store', [AssetCategoryController::class, 'store'])->name('asset_category.store');
    Route::delete('asset_category/delete/{id}', [AssetCategoryController::class, 'delete'])->name('asset_category.delete');

    // Mapping Asset Category
    Route::match(['get', 'post'], 'map_ast_cat_view', [AssetCategoryController::class, 'map_ast_cat_view'])->name('map_ast_cat_view');
    Route::get('getLocationJson/{id}', [AssetCategoryController::class, 'getLocationJson'])->name('getLocationJson');
    Route::get('map_ast_cat_view_json', [AssetCategoryController::class, 'map_ast_cat_view_json'])->name('map_ast_cat_view_json');
    Route::post('map_ast_cat_save', [AssetCategoryController::class, 'map_ast_cat_save'])->name('map_ast_cat_save');
    Route::delete('map_ast_cat_delete/{id}', [AssetCategoryController::class, 'map_ast_cat_delete'])->name('map_ast_cat_delete');


    // TESTING DATA
    Route::match(['get', 'put'], 'update_userid_employee', [TestController::class, 'update_userid_employee'])->name('update_userid_employee');
});

// MIDDLEWARE USER
Route::group(['middleware' => ['is_User']], function () {
    // DASHBOARD
    Route::get('home_user', [DashboardController::class, 'home_user']);
});

// MIDDLEWARE VESSEL
Route::group(['middleware' => ['is_Vessel']], function () {
    // DASHBOARD
    Route::get('home_crew', [DashboardController::class, 'home_crew']);
});

// MIDDLEWARE ADMIN & USER
Route::group(['middleware' => ['is_Admin_User']], function () {
});

// MIDDLEWARE ADMIN & VESSEL
Route::group(['middleware' => ['is_Admin_Vessel']], function () {
});



// =================================MODULE FIXED ASSET=======================================
// =================================END MODULE FIXED ASSET=======================================
// =================================MODULE FILLING DOCUMENT=======================================
// =================================END MODULE FILLING DOCUMENT=======================================

// ===========================================================================================
// ===========================================================================================

// TESTING API ERP
Route::get('invoice_ar', [APIErpController::class, 'invoice_ar']);
Route::resource('tests', TestController::class);

Route::get('/barcode', [BarcodeController::class, 'index']);
Route::get('/scan', [BarcodeController::class, 'scan']);

Route::post('scanner', [BarcodeController::class, 'scanner_validasi']);
Route::put('scanner_update/{id}', [BarcodeController::class, 'update'])->name('scanner.update');

// Email
Route::get('test_index', [SendMailController::class, 'test_index'])->name('test_index.viewemail');
Route::get('test_send_email', [SendMailController::class, 'ba_status'])->name('test_send_email.sendmail');
Route::get('ba_status/{id}', [SendMailController::class, 'ba_status'])->name('ba_status.sendmail');

// Recruitment Crew
Route::get('/recruitment_crew/regist', [RecruitmentController::class, 'recruitment_crew_regist']);
Route::get('/recruitment_crew', [RecruitmentController::class, 'index']);


Route::get('/ip', function () {
    $checkLocation = geoip()->getLocation($_SERVER['REMOTE_ADDR']);
    return $checkLocation->toArray();
});

Route::get('crew_report_data', [CrewController::class, 'index'])->name('crew_report_data')->middleware('auth');
Route::get('crew_report_json', [CrewController::class, 'json_report'])->name('crew_report_json')->middleware('auth');

Route::get('cek_api', [APIErpController::class, 'cek_api']);



// LOCK SCREEN
Route::group(['middleware' => ['auth']], function () {
    Route::get('lock-screen', [LockScreenController::class, 'lock_screen'])->name('lock-screen');
    Route::get('unlock', [LockScreenController::class, 'unlock'])->name('unlock');
});


// Update Password User
Route::match(['get', 'put'], 'update_password_user', [UserController::class, 'update_password_user'])->name('update_password_user');



// PROFILE
Route::get('profiles', [ProfileController::class, 'index'])->name('profiles')->middleware('auth');


// Department
Route::get('department', [DepartmentController::class, 'index'])->name('profiles.index');
Route::get('department/json', [DepartmentController::class, 'json'])->name('department.json');
Route::match(['get', 'post'], 'department/save', [DepartmentController::class, 'store'])->name('department.store');
Route::match(['get', 'put'], 'department/update/{id}', [DepartmentController::class, 'update'])->name('department.update');
Route::delete('department/delete/{id}', [DepartmentController::class, 'delete'])->name('department.delete');
