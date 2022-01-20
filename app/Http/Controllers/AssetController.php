<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Asset;
use App\Models\AssetObject;

class AssetController extends Controller
{
/* public function __construct() */
    /* { */
        /* $this->middleware('auth'); */
    /* } */

    public function show()
    {
        $assetList = Asset::all();
        return $assetList->toJson();
    }

    public function store(Request $request)
    {
        $asset = new Asset;
        
        $asset->realization_id = $request->input('realization_id');
        $asset->autodesk_forge_urn = $request->input('autodesk_forge_urn');
        
        $asset->save();
        
        return redirect('/asset/show');
    }

    public function update(Request $request)
    {
        $assetid=$request->input('id');
        
        $asset = Asset::find($assetid);

        $asset->realization_id = $request->input('realization_id');
        $asset->autodesk_forge_urn = $request->input('autodesk_forge_urn');

        $asset->save();

        return redirect('/asset/show');
    }

    public function delete(Request $request)
    {
        $assetid=$request->input('id');
        
        $asset = Asset::destroy($assetid);

        return redirect('/asset/show');
    }

    public function assetObjList(){
        $assetObj = Asset::with('assetObject', 'realization')
            //->where('employee_id','=', $id)
            ->get();

        return $assetObj->toJson(); 
    }

}
