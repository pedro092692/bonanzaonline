<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{


    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at', 'status'];
    
    const PENDING = 1;
    const RECEIVED = 2;
    const SHIPPED = 3;
    const DELIVERED = 4; 
    const NULLED = 5;
    const REVIEWING = 6;

    //1:N inverse relationship

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    // relationship 1:1 

    public function bankTransfer(): HasOne {
        return $this->hasOne(BankTranfer::class);
    }
}
