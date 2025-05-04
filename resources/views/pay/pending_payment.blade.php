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
                                        <th>User Name</th>
                                        <th>Request ID #</th>
                                        <th>User ID</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Requested At</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $count = 1;
                                        ?>
                                        @foreach($data as $da)
                                        <tr>
                                            <td>{{$count++}}</td>
                                            <td>{{$da->requestedBy}}</td>
                                            <td>{{$da->id}}</td>
                                            <td>{{$da->userId}}</td>
                                            <td>{{$da->amount}}</td>
                                            <td>{{$da->status}}</td>
                                            <td>{{$da->requestedAt}}</td>
                                            <td>
                                                <a href="{{route('pending_payment_accept',[ 'userId'=>$da->userId, 'amount'=>$da->amount,'id'=>$da->id ] )}}" 
                                                class="btn" style="background-color: #c70032; color: white;">Pay Now</a>
                                            </td>
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
