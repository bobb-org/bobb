<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssetObject;

class AssetObjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function show()
    {
        
        $AssetObjectList = AssetObject::All();
        
        return view('forge',["ObjectTemplateList"=>$AssetObjectList]);
    }

    public function store(Request $request)
    {
        $AssetObject = new AssetObject;
        $AssetObject->name = $request->input('name');
        $AssetObject->properties = $request->input('properties');
        $AssetObject->save();

        return back();
    }

    public function update(Request $request)
    {
        $AssetObjectid = $request->input('id_object');
        $AssetObjectList = AssetObject::find($AssetObjectid);
        $AssetObjectList->id_asset = $request->input('id_asset');
        $AssetObjectList->properties = $request->input('properties');
        $AssetObjectList->name = $request->input('name');
        $AssetObjectList->save();

        return back();
    }

}
