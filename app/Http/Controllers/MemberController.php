<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Realization;
use App\User;

class MemberController extends Controller
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
    public function index($id)
    {
        $memberList = Member::where('id',$id)->get();
        return view('member',["memberList"=>$memberList]);
    }
    public function creatememberforms($id_realization)
    {
        $userList = User::all();
        $realizationList = Realization::all();
        return view('memberadd',["realizationList"=>$realizationList, "userList"=>$userList,"id_realization"=>$id_realization]);
    }

    public function store(Request $request)
    {
        
        $member = new Member;
        $member->id = $request->input('id');
        $member->id_realization = $request->input('id_realization');
        
        $member->save();
        
        return redirect()->action('HomeController@index');
    }
}
