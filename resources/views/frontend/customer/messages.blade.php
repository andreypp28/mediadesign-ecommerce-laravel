@extends('frontend.layouts.customer')

@section('content')

<div class="container">
    <div class="row row-pad">
        <div class="col-md-12">
            <div class="page-title">
                <h1>{{ strtoupper($current_customer->full_name()) }}, WELCOME</h1>
                <div class="btn-wrap">
                    <a href="#" class="btn-help transition fw-medium">NEED HELP?</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container bg-white md-p-tb-30 sm-p-tb-15">
    @include('frontend.customer.home.advert')
    
    <div class="row row-pad">
        @include('frontend.customer.home.tracking')
        @include('frontend.customer.home.messages')
    </div>
</div>

@stop

@section('styles')
@stop

@section('scripts')
@stop