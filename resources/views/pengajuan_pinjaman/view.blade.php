@extends('layouts.main')

@section('title', 'Data Pengajuan Pinjaman')

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
                        <h3 class="page-title">Pengajuan Pinjaman</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Transaction</a></li>
                            <li class="breadcrumb-item active">Filling Document</li>
                            <li class="breadcrumb-item active">Pengajuan Pinjaman</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">

                        <div class="btn-group">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_pengajuan"><i
                                    class="fa fa-plus"></i> Add Pengajuan</a>
                        </div>
                        {{-- <div class="btn-group">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_custom_policy"><i
                                    class="fa fa-plus"></i> Add Pengajuan Custom</a>
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
                                    <th>User</th>
                                    <th>Kode Pengajuan</th>
                                    <th>Tgl Pengajuan</th>
                                    <th>Keterangan</th>
                                    <th>Created Date</th>
                                    <th>Updated Date</th>
                                    <th>Approval Status</th>
                                    <th>Approval Name</th>
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
        @include('pengajuan_pinjaman.modal_add')
        <!-- /Add Pengajuan Pinjaman Modal -->

        <!-- Add Document Custom Modal -->
        @include('pengajuan_pinjaman.modal_add_custom')
        <!-- /Add Document Custom Modal -->

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
                ajax: "{{ url('pengajuan_pinjaman/json') }}",
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
                        data: 'user_id',
                        name: 'user_id'
                    },
                    {
                        data: 'kode_pengajuan_pinjaman',
                        name: 'kode_pengajuan_pinjaman'
                    },
                    {
                        data: 'tgl_pengajuan_pinjaman',
                        name: 'tgl_pengajuan_pinjaman'
                    },
                    {
                        data: 'ket_pengajuan_pinjaman',
                        name: 'ket_pengajuan_pinjaman'
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
                        data: 'approval_status',
                        name: 'approval_status'
                    },
                    {
                        data: 'approval_name',
                        name: 'approval_name'
                    },

                ]
            });

            /*------------------------------------------
            --------------------------------------------
            Delete Product Code
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.deleteDoc', function() {

                var pengpinj_id = $(this).data("id");
                var result = confirm("Are you sure to delete?");
                if (result) {
                    $.ajax({
                        type: "DELETE",
                        url: "document/destroy/" + pengpinj_id,
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
