<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Seller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class SellerController extends Controller
{
    public function index(){


   return view('seller.seller_login');

    }// End Method

    public function sellerDashboard()
    {

        return view('seller.index');

    }// End Method

    public  function sellerLogin(Request $req){

//         dd($req->all());
        $check = $req->all();
        if(Auth::guard('seller')->attempt(['email'=>$check['email'],'password'=>$check['password'] ])){
            return redirect()->route('seller.dashboard')->with('error','Seller Login Successfully');
        }else{

            return back()->with('error','Invalid Email Or Password');
        }


    }// End Method

    public function sellerLogOut(){

        Auth::guard('seller')->logout();

        return redirect()->route('seller_login_form')->with('error','Seller LogOut Successfully');

    }// End Method

    public function sellerRegister(){

        return view('seller.seller_register');

    }// End Method

    public function sellerRegisterCreate(Request $req){

        Seller::insert([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('seller_login_form')->with('error','Seller Created Successfully');

    }// End Method
}
