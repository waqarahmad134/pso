@extends('welcome')
@section('content')

    <div id="main-content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Payment Requests</h2>
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
                                        <th>Serial #</th>
                                        <th>ID</th>
                                        <th>Request By</th>
                                        <th>Amount ($)</th>
                                        <th>Status</th>
                                        <th>Requested At</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count=1; ?>
                                        @foreach($data as $da)
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>{{$da->driverId}}</td>
                                            <td>{{$da->requestedBy}}</td>
                                            <td>{{$da->amount}}</td>
                                            <td>{{$da->status}}</td>
                                            <td>{{date('d,M Y h:i:s',strtotime($da->requestedAt))}}</td>
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
