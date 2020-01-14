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
                        <th>slug</th>
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
                            <td>{{$video->slug}}</td>
                            <td>{{$video->slug}}</td>
                            <td>{{$video->category->name}}</td>
                            <td>{{$video->published?'Published':'Pending'}}</td>
                            <td>
                                <ul class="admin-action btn btn-default">
                                    <li class="dropup">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        action <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li role="presentation">
                                        <a role="menuitem" tabindex="-1" href="{{route('admin.category.edit' , array('slug' => $category->slug))}}">Edit</a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" onclick="return confirm('Are you sure?')" href="{{route('admin.category.delete' , array('slug' => $category->slug))}}">Delete</a>
                                        </li>

                                        <li class="divider" role="presentation"></li>

                                            @if($category->status)
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('admin.category.approve' , array('slug' => $category->slug , 'status' =>0))}}">Disable</a></li>
                                            @else
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('admin.category.approve' , array('slug' => $category->slug , 'status' => 1))}}">Enable</a></li>
                                            @endif

                                        <li class="divider" role="presentation"></li>

                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('admin.category.create' , array('slug' => $category->slug))}}">Add Sub Category</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('admin.category.view' , array('slug' => $category->slug))}}">View Sub Category</a></li>
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
@section('scripts')

@endsection