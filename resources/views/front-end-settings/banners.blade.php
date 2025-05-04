@extends('welcome')
@section('content')

@section('title', 'Banners |  Admin')

<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Banners</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Banner Images</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Add New Banner Items</button>
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
                                        <th>S.No</th>
                                        <th>Title</th>
                                        <th>Image</th>
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
                                        <td>{{$da->title}}</td>
                                        <td>
                                            <img src="{{env('BASE_URL')}}/{{$da->value}}" width="80" loading="lazy">
                                        </td>
                                        <td>{{date('d,M Y h:i:s',strtotime($da->createdAt))}}</td>
                                        <td><a href="{{route('delete_banner',['id'=>$da->id])}}" class="btn btn-danger btn-sm">Delete</a></td>

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

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="imageUploadForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add New</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <label>Image (256x256)</label>
                            <input class="dropify" id="ImageBrowse" name="image" type="file" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Banner</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $('#imageUploadForm').on('submit', (function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $('#imageUploadForm button[type="submit"]').prop('disabled', true);
        toastr.info('Please wait...', 'Info');

        $.ajax({
            type: 'POST',
            url: "{{route('add_banner')}}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                if (response.ResponseCode == 1) {
                    location.reload();
                    toastr.info('Banner Added Sucessfully', 'Info');
                }

                if (response.ResponseCode == 0) {
                    toastr.error('Error', 'Error');
                    // $("#formular").modal('show');
                }

            },

            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                toastr.error('Error', jqXHR);
                toastr.error('Error', textStatus);
                toastr.error('Error', errorThrown);
            }

        });
    }));
</script>
@endsection