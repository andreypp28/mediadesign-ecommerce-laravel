<div class="col-md-6">
    <div class="jobs-block">
        <h4 class="fw-medium">Track My Orders</h4>
        
        {!! Form::open(array('url' => URL::route("customer.home"), 'method' => 'post', 'autocomplete' => 'off')) !!}                
            {!! Form::text('job-number', Input::get('job-number'), array('class' => 'job-number-search', 'placeholder' => 'Search By Job Number')) !!}
        {!! Form::close() !!}
        
        <div class="job-list">
            @foreach($jobs as $job)
            <div class="job-item status-warning">
                <div class="job-number">{{ $job->jobNumber() }}</div>
                <div class="job-date">9 / 28 / 2015 9:50AM</div>
                <div class="clearfix"></div>
                <div class="job-name fw-medium">{{ $job->name }}</div>
                <div class="status fw-light">Waiting For Your Information / Files</div>
            </div>
            @endforeach
        </div>
        <div class="view-all-wrap">
            <a href="{{ route('customer.tracking') }}"><button class="btn btn-cons">VIEW ALL</button></a>
        </div>
    </div>
</div>