@extends('welcome')
@section('content')

@section('title', 'Admins List |  Admin')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.0/css/intlTelInput.css" />

<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>List Admin</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homess')}}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Admin</li>
                    <li class="breadcrumb-item active">List Admin</li>
                    <li class="breadcrumb-item active"><button class="btn btn-styling1 text-capitalize mt-2" onClick="printData('DivIdToPrint');">Print</button></li>
                </ul>

            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header d-flex justify-content-between pb-0 mb-0">
                        <h2>Admin Mangement</h2>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">Add New Admin</button>
                    </div>
                    <div class="body">
                        <div id="DivIdToPrint" class="table-responsive">
                            <!--<table class="table table-bordered table-hover js-basic-example dataTable table-custom">-->
                            <!-- <table class="table table-bordered table-striped table-hover  js-exportable"> -->
                            <table id="example1" class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>

                                <tbody>
                                    <?php
                                    $count = 1;
                                    ?>
                                    @foreach($data as $d)
                                    <tr>
                                        <td>{{$count++}}</td>
                                        <td>{{$d->name}}</td>
                                        <td>{{$d->contact}} </td>
                                        <td>{{$d->email}} </td>
                                        <td>{{$d->usertype}}</td>
                                        <td>
                                            @if($d->status== "active")
                                            <span>Active</span>
                                            @else
                                            <span>Block</span>
                                            @endif
                                        </td>
                                        <td>{{date('d,M Y h:i:s',strtotime($d->created_at))}}</td>
                                        <td>
                                            @if($d->status== "active")
                                            <a href="{{route('update_status',['id'=>$d->id])}}" class="btn" style="background-color: #c70032; color: white;">Block</a>
                                            @else
                                            <a href="{{route('update_status',['id'=>$d->id])}}" class="btn" style="background-color: #002E63; color: white;">Active</a>
                                            @endif
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
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" id="myForm" action="{{route('add_admins')}}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="erur" class="alert alert-danger" style="display:none;"></div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <label>First Name</label>
                            <input name="firstName" type="text" class="form-control" placeholder="Enter First Name Here" required>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <label>Last Name</label>
                            <input name="lastName" type="text" class="form-control" placeholder="Enter Last name here" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <label>Email</label>
                            <input name="email" type="email" class="form-control" autocomplete="off" placeholder="Enter Email Address Here" required>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <label>Phone</label>

                            <input class="form-control tel" type="tel" name="leyka_donor_phone" inputmode="tel" value="" / required>
                            <input class="form-control tel" id="countrycode" type="hidden" name="countrycode" value="" / required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <label for="passInput">Password</label>
                            <input name="password" type="password" id="passInput" class="form-control" placeholder="Enter Password Here" required autocomplete="off">
                            <input type="checkbox" id="showPass">&nbsp; Show Password
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModel()"  data-dismiss="modal">Close</button>
                    <!-- <button type="submit" class="btn btn-primary" onclick="phonecheck()">Add Admin</button> -->
                    <a class="btn btn-primary text-white" onclick="phonecheck()">Add Employee</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function closeModel(){
        $('#myForm')[0].reset();
    }
    function phonecheck() {
        firstName = $("input[name=firstName]").val();
        lastName = $("input[name=lastName]").val();
        email = $("input[name=email]").val();
        phone = $("input[name=leyka_donor_phone]").val();
        passInput = $("input[name=password]").val();
        if (firstName == "") {
            document.getElementById('erur').style.display = "block";
            document.getElementById('erur').innerHTML = 'Please Add First Name !';
        } else if (lastName == '') {
            document.getElementById('erur').style.display = "block";
            document.getElementById('erur').innerHTML = 'Please Add Last Name !';
        } else if (email == '') {
            document.getElementById('erur').style.display = "block";
            document.getElementById('erur').innerHTML = 'Please Add Email !';
        } else if (!validateEmail(email)) { // Check if the email is valid
            document.getElementById('erur').style.display = "block";
            document.getElementById('erur').innerHTML = 'Please Add a Valid Email!';
        } else if (phone == '') {
            document.getElementById('erur').style.display = "block";
            document.getElementById('erur').innerHTML = 'Please Add Phone Number !';
        } else if (passInput == '') {
            document.getElementById('erur').style.display = "block";
            document.getElementById('erur').innerHTML = 'Please Add Password !';
        } else {
            document.getElementById('erur').style.display = "none";
            document.getElementById('erur').innerHTML = 'Please Add Phone Number !';
            if (phone.includes("X")) {
                alert("Please write the complete number.");
            } else {
                document.getElementById("myForm").submit();
            }
        }
    }
    function validateEmail(email) {
        // Simple email validation regex
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    $(document).ready(function() {
        $('#example1').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copy',
                    exportOptions: {
                        columns: ':not(:nth-child(6))'
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':not(:nth-child(6))'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':not(:nth-child(6))'
                    }
                }
            ]
        });
    });
    $(document).ready(function() {
        $('#showPass').on('click', function() {
            var passInput = $("#passInput");
            if (passInput.attr('type') === 'password') {
                passInput.attr('type', 'text');
            } else {
                passInput.attr('type', 'password');
            }
        })
    })

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.0/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.8/jquery.inputmask.bundle.min.js"></script>


<script>
    $j = jQuery.noConflict();

    $j(function() {
        var input = document.querySelectorAll("input[name=leyka_donor_phone]");
        var iti_el = $j(".iti.iti--allow-dropdown.iti--separate-dial-code");
        if (iti_el.length) {
            iti.destroy();
        }
        for (var i = 0; i < input.length; i++) {
            iti = intlTelInput(input[i], {
                autoHideDialCode: false,
                autoPlaceholder: "aggressive",
                initialCountry: "pk",
                separateDialCode: true,
                preferredCountries: ["ru", "th"],
                customPlaceholder: function(
                    selectedCountryPlaceholder,
                    selectedCountryData
                ) {
                    return "" + selectedCountryPlaceholder.replace(/[0-9]/g, "X");
                },
                geoIpLookup: function(callback) {
                    $j.get("https://ipinfo.io", function() {}, "jsonp").always(
                        function(resp) {
                            var countryCode = resp && resp.country ? resp.country : "";
                            callback(countryCode);
                        }
                    );
                },
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.0/js/utils.js",
            });

            $j('input[name="leyka_donor_phone"]').on(
                "focus click countrychange",
                function(e, countryData) {
                    var pl = $j(this).attr("placeholder") + "";
                    var res = pl.replace(/X/g, "9");
                    if (res != "undefined") {
                        $j(this).inputmask(res, {
                            placeholder: "X",
                            clearMaskOnLostFocus: true,
                        });
                    }
                }
            );

            $j('input[name="leyka_donor_phone"]').on(
                "focusout",
                function(e, countryData) {
                    var intlNumber = iti.getNumber();
                    console.log(intlNumber);
                    console.log(iti.s.dialCode);
                    $('#countrycode').val(iti.s.dialCode);
                }
            );
        }
    });
</script>

@endsection