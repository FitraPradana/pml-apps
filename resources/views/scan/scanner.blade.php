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
                            <li class="breadcrumb-item"><a href="#">Apps</a></li>
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
        @include('scan.modal_scan_update')
        {{-- END MODAL BARCODE SCAN --}}

    </div>
    <!-- /Page Wrapper -->

@endsection

@section('under_body')

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
                url: "{{ url('get_scan_qrcode') }}",
                type: 'POST',
                data: {
                    '_method': 'POST',
                    '_token': csrf_token,
                    'qr_code': code,
                },
                success: function(response) {

                    if (response.status_error) {
                        Swal.fire({
                            icon: 'error',
                            type: 'error',
                            tittle: "Ooops....",
                            text: 'QR Code tidak terdaftar'
                        });
                    }

                    if (response.berhasil) {
                        Swal.fire({
                            icon: 'success',
                            type: 'success',
                            tittle: "Mantap....",
                            text: 'Data Asset telah ditemukan !'
                        });
                        window.location.href = response.id;
                    }
                },
            });


        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>

@endsection
