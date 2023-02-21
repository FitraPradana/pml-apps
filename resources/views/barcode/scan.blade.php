@extends('layouts.main')

@section('title', 'Scanner')

@section('content')

<style>
    body {
        font-family: 'Nunito';
    }

    .center {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        flex: 1 0 100%;
    }
</style>


<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">

            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Scanner</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Apps</a></li>
                        <li class="breadcrumb-item active">Scan</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row staff-grid-row">
            <div class="col-md-6">
                <div class="profile-widget" style="">
                    <div id="reader" width="50px"></div>
                    <div class="col-12">
                        <input type="text" id="result">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    {{-- MODAL BARCODE SCAN --}}
    <div id="scanModal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Update Scan Barcode Asset</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <form action="{{ route('scanner.update') }}" method="post"> --}}
                    <form>
                        {{-- @csrf
                        @method('PUT') --}}
                        <div class="center">
                            {{-- <img id="img_barcode" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate('test')) !!} "> --}}

                            <img id="img_barcode" src="">
                        </div><br><br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fixed Asset Number</label>
                                    <input class="form-control" type="text" value="" id="fixed_assets_number" name="fixed_assets_number" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fixed Asset Group</label>
                                    <input class="form-control " type="text" value="" id="fixed_assets_group" name="fixed_assets_group" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Fixed Asset Name</label>
                                    <input class="form-control" type="text" value="" id="fixed_assets_name" name="fixed_assets_name" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- <div class="col-md-12">
                                <div class="profile-img-wrap edit-img">
                                    <img src="assets/img/Fixed Assets/andromeda.jpg">
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Qr Code</label>
                                    <input type="text" id="qrcode" class="form-control" value="">
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status <span class="text-danger">*</span></label>
                                    <select class="select" id="status_asset" required>
                                        <option value="general"> General </option>
                                        <option value="good"> GOOD </option>
                                        <option value="need"> Need Repair / Need Replacement</option>
                                        <option value="dont_exist"> Dont Exist</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reports To <span class="text-danger">*</span></label>
                                    <select class="select" id="pic" required>
                                        <option>-</option>
                                        <option>Wilmer Deluna</option>
                                        <option>Lesley Grauer</option>
                                        <option>Jeffery Lalor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Remarks <span class="text-danger">*</span></label>
                                    <textarea name="remarks_fixed_assets" id="remarks_fixed_assets" rows="3" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- END MODAL BARCODE SCAN --}}


</div>
<!-- /Page Wrapper -->
@endsection

@section('under_body')
{{-- <script src="assets/js/sweetalert2@11.js"></script>
<script src="assets/js/html5-qrcode.min.js"></script> --}}
    <script>
    // SELECT2
    $(document).ready(function() {
        $('#pic').select2({
            width: '300'
        });
    });


    // GLOBAL SETUP
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



        function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:
        // console.log(`Code matched = ${decodedText}`, decodedResult);
        $("#result").val(decodedText)

            var code = decodedText
            html5QrcodeScanner.clear()
            csrf_token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "{{url('scanner')}}",
                type: 'POST',
                data: {
                '_method': 'POST',
                '_token' : csrf_token,
                'qr_code': code,
                },
                success:function(response){

                    if(response.status_error){
                        Swal.fire({
                            icon : 'error',
                            type : 'error',
                            tittle : "Ooops....",
                            text : 'QR Code tidak terdaftar'
                        });
                    }

                    if(response.berhasil){
                        Swal.fire({
                            icon : 'success',
                            type : 'success',
                            // title : 'Success!',
                            title : response.number,
                            text : response.desc,
                            // text : 'Data Asset berhasil ditemukan',
                            imageUrl: 'assets/img/Fixed Assets/andromeda.jpg',
                            imageWidth: 400,
                            imageHeight: 200,
                            imageAlt: 'Custom image',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, update it!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#scanModal').modal('show');
                                // console.log(response.result);
                                $('#qrcode').val(code);
                                $('#fixed_assets_number').val(response.number);
                                $('#fixed_assets_group').val(response.group);
                                $('#fixed_assets_name').val(response.name);
                                $("#status_asset").val(response.status).attr('selected','selected');
                                var id = response.id
                                $('.submit-btn').click(function() {
                                    simpan(id);
                                });
                            }
                        });
                    }
                }
            });
        }



    // fungsi simpan dan update
    function simpan(id = '') {
        csrf_token = $('meta[name="csrf-token"]').attr('content');
        var var_url = 'scanner_update/' + id;
        var var_type = 'PUT';
        $.ajax({
            url: var_url,
            type: var_type,
            data: {
                // '_token' : csrf_token,
                remarks_fixed_assets: $('#remarks_fixed_assets').val(),
                status_asset: $('#status_asset').val(),
                pic: $('#pic').val()
            },
            success: function(response) {
                if (response.errors) {
                    console.log(response.errors);
                } else {
                    Swal.fire(
                        'Data Berhasil Update!',
                        'You clicked the button!',
                        'success'
                    )
                }

            }
        });
    }




        function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
        console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: {width: 250, height: 250} },
        /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endsection



