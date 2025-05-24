@extends('welcome')
@section('content')

<style>
    .dashboard-cards {
        color: white;
        border-radius: 8px;
        
    }

    .card-title {
        color: #00000099 !important;
        font-size: 16px !important;
        font-weight: 500;
    }

    .card-text {
        color: #000000 !important;
        font-size: 26px !important;
        font-weight: 600;
    }

    @media only screen and (max-width: 600px) {
        .responsive {
            overflow: auto;
        }
    }

    ul {
        padding-inline-start: 1px !important;
    }

    svg[aria-label="A chart."] {
        border-radius: 5px;
    }
</style>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

@section('title', 'Home |  MUDASSAR FILLING STATION')
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Dashboard</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homess')}}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item ">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 col-lg-9">
                <div class="row" style="row-gap: 10px">
                    <div class="col-md-4 col-lg-4">
                        <div class="card shadow-lg dashboard-cards ">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="card-title">Fuel Types                                        </h5>
                                    </div>
                                    <div>
                                        <img src="{{asset('/public/1.png')}}" width="60" alt="">
                                    </div>
                                </div>
                                <div>
                                    <h4 class="card-text"> 2 </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="card shadow-lg dashboard-cards">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="card-title">All Customers</h5>

                                    </div>
                                    <div>
                                        <img src="{{asset('/public/2.png')}}" width="60" alt="">
                                    </div>
                                </div>
                                <div>
                                    <h4 class="card-text">104</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="card shadow-lg dashboard-cards">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="card-title">All Staff</h5>
                                    </div>
                                    <div>
                                        <img src="{{asset('/public/3.png')}}" width="60" alt="">
                                    </div>
                                </div>
                                <div>
                                    <h4 class="card-text">10</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="card shadow-lg dashboard-cards">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="card-title">Administrator</h5>
                                    </div>
                                    <div>
                                        <img src="{{asset('/public/4.png')}}" width="60" alt="">
                                    </div>
                                </div>
                                <div>
                                    <h4 class="card-text">5</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="card shadow-lg dashboard-cards">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="card-title">Diesel</h5>

                                    </div>
                                    <div>
                                        <img src="{{asset('/public/5.png')}}" width="60" alt="">
                                    </div>
                                </div>
                                <div>
                                    <h4 class="card-text">4731.63 Liters </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="card shadow-lg dashboard-cards">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="card-title">Petrol</h5>
                                    </div>
                                    <div>
                                        <img class="img-fluid" src="{{asset('/public/6.png')}}" width="60" alt="">
                                    </div>
                                </div>
                                <div>
                                    <h4 class="card-text">-7611.74 Liters</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    @foreach($data as $fuel)
                    <div class="col-6">
                        <button class="card shadow-lg dashboard-cards mb-3" 
                            onclick="populateUpdateModal('{{ $fuel->id }}', '{{ $fuel->name }}', '{{ $fuel->price }}', '{{ $fuel->description }}')">
                            >
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="card-title">{{ $fuel->name }}</h5>
                                    </div>
                                    <div>
                                        <img src="{{asset('/public/1.png')}}" width="60" alt="">
                                    </div>
                                </div>
                                <div>
                                    <h4 class="card-text"> {{ $fuel->price }} PKR </h4>
                                </div>
                            </div>
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-3 col-lg-3">
                <div class="card shadow-lg dashboard-cards ">
                    <div class="card-body">
                        <div>
                            <h2 style="font-size: 24px;color:#000000;font-weight:600;">Hi, Zeeshan</h2>
                            <p class="text-dark">Here is how you're doing </p>
                            <p class="mt-4 text-dark">Total Receivable</p>
                            <h2 style="font-size:24px;color:#4A006D;font-weight:600px;">PKR 10,851,151.00</h2>
                            <p class="mt-4 text-dark">Today's Sales</p>
                            <h2 style="font-size:24px;color:#4A006D;font-weight:600px;">PKR 3,400.00</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Edit Fuel Modal -->
<div class="modal fade" id="editFuelModal" tabindex="-1" aria-labelledby="editFuelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="updateFuelForm" action="">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="fuel-id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFuelModalLabel">Edit Fuel</h5>
                    <button type="button" onclick="closeModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="fuel-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="fuel-name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="fuel-price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="fuel-price" name="price" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="fuel-description" class="form-label">Description</label>
                        <textarea class="form-control" id="fuel-description" name="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Fuel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    
    function populateUpdateModal(id, name, price, description) {
        $('#fuel-id').val(id);
        $('#fuel-name').val(name);
        $('#fuel-price').val(price);
        $('#fuel-description').val(description);
        $('#updateFuelForm').attr('action', '{{ route("fuel.update", "") }}/' + id);
        $('#editFuelModal').modal('show');
    }

    function closeModal() {
        $('#editFuelModal').modal('hide');
    }
</script>


@endsection