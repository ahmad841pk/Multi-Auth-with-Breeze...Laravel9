<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public  function index(){

        return view('admin.admin_login');

    }// End Method

    public  function Dashboard(){

        return view('admin.index');

    }// End Method


    public  function Login(Request $req){

//         dd($req->all());
        $check = $req->all();
        if(Auth::guard('admin')->attempt(['email'=>$check['email'],'password'=>$check['password'] ])){
            return redirect()->route('admin.dashboard')->with('error','Admin Login Successfully');
        }else{

            return back()->with('error','Invalid Email Or Password');
        }


    }// End Method


    public function logOut(){

       Auth::guard('admin')->logout();

        return redirect()->route('login_form')->with('error','Admin LogOut Successfully');

    }// End Method


    public function adminRegister(){

        return view('admin.admin_register');

    }// End Method


     public function adminRegisterCreate(Request $req){

         Admin::insert([
             'name' => $req->name,
              'email' => $req->email,
             'password' => Hash::make($req->password),
             'created_at' => Carbon::now(),
         ]);

         return redirect()->route('login_form')->with('error','Admin Created Successfully');

    }// End Method

}
