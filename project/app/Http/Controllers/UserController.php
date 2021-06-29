<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ProRequest;

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
    public function adduser(){
        return view('Admin.add');
    }
    public function showuser(){
        $user =new User();
        $users = $user->orderBy('id','asc')->paginate(5);
        return view('Admin.userlist')->with('userlist', $users);
    }
    public function usersearch(Request $req)
    {
        $user =new User();
        $users = $user->where('id','like','%'.$req->search.'%')->orwhere('type','like','%'.$req->search.'%')->paginate(5);
        //SELECT * FROM `product` WHERE id like 'elec%' or category like 'elec%'
        //dd($req->all());
        return view('Admin.userlist')->with('userlist', $users);
    }
    public function edit($id){
        // return view('Seller.profile');
         $user = User::find($id);
         return view('Admin.edit')->with('user', $user);
    }
    public function update(Request $req, $id)
    {
        $user= User::find($id);
        $user->name = $req->name;
        $user->address = $req->address;
        $user->phone = $req->phone;
        $user->email = $req->email;
        $user->type = $req->type;

        $user->save();
        return redirect()->route('showuser');
    }
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('showuser');
    }
    public function insertuser(UserRequest $req){

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
                return redirect()->route('showuser');
                echo "successfully created account, login with email and password.";
            }
            else{
                echo "error";
            }
        }
        else{
            echo "file not found.";
        }    
    }
    //ADMIN PROFILE WORK
    public function profileadmin($id){
        // return view('Seller.profile');
         $user = User::find($id);
         return view('Admin.profile')->with('user', $user);
    }
     public function adminupdate(ProRequest $req, $id)
    {
        $user= User::find($id);
        $user->name = $req->name;
        $user->address = $req->address;
        $user->phone = $req->phone;
        $user->email = $req->email;
        $user->password = $req->password;

        $user->save();
        return view('Admin.profile')->with('user',$user);
    }
    public function adminimage(Request $req,$id){
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
        return view('Admin.profile')->with('user',$user);
    }

}
