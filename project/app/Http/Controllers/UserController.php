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
    public function insert(UserRequest $req){

        if($req->type == 'admin')
        {
                $user = new User;
                $count = $user->where('type','admin')->orderBy('id',"desc")->first();
                if($count){
                    $id = intval(substr($count->id,2,4))+1;
                    $user->type = $req->type;
                    $id = "A-".strval($id);
                }
        }
        elseif($req->type == 'seller')
        {
                $user = new User;
                $count = $user->where('type','seller')->orderBy('id',"desc")->first();
                if($count){
                    $id = intval(substr($count->id,2,4))+1;
                    $user->type = $req->type;
                    $id = "S-".strval($id);
                }
        }
            elseif($req->type == 'buyer')
            {
                $user = new User;
                $count = $user->where('type','buyer')->orderBy('id',"desc")->first();
                if($count){
                    $id = intval(substr($count->id,2,4))+1;
                    $user->type = $req->type;
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
            }
            else{
                echo "error";
            }
        }
        else{
            echo "file not found.";
        }    
    }


    public function profile($id){
       // return view('Seller.profile');
        $user = User::find($id);
        return view('Seller.profile')->with('user', $user);
    }
    
    public function profileupdate(UserRequest $req, $id)
    {
        $user= User::find($id);
        $user->name = $req->name;
        $user->address = $req->address;
        $user->phone = $req->phone;
        $user->email = $req->email;
        $user->password = $req->password;

        $user->save();
        return view('Seller.profile')->with('user',$user);
    }
    public function profileimage(Request $req,$id){
        $user= User::find($id);
        if($req->hasFile('image')){
            $file = $req->file('image');
            // echo "file name: ".$file->getClientOriginalName()."<br>";
            // echo "file extension: ".$file->getClientOriginalExtension()."<br>";
            // echo "file Mime Type: ".$file->getType()."<br>";
            // echo "file Size: ".$file->getSize();
            $user->image = $file->getClientOriginalName();
            $user->save();

            if($file->move('upload', $file->getClientOriginalName())){
                echo "success";
            }else{
                echo "error..";
            }

        }else{
            echo "file not found!";
        }
        return view('Seller.profile')->with('user',$user);
    }

}
