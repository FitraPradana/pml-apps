@extends('layouts.main')

@section('title', 'Data Document')

@section('content')

    <style>
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
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Document</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Administration</a></li>
                            <li class="breadcrumb-item active">Filling Document</li>
                            <li class="breadcrumb-item active">Document</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        {{-- <div class="btn-group">
                        <a href="{{ url('fixed_assets_stg_save') }}" onclick="return confirm ('Are you sure to Get Data From ERP?')" class="btn btn-info"><i class="fa fa-plus"></i> Generate Asset from ERP</a>
                    </div> --}}
                        <div class="btn-group">
                            <button type="button" class="btn btn-info btn-rounded dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Import</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#import_document">Import Document</a>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#update_document_status">Update Document Status / Compare Ekky</a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-md-12">
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session()->has('failures'))
                        <div class="alert alert-danger" role="alert">
                            Document (
                            @foreach (session()->get('failures') as $validasi)
                                {{ $validasi->values()[$validasi->attribute()] . ',' }}
                            @endforeach
                            ) is Duplicate
                        </div>
                    @endif
                    @if (session()->has('error_vendor_kosong'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error_vendor_kosong') }} <a href="{{ url('vendors_stg_index') }}"> Form Staging
                                Vendor >>>
                            </a>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="datatables" class="table table-striped table-nowrap custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>#</th>
                                    <th>Status</th>
                                    <th>Tanggal Posting</th>
                                    <th>Voucher</th>
                                    <th>Invoice</th>
                                    <th>Last Settle Voucher</th>
                                    <th>Last Settle Date</th>
                                    <th>Description</th>
                                    <th>Nominal</th>
                                    <th>Vendor</th>
                                    <th>Created Date</th>
                                    <th>Updated Date</th>
                                    <th>PIC</th>
                                    <th>Tgl Terima Document</th>
                                    <th>Lemari</th>
                                    <th>Lorong</th>
                                    <th>Baris</th>
                                    <th>Box</th>
                                    <th>No Folder</th>
                                    <th>Upload Document</th>
                                    <th>Kelengkapan Document</th>
                                    <th>Keterangan Document</th>
                                    {{-- <th>Net Book Value</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

        <!-- Import Document Modal -->
        @include('document.modal_import_document')
        <!-- /Import Document Modal -->

        <!-- Update Document Modal -->
        @include('document.modal_import_update_document_status')
        <!-- /Update Document Modal -->

    </div>
    <!-- /Page Wrapper -->


@endsection


@section('under_body')
    <script type="text/javascript">
        $(function() {
            // $(document).ready(function () {

            // SELECT2
            $('#room_id').select2({
                width: '250'
            });

            // GLOBAL SETUP
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            var table = $('#datatables').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{ url('document/json') }}",
                columns: [{
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        sortable: false
                    },
                    {
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'status_doc',
                        name: 'status_doc'
                    },
                    {
                        data: 'tgl_posting',
                        name: 'tgl_posting'
                    },
                    {
                        data: 'voucher',
                        name: 'voucher'
                    },
                    {
                        data: 'invoice',
                        name: 'invoice'
                    },
                    {
                        data: 'last_settle_voucher',
                        name: 'last_settle_voucher'
                    },
                    {
                        data: 'last_settle_date',
                        name: 'last_settle_date'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'nominal',
                        name: 'nominal'
                    },
                    {
                        data: 'vendor_id',
                        name: 'vendor_id'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'pic',
                        name: 'pic'
                    },
                    {
                        data: 'tgl_terima_doc',
                        name: 'tgl_terima_doc'
                    },
                    {
                        data: 'lemari',
                        name: 'lemari'
                    },
                    {
                        data: 'lorong',
                        name: 'lorong'
                    },
                    {
                        data: 'baris',
                        name: 'baris'
                    },
                    {
                        data: 'box',
                        name: 'box'
                    },
                    {
                        data: 'no_folder',
                        name: 'no_folder'
                    },
                    {
                        data: 'upload_doc',
                        name: 'upload_doc'
                    },
                    {
                        data: 'kelengkapan_doc',
                        name: 'kelengkapan_doc'
                    },
                    {
                        data: 'ket_doc',
                        name: 'ket_doc'
                    },
                ]
            });

            /*------------------------------------------
            --------------------------------------------
            Delete Product Code
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.deleteDoc', function() {

                var doc_id = $(this).data("id");
                var result = confirm("Are you sure to delete?");
                if (result) {
                    $.ajax({
                        type: "DELETE",
                        url: "document/destroy/" + doc_id,
                        success: function(data) {
                            table.draw();
                            Swal.fire(
                                'Data Berhasil di Hapus!',
                                'You clicked the button!',
                                'success'
                            )
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });
            // End Delete Product Code
        });
    </script>
@endsection
