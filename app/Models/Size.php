<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'product_id'];

    //Inverse relationship 1:N

    public function product(){
        return $this->belongsTo(Product::class);
    }

    //relationship N:N

    public function colors(){
        return $this->belongsToMany(Color::class)->withPivot('quantity', 'id');;
    }
}
