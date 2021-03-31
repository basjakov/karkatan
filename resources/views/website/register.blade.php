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
                        <input type="text" name="name" placeholder="{{ __('account.name')}}">
                        <input type="text" name="lastname" placeholder="{{ __('account.lastname')}}">
                        <input type="text" name="username" placeholder="{{ __('account.username')}}">
                        <input type="text" name="email" placeholder="{{ __('account.email')}}">

                        <input type="password" name="password" placeholder="{{ __('account.password')}}">
                        <input type="password"  placeholder="{{ __('account.confirmpassword')}}">

                        <input type="text" name="position" placeholder="{{ __('account.position')}}">
                        <input type="text" name="country" placeholder="{{ __('account.country')}}">
                        <input type="text" name="region" placeholder="{{ __('account.region')}}">

                        <input type="text" name="city" placeholder="{{ __('account.city')}}">
                        <input type="text" name="address" placeholder="{{ __('account.address')}}">

                        <input type="text" name="zipcode" placeholder="{{ __('account.zipcode')}}">
                        <label for="profile_image">{{ __('account.avatar')}}</label>
                        <input type="file" name="profile_image"></br>
                        <label for="description">{{ __('account.description')}}</label>
                        <textarea name="descriptionen" placeholder="{{ __('account.descriptionen')}}"></textarea>
                        <textarea name="descriptionru" placeholder="{{ __('account.descriptionru')}}"></textarea>
                        <textarea name="descriptionsp" placeholder="{{ __('account.descriptionsp')}}"></textarea>
                        <textarea name="descriptionit" placeholder="{{ __('account.descriptionit')}}"></textarea>
                        <textarea name="descriptionfr" placeholder="{{ __('account.descriptionfr')}}"></textarea>
                        <textarea name="descriptionarm" placeholder="{{ __('account.descriptionarm')}}"></textarea>

                        <input type="submit" class="btn-large waves-effect waves-dark" value="{{ __('account.create_account')}}">

                    </form>
        </div>
    </div>

@endsection
