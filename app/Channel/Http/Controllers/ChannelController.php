<?php

namespace App\Channel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Channel\Interfaces\ChannelInterface;
use App\Common\Http\Helpers\Helper;
use Illuminate\Support\Facades\Validator;
use App\Channel\Models\Channel;
class ChannelController extends Controller
{
    protected $repo;
    public function __construct(ChannelInterface $repo)
    {
        $this->repo=$repo;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $channels=$this->repo->all();
        // return $channels;
        return view('channel::index',compact('channels'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Channel $channel=null)
    {
        return view('channel::create',compact('channel'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request,Channel $channel=null)
    {
        try
        {
            $messages=array('name'=>'required|max:255');

            if(!$channel)
            {
                $messages['image']='required|mimes:png,jpg,jpeg';
            }

            $validator=Validator::make($request->all(),$messages);
            if($validator->fails())
            {
                throw new \Exception($validator->errors()->first(),1);
            }
            $input=$request->all();
            if($request->has('image'))
            {
                if($channel)
                {
                    Helper::deleteImage($channel->getOriginal('image'),'channel');
                }
                $input['image']=Helper::uploadImage($request->image,'channel');
            }

            $input['user_id']=auth()->guard('admin')->user()->id;

            $status=false;
            if($channel)
            {
                $status=$this->repo->update($input,$channel);
            }
            else
            {
                $status=$this->repo->create($input);
            }

            if($status)
            {
                return redirect()->route('admin.channels')->with('flash_success','Channel'.$channel?' updated':' created');
            }
            else
            {
                throw new \Exception("Sorry! video can not be uploaded this time.",1);
            }
        } catch (\Throwable $th){
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
        return view('channel::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('channel::edit');
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
            $this->repo->delete($slug);
            return back()->with('flash_success','Channel deleted');
        } catch (\Throwable $th) {
            return back()->with('flash_error',$th->getMessage());
        }
    }
}
