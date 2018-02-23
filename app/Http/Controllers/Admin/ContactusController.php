<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\ContactUS;
use Image;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class ContactusController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  public function listing()
  {
  	$contact_listing = ContactUS::all();
  	return view('admin.contact_us.contact_listing',compact('contact_listing'));
  }

  public function destroy_contact(Request $request)
  {
	 if ( $request->input('id') ) 
	 {
	  $contact = ContactUS::find($request->input('id'));
	  $contact->delete();
	  return response(['msg' => 'Contact has been deleted successfully', 'status' => 'success']);
	}

	return response(['msg' => 'Failed deleting the contact', 'status' => 'failed']);
  }
}
