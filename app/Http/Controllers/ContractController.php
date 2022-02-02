<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contract;
use App\Http\Controllers\AccountController; //check perm

class ContractController extends Controller
{
/* public function __construct() */
    /* { */
        /* $this->middleware('auth'); */
    /* } */

    public function show()
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $contractList = Contract::all();
            return $contractList->toJson();
        }
        else
            return response(401);
    }

    public function store(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $contract = new Contract;
            
            $contract->name = $request->input('name');
            $contract->post_code = $request->input('post_code');
            $contract->city = $request->input('city');
            $contract->adress = $request->input('adress');
            $contract->general_contractor = $request->input('general_contractor');
            $contract->contractor = $request->input('contractor');
            
            $contract->save();
            
            return redirect('/contract/show');
        }
        else
            return response(401);    
    }

    public function update(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $contractid=$request->input('id');
            
            $contract = Contract::find($contractid);

            $contract->name = $request->input('name');
            $contract->post_code = $request->input('post_code');
            $contract->city = $request->input('city');
            $contract->adress = $request->input('adress');
            $contract->general_contractor = $request->input('general_contractor');
            $contract->contractor = $request->input('contractor');

            $contract->save();

            return redirect('/contract/show');
        }
        else
            return response(401);
    }

    public function delete(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $contractid=$request->input('id');
            
            $contract = Contract::destroy($contractid);

            return redirect('/contract/show');
        }
        else
            return response(401);
    }

}
