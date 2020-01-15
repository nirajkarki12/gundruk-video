<?php

namespace App\Video\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Video\Models\Video;
use App\Video\Repository\VideoRepository;
use App\Category\Repository\CategoryRepository;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    protected $videoRepo;
    protected $categoryRepo;
    public function __construct(VideoRepository $videoRepo,CategoryRepository $categoryRepo)
    {
        $this->videoRepo=$videoRepo;
        $this->categoryRepo=$categoryRepo;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $videos=$this->videoRepo->all();
        return view('video::index',compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $categories=$this->categoryRepo->all();
        return view('video::create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        try
        {
            $validator=Validator::make($request->all(),[
                'title'=>'required|max:255',
                'video'=>'required',
                'tag'=>'required',
                'description'=>'required',
                'image'=>'required',
                'category'=>'required'
            ]);
            if($validator->fails())
            {
                throw new \Exception($validator->errors()->first(),1);
            }
        } catch (\Throwable $th) {
            return back()->with('flash_error',$th->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('video::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('video::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
