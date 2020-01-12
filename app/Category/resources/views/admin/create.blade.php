@extends('layouts.admin')

@section('title', 'Add Category')

@section('content-header', 'Add Category')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dasboard</a></li>
    <li><a href="{{route('admin.category')}}"><i class="fa fa-suitcase"></i> Categories</a></li>
    <li class="active">Add Category</li>
@endsection

@section('content')

@include('notification.notify')

    <div class="row">

        <div class="col-md-10">

            <div class="box box-primary">

                <div class="box-header label-primary">
                    <b style="font-size:18px;">Add Category</b>
                    <a href="{{route('admin.category')}}" class="btn btn-default pull-right">Categories</a>
                </div>

                <form class="form-horizontal" action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data" role="form">
                    {{ csrf_field() }}

                    <div class="box-body">

                        <div class="form-group">
                            <label for="name" class="col-sm-1 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="name" name="name" placeholder="Category Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image" class="col-sm-1 control-label">Image</label>
                            <div class="col-sm-10">
                                <input type="file" required accept="image/png, image/jpeg" id="image" name="image" placeholder="Category Image">
                                <p class="help-block">Please enter .png .jpeg .jpg images only.</p>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <button type="reset" class="btn btn-danger">Cancel</button>
                        <button type="submit" class="btn btn-success pull-right">Save</button>
                    </div>
                </form>
            
            </div>

        </div>

    </div>

@endsection