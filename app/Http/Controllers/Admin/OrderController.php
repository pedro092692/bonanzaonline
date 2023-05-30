<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        
        $orders = Order::query()->where('status', '<>', 1);

        if(request('status')){
            $orders->where('status', request('status'));
        }

        $orders = $orders->get();

        $pending = Order::where('status', 1)->count();
        $received = Order::where('status', 2)->count();
        $shipped = Order::where('status', 3)->count();
        $delivered = Order::where('status', 4)->count();
        $nulled = Order::where('status', 5)->count();
        $reviewing = Order::where('status', 6)->count();

        return view('admin.orders.index', compact('orders', 'pending', 'received', 'shipped', 'delivered', 'nulled', 'reviewing'));



    }

    public function show(Order $order){

        return view('admin.orders.show', compact('order'));
        
    }
}
