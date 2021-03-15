@extends('website.layouts.app')
@section('maindivid')
    id="homevehicle"
@endsection
@section('searchbox')
    aaaaa
@endsection
@section('content')
    <div class="container">
        <h1 class="container_heading">Products</h1>
        <div class="row scrollspy">
            @foreach($products as $product)
                <div class="col s12 l4" >
                    <div class="image_wrap">
                        <?php $image = App\Models\Product::ProductImagesFirst($product->id)?>
                        <img src="storage/{{$image->image_path}}" class="vehicle_image">
                        <h5>{{$product->name}}</h5>
                        <span class="tools_username">{{$product->title}}</span>
                        <span class="tools_position"></span>
                        <span class="tools_position">{{$product->tools}}</span>
                        <a href="{{route('product.show',['id'=>$product->id,'name'=>$product->name])}}" class="btnmore">More</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection


