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
                            <h2>Home</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" method="post" novalidate>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea type="text" class="form-control" placeholder="Address"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Paragraph Description</label>
                                            <textarea type="text" class="form-control" rows="9" placeholder="Paragraph Description`"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>What would you like to send?</label>
                                            <input type="text" class="form-control" placeholder="Enter">
                                        </div>
                                        <div class="form-group">
                                            <label>Select Time</label>
                                            <input type="date" class="form-control" placeholder="Enter">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Title / Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Title / Name">
                                        </div>

                                        <div class="form-group">
                                            <label>Banner</label>
                                            <input type="file" class="dropify">
                                        </div>

                                        <div class="form-group">
                                        <label class="mt-4">Pickup Date</label>
                                        <div class="input-group mb-3">
                                            <input data-provide="datepicker" data-date-autoclose="true" class="form-control">
                                        </div>
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
