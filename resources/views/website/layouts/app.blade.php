<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!--Import Google Icon Font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/materialize.min.css')}}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}" />
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link href="{{asset('css/fontawesome-free-5.15.2-web/css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/fontawesome-free-5.15.2-web/css/brands.css')}}" rel="stylesheet">
    <link href="{{asset('css/fontawesome-free-5.15.2-web/css/solid.css')}}" rel="stylesheet">
    <link href="{{asset('css/gallery.css')}}" rel="stylesheet">
    <!-- <script defer src="css/fontawesome-free-5.15.2-web/js/brands.js')}}"></script>
    <script defer src="{{asset('css/fontawesome-free-5.15.2-web/js/solid.js')}}"></script>
    <script defer src="{{asset('css/fontawesome-free-5.15.2-web/js/fontawesome.js')}}"></script> -->
    @yield('css')
</head>

<body>
<div @yield('maindivid')>
    <header>

        <nav>
            <div class="container-fluid">
                <div class="nav-wrapper">
                    <a href="{{url('/')}}" class="brand-logo">Karkatan</a>

                    <a href="#" class="right sidenav-trigger" data-target="mobile-nav">
                        <i class="material-icons">menu</i>
                    </a>

                    <ul class="right hide-on-med-and-down menuitems" >
                        <li><a href="{{route('products')}}">{{ __('app.Products') }}</a></li>
                        <li><a href="{{route('experts')}}">{{ __('app.Experts') }}</a></li>
                        <li><a href=""></a></li>
                        @if (!Auth::check())
                        <li><a href="{{route('login')}}">{{ __('app.Login') }}</a></li>
                        <li><a href="{{route('makeaccount')}}">{{ __('app.Register') }}</a></li>
                        @else
                            <li><a href="{{route('dashboard')}}">{{Auth::user()->username}}</a></li>
                            <li><a href="{{route('logout')}}">{{ __('app.Logout') }}</a></li>
                        @endif
                        @php $locale = session()->get('locale'); @endphp
                        <button class='dropdown-trigger  lang_sw'  data-target='dropdown1'>
                            @switch($locale)
                                @case('en')
                                    EN
                                @break
                                @case('hy')
                                    ARM
                                @break
                            @endswitch
                        </button>

                        <!-- Dropdown Structure -->
                        <ul id='dropdown1' class='dropdown-content'>
                            <li><a href="{{route('lang','en')}}">Eng</a></li>
                            <li><a href="{{route('lang','hy')}}">Arm</a></li>
                        </ul>
                    </ul>

                </div>
            </div>
        </nav>
    </header>

    <ul class="right sidenav" id="mobile-nav">
        <li><a href="{{route('products')}}">{{ __('app.Products') }}</a></li>
        <li><a href="{{route('experts')}}">{{ __('app.Experts') }}</a></li>
        <li><a href="#"></a></li>
        <li><a href="{{route('login')}}">{{ __('app.Login') }}</a></li>
        <li><a href="{{route('makeaccount')}}">{{ __('app.Register') }}</a></li>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @php $locale = session()->get('locale'); @endphp
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        @switch($locale)
                            @case('en')
                            <img src="{{asset('img/us.png')}}"> English
                            @break
                            @case('hy')
                            <img src="{{asset('img/bn.png')}}"> Armenian
                            @break
                        @endswitch
                        <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="lang/en"><img src="{{asset('img/us.png')}}"> English</a>
                        <a class="dropdown-item" href="lang/hy"><img src="{{asset('img/bn.png')}}"> Armenian</a>

                    </div>
                </li>
            </ul>
        </div>
    </ul>

    @yield('searchbox')
</div>
@yield('content')

<script type="text/javascript" src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/materialize.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.dropdown-trigger').dropdown();
        $('.sidenav').sidenav();
        $('select').formSelect();
    });
    let el = $(".switch");
    let cur = el.find(".current");
    let options = el.find(".options li");
    let content = $("#content");

    // Open language dropdown panel

    el.on("click", function (e) {
        el.addClass("show-options");

        setTimeout(function () {
            el.addClass("anim-options");
        }, 50);

        setTimeout(function () {
            el.addClass("show-shadow");
        }, 200);
    });

    // Close language dropdown panel

    options.on("click", function (e) {
        e.stopPropagation();
        el.removeClass("anim-options");
        el.removeClass("show-shadow");

        let newLang = $(this).data("lang");

        cur.find("span").text(newLang);
        content.attr("class", newLang);

        setLang(newLang);

        options.removeClass("selected");
        $(this).addClass("selected");

        setTimeout(function () {
            el.removeClass("show-options");
        }, 600);
    });



</script>
@yield('js')
</body>
</html>
