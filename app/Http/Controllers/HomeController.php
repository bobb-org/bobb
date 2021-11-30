<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Realization;
use App\Models\Member;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $realizationList = Realization::all();
        //$realizationList =Member::select( Member::raw("SELECT r.id_realization, r.name, u.name FROM realizations as r, users as u, members as m WHERE m.id = 7 AND m.id_realization = r.id_realization AND m.id = u.id"));
        

        return view('home',["realizationList"=>$realizationList]);
    }

    public function create()
    {
        return view('homecreate');
    }

    public function store(Request $request)
    {
        $realization = new Realization;
        $realization->id = $request->input('id');
        $realization->name = $request->input('name');
        $realization->city = $request->input('city');
        $realization->street = $request->input('street');
        $realization->number = $request->input('number');
        $realization->save();

        return redirect()->action('HomeController@index');
    }

}
