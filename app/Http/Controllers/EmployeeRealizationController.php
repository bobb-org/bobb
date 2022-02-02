<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Models\EmployeeRealization;
use App\Models\Realization;
use App\Models\Contract;
use App\Models\Employee;
use App\Http\Controllers\AccountController; //check perm


class EmployeeRealizationController extends Controller
{
    public function show()
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1){
            $realizationList = Realization::all();
            return $realizationList->toJson();
        }
        else
            return response(401);
      
    }

   /* public function myRealizations($id){
        $myReal = EmployeeRealization::with('realization', 'contract')
           // ->select('id')
            ->where('employee_id','=', $id)
            ->charset('utf8mb4')
            ->get();
        return $myReal->toJson();

    }
        return $myReal->toJson();
    }*/

    public function getMyRealizations($id){
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2 || $userperm == 3 || $userperm == 4){
            $myRealization=DB::table('employee_realizations')
                ->Join('employees','employee_id','=','employees.id')
                ->Join('realizations','realizations.id','=','realization_id')
                ->Join('contracts','contracts.id','=','realizations.contract_id')
                ->where('employee_id',$id)
                ->select('employee_realizations.id','realizations.id AS realization_id','realizations.created_at','employees.id AS employee_id','employees.name AS employee_name','employees.surname AS employee_surname','contracts.name AS contract_name')
                ->get();
            return $myRealization->toJson();
        }
        else
            return response(401);
    }

    public function store(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $emplReal = new EmployeeRealization;
            
            $emplReal->realization_id = $request->input('realization_id');
            $emplReal->employee_id = $request->input('employee_id');
            $emplReal->introducer = $request->input('introducer');//użytkownik wprowadzający zmiany pobieramy z aktualnie zalogowanego użytkownika
            
            
            $emplReal->save();
            
            return redirect('/realization/show');
        }
        else
            return response(401);
    }

    public function update(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $emplRealid=$request->input('id');
            
            $emplReal = EmployeeRealization::find($emplRealid);

            $emplReal->realization_id = $request->input('realization_id');
            $emplReal->employee_id = $request->input('employee_id');
            $emplReal->introducer = $request->input('introducer');//użytkownik wprowadzający zmiany pobieramy z aktualnie zalogowanego użytkownika

            $emplReal->save();

            return redirect('/realization/show');
        }
        else
            return response(401);
    }

    public function delete(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $emplRealid=$request->input('id');
            
            $emplReal = EmployeeRealization::destroy($emplRealid);

            return redirect('/realization/show');
        }
        else
            return response(401);
    }

    
}
