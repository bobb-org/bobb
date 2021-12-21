<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

  
class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUpload()
    {
        return view('fileUpload');
    }
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUploadPost(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:dwg|max:200048',
        ]);
        
        $fileName = strtolower($request->file->getClientOriginalName());  
        
        $request->file->move('C:\xampp\htdocs\bobb\storage\app\public\uploads', $fileName);
        
        return back()
            ->with('success','You have successfully upload file.')
            ->with('file',$fileName);
   
    }
}
