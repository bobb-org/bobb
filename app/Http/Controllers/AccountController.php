<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
/* public function __construct() */
    /* { */
        /* $this->middleware('auth'); */
    /* } */

    public function show()
    {
       $accountList = Account::all();

       //dd('test1');

        return $accountList->ToJson(); // pokazuje wszystko z tabeli, przekazuje json
    }

    public function store(Request $request)
    {
        $account = new Account;
        
        $account->login = $request->input('login');
        $account->password = $request->input('password');
        $account->email = $request->input('email');
        $account->employee_id = $request->input('employee_id');
        $account->active = $request->input('active');
        
        $account->save();
        
        return redirect('/account/show');
    }

    public function update(Request $request)
    {
        $accountid=$request->input('id');
        
        $account = Account::find($accountid);

        $account->login = $request->input('login');
        $account->password = $request->input('password');
        $account->email = $request->input('email');
        $account->employee_id = $request->input('employee_id');
        $account->active = $request->input('active');

        $account->save();

        return redirect('/account/show');
    }

    public function delete(Request $request)
    {
        $accountid=$request->input('id');
        
        $account = Account::destroy($accountid);

        return redirect('/account/show');
    }

    public function accountOwner($id){
        $owner = Account::with('employee')
            ->where('employee_id','=', $id)
            ->get();

        return $owner->toJson();
    }

    public function permAccount($id){
        $permission = Account::with('Position')
            ->where('id', '=', $id)
            ->get();
        return $permission->toJson();
    }

    public function myPermissions($id){
        
        $myPermission=DB::table('accounts')
            ->Join('employees','employee_id','=','employees.id')
            ->Join('positions','position_id','=','positions.id')
            ->where('accounts.id',$id)
            ->select('positions.permission')
            ->get();
        return $myPermission->toJson();
    }

    public function checkPerm(){

        $userid = Auth::user()->id;
        $userperm = myPermissions($userid)->permission;

        if($userperm == 'superadmin')
            return 1;
        elseif($userperm == 'kierownik')
            return 2;
        elseif($userperm == 'inzynier')
            return 3;
        elseif($userperm == 'pracownik')
            return 4;
        else
            return response(401);
        
    }

    
}
