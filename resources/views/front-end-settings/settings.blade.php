@extends('welcome')
@section('content')


@section('title', 'Settings |  Admin')
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


<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Settings</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Front End Settings  
                    <!--<input name="about" type="text" id="about"></li>-->
                </ul>
            </div>
        </div>
    </div>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12 ml-auto col-xl-12 mr-auto">
            <!-- Tabs with Background on Card -->
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs nav-tabs-neutral justify-content-center" role="tablist" data-background-color="orange">
                        <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab"  href="#home1" role="tab">Website Setting</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="home1" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row clearfix">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2>Setting</h2>
                                            </div>
                                           
                                            <div class="body">
                                                @foreach($data1 as $d)
                                                <h5 class="mt-3">{{$d->title}}</h5>
                                                <input type="hidden" name="id" value="{{$d->id}}" class="form-control form-control-lg">
                                                <textarea class="summernote summer" name="value" id="value{{$d->id}}" value="{{$d->value}}" >
                                                   {{$d->value}}
                                                </textarea>
                                                <button onclick="about_us({{json_encode($d)}})" type="submit" class="btn btn-info float-right my-2">Save</button>
                                               @endforeach
                                            </div>
                                            
                                        </div>
                                    </div>
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


<div class="modal fade" id="ignismyModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
            </div>
            <div class="modal-body">
				<div class="thank-you-pop">
					<img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
					<h1>Thank You!</h1>
					<p>Setting has been Updated Successfully</p>
 				</div>
            </div>
        </div>
    </div>
</div>

<script>

function about_us(obj)
    {
        var id = obj.id;
        var value = $('#value'+id).summernote('code');
        
        $.ajax({
        url:"{{route('site_settings')}}",
        type: "post",
        data: {
            "_token": "{{ csrf_token() }}",
            "id": id,
            "value": value,
        } ,
        success: function (response) {
            console.log(response);
            if(response.ResponseCode==1)
            {
                $("#ignismyModal").modal('show');
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
