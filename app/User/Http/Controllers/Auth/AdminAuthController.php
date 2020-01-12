<?php

namespace App\User\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use App\Common\Http\Controllers\BaseController;
use App\User\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration / logout.
     *
     * @var string
     */
    protected $redirectTo = 'admin';

    protected $redirectAfterLogout = '/admin/login';

    /**
     * The Register form view that should be used.
     *
     * @var string
     */

    protected $registerView = 'user::admin.auth.register';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guestadmin', ['except' => 'logout']);
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showLoginForm()
    {
        return view('user::admin.auth.login');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    // protected function authenticated(Request $request, Admin $admin){

    //     if(\Auth::guard('admin')->check()) {
    //         if($admin = Admin::find(\Auth::guard('admin')->user()->id)) {
    //             $admin->save();
    //         }   
    //     };
    //    return redirect()->intended($this->redirectPath());
    // }
}