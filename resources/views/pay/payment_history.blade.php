@extends('welcome')
@section('content')


@section('title', 'Payment History |  Admin')
    <div id="main-content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Payment History</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                    <thead>
                                        <tr>
                                            <th>Serial No </th>
                                            <th>Transaction Id </th>
                                            <th>Driver ID</th>
                                            <th>Driver Name</th>
                                            <th>Status</th>
                                            <th>Amount ($)</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        <?php $count=1; ?>
                                        @foreach($data as $da)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{$da->transactionId}}</td>
                                                <td>{{$da->driverId}}</td>
                                                <td>{{$da->requestedBy}}</td>
                                                <td>{{$da->status}}</td>
                                                <td>{{$da->amount}}</td>
                                                <td>{{date('d,M Y h:i:s',strtotime($da->at))}}</td>
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
