@extends('welcome')
@section('title', 'Stocks | Admin')
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
                    <li class="breadcrumb-item">Stock Management</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStockModal">Add New Stock</button>
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
                                        <th>Stock Type</th>
                                        <th>Stock Name</th>
                                        <th>Supplier</th>
                                        <th>Quantity</th>
                                        <th>Sale Price</th>
                                        <th>Total Amount</th>
                                        <th>Paid</th>
                                        <th>Remaining</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stocks as $index => $stock)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ ucfirst($stock->stock_type) }}</td>
                                        <td>
                                            {{$stock->fuel->name ?? $stock->mobilOil->name}}
                                        </td>
                                        <td>{{ $stock->supplier->name ?? 'N/A' }}</td>
                                        <td>{{ $stock->quantity }}</td>
                                        <td>{{ number_format($stock->sale_price, 2) }}</td>
                                        <td>{{ number_format($stock->total_amount, 2) }}</td>
                                        <td>{{ number_format($stock->paid_amount, 2) }}</td>
                                        <td>{{ number_format($stock->total_amount - $stock->paid_amount, 2) }}</td>
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
                <form method="POST" action="{{ route('stock.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Stock</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <label>Stock Type</label>
                        <select name="stock_type" id="stockType" class="form-control" required onchange="updateStockNames()">
                            <option value="">Select Type</option>
                            <option value="fuel">Fuel</option>
                            <option value="mobil_oil">Mobil Oil</option>
                        </select>

                        <label>Stock Name</label>
                        <select name="stock_item_id" id="stockName" class="form-control" required>
                            <option value="">Select Stock</option>
                        </select>

                        <label>Supplier</label>
                        <select name="supplier_id" class="form-control" required>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>

                        <label>Quantity</label>
                        <input name="quantity" type="number" class="form-control" required>

                        <label>Sale Price</label>
                        <input name="sale_price" type="number" class="form-control" required>

                        <label>Total Amount</label>
                        <input name="total_amount" type="number" step="0.01" class="form-control" required>

                        <label>Paid Amount</label>
                        <input name="paid_amount" type="number" step="0.01" class="form-control" required>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Stock</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const fuelOptions = @json($fuels);
    const mobilOilOptions = @json($mobilOils);

    function updateStockNames() {
        const type = document.getElementById("stockType").value;
        const stockSelect = document.getElementById("stockName");
        stockSelect.innerHTML = '<option value="">Select Stock</option>';

        let options = [];
        if (type === "fuel") {
            options = fuelOptions;
        } else if (type === "mobil_oil") {
            options = mobilOilOptions;
        }

        options.forEach(item => {
            const option = document.createElement("option");
            option.value = item.id;
            option.text = item.name;
            stockSelect.appendChild(option);
        });
    }
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quantityInput = document.querySelector('input[name="quantity"]');
        const salePriceInput = document.querySelector('input[name="sale_price"]');
        const totalAmountInput = document.querySelector('input[name="total_amount"]');
        const paidAmountInput = document.querySelector('input[name="paid_amount"]');

        function updateTotalAmount() {
            const quantity = parseFloat(quantityInput?.value || 0);
            const salePrice = parseFloat(salePriceInput?.value || 0);

            if (!isNaN(quantity) && !isNaN(salePrice)) {
                const total = quantity * salePrice;
                totalAmountInput.value = total.toFixed(2);
                enforcePaidLimit(); // Check paid amount after total is updated
            } else {
                totalAmountInput.value = '';
            }
        }

        function enforcePaidLimit() {
            const total = parseFloat(totalAmountInput.value);
            const paid = parseFloat(paidAmountInput.value);

            if (!isNaN(total) && !isNaN(paid)) {
                if (paid > total) {
                    paidAmountInput.value = total.toFixed(2);
                }
            }
        }

        quantityInput?.addEventListener('input', updateTotalAmount);
        salePriceInput?.addEventListener('input', updateTotalAmount);
        paidAmountInput?.addEventListener('input', enforcePaidLimit);
    });
</script>


@endsection
