<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Mail;
use App\Mail\WelcomeMail;
use App\Mail\NewRegisterationMail;
use App\Mail\VerifyMail;


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
    protected $redirectTo = '/home';

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
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'token' => str_random(40),

        ]);

       //Assigning Role to Users
        $user->assignRole($data['role']);
        return $user;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //Sending-User-Welcome-Email-With-Verification-Link 
         \Mail::to($request->input('email'))->send(new VerifyMail($user));
        
        //Sending-Admin-New-User-Email-Registered
         \Mail::to('teamphp00@gmail.com')->send(new NewRegisterationMail($user));

        return redirect('login')->with("link_success","We sent you an activation code. Check your email and click on the link to verify");   

        #$this->guard()->login($user);
        #return $this->registered($request, $user)
                        #?: redirect($this->redirectPath());
    }


    public function verifyUser($role, $token)
    {
        $user = User::where('token', $token)->first();
        
        if(isset($user) ){
         
            if($user->registeration_status != 1) {
             $user->registeration_status = 1;
             $user->login_status = 1;
             $user->save();
             $status = "Your e-mail is verified. You can now login.";
            
            }else{
            $status = "Your e-mail is already verified. You can now login.";
            }

        }else{
        return redirect('login')->with('danger', "Sorry your email cannot be identified.");
        }
        
        if($role == 'user'){
        return redirect('login')->with('success', $status);
        }else{
        return redirect()->route('owner.login')->with('success', $status);    
        }
    }

}
