<?php

namespace App\Http\Controllers;

use App\Models\AssetCategory;
use App\Models\Document;
use App\Models\Employee;
use App\Models\FixedAssets;
use App\Models\Location;
use App\Models\Room;
use App\Models\Site;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Vessel;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Continue_;

class APIErpController extends Controller
{
    //
    public function cek_api()
    {
        $inv = 'https://prod-10.southeastasia.logic.azure.com:443/workflows/f72beb54ca9d40c2bb2746c5cb7f4da7/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=zQPlwyEMDTO3AgRq21BNEtjNTUybKSo08_WxF47ZrZU';
        $client = new Client();
        $response = $client->request('GET', $inv);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);
        $collectdata = collect($data);

        dd($data);

        // $asset = FixedAssets::all();
        // foreach ($asset as $key => $value) {
        //     $v[] = $value->fixed_assets_number;
        // }
        // $filtered = $collectdata->whereNotIn('AssetId', $v);
        // dd($filtered->all());
    }


    // ===============================================================================================
    // ===============================================================================================
    // ===============================================================================================

    // Fixed Assets ================================================================================
    public function fixed_assets_stg_index()
    {
        return view('fixed_assets.view_staging');
    }



    public function fixed_assets_stg_json()
    {
        $api_fixed_assets = 'https://prod-19.southeastasia.logic.azure.com:443/workflows/dc06527840cd42e5930a2f8ffd5b001d/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=6UQg7E24Ln9yqEoCODwhPqNVEFNVP6dWQoiWN6c-jI4';
        $client = new Client();
        $response = $client->request('GET', $api_fixed_assets);
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);
        $collectdata = collect($data);

        $asset = FixedAssets::all();
        if ($asset->isEmpty()) {
            $filtered = $data;
        } else {
            foreach ($asset as $key => $value) {
                $v[] = $value->fixed_assets_number;
            }
            $filtered = $collectdata->whereNotIn('AssetId', $v);
        }
        return DataTables::of($filtered)
            // ->rawColumns([])
            ->make(true);
    }

    public function fixed_assets_stg_save()
    {
        // Validasi Table Site Kosong
        $site_valid = Site::all();
        if ($site_valid->isEmpty()) {
            return redirect('fixed_assets_stg_index')->with(['error_site_kosong' => 'Data Site masih KOSONG, Harap isi pada Form Site !']);
        }
        // END Validasi Table Site Kosong

        // Validasi Table Location Kosong
        $location_valid = Location::all();
        if ($location_valid->isEmpty()) {
            return redirect('fixed_assets_stg_index')->with(['error_location_kosong' => 'Data Location masih KOSONG, Harap isi pada Form Location !']);
        }
        // END Validasi Table Location Kosong


        // Validasi Table Asset Category Kosong
        $asset_category = AssetCategory::all();
        if ($asset_category->isEmpty()) {
            return redirect('fixed_assets_stg_index')->with(['error_asset_category_kosong' => 'Data Asset Category masih KOSONG, Harap isi pada Form Asset Category !']);
        }
        // END Validasi Table Asset Category Kosong



        $api_fixed_assets = 'https://prod-19.southeastasia.logic.azure.com:443/workflows/dc06527840cd42e5930a2f8ffd5b001d/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=6UQg7E24Ln9yqEoCODwhPqNVEFNVP6dWQoiWN6c-jI4';
        $client = new Client();
        $response = $client->request('GET', $api_fixed_assets);
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);
        $collectdata = collect($data);

        // return $collectdata;

        $asset = FixedAssets::all();
        if ($asset->isEmpty()) {
            $filtered = $data;
        } else {
            foreach ($asset as $key => $value) {
                $v[] = $value->fixed_assets_number;
            }
            $filtered = $collectdata->whereNotIn('AssetId', $v);
        }

        foreach ($filtered as $value) {
            $qrcode = Str::random(20);
            $vessId = $value['KREVesselId'];
            $location_id_gnrl = Location::where('location_code', 'GNRL')->first();
            $asset_category_id_gnrl = AssetCategory::where('asset_category_code', 'GNRL')->first();

            // $site_gnrl = Site::where('id','')->first();
            // if($value['KREVesselId'] == '' || $value['KREVesselId'] == null)
            // {
            //     $inputVessel = $site_gnrl->id;
            // }

            // $siteValue = Site::where('site_code', $vessId)->first();
            // if($value['KREVesselId'] != '' || $value['KREVesselId'] != null)
            // {
            //     $inputVessel = $siteValue->id;
            // }

            FixedAssets::create([
                'fixed_assets_number'   => $value['AssetId'],
                'fixed_assets_name'     => $value['Name'],
                'fixed_assets_group'    => $value['AssetGroup'],
                'main_fixed_assets'     => $value['MainAssetId'],
                'information3'          => $value['MaintenanceInfo3'],
                'vessel_id'             => $value['KREVesselId'],
                'acquisition_date'      => Carbon::parse($value['AcquisitionDate']),
                // 'net_book_value'        => $value['net_book_value'],
                'status_asset'          => 'general',
                // 'last_update_stock_take_date' => '',
                // 'pic'                   => $value['pic'],
                // 'remarks_fixed_assets'  => $value['remarks_fixed_assets'],
                'qr_code'               => url('scan_edit_form', $value['AssetId']),
                // 'qr_code'               => $qrcode,
                // 'last_modified_name' => '',
                // 'location_id'               => $location_id_gnrl->id,
                // 'asset_category_id'               => $asset_category_id_gnrl->id,
            ]);
        }

        return redirect('fixed_assets')->with(['success' => 'Data Fixed Asset Berhasil Di Generate from ERP !']);
    }






    // Filling Document ================================================================================
    public function doc_stg_index()
    {
        return view('document.view_staging');
    }

    public function doc_stg_json()
    {
        //
        $api_doc = 'https://prod-60.southeastasia.logic.azure.com:443/workflows/22489788604d488294d41a0ef460855d/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=q7ZOP9chFOnQ3I99TqgtQFcV2vqV85RifmREO8mXONs';
        $client = new Client();
        $response = $client->request('GET', $api_doc);
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);
        $collectdata = collect($data);

        // dd($collectdata);

        $doc = Document::all();
        if ($doc->isEmpty()) {
            $filtered = $collectdata;
        } else {
            foreach ($doc as $key => $value) {
                $v[] = $value->voucher;
            }
            $filtered = $collectdata->whereNotIn('Voucher', $v);
        }


        return DataTables::of($filtered)
            // ->addColumn('tgl_posting', function($data){
            //     return $data->TransDate->format('d M Y H:i:s');
            // })
            ->make(true);
    }

    public function doc_stg_save()
    {
        // Validasi Table Vendor Kosong
        $vendor = Vendor::all();
        if ($vendor->isEmpty()) {
            return redirect('doc_stg_index')->with(['error_vendor_kosong' => 'Data Vendor masih KOSONG, Harap isi pada Form Vendor !']);
        }
        // END Validasi Table Vendor Kosong

        $api_doc = 'https://prod-60.southeastasia.logic.azure.com:443/workflows/22489788604d488294d41a0ef460855d/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=q7ZOP9chFOnQ3I99TqgtQFcV2vqV85RifmREO8mXONs';
        $client = new Client();
        $response = $client->request('GET', $api_doc);
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);
        $collectdata = collect($data);

        $doc = Document::all();
        if ($doc->isEmpty()) {
            $filtered = $collectdata;
        } else {
            foreach ($doc as $key => $value) {
                $v[] = $value->voucher;
            }
            $filtered = $collectdata->whereNotIn('Voucher', $v);
        }

        foreach ($filtered as $key => $value) {

            $vend = Vendor::where('accountnum', $value['AccountNum'])->first();

            Document::create([
                'tgl_posting'           => Carbon::parse($value['TransDate']),
                'voucher'               => $value['Voucher'],
                'last_settle_voucher'   => $value['LastSettleVoucher'],
                'last_settle_date'      => Carbon::parse($value['LastSettleDate']),
                'description'           => $value['Txt'],
                'nominal'               => $value['AmountCur'],
                'vendor_id'             => $vend->id,

            ]);
        }
        return redirect('documents')->with(['success' => 'Data Document Berhasil Di Generate from ERP !']);
    }


    // =======================================================================================
    // Employee ================================================================================
    public function employees_stg_index()
    {
        return view('employee.view_staging');
    }

    public function employees_stg_json()
    {
        //
        $api_emp = 'https://prod-14.southeastasia.logic.azure.com:443/workflows/fe8a1201c18d439f9d6730697b58ddf7/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=xGvURR69AcshnEafSrk7PvciEzi30HdoabCvrajTd7U';
        $client = new Client();
        $response = $client->request('GET', $api_emp);
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);
        $collectdata = collect($data);
        $query = $collectdata->all();
        // dd($collectdata);

        $emp = Employee::all();
        if ($emp->isEmpty()) {
            $filtered = $collectdata;
        } else {
            foreach ($emp as $key => $value) {
                $v[] = $value->emp_accountnum;
            }
            $filtered = $collectdata->whereNotIn('PersonnelNumber', $v);
        }


        return DataTables::of($filtered)
            ->make(true);
    }

    public function employees_stg_save()
    {
        //
        $api_emp = 'https://prod-14.southeastasia.logic.azure.com:443/workflows/fe8a1201c18d439f9d6730697b58ddf7/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=xGvURR69AcshnEafSrk7PvciEzi30HdoabCvrajTd7U';
        $client = new Client();
        $response = $client->request('GET', $api_emp);
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);
        $collectdata = collect($data);
        $query = $collectdata->all();

        // dd($collectdata);
        // return $collectdata;

        $emp = Employee::all();
        if ($emp->isEmpty()) {
            $filtered = $collectdata;
        } else {
            foreach ($emp as $key => $value) {
                $v[] = $value->emp_accountnum;
            }
            $filtered = $collectdata->whereNotIn('PersonnelNumber', $v);
        }

        DB::beginTransaction();
        try {

            // Create Employee
            foreach ($filtered as $key => $value) {
                $insert_emp = Employee::create([
                    'emp_accountnum'        => $value['PersonnelNumber'],
                    'emp_name'              => $value['Name'],
                    'emp_email'             => $value['PrimaryContactEmail'],
                    'emp_phone'             => $value['PrimaryContactPhone'],
                    'emp_address'           => '',
                    'emp_remarks'           => '',
                    // 'department_id'         => '',
                    // 'user_id'             => '1',
                ]);
            }
            // return $insert_emp;
            // END Create Employee

            // CEK DATA EMPLOYEE
            $emp_cek = Employee::all();
            if ($emp->isEmpty()) {
                $filtered_emp = $emp_cek;
            } else {
                foreach ($emp as $key => $value) {
                    $v[] = $value->emp_accountnum;
                }
                $filtered_emp = $emp_cek->whereNotIn('emp_accountnum', $v);
            }
            // return $filtered_emp;
            // CREATE USER ACCOUNT EMPLOYEE
            foreach ($filtered_emp as $key => $val) {
                User::create([
                    'personnel_number'  => $val['emp_accountnum'],
                    'username'          => $val['emp_accountnum'],
                    'full_name'         => $val['emp_name'],
                    'email'             => $val['emp_email'] . '@pml.co.id',
                    'password'          => Hash::make('PML@2023'),
                    'type'              => 'employee',
                    'roles'             => 'user',
                    'remarks_user'      => '',
                ]);
            }
            // END CREATE USER ACCOUNT EMPLOYEE

            DB::commit();
            return redirect('employees')->with(['success' => 'Data Employee Berhasil Di Generate from ERP !']);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
            // return redirect('employees_stg_index')->with(['error' => 'Data Employee Gagal Di Generate from ERP !']);
        }
    }


    // =======================================================================================
    // Customer ================================================================================
    public function customers_stg_index()
    {
        return view('customer.view_staging');
    }

    public function customers_stg_json()
    {
        //
        $api_cust = 'https://prod-16.southeastasia.logic.azure.com:443/workflows/8d188355816249488951f83cb8acd90e/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=QSL1ISgrZMmJPjGWlGoF2Kh-rlveAGgwH7RCu1219TA';
        $client = new Client();
        $response = $client->request('GET', $api_cust);
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);
        $collectdata = collect($data);
        $query = $collectdata->all();
        // dd($collectdata);

        // $doc = Document::all();
        // if($doc->isEmpty())
        // {
        //     $filtered = $collectdata;
        // }else{
        //     foreach ($doc as $key => $value) {
        //         $v[] = $value->voucher;
        //     }
        //     $filtered = $collectdata->whereNotIn('Voucher', $v);
        // }


        return DataTables::of($query)
            ->make(true);
    }

    public function customers_stg_save()
    {
        //
    }


    // =======================================================================================
    // Vendor ================================================================================
    public function vendors_stg_index()
    {
        return view('vendor.view_staging');
    }

    public function vendors_stg_json()
    {
        //
        // $data = APP[env]

        $api_vend = 'https://prod-06.southeastasia.logic.azure.com:443/workflows/4d4b85f077664ffa9a8d1206dbacad4e/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=NYpQ-_Q6h9e3R_ZRbue7s9PwFPDaLFsknmXHCyOdblg';
        $client = new Client();
        $response = $client->request('GET', $api_vend);
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);
        $collectdata = collect($data);
        $query = $collectdata->all();
        // dd($collectdata);

        $vend = Vendor::all();
        if ($vend->isEmpty()) {
            $filtered = $collectdata;
        } else {
            foreach ($vend as $key => $value) {
                $v[] = $value->accountnum;
            }
            $filtered = $collectdata->whereNotIn('VendorAccountNumber', $v);
        }


        return DataTables::of($filtered)
            ->make(true);
    }

    public function vendors_stg_save()
    {
        //

        $api_vend = 'https://prod-06.southeastasia.logic.azure.com:443/workflows/4d4b85f077664ffa9a8d1206dbacad4e/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=NYpQ-_Q6h9e3R_ZRbue7s9PwFPDaLFsknmXHCyOdblg';
        $client = new Client();
        $response = $client->request('GET', $api_vend);
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);
        $collectdata = collect($data);
        $query = $collectdata->all();

        $vend = Vendor::all();
        if ($vend->isEmpty()) {
            $filtered = $collectdata;
        } else {
            foreach ($vend as $key => $value) {
                $v[] = $value->accountnum;
            }
            $filtered = $collectdata->whereNotIn('VendorAccountNumber', $v);
        }


        foreach ($filtered as $value) {

            Vendor::create([
                'accountnum'            => $value['VendorAccountNumber'],
                'search_name'           => $value['VendorSearchName'],
                'vend_name'             => $value['VendorName'],
                'vend_address'          => $value['FormattedPrimaryAddress'],
                'vend_phone'            => $value['PrimaryPhoneNumber'],
                'vend_remarks'          => '',
            ]);
        }
        return redirect('vendors')->with(['success' => 'Data Vendor Berhasil Di Generate from ERP !']);
    }


    // =======================================================================================
    // Site ================================================================================
    public function sites_stg_index()
    {
        return view('site.view_staging');
    }

    public function sites_stg_json()
    {
        //
        $api_site = 'https://prod-23.southeastasia.logic.azure.com:443/workflows/d648c07e19444d92932448be4cfbee84/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=rq_uNUJTpWypp7ZdZVdBqTajKk5lECXBNlgAJT2-B3g';
        $client = new Client();
        $response = $client->request('GET', $api_site);
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);
        $collectdata = collect($data);
        $query = $collectdata->all();
        // dd($collectdata);

        $site = Site::all();
        if ($site->isEmpty()) {
            $filtered = $collectdata;
            $vessIdNotNull = $collectdata->where('VesselId', '!=', null);
            $cabang = $filtered->whereIn('SiteId', ['BJM', 'JKT', 'GNRL', '76872800', '76872801', '76872858', '76872893']);
            $union = $vessIdNotNull->union($cabang);
            // $vessIdnull = $collectdata->where('SiteId', 'like', '7%');
            // $unionALL = $union->union($vessIdnull);
        } else {
            foreach ($site as $key => $value) {
                $v[] = $value->site_code;
            }
            $filtered = $collectdata->whereNotIn('SiteId', $v);
            $vessIdNotNull = $filtered->where('VesselId', '!=', null);
            $cabang = $filtered->whereIn('SiteId', ['BJM', 'JKT', 'GNRL', '76872800', '76872801', '76872858', '76872893']);
            $union = $vessIdNotNull->union($cabang);
            // $vessIdnull = $collectdata->where('SiteId', 'like', '7%');
            // $unionALL = $union->union($vessIdnull);
        }
        // return $vessIdnull;

        return DataTables::of($union)
            ->make(true);
    }

    public function sites_stg_save()
    {
        // Validasi Table Room Kosong
        $room_valid = Room::all();
        if ($room_valid->isEmpty()) {
            return redirect('sites_stg_index')->with(['error_room_kosong' => 'Data ROOM masih KOSONG, Harap isi pada Form ROOM !']);
        }
        // END Validasi Table Room Kosong

        // Validasi Table Vessel Kosong
        $vessel_valid = Vessel::all();
        if ($vessel_valid->isEmpty()) {
            return redirect('sites_stg_index')->with(['error_vessel_kosong' => 'Data Vessel masih KOSONG, Harap isi pada Form ROOM !']);
        }
        // END Validasi Table Vessel Kosong

        //
        $api_site = 'https://prod-23.southeastasia.logic.azure.com:443/workflows/d648c07e19444d92932448be4cfbee84/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=rq_uNUJTpWypp7ZdZVdBqTajKk5lECXBNlgAJT2-B3g';
        $client = new Client();
        $response = $client->request('GET', $api_site);
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);
        $collectdata = collect($data);

        $site = Site::all();
        if ($site->isEmpty()) {
            $filtered = $collectdata;
            $vessIdNotNull = $collectdata->where('VesselId', '!=', null);
            $cabang = $filtered->whereIn('SiteId', ['BJM', 'JKT', 'GNRL', '76872800', '76872801', '76872858', '76872893']);
            $vessIdnull = $collectdata->where('SiteId', 'LIKE', "7%");
            $union = $vessIdNotNull->union($cabang);
        } else {
            foreach ($site as $value) {
                $v[] = $value->site_code;
            }
            $filtered = $collectdata->whereNotIn('SiteId', $v);
            $vessIdNotNull = $collectdata->where('VesselId', '!=', null);
            $cabang = $filtered->whereIn('SiteId', ['BJM', 'JKT', 'GNRL', '76872800', '76872801', '76872858', '76872893']);
            $vessIdnull = $collectdata->where('SiteId', 'LIKE', '76872%')->values()->all();
            $union = $vessIdNotNull->union($cabang);
        }

        // return $filtered;
        // return !$vessIdNotNull;
        foreach ($vessIdNotNull as $key => $v) {
            $select_param[] = $v;
            $siteId_param[] = $v['SiteId'];
            $vessId_param[] = $v['VesselId'];
        }
        // return $vessId_param;

        // Begin Transaction
        DB::beginTransaction();

        try {
            // if ($vessId_param !== null) {
            foreach ($vessIdNotNull as $key => $value) {
                $vessel_parm = Vessel::where('vess_id', $value['VesselId'])->first();
                // return $vessel_parm;
                Site::create([
                    'site_code'             => $value['SiteId'],
                    'site_name'             => $value['Name'],
                    'remarks_site'          => '',
                    'vessel_id'            => $vessel_parm->id,
                ]);
            }
            // }

            // if ($vessId_param == '') {
            foreach ($cabang as $key => $value) {
                Site::create([
                    'site_code'             => $value['SiteId'],
                    'site_name'             => $value['Name'],
                    'remarks_site'          => 'SITE PML',
                    // 'vessel_id'            => '',
                ]);
            }
            // }

            // Commit Transaction
            DB::commit();
        } catch (\Throwable $th) {
            // Rollback Transaction
            DB::rollback();
            throw $th;
        }

        return redirect('sites')->with(['success' => 'Data Site Berhasil Di Generate from ERP !']);
    }

    // =======================================================================================
    // Vessel ================================================================================
    public function vessels_stg_index()
    {
        return view('vessel.view_staging');
    }

    public function vessels_stg_json()
    {
        //
        $api_vessel = 'https://prod-28.southeastasia.logic.azure.com:443/workflows/c67e6de598a040cab1d14c57855986f6/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=qbpMoMidRY8WUWAf5yfmkIRDXQ4FVBgj0AkxLa5hjfs';
        $client = new Client();
        $response = $client->request('GET', $api_vessel);
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);
        $collectdata = collect($data);
        $query = $collectdata->all();

        // dd($collectdata);
        // return $collectdata;
        $vess = Vessel::all();
        if ($vess->isEmpty()) {
            $filtered = $collectdata;
        } else {
            foreach ($vess as $key => $value) {
                $v[] = $value->vess_id;
            }
            $filtered = $collectdata->whereNotIn('VessID', $v);
        }


        return DataTables::of($filtered)
            ->make(true);
    }

    public function vessels_stg_save()
    {
        //
        $api_vessel = 'https://prod-28.southeastasia.logic.azure.com:443/workflows/c67e6de598a040cab1d14c57855986f6/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=qbpMoMidRY8WUWAf5yfmkIRDXQ4FVBgj0AkxLa5hjfs';
        $client = new Client();
        $response = $client->request('GET', $api_vessel);
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);
        $collectdata = collect($data);
        // return $collectdata;
        $vess = Vessel::all();
        if ($vess->isEmpty()) {
            $filtered = $collectdata;
            $filter_tug = $filtered->where('VessType', '=', 'TUG');
        } else {
            foreach ($vess as $key => $value) {
                $v[] = $value->vess_id;
            }
            $filtered = $collectdata->whereNotIn('VessID', $v);
            $filter_tug = $filtered->where('VessType', '=', 'TUG');
        }

        // $filter_tug[] = $filtered->where('VessType', '=', 'TUG');
        // return $filter_tug;

        // Begin Transaction
        DB::beginTransaction();

        try {
            foreach ($filtered as $value) {
                // $vesstype[] = $value['VessType'];

                Vessel::create([
                    'vess_id'               => $value['VessID'],
                    'vess_name'             => $value['VessName'],
                    'vess_type'             => $value['VessType'],
                    'vess_class'            => $value['VessClassID'],
                    'vess_remarks'          => '',
                ]);
            }


            // CREATE USER ACCOUNT VESSEL TUG
            foreach ($filter_tug as $value) {
                // $vesstype[] = $value['VessType'];

                User::create([
                    'personnel_number'  => $value['SiteId'],
                    'username'          => $value['VessID'],
                    'full_name'         => $value['VessName'],
                    'email'             => $value['VessID'] . '@pml.co.id',
                    'password'          => Hash::make('PML@2023'),
                    'type'              => 'vessel',
                    'roles'             => 'vessel',
                    'remarks_user'      => '',
                ]);
            }
            // END CREATE USER ACCOUNT VESSEL TUG

            // Commit Transaction
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            // Rollback Transaction
            DB::rollback();
        }

        return redirect('vessels')->with(['success' => 'Data Vessel Berhasil Di Generate from ERP !']);
    }
}
