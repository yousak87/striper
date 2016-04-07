@extends('layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Tables
            <small>advanced tables</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">

            <div class="col-xs-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Hover Data Table</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
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

                        <form class="form-horizontal" role="form" method="POST" action="{{ action('userData@saveEditUser',$users->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

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
                                    <option value="1" <?= $users->status_karyawan="1"?"selected":""?>>Karyawan</option>
                                    <option value="2" <?= $users->status_karyawan="2"?"selected":""?>>Kontrak</option>
                                </select> 
                            </div>
                        </div>
                        <div class="form-group" id="div_jenis_karyawan">
                            <label class="col-md-4 control-label">Jenis Karyawan</label>
                            <div class="col-md-6">
                                <select name="jenis_karyawan" id="jenis_karyawan">
                                    <option value="1">Stripter</option>
                                    <option value="2">Repair Jig</option>
                                </select> 
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>User Name</th>
                                    <th>Nrp</th>
                                    <th>Email</th>
                                    <th>Status Karyawan</th>
                                    <th>Jenis Karyawan</th>
                                    <th>Edit/Delete</th>

                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>{{$users->nama_lengkap}}</td>
                                    <td>{{$users->user_name}}</td>
                                    <td>{{$users->nrp}}</td>
                                    <td>{{$users->email}}</td>
                                    <td>{{$users->status_karyawan}}</td>
                                    <td>{{$users->jenis_karyawan}}</td>
                                    <td><a href="{{ action('userData@editUser',$users->id) }}" class="btn btn-block btn-primary">Edit</a></td>
                                    <td><a href="{{ action('userData@deleteUser',$users->id) }}" class="btn btn-block btn-danger">Delete</a></td>

                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>User Name</th>
                                    <th>Nrp</th>
                                    <th>Email</th>
                                    <th>Status Karyawan</th>
                                    <th>Jenis Karyawan</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->


                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop