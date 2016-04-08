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

class login extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view("auth/login");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function doLogin() {

        $data = Input::all();

        $rules = array(
            'email' => 'required',
            'password' => 'required'
        );

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::to('login')->withErrors($validator)->withInput();
        }

        $userdata = array(
            'email' => $data['email'],
            'password' => Crypt::encrypt($data['password']),
        );
        //dd($this->cekUser($userdata));
        // attempt to do the login
        switch ($this->cekUser($userdata)) {
            case '0' : return Redirect::to('login')->withErrors('error : account not found');
                break;
            case '2' : return Redirect::to('login')->withErrors('error : please active your account first to login');
                break;
            case '3' : return Redirect::to('login')->withErrors('error : combination email and password is not right');
                break;
            case '1' : return Redirect::to('userData');
                break;
            default : return Redirect::to('login')->withErrors('error : something wrong');
                break;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
     public function cekUser($userdata) {
        
        $cekUser = DB::table('users')->where('email', '=', $userdata['email'])->get();
        
        //dd(Crypt::decrypt($cekUser[0]->password) != Crypt::decrypt($userdata['password']));
        if (!$cekUser) {
            return '0';
        } elseif (Crypt::decrypt($cekUser[0]->password) != Crypt::decrypt($userdata['password'])) {
            echo '3';
        } else {
            Session::put('nama_lengkap', $cekUser[0]->nama_lengkap);
            Session::put('id_karyawan', $cekUser[0]->id);
            Session::put('email', $cekUser[0]->email);
            Session::put('token', $cekUser[0]->password);
            Session::put('password', $cekUser[0]->password);
            Session::put('join_date', date("M, Y", strtotime($cekUser[0]->created_at)));
            Session::put('level', $cekUser[0]->level);
            
            
            return '1';
        }
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
