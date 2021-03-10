<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->

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
                        <li><a href="{{route('products')}}">Products</a></li>
                        <li><a href="{{route('experts')}}">Experts</a></li>
                        <li><a href=""></a></li>
                        @if (!Auth::check())
                        <li><a href="{{route('login')}}">Login</a></li>
                        <li><a href="{{route('makeaccount')}}">Register</a></li>
                        @else
                            <li><a href="{{route('dashboard')}}">{{Auth::user()->username}}</a></li>
                            <li><a href="{{route('logout')}}">Logout</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <ul class="right sidenav" id="mobile-nav">
        <li><a href="{{route('products')}}">Products</a></li>
        <li><a href="{{route('experts')}}">Experts</a></li>
        <li><a href="#"></a></li>
        <li><a href="#">Login</a></li>
        <li><a href="{{route('makeaccount')}}">Register</a></li>
    </ul>

    @yield('searchbox')
</div>
@yield('content')

<script type="text/javascript" src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/materialize.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.sidenav').sidenav();
    });
</script>
@yield('js')
</body>
</html>
