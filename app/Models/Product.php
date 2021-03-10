<?php

namespace App\Models;

use App\Models\productimages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'likes',
        'title',
        'Description',
        'tools',
        'status',
        'category',
        'desc_seo',
        'seo_keyword',
    ];
    protected $casts = [
        'Description'=>'array',
        'tags'=>'array',
    ];
    public function StoreProduct($request,$product,$user_id){
        $validated = $request->validated();
        $description=array('en'=>$request['desc_en'],'ru'=>$request['desc_ru'],'sp'=>$request['desc_sp'],'it'=>$request['desc_it'],'arm'=>$request['desc_arm']);
        $tagitems = explode(' ',$request->tags);
        $tags = array();
        foreach($tagitems as $key=>$tagitem){
            array_push($tags,$tagitem);
        }
        $product->user_id = $user_id;
        $product->name = $validated['name'];
        $product->title = $validated['title'];
        $product->tools = $validated['tools'];
        $product->likes = 0;
        $product->video_link = $request->video_link;
        $product->tags = json_encode($tags);
        $product->status = "pending";
        $product->category = $validated['category'];
        $product->Description = json_encode($description);
        $product->desc_seo = $request->desc_seo;
        $product->seo_keyword = $request->seo_keyword;
        $product->save();
        foreach ($request->file('images') as $image) {
            $ProductImage = new productimages();

            $image->store('/products/'.$product->id, 'public');
            $path = $image->hashName();
            $ProductImage->product_id = $product->id;
            $ProductImage->image_path = '/products/'.$product->id.'/'.$path;
            $ProductImage->save();
        }
        return $product;
    }
    public function productimages(){
        return $this->hasMany('App\Models\productimages');
    }
    public function productUpdate($request,$product){
        $description=array('en'=>$request['desc_en'],'ru'=>$request['desc_ru'],'sp'=>$request['desc_sp'],'it'=>$request['desc_it'],'arm'=>$request['desc_arm']);
        $tagitems = explode(' ',$request->tags);
        $tags = array();
        foreach($tagitems as $key=>$tagitem){
            array_push($tags,$tagitem);
        }

        $product->name = $request->name;
        $product->title = $request->title;
        $product->tools = $request->tools;

        $product->video_link = $request->video_link;
        $product->tags = json_encode($tags);
        $product->category = $request->category;
        $product->Description = json_encode($description);
        $product->desc_seo = $request->desc_seo;
        $product->seo_keyword = $request->seo_keyword;
        $product->save();
        foreach ($request->file('images') as $image) {
            $ProductImage = new productimages();

            $image->store('/products/'.$product->id, 'public');
            $path = $image->hashName();
            $ProductImage->product_id = $product->id;
            $ProductImage->image_path = '/products/'.$product->id.'/'.$path;
            $ProductImage->save();
        }
        return $product;
    }
    public function ProductLike(){
        return $this->hasMany('App\Models\ProductLike');
    }

    public static function ProductImagesFirst($productid){
        return productimages::where('product_id',$productid)->first();
    }
}
