@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
    <div class="row layout-top-spacing">
        <?php $progress = 0; ?>
        <!--START REQUEST DIV -->
         @forelse ($data as $req)
        <div class="col-md-4 layout-top-spacing">
            <div class="card component-card_8">
                    <div class="card-body">

                        <div class="progress-order">
                            <div class="progress-order-header">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <h6></h6>
                                    </div>
                                    <div class="col-md-6 pl-0 col-sm-6 col-12 text-right">
                                        <span class="badge badge-info">IN PROGRESS</span>
                                    </div>
                                </div>
                            </div>

                            <div class="progress-order-body">
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                    <h6 class="text-center">{{$req->borrower_id}}</h6>
                                        <p>
                                            <b class="text-info" style="text-transform: uppercase;">
                                                {{$req->customer['first_name']}} 
                                                {{$req->customer['other_name']}} 
                                                {{$req->customer['last_name']}}
                                            </b>
                                            <br>
                                            <b>Product:</b> <label class="text-warning">
                                            {{$req->product['name']}}</label>
                                            <br>
                                            <b>Loan Amount:</b> <label class="text-warning">
                                             ₦{{number_format($req->principal,2)}}</label>
                                            <br>
                                            <b>Branch:</b>  {{$req->branch['state']}} - {{$req->branch['title']}}
                                            <br>
                                            <b>Created By:</b> 
                                                @if ($req->customer_request)
                                                    <span class="badge badge-secondary">Online Request</span>
                                                @else
                                                {{$req->createdBy['first_name']}} {{$req->createdBy['last_name']}}
                                                @endif
                                             
                                            <br>
                                            <b>Created Date:</b>    {{$req->created_at}}
                                            <br>
                                             <b>Offer Letter:</b>   
                                            @if(checkLetterStatus($req->id))
    
                                                        @if(checkLetterStatus($req->id) == "pending")
                                                             <span class="badge badge-danger"> Pending Approval </span>
                                                        @elseif(checkLetterStatus($req->id) == "active")
                                                             <span class="badge badge-success"> Accepted </span>
                                                        @endif
                                                        
                                                    @else
                                                         <span class="badge badge-dark"> Waiting to send </span>
                                                   @endif
                                        </p>
                                    </div>
                                    <div class="col-md-12 text-right">
                                       
                                        <a href="{{url('loan/loan/show-request',$req->id)}}" class="badge badge-success" style="float:right;">Confirm</a>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
         </div>
        @empty
        <div class="col-md-12 layout-top-spacing">
            <div class="card component-card_8">
                    <div class="card-body">
                        <p class="text-info">You don't have any request...</p>
                    </div>
            </div>
        </div>
        @endforelse
        <!-- END REQUEST DIV -->





    </div>
</div>
@endsection
