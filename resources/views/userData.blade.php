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
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Hover Data Table</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

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
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->nama_lengkap}}</td>
                                    <td>{{$user->user_name}}</td>
                                    <td>{{$user->nrp}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status_karyawan}}</td>
                                    <td>{{$user->jenis_karyawan}}</td>
                                    <td><a href="{{ action('userData@editUser',$user->id) }}" class="btn btn-block btn-primary">Edit</a></td>
                                    <td><a href="{{ action('userData@deleteUser',$user->id) }}" class="btn btn-block btn-danger">Delete</a></td>

                                </tr>
                                @endforeach
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