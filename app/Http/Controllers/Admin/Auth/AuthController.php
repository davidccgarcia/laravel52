<?php

namespace App\Http\Controllers\Admin\Auth;

use Validator;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
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

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where the user show login view
     * 
     * @var string
     */
    protected $loginView = 'admin.auth.login';

    /**
     * Where the user show register view
     * 
     * @var string
     */
    protected $registerView = 'admin.auth.register';

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Where to redirect users after registration.
     *
     * @return string
     */
    protected $redirectPath = '/admin/login';

    /**
     * 
     * @var string
     */
    protected $guard = 'admin';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'full_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Admin
     */
    protected function create(array $data)
    {
        $user = new Admin([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $token = str_random(45);
        $user->registration_token = $token;

        $url = url('admin/confirmation', ['registration_token' => $token]);


        Mail::send('email.registration', compact('user', 'url'), function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject(trans('email.registration'));
        });

        $user->save();

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
        $this->create($request->all());

        return redirect($this->redirectPath)
            ->with('success', trans('email.registration'));
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return [
            'email' => $request->get('email'), 
            'password' => $request->get('password'), 
            'registration_token' => null
        ];
    }

    /**
     * Get the needed registration token to login users
     *
     */
    protected function getConfirmation($token)
    {
        $user = Admin::where('registration_token', $token)->firstOrFail();
        $user->registration_token = null;
        $user->save();

        return redirect($this->redirectPath)
            ->with('success', trans('email.confirmation'));
    }
}
