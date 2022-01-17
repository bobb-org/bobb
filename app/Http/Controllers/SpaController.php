<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpaController extends Controller
{
	/* public function __construct() */
    /* { */
        /* $this->middleware('auth'); */
    /* } */

    public function index()
    {
        return view('spa', ['auth_user' => Auth::user()]);
    }
}

