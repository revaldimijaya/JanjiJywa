<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function headerTransaction(){
        return $this->belongsTo(HeaderTransaction::class);
    }

    public function beverage(){
        return $this->belongsTo(Beverage::class);
    }

}
