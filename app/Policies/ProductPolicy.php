<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class ProductPolicy
{
    public function status(?User $user, Product $product){ //we used ? for indicate a guest users
        if($product->status == 1){
            return true;
        }else{
            abort(404);
        }
    }

    public function review(User $user, Product $product){
        $reviews = $product->reviews()->where('user_id', $user->id)->count();

        if($reviews){
            return false;
        }

        $orders = Order::where('user_id', $user->id)->select('content')
                        ->where('status', 4)                
                        ->get()->map(function($order){
            return json_decode($order->content, true);
        });
    
        $products = $orders->collapse();

        return $products->contains('id', $product->id);
    }
}
