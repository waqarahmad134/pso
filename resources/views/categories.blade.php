@extends('welcome')
@section('content')


@section('title', 'Categories |  Admin')
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Categories (What are you sending)</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Categories</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Add New Category</button>

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
                                        <th>Serial #</th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>18 +</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    @foreach($data as $da)
                                    <tr>
                                        <td>{{$count++}}</td>
                                        <td>{{$da->id}}</td>
                                        <td>{{$da->name}}</td>
                                        <td>
                                            <img class="img-fluid" src="{{env('BASE_URL')}}/{{$da->Image}}" width="80" loading="lazy">
                                        </td>
                                        <td>{{$da->adult_18plus == true ? "Yes":"No"}}</td>
                                        <td>{{date('d,M Y h:i:s',strtotime($da->createdAt))}}</td>
                                        <td>
                                            @if($da->status==1)
                                            <span>Active</span>
                                            @else
                                            <span>Block</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($da->status==1)
                                            <a href="{{route('cat_block',['id'=>$da->id])}}" class="btn" style="background-color: #910735; color: white;">Block</a>
                                            @else
                                            <a href="{{route('cat_activate',['id'=>$da->id])}}" class="btn" style="background-color: #310835; color: white;">Active</a>
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

<!-- Vertically centered -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width:200%;padding:5%">
            <form method="POST" enctype="multipart/form-data" id="categoryForm" onsubmit="disableSubmitButton(event)">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <label>Category</label>
                            <input name="name" type="text" class="form-control" required>
                            <label>Adult 18+</label>
                            <select class="form-control" name="adult_18plus" aria-label="Default select example" required>
                                <option selected>Please Add 18+</option>
                                <option value="false">NO</option>
                                <option value="true">Yes</option>
                            </select>
                            <label>Image (256x256)</label>
                            <input class="dropify" name="Image" type="file" class="form-control" required loading="lazy">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="addCategoryBtn">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function disableSubmitButton(event) {
        event.preventDefault();
        document.getElementById('addCategoryBtn').disabled = true;
        document.getElementById('categoryForm').submit();
    }
</script>
@endsection