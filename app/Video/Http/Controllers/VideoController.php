<?php

namespace App\Video\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Video\Models\Video;
use App\Tag\Repository\TagRepository;
use App\Video\Repository\VideoRepository;
use App\Category\Repository\CategoryRepository;
use Illuminate\Support\Facades\Validator;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\ContentRangeUploadHandler;
use Illuminate\Http\UploadedFile;
use App\Tag\Models\Tag;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use App\Common\Http\Helpers\Helper;
use Storage;
use Carbon\Carbon;
use App\Video\Stream\Stream;
use App\Common\Http\Helpers\Settings;
class VideoController extends Controller
{
    protected $videoRepo;
    protected $categoryRepo,$tagModel;
    protected $disk;
    public function __construct(VideoRepository $videoRepo,CategoryRepository $categoryRepo,Tag $tagModel)
    {
        $this->videoRepo=$videoRepo;
        $this->categoryRepo=$categoryRepo;
        $this->tagModel=$tagModel;
        $this->disk=Storage::disk(Settings::get('uploaddisk'));
    }
    
    public function upload(Request $request)
    {
        // $detail=$this->saveFile($request->video);
    
        // return $request->all();
        // create the file receiver
        //$receiver = new FileReceiver("video", $request, ContentRangeUploadHandler::class);
    
        //return [$receiver];
        // check if the upload is success
        // if ($receiver->isUploaded()) {
    
        //     // receive the file
        //     $save = $receiver->receive();
    
        //     // check if the upload has finished (in chunk mode it will send smaller files)
        //     if ($save->isFinished()) {
        //         // save the file and return any response you need
        //         // $video=new Video();
        //         // $video->title=$request->title;
        //         // $video->description=$request->description;
        //         // $video->url=$detail['path'].$detail['name'];
        //         // $video->category_id=$request->category_id;
        //         // $video->user_id=auth()->guard('admin')->user()->id;
        //         // $video->save();
        //         //return redirect()->back()->with('flash_success','Video Upload Successful');
        //     } else {
        //         // we are in chunk mode, lets send the current progress
    
        //         /** @var ContentRangeUploadHandler $handler */
        //         $handler = $save->handler();
    
        //         return response()->json([
        //             "start" => $handler->getBytesStart(),
        //             "end" => $handler->getBytesEnd(),
        //             "total" => $handler->getBytesTotal()
        //         ]);
        //     }
        // } else {
        //     throw new UploadMissingFileException();
        // }
    }
    
    protected function saveFile(UploadedFile $file)
    {
        $fileName = $this->createFilename($file);
        // Group files by mime type
        $mime = str_replace('/', '-', $file->getMimeType());
        // Group files by the date (week
        $dateFolder = date("Y-m");
        // Build the file path
        $filePath = "ftp/{$mime}/{$dateFolder}/";
        //$finalPath = storage_path("app/".$filePath);
        // move the file name
        $this->disk->put($filePath.$fileName,\fopen($file,'r+'));

        // $file->move($finalPath, $fileName);
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
                'category_id'=>'required',
            ]);
            if($validator->fails())
            {
                throw new \Exception($validator->errors()->first(),1);
            }
            $input=$request->all();

            $videoDetail=$this->saveFile($request->video);

            if($request->has('image'))
            {
                $imageDetail=$this->saveFile($request->image);
            }

            $input['user_id']=auth()->guard('admin')->user()->id;

            $input['url']=$videoDetail['path'].$videoDetail['name'];

            $input['image']=$imageDetail['path'].$imageDetail['name'];
            if($this->videoRepo->create($input))
            {
                return response()->json([
                    'status'=>true,
                    'message'=>'Video created successfully'
                ]);
            }
            else
            {
                throw new \Exception("Sorry! video can not be uploaded this time.",1);
            }
        } catch (\Throwable $th) {
            return trigger_error($th->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($slug)
    {
        $video=$this->videoRepo->show($slug);
        return view('video::show',compact('video','slug'));
    }

    public function stream($slug)
    {
        $video=$this->videoRepo->show($slug);
        $stream=new Stream($video->url);
        return $stream->start();
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
    public function destroy($slug)
    {
        try {
            $this->videoRepo->delete($slug);
            return redirect()->route('admin.videos')->with('flash_success','Video deleted successfully');
        } catch (\Throwable $th) {
            return back()->with('flash_error',$th->getMessage());
        }
    }

    public function deleted()
    {
        $videos=$this->videoRepo->deleted();
        return view('video::deleted',compact('videos'));
    }

    public function unDelete($slug)
    {
        try {
            $this->videoRepo->unDelete($slug);
            return redirect()->route('admin.videos')->with('flash_success','Video undeleted');
        } catch (\Throwable $th) {
            return back()->with('flash_error','Video can not be undelete');
        }
    }

    public function parmanentDestroy($slug)
    {
        try {
            $this->videoRepo->parmanentDestroy($slug);
            return redirect()->route('admin.video.deleted')->with('flash_success','Video deleted successfully');
        } catch (\Throwable $th) {
            return back()->with('flash_error',$th->getMessage());
        }
    }

    public function list()
    {
        $files=array();
        $directories=$this->disk->allDirectories();
        foreach($directories as $directory)
        {
            if($this->disk->files($directory))
                array_push($files,$this->disk->files($directory));
        }
        return $files;
    }

}
