<?php

namespace App\Category\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Common\Http\Controllers\BaseController;
use App\Category\Repository\CategoryRepository;
use App\Common\Http\Helpers\Helper;

class CategoryController extends BaseController
{
    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo)
    {
        // set the category repo
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $categories = $this->categoryRepo->categoryWithParentPaginate(10);
        return view('category::admin.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($slug = null)
    {
         $parentId = null;
         if($slug) 
         {
            $category = $this->categoryRepo->getCategory($slug);

            if($category) $parentId = $category->id;
         }
        $categories = $this->categoryRepo->categoryWithChildrens();
        return view('category::admin.create', compact('categories', 'parentId'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
      try {
        $validator = Validator::make( $request->all(), array(
               'name' => 'required|max:255',
               'file' => 'required|mimes:jpeg,jpg,png',
            )
        );
       
         if($validator->fails()) {
            throw new \Exception($validator->messages()->first(), 1);
            
         } else {
            
            if($file = Helper::uploadImage($request->file('file'), 'category')){
               $request->request->add(['image' => $file]);

               if(!$this->categoryRepo->create($request))
               {
                  Helper::deleteImage($file, 'category');
                  throw new \Exception("Something Went Wrong, Try Again!", 1);
               }
               
               return back()->with('flash_success', 'Category added Successfully');

            }else{

               throw new \Exception("Cannot upload image", 1);
            }
         }
      } catch (\Exception $e) {
         return back()->with('flash_error', $e->getMessage());
      }
    }

    /**
     * Show the specified resource.
     * @param int $slug
     * @return Response
     */
    public function show($slug)
    {
         try {
            if(!$slug) throw new \Exception("Category not found", 1);
            
            if(!$parent = $this->categoryRepo->getCategory($slug)) throw new \Exception("Category not found", 1);

            $categories = $this->categoryRepo->categoryChildrens($parent->id, 10);

            return view('category::admin.sub-category', compact('categories', 'parent'));
         } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
         }
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $slug
     * @return Response
     */
    public function edit($slug)
    {
        $allcategories = $this->categoryRepo->categoryWithChildrens($slug);
        $category = $this->categoryRepo->getCategory($slug);
        return view('category::admin/edit', compact('allcategories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $slug
     * @return Response
     */
    public function update(Request $request, $slug)
    {
        try {

            if(!$slug) throw new \Exception("Category not found", 1);

            $validator = Validator::make( $request->all(), array(
                  'name' => 'required|max:255',
               )
            );

            if($validator->fails()) {
               throw new \Exception($validator->messages()->first(), 1);
               
            } else {
               
               $data = array(
                  'name' => $request->name,
                  'category_id' => $request->category_id,
                  );               
               if($request->file('file'))
               {
                  $data['image'] = Helper::uploadImage($request->file('file'), 'category');
               }

               $category = $this->categoryRepo->update($data, $slug);
               
               if(!$category)
               {
                  throw new \Exception("Something Went Wrong, Try Again!", 1);
               }
                  
               return back()->with('flash_success', 'Category updated Successfully');
               
            }
         } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
         }
    }

    /**
     * enable/disable category status.
     * @param string $slug
     * @return Response
     */
    public function approve($slug, int $status)
    {
        try {
            if(!$slug) throw new \Exception("Category not found", 1);
           
            if(!$this->categoryRepo->update(['status' => $status], $slug)) throw new \Exception("Error Processing Request", 1);

            if($status == 1)
            {
               $message = 'Category enabled Successfully';
            }else{
               $message = 'Category disabled Successfully';
            }
            return back()->with('flash_success', $message);
               
        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param string $slug
     * @return Response
     */
    public function destroy($slug)
    {
        try {
            if(!$slug) throw new \Exception("Category not found", 1);
            
            if(!$category = $this->categoryRepo->getCategory($slug)) throw new \Exception("Category not found", 1);
            $file = $category->image;

            if(!$this->categoryRepo->delete($category->id)) throw new \Exception("Error Processing Request", 1);
            Helper::deleteImage($file, 'category');

            return back()->with('flash_success', 'Category Deleted Successfully');
               
        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }
    }
}
