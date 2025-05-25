@extends('welcome')
@section('title', 'Stock Testing | Admin')
@section('content')

<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Stocks</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Stock Testing</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStockModal">Add New Stock Testing</button>
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
                
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fuel</th>
                                        <th>Machine</th>
                                        <th>Litres</th>
                                        <th>Adjustment</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($testings as $index => $stock)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $stock->fuel->name }}</td>
                                        <td>{{ $stock->machine->name }}</td>
                                        <td>{{ $stock->litres }}</td>
                                        <td>{{ $stock->adjustment ? 'Yes' : 'No' }}</td>
                                        <td>{{ $stock->created_at->format('Y-m-d H:i') }}</td>
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

    <!-- Add Stock Modal -->
    <div class="modal fade" id="addStockModal" tabindex="-1" role="dialog" aria-labelledby="addStockModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="width:200%;padding:5%">
                <form method="POST" action="{{ route('stock_testing.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Stock</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        
                    <label>Fuel Type</label>
                    <select name="fuel_id" id="fuelSelect" class="form-control" required>
                        <option value="">Select Fuel</option>
                        @foreach($fuels as $fuel)
                            <option value="{{ $fuel->id }}">{{ $fuel->name }}</option>
                        @endforeach
                    </select>

                    <label>Machine</label>
                    <select name="machine_id" id="machineSelect" class="form-control" required>
                        <option value="">Select Machine</option>
                    </select>                        

                        <label>Fuel Quantity In Litres</label>
                        <input name="litres" type="number" class="form-control" required>

                       <label for="adjustment">Adjustment</label>
                       <select name="adjustment" id="adjustment" class="form-control" required>
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                       </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Stock Testing</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const machines = @json($machines);

    document.getElementById('fuelSelect').addEventListener('change', function () {
        const selectedFuelId = parseInt(this.value);
        const machineSelect = document.getElementById('machineSelect');
        machineSelect.innerHTML = '<option value="">Select Machine</option>';
        machines.forEach(machine => {
            if (parseInt(machine.fuel_id) === selectedFuelId) {
                const option = document.createElement('option');
                option.value = machine.id;
                option.text = machine.name;
                machineSelect.appendChild(option);
            }
        });
    });
</script>
@endsection
