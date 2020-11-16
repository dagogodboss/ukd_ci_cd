@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
    <div class="row layout-top-spacing">
        <!-- Start General Information-->
        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
            <div id="general-info" class="section general-info">
                <div class="info">
                    <h6 class="text-info">Loan Search</h6>
                    <form action="" method="GET">
                     {{csrf_field()}}
                     @if(can('Admin Loan Search'))
                      @include('accounting.loan.details.admin-search')
                    @endif
                    @if(can('Branch Loan Search'))
                      @include('accounting.loan.details.branch-search')
                    @endif
                    </form>
                </div>
            </div>
        </div>
        
        <!--START REQUEST DIV -->
         @foreach ($data as $req)
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
                                        <span class="badge badge-info">ID: 000-{{$req->id}}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="progress-order-body" style="margin-top:-18px;">
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
                                            <b>Product:</b> <b class="text-warning">
                                            {{$req->product['name']}}</b>
                                            <br>
                                            <b>Principal:</b> <label class="text-danger">
                                            ₦{{number_format($req->principal,2)}}</label>
                                            <br>
                                            <b>Loan Duration:</b>  {{$req->product['loan_duration']}}
                                            <br>
                                            <b>Maturity Date:</b>  {{$req->maturity_date}}
                                            <br>
                                            {{-- <b>Branch:</b>  {{$req->branch->title}}-{{$req->branch->state}} --}}
                                            <br>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <h6></h6>
                                    </div>
                                    <div class="col-md-6 pl-0 col-sm-6 col-12 text-right">
                                        <td class="text-center">
                                                    <div class="dropdown custom-dropdown">
                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                        </a>

                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1" style="will-change: transform;">
                                                            <a class="dropdown-item text-info" href="{{url('loan/loan/showloan-detail',$req->id)}}">View</a>
                                                            <a class="dropdown-item text-warning" href="javascript:void(0);">Edit</a>
                                                        </div>
                                                    </div>
                                                </td>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
         </div>
         @endforeach
         
        <!-- END REQUEST DIV -->





    </div>
</div>
@endsection
