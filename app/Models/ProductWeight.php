<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductWeight extends Model
{
    use HasFactory;

    protected $table = "product_weight";

    //relationship 1:N inverse 

    public function weight(){
        return $this->belongsTo(Weight::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
