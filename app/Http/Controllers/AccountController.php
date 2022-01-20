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

}
