<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use validator;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function add()
    {
        return view('Seller.add');
    }

    public function insert(ProductRequest $req){
        $product = new Product;

        //$product->id                = DB::table('products')->increment('id');
        $count = Product::orderBy('id',"desc")->first();

        if($count){
            $id = intval(substr($count->id,2,8))+1;
            $id = "PR".strval($id);
        }   
        else{
            $id = "PR1000";
        }

        $product->id                = $id;
        $product->name              = $req->name; 
        $product->price             = $req->price; 
        $product->p_condition       = $req->condition; 
        $product->category          = $req->category; 
        $product->userid            = session('id');
        $product->quantity          = $req->quantity;
        $product->discount          = $req->discount;
        $product->description       = $req->description;

        

        if($req->hasFile('image')){
            $file = $req->file('image');
            // echo "file name: ".$file->getClientOriginalName()."<br>";
            // echo "file extension: ".$file->getClientOriginalExtension()."<br>";
            // echo "file Mime Type: ".$file->getType()."<br>";
            // echo "file Size: ".$file->getSize();
            $product->image = $file->getClientOriginalName();
            $product->save();

            if($file->move('upload', $file->getClientOriginalName())){
                echo "success";
            }else{
                echo "error..";
            }

        }else{
            echo "file not found!";
        }

        return redirect()->route('show');
    }

    public function show(){
        //$products = Product::where('userid', session('id'));
        $products= DB::select("SELECT * FROM `product` WHERE userid='".session('id')."'");
        return view('Seller.show')->with('userlist', $products);
       // return view('Product.userlist');
    }

    public function edit($name)
    {
        $product = Product::find($name);
        return view('Seller.edit')->with('product', $product);
    }

    public function update(ProductRequest $req, $name)
    {
        $product= Product::find($name);
        $product->name = $req->name;
        $product->price = $req->price;
        $product->p_condition = $req->condition;
        $product->category = $req->category;
        $product->quantity = $req->quantity;
        $product->discount = $req->discount;
        $product->description = $req->description;

        //dd($req->all());
        
        if($req->has('image')){
            $file = $req->file('image');
            $product->image = $file->getClientOriginalName();
            

            if($file->move('upload', $file->getClientOriginalName())){
                echo "success";
                $product->save();
                return redirect()->route('show');
                
                
            }else{
                echo "error..";
            }
        }
    }
    public function delete($name)
    {
        $product = Product::find($name);
        $product->delete();
        return redirect()->route('show');
    }
    public function search(Request $req)
    {
        $products= DB::select("SELECT * FROM `product` WHERE id like '".$req->search."%' or category like '".$req->search."%'");
        //SELECT * FROM `product` WHERE id like 'elec%' or category like 'elec%'
        //dd($req->all());
        return view('Seller.show')->with('userlist', $products);
    }
}