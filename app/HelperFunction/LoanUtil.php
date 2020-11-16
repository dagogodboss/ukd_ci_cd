<?php

namespace App\HelperFunction;

use Carbon\Carbon;
// issue with creation date
class LoanUtil
{
    public static function generateCalendar($loan){
        $calendarDates =  $loan->loanPeriodInArray();
        $calendar = [];
        $balance = ($loan->disbursed_amount == null ) ? $loan->principal : $loan->disbursed_amount;
        foreach ($calendarDates as $date) {
            $repayment = self::monthlyRepayment($loan);
            $interest = self::monthlyInterest($loan, $balance);
            array_push($calendar, [
                'current_date' => Carbon::parse($date)->day($loan->payDay())->format('Y-m-d'),
                'beginningBalance' => $balance,
                'monthlyRepayment' =>  $repayment,
                'monthlyInterest' => $interest,
                'monthlyPrincipal' => $repayment - $interest,
                'nextBalance' => $balance - ($repayment - $interest),
                'hasPaid' => $loan->hasPaid($date->month)
            ]);
            $balance = $balance - ($repayment - $interest);
        }
        return $calendar;
    }

    public static function monthlyRepayment($loan){
        return $loan->getAmountDue();
    }

    public static function monthlyInterest($loan, $balance){
        return $loan->getLoanInterest($balance);
    }

}
