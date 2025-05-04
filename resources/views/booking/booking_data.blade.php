@extends('welcome')
@section('content')

<style>
    .modal-bg{
        background-color: #9b66d5;
        color: white; 
        border-radius: 8px; 
        border-color: #215fa6;
    }
</style>

    <div id="main-content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>All Orders By User ID - {{$id}}</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                            </ul>
                            <a href="{{ route('users') }}" class="btn btn-info mt-2"><i class="fa fa-arrow-left"></i>&nbsp; Back</a>
                        </div>
                        <div class="body">
                            <div class="card shadow-lg">
                        <div class="card-body">
                            <h6>All Bookings </h6>
                            <div class="table-responsive">
                                <table id="tab" class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                    <thead>
                                        <tr>
                                            <th>Serial #</th>
                                            <th>Order Number</th>
                                            <!--<th>senderName</th>-->
                                            <th>Sender Phone Num</th>
                                            <th>Order Date</th>
                                            <th>Receiver Name</th>
                                            <th>Receiver Phone Num</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php 
                                        $count=1;
                                        ?>
                                        @foreach($data as $da)
                                        <tr>
                                            <td>{{$count++}}</td>
                                            <td>ANT{{$da->orderNumber}}</td>
                                            <td>{{$da->senderPhoneNum}}</td>
                                            <td>{{date('d,M Y h:i:s',strtotime($da->orderDate))}}</td>
                                            <td>{{$da->receiverName}}</td>
                                            <td>{{$da->receiverPhoneNum}}</td>
                                            <td><a href="{{route('booking_details',['id'=>$da->orderNumber])}}" class="btn btn-info">View</a></td>
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
        </div>
    </div>

    @endsection
