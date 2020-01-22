@extends('layouts.admin')

@section('title', 'Videos')

@section('content-header', 'Videos')

@section('breadcrumb')
	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active"><i class="fa fa-suitcase"></i> Videos</li>
@endsection

@section('content')

@include('notification.notify')
	<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">List of Videos</h3>
            <div class="box-tools pull-right">
            		<a href="{{route('admin.video.create')}}" class="btn btn-default pull-right">Add Video</a>
            </div>
        </div>
        <div class="box-body">
        	@if(count($videos) > 0)
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>SN.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($videos as $key => $video)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$video->title}}</td>
                            <td>
                                <img src="{{$video->image}}" alt="{{$video->title}}" class="img-responsive" style="width:50px">
                            </td>
                            <td>{{$video->category->name}}</td>
                            <td>{{$video->published?'Published':'Pending'}}</td>
                            <td>
                                <ul class="admin-action btn btn-default pull-right">
                                    <li class="dropup">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        action <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="{{route('admin.category.edit' , array('slug' => $video->category->slug))}}">Edit</a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="{{route('admin.video.show' , $video->slug)}}">Watch</a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" onclick="return confirm('Are you sure?')" href="{{route('admin.video.delete' ,$video->slug)}}">Trash</a>
                                        </li>

                                    </ul>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $videos->links() }}
            @else
                <h3 class="no-result">No results found</h3>
            @endif
        </div>
      </div>
    </div>
  </div>
@endsection
