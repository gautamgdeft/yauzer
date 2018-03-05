<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
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
    	$total_business  = total_business();
    	$total_yauzers   = total_yauzers();
    	$total_owners    = total_owners();
    	return view('admin.report_management.show_reports', compact('total_customers', 'total_business', 'total_yauzers', 'total_owners'));
    }

    public function export()
	{
    header("Content-type: text/csv");
    header("Content-Disposition: attachment; filename=file.csv");
    header("Pragma: no-cache");
    header("Expires: 0");

    $reviews = User::all();
    $columns = array('UserID', 'Name');

    $file = fopen('php://output', 'w');
    fputcsv($file, $columns);

    foreach($reviews as $review) {
        fputcsv($file, array($review->id,$review->name));
    }
    exit();
	}
}
