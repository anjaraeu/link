<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function show() {
        return view('admin');
    }

    public function login(Request $request) {
        if (Hash::check($request->input('password', false), env('ADMIN_PASSWORD'))) {
            session(['admin' => true]);
            return response()->json(['loggedin' => true]);
        } else {
            session(['admin' => false]);
            return response()->json(['loggedin' => false], 401);
        }
    }

}
