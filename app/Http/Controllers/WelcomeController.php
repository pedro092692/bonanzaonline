<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;


class WelcomeController extends Controller
{
    public function __invoke()
    {

        if(auth()->user()){
            $pending = Order::where('status', 1)->where('user_id', auth()->user()->id)->count();
            if($pending){
                $message = "Usted tiene $pending ordernes pendientes <a class='font-bold' href='".route('orders.index')."?status=1'>Ir a pagar</a>";
                session()->flash('flash.banner', $message);
            }
        }

        $categories = Category::all();
        
        return view('welcome', compact('categories'));
    }
}
