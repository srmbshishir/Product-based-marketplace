<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use validator;
use Illuminate\Support\Facades\DB;
use App\Models\Person;

class LoginController extends Controller
{
    public function index(){
        return view('Login.login');
    }

    public function verify(LoginRequest $req){
        //$result = DB::table('user')
        //->where('email', $req->email)
        //->where('password', $req->password)
        //->first();

        //echo $result;
       // print_r($result[0]);
        if(DB::table('user')->where('email',$req->email)->where('password', $req->password)->exists()){
        //if(count(array($result)) > 0){
                $user = Person::find($req->email);
                $req->session()->put('name', $user['name']);
                $req->session()->put('type', $user['type']);
                $req->session()->put('id', $user['id']);

                //$req->session()->put('name', $result->name);
                //$req->session()->put('type', $result->type);
                
                if($user['type']=='admin'){
                    return redirect('/admin/index');
                }
                if($user['type']=='buyer'){
                    return redirect('/buyer/index');
                }
                if($user['type']=='seller'){
                    return redirect('/seller/index');
                }   
        }
        else{
            $req->session()->flash('msg', 'Invalid username or password!');
            return redirect('/login');
        }
    }


    public function admin(){
        return view('Admin.index');
    }
    public function buyer(){
        return view('Buyer.index');
    }
    public function seller(){
        return view('Seller.index');
    }



}
