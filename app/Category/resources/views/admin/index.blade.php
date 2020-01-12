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
      	<div class="box-header label-primary">
            <b style="font-size:18px;">Categories</b>
            <a href="{{route('admin.category.create')}}" class="btn btn-default pull-right">Add Category</a>
        </div>
        <div class="box-body">

        	@if(count($categories) > 0)

          	<table id="example1" class="table table-bordered table-striped">
							<thead>
						    <tr>
						      <th>Id</th>
						      <th>Name</th>
						      <th>Image</th>
						      <th>Parent Category</th>
						      <th>Status</th>
						      <th>Created At</th>
						      <th>action</th>
						    </tr>
							</thead>

							<tbody>
								@foreach($categories as $i => $category)
							    <tr>
						      	<td>{{$i+1}}</td>
						      	<td>{{$category->name}}</td>
						      	<td><img style="height: 30px;" src="{{$category->picture}}"></td>
							      <td>
							      		@if($category->status)
							      			<span class="label label-success">Active</span>
							       		@else
							       			<span class="label label-warning">Inactive</span>
							       		@endif
										</td>
							      <td>
        							<ul class="admin-action btn btn-default">
        								<li class="dropup">
						                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
						                  action <span class="caret"></span>
						                </a>
						                <ul class="dropdown-menu">
						                  	<li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="{{route('admin.category.edit' , array('id' => $category->id))}}">Edit</a>
                                </li>
						                  	<li role="presentation">
					                  			<a role="menuitem" tabindex="-1" onclick="return confirm('Are you sure?')" href="{{route('admin.category.delete' , array('category_id' => $category->id))}}">Delete</a>
						                  	</li>

																<li class="divider" role="presentation"></li>

						                  	@if($category->status)
						                  		<li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('admin.category.approve' , array('id' => $category->id , 'status' =>0))}}">Disable</a></li>
						                  	@else
						                  		<li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('admin.category.approve' , array('id' => $category->id , 'status' => 1))}}">Enable</a></li>
						                  	@endif

						                  	<li class="divider" role="presentation"></li>

						                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('admin.add.sub_category' , array('category' => $category->id))}}">Add Sub Category</a></li>
						                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('admin.sub_categories' , array('category' => $category->id))}}">View Sub Category</a></li>
						                </ul>
          								</li>
        							</ul>
							      </td>
							    </tr>
								@endforeach
							</tbody>
						</table>
					@else
						<h3 class="no-result">No results found</h3>
					@endif
        </div>
      </div>
    </div>
  </div>

@endsection
