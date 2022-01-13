<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Realization;

class RealizationController extends Controller
{
/* public function __construct() */
    /* { */
        /* $this->middleware('auth'); */
    /* } */

    public function show()
    {
        $realizationList = Realization::all();
        return view('spa', ['realizationList' => $realizationList]); // pokazuje wszystko z tabeli, przekazuje tablicę
    }

    public function store(Request $request)
    {
        $realization = new Realization;
        
        $realization->project = $request->input('project');
        $realization->employee = $request->input('employee');
        $realization->startDate = $request->input('startDate');
        $realization->plannedEndDate = $request->input('plannedEndDate');
        $realization->supervisor = $request->input('supervisor');
        
        $realization->save();
        
        return redirect('/Realization/show');
    }

    public function update(Request $request)
    {
        $realizationid=$request->input('id');
        
        $realization = Realization::find($realizationid);

        $realization->project = $request->input('project');
        $realization->employee = $request->input('employee');
        $realization->startDate = $request->input('startDate');
        $realization->plannedEndDate = $request->input('plannedEndDate');
        $realization->supervisor = $request->input('supervisor');

        $realization->save();

        return redirect('/Realization/show');
    }

    public function delete(Request $request)
    {
        $realizationid=$request->input('id');
        
        $realization = Realization::destroy($realizationid);

        return redirect('/Realization/show');
    }

}
