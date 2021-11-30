<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;

class AssetController extends Controller
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
    public function index($id_realization)
    {
        $assetList = Asset::where('id_realization',$id_realization)->get();
        
        return view('asset',["assetid"=>$id_realization, "assetList"=>$assetList], );
    }
    public function create($id_realization)
    {
        return view('assetcreate',["id_realization"=>$id_realization]);
    }

    public function store(Request $request)
    {
        $asset = new Asset;
        $asset->id_realization = $request->input('id_realization');
        $asset->name = $request->input('name');
        $asset->urn = $request->input('urn');
        $asset->save();

        return redirect()->action('AssetController@index',$request->input('id_realization'));
    }

}
