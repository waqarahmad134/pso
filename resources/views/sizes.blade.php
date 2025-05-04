@extends('welcome')
@section('content')

    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Size</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Size</li>
                    </ul>
                    
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
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

                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Height</th>
                                        <th>Width</th>
                                        <th>Length</th>
                                        <th>Uom</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Height</th>
                                        <th>Width</th>
                                        <th>Length</th>
                                        <th>Uom</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    <tr>
                                        <td>Large</td>
                                        <td>
                                            <img class="img-fluid" src="assets/images/large.png">
                                        </td>
                                        <td>6</td>
                                        <td>9</td>
                                        <td>33</td>
                                        <td>CM</td>
                                        <td>10</td>
                                        <td>
                                            <a href="#" class="btn" style="background-color: #002E63; color: white;">Active</a>
                                        </td>
                                        <td>
                                            <i href="#" class="btn fa fa-edit" style="background-color: #002E63; color: white;"></i>
                                        </td>
                                    </tr>
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
