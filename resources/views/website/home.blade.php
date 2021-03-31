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
@endsection


