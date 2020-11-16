@extends('layouts.admin-app')

@section('content')
<div class="col-md-12">
    <div class="row layout-top-spacing">
    
         <!-- START TAB DIV -->
            <div class="col-lg-12 col-12 layout-spacing">
            
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <!-- start header -->
                            <div class="content-section  animated animatedFadeInUp fadeInUp">

                                                <div class="row inv--head-section">

                                                    <div class="col-sm-6 col-12">
                                                        <h3 class="in-heading">Loan Request Details</h3>
                                                    </div>
                                                    <div class="col-sm-6 col-12 align-self-center text-sm-left">
                                                        <div class="company-info">
                                                         <div class="avatar avatar-xl">
                                                            <img alt="avatar" style="width:100px; hieght:100px;" src="{{ asset('customerfiles/profilepicture')}}/{{$data->customer->avatar}}" class="rounded" />
                                                        </div>
                                                        <br>
                                                        </div>
                                                    </div>
                                                    
                                                </div>

                                                <div class="row inv--detail-section" style="text-transform: uppercase;">

                                                    <div class="col-sm-7 align-self-center">
                                                        <p class="inv-to">Customer: 
                                                            <b >
                                                                {{$data->customer->first_name}} 
                                                                {{$data->customer->other_name}} 
                                                                {{$data->customer->last_name}}
                                                            </b>
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-5 align-self-center  text-sm-right order-sm-0 order-1">
                                                        <p class="inv-detail-title text-left">Relationship Officer : 
                                         @if ($data->customer_request)
                                                    <span class="badge badge-secondary">Online Request</span>
                                        <a href="{{url('loan/loan/assign-officer',$data->id)}}" class="btn btn-warning mb-4 mr-2 btn-sm" style="padding:3px; margin-top:23px;">Assign Officer</a>
                                        @else
                                        {{$data->loan_officer->first_name}} {{$data->loan_officer->last_name}} {{$data->loan_officer->other_name}}
                                        @endif
                                        </p>
                                                    </div>
                                                   
                                        
                                                    <div class="col-sm-7 align-self-center">
                                                        <p class="inv-customer-name"><b>Branch:</b>  {{$data->branch->title}}-{{$data->branch->state}}</p>
                                                        <p class="inv-street-addr"><b>Product:</b> {{$data->product->name}}</p>
                                                        <p class="inv-email-address"><b>Loan Amount:</b> ₦{{number_format($data->principal,2)}}</p>
                                                        <p class="inv-email-address"><b>Loan Purpose:</b> <label style="text-transform: lowercase;">{{$data->loan_purpose}}<label></p>
                                                        <p class="inv-email-address"><b>Offer Letter:</b> <label style="text-transform: lowercase;">
                    
                    <a  href="{{url('admin/show/loan/offer-letter',$data->id)}}" class="badge badge-info" target="_blank"> View</a>
                    
                 
                   
                   

 @if ($data->status != "active")
        @if(is_numeric($data->confirmation_status))
            @if(checkConfirmationProcess($data->confirmation_stage->privilege, "offer_letter"))
            
                    @if(checkLetterStatus($data->id))
                        
                        @if(checkLetterStatus($data->id) == "pending")
                             <a  href="#" class="badge badge-danger"> Awaiting Signed offer letter</a>
                             <a  href="{{url('admin/send/loan/offer-letter',[$data->id,$data->customer->id,$data->customer->email])}}" class="badge badge-warning"> Re-send offer letter</a>
                        @elseif(checkLetterStatus($data->id) == "active")
                            
                             <a  href="#" class="badge badge-success">ACCEPTED</a>
                             <!--<a  href="#" class="badge badge-secondary" data-toggle="modal" data-target=".bd-example-modal-accepted-offer-letter"> View Letter</a>-->
                             <!--<a  href="#" class="badge badge-secondary" data-toggle="modal" data-target=".bd-example-modal-accepted-application-form"> View Application Form</a>-->
                            
                            
                        @endif
                        
                    @else
                        <a  href="{{url('admin/send/loan/offer-letter',[$data->id,$data->customer->id,$data->customer->email])}}" class="badge badge-primary"> Send offer letter</a>
                    @endif

            @endif
        @endif
 @endif
 
  @if(checkLetterStatus($data->id))
    @if(checkLetterStatus($data->id) == "active")
        <?php $letter_info = getAcceptedLetterInfo($data->id); ?>
        <a  href="#" class="badge badge-secondary" data-toggle="modal" data-target=".bd-example-modal-accepted-offer-letter"> View Letter</a>
        <a  href="#" class="badge badge-secondary" data-toggle="modal" data-target=".bd-example-modal-accepted-application-form"> View Application Form</a>
                                                                  
    @endif
  @endif
                 
                    <label></p>
                                                     
                                                     </div>
                                                    <div class="col-sm-5 align-self-center  text-sm-left order-2">
                                                        <p class="inv-list-number"><span class="inv-title text-info">
                                    <!--Loan ID :</span> <span class="badge badge-secondary">000-{{$data->id}}</span>-->
                                    </p>
                                                        <p class="inv-created-date"><span class="inv-title"><b>Created By:</b> </span> <span class="inv-date"> 
                                        @if ($data->customer_request)
                                                    <span class="badge badge-secondary">Online Request</span>
                                        @else
                                        {{$data->createdBy->first_name}} {{$data->createdBy->last_name}}
                                        @endif
                                        </span></p>
        <p class="inv-due-date"><span class="inv-title"><b>Created Date:</b> : </span> <span class="inv-date">{{$data->created_at}}</span></p>
        <a class="btn btn-danger mb-4 mr-2 btn-sm" style="padding:3px;" target="_blank" href="https://webserver.creditreferencenigeria.net/CRCWeb/vw/SB?p=9MOCRqXKwmF0F6tJEfi2FJuNTLLo5Y3U">Check BVN</a>        
                                        </div>
                                                </div>
                        </div>
                         <!-- end header -->
                         <!-- Start Customer Information -->
                          <div class="widget-content widget-content-area">

                                    <div id="iconsAccordion" class="accordion-icons">
                                       @include('accounting.loan.includes.customer-general-info')
                                        
                                       @include('accounting.loan.includes.customer-employment-info')
                                       
                                       @if(checkLetterStatus($data->id))
                                        @if(checkLetterStatus($data->id) == "active")
                                             <?php $letter_info = getAcceptedLetterInfo($data->id); ?>
                                              @include('accounting.loan.files.accepted-offer-letter')
                                              @include('accounting.loan.files.accepted-application-form')
                                        @endif
                                      @endif
                                     
                                        
                                    
                                    </div>

                                </div>
                         <!-- End Customer Information -->
                            @if ($data->rejection_status)
                                 <div class="col-md-12">
                                  <label class="text-danger">
                                    This loan contain rejection notes, please click on Audit Trails to see the note.
                                    <div class="spinner-grow text-danger align-self-center" style="font-size:10px;">Loading...</div>
                                    
                                     </label>
                                </div>
                            @endif
                               
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area animated-underline-content">
                                    
                                    <ul class="nav nav-tabs  mb-3" id="animateLine" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="account-details-tab" data-toggle="tab" href="#account-details" role="tab" aria-controls="account-details" aria-selected="true">
                                             Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" onClick="seeCredential('calender');" id="pay-calender-tab" data-toggle="tab" href="#pay-calender" role="tab" aria-controls="pay-calender" aria-selected="false">
                                             Repayment Calender</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" onClick="seeCredential('files');"  id="files-details-tab" data-toggle="tab" href="#files-details" role="tab" aria-controls="files-details" aria-selected="false">
                                             Files</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="gurantors-details-tab" data-toggle="tab" href="#gurantors-details" role="tab" aria-controls="gurantors-details" aria-selected="false">
                                             Guarantors</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="comments-details-tab" data-toggle="tab" href="#comments-details" role="tab" aria-controls="comments-details" aria-selected="false">
                                             Comments</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="audit-details-tab" data-toggle="tab" href="#audit-details" role="tab" aria-controls="audit-details" aria-selected="false">
                                             Audit Trails</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="animateLineContent-4">
                                        <!-- start files-->
                                        <div class="tab-pane fade" id="files-details" role="tabpanel" aria-labelledby="files-details-tab">
                                                <p class="mb-4">
                                                   <!-- customer files-->
                                                        @include('accounting.loan.includes.customer-files')
                                                    <!-- customer files-->
                                                </p>      
                                        </div>
                                        <!-- end files-->
                                         <!-- start calender -->
                                                @include('accounting.loan.includes.pay-calender')
                                        <!-- end calender-->
                                        <!-- start gurantors-->
                                             @include('accounting.loan.includes.gurantors')
                                        <!-- end gurantors-->

                                        <!-- start Comments-->
                                        @include('accounting.loan.includes.loan_comment')
                                        <!-- end Comments-->

                                        <!-- start Audit Trails-->
                                            @include('accounting.loan.includes.audit_trial')
                                        <!-- end Audit Trails-->

                                <div class="tab-pane fade active show" id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                                           

                                <div class="col-sm-12">

                                  <!-- start Audit Trails-->
                                    @include('accounting.loan.includes.loan-details')
                                 <!-- end Audit Trails-->
                                
                                </div>


                                        </div>
                                    </div>

                                @include('accounting.loan.includes.change-amount-modal')
                        <!--@include('accounting.loan.includes.offer-letter')-->
                                <!-- Action Confirmation and rejection Div Start-->
                                    <div class="text-right">
                                    @if (App\Http\Helpers\AdminHelper::check_if_user_is_the_one_to_disburse())
                                    
                                 @if($data->confirmation_status != "decline")
                                            <button type="button" style="visibility:hidden" id="approve_btn" class="btn btn-primary mb-2 mr-2" data-toggle="modal" data-target="#approveFormModal">
                                              Approve Loan<svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> 
                                           </button>
                                 @endif
                                          {{-- @include('accounting.loan.includes.disbursement-modal') --}}
                                          @include('accounting.loan.includes.approve-modal')
                                     @else
                                         @if ($data->rejection_status && $data->confirmation_status != "decline")
                                    
                                       <button type="button" style="visibility:hidden" id="re_confirm_btn"  class="btn btn-warning mb-2 mr-2" data-toggle="modal" data-target="#confirmLoanModal">
                                            Re-Confirm<svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> 
                                        </button>
                                         @else
                                         
                                    @if($data->confirmation_status != "decline")
                                    

 @if ($data->status != "active")
        @if(is_numeric($data->confirmation_status))
            @if(checkConfirmationProcess($data->confirmation_stage->privilege, "offer_letter"))
            
                    @if(checkLetterStatus($data->id))
                        
                        @if(checkLetterStatus($data->id) == "pending")
                            
                                <p class="text-danger">Awaiting Signed offer letter</p>
                        @elseif(checkLetterStatus($data->id) == "active")
                             <button type="button" style="visibility:hidden" id="confirm_btn" class="btn btn-success mb-2 mr-2" data-toggle="modal" data-target="#confirmLoanModal">
                                            Confirm<svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> 
                                        </button>
                        @endif
                        
                    @else
                        <button type="button" style="visibility:hidden" id="confirm_btn" class="btn btn-success mb-2 mr-2" data-toggle="modal" data-target="#confirmLoanModal">
                                            Confirm<svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> 
                                        </button>
                    @endif

            @endif
        @endif
 @else
  <button type="button" style="visibility:hidden" id="confirm_btn" class="btn btn-success mb-2 mr-2" data-toggle="modal" data-target="#confirmLoanModal">
                                            Confirm<svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> 
                                        </button>
 @endif
                                        
                                    @endif
                                        @endif

                                    @endif
                                        <button type="button" class="btn btn-danger mb-2 mr-2" data-toggle="modal" data-target="#rejectLoanModal">
                                            Reject<svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                        </button>
                                        <button type="button" class="btn btn-dark mb-2 mr-2" data-toggle="modal" data-target="#declineModal">
                                            Decline<svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                        </button>
                                        @include('accounting.loan.includes.confirm-loan-model-actions')
                                <!-- End Action Confirmation and rejection Div -->
                                    <br>
                                    <label class="text-danger" id="see_credential_msg">Make sure you view all the re-payment calender and the files before you proceed</label>
                                 </div>
                                </div>
                            </div>
                            
                        </div>
        <!-- END TAB DIV -->


    </div>
</div>
<script>
let check_calender = false;
let check_files = false;
function seeCredential(val){
    
    switch(val){
        
        case 'calender':
            check_calender = true;
            break;
        case 'files':
            check_files = true;
            break;

    }

    if(check_calender && check_files){

        document.getElementById('see_credential_msg').innerHTML ='';
        hideOrDisplay('visible');

    }else if(check_calender && !check_files){

        document.getElementById('see_credential_msg').innerHTML ='Make sure you view all the files before you proceed.';
        //hideOrDisplay('visible');

    }else if(!check_calender && check_files){

        document.getElementById('see_credential_msg').innerHTML ='Make sure you view all the re-payment calender before you proceed';
       //hideOrDisplay('visible');

    }else if(!check_calender && !check_files){
        
        document.getElementById('see_credential_msg').innerHTML ='Make sure you view all the re-payment calender and the files before you proceed';
        //hideOrDisplay('visible');
    }else{
        hideOrDisplay('visible');
    }

}

function hideOrDisplay(val){
    let confirm_btn = document.getElementById('confirm_btn');//.style.display ='true';
    let re_confirm_btn = document.getElementById('re_confirm_btn');//.style.display ='true';
    let approve_btn = document.getElementById('approve_btn');//.style.display ='true';
    if(confirm_btn){
        confirm_btn.style.visibility = val;
    }
    if(re_confirm_btn){
        re_confirm_btn.style.visibility = val;
    }
    if(approve_btn){
        approve_btn.style.visibility = val;
    }
}
</script>
@endsection
