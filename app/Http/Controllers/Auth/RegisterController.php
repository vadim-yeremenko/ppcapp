<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\NewUserRequest;
use Illuminate\Support\Str;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Notification;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
//        $validate = Validator::make($data, [
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'password' => ['required', 'string', 'min:8', 'confirmed'],
//            'organization' => ['required', 'string', 'min:8'],
//            'role' => ['required', 'string', 'min:8'],
//        ]);
//
//        if($validate->fails()) {
//            return response()->json(['errors'=>$validate->errors()]);
//        } else {
//            return true;
//        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'organization' => $data['organization'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
            'api_token' => Str::random(60),
        ]);

        $user->assignRole('customer');
    }

    public function handle(UserHasRegistered $event)
    {
        $user = $event->user;

        $notification = new NewUser($user);

        $admins = User::whereHas('roles', function ($query) {

            $query->where('name', '=', 'admin');

        })->get();

        Notification::send($admins, $notification);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        //$this->validator($request->all())->validate();
        $validate = Validator::make($request -> all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'organization' => ['required'],
            'role' => ['required'],
        ]);

        if($validate->fails()) {
            return response()->json(['errors'=>$validate->errors()]);
        }

        $this->create($request->all());



        $returnHTML = view('authorization.registered')->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));
        //The auto login code has been removed from here.

        //return redirect($this->redirectPath());

        //return redirect('/registration')->with('success','welcome '. $user->name . ' you are registered');
    }

//    public function registered() {
//        return view('authorization.registered');
//    }
}
