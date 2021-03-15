<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//working with storage
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Detail;

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
    public static  function  ProductImageDestroy($image_id){
        $image = productimages::find($image_id);
        unlink(public_path('storage/'.$image->image_path));
        $image->delete();
    }
}
