<?php $order = $item->order; ?>

@extends('admin.layouts.default')

@section('content')

<!-- Page Header -->
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">Job Detail</h1>
        </div>
        
        <div class="col-sm-5 text-right">
            <a href="{{ my_route($list_route) }}" class="btn btn-default">Back</a>
        </div>
    </div>  
</div>
<!-- END Page Header -->

<!-- Page Content -->
<div class="content">

    <!-- My Block -->
    <div class="block">
        <div class="block-content">

            {!! Form::open(array('url' => URL::route('admin.sales.order.item.assign'), 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'aform')) !!}
            <div class="table-responsive">
                @if($item->product_type == PRODUCT_DESIGN)
                    @include('admin.sales.order.item.design')
                @else
                    @include('admin.sales.order.item.default')    
                @endif
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <!-- END My Block -->
    
</div>

@stop

@section('additional')

@stop

@section('scripts')

@stop