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

                                <input type="submit" class="btn mt-3 mb-3 float-right" style="background-color: #002E63; color: white;" value="Add Record" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
