@extends('welcome')
@section('content')

    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Form Validation</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Forms</li>
                        <li class="breadcrumb-item active">Form Validation</li>
                    </ul>
                    <a href="javascript:void(0);" class="btn btn-sm btn-primary" title="">Create New</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Let’s Start with Package Details</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" method="post" novalidate>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>What are you Sending?</label>
                                            <input type="text " class="form-control" placeholder="Enter Product">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-lg-4">
                                                <div class="form-group">
                                                    <label>Length</label>
                                                    <input type="number " class="form-control" placeholder="0.0 cm">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-4">
                                                <div class="form-group">
                                                    <label>Width</label>
                                                    <input type="number " class="form-control" placeholder="0.0 cm">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-4">
                                                <div class="form-group">
                                                    <label>Height</label>
                                                    <input type="number " class="form-control" placeholder="0.0 cm">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label>Load/ Offload</label>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                                        <label class="custom-control-label" for="customSwitch1">Lorem ipsum dolor sit amet.</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label>Insurance</label>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="customSwitch2">
                                                        <label class="custom-control-label" for="customSwitch2">Lorem ipsum dolor sit amet.</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Insurance Popup</label>
                                            <input type="text " class="form-control" placeholder="Enter Popup Detail">
                                        </div>

                                        <div class="form-group">
                                            <label>Add Delivery Notes (optional)</label>
                                            <textarea type="text " class="form-control" rows="6" placeholder="Add comments here...."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>What’s the weight of your Parcel?</label>
                                            <input type="number" class="form-control" placeholder="Enter Weight (KG)">
                                        </div>

                                        <div class="form-group">
                                            <label>Estd. Worth of Parcel</label>
                                            <input type="number" class="form-control" placeholder="0.0 $">
                                        </div>

                                        <div class="form-group">
                                            <label>Add New Package</label>
                                            <input type="file" class="dropify">
                                        </div>

                                        <div class="form-group">
                                            <label>Pickup Address</label>
                                            <input type="text" class="form-control" placeholder="Enter Address">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
