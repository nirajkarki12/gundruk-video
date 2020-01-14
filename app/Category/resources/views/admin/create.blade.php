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

        <div class="box-header with-border">
           <h3 class="box-title">Add New Category</h3>
           <div class="box-tools pull-right">
              <a href="{{route('admin.category')}}" class="btn btn-default pull-right">Categories</a>
           </div>
        </div>

        <form class="form-horizontal" action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data" role="form">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group">
              <label for="category" class="col-sm-1 control-label">Category</label>
              <div class="col-sm-10">
                  <select id="category" name="category_id" class="form-control">
                      <option value="">--Select Category--</option>
                      @foreach($categories as $i => $category)
                          <option value="{{ $category->id }}"
                              @if($category->id === $parentId)
                                  selected="selected"
                              @endif 
                              >{{ $category->name }}</option>

                          @foreach ($category->childrenCategories as $childCategory)
                              @include('category::admin/page-parts/child_category', ['child_category' => $childCategory, 'count' => 0, 'selected' => $parentId])
                          @endforeach
                      @endforeach
                  </select>
              </div>
                
            </div>

            <div class="form-group">
              <label for="name" class="col-sm-1 control-label">Name</label>
              <div class="col-sm-10">
                  <input type="text" required class="form-control" id="name" name="name" placeholder="Category Name">
              </div>
            </div>

            <div class="form-group">
              <label for="file" class="col-sm-1 control-label">Image</label>
              <div class="col-sm-10">
                  <input type="file" required accept="image/png, image/jpeg, image/jpg" id="file" name="file" placeholder="Category Image">
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

@section('scripts')
<script type="text/javascript">
    // $(document).ready(function() {
    //     $('#category').on("change", function() {
    //          $(this).children().text(function(i, value) {
    //             if (this.selected) return (value.replace(/[^\w\s]/gi, ''));
    //             return $(this).data("def_value");
    //         });

    //     }).children().each(function() {
    //         $(this).data("def_value", $(this).text());
    //     });
    // });
</script>
@endsection