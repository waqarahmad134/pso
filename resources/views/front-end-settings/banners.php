@extends('welcome')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Banners</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Banners</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Add New Vehicle</button>
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
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $da)
                                        <tr>
                                        </tr>
                                        @endforeach
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
    <!-- Vertically centered -->
    
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="uploadform" method="POST" enctype="multipart/form-data" >
            @csrf
        <div class="modal-content" style="width:200%;padding:10%">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Update Vehicle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <input id="id">
                        <label>Name</label>
                        <input id="names" name="names" type="text" class="form-control">
                        <img width="100px" src="" id="my_image">
                        <label>Image (256x256)</label>
                        <input class="dropify" id="images" name="images" type="file" class="form-control"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" onclick="update_vec()">Update</button>
            </div>
        </div>
    </div>
</div>
    
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="imageUploadForm" method="POST" enctype="multipart/form-data" >
            @csrf
        <div class="modal-content" style="width:200%;padding:10%">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Vehicle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <label>Name</label>
                        <input id="name" name="name" type="text" class="form-control">
                        <label>Image (256x256)</label>
                        <input class="dropify" id="ImageBrowse" name="image" type="file" class="form-control"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Vehicle</button>
            </div>
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


@endsection