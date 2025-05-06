@extends('welcome')
@section('content')

@section('title', 'Machines | Admin')

<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Machines</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Machines</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMachineModal">Add New Machine</button>
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
                                        <th>Machine Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    @foreach($machines as $machine)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $machine->name }}</td>
                                        <td>{{ $machine->status == 1 ? 'Active' : 'Blocked' }}</td>
                                        <td>
                                            @if($machine->status == 1)
                                                <a href="{{ route('machines.updateStatus', ['id' => $machine->id]) }}" class="btn btn-danger">Block</a>
                                            @else
                                                <a href="{{ route('machines.updateStatus', ['id' => $machine->id]) }}" class="btn btn-success">Activate</a>
                                            @endif
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#updateMachineModal" onclick="populateUpdateModal('{{ $machine->id }}', '{{ $machine->name }}', '{{ $machine->status }}')">Edit</button>
                                            <form action="{{ route('machines.delete', $machine->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this machine?')">Delete</button>
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

<!-- Modal to add new machine -->
<div class="modal fade" id="addMachineModal" tabindex="-1" role="dialog" aria-labelledby="addMachineModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width:200%;padding:5%">
            <form method="POST" action="{{ route('machines.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addMachineModalTitle">Add Machine</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <label>Machine Name</label>
                            <input name="name" type="text" class="form-control" required>

                            <label>Status</label>
                            <select class="form-control" name="status" required>
                                <option value="1">Active</option>
                                <option value="0">Blocked</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Machine</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Machine Modal -->
<div class="modal fade" id="updateMachineModal" tabindex="-1" role="dialog" aria-labelledby="updateMachineModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width:200%;padding:5%">
            <form method="POST" action="" enctype="multipart/form-data" id="updateMachineForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="updateMachineModalTitle">Update Machine</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <label>Machine Name</label>
                            <input name="name" type="text" class="form-control" required id="editMachineName">

                            <label>Status</label>
                            <select class="form-control" name="status" required id="editMachineStatus">
                                <option value="1">Active</option>
                                <option value="0">Blocked</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Machine</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function populateUpdateModal(id, name, status) {
        $('#editMachineName').val(name);
        $('#editMachineStatus').val(status);
        $('#updateMachineForm').attr('action', '/admin/machines/' + id);
    }
</script>

@endsection
