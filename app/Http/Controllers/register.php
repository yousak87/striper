<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator,
    Helper,
    Input,
    Redirect,
    Hash,
    Crypt,
    Mail,
    Auth,
    Session;

class register extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('auth/register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request) {
        $data = Input::all();
        $rules = array(
            'nama_lengkap' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'user_name' => 'required|unique:users',
            'nrp' => 'required|unique:users',
        );

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::to('register')->withErrors($validator)->withInput();
        }

        $cekUser = DB::table('users')->where('email', '=', $data['email'])->orWhere('nrp', $data['nrp'])->orWhere('user_name', $data['user_name'])->count();

        if ($cekUser > 0) {
            return Redirect::to('signup')->withErrors('User already exist please use another email or click forget password');
        }
        $data['password'] = Crypt::encrypt($data['password']);
        $data['date']=date("Y-m-d h:i:s");
        $ok = DB::table('users')->insert(
                [
                    'nama_lengkap' => $data['nama_lengkap'],
                    'email' => $data['email'],
                    'password' => $data['password'],
                    'user_name' => $data['user_name'],
                    'nrp' => $data['nrp'],
                    'jenis_karyawan' => $data['jenis_karyawan'],
                    'status_karyawan' => $data['status_karyawan'],
                    'level' => '1',
                    'created_at' => $data['date'],
                ]
        );

        if (!$ok) {
            return Redirect::to('signup')->withErrors('Fail to create user');
        }
        return Redirect::to('login')->with('status', 'Succes create user, you can login now ');
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
