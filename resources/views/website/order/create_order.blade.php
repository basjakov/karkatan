@extends('website.layouts.app')
@section('content')

    <div class="row">
        <div class="col s6">
            <div class="center-align">
                <form method="post" action="{{route('order.offer')}}" enctype="multipart/form-data">
                    @csrf
                    <label for="project_name" class="dashboard_label">{{ __('order.project_name') }}*</label>
                    <input type="text" name="project_name" >
                    @if($errors->has('project_name'))
                        <span class="help-block text-danger">{{ $errors->first('project_name') }}</span>
                    @endif

                    <input type="hidden" name="expert_id" value="{{$expert}}">

                    <label for="title" class="dashboard_label">{{ __('order.title') }}*</label>
                    <input type="text" name="title" >
                    @if($errors->has('title'))
                        <span class="help-block text-danger">{{ $errors->first('title') }}</span>
                    @endif

                    <label for="description" class="dashboard_label">{{ __('order.description') }}*</label>
                    <textarea name="description" placeholder="{{ __('order.description')}}"></textarea>
                    @if($errors->has('description'))
                        <span class="help-block text-danger">{{ $errors->first('description') }}</span>
                    @endif
                    </br>

                    <label for="filename" class="dashboard_label">{{ __('order.filename') }}*</label>
                    <input type="file" name="filename" ></br>
                    @if($errors->has('filename'))
                        <span class="help-block text-danger">{{ $errors->first('filename') }}</span>
                    @endif
                    <br/>
                    <label for="budget" class="dashboard_label">{{ __('order.budget') }}*</label>
                    <input type="number" name="budget" >
                    @if($errors->has('budget'))
                        <span class="help-block text-danger">{{ $errors->first('budget') }}</span>
                    @endif


                    <label for="currency" class="dashboard_label">{{ __('order.currency') }}*</label>
                    <select name="currency">
                        <option selected>choose currency</option>
                        <option value="usd">USD</option>
                        <option value="eur">EUR</option>
                        <option value="rub">RUB</option>
                        <option value="amd">AMD</option>
                    </select>
                    @if($errors->has('currency'))
                        <span class="help-block text-danger">{{ $errors->first('currency') }}</span>
                    @endif

                    <label for="to" class="dashboard_label">{{ __('order.to') }}*</label>
                    <input type="date" name="to" >
                    @if($errors->has('to'))
                        <span class="help-block text-danger">{{ $errors->first('to') }}</span>
                    @endif

                    <label for="finish" class="dashboard_label">{{ __('order.finish') }}*</label>
                    <input type="date" name="finish" >
                    @if($errors->has('finish'))
                        <span class="help-block text-danger">{{ $errors->first('finish') }}</span>
                    @endif
                        </br>
                    <input type="submit" class="btn-large waves-effect waves-dark" value="{{ __('account.create_account')}}">

                </form>
            </div>
        </div>
        <div class="col s5">

        </div>
    </div>

@endsection
