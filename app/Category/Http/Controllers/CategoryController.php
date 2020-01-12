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
        $categories = $this->categoryRepo->all();
        return view('category::admin.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('category::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make( $request->all(), array(
                'name' => 'required|max:255',
                'image' => 'required|mimes:jpeg,jpg,bmp,png',
            )
        );
       
        if($validator->fails()) {
            return back()->with('flash_error', $validator->messages()->first());

        } else {
            

            if($request->hasFile('image') && $request->file('image')->isValid()) {
                $category->image = Helper::uploadPicture($request->file('image'), 'category');
            }
            $category = $this->categoryRepo->create($request);

            if($category) {
                return back()->with('flash_success', 'Category added Successfully');
            } else {
                return back()->with('flash_error', 'Something Went Wrong, Try Again!');
            }

        }
    }

    /**
     * Show the specified resource.
     * @param int $slug
     * @return Response
     */
    public function show($slug)
    {
        return view('category::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $slug
     * @return Response
     */
    public function edit($slug)
    {
        return view('category::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $slug
     * @return Response
     */
    public function update(Request $request, $slug)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param string $slug
     * @return Response
     */
    public function destroy($slug)
    {
        //
    }
}
