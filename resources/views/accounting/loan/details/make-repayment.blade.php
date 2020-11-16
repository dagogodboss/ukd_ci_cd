<!--  make repayment -->
<style>

</style>
<div class="modal fade" id="make-repaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="text-transform: uppercase;">
            <div class="modal-header">
                <h5 class="modal-title text-info" id="exampleModalLabel">Loan Repayment</h5>
            </div>
            <div class="modal-body">
                <form action="{{url('loan/loan/make/repayment')}}" method="POST" id="actionForm">
                 {{csrf_field()}}
                 <input type="hidden" name="customer_id" value="{{$data->customer->id}}">
                 <input type="hidden" name="loan_id" value="{{$data->id}}">
                 <input type="hidden" id="next_pay_month" name="next_pay_month" value="">
                 <input type="hidden" id="next_amount_to_pay" name="next_amount_to_pay" value="">
                 <input type="hidden"  id="total_balance_to_be_paid" name="total_balance_to_be_paid" value="">
                 <input type="hidden"  name="transaction_type" value="in_house">
                <div class="form-row mb-4" >
                    <div class="col">
                          <b>Next Instalment amount</b>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="amount_to_be_paid_1" onClick="otherPay('hidden')" name="amount_to_be_paid" class="custom-control-input" value="">
                                <label class="custom-control-label" for="amount_to_be_paid_1">₦<b id="text_next_instalment_to_pay_amount"></b></label>
                            </div>
                    </div>
                </div>
                <div class="form-row mb-4" >
                    <div class="col">
                          <b>Full Loan Balance</b>
                           <div class="custom-control custom-radio">
                                <input type="radio" id="amount_to_be_paid_2" onClick="otherPay('hidden')" name="amount_to_be_paid" class="custom-control-input" value="">
                                <label class="custom-control-label" for="amount_to_be_paid_2">₦<b id="text_full_balance_to_pay_amount"></b></label>
                            </div>
                    </div>
                </div>
                 <div class="form-row mb-4" >
                    <div class="col">
                          <b>Others</b>
                           <div class="custom-control custom-radio">
                                <input type="radio" id="other_payment" onClick="otherPay('visible')" name="amount_to_be_paid" class="custom-control-input" value="other_payment">
                                <label class="custom-control-label" for="other_payment"><b id=""></b></label>
                            </div>
                    </div>
                </div>
                 <div class="form-row mb-4" id="div_other_amount" style="visibility:hidden">
                    <div class="col">
                        Enter amount
                          <input type="number" step="0.01" id="pay_other_amount" name="other_amount" class="form-control" placeholder="Amount to pay">
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                          Comment 
                          <textarea name="note" class="form-control" placeholder="Comment" required></textarea>
                    </div>

                </div>
                 <div class="form-group col-md-10">
                    <label class="text-info">Paymeny Bank</label>
                    <select class="form-control" name="payment_bank" required>
                        <option value="">Select Bank</option>
                        @foreach ($banks as $banks)
                         {{-- <option value="{{$banks->id}}">{{$banks->name}}</option> --}}
                            @foreach ($banks->children as $child)
                                <option value="{{$child->id}}">{{$child->name}}</option>
                            @endforeach
                        @endforeach 
                    </select>
                </div>
                <input type="submit" name="time" class="btn btn-primary">

            </form>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                
            </div>
        </div>
    </div>
</div>

<!-- End make repayment -->