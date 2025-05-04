@extends('welcome')
@section('content')


@section('title', 'Que Drivers |  Admin')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>    

<style>
    .light-box-img{
        cursor: pointer;
        background-size: cover;
        background-position: center;
        
    }
    .img-light{
        width: 300px;
        /*height: 300px;*/
        object-fit: cover;
    }
    
    .chart-fluid{
        height:400px;width:600px;margin:auto;
    }

    @media only screen and (max-width: 600px) {
        .card-body {
            padding: 0.25rem!important;
        }
        .card .body{
            padding: 5px!important;
        }
        
        .chart-fluid{
            height:auto;width:auto;margin:auto;
        }
    }
</style>
<div id="main-content">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 ml-auto col-xl-12 mr-auto">
            <!-- Tabs with Background on Card -->
            <a href="javascript:history.back()" class="btn btn-info mb-3"><i class="fa fa-arrow-left"></i>&nbsp; Back</a>
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs nav-tabs-neutral justify-content-center" role="tablist" data-background-color="orange">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab"  href="#Driver" role="tab">Driver Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#License" role="tab">License Information </a>
                        </li>           
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Vehicle" role="tab">Vehicle Information </a>
                        </li>           
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#bank" role="tab" onclick="bank()">Driver Bank and Balance</a>
                        </li>           
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#ratingss" role="tab" onclick="ratingss()">Ratings</a>
                        </li>    
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#rides" role="tab" onclick="driver_rides()">All Rides</a>
                        </li>           
                    </ul>
                </div>
                <div class="card-body">
                <!-- Tab panes -->
                
                    <div class="tab-content">
                        <div class="tab-pane active" id="Driver" role="tabpanel">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6 d-flex justify-content-center">
                                                <img class="img-fluid" src="https://antrak.zeeshannawaz.com/{{$data->profilePicture}}" alt="avatar" width="100" height="100">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6 " style="display:grid; align-items:center;">
                                                <h4>Driver Name : {{$data->name}}</h4>
                                                <h6>User ID : <span id="id">{{$data->id}}</span> </h6>
                                            </div>
                                        </div><hr>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <h5>Full Name </h5>
                                            </div>    
                                            <div class="col-lg-6 col-md-6 col-6 " style="display:grid; align-items:center;">
                                                <span> {{$data->name}} </span>
                                            </div>
                                        </div>    
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <h5>Email Name </h5>
                                            </div>    
                                            <div class="col-lg-6 col-md-6 col-6 " >
                                                <span> {{$data->email}} </span>
                                            </div>
                                        </div>    
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <h5>Phone</h5>
                                            </div>    
                                            <div class="col-lg-6 col-md-6 col-6 " style="display:grid; align-items:center;">
                                                <span> {{$data->phoneNum}}</span>
                                            </div>
                                        </div>    
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <h5>State</h5>
                                            </div>    
                                            <div class="col-lg-6 col-md-6 col-6 " style="display:grid; align-items:center;">
                                                <span>  {{$data->SSN}}</span>
                                            </div>
                                        </div>    
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <h5>Vehicle Type </h5>
                                            </div>    
                                            <div class="col-lg-6 col-md-6 col-6 " style="display:grid; align-items:center;">
                                                <span> {{$data->vehicleType}}</span>
                                            </div>
                                        </div> 
                                            <button class="button-success pure-button button-xlarge btn btn-info">
                                              <i class="fa fa-paper-plane"></i>&nbsp;<a class="text-white" href="mailto:{{$data->email}}">Send Mail</a>
                                            </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                       
                        <div class="tab-pane" id="License" role="tabpanel">
                            <div class="container">
                                <h4>License Information</h4><br>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <h5>Issue Date</h5>
                                    </div>    
                                    <div class="col-lg-6 col-md-6 col-6 " style="display:grid; align-items:center;">
                                        <span> {{$data->licenseData->issueDate}}</span>
                                    </div>
                                </div> 	
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <h5>Expiry Date</h5>
                                    </div>    
                                    <div class="col-lg-6 col-md-6 col-6 " style="display:grid; align-items:center;">
                                        <span> {{$data->licenseData->expiryDate}}</span>
                                    </div>
                                </div> 	
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <h5>License No.</h5>
                                    </div>    
                                    <div class="col-lg-6 col-md-6 col-6 " style="display:grid; align-items:center;">
                                        <span> {{$data->licenseData->Licnumber}}</span>
                                    </div>
                                </div> 	
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <h5>Issuing State</h5>
                                    </div>    
                                    <div class="col-lg-6 col-md-6 col-6 " style="display:grid; align-items:center;">
                                        <span> {{$data->licenseData->issueState}} </span>
                                    </div>
                                </div> 	
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-6">
                                            <h5>License Front Photo</h5>
                                            <div class="light-box-img">
                                                <a href="https://antrak.zeeshannawaz.com/{{$data->licenseData->frontPhoto}}" data-lightbox="roadtrip">
                                                    <img class="img-fluid mb-1 img-light" src="https://antrak.zeeshannawaz.com/{{$data->licenseData->frontPhoto}}" alt="Img Not Upload" width="200" >
                                                </a>
                                            </div>
                                    </div>    
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <h5>License Back Photo</h5>
                                        <a href="https://antrak.zeeshannawaz.com/{{$data->licenseData->backPhoto}}" data-lightbox="roadtrip">
                                            <img class="img-fluid mb-1 img-light" src="https://antrak.zeeshannawaz.com/{{$data->licenseData->backPhoto}}" alt="Img Not Upload" width="200" >
                                        </a>
                                    </div>
                                </div> 	
                            </div>
                        </div>
                        <div class="tab-pane" id="Vehicle" role="tabpanel">
                            <div class="container">
                                <h4>Bank Details</h4></br>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <h5>License Plate</h5>
                                    </div>    
                                    <div class="col-lg-6 col-md-6 col-6 " style="display:grid; align-items:center;">
                                        <span> {{$data->VehicleData->plateNum}}</span>
                                    </div>
                                </div> 	
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <h5>Make</h5>
                                    </div>    
                                    <div class="col-lg-6 col-md-6 col-6 " style="display:grid; align-items:center;">
                                        <span> {{$data->VehicleData->make}}</span>
                                    </div>
                                </div> 	
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <h5>Model </h5>
                                    </div>    
                                    <div class="col-lg-6 col-md-6 col-6 " style="display:grid; align-items:center;">
                                        <span> {{$data->VehicleData->model}}</span>
                                    </div>
                                </div> 	
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <h5>Year</h5>
                                    </div>    
                                    <div class="col-lg-6 col-md-6 col-6 " style="display:grid; align-items:center;">
                                        <span> {{$data->VehicleData->year}} </span>
                                    </div>
                                </div> 	
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <h5>Color</h5>
                                    </div>    
                                    <div class="col-lg-6 col-md-6 col-6 " style="display:grid; align-items:center;">
                                        <span> {{$data->VehicleData->color}} </span>
                                    </div>
                                </div> 	
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <h5>Vehicle Documents</h5>
                                        <div class="d-flex">
                                        @if(isset($data->VehicleData->documents) && sizeof($data->VehicleData->documents) > 0)
                                            @foreach($data->VehicleData->documents as $doc_image)
                                            <a class="m-2" href="https://antrak.zeeshannawaz.com/{{$doc_image}}" data-lightbox="roadtrip1">
                                                <img class="img-fluid mb-1 img-light" src="https://antrak.zeeshannawaz.com/{{$doc_image}}" alt="Document1" >
                                            </a>
                                            @endforeach
                                        @endif
                                        </div>
                                    </div>    
                                </div> 	
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <h5>Vehicle Images </h5>
                                        <div class="d-flex">
                                        @if(isset($data->VehicleData->images) && sizeof($data->VehicleData->images) > 0)
                                            @foreach($data->VehicleData->images as $veh_image)
                                            <a class="m-2" href="https://antrak.zeeshannawaz.com/{{$veh_image}}" data-lightbox="roadtrip2">
                                                <img class="img-fluid mb-1 img-light" src="https://antrak.zeeshannawaz.com/{{$veh_image}}" alt="Document1" >
                                            </a>    
                                            @endforeach
                                        @endif
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="bank" role="tabpanel">
                            <div class="container">
                                <div class="body">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <div class="d-flex justify-content-between">
                                                <div>Balance :</div> <span class="d-flex justify-content-center" id="balance">Updating ... </span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                Total Earnings : <span id="TotalAmount">Updating ... </span>
                                            </div> 
                                            <div class="d-flex justify-content-between">
                                                Earning by rides : <span id="RidesAmount">Updating ... </span>
                                            </div> 
                                            <div class="d-flex justify-content-between">
                                                Earning by Tips : <span id="TipsAmount">Updating ... </span>
                                            </div> 
                                            <div class="d-flex justify-content-between">
                                                Paid	 : <span id="PaidAmount">Updating ... </span>
                                            </div> 
                                            <div class="d-flex justify-content-between">
                                                Penalty for cancelling : <span id="panalty">Updating ... </span>
                                            </div> 
                                        </div>    
                                        
                                        <div class="col-md-6 col-lg-6">
                                            <!--<div class="d-flex justify-content-between">-->
                                            <!--    Account Title : <span id="AccTitle">Updating ... </span>-->
                                            <!--</div> -->
                                            <div class="d-flex justify-content-between">
                                                Payment Method : <span id="paymentMode">Updating ... </span>
                                            </div> 
                                            <div class="d-flex justify-content-between" id="BankName_title">
                                                Bank Name : <span id="BankName">Updating ... </span>
                                            </div> 
                                            
                                            <div class="d-flex justify-content-between">
                                                IBAN : <span id="IBAN">Updating ... </span>
                                            </div> 
                                            <div class="d-flex justify-content-between" id="routing_title">
                                                Routing Number : <span id="routing">Updating ... </span>
                                            </div> 
                                        </div>    
                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table id="bank-table" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>Payment ID</th>
                                                    <th>Paid Amount</th>
                                                    <th>Transaction Time</th>
                                                    <th>Transaction ID</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="tab-pane" id="ratingss" role="tabpanel">
                            <div class="container">
                                <h4 class="text-center">Average Rating = <span id="avgRating"></span></h4>
                                <div id="myChart" style="width:600px;height:400px;margin:auto;"></div>
                                <!--<div class="chart-fluid" style="">-->
                                <!--    <canvas id="bargraph"></canvas>-->
                                <!--</div>-->
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="rides" role="tabpanel">
                            <div class="container">
                                <div class="table-responsive">
                                    <table id="rides-table" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Serial No</th>
                                                <th>Order ID</th>
                                                <th>Sender Name</th>
                                                <th>Sender Phone</th>
                                                <th>Order Date</th>
                                                <th>Receiver Name</th>
                                                <th>Amount ($)</th>
                                                <th>Distance (mi)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count=1; ?>
                                            <tr>
                                               
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
            <!-- End Tabs on plain Card -->
            </div>
        </div>
    </div>
</div>


   

    
 <script>
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
function drawChart(obj1) {
    console.log(obj1);
var data = google.visualization.arrayToDataTable(obj1);
var options = {
  title:'Rating w.r.t number of Users',
  bar: {groupWidth: "60%"},
  vAxis: {title: "# of Users"},
  hAxis: {title: "ratings"}
};
var chart = new google.visualization.ColumnChart(document.getElementById('myChart'));
  chart.draw(data, options);
}
</script>

    
   

<script>
    lightbox.option({
      'resizeDuration': 700,
      'wrapAround': true
    })
    
    
    function ratingss(){
        
        event.preventDefault();
        var id = $('#id').text();
        $('#avgRating').empty();
        
        $.ajax({
           
                url:"{{route('ratingss')}}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                } ,
                success: function (response) {
                    console.log(response.graphData);
                    drawChart(response.graphData)
                    $("#avgRating").append('<span>'+response.avgRating+'</span>');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   console.log('Error In Rating');
                }
            });
    }
    
    
    function bank(){
        
        event.preventDefault();
        var id = $('#id').text();        
        $('#bank-table > tbody').empty();
        $('#balance').empty();
        $('#TotalAmount').empty();
        $('#RidesAmount').empty();
        $('#TipsAmount').empty();
        $('#PaidAmount').empty();
        $('#AccTitle').empty();
        $('#BankName').empty();
        $('#panalty').empty();
        $('#IBAN').empty();
        $('#routing').empty();
        $('#paymentMode').empty();
        $.ajax({
           
                url:"{{route('driver_bank')}}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                } ,
                success: function (response) {
                    console.log(response);
                    
                    $("#balance").append('<h6>&nbsp; $'+response['data'][0].balance+'</h6>');
                    $("#TotalAmount").append('<h6>&nbsp; $ '+response['data'][0].totalAmount+'</h6>');
                    $("#RidesAmount").append('<h6>&nbsp; $'+response['data'][0].ridesAmount+'</h6>');
                    $("#TipsAmount").append('<h6>&nbsp; $'+response['data'][0].tipsAmount+'</h6>');
                    $("#PaidAmount").append('<h6>&nbsp; $'+response['data'][0].paidAmount+'</h6>');
                    $("#panalty").append('<h6>&nbsp; $'+response['data'][0].cancelPenalty+'</h6>');
                    $("#paymentMode").append('<h6>'+response['data'][0].paymentMode+'</h6>');
                    
                    if (response['data'][0].bankexist)
                    {
                        if (response['data'][0].paymentMode == "bank") {
                            $("#AccTitle").append('<h6>'+response['data'][0].acctDetails.accTitle+'</h6>');
                            $("#BankName").append('<h6>'+response['data'][0].acctDetails.bankName+'</h6>');
                            $("#IBAN").append('<h6>'+response['data'][0].acctDetails.iBAN+' (Last 4 Digits)</h6>');
                            $("#routing").append('<h6>'+response['data'][0].acctDetails.routingNum+'</h6>');
                        }
                        
                        else
                        {   
                            $('#BankName_title').empty();
                            $("#IBAN").append('<h6>'+response['data'][0].acctDetails.iBAN+' (Last 4 Digits)</h6>');
                            $('#routing_title').empty();
                        }
                    }
                    else 
                    {
                        $("#AccTitle").append('<span>No Record Found</span>');
                        $("#BankName").append('<span>No Record Found</span>');
                        $("#IBAN").append('<span>No Record Found</span>');
                        $("#routing").append('<span>No Record Found</span>');
                    }
                    for(res in response['data1']){
                        $("#bank-table > tbody").append('<tr><td>'+response['data1'][res].paymentId+'</td><td>$'+response['data1'][res].paidAmount+'</td><td>'+response['data1'][res].requestedAt+'</td><td>'+response['data1'][res].transactionId+'</td></tr>');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                     console.log("bank data error");
                }
            });
    }
    
    
    function driver_rides(){
        event.preventDefault();
        var id = $('#id').text();
        // alert (id);
        console.log("{{route('driver_rides')}}?id="+id);
        let count = 1;
        $('#rides-table > tbody').empty();
        
        $.ajax({
           
                url:"{{route('driver_rides')}}?id="+id+"",
                type: "get",
                data: {
                    "_token": "{{ csrf_token() }}",
                } ,
                success: function (response) {
                    console.log(response);
                    // for(x = response.length; x <= 0; x--){
                    //     $("#rides-table > tbody").append('<tr><td>'+response[x].orderNumber+'</td><td>'+response[x].senderName+'</td><td>'+response[x].senderPhoneNum+'</td><td>'+response[x].orderDate+'</td><td>'+response[x].receiverName+'</td><td>'+response[x].receiverPhoneNum+'</td><td>'+response[x].pickupAddress+'</td><td>'+response[x].deliveryAddress+'</td><td>'+response[x].amount+'</td></tr>');
                    // }
                    for(res in response){
                        $("#rides-table > tbody").append('<tr><td>'+count++ +'</td><td>'+response[res].orderNumber+'</td><td>'+response[res].senderName+'</td><td>'+response[res].senderPhoneNum+'</td><td>'+response[res].orderDate+'</td><td>'+response[res].receiverName+'</td><td> '+response[res].amount+'</td><td>'+response[res].distance+' </td><td><a onclick="detail('+response[res].orderNumber+')" class="btn btn-info">View</a></td></tr>');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                     console.log("bank data error");
                }
            });
    }
    
    function detail(id)
    {
        // var url = <?php echo json_encode($url) ?>;
        // alert(url);
        window.location.replace("https://antrakdelivery.com/admin/booking_details/"+id);
    }
    
</script>
@endsection




  


