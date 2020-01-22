<?php
namespace App\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Common\Http\Controllers\BaseController;
use App\Setting\Repository\SettingRepository;
class SettingController extends BaseController
{
    protected $settingRepo;
    public function __construct(SettingRepository $settingRepo)
    {
        $this->settingRepo=$settingRepo;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $result=array();
        $disks=config('filesystems.disks');
        return view('setting::index',compact('result','disks'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('setting::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function save(Request $request)
    {
        return $this->settingRepo->create($request);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('setting::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('setting::edit');
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
