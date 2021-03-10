@extends('website.layouts.app')
@section('maindivid')
    id="home"
@endsection
@section('content')
    <section class="video-container">
        <video src="{{asset('video/production ID_4129702 .mp4')}}" autoplay loop playsinline></video>
        <div class="callout">
            <h1>A background video</h1>
            <div>
                <p>Object-Fit is the CSS Background-Size: Cover for Inline Images &amp; Videos.
                    <br>It's not Microsoft friendly.</p>
                <a class="waves-effect waves-light btn-large red lighten-2" href="https://codepen.io/DylanMacnab/pen/NjVXEe" target="_blank">Source</a>
            </div>
        </div>

    </section>
@endsection


