<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Image;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;


class AdminLoginController extends Controller
{
	public function __construct()
	{
      $this->middleware('guest:admin', ['except' => ['logout']]);
	}

    public function showLoginform()
    {
    	return view('auth.admin-login');
    }

    public function login(Request $request)
    {
       $this->validate($request, [
         'email'    => 'required|email',
         'password' => 'required|min:6'

       ]);       
       
       if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
       	{
       		return redirect()->intended(route('admin.dashboard'));
       	}
        
        return $this->sendFailedLoginResponse($request);
       	
    }

    public function logout()
    {
       Auth::guard('admin')->logout();
       return redirect()->route('admin.login');
    } 


    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    public function username()
    {
        return 'email';
    }           
}
