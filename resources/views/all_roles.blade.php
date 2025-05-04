@extends('welcome')
@section('content')


@section('title', 'Roles |  Admin')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Roles</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('homess')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Roles</li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                        <button style="background-color:#002E63"  type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Add New Role</button>
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
                                            <th>#</th>
                                            <th>Role ID</th>
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
                                        @foreach($roles as $rol)
                                        <tr>
                                        <td>{{$count++}}</td>
                                            <td>{{$rol->id}}</td>
                                            <td>{{$rol->name}}</td>
                                            <td>{{$rol->status == 1 ? "Active":"Block"}}</td>
                                            <td>{{date('d,M Y h:i:s',strtotime($rol->createdAt))}}</td>
                                            <td>
                                               <a class="btn btn-info" onclick="role_detail({{$rol->id}})" driver_id="{{$rol->id}}" data-toggle="modal" data-target="#exampleModalCenter1" >Edit Permissions</a>
                                                @if($rol->status==1)
                                                <a href="{{route('block_role',['id'=>$rol->id])}}" class="btn" style="background-color: #c70032; color: white;">Block Status</a>
                                                @else
                                                <a href="{{route('active_role',['id'=>$rol->id])}}" class="btn" style="background-color: #002E63; color: white;">Active Status</a>
                                                @endif
                                            </td>
                                        </tr>
                                        
                                         <!--Permission show Modal-->
                                        <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form method="POST" enctype="multipart/form-data" action="{{route('update_permissions')}}" style="width:100%">
                                                        <input name="id" type="hidden">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Permissions</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mt-2">
                                                            <div class="col-lg-4 col-md-4 col-6">
                                                                <input id="DashBoard" type="checkbox" name="DashBoard">
                                                                <label for="DashBoard">DashBoard</label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6">
                                                                <input  id="Users" type="checkbox" name="Users">
                                                                <label for="Users">Users</label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6">
                                                                <input id="Admin"  type="checkbox" name="Admin" >
                                                                <label for="Admin">Admin</label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6">
                                                                <input  id="Employees" type="checkbox" name="Employees">
                                                                <label for="Employees">Employees</label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6">
                                                                <input  id="Drivers" type="checkbox" name="Drivers">
                                                                <label for="Drivers">Drivers</label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6">
                                                                <input  id="Coupons" type="checkbox" name="Coupons">
                                                                <label for="Coupons">Coupons</label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6">
                                                                <input id="Charges" type="checkbox" name="Charges">
                                                                <label for="Charges">Charges</label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6">
                                                                <input id="Bookings" type="checkbox" name="Bookings">
                                                                <label for="Bookings">Bookings</label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6">
                                                                <input id="Mails" type="checkbox" name="Mails">
                                                                <label for="Mails">Mails</label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6">
                                                                <input id="Categories" type="checkbox" name="Categories">
                                                                <label for="Categories">Categories</label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6">
                                                                <input id="Banners" type="checkbox" name="Banners">
                                                                <label for="Banners">Banners</label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6">
                                                                <input id="RestrictedItems" type="checkbox" name="RestrictedItems">
                                                                <label for="RestrictedItems">Restricted Items</label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6">
                                                                <input  id="Vehicles" type="checkbox" name="Vehicles">
                                                                <label for="Vehicles">Vehicles</label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6">
                                                                <input id="RequestHistory" type="checkbox" name="RequestHistory">
                                                                <label for="RequestHistory">RequestHistory</label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6">
                                                                <input id="PendingRequests" type="checkbox" name="PendingRequests">
                                                                <label for="PendingRequests">PendingRequests</label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6">
                                                                <input  id="PaymentHistory" type="checkbox"  name="PaymentHistory">
                                                                <label for="PaymentHistory">PaymentHistory</label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6">
                                                                <input  id="Earnings" type="checkbox" name="Earnings">
                                                                <label for="Earnings">Earnings</label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6">
                                                                <input  id="FrontEndSettings" type="checkbox" name="FrontEndSettings">
                                                                <label for="FrontEndSettings">FrontEndSettings</label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
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
    
    

    <!-- Role / Permission add modal -->
    
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="POST" enctype="multipart/form-data" action="{{route('all_roles1')}}" style="width:100%">
                @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add New Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" required>
                        </div>
                    </div>
                    <h5 class="mt-4 text-center"><strong>Permissions</strong></h5>
                        <label><input type="checkbox" id="select-all" />&nbsp; <span style="color:blue;"> Choose all </span></label>
                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-4 col-6">
                            <input id="styled-checkbox-1" type="checkbox" value="1" name="DashBoard">
                            <label for="styled-checkbox-1">DashBoard</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-6">
                            <input class="styled-checkbox" id="styled-checkbox-2" type="checkbox" value="1" name="Users">
                            <label for="styled-checkbox-2">Users</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-6">
                            <input class="styled-checkbox" id="styled-checkbox-3" type="checkbox" value="1" name="Admin">
                            <label for="styled-checkbox-3">Admin</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-6">
                            <input class="styled-checkbox" id="styled-checkbox-4" type="checkbox" value="1" name="Employees">
                            <label for="styled-checkbox-4">Employees</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-6">
                            <input class="styled-checkbox" id="styled-checkbox-5" type="checkbox" value="1" name="Drivers">
                            <label for="styled-checkbox-5">Drivers</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-6">
                            <input class="styled-checkbox" id="styled-checkbox-6" type="checkbox" value="1" name="Coupons">
                            <label for="styled-checkbox-6">Coupons</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-6">
                            <input class="styled-checkbox" id="styled-checkbox-7" type="checkbox" value="1" name="Charges">
                            <label for="styled-checkbox-7">Charges</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-6">
                            <input class="styled-checkbox" id="styled-checkbox-8" type="checkbox" value="1" name="Bookings">
                            <label for="styled-checkbox-8">Bookings</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-6">
                            <input class="styled-checkbox" id="styled-checkbox-00" type="checkbox" value="1" name="Mails">
                            <label for="styled-checkbox-00">Mails</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-6">
                            <input class="styled-checkbox" id="styled-checkbox-9" type="checkbox" value="1" name="Categories">
                            <label for="styled-checkbox-9">Categories</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-6">
                            <input class="styled-checkbox" id="styled-checkbox-10" type="checkbox" value="1" name="Banners">
                            <label for="styled-checkbox-10">Banners</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-6">
                            <input class="styled-checkbox" id="styled-checkbox-10" type="checkbox" value="1" name="RestrictedItems">
                            <label for="styled-checkbox-10">Restricted Items</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-6">
                            <input class="styled-checkbox" id="styled-checkbox-11" type="checkbox" value="1" name="Vehicles">
                            <label for="styled-checkbox-11">Vehicles</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-6">
                            <input class="styled-checkbox" id="styled-checkbox-12" type="checkbox" value="1" name="RequestHistory">
                            <label for="styled-checkbox-12">RequestHistory</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-6">
                            <input class="styled-checkbox" id="styled-checkbox-14" type="checkbox" value="1" name="PendingRequests">
                            <label for="styled-checkbox-14">PendingRequests</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-6">
                            <input class="styled-checkbox" id="styled-checkbox-15" type="checkbox" value="1" name="PaymentHistory">
                            <label for="styled-checkbox-15">PaymentHistory</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-6">
                            <input class="styled-checkbox" id="styled-checkbox-16" type="checkbox" value="1" name="Earnings">
                            <label for="styled-checkbox-16">Earnings</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-6">
                            <input class="styled-checkbox" id="styled-checkbox-17" type="checkbox" value="1" name="FrontEndSettings">
                            <label for="styled-checkbox-17">FrontEndSettings</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Role</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    
    
   
<script>

 function role_detail(id)
    {
        id=id;
        $.ajax({
            url : 'role_detail/'+id,
            type: 'GET', //THIS NEEDS TO BE GET
            success: function (data) {
                console.log(data);
                $("input[name=id]").val(data.id);
                
                if(data.Admin == true) {  $("#Admin").attr('checked', true); }
                if(data.Admin == false ) { $('#Admin').attr('checked', false); }
              
                if(data.DashBoard == true) {  $("#DashBoard").attr('checked', true); }
                if(data.DashBoard == false ) { $('#DashBoard').attr('checked', false); }
              
                if(data.Users == true) {  $("#Users").attr('checked', true); }
                if(data.Users == false ) { $('#Users').attr('checked', false); }
              
                if(data.Employees == true) {  $("#Employees").attr('checked', true); }
                if(data.Employees == false ) { $('#Employees').attr('checked', false); }
              
                if(data.Drivers == true) {  $("#Drivers").attr('checked', true); }
                if(data.Drivers == false ) { $('#Drivers').attr('checked', false); }
              
                if(data.Coupons == true) {  $("#Coupons").attr('checked', true); }
                if(data.Coupons == false ) { $('#Coupons').attr('checked', false); }
              
                if(data.Charges == true) {  $("#Charges").attr('checked', true); }
                if(data.Charges == false ) { $('#Charges').attr('checked', false); }
              
                if(data.Bookings == true) {  $("#Bookings").attr('checked', true); }
                if(data.Bookings == false ) { $('#Bookings').attr('checked', false); }
                
                if(data.Mails == true) {  $("#Mails").attr('checked', true); }
                if(data.Mails == false ) { $('#Mails').attr('checked', false); }
              
                if(data.Categories == true) {  $("#Categories").attr('checked', true); }
                if(data.Categories == false ) { $('#Categories').attr('checked', false); }
              
                if(data.Banners == true) {  $("#Banners").attr('checked', true); }
                if(data.Banners == false ) { $('#Banners').attr('checked', false); }
                
                if(data.Banners == true) {  $("#RestrictedItems").attr('checked', true); }
                if(data.Banners == false ) { $('#RestrictedItems').attr('checked', false); }
              
                if(data.Vehicles == true) {  $("#Vehicles").attr('checked', true); }
                if(data.Vehicles == false ) { $('#Vehicles').attr('checked', false); }
              
                if(data.RequestHistory == true) {  $("#RequestHistory").attr('checked', true); }
                if(data.RequestHistory == false ) { $('#RequestHistory').attr('checked', false); }
              
                if(data.PendingRequests == true) {  $("#PendingRequests").attr('checked', true); }
                if(data.PendingRequests == false ) { $('#PendingRequests').attr('checked', false); }
              
                if(data.PaymentHistory == true) {  $("#PaymentHistory").attr('checked', true); }
                if(data.PaymentHistory == false ) { $('#PaymentHistory').attr('checked', false); }
              
                if(data.Earnings == true) {  $("#Earnings").attr('checked', true); }
                if(data.Earnings == false ) { $('#Earnings').attr('checked', false); }
                
                if(data.FrontEndSettings == true) {  $("#FrontEndSettings").attr('checked', true); }
                if(data.FrontEndSettings == false ) { $('#FrontEndSettings').attr('checked', false); }
              
            },
            error: function(e) {
                console.log(e);
            }
        });
    }

    var selectAllItems = "#select-all";
    var checkboxItem = ":checkbox";
    
    $(selectAllItems).click(function() {
    if (this.checked) {
        $(checkboxItem).each(function() {
          this.checked = true;
        });
    } else {
        $(checkboxItem).each(function() {
          this.checked = false;
        });
      }
      
    });

   
</script>
        

@endsection
