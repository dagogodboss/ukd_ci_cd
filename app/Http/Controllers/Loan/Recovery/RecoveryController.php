<?php

namespace App\Http\Controllers\Loan\Recovery;

use App\Http\Controllers\Controller;
use App\Models\Loan\Loan;
use Illuminate\Http\Request;

class RecoveryController extends Controller
{
    public function showHistory(Loan $loan, Request $request){
        $loans = $loan->getRunningLoan()->load('customer')->load('recovery');
        return view('admin.loan.recovery.history', ['loans' => $loans]);
    }
    
    public function recoverAmount(Loan $loan, Request $request){
        $loan = $loan->getByHash($request->uuid);
        if(!$loan->checkLoan()) {
            dd($loan->getAmountDue())  ;
        }
    }
    
    public function recover(Loan $loan, Request $request){
        $loans = $loan->getRunningLoan()->load('customer')->load('recovery');
        return view('admin.loan.recovery.history', ['loans' => $loans]);
    }
    
}
