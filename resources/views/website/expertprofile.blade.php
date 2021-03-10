@extends('website.layouts.app')
@section('content')
        <section style="margin-top:50px;">
            <div class="row">
                <div class="col s4 profile_card">
                    <div class="center-align">
                        <img class="responsive-img circle" width="120px" height="120px" src="storage/{{$profile->profile_photo}}">

                        <h4 class="name_lastnamepart">{{$profile->name}} {{$profile->lastname}}</h4>
                        <h5 class="username_profile">{{$profile->position}}</h5>
                        <h6 class="postition"><i class="fas fa-compass location_icon"></i> {{$profile->region}} {{$profile->city}},{{$profile->country}}</h6>
                        <button class="btn waves-effect waves-light" type="submit" name="action">Follow
                            <i class="material-icons right">send</i>
                        </button>
                        <button class="btn waves-effect waves-light" type="submit" name="action">Message
                            <i class="material-icons right">send</i>
                        </button>
                        <p class="flow-text" style="font-size:16.5px;">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.

                            The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                    </div>
                </div>
                <div class="col s7">
                    <section class="gallery">
                        <div class="grid">

                            @foreach($products as $product)
                            <div class="column-xs-12 column-md-4">
                                <figure class="img-container">
                                    <?php $image = App\Models\Product::ProductImagesFirst($product->id)?>
                                    <a href="#img{{$image->id}}">
                                        <img class="red" src="storage/products/{{$product->id}}/{{$image->image_path}}" />
                                    </a>
                                    <a href="#_" class="lightbox" id="img{{$image->id}}">
                                        <div class="clicked_image">
                                            <img src="storage/products/{{$product->id}}/{{$image->image_path}}">
                                            <p class="flow-text img_clicked" style="font-size:16.5px;color:aliceblue;">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                            <button class="waves-effect waves-light btn"  onclick="window.location.href='{{route('product.show',['id'=>$product->id,'name'=>$product->name])}}'">Button</button>
                                        </div>

                                    </a>

                                    <div class="content-details">
                                        <h3 class="content-title">{{$product->name}}</h3>
                                        <p class="content-text">{{$product->title}}</p>
                                    </div>
                                </figure>
                            </div>
                            @endforeach
                        </div>
                    </section>
                </div>

            </div>
        </section>
@endsection


