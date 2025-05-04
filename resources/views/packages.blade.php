@extends('welcome')
@section('content')

    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Packages</h2>

                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Packages</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Add New Package</button>
                            
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                    <thead>
                                    <tr>

                                        <th>ID</th>
                                        <th>Weight</th>
                                        <th>length</th>
                                        <th>width</th>
                                        <th>height</th>
                                        <th>Category</th>
                                        <th>Action</th>


                                    </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($data as $da)
                                    <tr>

                                        <td>{{$da->id}}</td>
                                        <td>{{$da->weight}}</td>
                                        <td>{{$da->length}}</td>
                                        <td>{{$da->width}}</td>
                                        <td>{{$da->height}}</td>
                                        <td>{{$da->Category->name}}</td>
                                        <td><a href="{{route('delete_package',['id'=>$da->id])}}" class="btn btn-danger btn-sm">Delete</a></td>

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
                                <div class="modal-dialog modal-lg" role="document">
                                    <form method="POST" enctype="multipart/form-data" action="{{route('add_vec')}}">
                                        @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Add Package</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-12">
                                                    <label>Name</label>
                                                    <input name="name" type="text" class="form-control">

                                                    <label>Image (256x256)</label>
                                                    <input class="dropify" id="ImageBrowse" name="image" type="file" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add Vehicle</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

@endsection
