@extends('welcome')
@section('content')

<style>
    .modal-bg {
        background-color: #215fa6;
        color: white;
        border-radius: 8px;
        border-color: #215fa6;
    }
    #main-content{
        margin-top: 72px;
    }
</style>

<div id="main-content">

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Details For Order No - ANT{{$id}}</h2>
                        <ul class="header-dropdown dropdown dropdown-animated scale-left">
                            <!--<li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>-->
                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                        </ul>
                        <a href="{{ url()->previous() }}" class="btn btn-info mt-2"><i class="fa fa-arrow-left"></i>&nbsp; Back</a>
                    </div>
                    <!-- <pre>{{json_encode($data)}}</pre>  -->
                    <div class="body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="row mt-2" style="row-gap: 20px;">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h5 style="color:#EA5F00;"><b>Sender Details</b></h5>
                                                <h6>Name: &nbsp;{{$data->senderName ?? ''}}</h6>
                                                <h6>Phone: &nbsp;{{$data->senderPhoneNum ?? ''}}</h6>
                                                <hr style="border-top: 2px solid #EA5F00 !important;">
                                                <h6>Address: &nbsp;{{$data->pickupAddress ?? ''}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h5 style="color:#EA5F00;"><b>Receiver Details</b></h5>
                                                <h6>Name: &nbsp;{{$data->recieverName ?? ''}}</h6>
                                                <h6>Phone: &nbsp;{{$data->recieverPhoneNum ?? ''}}</h6>
                                                <hr style="border-top: 2px solid #EA5F00 !important;">
                                                <h6>Address: &nbsp;{{$data->dropoffAddress ?? ''}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h5 style="color:#EA5F00;"><b>Booking Details</b></h5>
                                                <h6>Booking Status: &nbsp;{{$data->bookingStatus ?? ''}}</h6>
                                                <h6>Total Distance: &nbsp;{{$data->distance ?? ''}}</h6>
                                                <hr style="border-top: 2px solid #EA5F00 !important;">
                                                <h6>Pickup Time: &nbsp;{{$data->pickupTime ?? ''}}</h6>
                                                <!-- <h6>Rating: &nbsp;{{$data->rating ?? ''}}</h6> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h5 style="color:#EA5F00;"><b>Driver Details</b></h5>
                                                        <h6>Name: &nbsp;{{ $data->driverName ?? 'No Data Available' }}</h6>
                                                        <h6 class="p-0 m-0">Phone: &nbsp;{{$data->driverPhone ?? 'No Data Available'}}</h6>
                                                    </div>
                                                    <div>
                                                        @php
                                                        $baseUrl = env('BASE_URL');
                                                        @endphp

                                                        @if (!empty($data->driverImage))
                                                        <img src="{{ $baseUrl }}/{{ $data->driverImage }}" alt="driver" width="70">
                                                        @endif
                                                        <img src="{{asset('public/driver.jpg')}}" alt="driver" width="70">
                                                    </div>
                                                </div>
                                                <hr style="border-top: 2px solid #EA5F00 !important;">
                                                <h6>Email: &nbsp;{{$data->driverEmail ?? 'No Data Available'}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6 style="color:#EA5F00;">Total Amount</h6>
                                                <h3>{{$data->amount ?? 'No Data Available'}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6 style="color:#EA5F00;">Admin Earning</h6>
                                                <h3>{{$data->amount - $data->estEarning ?? 'No Data Available'}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6 style="color:#EA5F00;">Driver Earning</h6>
                                                <h3>{{$data->estEarning ?? 'No Data Available'}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h6 style="color:#EA5F00;">Tip</h6>
                                                <h3>{{$data->tip ?? 'No Data Available'}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-4">
                            <h4>Booking Note</h4>
                            <p>{{$data->note}}</p>
                        </div>
                    </div>
                </div>
                <div class="card shadow-lg my-4">
                    <div class="card-body">
                        <h6>Packages</h6>
                        <div class="table-responsive">
                            <table id="tab" class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Dimensions (cm3)</th>
                                        <th>Unit</th>
                                        <th>Weight (lbs)</th>
                                        <th>Worth ($)</th>
                                        <th>Category</th>
                                        <th>Total ($)</th>
                                        <th>Insurance</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $count = 1;
                                    ?>
                                    @foreach($data->packages as $da)
                                    <tr>
                                        <td>{{$count++}}</td>
                                        <td>{{$da->dimensions}}</td>
                                        <td>{{$da->unit}}</td>
                                        <td>{{$da->weight}}</td>
                                        <td>{{$da->worth}}</td>
                                        <td>{{$da->category}}</td>
                                        <td>{{$da->total}}</td>
                                        <td>{{$da->insurance == true ? "Yes":"No"}}</td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card shadow-lg my-4">
                    <div class="card-body">
                        <h6>Time Stamp</h6>
                        <div class="table-responsive">
                            <table id="tab" class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Status</th>
                                        <th>Time Stamp</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $count = 1;
                                    ?>
                                    @foreach($data->history as $da)
                                    <tr>
                                        <td>{{$count++}}</td>
                                        <td>{{$da->status}}</td>
                                        <td>{{date('d,M Y h:i:s',strtotime($da->time))}}</td>
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