@extends('welcome')
@section('title', 'Shift Data | Admin')
@section('content')

<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Shift Data</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Shift Data</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <ul class="header-dropdown dropdown dropdown-animated scale-left">
                            <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Shift Type</th>
                                        <th>Cashier</th>
                                        <th>Cash in Hand</th>
                                        <th>Bank/Online</th>
                                        <th>Petrol Price</th>
                                        <th>Diesel Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($shifts as $index => $shift)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $shift->shift_date }}</td>
                                        <td>{{ ucfirst($shift->shift_type) }}</td>
                                        <td>{{ $shift->cashier->name ?? 'N/A' }}</td>
                                        <td>{{ number_format($shift->cash_in_hand, 2) }}</td>
                                        <td>{{ number_format($shift->bank_online, 2) }}</td>
                                        <td>{{ number_format($shift->petrol_price, 2) }}</td>
                                        <td>{{ number_format($shift->diesel_price, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
