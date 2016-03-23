@extends('frontend.layouts.customer')

@section('content')

<div class="container">
    <div class="row row-pad">
        <div class="col-md-12">
            <div class="page-title">
                <h1>TRACK MY ORDER</h1>
                <div class="btn-wrap">
                    <a href="#" class="btn-help transition fw-medium">NEED HELP?</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php for($i=0; $i<1; $i++) { ?>
<div class="container bg-white md-p-tb-30 sm-p-tb-15 m-b-50 sm-m-b-30">
    <div class="row row-pad">
        <div class="col-md-12">
            <div class="order-block">
                <div class="order-block-titl">
                    <h3>Order Number 12345</h3>
                    <div class="date-wrap">9 / 28 / 2015 9:50AM</div>
                    <div class="invoice-wrap">
                        <span class="fw-medium">INVOICE</span>
                        <a href="#"><i class="fa fa-clipboard"></i></a>
                    </div>
                </div>
                <div class="order-block-table">
                    <div class="table-row table-titl-row">
                        <div class="table-column fw-medium">PRODUCT</div>
                        <div class="status-column fw-medium">STATUS</div>
                        <div class="reorder-column fw-medium">RE-ORDERING</div>
                    </div>
                    <div class="table-row">
                        <div class="table-column">
                            <div class="order-thumb">
                                <img src="{{ asset('frontend/img/nav-logo-img.jpg') }}" alt="thumb">
                            </div>
                            <div class="order-content xs-m-b-15">
                                <div class="order-product-titl fw-medium">Black Duplex Business Card</div>
                                <div>Job # 123453</div>
                                <div>1 set / 100 Cards</div>
                                <div>$540</div>
                            </div>
                        </div>
                        <div class="status-column xs-m-b-15">
                            <div class="status-success">
                                <div class="status">Shipped Via Fedex</div>
                                <div class="order-date">9 / 28 / 2015 9:50AM</div>
                            </div>
                        </div>
                    </div>
                    <div class="table-row">
                        <div class="table-column">
                            <div class="order-thumb">
                                <img src="{{ asset('frontend/img/nav-logo-img.jpg') }}" alt="thumb">
                            </div>
                            <div class="order-content xs-m-b-15">
                                <div class="order-product-titl fw-medium">Black Duplex Business Card</div>
                                <div>Job # 123453</div>
                                <div>$750</div>
                            </div>
                        </div>
                        <div class="status-column xs-m-b-15">
                            <div class="status-none">
                                <div class="status">Job Cancelled</div>
                                <div class="order-date">9 / 28 / 2015 9:50AM</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<div class="container">
    <div class="row">
        <div class="pagination-wrap">
            <ul class="pagination">
                <li class="paginate_button previous" id="tableWithSearch_previous">
                    <a href="#">Previous</a>
                </li>
                <li class="paginate_button active">
                    <a href="#">1</a>
                </li>
                <li class="paginate_button">
                    <a href="#">2</a>
                </li>
                <li class="paginate_button ">
                    <a href="#">3</a>
                </li>
                <li class="paginate_button next" id="tableWithSearch_next">
                    <a href="#">Next</a>
                </li>
            </ul>
        </div>
    </div>
</div>

@stop

@section('styles')
@stop

@section('scripts')
@stop