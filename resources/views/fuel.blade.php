@extends('welcome')

@section('title', 'Fuels | Admin')

@section('content')
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Fuels</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homess') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Fuels</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addFuelModal">Add New Fuel</button>
                        <ul class="header-dropdown dropdown dropdown-animated scale-left">
                            <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>Serial #</th>
                                        <th>Fuel Name</th>
                                        <th>Fuel Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    @foreach($fuels as $fuel)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $fuel->name }}</td>
                                        <td>{{ $fuel->fuelType->name }}</td>
                                        <td>{{ $fuel->status == 1 ? 'Active' : 'Blocked' }}</td>
                                        <td>
                                            <button class="btn btn-info" data-toggle="modal" data-target="#updateFuelModal"
                                                onclick="populateUpdateModal('{{ $fuel->id }}', '{{ $fuel->name }}', '{{ $fuel->fuel_type_id }}', '{{ $fuel->status }}')">Edit</button>

                                            @if($fuel->status == 1)
                                                <a href="{{ route('fuel.updateStatus', ['id' => $fuel->id]) }}" class="btn btn-danger">Block</a>
                                            @else
                                                <a href="{{ route('fuel.updateStatus', ['id' => $fuel->id]) }}" class="btn btn-success">Activate</a>
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

<!-- Add Fuel Modal -->
<div class="modal fade" id="addFuelModal" tabindex="-1" role="dialog" aria-labelledby="addFuelModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width:200%;padding:5%">
            <form method="POST" action="{{ route('fuel.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Fuel</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <label>Fuel Name</label>
                    <input name="name" type="text" class="form-control" required>

                    <label>Fuel Type</label>
                    <select class="form-control" name="fuel_type_id" required>
                        <option value="">Select Fuel Type</option>
                        @foreach($fuelTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>

                    <label>Status</label>
                    <select class="form-control" name="status" required>
                        <option value="1">Active</option>
                        <option value="0">Blocked</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Fuel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Fuel Modal -->
<div class="modal fade" id="updateFuelModal" tabindex="-1" role="dialog" aria-labelledby="updateFuelModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width:200%;padding:5%">
            <form method="POST" id="updateFuelForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Update Fuel</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <label>Fuel Name</label>
                    <input name="name" type="text" class="form-control" id="editFuelName" required>

                    <label>Fuel Type</label>
                    <select class="form-control" name="fuel_type_id" id="editFuelType" required>
                        <option value="">Select Fuel Type</option>
                        @foreach($fuelTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>

                    <label>Status</label>
                    <select class="form-control" name="status" id="editFuelStatus" required>
                        <option value="1">Active</option>
                        <option value="0">Blocked</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Fuel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function populateUpdateModal(id, name, type_id, status) {
        $('#editFuelName').val(name);
        $('#editFuelType').val(type_id);
        $('#editFuelStatus').val(status);
        $('#updateFuelForm').attr('action', '/admin/fuels/' + id);
    }
</script>

@endsection
