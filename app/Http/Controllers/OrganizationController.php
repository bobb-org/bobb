<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Organization;
use App\Http\Controllers\AccountController; //check perm

class OrganizationController extends Controller
{
/* public function __construct() */
    /* { */
        /* $this->middleware('auth'); */
    /* } */

    public function show()
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $orgList = Organization::all();

            #dd($orgList);

            return $orgList->toJson();
        }
        else
            return response(401);
    }

    public function store(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $org = new Organization;
            
            $org->name = $request->input('name');
            $org->contact = $request->input('contact');
            $org->email = $request->input('email');
            $org->adress = $request->input('adress');
            $org->post_code = $request->input('post_code');
            $org->city = $request->input('city');
            $org->nip = $request->input('nip');
            
            $org->save();
            
            return redirect('/organization/show');
        }
        else
            return response(401);
    }

    public function update(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $orgid=$request->input('id');
            
            $org = Organization::find($orgid);

            $org->name = $request->input('name');
            $org->contact = $request->input('contact');
            $org->email = $request->input('email');
            $org->adress = $request->input('adress');
            $org->post_code = $request->input('post_code');
            $org->city = $request->input('city');
            $org->nip = $request->input('nip');

            $org->save();

            return redirect('/organization/show');
        }
        else
            return response(401);
    }

    public function delete(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $orgid=$request->input('id');
            
            $org = Organization::destroy($orgid);

            return redirect('/organization/show');
        }
        else
            return response(401);
    }

}
