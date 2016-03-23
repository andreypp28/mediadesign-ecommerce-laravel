@extends('frontend.layouts.customer')

@section('content')

@include('frontend.customer.setting.header')

<div class="container bg-white md-p-tb-30 sm-p-tb-15 m-b-50 sm-m-b-30">
    <div class="row row-pad">
        <div class="col-md-12">
            @include('frontend.customer.setting.tabs')
           
           <div class="fw-medium m-b-25">ADD NEW SHIPPING ADDRESS</div>
            <div class="settings-table">
            {!! Form::open(array('url' => URL::route('customer.setting.shipping.post'), 'id' => 'password-form', 'method' => 'post', 'autocomplete' => 'on')) !!}
                
            {!! Form::close() !!}
            </div>
            
        </div>
    </div>
</div>

@stop

@section('styles')
@stop

@section('scripts')
@stop