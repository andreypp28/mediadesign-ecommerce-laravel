<?php
    $order_status_list = order_status_list();
?>

@extends('admin.layouts.default')

@section('content')

<!-- Page Header -->
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">Orders</h1>
        </div>
        
        <!--<div class="col-sm-5 text-right">
            <a class="btn btn-primary" href='{{ URL::route("admin.sales.order.create") }}'>Create Order</a>    
        </div>-->
    </div>  
</div>
<!-- END Page Header -->

<!-- Page Content -->
<div class="content">
    <?php 
    $base_index = ($orders->currentPage() - 1) * $orders->count();
    $i = 0;
    ?>
    <?php foreach($orders as $o) { $i++; ?>       
    <div class="block">   
        <div class="block-content">
            {!! Form::open(array('url' => URL::route('admin.sales.order.item.assign'), 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'aform')) !!}
            <table class="table table-borderless table-order">
            <colgroup>
                <col width="60"/>
                <col width="120"/>
                <col width=""/>
                <col width=""/>
                <col width=""/>
                <col width=""/>
                <col width=""/>
                <col width="105"/>
            </colgroup>
            <tbody>
                <tr>
                    <td colspan="2"><h2>{{ $o->number() }}</h2></td>
                    <td class="text-bottom">Order Date: <?php echo date('Y-m-d', strtotime($o->created_at)); ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <a class="btn btn-info" href='#'><i class="fa fa-edit"></i></a>
                        <a class="btn btn-info" href='#'><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-middle">
                        {{ $o->billing_name }}<br/>
                        <!--{{ $o->customer_phone }}<br/>-->
                        <a href="mailto:{{ $o->billing_email }}">{{ $o->billing_email }}</a>
                    </td>
                    <td class="text-middle">
                        {{ $o->shipping_address }}<br/>
                        {{ $o->shipping_city }}, {{ $o->shipping_state }}, {{ $o->shipping_country }}, {{ $o->shipping_zipcode }}</br>
                        @if($o->shipping_phone != '')
                        {{ $o->shipping_phone }}<br/>
                        @endif
                        
                        @if($o->shipping_price > 0)
                        DELIVERY - {{ trans("shipping.fedex.$o->shipping_method") }}
                        @endif
                    </td>
                    <td></td>
                    <td colspan="2" class="text-bottom text-right">
                        <small class="text-top" style="font-size:15px; line-height:30px;">$</small>
                        <span class="text-top" style="font-size:25px;">{{ $o->total_price }}</span>
                        <label class="text-success text-bottom">{{ $o->currency }}</label>
                        <br/>

                        <small>Including shipping + Tax if is applicable</small>
                    </td>
                    <td></td>
                </tr>
                
                @foreach($o->items as $it)
                <tr>
                    <td class="text-middle"><img src="{{ asset(ImageManager::getImagePath( $it->image, 50, 50, 'fit-x' )) }}" alt=""></td>
                    <td class="text-middle"><a href='{{ URL::route("admin.sales.order.item", $it->id) }}'>{{ $it->jobNumber() }}</a></td>
                    <td class="text-middle">{{ $it->name }}</td>
                    <td class="text-middle text-center">{!! $it->status_lang(true) !!}</td>
                    <td class="text-middle">
                        @if($it->product_type != PRODUCT_DESIGN)
                        {{ $it->qty }} cards
                        @endif
                    </td>
                    <td class="text-middle text-right">{{ format_currency($it->price, $o->currency, false) }}</td>
                    <td class="text-middle">
                        {!! Form::select("job_manager[$it->id]", $stuffs, $it->job_stuff_id, array('class' => 'form-control')) !!}
                    </td>
                    <td class="text-middle">
                        <button type="submit" class="btn btn-info" name="btn-assign-job" value="{{ $it->id }}">Submit</button>
                    </td>
                </tr>
                @endforeach
                
                <tr>
                    <td colspan="5"></td>
                    <td class="text-middle text-right">Order Status</td>
                    <td class="text-middle">
                        {!! Form::select('order-status', $order_status_list, $o->status, array('class' => 'form-control')) !!}
                    </td>
                    <td class="text-middle"><button type="submit" class="btn btn-info" name="btn-change-status" value="{{ $o->id }}">Submit</button></td>
                </tr>
            </tbody>
            </table>
            {!! Form::close() !!}
        </div>
    </div>
    <?php } ?>

    @if($orders->isEmpty())
    <div class="block">   
        <div class="block-content">
            <p>There is no order.</p>
        </div>
    </div>
    @endif
    <!-- END My Block -->
    
    <div class="block"><div class="block-content"><div class="row" style="padding-bottom:15px;">
        <div class="col-sm-6">
            @if($orders->total() > 0) 
            <div class="dataTables_info" id="data-table_info" role="status" aria-live="polite">
                Showing <b>{{ $base_index + 1 }} to {{ $orders->currentPage() * $orders->count() }}</b> of <b>{{ $orders->total() }}</b> entries    
            </div>
            @endif
        </div>
        <div class="col-sm-6">
            <div class="dataTables_paginate paging_simple_numbers">
                {!! paginate_links($orders); !!}
            </div>    
        </div>
    </div></div></div>
</div>

@stop

@section('additional')
@stop

@section('styles')
<link href="{{ asset('vendor/datatables/jquery.dataTables.min.css') }}" rel="stylesheet">
@stop

@section('scripts')
@stop