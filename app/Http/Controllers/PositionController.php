<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Position;

class PositionController extends Controller
{
/* public function __construct() */
    /* { */
        /* $this->middleware('auth'); */
    /* } */

    public function show()
    {
        $positionList = Position::all();
        return $positiontList->toJson();
    }

    public function store(Request $request)
    {
        $position = new Position;
        
        $position->name = $request->input('name');
        $position->permission = $request->input('permission');
        
        $position->save();
        
        return redirect('/position/show');
    }

    public function update(Request $request)
    {
        $positionid=$request->input('id');
        
        $position = Position::find($positionid);

        $position->name = $request->input('name');
        $position->permission = $request->input('permission');

        $position->save();

        return redirect('/position/show');
    }

    public function delete(Request $request)
    {
        $positionid=$request->input('id');
        
        $position = Position::destroy($positionid);

        return redirect('/position/show');
    }

}
