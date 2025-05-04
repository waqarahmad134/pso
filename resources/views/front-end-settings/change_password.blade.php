@extends('welcome')
@section('content')

@section('title', 'Change Password |  Admin')
<style>
    .thank-you-pop{
    	width:100%;
     	padding:20px;
    	text-align:center;
    }
    .thank-you-pop img{
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


<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Change Password</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Front End Settings</li>
                    <li class="breadcrumb-item active">Change Password</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    @csrf
                    <div class="row clearfix">
                        <div class="col-md-6 col-lg-6">
                            <label>Old Password</label>
                            <input id="old" name="old" type="password" class="form-control" placeholder="Old Password Here">
                            <input type="checkbox" id="showPass">&nbsp; Show Password
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <label>New Password</label>
                            <input id="new" name="new" type="password" class="form-control" placeholder="Confirm Password Here">
                            <input type="checkbox" id="showPass1">&nbsp; Show Password
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 mt-2">
                            <input onclick="change_password()" type="submit" class="btn float-right" style="background-color: #002E63; color: white;" value="Change Password">
                        </div>
                    </div>
                </form>
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
					<img class="img-fluid" src="https://gatesbbq.com/wp-content/uploads/2017/04/checkmarksuccess.gif" alt="">
					<h1>Thank You!</h1>
					<p>Password Updated Successfully!</p>
 				</div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="error" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="background:#fefcfb;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
             </div>
            <div class="modal-body">
				<div class="thank-you-pop">
					<img class="img-fluid" src="https://cdn.dribbble.com/users/2469324/screenshots/6538803/comp_3.gif" alt="">
					<h1>Error!</h1>
					<p>Error Occured!</p>
 				</div>
            </div>
        </div>
    </div>
</div>


<script>
     $(document).ready(function() {
        $('#showPass').on('click', function() {
            var passInput = $("#old");
            if (passInput.attr('type') === 'password') {
                passInput.attr('type', 'text');
            } else {
                passInput.attr('type', 'password');
            }
        })
    })
    
     $(document).ready(function() {
        $('#showPass1').on('click', function() {
            var passInput = $("#new");
            if (passInput.attr('type') === 'password') {
                passInput.attr('type', 'text');
            } else {
                passInput.attr('type', 'password');
            }
        })
    })
    

    function change_password()
    {
        event.preventDefault();
        neww=$("#new").val();
        old=$("#old").val();
       
        $.ajax({
        url:"{{route('change_password_post')}}",
        type: "post",
        data: {
        "_token": "{{ csrf_token() }}",
        "neww": neww,
        "old": old,
      
        } ,
        success: function (response) {
            console.log(response);
            if(response.ResponseCode==1)
            {
                $("#ignismyModal").modal('show');
            }
            if(response.ResponseCode==0)
            {
                $("#error").modal('show');
            }
          
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
    }
    </script>

@endsection
