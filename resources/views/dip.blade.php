@extends('welcome')

@section('title', 'Dips | Admin')

@section('content')
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Dips</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homess') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Dips</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <!-- Fuel Tabs -->
        <div class="container mb-3">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ request('fuel_id') == null ? 'active' : '' }}" href="{{ route('dip.index') }}">All</a>
                </li>
                @foreach($fuel as $f)
                <li class="nav-item">
                    <a class="nav-link {{ request('fuel_id') == $f->id ? 'active' : '' }}" href="{{ route('dip.index', ['fuel_id' => $f->id]) }}">
                        {{ $f->name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDipModal">Add New Dip</button>
                        <ul class="header-dropdown dropdown dropdown-animated scale-left">
                            <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                        </ul>
                    </div>

                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>Serial #</th>
                                        <th>Dip</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dips as $index => $dip)
                                    <tr>
                                        <td>{{ $dips->firstItem() + $index }}</td>
                                        <td>{{ $dip->name }}</td>
                                        <td>{{ $dip->status == 1 || $dip->status == 'active' ? 'Active' : 'Blocked' }}</td>
                                        <td>
                                            <button class="btn btn-info" data-toggle="modal" data-target="#updateDipModal"
                                                onclick="populateUpdateModal('{{ $dip->id }}', '{{ $dip->name }}', '{{ $dip->status }}')">Edit</button>

                                            @if($dip->status == 1 || $dip->status == 'active')
                                                <a href="{{ route('dip.updateStatus', ['id' => $dip->id]) }}" class="btn btn-danger">Block</a>
                                            @else
                                                <a href="{{ route('dip.updateStatus', ['id' => $dip->id]) }}" class="btn btn-success">Active</a>
                                            @endif

                                            <form action="{{ route('dip.delete', $dip->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center my-4">
                                {{ $dips->withQueryString()->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Dip Modal -->
<div class="modal fade" id="addDipModal" tabindex="-1" role="dialog" aria-labelledby="addDipModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width:200%;padding:5%">
            <form method="POST" action="{{ route('dip.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Dip</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <label>Dip Name</label>
                    <input name="name" type="text" class="form-control" required>

                    <label>Fuel</label>
                    <select class="form-control" name="fuel_id" required>
                        @foreach($fuel as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>

                    <label>Status</label>
                    <select class="form-control" name="status" required>
                        <option value="active">Active</option>
                        <option value="inactive">Blocked</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Dip</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Dip Modal -->
<div class="modal fade" id="updateDipModal" tabindex="-1" role="dialog" aria-labelledby="updateDipModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width:200%;padding:5%">
            <form method="POST" id="updateDipForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Update Dip</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <label>Dip Name</label>
                    <input name="name" type="text" class="form-control" id="editDipName" required>

                    <label>Status</label>
                    <select class="form-control" name="status" id="editDipStatus" required>
                        <option value="active">Active</option>
                        <option value="inactive">Blocked</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Dip</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function populateUpdateModal(id, name, status) {
        $('#editDipName').val(name);
        $('#editDipStatus').val(status);
        $('#updateDipForm').attr('action', '{{ route("dip.update", "") }}/' + id);
    }
</script>
@endsection
