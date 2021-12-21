<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObjectTemplate;

class ObjectTemplateController extends Controller
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
        
        $ObjectTemplateList = ObjectTemplate::All();
        
        return view('forge',["ObjectTemplateList"=>$ObjectTemplateList]);
    }

    public function store(Request $request)
    {
        $ObjectTemplate = new ObjectTemplate;
        $ObjectTemplate->name = $request->input('name');
        $ObjectTemplate->properties = $request->input('properties');
        $ObjectTemplate->save();

        return back();
    }

    public function update(Request $request)
    {
        $ObjectTemplateid = $request->input('id_template');
        $ObjectTemplateList = ObjectTemplate::find($ObjectTemplateid);
        $ObjectTemplate->name = $request->input('name');
        $ObjectTemplate->properties = $request->input('properties');
        $ObjectTemplate->save();

        return back();
    }

}
