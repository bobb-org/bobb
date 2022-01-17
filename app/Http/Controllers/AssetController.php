<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Asset;

class AssetController extends Controller
{
/* public function __construct() */
    /* { */
        /* $this->middleware('auth'); */
    /* } */

    public function show()
    {
        $assetList = Asset::all();
        return json_encode($assetList);
    }

    public function store(Request $request)
    {
        $asset = new Asset;
        
        $asset->realizationId = $request->input('realizationId');
        $asset->autodeskForgeUrn = $request->input('autodeskForgeUrn');
        
        $asset->save();
        
        return redirect('/Asset/show');
    }

    public function update(Request $request)
    {
        $assetid=$request->input('id');
        
        $asset = Asset::find($assetid);

        $asset->realizationId = $request->input('realizationId');
        $asset->autodeskForgeUrn = $request->input('autodeskForgeUrn');

        $asset->save();

        return redirect('/Asset/show');
    }

    public function delete(Request $request)
    {
        $assetid=$request->input('id');
        
        $asset = Asset::destroy($assetid);

        return redirect('/Asset/show');
    }

}
