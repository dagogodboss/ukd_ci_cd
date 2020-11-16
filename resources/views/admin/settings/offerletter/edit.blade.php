@extends('layouts.admin-app')
@section('content')
 <div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-two" style="padding:15px;">

                            <div class="widget-heading">
                                <h5 class="">Update Offer Letter</h5>
                            </div>

                            <div class="widget-content">
                                  <form action="{{url('admin/update/offer-letter')}}" method="POST">
                                     {{csrf_field()}}
                                     <input type="hidden" name="letter_id" value="{{$letter->id}}" >
                                    <div class="form-row mb-4">
                                        
                                    <div class="col"> 
                                           Product Name
                                           <input type="text" value="{{$letter->product->name}}" class="form-control  basic" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row mb-4">
                                           <div class="col">
                                                 Letter
                                                 <br>
                                                 <label class="text-danger">
                                                    Note: Type customer where you want customer name to show,<br>
                                                    Type Amount where you want the loan amount to show. <br>
                                                    Type ddate where you want the disbursement date to show. <br>
                                                    Type mdate where you want the maturity date yo show.
                                                 </label>
                                                <textarea name="letter" class="form-control" rows="9" placeholder="Letter" required>{{$letter->letter}}</textarea>
                                            </div>
                                    </div>
                                            
                                        </div>
                                
                                        <input type="submit" name="time" class="btn btn-primary">
                                
                                </form>
                            </div>
                        </div>
                    </div>
                    
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
  <div>
<div>
@endsection
