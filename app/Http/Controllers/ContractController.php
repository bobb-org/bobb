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
        return json_encode($contractList);
    }

    public function store(Request $request)
    {
        $contract = new Contract;
        
        $contract->name = $request->input('name');
        $contract->postcode = $request->input('postcode');
        $contract->city = $request->input('city');
        $contract->adress = $request->input('adress');
        $contract->generalContractor = $request->input('generalContractor');
        $contract->contractor = $request->input('contractor');
        
        $contract->save();
        
        return redirect('/Contract/show');
    }

    public function update(Request $request)
    {
        $contractid=$request->input('id');
        
        $contract = Contract::find($contractid);

        $contract->name = $request->input('name');
        $contract->postcode = $request->input('postcode');
        $contract->city = $request->input('city');
        $contract->adress = $request->input('adress');
        $contract->generalContractor = $request->input('generalContractor');
        $contract->contractor = $request->input('contractor');

        $contract->save();

        return redirect('/Contract/show');
    }

    public function delete(Request $request)
    {
        $contractid=$request->input('id');
        
        $contract = Contract::destroy($contractid);

        return redirect('/Contract/show');
    }

}
