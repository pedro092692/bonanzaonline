<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Weight extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'factor'];

    //relationship N:N

    public function products(){
        return $this->BelongsTo(Product::class);
    }
}
