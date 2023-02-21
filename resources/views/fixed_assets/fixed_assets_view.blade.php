@extends('layouts.main')

@section('title', 'Data Fixed Assets')

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


        <div class="page-wrapper">

				<!-- Page Content -->
                <div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Fixed Assets</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Administration</a></li>
									<li class="breadcrumb-item active">Fixed Assets</li>
									<li class="breadcrumb-item active">Assets</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
                                <a href="javascript:void(0)" class="btn add-btn" id="createNewAsset"><i class="fa fa-plus"></i> Add Asset</a>
							</div>
                            <div class="col-auto float-right ml-auto">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Import Fixed Assets</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#import_fixed_assets">Import</a>
                                        <a class="dropdown-item" href="#">Template Import Fixed Assets</a>
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Export Fixed Assets</button>
                                    <div class="dropdown-menu">
                                        {{-- <a class="dropdown-item" href="{{route('fixed_asset.export')}}">Export</a> --}}
                                        <a class="dropdown-item" href="#">Template Export Fixed Assets</a>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
					<!-- /Page Header -->

					<!-- Search Filter -->
					<div class="row filter-row">
						<div class="col-sm-6 col-md-3">
							<div class="form-group form-focus">
								<input type="text" class="form-control floating">
								<label class="focus-label">Employee Name</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group form-focus select-focus">
								<select class="select floating">
									<option value=""> -- Select -- </option>
									<option value="0"> Pending </option>
									<option value="1"> Approved </option>
									<option value="2"> Returned </option>
								</select>
								<label class="focus-label">Status</label>
							</div>
						</div>
						<div class="col-sm-12 col-md-4">
						   <div class="row">
							   <div class="col-md-6 col-sm-6">
									<div class="form-group form-focus">
										<div class="cal-icon">
											<input class="form-control floating datetimepicker" type="text">
										</div>
										<label class="focus-label">From</label>
									</div>
								</div>
							   <div class="col-md-6 col-sm-6">
									<div class="form-group form-focus">
										<div class="cal-icon">
											<input class="form-control floating datetimepicker" type="text">
										</div>
										<label class="focus-label">To</label>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-2">
							<a href="#" class="btn btn-secondary btn-block"> Search </a>
						</div>
                    </div>
					<!-- /Search Filter -->


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

                            @if (session()->has('failures'))
                            <div class="alert alert-danger" role="alert">
                                Fixed Assets Number (
                                @foreach (session()->get('failures') as $validasi)
                                    {{  $validasi->values()[$validasi->attribute()].',' }}
                                @endforeach
                                ) is Duplicate

                            </div>

                            @endif

							<div class="table-responsive">
								<table id="datatables" class="table table-striped custom-table mb-0 datatable yajradata">
									<thead>
										<tr>
                                            <th>Action</th>
											<th>#</th>
											<th class="text-center">Status</th>
											<th>Fixed Asset Number</th>
											<th>Fixed Asset Group</th>
											<th>Fixed Asset Description</th>
											<th>Site ID</th>
											<th>Site Name</th>
											<th>Acquisition Date</th>
											<th>Net Book Value</th>
											<th>Last Update</th>
											<th>PIC</th>
											<th>Remarks</th>
											<th class="text-center">QR Code</th>
											<th>Created at</th>
											<th>Updated at</th>
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

                <!-- Import Asset Modal -->
				<div id="import_fixed_assets" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-md" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Import Asset</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="{{ route('fixed_asset.import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="">Pilih File</label>
                                        <input type="file" class="form-control" name="file" required>
                                    </div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Import Asset Modal -->
            </div>


@include('fixed_assets.form')

@endsection


@section('under_body')
<script src="assets/js/jquery-3.5.1.min.js"></script>
{{-- <script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script> --}}
<script src="assets/js/select2.min.js"></script>
{{-- <script src="assets/js/jquery.slimscroll.min.js"></script> --}}
{{-- <script src="assets/js/bootstrap-datetimepicker.min.js"></script> --}}
<script>

    // GLOBAL SETUP
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready(function () {

        $('#datatables').DataTable({
            // dom: 'lBfrtip',
            // dom: 'Blfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'csv', 'print'
            ],
            processing: true,
            serverSide: true,
            ajax: "{{ url('/fixed_asset/json') }}",
            columns: [
                { data: 'action', name: 'action', searchable: false, sortable: false },
                {
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                { data: 'status', name: 'status' },
                { data: 'fixed_assets_number', name: 'fixed_assets_number' },
                { data: 'fixed_assets_group', name: 'fixed_assets_group'},
                { data: 'fixed_assets_description', name: 'fixed_assets_description' },
                { data: 'site_id', name: 'site_id' },
                { data: 'site_name', name: 'site_name' },
                { data: 'acquisition_date', name: 'acquisition_date' },
                { data: 'nbv', name: 'nbv' },
                { data: 'last_update', name: 'last_update' },
                { data: 'pic', name: 'pic' },
                { data: 'remarks', name: 'remarks' },
                { data: 'qr_code', name: 'qr_code', searchable: false, sortable: false  },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
            ]
        });
    });

    /*------------------------------------------
    --------------------------------------------
    Click to Edit Button
    --------------------------------------------
    --------------------------------------------*/
    // $.ajax({
    //     url: "{{url('scanner')}}",
    //     type: 'POST',
    //     data: {
    //         '_method': 'POST',
    //         // '_token' : csrf_token,
    //         'qr_code': code,
    //         },
    //         success:function(response){
    //             if(response.status_error){
    //                 Swal.fire({
    //                     icon : 'error',
    //                     type : 'error',
    //                     tittle : "Ooops....",
    //                     text : 'QR Code tidak terdaftar'
    //                 });
    //             }

    //             if(response.berhasil){
    //                 Swal.fire({
    //                 icon : 'success',
    //                 type : 'success',
    //                 // title : 'Success!',
    //                 title : response.number,
    //                 text : response.desc,
    //                         // text : 'Data Asset berhasil ditemukan',
    //                         imageUrl: 'assets/img/Fixed Assets/andromeda.jpg',
    //                         imageWidth: 400,
    //                         imageHeight: 200,
    //                         imageAlt: 'Custom image',
    //                         showCancelButton: true,
    //                         confirmButtonColor: '#3085d6',
    //                         cancelButtonColor: '#d33',
    //                         confirmButtonText: 'Yes, update it!',
    //                     }).then((result) => {
    //                         if (result.isConfirmed) {
    //                             $('#scanModal').modal('show');
    //                             // console.log(response.result);
    //                             $('#qrcode').val(code);
    //                             $('#fa_number').text(response.number);
    //                             $('#fa_desc').text(response.desc);
    //                             $("#status").val(response.status).attr('selected','selected');
    //                             var id = response.id
    //                             $('.submit-btn').click(function() {
    //                                 simpan(id);
    //                             });
    //                         }
    //                     });
    //                 }
    //             }
    //         });





</script>
@endsection
