@extends('welcome')
@section('content')

@section('title', 'User Management | Express Ease')

@section('content')
<div id="main-content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>User Management</h2>
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
                                        <th>Status</th>
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
                                            @if($d->status == "active")
                                                <span>Active</span>
                                            @else
                                                <span>Block</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($d->status == "active")
                                                <a href="{{ route('update_status', ['id' => $d->id]) }}" class="btn btn-danger">Block</a>
                                            @else
                                                <a href="{{ route('update_status', ['id' => $d->id]) }}" class="btn btn-success">Active</a>
                                            @endif
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
@endsection
