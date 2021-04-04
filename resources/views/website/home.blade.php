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
            <h1>Top experts</h1>
            <p>Մեր թոփ մասնագետները ընտրվում են կայքի կողմից ՝ հիմնվելով որակի և հաճախորդների կարծիքի վրա:Մեր թոփում հայտնվելու համար էքսպերտը ոչ մի հավելյալ բան չի գնում,այլ կարող է ընտրվել մի միայն կայքի կողմից իր որակին և   փորձառությանը համապատասխան:</p>
        </div>
    </div>
@endsection


