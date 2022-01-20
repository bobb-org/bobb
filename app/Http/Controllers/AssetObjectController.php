<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AssetObject;

class AssetObjectController extends Controller
{
/* public function __construct() */
    /* { */
        /* $this->middleware('auth'); */
    /* } */

    public function show()
    {
        $assetObjectList = AssetObject::all();
        return $assetObjectList->toJson();
    }

    public function store(Request $request)
    {
        $assetObject = new AssetObject;
        
        $assetObject->asset_id = $request->input('asset_id');
        $assetObject->name = $request->input('name');
        $assetObject->properties = $request->input('properties');
        $assetObject->images = $request->input('images');
        $assetObject->schemes = $request->input('schemes');
        
        $assetObject->save();
        
        return redirect('/asset_object/show');
    }

    public function update(Request $request)
    {
        $assetObjectid=$request->input('id');
        
        $assetObject = AssetObject::find($assetObjectid);

        $assetObject->asset_id = $request->input('asset_id');
        $assetObject->name = $request->input('name');
        $assetObject->properties = $request->input('properties');
        $assetObject->images = $request->input('images');
        $assetObject->schemes = $request->input('schemes');

        $assetObject->save();

        return redirect('/asset_object/show');
    }

    public function delete(Request $request)
    {
        $assetObjectid=$request->input('id');
        
        $assetObject = AssetObject::destroy($assetObjectid);

        return redirect('/asset_object/show');
    }

}
