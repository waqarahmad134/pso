@extends('welcome')
@section('title', 'Mobil Oils | Admin')
@section('content')

<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Mobil Oils</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Mobil Oils</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMobilOilModal">Add New Mobil Oil</button>
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
                                        <th>Name</th>
                                        <th>Sale Price</th>
                                        <th>Inventory</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mobilOils as $index => $oil)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $oil->name }}</td>
                                        <td>{{ number_format($oil->saleprice, 2) }}</td>
                                        <td>{{ $oil->inventory }}</td>
                                        <td>
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#updateMobilOilModal" onclick="populateUpdateModal('{{ $oil->id }}', '{{ $oil->name }}', '{{ $oil->sale_price }}', '{{ $oil->inventory }}')">Edit</button>
                                            <form action="{{ route('mobil_oil.delete', $oil->id) }}" method="POST" style="display:inline-block;">
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

<!-- Add Mobil Oil Modal -->
<div class="modal fade" id="addMobilOilModal" tabindex="-1" role="dialog" aria-labelledby="addMobilOilModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width:200%;padding:5%">
            <form method="POST" action="{{ route('mobil_oil.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addMobilOilModalTitle">Add Mobil Oil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control" required>

                    <label>Sale Price</label>
                    <input name="sale_price" type="number" step="0.01" class="form-control" required>

                    <label>Inventory</label>
                    <input name="inventory" type="number" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Mobil Oil</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Mobil Oil Modal -->
<div class="modal fade" id="updateMobilOilModal" tabindex="-1" role="dialog" aria-labelledby="updateMobilOilModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width:200%;padding:5%">
            <form method="POST" action="" id="updateMobilOilForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="updateMobilOilModalTitle">Update Mobil Oil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control" required id="editOilName">

                    <label>Sale Price</label>
                    <input name="sale_price" type="number" step="0.01" class="form-control" required id="editOilPrice">

                    <label>Inventory</label>
                    <input name="inventory" type="number" class="form-control" required id="editOilInventory">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Mobil Oil</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function populateUpdateModal(id, name, saleprice, inventory) {
        $('#editOilName').val(name);
        $('#editOilPrice').val(saleprice);
        $('#editOilInventory').val(inventory);
        $('#updateMobilOilForm').attr('action', '{{ route("mobil_oil.update", "") }}/' + id);
    }
</script>

@endsection
