<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLike extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'user_id',
        'ip',
    ];
    public function Product(){
        return $this->belongsTo('App\Models\Product');
    }
}
