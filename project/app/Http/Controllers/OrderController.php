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
    public function dashboard(Request $req, $id){
        //SELECT sum(price) FROM `orderlist` WHERE track='delivered' and sellerid='S-104'
        $orders= DB::select("SELECT sum(price) FROM `orderlist` WHERE track='delivered' and sellerid='".session('id')."'");
        //SELECT sum(price) FROM `orderlist` WHERE track='delivered' and sellerid='S-104' and MONTH(date) = MONTH(CURRENT_DATE())
        $month_income= DB::select("SELECT sum(price) FROM `orderlist` WHERE track='delivered' and sellerid='".session('id')."' and MONTH(date) = MONTH(CURRENT_DATE())");
        //SELECT count(*) FROM `orderlist` WHERE track!='delivered'
        $pending=DB::select("SELECT count(*) FROM `orderlist` WHERE track!='delivered'");


       // print_r($orders[0][0]);
         $data = [
             'total_income'             => $orders,
             'current_month_income'     => $month_income,
             'pending'                  => $pending
        ];
       //  dd($req->all());
       //  print_r($data['total_income'][0]->sum(price));
        return view('Seller.dashboard')->with('orderlist', $data);
    }
}
