<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\productimages;
class PagesController extends Controller
{
    public function Home(){
        $users = User::where('status','top_expert')->paginate(15);
        $products = Product::where('status','top_product')->paginate(15);
        return view('website.home',compact('users','products'));
    }
    public function Experts(){
        $users = User::where('status','expert')->orwhere('status','top_expert')->paginate(15);
        return view('website.profiles',['users'=>$users]);
    }
    public function ShowExpert($username){
        $profile = User::where('username',$username)->first();
        $expert_desc = json_decode($profile->description,true);
        $products = Product::where('user_id',$profile->id)->get();
        return view('website.expertprofile',compact('profile','products','expert_desc'));
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
