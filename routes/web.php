<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FixedAssetsController;
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
use App\Http\Controllers\RoomVesselController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\ScanVesselController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\SetTypeTugBargeController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StockTakeController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VesselController;
use App\Models\RoomVessel;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\UserSystemInfoHelper;
use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\EmployeeController;

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
    // return view('login');
    return redirect('login');
});

// Route::get('/', [LoginController::class, 'index']);

// LOGIN
Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('/login/proses', 'proses');
    Route::get('logout', 'logout')->name('logout');
});

// MIDDLEWARE
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cekUserLogin:admin']], function () {
        // DASHBOARD
        Route::get('home_admin', [DashboardController::class, 'home_admin']);
    });
    Route::group(['middleware' => ['cekUserLogin:user']], function () {
        // DASHBOARD
        Route::get('home_user', [DashboardController::class, 'home_user']);
    });
    Route::group(['middleware' => ['cekUserLogin:vessel']], function () {
        // DASHBOARD
        Route::get('home_crew', [DashboardController::class, 'home_crew']);
    });
});

// DASHBOARD
// Route::get('home_admin', [DashboardController::class, 'home_admin']);
Route::get('home_owner', [DashboardController::class, 'home_owner']);
Route::get('home_manager', [DashboardController::class, 'home_manager']);
// Route::get('home_staff', [DashboardController::class, 'home_staff']);


// USER
Route::resource('users', UserController::class)->middleware('auth');
Route::get('/user/json', [UserController::class, 'json'])->middleware('auth');
Route::post('user_import', [UserController::class, 'import'])->name('user.import');
Route::get('user_export', [UserController::class, 'export'])->name('user.export')->middleware('auth');
// SETUP IMPORT USER
Route::get('import_user_no_auth', [UserController::class, 'import_user_no_auth']);



// Fixed Assets
Route::resource('fixed_assets', FixedAssetController::class)->middleware('auth');
Route::get('/fixed_asset/json', [FixedAssetController::class, 'json'])->middleware('auth');
Route::post('fixed_asset_import', [FixedAssetController::class, 'import'])->name('fixed_asset.import')->middleware('auth');
Route::get('fixed_asset_export', [FixedAssetController::class, 'export'])->name('fixed_asset.export')->middleware('auth');
Route::get('generate/{fix_asset}', [FixedAssetController::class, 'generate'])->name('generate.qr_code')->middleware('auth');
Route::put('fa_import_nbv', [FixedAssetController::class, 'import_nbv'])->name('fa_nbv.import')->middleware('auth');

// =========================================================================================

// Fixed Asset Staging from ERP
Route::get('fixed_assets_stg_index', [APIErpController::class, 'fixed_assets_stg_index'])->middleware('auth');
Route::get('fixed_assets_stg_json', [APIErpController::class, 'fixed_assets_stg_json'])->middleware('auth');
Route::get('fixed_assets_stg_save', [APIErpController::class, 'fixed_assets_stg_save'])->middleware('auth');
Route::get('cek_api', [APIErpController::class, 'cek_api']);

// TESTING API ERP
Route::get('invoice_ar', [APIErpController::class, 'invoice_ar']);
Route::resource('tests', TestController::class);

Route::get('/barcode', [BarcodeController::class, 'index'])->middleware('auth');
Route::get('/scan', [BarcodeController::class, 'scan'])->middleware('auth');

Route::post('scanner', [BarcodeController::class, 'scanner_validasi'])->middleware('auth');
Route::put('scanner_update/{id}', [BarcodeController::class, 'update'])->name('scanner.update')->middleware('auth');

// SCANNER
Route::get('scan_form', [ScanController::class, 'index'])->middleware('auth');
Route::get('scan_edit_form/{fix_asset}', [ScanController::class, 'show_edit'])->name('scan.edit')->middleware('auth');
Route::post('get_scan_qrcode', [ScanController::class, 'get_scan_qrcode'])->middleware('auth');
Route::put('update_scan_asset', [ScanController::class, 'update_scan_asset'])->name('update_scan_asset.update')->middleware('auth');

// ROOM
Route::get('rooms', [RoomController::class, 'index'])->middleware('auth');
Route::post('room/store', [RoomController::class, 'store'])->name('room.store')->middleware('auth');
Route::get('/room/json', [RoomController::class, 'json'])->middleware('auth');
Route::post('room_import', [RoomController::class, 'import'])->name('room.import')->middleware('auth');
Route::get('room_export', [RoomController::class, 'export'])->name('room.export')->middleware('auth');

// SITE
Route::get('sites', [SiteController::class, 'index'])->middleware('auth');
Route::get('/site/json', [SiteController::class, 'json'])->middleware('auth');
Route::post('site_import', [SiteController::class, 'import'])->name('site.import')->middleware('auth');
Route::post('site/store', [SiteController::class, 'store'])->name('site.store')->middleware('auth');
Route::get('site_export', [SiteController::class, 'export'])->name('site.export')->middleware('auth');


// STOCK TAKE
Route::get('/print_stock_take/{id}', [StockTakeController::class, 'print_stock_take'])->name('print.stock_take')->middleware('auth');
Route::get('stock_takes', [StockTakeController::class, 'index'])->middleware('auth');
Route::get('/stock_takes/json', [StockTakeController::class, 'json'])->middleware('auth');

// Document Staging from ERP
Route::get('doc_stg_index', [APIErpController::class, 'doc_stg_index'])->middleware('auth');
Route::get('doc_stg_json', [APIErpController::class, 'doc_stg_json'])->middleware('auth');
Route::get('doc_stg_save', [APIErpController::class, 'doc_stg_save'])->middleware('auth');

// Employee Staging from ERP
Route::get('employees_stg_index', [APIErpController::class, 'employees_stg_index'])->middleware('auth');
Route::get('employees_stg_json', [APIErpController::class, 'employees_stg_json'])->middleware('auth');
Route::get('employees_stg_save', [APIErpController::class, 'employees_stg_save'])->middleware('auth');


// Customer Staging from ERP
Route::get('customers_stg_index', [APIErpController::class, 'customers_stg_index'])->middleware('auth');
Route::get('customers_stg_json', [APIErpController::class, 'customers_stg_json'])->middleware('auth');
Route::get('customers_stg_save', [APIErpController::class, 'customers_stg_save'])->middleware('auth');

// Vendor Staging from ERP
Route::get('vendors_stg_index', [APIErpController::class, 'vendors_stg_index'])->middleware('auth');
Route::get('vendors_stg_json', [APIErpController::class, 'vendors_stg_json'])->middleware('auth');
Route::get('vendors_stg_save', [APIErpController::class, 'vendors_stg_save'])->middleware('auth');

// Site Staging from ERP
Route::get('sites_stg_index', [APIErpController::class, 'sites_stg_index'])->middleware('auth');
Route::get('sites_stg_json', [APIErpController::class, 'sites_stg_json'])->middleware('auth');
Route::get('sites_stg_save', [APIErpController::class, 'sites_stg_save'])->middleware('auth');

// Vessel Staging from ERP
Route::get('vessels_stg_index', [APIErpController::class, 'vessels_stg_index'])->middleware('auth');
Route::get('vessels_stg_json', [APIErpController::class, 'vessels_stg_json'])->middleware('auth');
Route::get('vessels_stg_save', [APIErpController::class, 'vessels_stg_save'])->middleware('auth');



// VESSEL
Route::get('vessels', [VesselController::class, 'index'])->middleware('auth');
Route::get('vessel/json', [VesselController::class, 'json'])->middleware('auth');
Route::get('vessel_export', [VesselController::class, 'export'])->name('vessel.export')->middleware('auth');


// LOCATION
Route::get('locations', [LocationController::class, 'index'])->middleware('auth');
Route::get('location/json', [LocationController::class, 'json'])->middleware('auth');
Route::post('location/store', [LocationController::class, 'store'])->name('location.store')->middleware('auth');
Route::post('location_import', [LocationController::class, 'import'])->name('location.import')->middleware('auth');
Route::get('location/insert_general', [LocationController::class, 'insert_general'])->middleware('auth');

//Employee
Route::get('employees', [EmployeeController::class, 'index'])->middleware('auth');
Route::get('employee/json', [EmployeeController::class, 'json'])->middleware('auth');

//Vendor
Route::get('vendors', [VendorController::class, 'index'])->middleware('auth');
Route::get('vendor/json', [VendorController::class, 'json'])->middleware('auth');

// Email
Route::get('test_index', [SendMailController::class, 'test_index'])->name('test_index.viewemail')->middleware('auth');
Route::get('test_send_email', [SendMailController::class, 'ba_status'])->name('test_send_email.sendmail')->middleware('auth');
Route::get('ba_status/{id}', [SendMailController::class, 'ba_status'])->name('ba_status.sendmail')->middleware('auth');


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





// Recruitment Crew
Route::get('/recruitment_crew/regist', [RecruitmentController::class, 'recruitment_crew_regist']);
Route::get('/recruitment_crew', [RecruitmentController::class, 'index']);



// Set Type Tug and Barge
Route::get('/settype_tugbarge', [SetTypeTugBargeController::class, 'index'])->middleware('auth');
Route::get('/settype_tugbarge/json', [SetTypeTugBargeController::class, 'json'])->middleware('auth');
Route::get('/settype_tugbarge/data_db', [SetTypeTugBargeController::class, 'data_db'])->middleware('auth');
Route::get('/settype_tugbarge/data_db2', [SetTypeTugBargeController::class, 'data_db2'])->middleware('auth');




// REPORT VESSEL
Route::get('/scan_vessels', [ReportVesselController::class, 'index'])->middleware('auth');
// Route::get('/scan_vessels/scan', [BarcodeController::class, 'scan_vessels'])->middleware('auth');



// GET TUG BARGE FIXED ASSET
Route::match(['get', 'post'], '/scan_vessels_get_tugbarge_testing', [ReportVesselController::class, 'json_testing'])->middleware('auth');
Route::match(['get', 'post'], '/report_vessels_get_tug', [ReportVesselController::class, 'get_asset_tug_json'])->middleware('auth');
Route::match(['get', 'post'], '/get_barge', [ReportVesselController::class, 'get_barge'])->middleware('auth');
Route::match(['get', 'post'], '/report_vessels_get_barge', [ReportVesselController::class, 'get_asset_barge_json'])->middleware('auth');



Route::get('/ip', function () {
    $checkLocation = geoip()->getLocation($_SERVER['REMOTE_ADDR']);
    return $checkLocation->toArray();
});
// Route::get('/ip_details', function () {
//     $get_ip = UserSystemInfoHelper::get_ip();
//     $get_browser = UserSystemInfoHelper::get_browsers();
//     $get_device = UserSystemInfoHelper::get_device();
//     $get_os = UserSystemInfoHelper::get_os();
//     return $get_device;
// });

// ASSET CATEGORY
Route::get('asset_category', [AssetCategoryController::class, 'index'])->middleware('auth');
Route::get('/asset_category/json', [AssetCategoryController::class, 'json'])->middleware('auth');
Route::post('asset_category/store', [AssetCategoryController::class, 'store'])->name('asset_category.store')->middleware('auth');
Route::delete('asset_category/delete/{id}', [AssetCategoryController::class, 'delete'])->name('asset_category.delete')->middleware('auth');


// Mapping Asset Category
Route::match(['get', 'post'], 'map_ast_cat_view', [AssetCategoryController::class, 'map_ast_cat_view'])->name('map_ast_cat_view')->middleware('auth');
Route::get('getLocationJson/{id}', [AssetCategoryController::class, 'getLocationJson'])->name('getLocationJson')->middleware('auth');
Route::get('map_ast_cat_view_json', [AssetCategoryController::class, 'map_ast_cat_view_json'])->name('map_ast_cat_view_json')->middleware('auth');
Route::post('map_ast_cat_save', [AssetCategoryController::class, 'map_ast_cat_save'])->name('map_ast_cat_save')->middleware('auth');
Route::delete('map_ast_cat_delete/{id}', [AssetCategoryController::class, 'map_ast_cat_delete'])->name('map_ast_cat_delete')->middleware('auth');


Route::get('crew_report_data', [CrewController::class, 'index'])->name('crew_report_data')->middleware('auth');
Route::get('crew_report_json', [CrewController::class, 'json_report'])->name('crew_report_json')->middleware('auth');


// Form Asset Kategori Per Kapal
Route::match(['get', 'post'], 'form_asset_view', [FixedAssetController::class, 'form_asset_view'])->name('form_asset_view')->middleware('auth');
// Route::get('form_asset_view_json', [FixedAssetController::class, 'form_asset_view_json'])->name('form_asset_view_json')->middleware('auth');
// Route::get('get_mapping_assets_json', [FixedAssetController::class, 'get_mapping_assets_json'])->name('get_mapping_assets_json')->middleware('auth');


// LOG Trans Assets
Route::get('log_trans_asset_view', [FixedAssetController::class, 'log_trans_asset_view'])->name('log_trans_asset_view')->middleware('auth');
Route::get('log_trans_asset_json', [FixedAssetController::class, 'log_trans_asset_json'])->name('log_trans_asset_json')->middleware('auth');
