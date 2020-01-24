@extends('layouts.admin')

@section('title', 'View Video')

@section('content-header', 'Watch Video')

@section('breadcrumb')
	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active"><i class="fa fa-suitcase"></i>Watch Video</li>
@endsection

@section('content')

@include('notification.notify')
	<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
        </div>
        <div class="box-body">
            <video src="{{route('admin.video.stream',$slug)}}" controls height="300" poster="{{$video->image}}"></video>            
            <!-- <video src="{{route('admin.video.stream',$slug)}}" controls height="300"></video>             -->
        </div>
      </div>
    </div>
  </div>
@endsection
