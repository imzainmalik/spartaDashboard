<?php

namespace App\Http\Controllers;

use App\Models\AssementFillup;
use App\Models\Customer;
use App\Models\ReportGenrated;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // dd(now()->subDay(5));
        $page_title = 'Dashboard';
        $total_assessment = AssementFillup::distinct('assement_no')->count('assement_no');
        $ReportGenrated = ReportGenrated::distinct('assessment_no')->count('assessment_no');
        $new_customer = Customer::where('created_at','>', now()->subDay(10))->count();
        $latest_assessment = AssementFillup::select('assement_no','customer_id','created_at','employee_id')
        ->where('created_at','>', now()->subDay(10))
        ->distinct()
        ->get(); 
        // dd($latest_assessment);
        return view('Admin.index',get_defined_vars());
    }
}
