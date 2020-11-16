@extends('layouts.admin-app')

@section('content')

<div class="panel panel-white">
   
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
       
        <div class="widget-content widget-content-area br-6 layout-spacing" style="margin-top:30px;">
            <div class="card-body text-left layout-spacing">
                <div class="widget-header">
                    <h4>Disbursement Report</h4>
            </div>
            </div>
               <form action="" method="GET" id="actionForm">
                                                            {{csrf_field()}}
                                                           
                                                            <div class="form-row mb-4" >
                                                                <div class="col">
                                                                    From
                                                                    <input type="date" name="from" class="form-control"  required>
                                                                </div>
                                                                <div class="col">
                                                                       To
                                                                        <input type="date" name="to" class="form-control" required>
                                                                </div>
                                                               
                                                                 <div class="col">
                                                                        <br>
                                                                       <input type="submit" value="Search" class="btn btn-primary">
                                                                </div>
                                                                    
                                                            </div>

                                                         </form>
        <div class="row">

    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <div class="ac_chart">
          
          <div class="reports-breads">
            <h4 class="text-info"> 
            Disbursement Report From 
            <span class="filter-txt-highligh">
              <?php  
                    $d_fromDate = new \DateTime(Request::Get('from'));
                    $get_fromDate =  $d_fromDate->format('D M d, Y');

                    $d_toDate = new \DateTime(Request::Get('to'));
                    $get_toDate =  $d_toDate->format('D M d, Y');
                    
                ?>
              (

              {{$get_fromDate}} - {{$get_toDate}}

             ) </span>
            
          </h4>
          </div>

          <div class="col-sm-1">
           
          </div>

             <table class="table table-striped table-bordered">
              <tr>
                <th width="90">ID</th>
                <th>Disburse By</th>
                <th>Date</th>
                <th>Amount</th>
                <th></th>
              </tr>
               
               <?php $total = 0; ?>
              @foreach ($data as $rec)
                
                <?php
                    $d_amount = $rec->disbursed_amount ? $rec->disbursed_amount : $rec->principal;
                    
                ?>
                  <tr>
                    <td width="90">{{$loop->iteration}}</td>
                    <td>
                        {{$rec->loan_disbursed_by->first_name}}
                        {{$rec->loan_disbursed_by->last_name}}
                    </td>
                    <td>{{$rec->release_date}}</td>
                     <td>₦{{number_format($d_amount,2)}}</td>
                    <td>
                        <a class="nav-link list-actions text-info" href="{{url('loan/loan/showloan-detail',$rec->id)}}"><svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg> view</a>
                    </td>
              </tr>
              <?php $total += $d_amount; ?>
              @endforeach

              <tr>
                    <td width="90"><h4 class="text-info">TOTAL</h4></td>
                    <td></td>
                    <td></td>
                     <td><h4 class="text-info">₦{{number_format($total,2)}}</h4></td>
                    <td></td>
              </tr>
              
           

          </table>

        </div>
      </div>
          
        </div>

        </div>
    </div>
</div>
@endsection
