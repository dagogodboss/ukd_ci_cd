<?php

namespace App\User\CustomerLoan\Traits;

use App\Models\Loan\Loan_Repayment;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

/**
 * This Trait Major often use Loan Functions
*/
trait LoanTrait
{

    public function getAmountDue(){
        $paidAmount = ($this->disbursed_amount !== null) ? $this->disbursed_amount : $this->principal;
        return (($paidAmount/$this->getDuration()) + (percent($this->interest_rate) * $paidAmount));
    }

    public function getLoanInterest($balance){
        return (getRepaymentRate($this->getDuration())*$balance)/$this->getDuration();
    }

    public function getDuration(){
        return ($this->loan_duration == 'month') ? $this->loan_duration_length : 12 * $this->loan_duration_length;
    }

    public function getByHash($hash){
        foreach ($this->all() as $key => $value) {
            if(hashId($value->id) === $hash){
                return $value;
            }
        }
    }

    public function checkLoan(){
        $loan = $this->paidForXMonth(now()->month);
        return ($loan !== null )? true : false ;
    }

    public function hasPaid($month){
        return ($this->paidForXMonth($month) !== null) ? true : false;
    }

    private function paidForXMonth($month){
        return $this->recovery()->whereMonth('date_paid','=', $month)->first();
    }

    public function recovery(){
        return $this->hasMany(Loan_Repayment::class, 'loan_id', 'id');
    }

    public function nextPayDay($payDay){
        return Carbon::parse($this->release_date)->day($this->payDay());
    }

    public function payDay(){
        return $this->apiCustomer->employment()->latest()->first()->salary_pay_day;
    }

    public function martinsCheck(){
        return  (Carbon::parse($this->release_date)->diffInDays($this->nextPayDay($this->payDay())) <= 15) ? true : false;
    }

    public function latestLoanRepayment(){
        return $this->hasOne(Loan_Repayment::class)->latest();
    }

    public function getRunningLoan(){
        return $this->whereNotNull(['release_date', 'disbursed_amount'])->where('status', '!=', 'processing')->get();
    }

    public function loanDurationInMonths(){
        return Carbon::parse($this->release_date)->addMonths($this->getDuration());
    }

    public function loanPeriodInArray(){
        $start_date = ($this->martinsCheck()) ? Carbon::parse($this->release_date)->addMonth() : $this->release_date;
        return CarbonPeriod::create($start_date, '1 month', $this->loanDurationInMonths());
    }
}
