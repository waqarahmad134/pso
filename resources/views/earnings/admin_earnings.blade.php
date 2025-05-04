@extends('welcome')
@section('content')


@section('title', 'Admin Earnings | Express Ease')
<style>
    .font {
        font-size: 50px !important;
        font-weight: bold;
    }

    .img {
        width: 100px !important;
    }

    .dashboard-cards {
        color: white;
        border-radius: 8px;
        height: 100%;
    }

    .card-title {
        color: #00000099 !important;
        font-size: 16px !important;
        font-weight: 500;
    }

    .card-text {
        color: #000000 !important;
        font-size: 26px !important;
        font-weight: 600;
    }
</style>
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Dashboard</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item ">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header pb-0">
                        <div class="row clearfix">
                            <div class="col-md-4 col-sm-12">
                                <h2>Admin Earnings</h2>
                            </div>
                            <form method="POST" class="col-md-8 col-sm-12 text-right" action="{{route('earning_filter')}}">
                                @csrf
                                <div class="input-daterange input-group" data-provide="datepicker">
                                    <input type="text" class="input-sm form-control mr-2" name="from" placeholder="From" autocomplete="off">
                                    <!-- <span class="input-group-addon range-to">to</span> -->
                                    <input type="text" class="input-sm form-control mr-2" name="to" placeholder="To" autocomplete="off">
                                    <button class="btn btn-success w-25" style="background: #4A006D; color:white;" type="submit">Apply Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="mb-4">
                                    <h2>Overall Earnings</h2>
                                </div>
                                <div class="row" style="row-gap: 30px;">
                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg dashboard-cards ">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h5 class="card-title">Total Earnings</h5>
                                                    </div>
                                                    <div>
                                                        <img src="{{asset('/public/1.png')}}" width="60" alt="">
                                                    </div>
                                                </div>
                                                <div>
                                                    <h4 class="card-text">$ {{$data->totalEarnings}} </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg dashboard-cards ">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h5 class="card-title">Driver Earnings</h5>
                                                    </div>
                                                    <div>
                                                        <img src="{{asset('/public/2.png')}}" width="60" alt="">
                                                    </div>
                                                </div>
                                                <div>
                                                    <h4 class="card-text">$ {{$data->totaldriverEarnings}} </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg dashboard-cards ">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h5 class="card-title">Admin Commision</h5>
                                                    </div>
                                                    <div>
                                                        <img src="{{asset('/public/3.png')}}" width="60" alt="">
                                                    </div>
                                                </div>
                                                <div>
                                                    <h4 class="card-text">$ {{$data->totalAdminCommission}} </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg dashboard-cards ">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h5 class="card-title">No. of Deliveries</h5>
                                                    </div>
                                                    <div>
                                                        <img src="{{asset('/public/4.png')}}" width="60" alt="">
                                                    </div>
                                                </div>
                                                <div>
                                                    <h4 class="card-text">{{$data->totalBookings}} </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg dashboard-cards ">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h5 class="card-title">Cancel Earnings</h5>
                                                    </div>
                                                    <div>
                                                        <img src="{{asset('/public/5.png')}}" width="60" alt="">
                                                    </div>
                                                </div>
                                                <div>
                                                    <h4 class="card-text">$ {{$data->adminEarnbyCancelTotal}} </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg dashboard-cards ">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h5 class="card-title">Driver Penalties</h5>
                                                    </div>
                                                    <div>
                                                        <img src="{{asset('/public/6.png')}}" width="60" alt="">
                                                    </div>
                                                </div>
                                                <div>
                                                    <h4 class="card-text">$ {{$data->driverPenaltyTotal}}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6>Total Earnings</h6>
                                                <img class="img" src="{{asset('public/images/7163404.png')}}">
                                                <span class="float-right font">$ {{$data->monthlyTotal}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6>Driver Earnings</h6>
                                                <img class="img" src="{{asset('public/images/6009132.png')}}">
                                                <span class="float-right font">$ {{$data->monthlyDriver}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6>Admin Commision</h6>
                                                <img class="img" src="{{asset('public/images/3142062.png')}}">
                                                <span class="float-right font">$ {{$data->monthlyAdminCommission}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6>No. of Deliveries</h6>
                                                <img class="img" src="{{asset('public/images/3063822.png')}}">
                                                <span class="float-right font">{{$data->monthlyBookings}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6>Cancel Earnings</h6>
                                                <img class="img" src="{{asset('public/images/1819863.png')}}">
                                                <span class="float-right font">$ {{$data->cancelEarningsMonthly}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6>Driver Penalties</h6>
                                                <img class="img" src="{{asset('public/images/6744366.png')}}">
                                                <span class="float-right font">$ {{$data->driverPenaltyMonthly}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="row">
                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6>Total Earnings</h6>
                                                <img class="img" src="{{asset('public/images/7163404.png')}}">
                                                <span class="float-right font">$ {{$data->weeklyTotal}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6>Driver Earnings</h6>
                                                <img class="img" src="{{asset('public/images/6009132.png')}}">
                                                <span class="float-right font">$ {{$data->weeklyDriver}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6>Admin Commission</h6>
                                                <img class="img" src="{{asset('public/images/3142062.png')}}">
                                                <span class="float-right font">$ {{$data->weeklyAdminCommission}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6>No. of Deliveries</h6>
                                                <img class="img" src="{{asset('public/images/3063822.png')}}">
                                                <span class="float-right font">{{$data->weeklyBookings}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6>Cancel Earning</h6>
                                                <img class="img" src="{{asset('public/images/1819863.png')}}">
                                                <span class="float-right font">$ {{$data->cancelEarningsWeekly}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6>Driver Penalties</h6>
                                                <img class="img" src="{{asset('public/images/6744366.png')}}">
                                                <span class="float-right font">$ {{$data->driverPenaltyWeekly}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="row">
                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6>Total Earnings</h6>
                                                <img class="img" src="{{asset('public/images/7163404.png')}}">
                                                <span class="float-right font">$ {{$data->todaysTotal}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6>Driver Earnings</h6>
                                                <img class="img" src="{{asset('public/images/6009132.png')}}">
                                                <span class="float-right font">$ {{$data->todaysDriver}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6>Admin Commission</h6>
                                                <img class="img" src="{{asset('public/images/3142062.png')}}">
                                                <span class="float-right font">$ {{$data->todaysAdminCommission}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6>No. of Deliveries</h6>
                                                <img class="img" src="{{asset('public/images/3063822.png')}}">
                                                <span class="float-right font">{{$data->todaysBookings}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6>Cancel Earnings</h6>
                                                <img class="img" src="{{asset('public/images/1819863.png')}}">
                                                <span class="float-right font">$ {{$data->cancelEarningsToday}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6>Driver Penalties</h6>
                                                <img class="img" src="{{asset('public/images/6744366.png')}}">
                                                <span class="float-right font">$ {{$data->driverPenaltyToday}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>

                        <div>
                            <h4 class="mt-3">Booking Details</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Booking Id</th>
                                            <th>Booking Total ($)</th>
                                            <th>Driver Earning ($)</th>
                                            <th>Admin Commission ($)</th>
                                            <th>Tip Amount ($)</th>
                                            <th>Customer Name</th>
                                            <th>Driver Name</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        ?>
                                        @foreach($dashboard_booking_info->details as $booking_details)
                                        <tr>
                                            <td>{{$count++}}</td>
                                            <td>{{$booking_details->bookingId}}</td>
                                            <td>{{$booking_details->bookingTotal}}</td>
                                            <td>{{$booking_details->driverEarning}}</td>
                                            <td>{{$booking_details->adminCommission}}</td>
                                            <td>{{$booking_details->tipAmount}}</td>
                                            <td>{{$booking_details->customerName}}</td>
                                            <td>{{$booking_details->driverName}}</td>
                                            <td>{{$booking_details->status}}</td>
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


<script>
    function filter() {
        console.log('tatat');
        event.preventDefault();
        from = $("input[name=from]").val();
        to = $("input[name=to]").val();

        console.log(from, to);

        $.ajax({

            url: "{{route('earning_filter')}}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                "from": from,
                "to": to,

            },
            success: function(response) {
                console.log(response);
                if (response.ResponseCode == 1) {
                    $("#adminearning").html(response.Response.totalBookings);

                }

                if (response.ResponseCode == 0) {
                    toastr.error(response.ResponseMessage, 'Error');
                }


            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
</script>


@endsection