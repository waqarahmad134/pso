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
                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>Serial #</th>
                                        <th>Dip Name</th>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>Litres</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    @foreach($dips as $dip)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $dip->name }}</td>
                                        <td>{{ $dip->type }}</td>
                                        <td>{{ $dip->price }}</td>
                                        <td>{{ $dip->litres }}</td>
                                        <td>{{ $dip->status == 1 ? 'Active' : 'Blocked' }}</td>
                                        <td>
                                            <button class="btn btn-info" data-toggle="modal" data-target="#updateDipModal"
                                                onclick="populateUpdateModal('{{ $dip->id }}', '{{ $dip->name }}', '{{ $dip->type }}', '{{ $dip->price }}', '{{ $dip->litres }}', '{{ $dip->status }}')">Edit</button>

                                            @if($dip->status == 1)
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
                    <select  class="form-control d-none" name="fuel_id" required>
                        @foreach($fuel as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>

                    <label>Type</label>
                    <select class="form-control" name="type" required>
                        @foreach($fuel as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>

                    <label>Price</label>
                    <input name="price" type="number" class="form-control" required>

                    <label>Litres</label>
                    <input name="litres" type="number" class="form-control" required>

                    <label>Status</label>
                    <select class="form-control" name="status" required>
                        <option value="1">Active</option>
                        <option value="0">Blocked</option>
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

                    <label>Type</label>
                    <input name="type" type="text" class="form-control" id="editDipType" required>

                    <label>Price</label>
                    <input name="price" type="number" class="form-control" id="editDipPrice" required>

                    <label>Litres</label>
                    <input name="litres" type="number" class="form-control" id="editDipLitres" required>

                    <label>Status</label>
                    <select class="form-control" name="status" id="editDipStatus" required>
                        <option value="1">Active</option>
                        <option value="0">Blocked</option>
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
    document.addEventListener("DOMContentLoaded", function () {
        const typeSelect = document.querySelector('select[name="type"]');
        const fuelIdSelect = document.querySelector('select[name="fuel_id"]');

        typeSelect.addEventListener("change", function () {
            const selectedValue = this.value;
            fuelIdSelect.value = selectedValue;
        });
    });
</script>


<script>
    function populateUpdateModal(id, name, type, price, litres, status) {
        $('#editDipName').val(name);
        $('#editDipType').val(type);
        $('#editDipPrice').val(price);
        $('#editDipLitres').val(litres);
        $('#editDipStatus').val(status);
        $('#updateDipForm').attr('action', '{{ route("dip.update", "") }}/' + id);
    }
</script>

@endsection
