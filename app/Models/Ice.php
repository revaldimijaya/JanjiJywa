<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ice extends Model
{
    use HasFactory;

    public function carts(){
        return $this->hasMany(Cart::class);
    }

    public function detailTransactions(){
        return $this->hasMany(DetailTransaction::class);
    }
}
