<?php

namespace App\Channel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Channel\Interfaces\ChannelInterface;
use App\Common\Http\Helpers\Helper;
use Illuminate\Support\Facades\Validator;
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
        return $channels;
        return view('channel::index',compact('channels'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('channel::create');
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
                'name'=>'required|max:255',
                'image'=>'required|mimes:png,jpg,jpeg'
            ]);
            if($validator->fails())
            {
                throw new \Exception($validator->errors()->first(),1);
            }
            $input=$request->all();
            if($request->has('image'))
            {
                $input['image']=Helper::uploadImage($request->image,'channel');
            }

            $input['user_id']=auth()->guard('admin')->user()->id;
            if($this->repo->create($input))
            {
                return redirect()->route('admin.channels')->with('flash_success','Channel Created');
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
    public function destroy($id)
    {
        //
    }
}
