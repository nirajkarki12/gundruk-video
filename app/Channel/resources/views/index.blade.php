@extends('layouts.admin')

@section('title', 'Channels')

@section('content-header', 'Channels')

@section('breadcrumb')
	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active"><i class="fa fa-suitcase"></i> Channels</li>
@endsection

@section('content')

@include('notification.notify')
	<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
            <div class="box-tools pull-right">
            		<a href="{{route('admin.channel.create')}}" class="btn btn-default pull-right">Add Channel</a>
            </div>
            <br>
        </div>
        <div class="box-body">
        	@if(count($channels) > 0)
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>SN.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($channels as $key => $channel)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$channel->name}}</td>
                            <td>
                                <img src="{{$channel->image}}" alt="{{$channel->name}}" class="img-responsive" style="width:50px">
                            </td>
                            <td>
                                <ul class="admin-action btn btn-default pull-right">
                                    <li class="dropup">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        action <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="{{route('admin.channel.create' , $channel->id)}}">Edit</a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" onclick="return confirm('Are you sure?')" href="{{route('admin.channel.delete' ,$channel->slug)}}">Delete</a>
                                        </li>

                                    </ul>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $channels->links() }}
            @else
                <h3 class="no-result">No results found</h3>
            @endif
        </div>
      </div>
    </div>
  </div>
@endsection
