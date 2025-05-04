@extends('welcome')
@section('content')


@section('title', 'Mobile Settings |  Admin')
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
    
  
    body {
    	 color: #999999;
    	 font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    	 font-style: normal;
    	 font-weight: 400;
    	 letter-spacing: 0;
    	 text-rendering: optimizeLegibility;
    	 -webkit-font-smoothing: antialiased;
    	 -moz-osx-font-smoothing: grayscale;
    	 -moz-font-feature-settings: "liga" on;
    }
    
    img {
    	 height: auto;
    	 max-width: 100%;
    	 vertical-align: middle;
    }
     .btn {
    	 background-color: #ff9839;
    	 border: 1px solid #cccccc;
    	 /*color: #696969;*/
    	 color: #215fa6;
    	 padding: 0.5rem;
    	 text-transform: lowercase;
    }
     .btn--block {
    	 display: block;
    	 width: 100%;
    }
     .cards {
    	 display: flex;
    	 flex-wrap: wrap;
    	 list-style: none;
    	 margin: 0;
    	 padding: 0;
    }
     .cards__item {
    	 display: flex;
    	 padding: 1rem;
    }
     @media (min-width: 40rem) {
    	 .cards__item {
    		 width: 50%;
    	}
    }
     @media (min-width: 56rem) {
    	 .cards__item {
    		 width: 33.3333%;
    	}
    }
     .card {
    	 background-color: white;
    	 border-radius: 0.25rem;
    	 box-shadow: 0 20px 40px -14px rgba(0,0,0,0.25);
    	 display: flex;
    	 flex-direction: column;
    	 overflow: hidden;
    }
     .card__content {
    	 display: flex;
    	 flex: 1 1 auto;
    	 flex-direction: column;
    	 padding: 1rem;
    }
     .card__image {
    	 background-position: center center;
    	 background-repeat: no-repeat;
    	 background-size: cover;
    	 border-top-left-radius: 0.25rem;
    	 border-top-right-radius: 0.25rem;
    	 overflow: hidden;
    	 position: relative;
    	 transition: filter 0.5s cubic-bezier(.43,.41,.22,.91);
    }
     .card__image::before {
    	 content: "";
    	 display: block;
    	 padding-top: 56.25%;
    }
     @media (min-width: 40rem) {
    	 .card__image::before {
    		 padding-top: 66.6%;
    	}
    }
    .card__image--flowers {
    	 background-image: url(https://www.studenthealth.cuimc.columbia.edu/sites/default/files/styles/cola_media_1280_16_9/public/media/images/2020-11/insurance.jpg?itok=PCjoS6H_);
    }
    .card__image--flowers3 {
    	 background-image: url(https://mahirconsultancy.com/wp-content/uploads/2021/04/home-insurance-getty.jpg);
    }
    .card__image--flowers4 {
    	 background-image: url(https://cdn5.vectorstock.com/i/1000x1000/30/59/unloading-loading-truck-vector-6523059.jpg);
    }
     .card__image--flowers1 {
    	 background-image: url(https://www.kindpng.com/picc/m/492-4921444_website-cancel-order-hd-png-download.png);
    }
     .card__image--flowers2 {
    	 background-image: url(https://prestashoppe.com/127-large_default/prestashop-cancel-order.jpg);
    }
     .card__image--river {
    	 background-image: url(https://akcdn.detik.net.id/visual/2015/07/10/0cc5f8f7-5740-43ca-bdda-33010cac28cd_169.jpg?w=650);
    }
     .card__image--record {
    	 background-image: url(https://wwz.ifremer.fr/var/storage/images/_aliases/opengraphimage/medias-ifremer/medias-bluerevolution/contact-us/1811720-1-eng-GB/Contact-us.png);
    }
     .card__image--fence {
    	 background-image: url(https://inchoo.net/wp-content/uploads/2015/04/titletag.png);
    }
     .card__title {
    	 color: #696969;
    	 font-size: 1.25rem;
    	 font-weight: 300;
    	 letter-spacing: 2px;
    	 text-transform: uppercase;
    }
     .card__text {
    	 flex: 1 1 auto;
    	 font-size: 0.875rem;
    	 line-height: 1.5;
    	 margin-bottom: 0.75rem;
    }
    
    .card_ui_style{
       background: #EEE;
       border-left: 5px solid #69c773;
       padding:1rem;
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
                    <li class="breadcrumb-item"><a href="{{route('homess')}}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Front End Settings</li>  
                </ul>
            </div>
        </div>
    </div>
 
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12 ml-auto col-xl-12 mr-auto">
            <!-- Tabs with Background on Card -->
            <div class="card">
                <div class="card-body">
                    <ul class="cards">
                            <li class="cards__item">
                                <div class="card">
                                  <div class="card__image card__image--fence"></div>
                                  <div class="card__content">
                                    <div class="card__title">App Title</div>
                                    <p class="card__text">{{($data->msgCustApp->text ?? "")}} </p>
                                    <button class="btn btn--block card__btn" onclick="detail({{json_encode($data->msgCustApp)}})">Update</button>
                                  </div>
                                </div>
                            </li>
                            <li class="cards__item">
                            <div class="card">
                              <div class="card__image card__image--river"></div>
                              <div class="card__content">
                                <div class="card__title">Email</div>
                                <p class="card__text">{{($data->email->text)}}</p>
                                <button class="btn btn--block card__btn" onclick="detail({{json_encode($data->email)}})">Update</button>
                              </div>
                            </div>
                            </li>
                        <li class="cards__item">
                            <div class="card">
                              <div class="card__image card__image--record"></div>
                              <div class="card__content">
                                <div class="card__title">Contact</div>
                                <p class="card__text">{{($data->contact->text)}}</p>
                                <button class="btn btn--block card__btn" onclick="detail({{json_encode($data->contact)}})">Update</button>
                              </div>
                            </div>
                        </li>
                        <li class="cards__item">
                            <div class="card">
                              <div class="card__image card__image--flowers"></div>
                              <div class="card__content">
                                <div class="card__title">Insurance Text</div>
                                <p class="card__text">{{($data->insuranceText->text)}}</p>
                                <button class="btn btn--block card__btn" onclick="detail({{json_encode($data->insuranceText)}})">Update</button>
                              </div>
                            </div>
                        </li>
                        <li class="cards__item">
                            <div class="card">
                              <div class="card__image card__image--flowers3"></div>
                              <div class="card__content">
                                <div class="card__title">Insurance Long Text</div>
                                <p class="card__text">{{($data->insuranceLongText->text)}}</p>
                                <button class="btn btn--block card__btn" onclick="detail({{json_encode($data->insuranceLongText)}})">Update</button>
                              </div>
                            </div>
                        </li>
                        <li class="cards__item">
                            <div class="card">
                              <div class="card__image card__image--flowers4"></div>
                              <div class="card__content">
                                <div class="card__title">Load Un-load Text</div>
                                <p class="card__text">{{($data->loadUnloadText->text)}}</p>
                                <button class="btn btn--block card__btn" onclick="detail({{json_encode($data->loadUnloadText)}})">Update</button>
                              </div>
                            </div>
                        </li>
                        <li class="cards__item">
                            <div class="card">
                              <div class="card__image card__image--flowers1"></div>
                              <div class="card__content">
                                <div class="card__title mb-2">Customer Cancel Reasons</div>
                                @foreach($data->customerCancelReasons as $ccr)
                                    <p class="card__text card_ui_style">&nbsp;{{($ccr->text)}}</p>
                                @endforeach
                                <button class="btn btn--block card__btn" onclick="detail1({{json_encode($data->customerCancelReasons)}})">Update</button>
                              </div>
                            </div>
                        </li>
                        <li class="cards__item">
                            <div class="card">
                              <div class="card__image card__image--flowers2"></div>
                              <div class="card__content">
                                <div class="card__title mb-2">Driver Cancel Reasons</div>
                                @foreach($data->driverCancelReasons as $dcr)
                                    <p class="card__text card_ui_style">&nbsp; {{($dcr->text)}}</p>
                                @endforeach
                                <button class="btn btn--block card__btn" onclick="detail2({{json_encode($data->driverCancelReasons)}})">Update</button>
                              </div>
                            </div>
                        </li>
                    </ul>
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


<!-- Modal To Edit / Update Data -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Setting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-outline mb-2">
            <input type="hidden" name="id" class="form-control form-control-lg">
            <textarea  type="text" name="text" rows="5" class="form-control form-control-lg"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updtaesettings()">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal To Edit / Update Data -->
<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Settings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalbody">
        
       
      </div>
      
    </div>
  </div>
</div>


<script>

function detail1(obj){
    $("#modalbody").html("");
    console.log(obj[0]);
    for(var i=0; i<obj.length; i++)
    {
        $("#modalbody").append('<div class="form-outline"><input type="hidden" value="'+obj[i].id+'" id="id'+[i]+'" class="form-control form-control-lg"><textarea  type="text" id="text'+[i]+'" rows="2" class="form-control form-control-lg">'+obj[i].text+'</textarea><div class="float-right mt-2 mb-2"><button type="button" class="btn btn-primary" onclick="updtaesettings1('+[i]+')">Save changes</button></div></div>')
    }
    
    $("textarea[name=text5]").val(obj[4].text);
    $('#exampleModalCenter1').modal('show');
}
function detail2(obj){
    
    $("#modalbody").html("");
    console.log(obj[0]);
    for(var i=0; i<obj.length; i++)
    {
        $("#modalbody").append('<div class="form-outline"><input type="hidden" value="'+obj[i].id+'" id="id'+[i]+'" class="form-control form-control-lg"><textarea  type="text" id="text'+[i]+'" rows="2" class="form-control form-control-lg">'+obj[i].text+'</textarea><div class="float-right mt-2 mb-2"><button type="button" class="btn btn-primary" onclick="updtaesettings1('+[i]+')">Save changes</button></div></div>')
    }
    
    $("textarea[name=text5]").val(obj[4].text);
    $('#exampleModalCenter1').modal('show');
}


// function updtaesettings1(){
//     id1 = $("input[name=id0").val();
//     id2 = $("input[name=id1").val();
//     id3 = $("input[name=id2").val();
//     id4 = $("input[name=id3").val();
//     id5 = $("input[name=id4").val();
//     text0 = $("textarea[name=text0]").val();
//     text1 = $("textarea[name=text1]").val();
//     text2 = $("textarea[name=text2]").val();
//     text3 = $("textarea[name=text3]").val();
//     text4 = $("textarea[name=text4]").val();
    
//     $.ajax({
//             url:"{{route('settings_update1')}}",
//             type: "post",
//             data: {
//             "_token": "{{ csrf_token() }}",
//             'id1':id1,
//             'id2':id2,
//             'id3':id3,
//             'id4':id4,
//             'id5':id5,
//             'text0':text0,
//             'text1':text1,
//             'text2':text2,
//             'text3':text3,
//             'text4':text4,

//             } ,
//             success: function (response) {
//                 console.log(response);
               
//             },
//             error: function(jqXHR, textStatus, errorThrown) {
//                 console.log(textStatus, errorThrown);
//             }
//     });
// }


function detail(obj){
    console.log(obj);
    $("input[name=id]").val(obj.id);
    $("textarea[name=text]").val(obj.text);
    $('#exampleModalCenter').modal('show');
}

function updtaesettings1(obj){
    id = $("#id"+obj).val();
    text = $("#text"+obj).val();

    $.ajax({
            url:"{{route('settings_update')}}",
            type: "post",
            data: {
            "_token": "{{ csrf_token() }}",
            'id':id,
            'text':text,
            } ,
            success: function (response) {
                console.log(response);
                if(response.status==false)
                {
                    toastr.error(response.message, 'Error');
                }
                else
                {
                    toastr.info('Update Sucessfully', 'Info');
                    location.reload();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
    });
}


function updtaesettings(){
    id = $("input[name=id]").val();
    text = $("textarea[name=text]").val();
    
    
    $.ajax({
            url:"{{route('settings_update')}}",
            type: "post",
            data: {
            "_token": "{{ csrf_token() }}",
            'id':id,
            'text':text,
            } ,
            success: function (response) {
                console.log(response);
                if(response.status==false)
                {
                    toastr.error(response.message, 'Error');
                }
                else
                {
                    toastr.info('Update Sucessfully', 'Info');
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
