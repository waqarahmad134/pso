@extends('welcome')
@section('content')

@section('title', 'Vehicles |  Admin')
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Vehicle</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Vehicle</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header d-flex justify-content-between align-items-center">
                        <h2>Vehicle Management</h2>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Add New Vehicle</button>

                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <!-- <th>ID</th> -->
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Base Rate($)</th>
                                        <th>Base/Mile($)</th>
                                        <th>Volume Capacity(cm3)</th>
                                        <th>Weight Capacity(Lbs)</th>
                                        <th>Status</th>
                                        <th>Created At</th>
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
                                        <!-- <td>{{$da->id}}</td> -->
                                        <td>{{$da->name}}</td>
                                        <td>
                                            <!--<img width="50px" src="https://antrak.zeeshannawaz.com/{{$da->image}}">-->
                                            <img class="img-fluid" src="{{env('BASE_URL')}}/{{$da->image}}" width="100">
                                        </td>
                                        <td>{{$da->baseRateVec}} </td>
                                        <td>{{$da->baseRateMile}} </td>
                                        <td>{{$da->VolumeCap}} </td>
                                        <td>{{$da->WeightCap}} </td>
                                        <td>
                                            @if($da->status=='true')
                                            Active
                                            @else
                                            Block
                                            @endif
                                        </td>
                                        <td>{{date('d,M Y h:i:s',strtotime($da->createdAt))}}</td>
                                        <td>
                                            <a onclick="updatee(this);" vid="{{$da->id}}" type="button" class="btn btn-warning" data-toggle="modal" data-target="#update">Update</a>
                                            <a href="{{route('vehicle_delete',['id'=>$da->id])}}" class="btn btn-info">Delete</a>
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
<!-- Vertically centered -->


<!--To Update Vehicles Info this modal is being used -->
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="update" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="uploadformm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Update Vehicle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <input name="id" hidden id="id">

                            <label>Name</label>
                            <input id="names" name="names" type="text" class="form-control" required>

                            <label>Base Rate ($)</label>
                            <input id="baserate" name="baserate" type="text" class="form-control" required>

                            <label>Base/Mile($)</label>
                            <input id="ratemile" name="ratemile" type="text" class="form-control" required>

                            <label>Volume Capacity(cm3)</label>
                            <input id="volcap" name="volcap" type="text" class="form-control" required>

                            <label>Weight Capacity(Lbs)</label>
                            <input id="wcap" name="wcap" type="text" class="form-control" required>

                            <label for="images">Image (256x256) 
                                <img width="100px" src="" class="img-fluid" id="my_image">
                            </label>
                            <input class="dropify" id="images" name="images" type="file" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--To add New Vehicle -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="addvec" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add New Vehicle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <label>Name</label>
                            <input id="name" name="name" type="text" class="form-control" required>
                            <label>Base Rate ($)</label>
                            <input id="baserates" name="baserates" type="text" class="form-control" required>
                            <label>BaseRate/Mile ($)</label>
                            <input id="ratemiles" name="ratemiles" type="text" class="form-control" required>
                            <label>Volume Capacity (cm3)</label>
                            <input id="volcaps" name="volcaps" type="text" class="form-control" required>
                            <label>Weight Capacity (Lbs)</label>
                            <input id="wcaps" name="wcaps" type="text" class="form-control" required>
                            <label for="ImageBrowse">Image (256x256)</label>
                            <input class="dropify" id="ImageBrowse" name="image" type="file" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Vehicle</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="formular">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert alert-block alert-danger">
                    <h4>Error !</h4>
                    Vechile Name already exists!
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function updatee(e) {
        console.log(e);
        $("#names").val('updating...');
        $('#my_image').attr('src', 'updating...');

        vid = $(e).attr('vid');
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: 'vec_detail/' + vid,
            success: function(data) {
                console.log(data);
                $("#names").val(data.Response.name);
                $("#baserate").val(data.Response.baseRateVec);
                $("#ratemile").val(data.Response.baseRateMile);
                $("#volcap").val(data.Response.VolumeCap);
                $("#wcap").val(data.Response.WeightCap);
                $("#id").val(data.Response.id);
                $('#my_image').attr('src', 'https://antrak.zeeshannawaz.com/' + data.Response.image);
                //   $("#images").val(data.Response.image);

            },
            error: function() {
                console.log('data');
            }
        });
    }



    $(document).ready(function(e) {

        $('#addvec').on('submit', (function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $('#addvec button[type="submit"]').prop('disabled', true);
            $.ajax({
                type: 'POST',
                url: "{{route('add_vecs')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response.ResponseCode == 1) {
                        toastr.info('Vehicle Added Sucessfully', 'Info');
                        location.reload();
                    }
                    if (response.ResponseCode == 0) {
                        toastr.error(response.message, 'Error');
                        //   $("#formular").modal('show');
                    }
                },
                error: function(data) {
                    console.log("error");
                    console.log(data);
                }
            });

        }));


        $('#uploadformm').on('submit', (function(e) {
            e.preventDefault();
            var formDatas = new FormData(this);
            $('#uploadformm button[type="submit"]').prop('disabled', true);
            $.ajax({
                type: 'POST',
                url: "{{route('update_vec')}}",
                data: formDatas,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response.ResponseCode == 1) {
                        toastr.info('Vehicle Updated Sucessfully', 'Info');
                        location.reload();
                    }
                    if (response.ResponseCode == 0) {
                        toastr.error(response.message, 'Error');
                    }
                },
                error: function(data) {
                    console.log("error");
                    console.log(data);
                }
            });
        }));



    });
</script>
@endsection