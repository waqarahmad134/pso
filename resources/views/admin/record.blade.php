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
                        <div class="body pt-0">
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

                            <table class="table table-bordered mt-4">
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-right font-weight-bold">Grand Total:</td>
                                        <td id="grandTotalAmount" class="font-weight-bold"></td>
                                    </tr>
                                </tfoot>
                            </table>


                            <div>
                                <button  class="btn btn-primary shadow-lg" onclick="addCredit()">
                                >Add Debit/Credit</button>
                            </div>
                            <table class="table" id="debitCreditTable">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <input type="submit" class="btn mt-3 mb-3 float-right" style="background-color: #002E63; color: white;" value="Add Record" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addDebitModal" tabindex="-1" aria-labelledby="addDebitModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addDebitForm" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDebitModalLabel">Add Debit Credit Record</h5>
                <button type="button" onclick="closeModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Select Customer</label>
                    <select name="customer-name" class="form-control" required>
                        <option value="">-- Select Cashier (Customer) --</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <div class="d-flex justify-content-between align-items-center">
                        Credit
                        <input type="radio" class="form-control" name="record-type" required>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        Debit
                        <input type="radio" class="form-control" name="record-type" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="record-amount" class="form-label">Amount</label>
                    <input type="number" class="form-control" id="record-amount" name="record-amount">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    $('#addDebitForm').on('submit', function (e) {
        e.preventDefault();

        const customerId = $('select[name="customer-name"]').val();
        const customerName = $('select[name="customer-name"] option:selected').text();
        const type = $('input[name="record-type"]:checked').parent().text().trim();
        const amount = $('#record-amount').val();

        if (!customerId || !type || !amount) {
            alert("Please fill all fields.");
            return;
        }

        // Append to table
        $('#debitCreditTable tbody').append(`
            <tr>
                <td>${customerName}</td>
                <td>${type}</td>
                <td>${amount}</td>
            </tr>
        `);

        // Reset form
        $('#addDebitForm')[0].reset();
        $('#addDebitModal').modal('hide');
    });
</script>


<script>
    function addCredit() {
        $('#addDebitModal').modal('show');
    }

    function closeModal() {
        $('#addDebitModal').modal('hide');
    }


$(document).ready(function () {
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
        
        // Get the fuel type ID more reliably by finding the closest table and its related data
        var fuelTypeId = null;
        // Try to get the fuel type ID from the table footer ID
        var footerElement = $(this).closest('table').find('tfoot tr td:first');
        if (footerElement.length > 0 && footerElement.attr('id')) {
            var idMatch = footerElement.attr('id').match(/\d+/);
            if (idMatch) {
                fuelTypeId = idMatch[0];
            }
        }
        
        // Fallback: If we couldn't get the ID from the footer, try to extract from the h4 element
        if (!fuelTypeId) {
            var fuelTypeHeader = $(this).closest('table').prev('h4');
            if (fuelTypeHeader.length > 0) {
                @foreach($fuelTypes as $fuelType)
                    if ('{{ $fuelType->name }}' === fuelTypeHeader.text().trim()) {
                        fuelTypeId = {{ $fuelType->id }};
                    }
                @endforeach
            }
        }
        
        // Default to the first fuel type if we still couldn't find the ID
        if (!fuelTypeId) {
            fuelTypeId = {{ $fuelTypes->first()->id ?? 0 }};
        }
        
        // Get the fuel price
        var fuelTypePrice = 0;
        @foreach($fuelTypes as $fuelType)
            if ({{ $fuelType->id }} == fuelTypeId) {
                fuelTypePrice = {{ $fuelType->price ?? 0 }};
            }
        @endforeach
        
        var totalAmount = todaySales * fuelTypePrice;
        $('#totalAmount_' + machineId).text('PKR ' + totalAmount.toFixed(2));

        // Calculate total for current fuel type table
        let total = 0;
        $(this).closest('table').find('tbody tr').each(function () {
            const val = $(this).find('td:last').text().replace(/[^\d.]/g, '');
            total += parseFloat(val) || 0;
        });

        // Update the total amount for the current fuel type
        $('#totalFuelAmount_' + fuelTypeId).text('PKR ' + total.toFixed(2));

        // Update the grand total
        updateGrandTotal();
    });
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quantityInputs = document.querySelectorAll('input[name^="quantity["]');

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

                const total = quantity * salePrice;
                totalAmountCell.textContent = `PKR ${total.toFixed(2)}`;
                let overall = 0;
                document.querySelectorAll('[id^="mobilTotalAmount_"]').forEach(cell => {
                    const amount = parseFloat(cell.textContent.replace(/[^\d.]/g, '')) || 0;
                    overall += amount;
                });
                document.getElementById('totalMobilOilAmount').textContent = `PKR ${overall.toFixed(2)}`;
                updateGrandTotal();
            });
        });
    });
</script>

<script>
    function updateGrandTotal() {
        let grandTotal = 0;

        // Collect all fuel totals
        document.querySelectorAll('[id^="totalFuelAmount_"]').forEach(cell => {
            const amount = parseFloat(cell.textContent.replace(/[^\d.]/g, '')) || 0;
            grandTotal += amount;
        });

        // Add Mobil Oil total
        const mobilOilTotalText = document.getElementById('totalMobilOilAmount')?.textContent || '';
        const mobilTotal = parseFloat(mobilOilTotalText.replace(/[^\d.]/g, '')) || 0;

        grandTotal += mobilTotal;

        document.getElementById('grandTotalAmount').textContent = `PKR ${grandTotal.toFixed(2)}`;
    }
</script>

    
@endsection
