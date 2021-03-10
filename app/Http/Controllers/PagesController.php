<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\productimages;
class PagesController extends Controller
{
    public function Home(){
        return view('website.home');
    }
    public function Experts(){
        $users = User::where('status','active')->paginate(15);
        return view('website.profiles',['users'=>$users]);
    }
    public function ShowExpert($username){
        $profile = User::where('username',$username)->first();
        $products = Product::where('user_id',$profile->id)->get();
        return view('website.expertprofile',compact('profile','products'));
    }
    public function Products(){
        $products = Product::paginate(42);
        return view('website.products',compact('products'));
    }
    public function ShowProduct($product_id){
        $product = Product::Find($product_id);
        $user = User::find($product->user_id);
        $productimages = productimages::where('product_id',$product_id)->get();
        return view('website.product',['product'=>$product,'productimages'=>$productimages,'user'=>$user]);
    }
}
