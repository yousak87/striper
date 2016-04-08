<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Validator,
    Helper,
    Input,
    Redirect,
    Hash,
    Crypt,
    Mail,
    Auth,
    Session;

class userData extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if (Session::get('token') == '') {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } elseif (Session::get('password') == '') {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } elseif (Session::get('token') != Session::get('password')) {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } else {
            $users = DB::table('users')->get();
            return view("userData", ['users' => $users]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editUser($id) {
        $users = DB::table('users')->where('id', '=', $id)->first();
        return view("editUserData", ['users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function saveEditUser() {
        $data = Input::all();
        $rules = array(
            'nama_lengkap' => 'required|max:255',
            'email' => 'required|email|max:255',
            'user_name' => 'required',
            'nrp' => 'required',
        );

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors('please insert all data');
        }

        $cekUser = DB::table('users')->where('id', '<>', $data['id_karyawan'])->Where('email', $data['email'])->count();

        if ($cekUser > 0) {
            return Redirect::back()->withErrors('email/nrp/user name already use by another users ,please use another email');
        }

        $cekUser = DB::table('users')->where('id', '<>', $data['id_karyawan'])->Where('nrp', $data['nrp'])->count();

        if ($cekUser > 0) {
            return Redirect::back()->withErrors('nrp already use by another users ,please use another email');
        }
        $cekUser = DB::table('users')->where('id', '<>', $data['id_karyawan'])->where('user_name', $data['user_name'])->count();

        if ($cekUser > 0) {
            return Redirect::back()->withErrors('user name already use by another users ,please use another email');
        }

        if ($data['status_karyawan'] == '1' && $data['jenis_karyawan'] == '') {
            return Redirect::back()->withErrors('please chose one of Jenis Karyawan if your Status Karyawan not Kontrak');
        }

        $data['date'] = date("Y-m-d h:i:s");
        $ok = DB::table('users')->where('id', '=', $data['id_karyawan'])->update(array(
            'nama_lengkap' => $data['nama_lengkap'],
            'email' => $data['email'],
            'user_name' => $data['user_name'],
            'nrp' => $data['nrp'],
            'jenis_karyawan' => $data['jenis_karyawan'],
            'status_karyawan' => $data['status_karyawan'],
            'level' => '1',
            'updated_at' => $data['date'],
                )
        );

        if (!$ok) {
            return Redirect::to('userData')->withErrors('Fail to create user');
        }
        return Redirect::to('userData')->with('status', 'Succes update user data ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function deleteUser($id) {
        $cekUser = DB::table('users')->where('id', '=', $id)->count();

        if ($cekUser > 0) {
            DB::table('users')->where('id', '=', $id)->delete();
            return Redirect::to('userData')->with('status', 'Succes update user data ');
        }
        return Redirect::to('userData')->withErrors('Error User Not Found');
        
    }

}
