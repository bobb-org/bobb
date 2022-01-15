<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;

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

        return json_encode($accountList); // pokazuje wszystko z tabeli, przekazuje json
    }

    public function store(Request $request)
    {
        $account = new Account;
        
        $account->login = $request->input('login');
        $account->password = $request->input('password');
        $account->email = $request->input('email');
        $account->owner = $request->input('owner');
        $account->active = $request->input('active');
        
        $account->save();
        
        return redirect('/Account/show');
    }

    public function update(Request $request)
    {
        $accountid=$request->input('id');
        
        $account = Account::find($accountid);

        $account->login = $request->input('login');
        $account->password = $request->input('password');
        $account->email = $request->input('email');
        $account->owner = $request->input('owner');
        $account->active = $request->input('active');

        $account->save();

        return redirect('/Account/show');
    }

    public function delete(Request $request)
    {
        $accountid=$request->input('id');
        
        $account = Account::destroy($accountid);

        return redirect('/Account/show');
    }

}
