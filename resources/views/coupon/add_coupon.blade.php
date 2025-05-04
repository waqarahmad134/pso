@extends('welcome')
@section('content')



@section('title', 'Coupons |  Admin')
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>-->
<style>
    .text-black {
        color: black;
    }
</style>


<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Coupons</h2>

            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homess')}}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Coupons</li>
                </ul>

            </div>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" style="background-color:#002E63;border:0px">Add Coupon</button>
                        <ul class="header-dropdown dropdown dropdown-animated scale-left">
                            <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Discount</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($data->Response as $da)
                                    <tr>
                                        <td>{{$da->id}}</td>
                                        <td>{{$da->name}}</td>
                                        <td>{{$da->discount}} $</td>
                                        <td>{{date('d,M Y',strtotime($da->from))}}</td>
                                        <td>{{date('d,M Y',strtotime($da->to))}}</td>
                                        <td>
                                            @if($da->status=="true")
                                            <p>Active</p>
                                            @else
                                            <p>Block</p>
                                            @endif
                                        </td>

                                        <td>
                                            <div style="display:flex">
                                                @if($da->status=="true")
                                                <form method="POST" action="{{route('deactivate')}}">
                                                    @csrf
                                                    <input value="{{$da->name}}" name="name" hidden>
                                                    <input type="submit" class="btn" style="background-color: #002E63; color: white; width:100px!important;" value="Deactivate">
                                                </form>
                                                @else
                                                <form method="POST" action="{{route('activate')}}">
                                                    @csrf
                                                    <input value="{{$da->name}}" name="name" hidden>
                                                    <input type="submit" class="btn btn-warning " style=" color: white;width:100px!important;" value="Activate">
                                                </form>

                                                @endif
                                                <a onclick="update(this)" cid="{{$da->id}}" class="btn btn-info ml-2" data-toggle="modal" data-target="#update">Update</a>
                                                <div>
                                                    <!-- <form method="POST" action="{{route('delete')}}">
                                                    @csrf
                                                    <input value="{{$da->name}}" name="name" hidden>
                                                    <input type="submit" class="btn btn-warning " style=" color: white;width:100px!important;" value="Delete">
                                                </form> -->

                                                </div>
                                            </div>
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





<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="update" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Update Coupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div id="erur" class="alert alert-danger" style="display:none;"></div>
                            <input hidden name="id" type="text" class="form-control" required>
                            <label>Name</label>
                            <input name="cname" type="text" class="form-control" required>

                            <label>Discount</label>
                            <input name="cdiscount" type="text" class="form-control" required>

                            <label>From</label>
                            <input name="cfrom" type="datetime" class="form-control" placeholder="Issue Date" disabled>
                            <input name="c1from" type="date" class="form-control" placeholder="Issue Date" required>

                            <label>To</label>
                            <input name="cto" type="datetime" class="form-control" placeholder="Expiry Date" disabled>
                            <input name="c1to" type="date" class="form-control" placeholder="Expiry Date" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button onclick="update_post()" type="submit" class="btn btn-primary" style="background-color:#002E63;border:0px">Update Coupon</button>
                </div>
        </div>
        </form>
    </div>
</div>

<style>

</style>

<!-- Vertically centered -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="background-image: url(public/coupen-bg.jpg); ">
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title text-black" id="exampleModalCenterTitle"><strong>Add Coupon</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div id="erur1" class="alert alert-danger" style="display:none;"></div>
                            <div>
                                <label class="text-black">Name</label>
                                <input name="names" type="text" class="form-control" required>
                            </div>
                            <div>
                                <label class="text-black mt-2">Discount</label>
                                <input name="discount" type="text" class="form-control" required>
                            </div>
                            <div>
                                <label for="issuedate" class="text-black mt-2">From</label>
                                <input name="from" id="issuedate" type="date" class="form-control" placeholder="Issue Date" required>
                            </div>
                            <div>
                                <label class="text-black mt-2">To</label>
                                <input name="to" type="date" class="form-control" placeholder="Expiry Date" required>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button onclick="acc_coupon()" type="submit" id="new-btn" data-context="info" data-message="Coupon Name already exists!" data-position="bottom-right" class="btn btn-primary" style="background-color:#002E63;border:0px">Add Coupon</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .toastr-div .modal-backdrop {
        background-color: none !important;
    }
</style>



<script>
    function acc_coupon() {
        event.preventDefault();
        name = $("input[name=names]").val();
        discount = $("input[name=discount]").val();
        from = $("input[name=from]").val();
        to = $("input[name=to]").val();

        if (name == "") {
            document.getElementById('erur1').style.display = "block";
            document.getElementById('erur1').innerHTML = 'Please Submit First Name !';
            //  block of code to be executed if the condition is true
        } else if (discount == "") {
            document.getElementById('erur1').style.display = "block";
            document.getElementById('erur1').innerHTML = 'How Much Discount You Wanna Give ?';
            //  block of code to be executed if the condition is true
        } else if (from == "") {
            document.getElementById('erur1').style.display = "block";
            document.getElementById('erur1').innerHTML = 'Discount Start Date ';
            //  block of code to be executed if the condition is true
        } else if (to == "") {
            document.getElementById('erur1').style.display = "block";
            document.getElementById('erur1').innerHTML = 'Discount End Date ';
            //  block of code to be executed if the condition is true
        } else {

            $.ajax({
                url: "{{route('add_coupons')}}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "name": name,
                    "discount": discount,
                    "from": from,
                    "to": to,

                },
                success: function(response) {
                    console.log(response);
                    if (response.ResponseCode == 1) {
                        toastr.info('Congrats Coupen Created !!!.', 'Info');
                        // $("#formular_sucess").modal('show');
                        setTimeout(function() {
                            window.location.reload(1);
                        }, 2000);
                        location.reload();
                    }

                    if (response.ResponseCode == 0) {
                        toastr.error(response.ResponseMessage, 'Error');
                    }


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    }

    function update(e) {
        cid = $(e).attr('cid');
        console.log(cid);

        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: 'coupons_detail/' + cid,
            success: function(data) {
                console.log(data);
                $("input[name=id]").val(data.Response.id);
                $("input[name=cname]").val(data.Response.name);
                $("input[name=cdiscount]").val(data.Response.discount);
                var from = $("input[name=cfrom]").val(data.Response.from);
                var to = $("input[name=cto]").val(data.Response.to);

                // let str = data.Response.from;
                // let date = moment(str);
                // $("input[name=cfrom]").val(date.format('DD/MM/YYYY'));

                // let str1 = data.Response.to;
                // let date1 = moment(str1);
                // $("input[name=cto]").val(date1.format('DD/MM/YYYY'));

            },
            error: function() {

            }
        });

    }




    function update_post() {
        var match_date = "01,Jan 1970";


        event.preventDefault();
        name = $("input[name=cname]").val();
        id = $("input[name=id]").val();
        discount = $("input[name=cdiscount]").val();
        from = $("input[name=c1from]").val();
        to = $("input[name=c1to]").val();
        if (from == "") {
            document.getElementById('erur').style.display = "block";
            document.getElementById('erur').innerHTML = 'Please Select From Date !';
        } else if (to == "") {
            document.getElementById('erur').style.display = "block";
            document.getElementById('erur').innerHTML = 'Please Select To Date !';
        } else if (from == "") {
            document.getElementById('erur').style.display = "block";
            document.getElementById('erur').innerHTML = 'Discount Start Date ';
            //  block of code to be executed if the condition is true
        } else if (to == "") {
            document.getElementById('erur').style.display = "block";
            document.getElementById('erur').innerHTML = 'Discount End Date ';
            //  block of code to be executed if the condition is true
        } else {

            $.ajax({
                url: "{{route('update_coupon')}}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "name": name,
                    "discount": discount,
                    "from": from,
                    "to": to,
                    'id': id

                },
                success: function(response) {
                    console.log(response);
                    if (response.ResponseCode == 1) {
                        location.reload();
                        toastr.info(response.ResponseMessage, 'Info');
                    }

                    if (response.ResponseCode == 0) {
                        toastr.error(response.ResponseMessage, 'Error');
                        // $("#formular").modal('show');
                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    }
</script>



@endsection