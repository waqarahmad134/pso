@extends('welcome')
@section('title', 'Stock Wastage | Admin')
@section('content')

<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Stock Wastage</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Fuel Wastage</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#addWastageModal">Add Wastage</button>
                    </div>
                    <div class="container-fluid">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
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
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fuel Name</th>
                                        <th>Litres Wasted</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($wastages as $index => $wastage)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $wastage->fuel->name ?? 'N/A' }}</td>
                                        <td>{{ $wastage->litres }}</td>
                                        <td>{{ $wastage->created_at->format('Y-m-d H:i') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Add Wastage Modal -->
                    <div class="modal fade" id="addWastageModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content" style="width: 200%; padding: 5%">
                                <form method="POST" action="{{ route('stock_wastage.store') }}">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Fuel Wastage</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <label for="fuel_id">Fuel</label>
                                        <select name="fuel_id" class="form-control" required>
                                            <option value="">Select Fuel</option>
                                            @foreach($fuels as $fuel)
                                                <option value="{{ $fuel->id }}">{{ $fuel->name }}</option>
                                            @endforeach
                                        </select>

                                        <label for="litres">Litres Wasted</label>
                                        <input name="litres" type="number" step="0.01" class="form-control" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Record Wastage</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
