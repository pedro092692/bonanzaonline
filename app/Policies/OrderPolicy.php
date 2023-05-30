<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function author(User $user, Order $order){
        if($order->user_id == $user->id){
            return true;
        }else{
            abort(404);
        }
    }

    public function payment(User $user, Order $order){
        if($order->status == 1){
            return true;
        }else{
            return false;
        }
    }
}
