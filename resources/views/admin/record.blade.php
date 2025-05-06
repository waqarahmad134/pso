@extends('welcome')
@section('content')

    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                 <div class="col-md-6 col-sm-12">
                     <h2>Add Daily Record</h2>
                 </div>
             </div> 
         </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                                <h2>General Information</h2>
                        </div>
                        <form method="POST" action="{{ route('add_admins') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <label>Date</label>
                                        <input name="date" type="date" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <label>Shift</label>
                                        <select name="shift" class="form-control" required>
                                            <option value="">-- Select Shift --</option>
                                            <option value="Day">Day</option>
                                            <option value="Night">Night</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <label>Cashier</label>
                                        <select name="cashier_id" class="form-control" required>
                                            <option value="">-- Select Cashier (Customer) --</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->email }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6 col-lg-6">
                                        <label>DIP Petrol</label>
                                        <select name="shift" class="form-control" required>
                                            <option value="">-- Select --</option>
                                            <option value="100">100</option>
                                            <option value="200">200</option>
                                            <option value="300">300</option>
                                            <option value="400">400</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label>DIP Diesel</label>
                                        <select name="shift" class="form-control" required>
                                            <option value="">-- Select --</option>
                                            <option value="100">100</option>
                                            <option value="200">200</option>
                                            <option value="300">300</option>
                                            <option value="400">400</option>
                                        </select>
                                    </div>
                                  
                                </div>
                                <div class="header p-0 mt-4">
                                    <h2>Sales Information</h2>
                                </div>
                                

                                @foreach($fuelTypes as $fuelType)
                                    <h4>{{ $fuelType->name }}</h4>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Fuel Type</th>
                                                <th>Machine</th>
                                                <th>Last Reading</th>
                                                <th>Today Reading</th>
                                                <th>Today Sales</th>
                                                <th>Total Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($machines->where('fuel_type_id', $fuelType->id) as $machine)
                                                <tr>
                                                    <td >{{ $fuelType->name }}</td>
                                                    <td>{{ $machine->name }}</td>
                                                    <td>{{ $machine->last_reading ?? 'N/A' }} LTR</td>
                                                    <td><input class="form-control" type="number" name="today_reading[{{ $machine->id }}]"></td>
                                                    <td id="todaySales_{{ $machine->id }}"></td>
                                                    <td id="totalAmount_{{ $machine->id }}"></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5" class="text-right font-weight-bold">Total {{ $fuelType->name }} Amount:</td>
                                                <td id="totalFuelAmount_{{ $fuelType->id }}" class="font-weight-bold"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                @endforeach

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Sub Product</th>
                                            <th>Sale Price (PKR)</th>
                                            <th>Inventory (LTR)</th>
                                            <th>Quantity</th>
                                            <th>Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mobilOils as $mobilOil)
                                            <tr>
                                                <td>Mobil Oil</td>
                                                <td>{{ $mobilOil->name }}</td>
                                                <td>PKR {{ number_format($mobilOil->saleprice, 2) }}</td>
                                                <td>{{ $mobilOil->inventory }}</td>
                                                <td>
                                                    <input class="form-control" type="number"
                                                        name="quantity[{{ $mobilOil->id }}]"
                                                        min="0"
                                                        max="{{ $mobilOil->inventory }}"
                                                        oninput="this.value = Math.min(this.value, this.max)">
                                                </td>                                                
                                                <td id="mobilTotalAmount_{{ $mobilOil->id }}"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-right font-weight-bold">Total Mobil Oil Amount:</td>
                                            <td id="totalMobilOilAmount" class="font-weight-bold"></td>
                                        </tr>
                                    </tfoot>
                                </table>


                                <input type="submit" class="btn mt-3 mb-3 float-right" style="background-color: #002E63; color: white;" value="Add Record" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>

    $(document).ready(function () {
        var totalFuelAmount = 0;
        $('input[name^="today_reading"]').on('input', function () {
            var machineId = $(this).attr('name').match(/\d+/)[0];
            var lastReading = parseFloat($(this).closest('tr').find('td:nth-child(3)').text()) || 0;
            var todayReading = parseFloat($(this).val()) || 0;
            if (todayReading > lastReading) {
                alert('Today Reading cannot be larger than Last Reading.');
                $(this).val(''); 
                $('#todaySales_' + machineId).text(''); 
                $('#totalAmount_' + machineId).text('');
                return; 
            }

           var todaySales = lastReading - todayReading;
           $('#todaySales_' + machineId).text(todaySales.toFixed(2) + ' LTR'); 
            var fuelTypePrice = {{ $fuelTypes->first()->price ?? 0 }};
            var totalAmount = todaySales * fuelTypePrice;
            $('#totalAmount_' + machineId).text('PKR ' + totalAmount.toFixed(2));
            let total = 0;
            row.closest('tbody').find('tr').each(function () {
                const val = $(this).find('td:last').text().replace(/[^\d.]/g, '');
                total += parseFloat(val) || 0;
            });
            $('#totalFuelAmount_' + fuelTypeId).text('PKR ' + total.toFixed(2));
        });
    });

    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quantityInputs = document.querySelectorAll('input[name^="quantity["]');
        let totalAll = 0;

        quantityInputs.forEach(input => {
            input.addEventListener('input', function () {
                const id = this.name.match(/\d+/)[0]; // Extract mobilOil ID
                const quantity = parseInt(this.value) || 0;
                const row = this.closest('tr');

                const inventoryCell = row.children[3];
                const priceCell = row.children[2];
                const totalAmountCell = document.getElementById(`mobilTotalAmount_${id}`);

                const inventory = parseInt(inventoryCell.textContent) || 0;
                const priceText = priceCell.textContent.replace(/[^\d.]/g, '');
                const salePrice = parseFloat(priceText) || 0;
                console.log("🚀 ~ salePrice:", salePrice)

                const total = quantity * salePrice;
                totalAmountCell.textContent = `PKR ${total.toFixed(2)}`;
                let overall = 0;
                document.querySelectorAll('[id^="mobilTotalAmount_"]').forEach(cell => {
                    const amount = parseFloat(cell.textContent.replace(/[^\d.]/g, '')) || 0;
                    overall += amount;
                });
                document.getElementById('totalMobilOilAmount').textContent = `PKR ${overall.toFixed(2)}`;
            });
        });
    });
</script>

    
@endsection
