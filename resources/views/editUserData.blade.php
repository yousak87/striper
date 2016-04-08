@extends('layout')
@section('content')

<script>
    $(document).ready(function () {
        $("#status_karyawan").change(function () {
            if ($("#status_karyawan").val() === '1') {
                $("#div_jenis_karyawan").show();
            } else {
                $("#div_jenis_karyawan").hide();

            }
        });
        if ($("#status_karyawan").val() === '2') {
            $("#div_jenis_karyawan").hide();
        }
    });
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">User Data</a></li>
            <li class="active">Edit User Data</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="login-logo">
                <a href="#"><b>Edit</b>User Data</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form class="form-horizontal" role="form" method="POST" action="{{ action('userData@saveEditUser')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <input type="hidden" name="id_karyawan" value="{{ $users->id }}">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Nama Lengkap</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="nama_lengkap" value="{{ $users->nama_lengkap}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">NRP</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="nrp" value="{{ $users->nrp }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">User Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="user_name" value="{{$users->user_name }}">
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-md-4 control-label">E-Mail</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="{{ $users->email }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Status Karyawan</label>
                        <div class="col-md-6">
                            <select name="status_karyawan" id="status_karyawan">
                                <option value="1" <?= $users->status_karyawan == "1" ? "selected" : "" ?>>Karyawan</option>
                                <option value="2" <?= $users->status_karyawan =="2" ? "selected" : "" ?>>Kontrak</option>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group" id="div_jenis_karyawan">
                        <label class="col-md-4 control-label">Jenis Karyawan</label>
                        <div class="col-md-6">
                            <select name="jenis_karyawan" id="jenis_karyawan">
                                <option value="" <?= $users->jenis_karyawan == "" ? "selected" : "" ?>>Pilih Jenis Karyawan</option>
                                <option value="1" <?= $users->jenis_karyawan == "1" ? "selected" : "" ?>>Stripter</option>
                                <option value="2" <?= $users->jenis_karyawan == "2" ? "selected" : "" ?>>Repair Jig</option>
                            </select> 
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Update Data
                            </button>
                        </div>
                    </div>
                </form>



            </div>
            <!-- /.login-box-body -->
        </div>

        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop