<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\productimages;
use App\Http\Requests\ProductValidationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

//working with storage
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Detail;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = product::paginate(45);
        $product_id = product::select('id')->where('user_id',Auth::user()->id)->pluck('id');
        $product_images = productimages::where('product_id',$product_id)->get();
        return view('website.profile.product.allproducts',compact('products','product_images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website.profile.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductValidationRequest $request)
    {
        $product = new product();
        $product->StoreProduct($request,$product,Auth::user()->id);
        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $productimages = productimages::where('product_id',$product->id)->get();

        return view('website.product.show',compact('product','productimages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product_id = $product->select('id')->where('user_id',Auth::user()->id)->pluck('id');
        $product_images = productimages::where('product_id',$product_id)->get();

        return view('website.profile.product.edit',compact('product','product_images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Product $product)
    {

        $product->productUpdate($request,$product);
        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        $folder_path = 'storage/products/'.$product->id;

        $files = glob($folder_path.'/*');

        // Deleting all the files in the list
        foreach($files as $file) {

            if(is_file($file))

                // Delete the given file
                unlink($file);
        }
        rmdir('storage/products/'.$product->id);

        $product->delete();


        return redirect('/dashboard')->with('success', 'Product deleted!');
    }
    public function DestroyImage($id){
        productimages::ProductImageDestroy($id);
        return redirect()->back();
    }
}
