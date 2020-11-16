<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Loan Offer Letter</title>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/main.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ asset('assets/css/pages/helpdesk.css')}}" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->  
    
 
    <link href="{{ asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />
</head>
<body>

    <div class="helpdesk container">
        <nav class="navbar navbar-expand navbar-light">
            <a class="navbar-brand" href="#">
               
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    
                </ul>
            </div>
        </nav>

        <div class="helpdesk layout-spacing">

            <div class="hd-header-wrapper">
                <div class="row">                                
                    <div class="col-md-12 text-center">
                        <h4 class="">Loan Offer Letter</h4>
                        
                        @if(Session('errorMessage'))
                                     <h4 class="text-danger" style="text-align:center; background-color:#FFF;">{{Session('errorMessage')}}</h4>
                
                                 @endif
                    </div>
                </div>
            </div>

            <div class="hd-tab-section" style="margin-top:-90px;">
                <div class="row">
                    <div class="col-md-12 mb-5 mt-5">

                        <div class="accordion" id="hd-statistics">
                        
                          <div class="card">
                            <div class="card-header" id="hd-statistics-2">
                              <div class="mb-0">
                                <div class=" collapsed" data-toggle="collapse" role="navigation" data-target="#collapse-hd-statistics-2" aria-expanded="true" aria-controls="collapse-hd-statistics-2">
                                   <img src="{{ asset('https://ukdiononline.com/assets/images/maxer.jpg')}}" class="img-responsive">
                                </div>
                              </div>
                            </div>
                            <div id="collapse-hd-statistics-2" class="collapse show" aria-labelledby="hd-statistics-2" data-parent="#hd-statistics">
                              <div class="card-body">
                                
    
    <div class="col-md-12" style="">
        <?php
        $customer_name = $letter->customer->first_name;
        $appied_loan_amount = $letter->disbursed_amount ? $letter->disbursed_amount : $letter->principal;
        $appied_loan_amount = '<b style="color:#dc3545;">N'.number_format($appied_loan_amount,2).'</b>';
         $the_letter =  str_replace("customer",$customer_name, $letter->product->offer_letter->letter);
        $the_letter =  str_replace("amount",$appied_loan_amount, $the_letter);
        $the_letter =  str_replace("ddate","Disbursement Date:".$letter->release_date, $the_letter);
        $the_letter =  str_replace("mdate","Maturity Date:".$letter->maturity_date, $the_letter);
        
        //$upper_string = strtok($the_letter, 'Repayment_Schedule_Calendar');
        
        // $mystring = 'home/cat1/subcat2/';
         $first = strtok($the_letter, '/');
        ?>
      
            {!!nl2br($the_letter)!!}
            
            

 <div class="row">
    <div class="media">
        <div class="media-body">
             <div class="table-responsive">
             <?php
                $loan_amount = $letter->disbursed_amount ? $letter->disbursed_amount : $letter->principal;
                 $pay_day = $letter->customer->employment->salary_pay_day;
                 if($pay_day < 10){
                     $pay_day = '0'.$pay_day;
                 }
                 
               
                 $in = date_create($letter->created_at);
                
                $out = date_create($in->format('Y-m-'.$pay_day));
               
                // $the_release_date = $out->format('Y-m-d');
                 $the_release_date = $letter->release_date ? $letter->release_date : date('Y-m-d');
                                
                $cal_result = App\Http\Controllers\Loan\RepaymentController::repaymentScheduleCalendar($letter->id,$loan_amount,$letter->interest_rate,$letter->loan_duration,$letter->loan_duration_length,$the_release_date,$pay_day);
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
                   
                   
                        <?php
                        $insurance = calPercentage($letter->insurance_charge,$loan_amount);
                        $processing = calPercentage($letter->processing_charge,$loan_amount) * $letter->loan_duration_length;
                        $vat = calPercentage(7.5,$processing);
                        $total_deductions = $insurance + $processing + $vat;
                        ?>
                          
                        </div>
                        <div class="col-md-6">
                        
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
                                <!--<th>Penalty</th>-->
                                <th>Interest</th>	
                                <th>Principal</th>
                                <!--<th>Stutus</th>-->
                                <!--<th>Amount Paid</th>-->
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
                                                @if (App\Http\Controllers\Loan\RepaymentController::getNextPayMonth($letter->id,$value['date']))
                                                    
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
                                    <!--<td><b>₦{{$value['penalties']}}</b></td>-->
                                    <td><b>₦{{$value['interest']}}</b></td>
                                    <td><b>₦{{$value['principal']}}</b></td>
                                   
                                    @if ($value['status'] == true)
                                    <!-- <td class="text-success">-->
                                    <!--    <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>-->
                                        
                                    <!--</td>-->
                                    @else
                                    <!--<td class="text-danger">-->
                                    <!--    <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>-->
                                    <!--</td>-->
                                    @endif
                                    <!--<td><b>₦{{$value['amount_paid']}}</b></td>-->
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
                                    <!--<td><b class="text-danger">₦{{number_format($total_penaltie,2)}}</b></td>-->
                                    <td><b class="text-danger">₦{{number_format($total_interest,2)}}</b></td>
                                    <td><b class="text-danger">₦{{number_format($total_principal,2)}}</b></td>
                                    <!--<td class="text-success"></td>-->
                                    <!--<td><b class="text-danger">₦{{number_format($total_amount_paid,2)}}</b></td>-->
                                    <!--<td class="text-danger">-->
                                        <!--<b>₦{{$balance}}</b>-->
                                    <!--    </td>-->
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

            
            
            
            
            
             <!-- Button trigger modal -->
                                    <div class="text-center">
                                        <button type="button" class="btn btn-success mb-2 mr-2" data-toggle="modal" data-target="#exampleModal">
                                         Confirm Letter
                                        </button>
                                    </div>

                                    


                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                         @if(Session('errorMessage'))
                                     <h4 class="text-danger" style="text-akign:center;">{{Session('errorMessage')}}</h4>
                
                                 @endif
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>
                            <form action="{{url('confirm/letter/accepted')}}" method="POST" id="actionForm">
                                                                        {{csrf_field()}} 
                                                <div class="modal-body">
                                                    <p class="modal-text">
                                                        <div class="form-group">
                                                                                <label >Refrence Number</label>
                                                                                <input type="text" name="code" placeholder="Refrence Number" class="form-control" required>
                                    
                                    <input type="hidden" name="customer_id" value="{{$customer_id}}">
                                    <input type="hidden" name="loan_id" value="{{$loan_id}}">                                
                                                                            </div>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- End Modal -->
       
    </div>
                              </div>
                            </div>
                          </div>
                         
                        

                        </div>


                    </div>
                </div>                            
            </div>

          

        </div>
    </div>

    <div id="miniFooterWrapper" class="">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="position-relative">
                        <div class="arrow text-center">
                            <p class="">Up</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 mx-auto col-lg-6 col-md-6 site-content-inner text-md-left text-center copyright align-self-center">
                            <p class="mt-md-0 mt-4 mb-0">{{date('Y')}} &copy; <a target="_blank" href="#">UK-DION</a>.</p>
                        </div>
                        <div class="col-xl-5 mx-auto col-lg-6 col-md-6 site-content-inner text-md-right text-center align-self-center">
                            <p class="mb-0"></p>
                        </div>
                    </div>
                </div>      
            </div>
        </div>
    </div>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('assets/js/pages/helpdesk.js')}}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('assets/js/app.js')}}"></script>
</body>


</html>