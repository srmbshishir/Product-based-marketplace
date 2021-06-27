<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
//use validator;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function showOrder(Request $req){
        $order =new Order();
        $orders = $order->where('sellerid',session('id'))->paginate(3);
        return view('Seller.showOrder')->with('orderlist', $orders);


        //$orders= DB::select("SELECT * FROM `orderlist` WHERE sellerid='".session('id')."' order by id desc")->pagination(5);
        //return view('Seller.showOrder')->with('orderlist', $orders);
    }
    public function search(Request $req)
    {
        $orders= DB::select("SELECT * FROM `orderlist` WHERE id like '".$req->search."%' or date like '".$req->search."%'");
        //SELECT * FROM `product` WHERE id like 'elec%' or category like 'elec%'
        //dd($req->all());
        return view('Seller.showOrder')->with('orderlist', $orders);
    }
    public function track(Request $req, $id)
    {
        $order= Order::find($id);
        //print_r($order);
        $order->track = $req->track;
        //print_r($order->track);

        $order->save();
        //dd($req->all());
        return redirect()->route('showOrder');
    }
}
