@extends('layouts.admin')

@section('title', 'Profile')

@section('content-header', 'Profile')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active"><i class="fa fa-diamond"></i> Profile</li>
@endsection

@section('content')

@include('notification.notify')

    <div class="row">

        <div class="col-md-4">

            <div class="box box-primary">

                <div class="box-body box-profile">

                    <img class="profile-user-img img-responsive img-circle" src="@if(Auth::guard('admin')->user()->picture) {{Auth::guard('admin')->user()->picture}} @else {{asset('placeholder.png')}} @endif" alt="User profile picture">

                    <h3 class="profile-username text-center">{{Auth::guard('admin')->user()->name}}</h3>

                    <p class="text-muted text-center">admin</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Username</b> <a class="pull-right">{{Auth::guard('admin')->user()->name}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <a class="pull-right">{{Auth::guard('admin')->user()->email}}</a>
                        </li>

                        <li class="list-group-item">
                            <b>Mobile</b> <a class="pull-right">{{Auth::guard('admin')->user()->mobile}}</a>
                        </li>

                        <li class="list-group-item">
                            <b>Address</b> <a class="pull-right">{{Auth::guard('admin')->user()->address}}</a>
                        </li>
                    </ul>
                
                </div>

            </div>

        </div>

         <div class="col-md-8">
            <div class="nav-tabs-custom">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#adminprofile" data-toggle="tab">Update Profile</a></li>
                    <li><a href="#image" data-toggle="tab">Upload Image</a></li>
                    <li><a href="#password" data-toggle="tab">Change Password</a></li>
                </ul>
               
                <div class="tab-content">
                   
                    <div class="active tab-pane" id="adminprofile">

                        <form class="form-horizontal" action="{{(Setting::get('admin_delete_control') == 1) ? '' : route('admin.profile.save')}}" method="POST" enctype="multipart/form-data" role="form">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{Auth::guard('admin')->user()->id}}">

                            <div class="form-group">
                                <label for="name" required class="col-sm-2 control-label">Username</label>

                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="name"  name="name" value="{{Auth::guard('admin')->user()->name}}" placeholder="username" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                  <input type="email" required value="{{Auth::guard('admin')->user()->email}}" name="email" class="form-control" id="email" placeholder="email">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="mobile" class="col-sm-2 control-label">Mobile</label>

                                <div class="col-sm-10">
                                  <input type="text" required value="{{Auth::guard('admin')->user()->mobile}}" name="mobile" class="form-control" id="mobile" placeholder="mobile" pattern="[0-9]{10}">
                                  <small style="color:brown">Note : The mobile must be 10 digits.</small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="col-sm-2 control-label">Address</label>

                                <div class="col-sm-10">
                                  <input type="text" required value="{{Auth::guard('admin')->user()->address}}" name="address" class="form-control" id="address" placeholder="address">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    @if(Setting::get('admin_delete_control') == 1)
                                        <button type="submit" class="btn btn-danger" disabled>submit</button>
                                    @else`
                                        <button type="submit" class="btn btn-danger">submit</button>
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="tab-pane" id="image">

                        <form class="form-horizontal" action="{{(Setting::get('admin_delete_control') == 1) ? '' : route('admin.profile.save')}}" method="POST" enctype="multipart/form-data" role="form">
                            {{ csrf_field() }}

                            <input type="hidden" name="id" value="{{Auth::guard('admin')->user()->id}}">

                            @if(Auth::guard('admin')->user()->picture)
                                <img style="height: 90px; margin-bottom: 15px; border-radius:2em;" src="{{Auth::guard('admin')->user()->picture}}">
                            @else
                                <img style="margin-left: 15px;margin-bottom: 10px" class="profile-user-img img-responsive img-circle"  src="{{asset('placeholder.png')}}">
                            @endif

                            <div class="form-group">
                                <label for="picture" class="col-sm-2 control-label">Picture</label>

                                <div class="col-sm-10">
                                  <input type="file" required accept="image/png,image/jpeg" name="picture" id="picture">
                                  <p class="help-block">Please enter .png .jpeg .jpg images only.</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    @if(Setting::get('admin_delete_control') == 1) 
                                        <button type="submit" class="btn btn-danger" disabled>submit</button>
                                    @else 
                                        <button type="submit" class="btn btn-danger">submit</button>
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="tab-pane" id="password">

                        <form class="form-horizontal" action="{{ (Setting::get('admin_delete_control') == 1) ? '' : route('admin.change.password')}}" method="POST" enctype="multipart/form-data" role="form">
                            {{ csrf_field() }}

                            <input type="hidden" name="id" value="{{Auth::guard('admin')->user()->id}}">

                            <div class="form-group">
                                <label for="old_password" class="col-sm-3 control-label">Old Password</label>

                                <div class="col-sm-8">
                                  <input required type="password" class="form-control" name="old_password" id="old_password" placeholder="Old Password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-sm-3 control-label">New Password</label>

                                <div class="col-sm-8">
                                  <input required type="password" class="form-control" name="password" id="password" placeholder="New Password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="confirm_password" class="col-sm-3 control-label">Confirm Password</label>

                                <div class="col-sm-8">
                                  <input required type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    @if(Setting::get('admin_delete_control') == 1)
                                        <button type="submit" class="btn btn-danger" disabled>Delete</button>
                                    @else
                                        <button type="submit" class="btn btn-success">Save</button>
                                    @endif
                                </div>
                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection