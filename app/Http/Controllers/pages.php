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
class pages extends Controller {

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
            return view("dashboard");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function logout() {
        Session::flush();
        return Redirect::to('login')->with('status', 'You already logout see you again nextime');
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
