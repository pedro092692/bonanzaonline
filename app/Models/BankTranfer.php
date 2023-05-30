<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankTranfer extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'reference', 'image'];

    //inverse relationship 1:1 

    public function order(): BelongsTo{
        return $this->belongsTo(Order::class);
    }
}
