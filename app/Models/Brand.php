<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    //relationship 1:N

    public function products(){
        return $this->hasMany(Product::class);
    }

    //relationship N:N

    public function categories(){
        return $this->BelongsToMany(Category::class);
    }
}
