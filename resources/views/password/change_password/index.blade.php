@extends('layouts.main')

@section('title', 'Change Password')

@section('content')
    @include('sweetalert::alert')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-6 offset-md-3">

                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Change Password</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('change_password_update', Auth::user()->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Personnel Number</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->personnel_number }}"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->username }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->email }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>New password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        {{-- <div class="form-group">
                            <label>Confirm password</label>
                            <input type="password" class="form-control">
                        </div> --}}
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->



@endsection
