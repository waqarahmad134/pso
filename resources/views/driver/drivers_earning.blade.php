@extends('welcome')
@section('content')


@section('title', 'Driver Earning |  Admin')
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Drivers Earning</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Earnings</li>
                    <li class="breadcrumb-item active">Driver Earnings</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <ul class="header-dropdown dropdown dropdown-animated scale-left">
                            <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Overall Earning ($)</th>
                                        <th>Earning by Rides ($)</th>
                                        <th>Earning by Tips ($)</th>
                                        <th>Overall Paid ($)</th>
                                        <th>Cancel Penalty ($)</th>
                                        <th>Balance ($)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $count = 1; ?>
                                    @foreach($data as $d)
                                    <tr>
                                        <td>{{$count++}}</td>
                                        <td>{{$d->id}}</td>
                                        <td>{{$d->name}}</td>
                                        <td>{{$d->overallEarnings}}</td>
                                        <td>{{$d->ridesEarnings}}</td>
                                        <td>{{$d->overallTips}}</td>
                                        <td>{{$d->overallPaid}}</td>
                                        <td>{{$d->cancelPenalty}}</td>
                                        <td>{{$d->balance}}</td>
                                        <td> <a onclick="detail({{json_encode($d)}})" class="btn" style="background-color: #002E63; color: white;">Pay Now</a></td>
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



<!-- Modal To Edit / Update Data -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" action="{{route('driver_pay_apnimarzika')}}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Pay Now</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-outline mb-2">
                    <input type="hidden" name="userId" class="form-control form-control-lg">
                    <h4>User ID : <span id="id"> </span> </h4>
                    <label>Amount To Pay </label><br>
                    <input type="text" name="amount" class="form-control form-control-lg">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Pay Now</button>
            </div>
        </form>
    </div>
</div>


<script>
    function detail(obj) {

        $("input[name=userId]").val(obj.id);
        $("#id").text(obj.id);
        $("input[name=amount]").val(obj.balance);
        $('#exampleModalCenter').modal('show');

    }

    function updtaesettings() {
        userId = $("input[name=id]").val();
        amount = $("input[name=text]").val();
        $.ajax({
            url: "{{route('driver_pay_apnimarzika')}}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                'userId': userId,
                'amount': amount,
            },
            success: function(response) {
                console.log(response);
                if (response.ResponseCode == 0) {
                    toastr.error(response.ResponseMessage, 'Error');
                    location.reload();
                } else {
                    toastr.info('Payed Sucessfully', 'Info');
                    location.reload();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

    }
</script>


@endsection