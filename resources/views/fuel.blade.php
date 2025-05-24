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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#assignFuelModal">Assign Fuel to Machine</button>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>Serial #</th>
                                        <th>Fuel Name</th>
                                        <th>Fuel Type</th>
                                        <th>Liters</th>
                                        <th>Price</th>
                                        <th>Description</th>
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
                                        <td>{{ $fuel->liters }}</td>
                                        <td>{{ $fuel->price }}</td>
                                        <td>{{ $fuel->description }}</td>
                                        <td>{{ $fuel->status == 1 ? 'Active' : 'Blocked' }}</td>
                                        <td>
                                            <button class="btn btn-info" data-toggle="modal" data-target="#updateFuelModal"
                                                onclick="populateUpdateModal('{{ $fuel->id }}', '{{ $fuel->name }}', '{{ $fuel->fuel_type_id }}', '{{ $fuel->status }}', '{{ $fuel->price }}', '{{ $fuel->description }}')">Edit</button>

                                            @if($fuel->status == 1)
                                                <a href="{{ route('fuel.updateStatus', ['id' => $fuel->id]) }}" class="btn btn-danger">Block</a>
                                            @else
                                                <a href="{{ route('fuel.updateStatus', ['id' => $fuel->id]) }}" class="btn btn-success">Active</a>
                                            @endif
                                            <form action="{{ route('fuel.delete', $fuel->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                            </form>
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

                    <label>Price</label>
                    <input name="price" type="number" class="form-control" required>

                    <label>Description</label>
                    <textarea name="description" class="form-control" required></textarea>

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

                    <label>Price</label>
                    <input name="price" type="number" class="form-control" id="editFuelPrice" required step="0.01">

                    <label>Description</label>
                    <textarea name="description" class="form-control" id="editFuelDescription" required></textarea>

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

<!-- Assign Fuel Modal -->
<div class="modal fade" id="assignFuelModal" tabindex="-1" role="dialog" aria-labelledby="assignFuelModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width:200%;padding:5%">
            <form method="POST" action="{{ route('fuel.assign') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Assign Fuel to Machine</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <label>Fuel</label>
                    <select name="fuel_id" id="fuel_id" class="form-control">
                        <option value="">Select Fuel</option>
                        @foreach($fuels as $fuel)
                            <option value="{{ $fuel->id }}">{{ $fuel->name }}</option>
                        @endforeach
                    </select>
                    
                    <label>Machine</label>
                    <select class="form-control" name="machine_id" required>
                        <option value="">Select Machine</option>
                        @foreach($machines as $machine)
                            <option value="{{ $machine->id }}">{{ $machine->name }}</option>
                        @endforeach
                    </select>   
                    <label>Liters To Assign</label>
                    <input class="form-control" type="text" name="liters" value="{{ $fuel->liters }}">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Assign Fuel</button>
                </div>
            </form>
        </div>  
    </div>
</div>

<script>
    function populateUpdateModal(id, name, type_id, status, price, description) {
        $('#editFuelName').val(name);
        $('#editFuelType').val(type_id);
        $('#editFuelStatus').val(status = "active" ? "1" : "0");
        $('#editFuelPrice').val(price);
        $('#editFuelDescription').val(description);
        $('#updateFuelForm').attr('action', '{{ route("fuel.update", "") }}/' + id);
    }
</>

@endsection
