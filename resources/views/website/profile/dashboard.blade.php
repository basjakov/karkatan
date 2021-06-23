@extends('website.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
@endsection
@section('content')
    <div class="container">
        <div class="row scrollspy">
            <section style="margin-top:50px;">
                <div class="row">
                    <div class="col s12">
                        <div class="center-align">
                            <img class="responsive-img circle" width="120px" height="120px" src="
                            @if($user->profile_photo=='noteimage')
                                https://cdn1.iconfinder.com/data/icons/website-internet/48/website_-_male_user-512.png                    
                            @else
                                storage/{{$user->profile_photo}}                                            
                            @endif">
                            <h2 class="name_lastnamepart">{{$user->name}} {{$user->lastname}}</h2>
                            <h5 class="username_profile"></h5>
                            <a href="{{route('product.create')}}" class="btn-floating btn-large pulse"><i class="material-icons">add_circle</i></a>
                            <div class="col s12">
                               @if(isset($products))  <h2 class="container_heading">{{__('account.my_products')}}</h2> @endif
                                <div class="gallery">
                                    <div class="grid">                                                                       
                                       @if(isset($products)) 
                                            @foreach($products as $product)                                         
                                                <?php $image = App\Models\Product::ProductImagesFirst($product->id)?>
                                                <div class="column-xs-12 column-md-4">
                                                    <figure class="img-container">
                                                        <div class="popup-images">
                                                            <a class="popup-img" href="storage/{{$image->image_path}}"><img class="red" src="storage/{{$image->image_path}}" alt="aaa"></a>
                                                        </div>
                                                    </figure>
                                                    <form id="destroyproduct" method="post" action="{{route('product.destroy',$product->id)}}" >
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}

                                                    </form>
                                                    <a href="{{route('product.edit',$product->id)}}" style="margin-left:40px;" class="btn waves-effect waves-light" type="submit" name="action">{{__('account.edit')}}<i class="material-icons right">border_color</i></a>
                                                    <a data-original-title="Delete" data-toggle="tooltip" title="" class="btn waves-effect waves-light red tooltips js-ajax-delete" onclick="deleteProduct()" href="javascript:void(0);"><i class="material-icons center">delete_sweep</i></a>
                                                    <p class="flow-text" style="font-size:16.5px;">
                                                        @php $locale = session()->get('locale'); @endphp
                                                        @switch($locale)
                                                            @case('en')

                                                                    {{$product->Description['en']}}
                                                            @break
                                                            @case('arm')

                                                                    {{$product->Description['arm']}}
                                                            @break
                                                            @default
                                                                @if($locale = 'arm')
                                                                    {{$product->Description['arm']}}
                                                                @endif
                                                                @if($locale = 'en')
                                                                    {{$product->Description['en']}}
                                                                @endif
                                                            @break
                                                        @endswitch
                                                    </p>
                                                </div>
                                            @endforeach
                                        @else 
                                             {{-- <div class="column-xs-12 column-md-4"><p>{{__('account.not_product')}}</p></div> --}}
                                        @endif    
                                    </div>
                                </div>
                            </div>                           
                            <div class="container">
                                @foreach($orders as $order)

                                    @if($order->status == 'offer')
                                        <form id="acceptOffer{{$order->id}}" method="post" action="{{route('order.acceptOffer',$order->id)}}">
                                            @csrf
                                        </form>
                                        <form id="rejectOffer{{$order->id}}" action="{{route('order.reject',$order->id)}}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                    @endif
                                    @if($order->status == 'ongoing')
                                            <form id="finishtask{{$order->id}}" method="post" action="{{route('order.finishtask',$order->id)}}">
                                                @csrf
                                            </form>
                                    @endif
                                    @if($order->status =='finish')
                                            <form id="deliverytask{{$order->id}}" method="post" action="{{route('order.delivery',$order->id)}}">
                                                @csrf
                                            </form>
                                    @endif


                                        <div class="row valign-wrapper">
                                        <div class="col s10 offset-s1 valign">
                                            <div class="card blue-grey darken-1">
                                                <div class="card-content white-text">
                                                    <span class="card-title">
                                                        @if($order->status == 'offer')
                                                            <span class="offer_title" >{{__('account.offer')}}</span>
                                                        @endif
                                                        @if($order->status == 'accepted')
                                                            <span class="accepted_title" >{{$order->status}}</span>
                                                        @endif
                                                        @if($order->status == 'ongoing')
                                                            <span class="ongoing_title" >{{__('account.ongoing')}}</span>
                                                        @endif
                                                        @if($order->status == 'finish')
                                                            <span class="finish_title" >{{__('account.finished')}}</span>
                                                        @endif
                                                        @if($order->status == 'delivery')
                                                            <span class="delivery_title" >{{__('account.delivery')}}</span>
                                                        @endif
                                                        @if($order->status == 'completed')
                                                            <span class="completed_title" >{{__('account.completed')}}</span>
                                                        @endif
                                                            {{$order->project_name}}  
                                                        <span style="font-size: 16px;">{{$order->title}}</span>
                                                    </span>

                                                    <p>{{$order->description}}</p>
                                                    <span style="font-size: 26px;"><a href="{{$order->filename}}">File</a></span>
                                                    <div class="hide-on-small-only">{{__('account.to')}} : {{$order->to}}</div>
                                                    <div class="hide-on-small-only">{{__('account.finish')}} : {{$order->finish}}</div>
                                                </div>
                                                <div class="card-action">
                                                    @if($order->status == 'offer')
                                                        <a onclick="acceptOffer{{$order->id}}()" href="javascript:void(0);">{{__('account.accept')}}</a>
                                                        <a onclick="rejectOffer{{$order->id}}()" href="javascript:void(0);">{{__('account.reject')}}</a>
                                                    @endif
                                                    @if($order->status == 'ongoing')
                                                            <a onclick="finishtask{{$order->id}}()" href="javascript:void(0);">{{__('account.finished')}}</a>
                                                    @endif
                                                    @if($order->status=='finish')
                                                            <a onclick="deliverytask{{$order->id}}()" href="javascript:void(0);">{{__('account.delivery')}}</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <script type="text/javascript">
                                        @if($order->status == 'offer')
                                            function acceptOffer{{$order->id}}(){
                                                if (window.confirm("{{__('account.offer_message')}}")) {
                                                    document.getElementById("acceptOffer{{$order->id}}").submit();
                                                }
                                            }
                                            function rejectOffer{{$order->id}}(){
                                                document.getElementById("rejectOffer{{$order->id}}").submit();
                                            }
                                        @endif
                                        @if($order->status == 'ongoing')
                                            function finishtask{{$order->id}}(){
                                                if (window.confirm("{{__('account.ongoing_message')}}")) {
                                                    document.getElementById("finishtask{{$order->id}}").submit();
                                                }
                                            }
                                        @endif
                                        @if($order->status == 'finish')
                                            function deliverytask{{$order->id}}(){
                                                if (window.confirm("{{__('account.finish_message')}}")) {
                                                    document.getElementById("deliverytask{{$order->id}}").submit();
                                                }
                                            }
                                        @endif
                                    </script>
                                @endforeach
                            </div>
                            <h2>{{__('account.My_ordered_tasks')}}</h2>
                            <div class="container">
                                    @foreach($tasks as $task)
                                        @if($task->status == 'delivery')
                                            <form id="complatetask{{$task->id}}" method="post" action="{{route('order.completed',$task->id)}}">
                                                @csrf
                                            </form>
                                        @endif
                                        <div class="row valign-wrapper">
                                            <div class="col s10 offset-s1 valign">
                                                <div class="card blue-grey darken-1">
                                                    <div class="card-content white-text">
                                                        <span class="card-title">
                                                            @if($task->status == 'offer')
                                                                <span class="offer_title" >{{__('account.offer')}}</span>
                                                            @endif
                                                            @if($task->status == 'accepted')
                                                                    <span class="accepted_title" >{{$task->status}}</span>
                                                            @endif
                                                            @if($task->status == 'ongoing')
                                                                    <span class="ongoing_title" >{{__('account.ongoing')}}</span>
                                                            @endif
                                                            @if($task->status == 'finish')
                                                                <span class="finish_title" >{{__('account.finished')}}</span>
                                                            @endif
                                                            @if($task->status == 'delivery')
                                                                    <span class="delivery_title" >{{__('account.delivery')}}</span>
                                                            @endif
                                                            @if($task->status == 'completed')
                                                                    <span class="completed_title" >{{__('account.completed')}}</span>
                                                            @endif
                                                            {{$task->project_name}}   </br>
                                                            <span style="font-size: 16px;">{{$task->title}}</span>
                                                        </span>

                                                        <p>{{$task->description}}</p>
                                                        <span style="font-size: 26px;"><a href="{{$task->filename}}" target="_blank">File</a></span>
                                                        <div class="hide-on-small-only">{{__('account.to')}}: {{$task->to}}</div>
                                                        <div class="hide-on-small-only">{{__('account.finish')}}: {{$task->finish}}</div>
                                                    </div>
                                                    <div class="card-action">
                                                           @if($task->status == 'delivery')
                                                                <a onclick="complatetask{{$task->id}}()" href="javascript:void(0);">{{__("account.completed")}} </a>
                                                            @endif

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <script type="text/javascript">
                                            function complatetask{{$task->id}}(){
                                                document.getElementById("complatetask{{$task->id}}").submit();
                                            }
                                        </script>
                                    @endforeach

                            </div>
                        </div>
                    </div>

                </div>

            </section>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('js/smooth-scroll.min.js')}}"></script>
    <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('js/popup.js')}}"></script>

    <script>
        function deleteProduct(){
            document.getElementById("destroyproduct").submit();
        }

        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 3,
            slidesPerGroup: 1,
            loop: true,
            loopFillGroupWithBlank: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 1,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 50,
                },
            }
        });

    </script>

    <!-- Date Dropper Script-->
    <script>
        $('#reservation-date').dateDropper();

    </script>
    <!-- Time Dropper Script-->
    <script>
        this.$('#reservation-time').timeDropper({
            setCurrentTime: false,
            meridians: true,
            primaryColor: "#e8212a",
            borderColor: "#e8212a",
            minutesInterval: '15'
        });

    </script>

    <script>
        $(document).ready(function() {
            $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false
            });
        });

    </script>

    <script>

        $(document).ready(function(){
            $('#basicTable').DataTable({
                "aoColumnDefs": [
                    { "bSortable": false, "aTargets": [ "nosortable" ] }
                ],
                "order": []
            });
            $(function()
            {
                var $modal = $('#deleteModal');
                // runs when a user first hits a delete link
                $('.js-ajax-delete').on('click', function(e)
                {
                    // Stop anchor tag from trying to execute as a link
                    e.preventDefault();

                    // Get delete URL
                    var deleteUrl = $(this).attr('href');

                    // Show delete confirmation modal
                    $modal.modal('show');

                    // If user clicks "Yes" then submit deletion
                    $('#deleteModalConfirm').on('click', function(e)
                    {
                        // Close modal
                        $modal.modal('hide');

                        // Do delete
                        $.post(deleteUrl, {"_method" : "DELETE"}, function(response) {
                            // This is a callback. Do stuff here if you want.
                            console.log('testing');
                        });
                    });
                });
            });
        });

        $('.slick-carousel').each(function() {
            var slider = $(this);
            $(this).slick({
                infinite: true,
                dots: false,
                arrows: false,
                centerMode: true,
                centerPadding: '0'
            });

            $(this).closest('.slick-slider-area').find('.slick-prev').on("click", function() {
                slider.slick('slickPrev');
            });
            $(this).closest('.slick-slider-area').find('.slick-next').on("click", function() {
                slider.slick('slickNext');
            });
        });

    </script>
@endsection


