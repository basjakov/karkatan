@extends('website.layouts.app')
@section('maindivid')
    id="home"
@endsection
@section('content')
    <section class="video-container">
        <video src="{{asset('video/production ID_4129702 .mp4')}}" autoplay loop playsinline></video>
        <div class="callout">
            <h1>{{ __('app.home_header') }}</h1>
            <div>
                <p>{{ __('app.home_headerdesc') }}</p>
                <a class="waves-effect waves-light btn-large red lighten-2" href="https://codepen.io/DylanMacnab/pen/NjVXEe" target="_blank">{{ __('app.source') }}</a>
            </div>
        </div>

    </section>

    <div class="home_page_more">
        <div class="container_heading">
            <h2>{{__('app.Top_experts')}}</h2>
            <p>{{__('app.Top_experts_desc')}}</p>
        </div>
    </div>
    <div class="container">
        <div class="row scrollspy">
            @foreach($users as $user)
                <div class="col s12 l4" >
                    <div class="image_wrap">
                        <img src="/storage/{{$user->profile_photo}}" class="vehicle_image">
                        <h5>{{$user->name}} {{$user->lastname}}</h5>
                        <span class="tools_username">@|{{$user->username}}</span>
                        <span class="tools_position">{{$user->position}}</span>
                        <span class="tools_position">{{$user->country}}</span>
                        <a href="{{route('expert.show',$user->username)}}" class="btnmore">{{ __('app.more') }}</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="home_page_more">
            <div class="container_heading">
                <h2>{{__('app.Top_Products')}}</h2>
                <p></p>
            </div>
        </div>
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
                            <a href="{{route('product.show',['id'=>$product->id,'name'=>$product->name])}}" class="btnmore">{{ __('app.more') }}</a>
                        </div>
                    </div>
                @endforeach

            </div>
        <div class="home_page_more">
            <div class="container_heading">
                <h2>{{__('app.What_is_karkatan')}}</h2>
                <p>{{__('app.What_is_karkatan_desc')}}</p>
            </div>
        </div>
    </div>
@endsection


