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
use Illuminate\Support\Facades\Redirect;

class ContactusController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  public function search(Request $request)
  {
     $search_parameter = $request->search_parameter;
     if($search_parameter != "")
     {

      $filterContacts = ContactUS::where ( 'name', 'LIKE', '%' . $search_parameter . '%' )->orWhere ( 'email', 'LIKE', '%' . $search_parameter . '%' )->paginate (10)->setPath ( '' );
      $pagination = $filterContacts->appends ( array (
            'search_parameter' => $request->search_parameter 
        ) );
        
      if (count ( $filterContacts ) > 0)
      return view ( 'admin.contact_us.contact_listing' )->withDetails ( $filterContacts )->withQuery ( $search_parameter );
     }

      return view ( 'admin.contact_us.contact_listing' )->withMessage ( 'No Details found. Try to search again !' );
  }

  public function search_by_date(Request $request)
  {

      $filterContacts = ContactUS::whereBetween('created_at', [$request->start, $request->end])->paginate (10)->setPath ( '' );
      $pagination = $filterContacts->appends ( array (
            'start' => $request->start,
            'end'   => $request->end
        ) );
      if (count ( $filterContacts ) > 0) {
       return view ( 'admin.contact_us.contact_listing' )->withFilter ( $filterContacts )->withStart ( $request->start )->withEnd( $request->end );
      }else{
       return view ( 'admin.contact_us.contact_listing' )->withError ( 'No Details found. Try to search again !' );
      }


  }    

  public function listing()
  {
  	$contact_listing = ContactUS::paginate(10);
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

  public function contact_details($id)
  {
      if ( $id ) 
      {
        $contact = ContactUS::find($id);
        if($contact){
          return view('admin.contact_us.contact_details',compact('contact'));
        }
        else{
          return view ( 'admin.contact_us.contact_listing' )->withMessage('No Details found.');
        }
      }   
  }

  public function export_contact()
  {
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=contacts.csv");
        header("Pragma: no-cache");
        header("Expires: 0");

        $contacts = ContactUS::orderBy('id', 'desc')->get();
        
        $columns = array('ContactId', 'Name', 'Email', 'Message');

        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach($contacts as $contact){

             fputcsv($file, array($contact->id,$contact->name,$contact->email,$contact->message));

        }
        exit();    
  }
}
