@extends('website.layouts.app')
@section('maindivid')
    id="homevehicle"
@endsection
@section('searchbox')
    aaaaas
@endsection
@section('content')
<div class="container">
    <h1 class="container_heading">Experts</h1>
    <div class="row scrollspy">
        @foreach($users as $user)
        <div class="col s12 l4" >
            <div class="image_wrap">
                <img src="/storage/{{$user->profile_photo}}" class="vehicle_image">
                <h5>{{$user->name}} {{$user->lastname}}</h5>
                <span class="tools_username">@|{{$user->username}}</span>
                <span class="tools_position">{{$user->position}}</span>
                <span class="tools_position">{{$user->country}}</span>
                <a href="{{route('expert.show',$user->username)}}" class="btnmore">More</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection


