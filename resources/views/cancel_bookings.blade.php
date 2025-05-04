@extends('welcome')
@section('content')



@section('title', 'Cancel Bookings |  Admin')
<style>
    .modal-bg{
        background-color: #215fa6;
        color: white; 
        border-radius: 8px; 
        border-color: #215fa6;
    }
</style>

    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Cancel Bookings</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('homess')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">All Cancel Bookings</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Cancel Bookings</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                          
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>Serial #</th>
                                        <th>Cancelled by</th>
                                        <th>Cancelled by (ID) </th>
                                        <th>Cancelled by (Name)</th>
                                        <th>Booked by</th>
                                        <th>Amount ($)</th>
                                        <th>Reason of Cancel</th>
                                        <th>Notes</th>
                                        <th>Cancelled At</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count=1
                                    ?>
                                    @foreach($data->Response as $res)
                                    <tr>
                                        <td>{{$count++}}</td>
                                        <td>{{$res->cancelledBy}}</td>
                                        <td>{{$res->cancelledByUserId}}</td>
                                        <td>{{$res->cancelledByName}}</td>
                                        <td>{{$res->bookedByName}}</td>
                                        <td>{{$res->total}}</td>
                                        <td>{{$res->reason}}</td>
                                        <td>{{$res->note}}</td>
                                        <td>{{date('d,M Y h:i:s',strtotime($res->cancelledAt))}}</td>
                                        
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
                <div class="row text-center justify-content-center">
                    <div class="col-md-4 col-lg-4">
                        <div class="shadow modal-bg p-1 m-1">
                            <label>SenderName</label>
                            <p id="senderName"></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="shadow modal-bg p-1 m-1">
                            <label>SenderPhoneNum</label>
                            <p id="phone"></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="shadow modal-bg p-1 m-1">
                            <label>RecieverName</label>
                            <p id="rname"></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="shadow modal-bg p-1 m-1">
                            <label>RecieverPhoneNum</label>
                            <p id="rphone"></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="shadow modal-bg p-1 m-1">
                            <label>PickupAddress</label>
                            <p id="pickup"></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="shadow modal-bg p-1 m-1">
                            <label>DropoffAddress</label>
                            <p id="dropoff"></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="shadow modal-bg p-1 m-1">
                            <label>Note</label>
                            <p id="note"></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="shadow modal-bg p-1 m-1">
                            <label>PickupTime</label>
                            <p id="ptime"></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="shadow modal-bg p-1 m-1">
                            <label>Amount</label>
                            <p id="amount"></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="shadow modal-bg p-1 m-1">
                            <label>BookingStatus</label>
                            <p id="status"></p>
                        </div>
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



