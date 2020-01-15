<?php

namespace App\Video\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Video\Models\Video;
use App\Video\Repository\VideoRepository;
use App\Category\Repository\CategoryRepository;
use Illuminate\Support\Facades\Validator;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\ContentRangeUploadHandler;
use Illuminate\Http\UploadedFile;
class VideoController extends Controller
{
    protected $videoRepo;
    protected $categoryRepo;
    public function __construct(VideoRepository $videoRepo,CategoryRepository $categoryRepo)
    {
        $this->videoRepo=$videoRepo;
        $this->categoryRepo=$categoryRepo;
    }
    
    public function upload(Request $request)
    {
    
        // create the file receiver
        $receiver = new FileReceiver("video", $request, ContentRangeUploadHandler::class);
    
        //return [$receiver];
        // check if the upload is success
        if ($receiver->isUploaded()) {
    
            // receive the file
            $save = $receiver->receive();
    
            // check if the upload has finished (in chunk mode it will send smaller files)
            if ($save->isFinished()) {
                // save the file and return any response you need
                $detail=$this->saveFile($save->getFile());
                $video=new Video();
                $video->title=$request->title;
                $video->description=$request->description;
                $video->url=$detail['path'].'/'.$detail['name'];
                $video->category_id=$request->category_id;
                $video->user_id=auth()->guard('admin')->user()->id;
                $video->save();

            } else {
                // we are in chunk mode, lets send the current progress
    
                /** @var ContentRangeUploadHandler $handler */
                $handler = $save->handler();
    
                return response()->json([
                    "start" => $handler->getBytesStart(),
                    "end" => $handler->getBytesEnd(),
                    "total" => $handler->getBytesTotal()
                ]);
            }
        } else {
            throw new UploadMissingFileException();
        }
    }
    
    protected function saveFile(UploadedFile $file)
    {
        $fileName = $this->createFilename($file);
        // Group files by mime type
        $mime = str_replace('/', '-', $file->getMimeType());
        // Group files by the date (week
        $dateFolder = date("Y-m");
        // Build the file path
        $filePath = "upload/{$mime}/{$dateFolder}/";
        $finalPath = storage_path("app/".$filePath);
        // move the file name
        $file->move($finalPath, $fileName);
        return ['path'=>$filePath,'name'=>$fileName,'mime'=>$mime];
        return response()->json([
            'path' => $filePath,
            'name' => $fileName,
            'mime_type' => $mime
        ]);
    }
    /**
     * Create unique filename for uploaded file
     * @param UploadedFile $file
     * @return string
     */
    protected function createFilename(UploadedFile $file)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = str_replace(".".$extension, "", $file->getClientOriginalName()); // Filename without extension
        // Add timestamp hash to name of the file
        $filename .= "_" . md5(time()) . "." . $extension;
        return $filename;
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
