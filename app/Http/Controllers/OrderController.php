<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){

        $orders = Order::query()
        ->where('user_id', auth()->user()->id);

        if(request('status')){
            $orders->where('status', request('status'));
        }

        $orders = $orders->orderBy('id', 'DESC')->get();

        $pending = Order::where('status', 1)->where('user_id', auth()->user()->id)->count();
        $received = Order::where('status', 2)->where('user_id', auth()->user()->id)->count();
        $shipped = Order::where('status', 3)->where('user_id', auth()->user()->id)->count();
        $delivered = Order::where('status', 4)->where('user_id', auth()->user()->id)->count();
        $nulled = Order::where('status', 5)->where('user_id', auth()->user()->id)->count();
        $reviewing = Order::where('status', 6)->where('user_id', auth()->user()->id)->count();


        return view('orders.index', compact('orders', 'pending', 'received', 'shipped', 'delivered', 'nulled', 'reviewing'));
    }
    
    public function show(Order $order){
        
        $this->authorize('author', $order);

    

        $items = json_decode($order->content);    
        $elements = json_decode($order->content, true);
        $shipping = json_decode($order->shipping);
        
        return view('orders.show', compact('order', 'items', 'elements', 'shipping'));
    }

}
