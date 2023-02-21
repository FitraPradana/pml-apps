@extends('layouts.main')

@section('title', 'Data Vessel')

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
                    <h3 class="page-title">Vessel</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Master</a></li>
                        <li class="breadcrumb-item active">Vessel</li>
                    </ul>
                </div>
                <div class="btn-group">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_vessel"><i class="fa fa-plus"></i> Add Vessel</a>
                </div>
                <div class="col-auto float-right ml-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-dark btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Import Vessel</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#import_vessel">Import</a>
                            <a class="dropdown-item" href="#">Template Import Vessel</a>
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
                {{-- @if ($room->isEmpty())
                    <div class="alert alert-danger" role="alert">
                        Data Room Masih KOSONG !!! Harap di Input terlebih dahulu
                    </div>
                @endif --}}

                @if (session()->has('failures'))
                    <div class="alert alert-danger" role="alert">
                                Room Code (
                        @foreach (session()->get('failures') as $validasi)
                                    {{  $validasi->values()[$validasi->attribute()].',' }}
                        @endforeach
                                ) is Duplicate
                    </div>
                @endif

                @if (isset($errors) && $errors->any())
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                                        {{  $error }}
                        @endforeach
                    </div>
                @endif


                <div class="table-responsive">
                    <table id="datatables" class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>#</th>
                                <th>ID</th>
                                <th>ID Vessel</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Class</th>
                                <th>Remarks</th>
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

    <!-- Import Site Modal -->
    {{-- @include('site.import_site') --}}
    <!-- /Import Site Modal -->

    <!-- Add Site Modal -->
    {{-- @include('site.add_modal') --}}
    <!-- /Add Site Modal -->


</div>
<!-- /Page Wrapper -->
@endsection



@section('under_body')

<script type="text/javascript">

    $(function () {
    // $(document).ready(function () {

        // SELECT2
        // $('#room_id').select2({
        //     width: '250'
        // });

        $('#datatables').DataTable({
            processing: true,
            serverSide: true,
            destroy:    true,
            ajax: "{{ url('vessel/json') }}",
            columns: [
                { data: 'action', name: 'action', searchable: false, sortable: false },
                {
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                { data: 'id', name: 'id' },
                { data: 'vess_id', name: 'vess_id' },
                { data: 'vess_name', name: 'vess_name' },
                { data: 'vess_type', name: 'vess_type' },
                { data: 'vess_class', name: 'vess_class' },
                { data: 'vess_remarks', name: 'vess_remarks'},
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
            ]
        });
    });


</script>

@endsection
