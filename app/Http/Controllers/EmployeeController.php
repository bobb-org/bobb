<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Realization;
use App\Models\Contract;
use App\Http\Controllers\AccountController; //check perm

class EmployeeController extends Controller
{
/* public function __construct() */
    /* { */
        /* $this->middleware('auth'); */
    /* } */

    public function show()
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $employeeList = Employee::all();
            return $employeeList->toJson();
        }
        else
            return response(401);
    }

    public function store(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $employee = new Employee;
            
            $employee->name = $request->input('name');
            $employee->surname = $request->input('surname');
            $employee->contact = $request->input('contact');
            $employee->email = $request->input('email');
            $employee->pesel = $request->input('pesel');
            $employee->series_id_card = $request->input('series_id_card');
            $employee->number_id_card = $request->input('number_id_card');
            $employee->validity_id_card = $request->input('validity_id_card');
            $employee->date_of_birth = $request->input('date_of_birth');
            $employee->father_name = $request->input('father_name');
            $employee->adress = $request->input('adress');
            $employee->post_code = $request->input('post_code');
            $employee->city = $request->input('city');
            $employee->organization_id = $request->input('organization_id');
            $employee->position_id = $request->input('position_id');
            
            $employee->save();
            
            return redirect('/employee/show');
        }
        else
            return response(401);
    }

    public function update(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $employeeid=$request->input('id');
            
            $employee = Employee::find($employeeid);

            $employee->name = $request->input('name');
            $employee->surname = $request->input('surname');
            $employee->contact = $request->input('contact');
            $employee->email = $request->input('email');
            $employee->pesel = $request->input('pesel');
            $employee->series_id_card = $request->input('series_id_card');
            $employee->number_id_card = $request->input('number_id_card');
            $employee->validity_id_card = $request->input('validity_id_card');
            $employee->date_of_birth = $request->input('date_of_birth');
            $employee->father_name = $request->input('father_name');
            $employee->adress = $request->input('adress');
            $employee->post_code = $request->input('post_code');
            $employee->city = $request->input('city');
            $employee->organization_id = $request->input('organization_id');
            $employee->position_id = $request->input('position_id');

            $employee->save();

            return redirect('/employee/show');
        }
        else
            return response(401);
    }

    public function delete(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $employeeid=$request->input('id');
            
            $employee = Employee::destroy($employeeid);

            return redirect('/employee/show');
        }
        else
            return response(401);
    }



}
