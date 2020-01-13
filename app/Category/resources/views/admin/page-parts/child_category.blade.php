<option value="{{ $child_category->id }}">
	@for($i = 0; $i <= $count; $i++)
	-
	@endfor
	{{ $child_category->name }}
</option>
@if ($child_category->categories)
  @foreach ($child_category->categories as $childCategory)
      @include('category::admin/page-parts/child_category', ['child_category' => $childCategory, 'count' => ($count + 1)])
  @endforeach
@endif