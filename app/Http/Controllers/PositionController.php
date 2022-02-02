<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Position;
use App\Http\Controllers\AccountController; //check perm

class PositionController extends Controller
{
/* public function __construct() */
    /* { */
        /* $this->middleware('auth'); */
    /* } */

    public function show()
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $positionList = Position::all();
            return $positiontList->toJson();
        }
        else
            return response(401);
    }

    public function store(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1){
            $position = new Position;
            
            $position->name = $request->input('name');
            $position->permission = $request->input('permission');
            
            $position->save();
            
            return redirect('/position/show');
        }
        else
            return response(401);   
    }

    public function update(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1){
            $positionid=$request->input('id');
            
            $position = Position::find($positionid);

            $position->name = $request->input('name');
            $position->permission = $request->input('permission');

            $position->save();

            return redirect('/position/show');
        }
        else
            return response(401);
    }

    public function delete(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1){
            $positionid=$request->input('id');
            
            $position = Position::destroy($positionid);

            return redirect('/position/show');
        }
        else
            return response(401);
    }

}
