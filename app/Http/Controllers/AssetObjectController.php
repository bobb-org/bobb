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
        return view('spa', ['assetObjectList' => $assetObjectList]); // pokazuje wszystko z tabeli, przekazuje tablicę
    }

    public function store(Request $request)
    {
        $assetObject = new AssetObject;
        
        $assetObject->name = $request->input('name');
        $assetObject->contact = $request->input('contact');
        $assetObject->email = $request->input('email');
        $assetObject->adress = $request->input('adress');
        
        $assetObject->save();
        
        return redirect('/AssetObject/show');
    }

    public function update(Request $request)
    {
        $assetObjectid=$request->input('id');
        
        $assetObject = AssetObject::find($assetObjectid);

        $assetObject->name = $request->input('name');
        $assetObject->contact = $request->input('contact');
        $assetObject->email = $request->input('email');
        $assetObject->adress = $request->input('adress');

        $assetObject->save();

        return redirect('/AssetObject/show');
    }

    public function delete(Request $request)
    {
        $assetObjectid=$request->input('id');
        
        $assetObject = AssetObject::destroy($assetObjectid);

        return redirect('/AssetObject/show');
    }

}
