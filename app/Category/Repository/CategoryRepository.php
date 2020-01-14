<?php

namespace App\Category\Repository;

use Illuminate\Http\Request;
use App\Category\Models\Category;

class CategoryRepository
{
    // model property on class instances
    protected $category;

    public function __construct(Category $category) {
        $this->category = $category;
    }

    public function all() {
        return $this->category->get();
    }

    public function create(Request $request) {
        return $this->category->create($request->all());
    }

    public function update($request, string $slug) {
        return $this->category->where('slug', $slug)->update($request);
    }

    public function delete(int $id) {
        return $this->category->destroy($id);
    }

    public function show(int $id) {
        return $this->category->findOrFail($id);
    }

    public function getModel() {
        return $this->category;
    }

    public function setModel($category) {
        $this->category = $category;
        return $this;
    }

    public function with($relations) {
        return $this->category->with($relations);
    }

    public function getCategory(string $slug) {
        return $this->category::where('slug', $slug)
                ->first();
    }

    public function categoryWithParentPaginate($perPage = 10) {
        return $this->category->with('parent')->paginate($perPage);
    }

    public function categoryWithChildrens() {
        $category = $this->category
                    ->whereNull('category_id')
                    ->with('childrenCategories')
                    ;

        return $category->get();
    }

    public function categoryChildrens($parentId = null, $perPage = 10) {
        $category = $this->category
                    ->with('childrenCategories')
                    ;

        if($parentId)
        {
            $category->where('category_id', $parentId);
        }
        return $category->paginate($perPage);
    }

}
