<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //Relationship 1:N
    public function products(){
        return $this->hasMany(Product::class);
    }

    //Inverse Relationship 1:N

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
