@extends('welcome')
@section('content')

@section('title', 'User Management | Express Ease')

@section('content')
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>List Admin</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homess')}}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Admin</li>
                    <li class="breadcrumb-item active">List Admin</li>
                    <li class="breadcrumb-item active"><button class="btn btn-styling1 text-capitalize mt-2" onClick="printData('DivIdToPrint');">Print</button></li>
                </ul>

            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row clearfix">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger mt-2">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif  
        </div>
    </div>
    <pre>

    </pre>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header d-flex justify-content-between pb-0 mb-0">
                        <h2>User Management</h2>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">Add New Customer</button>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach($data as $key => $d)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $d->name }}</td>
                                        <td>{{ $d->contact }}</td>
                                        <td>{{ $d->email }}</td>
                                        <td>{{ date('d,M Y h:i:s', strtotime($d->created_at)) }}</td>
                                        <td>
                                           <!-- <button class="btn btn-info" onclick="seeTransactions({{ $d->transactions }})">See Transactions</button> -->
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



<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" id="myForm" action="{{route('add_user')}}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="erur" class="alert alert-danger" style="display:none;"></div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <label>First Name</label>
                            <input name="firstName" type="text" class="form-control" placeholder="Enter First Name Here" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModel()"  data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
