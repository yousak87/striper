<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator,
    Helper,
    Input,
    Redirect,
    Hash,
    Crypt,
    Mail,
    Auth,
    DB,
    Session;

class userProfile extends Controller {

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
            $users = DB::table('users')->where('id', '=', Session::get('id_karyawan'))->first();

            return view("userProfile", ['users' => $users]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function editSave() {

        $file = array('image' => Input::file('avatar'));
        $fileName = '';
        if ($file['image'] != "") {
            $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
// doing the validation, passing post data, rules and the messages
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                return Redirect::back()->withErrors('please insert image only');
            } else {

// checking file is valid.
                if (Input::file('avatar')->isValid()) {
                    $destinationPath = 'uploads'; // upload path
                    $extension = Input::file('avatar')->getClientOriginalExtension(); // getting image extension
                    $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
                    Input::file('avatar')->move($destinationPath, $fileName); // uploading file to given path
// sending back with message
                }
            }
        }

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
        if ($fileName !== "") {
            $ok = DB::table('users')->where('id', '=', $data['id_karyawan'])->update(array(
                'nama_lengkap' => $data['nama_lengkap'],
                'email' => $data['email'],
                'user_name' => $data['user_name'],
                'nrp' => $data['nrp'],
                'jenis_karyawan' => $data['jenis_karyawan'],
                'status_karyawan' => $data['status_karyawan'],               
                'gambar' => $fileName,
                'updated_at' => $data['date'],
                    )
            );
            Session::put('gambar', $fileName);
        } else {
            $ok = DB::table('users')->where('id', '=', $data['id_karyawan'])->update(array(
                'nama_lengkap' => $data['nama_lengkap'],
                'email' => $data['email'],
                'user_name' => $data['user_name'],
                'nrp' => $data['nrp'],
                'jenis_karyawan' => $data['jenis_karyawan'],
                'status_karyawan' => $data['status_karyawan'],
                'updated_at' => $data['date'],
                    )
            );
        }

        if (!$ok) {
            return Redirect::to('profile')->withErrors('Fail to edit profile');
        }
        Session::put('nama_lengkap', $data['nama_lengkap']);

        return Redirect::to('profile')->with('status', 'Succes update profile ');
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
    public function edit($id) {
//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
//
    }

}
