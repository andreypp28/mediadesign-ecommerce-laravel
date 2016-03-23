{!! Form::open(array('id' => 'billing-form', 'method' => 'post')) !!}
    <div class="col-md-7">
        <h3>Enter your billing address</h3>
        <div class="shipping-hint">If your order need to ship to multiple address, please make a note below</div>
        
        <div class="address-block-row">
            <div class="left-bl">First Name</div>
            <div class="right-bl">{!! Form::text('billing[first_name]', isset($address['first_name']) ? $address['first_name'] : '', array('id' => 'billing_first_name')) !!}</div>
        </div>
        <div class="address-block-row">
            <div class="left-bl">Last Name</div>
            <div class="right-bl">{!! Form::text('billing[last_name]', isset($address['last_name']) ? $address['last_name'] : '', array('id' => 'billing_last_name')) !!}</div>
        </div>
        <div class="address-block-row">
            <div class="left-bl">Email</div>
            <div class="right-bl">{!! Form::email('billing[email]', isset($address['email']) ? $address['email'] : '', array('id' => 'billing_email')) !!}</div>
        </div>
        
        <div class="address-block-row">
            <div class="left-bl">Country</div>
            <div class="right-bl">{!! Form::select('billing[country]', $countries, isset($address['country']) ? $address['country'] : '', array('id' => 'billing_country', 'class' => 'country require-region', 'data-target' => '#billing_state')) !!}</div>
        </div>
        <div class="address-block-row">
            <div class="left-bl">Address</div>
            <div class="right-bl">{!! Form::text('billing[address]', isset($address['address']) ? $address['address'] : '', array('id' => 'billing_address')) !!}</div>
        </div>
        <div class="address-block-row">
            <div class="left-bl">City</div>
            <div class="right-bl">{!! Form::text('billing[city]', isset($address['city']) ? $address['city'] : '', array('id' => 'billing_city')) !!}</div>
        </div>
        <div class="address-block-row">
            <div class="left-bl">State / Province</div>
            <div class="right-bl">{!! Form::select('billing[state]', $regions, isset($address['state']) ? $address['state'] : '', array('id' => 'billing_state')) !!}</div>
        </div>
        <div class="address-block-row">
            <div class="left-bl">Postal / Zip Code</div>
            <div class="right-bl">{!! Form::text('billing[zipcode]', isset($address['zipcode']) ? $address['zipcode'] : '', array('id' => 'billing_zipcode')) !!}</div>
        </div>
        <div class="address-block-row">
            <div class="left-bl">Phone Number</div>
            <div class="right-bl">{!! Form::text('billing[phone]', isset($address['phone']) ? $address['phone'] : '', array('id' => 'billing_phone')) !!}</div>
        </div>
        <div class="address-block-row">
            <div class="right-bl check-bl">
                <button type="submit" class="chekout-but lg-but">CONTINUE</button>
            </div>
        </div>
    </div>
{!! Form::close() !!}