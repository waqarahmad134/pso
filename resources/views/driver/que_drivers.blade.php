@extends('welcome')
@section('content')

<script src="assets/bundles/knob.bundle.js"></script>

    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Driver Waiting Approval</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('homess')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Driver</li>
                        <li class="breadcrumb-item active">Que Drivers</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <a href="{{route('list_drivers')}}" class="btn btn-info mb-3"><i class="fa fa-arrow-left"></i>&nbsp; Back</a>
                            <h2>Que Drivers</h2>
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
                                            <th>Serial No</th>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Created at</th>
                                            <th>Status</th>
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
                                        <td>{{$d->phoneNum}}</td>
                                        <td>{{$d->email}}</td>
                                        <td>{{date('d,M Y h:i:s',strtotime($d->createdAt))}}</td>
                                        <td>
                                            <a href="{{route('active_que_driver',['id'=>$d->id])}}" class="btn" style="background-color: #002E63; color: white;">Active</a>
                                        </td>
                                        <td>
                                            <a href="{{route('waiting_drivers_details',['id'=>$d->id])}}" class="btn btn-info">Details</a>
                                            <!--<button class="btn fa fa-eye" data-toggle="modal" data-target=".bd-example-modal-lg" style="background-color: #002E63; color: white;"></button>-->
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

    <script>
        $(function() {
            $('.knob').knob({
                draw: function() {}
            });
        });
    </script>

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
                            <h4 class="mb-0"><strong>Driver Name</strong></h4>
                            {{-- <span>San Francisco</span> --}}
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <small class="text-muted">Mobile: </small>
                                <p>+923001234567</p>
                                <hr>
                                <small class="text-muted">total orders</small>
                                <p>10</p>
                                <hr>
                                <small class="text-muted">week earnings</small>
                                <p>$100</p>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <small class="text-muted">Email: </small>
                                <p>michael@gmail.com</p>
                                <hr>
                                <small class="text-muted">total earnings</small>
                                <p>$5000</p>
                                <hr>
                                <small class="text-muted">previous month earnings</small>
                                <p>$2500</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
