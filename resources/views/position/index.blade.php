@extends('layouts.main')

@section('title', 'Data Position')

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
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Position</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Master Administration</a></li>
                            <li class="breadcrumb-item active">Employees</li>
                            <li class="breadcrumb-item active">Positions</li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_position"><i
                                class="fa fa-plus"></i> Add Position</a>
                    </div>

                    <div class="col-auto float-right ml-auto">
                        {{-- <div class="btn-group">
                            <button type="button" class="btn btn-dark btn-rounded dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Import Room</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#import_room">Import</a>
                                <a class="dropdown-item" href="{{ route('room_import_template') }}">Template Import Room</a>
                            </div>
                        </div> --}}
                        {{-- <div class="btn-group">
                            <button type="button" class="btn btn-secondary btn-rounded dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Export Room</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('room.export') }}">Export</a>
                            </div>
                        </div> --}}
                    </div>

                </div>
            </div>
            <!-- /Page Header -->


            <div class="row">
                <div class="col-md-12">


                    @if (session()->has('failures'))
                        <div class="alert alert-danger" role="alert">
                            Room Code (
                            @foreach (session()->get('failures') as $validasi)
                                {{ $validasi->values()[$validasi->attribute()] . ',' }}
                            @endforeach
                            ) is duplicate. Data was not added to the website !
                        </div>
                    @endif

                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            <b>{{ session('success') }}</b>
                        </div>
                    @endif

                    @if (isset($errors) && $errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif


                    <div class="table-responsive">
                        <table id="datatables" class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>#</th>
                                    {{-- <th>ID Dept</th> --}}
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Remarks</th>
                                    <th>Department</th>
                                    <th>Created Date</th>
                                    <th>Updated Date</th>
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

        <!-- Import Room Modal -->
        {{-- @include('department.import_dept') --}}
        <!-- /Import Room Modal -->

        <!-- Add Location Modal -->
        @include('position.add_modal')
        <!-- /Add Location Modal -->


    </div>
    <!-- /Page Wrapper -->


@endsection



@section('under_body')

    <script type="text/javascript">
        $(function() {
            // $(document).ready(function () {

            // SELECT2
            $('#department_id').select2({
                width: '100%'
            });

            // GLOBAL SETUP
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            table = $('#datatables').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{ url('/position/json') }}",
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
                        data: 'position_code',
                        name: 'position_code'
                    },
                    {
                        data: 'position_name',
                        name: 'position_name'
                    },

                    {
                        data: 'remarks_position',
                        name: 'remarks_position'
                    },
                    {
                        data: 'department_id',
                        name: 'department_id'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                ],
                dom: 'Bfrtip',
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
                ],
                buttons: [
                    'pageLength',
                    {
                        "extend": "colvis",
                        "text": "Show/Hide Columns"
                    },
                    'copy', 'csv',
                    {
                        extend: "excel",
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'print'
                ],
            });
        });

        function deleteData(url) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        table.ajax.reload();
                        Swal.fire(
                            'has been successfully',
                            'deleted data from the website!',
                            'success'
                        )
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        }
    </script>

@endsection
