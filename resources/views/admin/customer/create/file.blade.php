@extends('layouts.admin-app')
@section('content')
<div class="layout-px-spacing">                
                    <br>
                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                    <form action="{{url('customer/store/file')}}" method="POST" id="actionForm" enctype="multipart/form-data">
                                {{csrf_field()}}
                                 @if (session()->get('customer_registration_id'))
                                    <input type="hidden" name="customer_id" value="{{session()->get('customer_registration_id')}}">
                                 @endif
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                
                                   <!-- Start Files Information-->
                             <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div id="general-info" class="section general-info">
                                        <div class="info">
                                            <h6 class="text-info">Files Upload</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                    <div class="col-xl-2 col-lg-12 col-md-4">
                                                            <div class="upload mt-4 pr-md-4">
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                         <div id="fuMultipleFile" class="col-lg-12 layout-spacing">
                                                                            <div class="statbox widget box box-shadow">
                                                                               
                                                                                   <div class="row" style="padding-left:7px;">
                                                                                         <div class="form-group">
                                                                                            <label >ID Card</label>
                                                                                            <input type="file" name="id_card" class="form-control" required>
                                                                                             @if ($employment->id_card)
                                                                                             <input type="hidden" name="old_id_card" value="{{$employment->id_card}}">
                                                                                                    <br>
                                                                                                <div class="post-gallery-img">
                                                                                                    @if (ltrim(strstr($employment->id_card, '.'), '.') == "pdf")

                                                                                                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_id_card">Open File</button>

                                                                                                     @else
                                                                                                        <img src="{{ asset('customerfiles/files')}}/{{$employment->id_card}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_id_card">
                                                                                                     @endif
                                                                                                </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_id_card" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                    <img src="{{ asset('customerfiles/files')}}/{{$employment->id_card}}" class="img-responsive" style="width:100%;">
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                                                                                                    {{-- <button type="button" class="btn btn-primary"></button> --}}
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                        </div>
                                                                                         <div class="form-group">
                                                                                            <label >Bank Statement</label>
                <input type="file" name="bank_statement" class="form-control" required>
                                                                                             @if ($employment->bank_statement)
                                                                                             <input type="hidden" name="old_bank_statement" value="{{$employment->bank_statement}}">
                                                                                                    <br>
                                                                                                <div class="post-gallery-img">
                                                                                                     @if (ltrim(strstr($employment->bank_statement, '.'), '.') == "pdf")

                                                                                                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_files">Open File</button>

                                                                                                     @else
                                                                                                        <img src="{{ asset('customerfiles/files')}}/{{$employment->bank_statement}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_files">
                                                                                                     @endif
                                                                                                </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_files" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                    <div class="pdf">
                                                                                                                        <object data="pdf_file_name.pdf" type="application/pdf" width="600" height="400">
                                                                                                                             <a class="btn btn-warning" href="{{ asset('customerfiles/files')}}/{{$employment->bank_statement}}">Click to open file</a>
                                                                                                                        </object>
                                                                                                                    </div>
                                                                                                                    <img src="{{ asset('customerfiles/files')}}/{{$employment->bank_statement}}" class="img-responsive" style="width:100%;">
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                                                                                                    {{-- <button type="button" class="btn btn-primary"></button> --}}
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                        </div>
                                                                                         <div class="form-group">
                                                                                            <label >Utility bill</label>
                                                                                            <input type="file" name="utility_bill" class="form-control" required>
                                                                                             @if ($employment->utility_bill)
                                                                                             <input type="hidden" name="old_utility_bill" value="{{$employment->utility_bill}}">
                                                                                                    <br>
                                                                                                <div class="post-gallery-img">
                                                                                                    @if (ltrim(strstr($employment->utility_bill, '.'), '.') == "pdf")

                                                                                                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_utility_bill">Open File</button>

                                                                                                     @else
                                                                                                        <img src="{{ asset('customerfiles/files')}}/{{$employment->utility_bill}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_utility_bill">
                                                                                                    @endif
                                                                                                </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_utility_bill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                    <img src="{{ asset('customerfiles/files')}}/{{$employment->utility_bill}}" class="img-responsive" style="width:100%;">
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                                                                                                    {{-- <button type="button" class="btn btn-primary"></button> --}}
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label >Cheque</label>
                                                                                            <input type="file" name="cheque" class="form-control">
                                                                                             @if ($employment->cheque)
                                                                                             <input type="hidden" name="old_cheque" value="{{$employment->cheque}}">
                                                                                                    <br>
                                                                                                <div class="post-gallery-img">
                                                                                                    @if (ltrim(strstr($employment->cheque, '.'), '.') == "pdf")

                                                                                                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_cheque">Open File</button>

                                                                                                     @else
                                                                                                        <img src="{{ asset('customerfiles/files')}}/{{$employment->cheque}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_utility_bill">
                                                                                                    @endif
                                                                                                </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_cheque" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                    <img src="{{ asset('customerfiles/files')}}/{{$employment->cheque}}" class="img-responsive" style="width:100%;">
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                                                                                                    {{-- <button type="button" class="btn btn-primary"></button> --}}
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                        </div>


                                                                                        <div class="form-group">
                                                                                            <label >Others</label>
                                                                                            <input type="file" name="other_files" class="form-control">
                                                                                                @if ($employment->other_files)
                                                                                                <input type="hidden" name="old_other_files" value="{{$employment->other_files}}">
                                                                                                    <br>
                                                                                                <div class="post-gallery-img">
                                                                                                     @if (ltrim(strstr($employment->other_files, '.'), '.') == "pdf")

                                                                                                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_other_files">Open File</button>

                                                                                                     @else
                                                                                                        <img src="{{ asset('customerfiles/files')}}/{{$employment->other_files}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_other_files">
                                                                                                     @endif
                                                                                                    </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_other_files" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                    <img src="{{ asset('customerfiles/files')}}/{{$employment->other_files}}" class="img-responsive" style="width:100%;">
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                                                                                                    {{-- <button type="button" class="btn btn-primary"></button> --}}
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                            
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               <!-- End Files Information-->
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                 <a href="{{ url('customer/create/loan') }}" class="mr-2 btn btn-primary  html">Previous</a> 
                                 {{-- <button class="mr-2 btn btn-primary  html" style="float:right;">Next</button> --}}
                                 @include('inc.submit-btn-warning') 
                                   
                              </div>
                            
                            </div>
                        </div>
                        </form>
                    </div>

                  
                </div>

            </div>



<script>
 //First upload
 var firstUpload = new FileUploadWithPreview('myFirstImage');
 //Second upload
 var secondUpload = new FileUploadWithPreview('mySecondImage');
</script>
<!-- END PAGE LEVEL PLUGINS --> 
@endsection
