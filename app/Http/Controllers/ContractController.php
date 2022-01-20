<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contract;

class ContractController extends Controller
{
/* public function __construct() */
    /* { */
        /* $this->middleware('auth'); */
    /* } */

    public function show()
    {
        $contractList = Contract::all();
        return $contractList->toJson();
    }

    public function store(Request $request)
    {
        $contract = new Contract;
        
        $contract->name = $request->input('name');
        $contract->post_code = $request->input('post_code');
        $contract->city = $request->input('city');
        $contract->adress = $request->input('adress');
        $contract->general_contractor = $request->input('general_contractor');
        $contract->contractor = $request->input('contractor');
        
        $contract->save();
        
        return redirect('/contract/show');
    }

    public function update(Request $request)
    {
        $contractid=$request->input('id');
        
        $contract = Contract::find($contractid);

        $contract->name = $request->input('name');
        $contract->post_code = $request->input('post_code');
        $contract->city = $request->input('city');
        $contract->adress = $request->input('adress');
        $contract->general_contractor = $request->input('general_contractor');
        $contract->contractor = $request->input('contractor');

        $contract->save();

        return redirect('/contract/show');
    }

    public function delete(Request $request)
    {
        $contractid=$request->input('id');
        
        $contract = Contract::destroy($contractid);

        return redirect('/contract/show');
    }

}
