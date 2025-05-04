@extends('welcome')
@section('content')



<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Payment Methods</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homess')}}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Payment Methods</li>

                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Payment Methods</h2>
                        <!-- <button style="background-color:#002E63" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Add New</button> -->
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Title</th>
                                        <!-- <th>Client Key</th> -->
                                        <!-- <th>Secret Key</th> -->
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key=>$method)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            <p class="bg-success text-white px-2 py-1 rounded">{{$method->title}}</p>
                                        </td>
                                        <!-- <td style="white-space: normal;line-break: anywhere;">{{$method->clientKey}}</td>
                                        <td style="white-space:normal;">{{$method->secretKey}}</td> -->
                                        <td>
                                            {{$method->status == 1 ? "Active":"Block"}}
                                        </td>
                                        <td style="display: flex; justify-content: end; gap:5px;">
                                            <button style="width: 65px;" class="btn btn-primary btn-sm" onclick="update_method({{json_encode($method)}})">View</button>
                                            @if($method->status == true)
                                            <a style="width: 65px;" class="btn btn-danger btn-sm" href="{{route('block_payment_method',['id'=>$method->id])}}">Block</a>
                                            @else
                                            <a style="width: 65px;" class="btn btn-info btn-sm" href="{{route('active_payment_method',['id'=>$method->id])}}">Active</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    <!--Permission show Modal-->
                                    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form method="POST" action="{{route('update_payment_method')}}" style="width:100%">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Update Payment Method</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input class="form-control" name="id" id="id" hidden />
                                                        <div class="mb-2">
                                                            <label>Title</label>
                                                            <input class="form-control" name="update_title" id="update_title" readonly />
                                                        </div>
                                                        <div class="mb-2">
                                                            <label>Client Key</label>
                                                            <input class="form-control" name="update_clientKey" id="update_clientKey" />
                                                        </div>
                                                        <div class="mb-2">
                                                            <label>Secret Key</label>
                                                            <input class="form-control" name="update_secretKey" id="update_secretKey" />
                                                        </div>
                                                        <div class="modal-footer">
                                                            <!-- <button onclick="get_payment_method({{json_encode($method)}})" class="btn btn-primary"></button> -->
                                                            <button type="button" id="seeCredentials" class="btn btn-primary" data-toggle="modal" data-target="#passwordModel">See Credentials</button>
                                                            <button type="submit" class="btn btn-primary" id="updateModelBTN" disabled>Update</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="passwordModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="height: 378px;">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" / required>
                    </div>
                    <div class="modal-footer">
                        <button onclick="get_payment_method({{json_encode($method)}})" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function update_method(obj) {
        $("#id").val(obj.id)
        $("#update_title").val(obj.title)
        $("#update_clientKey").val('************************************')
        // $("#update_clientKey").val(obj.clientKey)
        $("#update_secretKey").val('************************************')
        // $("#update_secretKey").val(obj.secretKey)
        $("#exampleModalCenter1").modal("show")
    }

    function get_payment_method(obj) {
        var password = document.getElementById("password").value;
        if (password === "") {
            toastr.error('Password Field Required', 'Error');
        }
        id = $("#id").val();
        event.preventDefault();
        var paymentMethodId = id;
        var password = $('#password').val();
        $.ajax({
            url: "{{route('get_payment_method')}}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                "paymentMethodId": paymentMethodId,
                "password": password,
            },
            success: function(response) {
                console.log(response);
                if (response.ResponseCode == 1) {
                    toastr.warning('Please Wait', 'info');
                    $("#update_clientKey").val(response.Response.clientKey);
                    $("#update_secretKey").val(response.Response.secretKey);
                    $("#passwordModel").modal("hide");
                    document.getElementById("seeCredentials").disabled = true;
                    $("#updateModelBTN").removeAttr("disabled");

                }

                if (response.ResponseCode == 0) {
                    toastr.error(response.errors, 'Error');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });



    }
</script>


@endsection