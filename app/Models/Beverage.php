<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beverage extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';

    public function beverageType(){
        return $this->belongsTo(BeverageType::class);
    }

    public function carts(){
        return $this->hasMany(Cart::class);
    }

    public function detailTransactions(){
        return $this->hasMany(DetailTransaction::class);
    }
}
