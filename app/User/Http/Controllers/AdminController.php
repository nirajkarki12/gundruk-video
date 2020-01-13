<?php

namespace App\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Common\Http\Controllers\BaseController;
use App\User\Models\Admin;
use App\Common\Http\Helpers\Helper;
class AdminController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	//
    }

    public function profile() {
        $admin = \Auth::guard('admin')->user();
        return view('user::admin.profile', compact('admin'));
    }

    public function profileSave(Request $request) {

        $validator = Validator::make( $request->all(), array(
                'name' => 'max:255',
                'email' => 'email|max:255|unique:mysql2.admins,email, ' . $request->id,
                'mobile' => 'digits_between:6,13',
                'address' => 'max:300',
                'id' => 'required|exists:mysql2.admins,id',
                'picture' => 'mimes:jpeg,jpg,png'
            )
        );
        
        if($validator->fails()) {
            return back()->with('flash_error', $validator->messages()->first());
        } else {
            
            $admin = Admin::find($request->id);
            $admin->name = $request->has('name') ? $request->name : $admin->name;
            $admin->email = $request->has('email') ? $request->email : $admin->email;
            $admin->mobile = $request->has('mobile') ? $request->mobile : $admin->mobile;
            $admin->address = $request->has('address') ? $request->address : $admin->address;

            if($request->hasFile('picture')) {
                Helper::deleteImage(basename($admin->picture),'admins');
                $admin->picture = Helper::uploadImage($request->picture,'admins');
            }

            $admin->update();

            return back()->with('flash_success', 'Admin Details updated Successfully');
        }
    
    }

    public function changePassword(Request $request) {
        $old_password = $request->old_password;
        $new_password = $request->password;
        $confirm_password = $request->confirm_password;
        
        $validator = Validator::make($request->all(), [              
                'password' => 'required|min:6',
                'old_password' => 'required',
                'confirm_password' => 'required|min:6',
                'id' => 'required|exists:mysql2.admins,id'
            ]);

        if($validator->fails()) {
            return back()->with('flash_error', $validator->messages()->first());
        } else {
            $admin = Admin::find($request->id);

            if(Hash::check($old_password, $admin->password))
            {
                $admin->password = Hash::make($new_password);
                $admin->save();

                return back()->with('flash_success', 'Password Updated successfully');
                
            } else {
                return back()->with('flash_error', 'New and Confirm Password mismatched');
            }
        }

        $response = response()->json($response_array,$response_code);

        return $response;
    }


}
