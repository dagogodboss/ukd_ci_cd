 <div class="tab-pane fade" id="pay-calender" role="tabpanel" aria-labelledby="pay-calender-tab">
    <div class="media">
        <div class="media-body">
             <div class="table-responsive">
             <?php
                $loan_amount = $data->disbursed_amount ? $data->disbursed_amount : $data->principal;
                 $pay_day = $data->customer->employment->salary_pay_day;
                 if($pay_day < 10){
                     $pay_day = '0'.$pay_day;
                 }
                 
               
                 $in = date_create($data->created_at);
                
                $out = date_create($in->format('Y-m-'.$pay_day));
               
                 //$the_release_date = $out->format('Y-m-d');
                  $the_release_date = $data->release_date ? $data->release_date : date('Y-m-d');
                                
                $cal_result = App\Http\Controllers\Loan\RepaymentController::repaymentScheduleCalendar($data->id,$loan_amount,$data->interest_rate,$data->loan_duration,$data->loan_duration_length,$the_release_date,$pay_day);
                $get_result = json_decode($cal_result, true);

                $total_begining_balance = 0; $total_repayment_amount = 0;
                $total_penaltie = 0; $total_interest = 0;
                $total_principal = 0; $balance = 0; $total_balance = 0;
                $next_pay = false; 
                $total_paid = 0;
                $total_amount_paid = 0;
                                
            ?>
            <h4 class="text-center">{{trans('general.calendar_title')}}</h4>
            <div class="row">
                <div class="col-md-6">
                     <p class="inv-email-address text-info"><b>{{trans('general.disbursed_amount')}}:</b> <b class="text-danger">: ₦{{number_format($loan_amount,2)}}</b> </p>
                    <p class="inv-email-address text-info"><b>{{trans('general.interest_rate')}}</b> <b class="text-danger"></b>: {{$data->interest_rate}}%</p>
                   
                        <?php
                        $insurance = calPercentage($data->insurance_charge,$loan_amount);
                        $processing = calPercentage($data->processing_charge,$loan_amount) * $data->loan_duration_length;
                        $vat = calPercentage(7.5,$processing);
                        $total_deductions = $insurance + $processing + $vat;
                        ?>
                            <p class="inv-email-address text-info"><b>{{trans('general.insurance_fee')}}</b> <b class="text-danger"></b>: 
                            {{$data->insurance_charge}}% (₦{{number_format($insurance,2)}})</p>
                            
                            <p class="inv-email-address text-info"><b>{{trans('general.processing_fee')}}</b> <b class="text-danger"></b>: 
                            {{$data->processing_charge}}% (₦{{number_format($processing,2)}})</p>
                            <p class="inv-email-address text-info"><b>VAT on {{trans('general.processing_fee')}}</b> <b class="text-danger"></b>:
                            7.5% (₦{{number_format($vat,2)}})</p>
                            
                            
                            <p class="inv-email-address text-info"><b>{{trans('general.total_deduction')}}</b> <b class="text-danger"></b>: 
                            ₦{{number_format($total_deductions,2)}}</p>
                        </div>
                        <div class="col-md-6">
                         <p class="inv-email-address text-info"><b>{{trans('general.duration')}}</b> <b class="text-danger"></b>: {{$data->loan_duration_length}} <b style="text-transform: capitalize;">{{$data->loan_duration}} (s)</b></p>
                            @if ($data->release_date)
                            <p class="inv-email-address text-info"><b>{{trans('general.release_date')}}:</b> 
                            
                                <b class="text-primary">{{$the_release_date}}</b>
                            
                            </p>
                            @endif 
                            <p class="inv-email-address text-info"><b>{{trans('general.next_payment_date')}}</b>: <b class="text-primary" id="text_next_month_payment"></b></p>
                        <p class="inv-email-address text-info"><b>{{trans('general.next_instalment_amount')}}</b>: <b class="text-danger" id="text_next_instalment_amount"></b></p>
                </div>
            </div>
            
             
            
                <div class="table-responsive">
                    <table id="data-table" class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr style="font-size:12px;">
                                <th></th>
                                <th>Date</th>
                                <th>Begining Balance</th>
                                <th>Repayment Amount</th>
                                <th>Penalty</th>
                                <th>Interest</th>	
                                <th>Principal</th>
                                <th>Stutus</th>
                                <th>Amount Paid</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($get_result as $value) 
                                <tr>
                                    <td width="5">{{$loop->iteration}}</td>
                                    <td>
                                        <b>{{$value['date']}}</b>
                                        @if (!$next_pay)
                                                @if (App\Http\Controllers\Loan\RepaymentController::getNextPayMonth($data->id,$value['date']))
                                                    <div class="spinner-grow text-danger align-self-center" style="font-size:10px;">Loading...</div>
                                                    <input type="hidden" id="next_month_payment" value="{{$value['date']}}">
                                                    <?php $the_next_payment = str_replace( ',', '', $value['next_payment']); ?>
                                                    <input type="hidden" id="next_instalment_amount" value="{{$the_next_payment}}">
                                                    <?php $next_pay = true; ?>
                                                @endif
                                        @else
                                        <?php 
                                           //******
                                         ?>
                                        @endif
                                    </td>
                                    <td><b>₦{{$value['begining_balance']}}</b></td>
                                    <td><b>₦{{$value['repayment_amount']}}</b></td>
                                    <td><b>₦{{$value['penalties']}}</b></td>
                                    <td><b>₦{{$value['interest']}}</b></td> 
                                    <td><b>₦{{$value['principal']}}</b></td>
                                   
                                    @if ($value['status'] == true && $value['in_complete_payment'] == true)
                                     <td class="text-primary" style="text-align:center; padding:2px;">
                                        <div class="spinner-grow text-primary align-self-center" style="font-size:10px;">Loading...</div>
                                        <!--<svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>-->
                                        <a href="#" class="badge badge-primary">Complete Pay</a>
                                    </td>
                                    @elseif ($value['status'] == true && $value['in_complete_payment'] != true)
                                     <td class="text-success" style="text-align:center;">
                                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                        
                                    </td>
                                    @else
                                    <td class="text-danger" style="text-align:center;">
                                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    </td>
                                    @endif
                                    <td>
                                        <b>₦{{$value['amount_paid']}}</b>
                                         @if ($value['status'] == true && $value['in_complete_payment'] == true)
                                         <br>
                                         <b class="text-danger">₦{{$value['in_complete_balance']}}</b>
                                         @endif
                                        
                                    </td>
                                    <td><b>₦{{$value['balance']}}</b></td>
                                </tr>

                                <?php
                                $total_begining_balance += str_replace( ',', '', $value['begining_balance']);
                                //$total_begining_balance += floatval($value['begining_balance']); 
                                $total_repayment_amount += str_replace( ',', '', $value['repayment_amount']);
                                $total_penaltie += str_replace( ',', '', $value['penalties']); 
                                $total_interest += str_replace( ',', '', $value['interest']);
                                $total_principal += str_replace( ',', '', $value['principal']); 
                                $balance += str_replace( ',', '', $value['principal']);
                                $total_amount_paid += str_replace( ',', '', $value['amount_paid']); 
                                $total_balance += str_replace( ',', '', $value['total_balance']); 
                                
                                ?>
                                
                            @endforeach

                             <tr>
                                    <td></td>
                                    <td><b class="text-danger">Total</b></td>
                                    <td>
                                        <!--<b class="text-danger">₦{{number_format($total_begining_balance,2)}}</b>-->
                                        </td>
                                    <td><b class="text-danger">₦{{number_format($total_repayment_amount,2)}}</b></td>
                                    <td><b class="text-danger">₦{{number_format($total_penaltie,2)}}</b></td>
                                    <td><b class="text-danger">₦{{number_format($total_interest,2)}}</b></td>
                                    <td><b class="text-danger">₦{{number_format($total_principal,2)}}</b></td>
                                    <td class="text-success"></td>
                                    <td><b class="text-danger">₦{{number_format($total_amount_paid,2)}}</b></td>
                                    <td class="text-danger">
                                        <!--<b>₦{{$balance}}</b>-->
                                        </td>
                                </tr>
                            
                        </tbody>
                    </table>
                    <h4 class="text-danger">Total Balance: ₦{{number_format($total_balance,2)}}</h4>
                    <input type="hidden" id="full_balance_to_pay_amount" value="{{$total_balance}}" >
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function setNextpayMonthText(){
        const nextpayMonth = document.getElementById('next_month_payment').value;
        const installPay = document.getElementById('next_instalment_amount').value;
        const fullBalcne = document.getElementById('full_balance_to_pay_amount').value;

        document.getElementById("text_next_month_payment").innerHTML = nextpayMonth;
        document.getElementById("text_next_instalment_amount").innerHTML = '₦'+putComma(installPay);

        document.getElementById("amount_to_be_paid_1").value = installPay;
        document.getElementById("text_next_instalment_to_pay_amount").innerHTML = putComma(installPay);

        document.getElementById("amount_to_be_paid_2").value = fullBalcne;
        document.getElementById("total_balance_to_be_paid").value = fullBalcne;
        document.getElementById("text_full_balance_to_pay_amount").innerHTML = putComma(fullBalcne);

        document.getElementById("next_pay_month").value = nextpayMonth;
        document.getElementById("next_amount_to_pay").value = installPay;
   
    }

function putComma(x) {
    //convert to two decimals
    //x = x.toFixed(2);
    //put comma
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
    setNextpayMonthText();
</script>