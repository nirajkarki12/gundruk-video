@extends('layouts.admin')

@section('title', 'Categories')

@section('content-header', 'Categories')

@section('breadcrumb')
	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active"><i class="fa fa-suitcase"></i> Categories</li>
@endsection

@section('content')

@include('notification.notify')

	<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">List of Categories</h3>
            <div class="box-tools pull-right">
            		<a href="{{route('admin.category.create')}}" class="btn btn-default pull-right">Add Category</a>
            </div>
        </div>
        <div class="box-body">

        	@if(count($categories) > 0)

          	<table id="example1" class="table table-bordered table-striped">
							<thead>
						    <tr>
						      <th>SN.</th>
						      <th>Name</th>
						      <th>Image</th>
						      <th>Parent Category</th>
						      <th>Status</th>
						      <th>Created At</th>
						      <th>action</th>
						    </tr>
							</thead>

							<tbody>
								@foreach($categories as $key => $category)
							    <tr>
						      	<td>{{ $categories->firstItem() + $key }}</td>
						      	<td>{{ $category->name }}</td>
						      	<td><img src="{{ $category->image_full_path }}" width="30"></td>
						      	<td>{{ $category->parent ? $category->parent->name : '-' }}</td>
								<td>
									@if($category->status)
										<span class="label label-success">Active</span>
									@else
										<span class="label label-warning">Inactive</span>
									@endif
								</td>
						      	<td>{{ $category->created_at->format('Y-m-d') }}</td>
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
						{{ $categories->links() }}
					@else
						<h3 class="no-result">No results found</h3>
					@endif
        </div>
      </div>
    </div>
  </div>

@endsection
