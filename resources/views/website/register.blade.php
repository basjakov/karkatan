@extends('website.layouts.app')
@section('content')
    <div class="row">
        <div class="col s5">
            <div class="center-align">

            </div>
        </div>
        <div class="col s6">
                    <form method="post" action="{{route('storeaccount')}}" enctype="multipart/form-data">
                        @csrf
                        @if($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>

                                @foreach($errors->all() as $error)
                                    {{ $error }}<br/>
                                @endforeach
                            </div>
                        @endif
                        <input type="text" name="name" placeholder="name">
                        <input type="text" name="lastname" placeholder="lastname">
                        <input type="text" name="username" placeholder="username">
                        <input type="text" name="email" placeholder="email">

                        <input type="password" name="password" placeholder="password">
                        <input type="text" name="position" placeholder="postition">
                        <input type="text" name="country" placeholder="country">
                        <input type="text" name="region" placeholder="region">

                        <input type="text" name="city" placeholder="city">
                        <input type="text" name="address" placeholder="address">

                        <input type="text" name="zipcode" placeholder="zipcode">
                        <input type="file" name="profile_image">
                        <textarea name="descriptionen" ></textarea>
                        <textarea name="descriptionru" ></textarea>
                        <textarea name="descriptionsp" ></textarea>
                        <textarea name="descriptionit" ></textarea>
                        <textarea name="descriptionfr" ></textarea>
                        <textarea name="descriptionarm" ></textarea>

                        <input type="submit" class="btn-large waves-effect waves-dark" value="Create account">

                    </form>
        </div>
    </div>

@endsection
