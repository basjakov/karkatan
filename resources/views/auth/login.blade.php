@extends('website.layouts.app')
@section('content')

    <div class="row">
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <div class="col s12 m8 l4 offset-m2 offset-l4">
            <div class="card">

                <div class="card-action teal lighten-1 white-text">
                    <h3>{{ __('account.Signin') }}</h3>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card-content">
                        <div class="form-field">
                            <label for="username">{{ __('account.Email') }}</label>
                            <input type="email" id="username" name="email" value="{{old('email')}}">
                        </div><br>

                        <div class="form-field">
                            <label for="password">{{ __('account.Password') }}</label>
                            <input type="password" name="password" id="password">
                        </div><br>

                        <div class="block mt-4">
                            <label for="remember_me" class="flex items-center">
                                <x-jet-checkbox id="remember_me" name="remember" />
                                <span class="ml-2 text-sm text-gray-600">{{ __('account.Rememberme') }}</span>
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('account.forgot_pass') }}
                            </a>
                        @endif
                        <div class="form-field">
                            <button class="btn-large waves-effect waves-dark" style="width:100%;"> {{ __('account.Signin') }}</button>
                        </div><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
