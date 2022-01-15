<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Organization;

class OrganizationController extends Controller
{
/* public function __construct() */
    /* { */
        /* $this->middleware('auth'); */
    /* } */

    public function show()
    {
        $orgList = Organization::all();

        #dd($orgList);

        return json_encode($orgList);
    }

    public function store(Request $request)
    {
        $org = new Organization;
        
        $org->name = $request->input('name');
        $org->contact = $request->input('contact');
        $org->email = $request->input('email');
        $org->adress = $request->input('adress');
        $org->postCode = $request->input('postCode');
        $org->city = $request->input('city');
        $org->nip = $request->input('nip');
        
        $org->save();
        
        return redirect('/Organization/show');
    }

    public function update(Request $request)
    {
        $orgid=$request->input('id');
        
        $org = Organization::find($orgid);

        $org->name = $request->input('name');
        $org->contact = $request->input('contact');
        $org->email = $request->input('email');
        $org->adress = $request->input('adress');
        $org->postCode = $request->input('postCode');
        $org->city = $request->input('city');
        $org->nip = $request->input('nip');

        $org->save();

        return redirect('/Organization/show');
    }

    public function delete(Request $request)
    {
        $orgid=$request->input('id');
        
        $org = Organization::destroy($orgid);

        return redirect('/Organization/show');
    }

}
