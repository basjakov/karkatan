
@foreach ($products as $product )
    {{$product->name}}
    {{$product->title}}
    @foreach ($product_images as $image )
        {{$image->image_path}}
    @endforeach
    <a href="{{route('product.edit',$product->id)}}">Edit</a>
</br>
@endforeach
