<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeToRealization extends Controller
{
    public function show()
    {
       # $employeeToRealization = EmployeeToRealization::all();
       # return view('spa', ['employeeList' => $employeeToRealization]); // pokazuje wszystko z tabeli, przekazuje tablicę

      # $employeeToRealization = DB::table('employeetorealization')
        #->join('employee', 'employeeId', '=', 'employee.id')
        #->join('realization', 'realizationId', '=', 'realization.id')
        #->select()
        #->groupBy('realizationId')
    }

    public function myRealizations($id){
        $myrealizations = DB::table('employeetorealization')
            -> join('realization', 'realizationId', '=', 'realization.id')
            -> select('realization.id', 'realization.name')
            -> where('employeeId', '=', $id)
            -> get();
    }

    public function store(Request $request)
    {
       
    }

    public function update(Request $request)
    {
        
    }

    public function delete(Request $request)
    {
        
    }
}
