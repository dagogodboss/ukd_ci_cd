<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\AdminHelper;
use App\Http\Controllers\Loan\RepaymentController;
use App\Models\Loan\Product;
use App\Models\Loan\Loan;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        return view('admin.dashboard');

        // $loan_id = 25;
        // $loan_amount = 100000;
        // $interest_rate = 13;
        // $duration = 'year';
        // $duration_lenght = 30;
        // $loan_start_date = '2020-01-27';

        //  $result = RepaymentController::repaymentScheduleCalendar($loan_id,$loan_amount,$interest_rate,$duration,$duration_lenght,$loan_start_date);
        
        //  echo $result;
         
    }

    

    
}
