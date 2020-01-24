@extends('layouts.admin')

@section('title', $channel?'Update Channel':'Create Channel')

@section('content-header',  $channel?'Update Channel':'Create Channel')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>home</a></li>
    <li class="active"><i class="fa fa-camera"></i>{{$channel?'Update':'Create'}} Channel</li>
@endsection

@section('content')

    <div class="row">

    @include('notification.notify')
    
    <div class="col-md-12">
        <div class="nav-tabs-custom">

                <ul class="nav nav-tabs">
                    <!-- <li class="active"><a href="#general" data-toggle="tab">General</a></li> -->
                </ul>
               
                <div class="tab-content">
                   
                    <div class="active tab-pane" id="general">
                      
                        <form id="form-upload" action="{{route('admin.channel.store',$channel?$channel:'')}}" method="POST" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="box-body">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sitename">Channel Name *</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter channel name" value="{{$channel?$channel->name:''}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sitename">Image *</label>
                                        <input type="file" name="image" class="form-control" id="image">
                                    </div>
                                    @if($channel)
                                    <img src="{{$channel->image}}" alt="{{$channel->name}}" class="img-responsive" style="width:50px">
                                    @endif
                                </div>

                          </div>
                          <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">{{$channel?'Update':'Create'}}</button>
                        </div>
                        </form>

                          
                    </div>
                </div>

            </div>
           
        </div>
</div>
    </div>
@endsection