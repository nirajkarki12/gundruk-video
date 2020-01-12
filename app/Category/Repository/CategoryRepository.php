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
        $data = $request->all();
        return $this->category->create($data);
    }

    public function update(Request $request, int $id) {
        //
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

    public function getCategory(int $categoryId) {
        return $this->category::where('id', $categoryId)
                ->first();
    }

}
