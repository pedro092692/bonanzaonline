<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Product extends Model
{
    use HasFactory;

    const DRAFT = 2;
    const PUBLISHED = 1;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //accessors

    public function getStockAttribute(){
        if($this->subcategory->size){
            return ColorSize::whereHas('size.product', function(Builder $query){
                $query->where('id', $this->id);
            })->sum('quantity');
        }elseif($this->subcategory->color){
            return ColorProduct::whereHas('product', function(Builder $query){
                $query->where('id', $this->id);
            })->sum('quantity');
        }elseif($this->subcategory->weight){
            return ProductWeight::whereHas('product', function(Builder $query){
                $query->where('id', $this->id);
            })->sum('quantity');
        }else{
            return $this->quantity;
        }
    }

    //relationship 1:N
    public function sizes(){
        return $this->hasMany(Size::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    //Inverse relationship 1:N
    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    

    //relationship N:N

    public function colors(){
        return $this->belongsToMany(Color::class)->withPivot('quantity', 'id');
    }

    public function weights(){
        return $this->belongsToMany(Weight::class)->withPivot('quantity', 'id');
    }

    //polymorphic relationship 1:N

    public function images(){
        return $this->morphMany(Image::class, "imageable");
    }

    //friendly urls
   public function getRouteKeyName()
   {
       return 'slug';
   }

}
