<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

//use App\Repositories\UserRepository;

class RoleController extends Controller
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
    //public function index(UserRepository $userRepo)
    public function index()
    {
        $userList = User::all();
        //$userList = User::where('company','bobb')->orderBy('surnname','asc')->get();
        //$userList = User::where('role','superadmin')->get();
        
        //$userList = $userRepo->getAll('*');

        return view('role',["userList"=>$userList]);
    }
    public function createuserforms()
    {
        return view('rolecreate');
    }
    public function showuser(Request $request)
    {
        $useremail=$request->input('email');
        $userList = User::where('email',$useremail)->get();
        
        return view('roleshow',["userList"=>$userList]);
    }
    public function createuser(Request $request)
    {
        $pass=$request->input('password');
        User::create([
            'name'=>$request->input('name'),
            'surnname'=>$request->input('surnname'),
            'email'=>$request->input('email'),
            'password'=>bcrypt($pass),
            'role'=>$request->input('role'),
            'company'=>$request->input('company'),
            'phone'=>$request->input('phone'),
        ]);

        return redirect('role');
    }

    public function updateuser(Request $request)
    {
        $userid=$request->input('id');
        $userrole=$request->input('role');
        $userList = User::find($userid);
        $userList->role = $userrole;
        $userList->name = $request->input('name');
        $userList->surnname = $request->input('surnname');
        $userList->email = $request->input('email');
        $userList->save();
        return redirect('role');
    }
}
