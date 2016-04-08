@extends('app')

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
        if ($("#status_karyawan").val() === '1') {
            $("#div_jenis_karyawan").show();
        } else {
            $("#div_jenis_karyawan").hide();

        }
    });
</script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
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

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('register') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Nama Lengkap</label>
                            <div class="col-md-6">
                                <input type="text" autofocus class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">NRP</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="nrp" value="{{ old('nrp') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">User Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="user_name" value="{{ old('user_name') }}">
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Status Karyawan</label>
                            <div class="col-md-6">
                                <select name="status_karyawan" id="status_karyawan">
                                    <option value="1">Karyawan</option>
                                    <option value="2">Kontrak</option>
                                </select> 
                            </div>
                        </div>
                        <div class="form-group" id="div_jenis_karyawan">
                            <label class="col-md-4 control-label">Jenis Karyawan</label>
                            <div class="col-md-6">
                                <select name="jenis_karyawan" id="jenis_karyawan">
                                    <option value="">Pilih Jenis Karyawan</option>
                                    <option value="1">Stripter</option>
                                    <option value="2">Repair Jig</option>
                                </select> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Ulangi Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
