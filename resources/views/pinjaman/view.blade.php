@extends('layouts.main')

@section('title', 'Data Pinjaman')

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
                        <h3 class="page-title">Pinjaman</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Transaction</a></li>
                            <li class="breadcrumb-item active">Filling Document</li>
                            <li class="breadcrumb-item active">Pinjaman</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">

                        {{-- <div class="btn-group">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_pengajuan"><i
                                    class="fa fa-plus"></i> Add Pinjaman</a>
                        </div> --}}

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
                    <div class="table-responsive">
                        <table id="datatables" class="table table-striped table-nowrap custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No</th>
                                    {{-- <th>ID</th> --}}
                                    <th>Kode Pinjaman</th>
                                    <th>Tgl Pinjaman</th>
                                    <th>Due Pengembalian</th>
                                    <th>Status</th>
                                    <th>Kode Referensi Pinjaman</th>
                                    <th>Keterangan</th>
                                    <th>Created Date</th>
                                    <th>Updated Date</th>
                                    <th>Nama Peminjam</th>
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


        <!-- Add Pengajuan Pinjaman Modal -->
        {{-- @include('Pinjaman.modal_add') --}}
        <!-- /Add Pengajuan Pinjaman Modal -->

    </div>
    <!-- /Page Wrapper -->


@endsection


@section('under_body')
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/select2.min.css">
    <script type="text/javascript">
        $(function() {
            // $(document).ready(function () {

            // SELECT2
            $('.selectDoc').select2({
                // placeholder: 'This is my placeholder',
                // allowClear: true
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
                ajax: "{{ url('pinjaman/json') }}",
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
                    // {
                    //     data: 'id',
                    //     name: 'id'
                    // },
                    {
                        data: 'kode_pinjaman',
                        name: 'kode_pinjaman'
                    },
                    {
                        data: 'tgl_pinjaman',
                        name: 'tgl_pinjaman'
                    },
                    {
                        data: 'tgl_pengembalian',
                        name: 'tgl_pengembalian'
                    },
                    {
                        data: 'status_pinjam',
                        name: 'status_pinjam'
                    },
                    {
                        data: 'kode_ref_perpanjangan',
                        name: 'kode_ref_perpanjangan'
                    },
                    {
                        data: 'ket_pinjaman',
                        name: 'ket_pinjaman'
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
                        data: 'user_id',
                        name: 'user_id'
                    },
                ]
            });

            /*------------------------------------------
            --------------------------------------------
            Delete Product Code
            --------------------------------------------
            --------------------------------------------*/
            // $('body').on('click', '.deleteDoc', function() {

            //     var pengpinj_id = $(this).data("id");
            //     var result = confirm("Are you sure to delete?");
            //     if (result) {
            //         $.ajax({
            //             type: "DELETE",
            //             url: "document/destroy/" + pengpinj_id,
            //             success: function(data) {
            //                 table.draw();
            //                 Swal.fire(
            //                     'Data Berhasil di Hapus!',
            //                     'You clicked the button!',
            //                     'success'
            //                 )
            //             },
            //             error: function(data) {
            //                 console.log('Error:', data);
            //             }
            //         });
            //     }
            // });
            // End Delete Product Code
        });
    </script>
@endsection
