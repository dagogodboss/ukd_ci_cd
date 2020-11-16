<?php

namespace App\Jobs\Loan\Recovery;

use App\Models\Customer\CustomerEmployment;
use App\User\CustomerLoan\Loan;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AutomaticRecovery implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Loan $loan)
    {
        /**
         * Get all running Loans, get it's duration,
         * convert it to months in array,
         * get the one for the current month,
         * check for defaulting Loan Payments
         * query both current and defaulting Loan
         * check if the user has paid for that month and
         * check the pay day for that user
         * Create a notification for the user 3 days before payment day
         * check if we have past the paid date and user has not paid for that month
         * run the right action base on the above check
        **/
        // return 'Hello';
        $loans = $loan->getRunningLoan();
        foreach ($loans as $value) {
            $loan_duration = $this->loanDurationInMonths($value);
            foreach(CarbonPeriod::create($value->release_date, '1 month', $loan_duration) as $dates) {
                if($dates->format("m") <= Carbon::now()->month && $dates->format("Y") <= now()->year){
                    Log::error('Months From Date: '.$dates->format("m"). ' Month From Now is: '. Carbon::now()->month. ' And Year is: '.$dates->format("Y"). ' Carbon :'. now()->year);
                    if(($value->loanRepayment()->whereMonth('date_paid', now()->month)->latest()->first()) == null){
                        $this->checkUserPayDay($value);
                    }
                }
            }
        }
    }

    private function loanDurationInMonths($value){
        return Carbon::parse($value->release_date)->addMonths($value->getDuration());
    }

    private function checkUserPayDay($value){
        $payDay = CustomerEmployment::where('customer_id', $value->customer->id)->latest()->first()->salary_pay_day;
        // Log::error('We Have Loan ID: '.$value->id. ' And the Pay Day is: '. $value->customer->employment->salary_pay_day. ' ');
        // 15 <> 45
        (((int)now()->day == (int)$payDay) ? queryPayment($value) : ((int)now()->day < (int)$payDay || ((int)$payDay - (int)now()->day) <= (int)config('loan.notifyDays'))) ? notifyUser($value) : latePayment($value);
    }

}

// Loan amount/Duration
// +
// 3.2 * Loan

// INTEREST = (BeginningBalance*RATE_PER_DURATION)/DURATION

// Principal = Repayment - INTEREST
// 1051537-17
// ENDING_BALANCE = BeginningBalance - Principal


// Decline, approve, DepositRepay, notification to repay

// User Interface for Loan Recovery

// Loan | Amount |  Customer Name | Paid Date | Status | Remarks | Action
