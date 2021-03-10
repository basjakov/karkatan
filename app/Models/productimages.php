<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productimages extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'image_path',
    ];
    public function Product(){
        return $this->belongsTo('App\Models\Product');
    }
}
