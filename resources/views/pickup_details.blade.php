@extends('welcome')
@section('content')

    <div id="main-content">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <!--<a href="assets/images/Store Details.xlsx" class="btn mb-3" download style="background-color: gray; color: white;">Excel</a>-->
                        <h5 class="card-title">Users</h5>
                        <div class="table-responsive">

                            <table id="zero-conf" class="display" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                        <tr>
                                            <td>123</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><a href="#" class="btn btn-primary"></a></td>


                                            <td>
                                                <div style="display: flex;">
                                                    <a onclick="" driverid="" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary"><i class="fas fa-eye"></i></a>


                                                </div>

                                            </td>
                                        </tr>




                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Pickup Details</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" method="post" novalidate>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Pickup Address</label>
                                            <input type="text" class="form-control" placeholder="Enter Address">
                                        </div>

                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Add Delivery Notes (optional)</label>
                                            <textarea type="text " class="form-control" rows="6" placeholder="Add comments here...."></textarea>
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
