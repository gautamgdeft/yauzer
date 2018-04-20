<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use App\BusinessListing;
use App\Yauzer;
use Session;
use Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;


class ReportManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

    }

    public function show_reports()
    {
        $total_customers = total_customers();
        $total_basic_business  = total_basic_business();
        $total_premium_business  = total_premium_business();
        $total_yauzers   = total_yauzers();
        $total_owners    = total_owners();   
    	return view('admin.report_management.show_reports', compact('total_customers', 'total_basic_business', 'total_premium_business', 'total_yauzers', 'total_owners'));
    }

    public function customer_export()
    {
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=customer.csv");
        header("Pragma: no-cache");
        header("Expires: 0");

        $reviews = User::whereHas( 'roles', function($q){ $q->where('name', 'user'); } )->orderBy('id', 'desc')->get();
        
        $columns = array('UserID', 'Name', 'Email', 'City', 'State', 'Zipcode', 'Country', 'Address', 'Phone Number');

        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach($reviews as $review){

             fputcsv($file, array($review->id,$review->name,$review->email,$review->city,$review->state,$review->zipcode, $review->country, $review->address, $review->phone_number));

        }
        exit();
    }       


    public function owner_export()
    {
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=owner.csv");
        header("Pragma: no-cache");
        header("Expires: 0");

        $reviews = User::whereHas( 'roles', function($q){ $q->where('name', 'owner'); } )->orderBy('id', 'desc')->get();
        
        $columns = array('UserID', 'Name', 'Email', 'City', 'State', 'Zipcode', 'Country', 'Address', 'Phone Number');

        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach($reviews as $review){

             fputcsv($file, array($review->id,$review->name,$review->email,$review->city,$review->state,$review->zipcode, $review->country, $review->address, $review->phone_number));

        }
        exit();
    }      

    public function basic_business_export()
    {
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=business_listing.csv");
        header("Pragma: no-cache");
        header("Expires: 0");

        $reviews = BusinessListing::orderBy('id', 'desc')->where('premium_status', false)->get();
        
        $columns = array('BusinessID', 'Name', 'BusinessOwner', 'Address', 'City', 'State', 'Zipcode', 'Country', 'Phone Number', 'Website', 'Description', 'Latitude', 'Longitude');

        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach($reviews as $review){

             fputcsv($file, array($review->id,$review->name,$review->business_added_by->name,$review->address,$review->city,$review->state,$review->zipcode,$review->country,$review->phone_number,$review->website,$review->description,$review->latitude,$review->longitude));

        }
        exit();
    }     

    public function premium_business_export()
    {
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=business_listing.csv");
        header("Pragma: no-cache");
        header("Expires: 0");

        $reviews = BusinessListing::orderBy('id', 'desc')->where('premium_status', true)->get();
        
        $columns = array('BusinessID', 'Name', 'BusinessOwner', 'Address', 'City', 'State', 'Zipcode', 'Country', 'Phone Number', 'Website', 'Description', 'Latitude', 'Longitude');

        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach($reviews as $review){

             fputcsv($file, array($review->id,$review->name,$review->business_added_by->name,$review->address,$review->city,$review->state,$review->zipcode,$review->country,$review->phone_number,$review->website,$review->description,$review->latitude,$review->longitude));

        }
        exit();
    }       

    public function yauzer_export()
    {

        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=yauzer.csv");
        header("Pragma: no-cache");
        header("Expires: 0");

        $reviews = Yauzer::orderBy('id', 'desc')->get();
       
         $columns = array('YauzerID', 'Yauzer', 'BusinessName', 'BusinessOwner', 'User', 'Rating');

         $file = fopen('php://output', 'w');
         fputcsv($file, $columns);

         foreach($reviews as $review){

              fputcsv($file, array($review->id,$review->yauzer,$review->business->name,$review->business->business_added_by->name,$review->user->name,$review->rating));

         }
        exit();
    }    


}
