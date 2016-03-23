@extends('frontend.layouts.customer')

@section('content')

@include('frontend.customer.setting.header')

<div class="container bg-white md-p-tb-30 sm-p-tb-15 m-b-50 sm-m-b-30">
    <div class="row row-pad">
        <div class="col-md-12">
            @include('frontend.customer.setting.tabs')
            
            <div class="settings-table">
            {!! Form::open(array('url' => URL::route('customer.setting.account.post'), 'id' => 'account-form', 'method' => 'post', 'autocomplete' => 'on')) !!}
                <div class="settings-table-row">
                    <div class="left-column cell-title">PROFILE AVATAR</div>
                    <div class="right-column profile-column">
                        <img src="{{ asset('frontend/img/login-tb.jpg') }}" alt="avatar">
                        <div class="update-profile-but-wrap">
                            <a href="#" class="update-profile-but">UPDATE PROFILE AVATAR</a>
                        </div>
                    </div>
                </div>
                <div class="settings-table-row">
                    <div class="left-column cell-title">FIRST NAME</div>
                    <div class="right-column">
                        {!! Form::text('first-name', $current_customer->first_name, array()) !!}
                    </div>
                </div>
                <div class="settings-table-row">
                    <div class="left-column cell-title">LAST NAME</div>
                    <div class="right-column">
                        {!! Form::text('last-name', $current_customer->last_name, array()) !!}
                    </div>
                </div>
                <div class="settings-table-row">
                    <div class="left-column cell-title">EMAIL</div>
                    <div class="right-column">
                        {!! Form::email('email', $current_customer->email, array()) !!}
                    </div>
                </div>
                <div class="settings-table-row">
                    <div class="left-column cell-title">COMPANY NAME</div>
                    <div class="right-column">
                        {!! Form::text('company', $current_customer->company, array()) !!}
                    </div>
                </div>
                <div class="settings-table-row">
                    <div class="left-column cell-title">PHONE NUMBER</div>
                    <div class="right-column">
                        {!! Form::text('phone', $current_customer->phone, array()) !!}
                    </div>
                </div>
                <div class="settings-table-row settings-newsletter-row">
                    <div class="left-column cell-title">NEWSLETTER</div>
                    <div class="right-column">
                        <?php $checked = $current_customer->is_subscribed == YES ? true : false; ?>
                        {!! Form::checkbox('newsletter', 1, $checked, array('class' => 'switchery js-check-change')) !!}
                        <span class="js-check-change-field">SUBSCRIBED</span>
                    </div>
                </div>
                <div class="settings-table-row">
                    <div class="left-column"></div>
                    <div class="right-column text-right">
                        <button type="submit" class="save-changes-but">SAVE CHANGE</button>
                    </div>
                </div>
            {!! Form::close() !!}
            </div>
            
        </div>
    </div>
</div>

@stop

@section('styles')
<link href="{{ asset('vendor/switchery/css/switchery.min.css') }}" rel="stylesheet" />
@stop

@section('scripts')
<script src="{{ asset('vendor/switchery/js/switchery.min.js') }}"></script>
<script>
    var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
    elems.forEach(function(html) {
        var switchery = new Switchery(html, {
            color: '#10CFBD'
        });
    });
    var changeCheckbox = document.querySelector('.js-check-change');
    var changeField = document.querySelector('.js-check-change-field');

    changeCheckbox.onchange = function() {
        if ($('.js-check-change').is(":checked")) {
            changeField.innerHTML = 'SUBSCRIBED';
        } else {
            changeField.innerHTML = 'UNSUBSCRIBED';
        }
    };
</script>
@stop