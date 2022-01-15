<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

class EmployeeController extends Controller
{
/* public function __construct() */
    /* { */
        /* $this->middleware('auth'); */
    /* } */

    public function show()
    {
        $employeeList = Employee::all();
        return json_encode($employeeList);
    }

    public function store(Request $request)
    {
        $employee = new Employee;
        
        $employee->name = $request->input('name');
        $employee->surname = $request->input('surname');
        $employee->contact = $request->input('contact');
        $employee->email = $request->input('email');
        $employee->PESEL = $request->input('PESEL');
        $employee->seriesIdCard = $request->input('seriesIdCard');
        $employee->numberIdCard = $request->input('numberIdCard');
        $employee->validityIdCard = $request->input('validityIdCard');
        $employee->dateOfBirth = $request->input('dateOfBirth');
        $employee->fatherName = $request->input('fatherName');
        $employee->adress = $request->input('adress');
        $employee->postCode = $request->input('postCode');
        $employee->city = $request->input('city');
        $employee->company = $request->input('company');
        $employee->position = $request->input('position');
        
        $employee->save();
        
        return redirect('/Employee/show');
    }

    public function update(Request $request)
    {
        $employeeid=$request->input('id');
        
        $employee = Employee::find($employeeid);

        $employee->name = $request->input('name');
        $employee->surname = $request->input('surname');
        $employee->contact = $request->input('contact');
        $employee->email = $request->input('email');
        $employee->PESEL = $request->input('PESEL');
        $employee->seriesIdCard = $request->input('seriesIdCard');
        $employee->numberIdCard = $request->input('numberIdCard');
        $employee->validityIdCard = $request->input('validityIdCard');
        $employee->dateOfBirth = $request->input('dateOfBirth');
        $employee->fatherName = $request->input('fatherName');
        $employee->adress = $request->input('adress');
        $employee->postCode = $request->input('postCode');
        $employee->city = $request->input('city');
        $employee->company = $request->input('company');
        $employee->position = $request->input('position');

        $employee->save();

        return redirect('/Employee/show');
    }

    public function delete(Request $request)
    {
        $employeeid=$request->input('id');
        
        $employee = Employee::destroy($employeeid);

        return redirect('/Employee/show');
    }

}
