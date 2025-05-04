@extends('welcome')
@section('content')

<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Add Business</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Table</li>
                    <li class="breadcrumb-item active">Jquery Datatable</li>
                </ul>
                <a href="javascript:void(0);" class="btn btn-sm btn-primary" title="">Create New</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Push Notifications</h2>
                    </div>
                    <div class="body">

                        <form class="row" method="POST" action="{{route('send_notifications')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Sent To</label>
                                    <select name="userCategoryId" class="form-control">
                                        <option value="">All Users & Drivers</option>
                                        @foreach ($data->Response->categories as $cat)
                                        <option value="$cat->id">{{$cat->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Title:</label>
                                    <input name="title" type="text" class="form-control" placeholder="Subject" required>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Message:</label>
                                    <textarea name="body" class="form-control" placeholder="Write your Message" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 d-flex align-items-end">
                                <button type="submit" class="btn float-right mb-3" style="background-color: #002E63; color: white;">Submit</button>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>User Type/Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->Response->notifications as $noti)
                                    <tr>
                                        <td>{{$noti->id}}</td>
                                        <td>{{$noti->title}}</td>
                                        <td>
                                            {{$noti->body}}
                                        </td>
                                        <td>
                                            {{$noti->createdAt}}
                                        </td>
                                        <td>{{$noti->UserCategory->name}}</td>
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

@endsection