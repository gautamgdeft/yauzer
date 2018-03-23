<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Image;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_customers = total_customers();
        $total_business  = total_business();
        $total_yauzers   = total_yauzers();
        $total_owners    = total_owners();      
        return view('admin.dashboard.index', compact('total_customers', 'total_business', 'total_yauzers', 'total_owners') , ['user' => Auth::user()]);
    }

    public function profile()
    {
        return view('admin.dashboard.profile', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
            $validator = $this->validateRequest($request);
            if($validator->fails())
            {
                return redirect()->route('admin.profile')
                                 ->withErrors($validator)
                                 ->withInput(['user' => Auth::user()]);
            }else{
                $user = Auth::user();
                $user->name  = $request->input('name');
                //$user->email = $request->input('email');


                if($request->hasFile('avatar'))
                {   
                 $avatar = $request->file('avatar');
                 $filename = time() . '.' . $avatar->getClientOriginalExtension();
                 $path = '/uploads/avatars/' . $filename;
                 Image::make($avatar)->resize(300, 300)->save( public_path($path));
                 $user->avatar = $filename;
                }

                $user->save();

                Session::flash('success', 'Your profile was updated.');
                return redirect()->route('admin.profile')->withInput(['user' => Auth::user()]);                
            } 

    }

    public function showChangePasswordForm()
    {
         return view('auth.passwords.changepassword', ['user' => Auth::user()]);
    }


    public function changePassword(Request $request)
    {
          if (!(Hash::check($request->get('current-password'), Auth::user()->password))) 
          {
            // The passwords matches
               return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
          }
        
          if(strcmp($request->get('current-password'), $request->get('new-password')) == 0)
          {
            //Current password and new password are same
              return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
          }

            $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password'     => 'required|string|min:6|confirmed',
            ]);
            
            //Change Password
            $user = Auth::user();
            $user->password = bcrypt($request->get('new-password'));
            $user->save();
            return redirect()->back()->with("success","Password changed successfully !");
    }
    







    //Protected Functions 
    protected function validateRequest(Request $request)
    {
        $rules = [
                    'name'                 =>  'required',
                    #'email'                =>  'required|email',
                    'avatar'               =>  'unique:admins'
                 ];

        $messages = [
                    'name.required'        =>  'Name is required.',
                    'email.required'       =>  'Email address is required.',
                    'email.unique'         =>  'Email address is already in use.',
                    'avatar.required'      =>  'ProfileImage is required.',
                    'avatar.unique'        =>  'ProfileImage is already in use.'
                ];    

        $validator = Validator::make($request->all(), $rules, $messages);
        return $validator;
    }     
}
