<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Realization;
use App\Models\Account;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AccountController; //check perm

class RealizationController extends Controller
{
/* public function __construct() */
    /* { */
        /* $this->middleware('auth'); */
    /* } */

    public function show()
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $realizationList = Realization::all();
            return $realizationList->toJson();
        }
        else
            return response(401);
    }

    public function store(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $realization = new Realization;
            
            $realization->contract_id = $request->input('contract_id');
            $realization->start_date = $request->input('start_date');
            $realization->planned_end_date = $request->input('planned_end_date');
            $realization->supervisor = $request->input('supervisor');
            
            $realization->save();
            
            return redirect('/realization/show');
        }
        else
            return response(401);
    }

    public function update(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $realizationid=$request->input('id');
            
            $realization = Realization::find($realizationid);

            $realization->contract_id = $request->input('contract_id');
            $realization->start_date = $request->input('start_date');
            $realization->planned_end_date = $request->input('planned_end_date');
            $realization->supervisor = $request->input('supervisor');

            $realization->save();

            return redirect('/realization/show');
        }
        else
            return response(401);
    }

    public function delete(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $realizationid=$request->input('id');
            
            $realization = Realization::destroy($realizationid);

            return redirect('/realization/show');
        }
        else
            return response(401);
        
    }

    


}
