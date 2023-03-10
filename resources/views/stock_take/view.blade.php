@extends('layouts.main')

@section('title', 'Data Stock Take')

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
                    <h3 class="page-title">Stock Take</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Stock Take</li>
                    </ul>
                </div>
                {{-- <div class="btn-group">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_site"><i class="fa fa-plus"></i> Add Site</a>
                </div> --}}

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
                                <th>Tanggal</th>
                                <th>Fixed Assets</th>
                                <th>Status Asset</th>
                                <th>Remarks Stock Take</th>
                                <th>Last Image Condition</th>
                                <th>Last Update Name</th>
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

        // $('#datatables').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     destroy:    true,
        //     ajax: "{{ url('/site/json') }}",
        //     columns: [
        //         { data: 'action', name: 'action', searchable: false, sortable: false },
        //         {
        //             render: function (data, type, row, meta) {
        //                 return meta.row + meta.settings._iDisplayStart + 1;
        //             },
        //         },
        //         { data: 'id', name: 'id' },
        //         { data: 'site_code', name: 'site_code' },
        //         { data: 'site_name', name: 'site_name' },
        //         // { data: 'vessel_id', name: 'vessel_id' },
        //         { data: 'remarks_site', name: 'remarks_site'},
        //         { data: 'created_at', name: 'created_at' },
        //         { data: 'updated_at', name: 'updated_at' },
        //     ]
        // });
    });


</script>

@endsection
