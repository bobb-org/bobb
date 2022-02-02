<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AssetObject;
use App\Http\Controllers\AccountController; //check perm

class AssetObjectController extends Controller
{
/* public function __construct() */
    /* { */
        /* $this->middleware('auth'); */
    /* } */

    public function show()
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2 || $userperm == 3 || $userperm == 4){
            $assetObjectList = AssetObject::all();
            return $assetObjectList->toJson();
        }
        else
            return response(401);
    }

    public function store(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2 || $userperm == 3){
            $assetObject = new AssetObject;
            
            $assetObject->asset_id = $request->input('asset_id');
            $assetObject->name = $request->input('name');
            $assetObject->properties = $request->input('properties');
            $assetObject->images = $request->input('images');
            $assetObject->schemes = $request->input('schemes');
            
            $assetObject->save();
            
            return redirect('/asset_object/show');
        }
        else
            return response(401);
    }

    public function update(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2 || $userperm == 3){
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
        else
            return response(401);
    }

    public function delete(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2 || $userperm == 3){
            $assetObjectid=$request->input('id');
            
            $assetObject = AssetObject::destroy($assetObjectid);

            return redirect('/asset_object/show');
        }
        else
            return response(401);
    }

    public function getAssetObjectTemplates()
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2 || $userperm == 3){
            $templates = Storage::disk('local')->get('assetobject_templates.json');

            //$templates2 = File::get(storage_path('app/assetobject_templates.json'));
            
            return $templates;
        }
        else
            return response(401);
    }
}
