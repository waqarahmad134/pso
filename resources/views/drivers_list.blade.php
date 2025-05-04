@extends('welcome')
@section('content')


@section('title', 'Drivers List |  Admin')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Drivers
                    </h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('homess')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Drivers</li>
                    </ul>
                    
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                        <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">Add New</button> -->
                            <h2>All Drivers</h2>
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
                                            <th>ID</th>
                                            <th>Driver ID</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count=1;
                                        ?>
                                    @foreach($data as $d)
                                    <tr>
                                        <td>{{$count++}}</td>
                                        <td>{{$d->id}}</td>
                                        <td>{{$d->name}}</td>
                                        <td>{{$d->phone}}	</td>
                                        <td>{{$d->email}}</td>
                                        <td>
                                            @if($d->status==1)
                                            <span>Active</span>
                                            @else
                                            <span>Block</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($d->status==1)
                                            <a href="{{route('block_admin',['id'=>$d->id])}}" class="btn" style="background-color: #c70032; color: white;">Block</a>
                                            @else
                                            <a href="{{route('active_admin',['id'=>$d->id])}}" class="btn" style="background-color: #002E63; color: white;">Active</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('waiting_drivers_details',['id'=>$d->id])}}" class="btn btn-info">Details</a>
                                            <!--<button onclick="detail(this)" driver_id="{{$d->id}}" class="btn fa fa-eye" data-toggle="modal" data-target=".bd-example-modal-lg" style="background-color: #002E63; color: white;"></button>-->
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

<!-- larg modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Driver Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card profile-header shadow-lg">
                    <div class="body text-center">
                        <div class="profile-image mb-3"><img src="images/user-img.png" class="rounded-circle" alt=""></div>
                        <div>
                            <h4 class="mb-0">
                                <strong>
                                    <span id="drivername"></span>
                                </strong>
                            </h4>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <small class="text-muted">Mobile: </small>
                                        <p><span id="phone"></span></p>
                                        <small class="text-muted">week earnings</small>
                                        <p>$100</p>
                                        <small class="text-muted">total earnings</small>
                                        <p>$5000</p>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <small class="text-muted">total orders</small>
                                        <p><span id="total"></span></p>
                                        <small class="text-muted">Email: </small>
                                        <p><span id="email"></span></p>
                                        <small class="text-muted">previous month earnings</small>
                                        <p>$2500</p>
                                    </div>
                                </div>
                                <div>
                                    <h6>Vehicle Name</h6>
                                    <img id="car" class="img-fluid" src="https://demo.zeeshannawaz.com/antrack_backend/public/images/vehicle-image.jpg" width="200">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <h6>Front View</h6>
                                <img id="front" class="img-fluid" src="https://demo.zeeshannawaz.com/antrack_backend/public/images/Front_View.png" width="200">
                                <h6>Back View</h6>
                                <img id="back" class="img-fluid" src="https://demo.zeeshannawaz.com/antrack_backend/public/images/Back_View.png" width="200">
                            </div>
                        </div>
                    </div><hr>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function detail(e)
    {
        var value=$(e).attr("driver_id");
        console.log(value);

        $("#drivername").text('updating....');
        $("#phone").text('updating....');
        $("#email").text('updating....');
        $("#total").text('updating....');

        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url : 'driver_detail/'+value,
            success: function (data) {
                console.log(data.data.Response.driver.firstName);
                if(data)
                {
                    console.log(data.data.Response.img.image);
                $("#drivername").text(data.data.Response.driver.firstName+' '+data.data.Response.driver.lastName);
                $("#phone").text(data.data.Response.driver.phoneNum);
                $("#email").text(data.data.Response.driver.email);
                $("#total").text(data.data.Response.driver.Bookings.length);
                $("#front").attr("src",'https://test.zeeshannawaz.com/'+data.data.Response.driver.DriverDetails[0].licFrontPhoto);
                $("#back").attr("src",'https://test.zeeshannawaz.com/'+data.data.Response.driver.DriverDetails[0].licBackPhoto);
                $("#car").attr("src",'https://test.zeeshannawaz.com/'+data.data.Response.img.image);


                }

            },
            error: function() {
                console.log(data);
            }
        });
    }
</script>


    @endsection
