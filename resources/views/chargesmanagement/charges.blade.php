@extends('welcome')
@section('content')


@section('title', 'Charges |  Admin')
<style>
    .search-control {
  display: block;
  width: 100%;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
    body {
       font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }
    form {
       max-width: 450px;
       margin: auto;
    }
    
    input:focus{
        border:0px solid transparent!important;    
    }
    
    input:active{
         border:0px solid transparent!important;    
    }
    
    input:visited{
         border:0px solid transparent!important;    
    }
    
    .form-control{
        background-color: #fff;
        border: 1px solid transparent!important;
    }
    
    .inp-color:hover {
        background-color: #fff!important;
    }
    
    .inputContainer i {
       position: absolute;
    }
    .inputContainer {
       width: 100%;
       margin-bottom: 10px;
    }
    .icon {
       padding: 15px;
       color: rgb(49, 0, 128);
       width: 70px;
       text-align: left;
    }
    .Field {
       width: 100%;
       padding: 10px;
       text-align: center;
       font-size: 20px;
       font-weight: 500;
    }
</style>


<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Charges (Click To Edit)</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Charges </li>
                </ul>
                
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="body">
                        <div><h5> <strong>Amount* </strong></h5> Cost Per Base Value </div><hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>Serial #</th>
                                        <th>Title</th>
                                        <th>Amount $ (Cost Per Base Value)</th>
                                        <th>Base Value</th>
                                        <!--<th>Action</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1; ?>
                                @foreach($data as $da)
                               <tr class="inp-color">
                                   <td>{{$count++}}</td>
                                   <td>{{$da->title}}</td>
                                   <td><input value="{{$da->amount}}" name="amount" class="amount form-control" cid="{{$da->id}}"> </td>
                                   <td><input value="{{$da->value}}" name="value" class="value form-control" onchange="value(this)" cid="{{$da->id}}"></td>
                                   <!--<td> <a href="" class="btn" style="background-color: #c70032; color: white;">Delete</a></td>-->
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
</div>
<div class="modal fade" id="ignismyModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
             </div>
            <div class="modal-body">
				<div class="thank-you-pop">
					<img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="" />
					<h1>Thank You!</h1>
					<p>Charge Values Updated Successfully</p>
 				</div>
            </div>
        </div>
    </div>
</div>

<style>
    .thank-you-pop{
    	width:100%;
     	padding:20px;
    	text-align:center;
    }
    .thank-you-pop img{
    	width:76px;
    	height:auto;
    	margin:0 auto;
    	display:block;
    	margin-bottom:25px;
    }
    
    .thank-you-pop h1{
    	font-size: 42px;
        margin-bottom: 25px;
    	color:#5C5C5C;
    }
    .thank-you-pop p{
    	font-size: 20px;
        margin-bottom: 27px;
     	color:#5C5C5C;
    }
    .thank-you-pop h3.cupon-pop{
    	font-size: 25px;
        margin-bottom: 40px;
    	color:#222;
    	display:inline-block;
    	text-align:center;
    	padding:10px 20px;
    	border:2px dashed #222;
    	clear:both;
    	font-weight:normal;
    }
    .thank-you-pop h3.cupon-pop span{
    	color:#03A9F4;
    }
    .thank-you-pop a{
    	display: inline-block;
        margin: 0 auto;
        padding: 9px 20px;
        color: #fff;
        text-transform: uppercase;
        font-size: 14px;
        background-color: #8BC34A;
        border-radius: 17px;
    }
    .thank-you-pop a i{
    	margin-right:5px;
    	color:#fff;
    }
    #ignismyModal .modal-header{
        border:0px;
}
</style>

<script>
    

$(document).ready(function(){
    $(".amount").on('change', function post(e){
        cid=$(this).attr('cid');
        amount=$(this).val();
      
       $.ajax({
        url:"{{route('update_amount')}}",
        type: "post",
        data: {
        "_token": "{{ csrf_token() }}",
        "cid": cid,
        "amount": amount,
       
        } ,
        success: function (response) {
            console.log(response);
            $(this).val(response.amount);
            $("#ignismyModal").modal('show');
            // alert('Amount Value Updated Successfully!')
           
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
    });
    
     $(".value").on('change', function value(e){
        cid=$(this).attr('cid');
        values=$(this).val();
      
      
       $.ajax({
        url:"{{route('update_value')}}",
        type: "post",
        data: {
        "_token": "{{ csrf_token() }}",
        "cid": cid,
        "value": values,
       
        } ,
        success: function (response) {
            console.log(response);
            $(this).val(response.value);
            $("#ignismyModal").modal('show');
            // alert('Value Updated Successfully!')
           
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
    });
});


function weight_update(e)
{
    weight=$("#weight_update").val();
    dimension=$("#dimension").val();
    distance=$("#distance").val();
    $.ajax({
        url:"{{route('update_charge')}}",
        type: "post",
        data: {
        "_token": "{{ csrf_token() }}",
        "weight": weight,
        "dimension": dimension,
        "distance": distance,
        } ,
        success: function (response) {
            console.log(response);
            $("#weight_update").val(response.weight_price);
            $("#dimension").val(response.dimension_price);
            $("#distance").val(response.distance_price);
            $("#ignismyModal").modal('show');
           // You will get response from your PHP page (what you echo or print)
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
}

$.holdReady(true);

$(window).on("load", function() {
  $.holdReady(false);
  $("input[type=search]").removeClass("form-control").addClass("search-control");
});

    </script>
@endsection
