@extends('welcome')
@section('content')


@section('title', 'Bookings |  Admin')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Bookings</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Bookings</li>
                        <li class="breadcrumb-item active">All Bookings</li>
                </ul>

                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">

                            <h2>All Bookings</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <!--<table class="table table-bordered table-hover js-basic-example dataTable table-custom">-->
                                  <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>Serial #</th>
                                        <th>Order #</th>
                                        <th>Sender Name</th>
                                        <th>Sender No</th>
                                        <th>Receiver Name</th>
                                        <th>Pickup Address</th>
                                        <th>Amount ($)</th>
                                        <th>Booking Status</th>
                                        <th>Created Date</th>
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
                                        <td>ANT{{$da->orderNum}}</td>
                                        <td>{{$da->senderName}}</td>
                                        <td>{{$da->senderPhoneNum}}</td>
                                        <td>{{$da->recieverName}}</td>
                                        <td style="white-space:normal;">{{$da->pickupAddress}}</td>
                                        <td>{{$da->amount}}</td>
                                        <td>{{$da->bookingStatus}}</td>
                                        <td>{{$da->pickupTime}}</td>
                                        <td><a href="{{route('booking_details',['id'=>$da->orderNum])}}" class="btn btn-info">View</a></td>
                                       
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

    <!-- Vertically centered -->

<!-- larg modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">View Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-4 col-lg-4">
                        <label>senderName</label>
                        <p><span id="senderName"></span></p>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <label>senderPhoneNum</label>
                        <p><span id="phone"></span></p>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <label>recieverName</label>
                        <p><span id="rname"></span></p>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <label>recieverPhoneNum</label>
                        <p><span id="rphone"></span></p>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <label>pickupAddress</label>
                        <p><span id="pickup"></span></p>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <label>dropoffAddress</label>
                        <p><span id="dropoff"></span></p>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <label>note</label>
                        <p><span id="note"></span></p>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <label>pickupTime</label>
                        <p><span id="ptime"></span></p>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <label>amount</label>
                        <p><span id="amount"></span></p>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <label>bookingStatus</label>
                        <p><span id="status"></span></p>
                    </div>
                </div>
                <h6>Packages</h6>


                <div class="body">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tab" class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>dimensions (cm3)</th>
                                        <th>weight (LBs)</th>
                                        <th>worth ($)</th>
                                        <th>category</th>
                                        <th>CreatedAt</th>
                                    </tr>
                                    </thead>
                                    <tbody>
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


<script>
    function booking_detail(e)
    {
        var value=$(e).attr("booking_id");
        console.log(value);
        
        $("#orderNum").text('')
        $("#senderName").text('');
        $("#phone").text('');
        $("#note").text('');
        $("#amount").text('');
        $("#status").text('');
        $("#rphone").text('');
        $("#rname").text('');
        $("#pickup").text('');
        $("#dropoff").text('');
        $("#ptime").text('');
        $("#tab > tbody").empty();

        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url : 'booking_detail/'+value,
            success: function (data) {
                console.log(data);
                if(data)
                {
                    $("#orderNum").text(data.data.Response.orderNum);
                    $("#senderName").text(data.data.Response.senderName);
                    $("#phone").text(data.data.Response.senderPhoneNum);
                    $("#note").text(data.data.Response.note);
                    $("#amount").text(data.data.Response.amount+'$');
                    $("#status").text(data.data.Response.bookingStatus);
                    $("#rphone").text(data.data.Response.recieverPhoneNum);
                    $("#rname").text(data.data.Response.recieverName);
                    $("#pickup").text(data.data.Response.pickupAddress);
                    $("#dropoff").text(data.data.Response.dropoffAddress);
                    $("#ptime").text(data.data.Response.pickupTime);
                    var s=1;
                        for(var i=0; i< data.data.Response.packages.length; i++) 
                    {
                        console.log(i);
                        $('#tab > tbody').append("<tr><td>"+ s++ +"</td><td>"+data.data.Response.packages[i].dimensions+"</td><td>"+data.data.Response.packages[i].weight+"</td><td>"+data.data.Response.packages[i].worth+"</td><td>"+data.data.Response.packages[i].category+"</td><td>"+data.data.Response.packages[i].createdAt+"</td></tr>");
                    }
                }
            },
            error: function() {
               
            }
        });
    }
</script>
@endsection



