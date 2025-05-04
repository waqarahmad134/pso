@extends('welcome')
@section('content')


@section('title', 'Unread Mails |  Admin')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>All Mails</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('homess')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Mails</li>
                    </ul>
                </div>
            </div>
        </div>
       
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>All Mails</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Serial #</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                        
                                            <th>Message</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                            $count=1;
                                        ?>
                                    @foreach($data as $da)
                                    <tr>
                                        <td>{{$count++}}</td>
                                        <td>{{$da->firstName}}</td>
                                        <td>{{$da->lastName}}</td>
                                        <td>{{$da->email}}</td>
                                        <td style="white-space:normal;">{{$da->message}}</td>
                                        <td>
                                            <form action="https://antrak.zeeshannawaz.com/appsettings/responded/{{$da->id}}" id="idForm{{$da->id}}">
                                                
                                            <button onclick="sednmail({{$da->id}})" class="button-success pure-button button-xlarge btn btn-info">
                                                  <i class="fa fa-paper-plane"></i>&nbsp;Send Mail
                                            </button>
                                            <a class="text-white" id="link{{$da->id}}" href="mailto:{{$da->email}}"></a>
                                                
                                            </form>
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
    
    
<script>
    
    function sednmail(id){
    $("#idForm"+id).submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        
        var actionUrl = form.attr('action');
       
        $.ajax({
            type: 'PUT',
            url: actionUrl,
            contentType: 'application/json',
            success: function(data)
            {
                toastr.info(data.ResponseMessage);
                $('#link'+id)[0].click(); 
                setTimeout(function(){
                  window.location.reload(1);
                }, 2000);
                location.reload();
            }
        });
        
    });
}
    
</script>
            
@endsection



