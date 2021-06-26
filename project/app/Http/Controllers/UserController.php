<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index(){
        return view('register.index');
    }
    public function insert(userRequest $req){
        $user = new User;
        $count = User::orderBy('id',"desc")->first();
        if($count){
            $id = intval(substr($count->id,2,4))+1;
            $user->type = $req->type;
            if($user->type == 'admin')
            {
                $id = "A-".strval($id);
            }
            elseif($user->type == 'seller')
            {
                $id = "S-".strval($id);
            }
            elseif($user->type == 'buyer')
            {
                $id = "B-".strval($id);
            }
        }
        $user->id = $id;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->address = $req->address;
        $user->phone = $req->phone;
        $user->password = $req->password;
        if($req->hasFile('image')){
            $file = $req->file('image');
            $user->image = $file->getClientOriginalName();
            $user->save();
            if($file->move('upload', $file->getClientOriginalName())){
                return redirect('/login');
                echo "successfully created account, login with email and password.";
            }else echo "error";
        }else{
            echo "file not found.";
        }    
    }
}
