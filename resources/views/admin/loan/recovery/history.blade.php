@extends('layouts.admin-app')
@section('stylesheet')
<style>
    .hide{
        display: none;
    }
</style>
@endsection
@section('content')
<div class="col-md-12">
    <div class="row layout-top-spacing">
        <!--START Disburse DIV -->
        <div id="tableCheckbox" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Recovery Instrument</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <form method="POST" action="{{ URL('recover') }}" id="form_sample_1" class="form-horizontal">
                        {{ csrf_field() }}
                        <table id="html5-extension" class="table table-bordered dataTable table-hover table-striped  table-checkable table-highlight-head mb-4" aria-describedby="html5-extension_info">
                            <thead>
                                <tr>
                                    <th class="checkbox-column">
                                        <label class="new-control new-checkbox checkbox-primary" style="height: 18px; margin: 0 auto;" title="Check All">
                                            <input type="checkbox" onClick="resetDisbursementAmount()" class="new-control-input todochkbox" id="todoAll">
                                            <span class="new-control-indicator"></span>
                                        </label>
                                    </th>
                                    <th class="">S/N</th>
                                    <th class="">Amount Paid</th>
                                    <th class="">Loan Amount</th>
                                    <th class="">Customer Name</th>
                                    <th class="">Due Amount</th>
                                    <th class="">Paid Date</th>
                                    <th class="">Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($loans as $loan)
                                    <tr>
                                        <td>
                                            <label class="new-control new-checkbox checkbox-primary" style="height: 18px; margin: 0 auto;" title="Check All">
                                            <input type="checkbox" class="new-control-input todochkbox" id="todoAll" >
                                            <span class="new-control-indicator"></span>
                                        </label>
                                        </td>
                                        <td>
                                            {{ $loop->iteration}}
                                        </td>
                                        <td>
                                            @if ($loan->recovery != null)
                                                {{format_number($loan->recovery->sum('amount'))}}
                                            @else
                                                Yet to Re-Pay
                                            @endif
                                        </td>
                                        <td>
                                             @if($loan->disbursed_amount != null)
                                            {{ format_number($loan->disbursed_amount) }}
                                            @else
                                             Not  Disbursed
                                            @endif
                                        </td>
                                        <td>
                                            {{$loan->customer->first_name}}
                                            {{$loan->customer->last_name}}
                                            {{$loan->customer->other_name}}
                                        </td>
                                        <td>
                                            @if($loan->recovery != null)
                                                {{$loan->getAmountDue()}}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($loan->recovery != null)
                                                {{$loan->recovery->date_paid}}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($loan->recovery != null)
                                            {{$loan->recovery->status}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($loan->checkLoan())
                                            <a class="mr-2 dynamic-queue btn btn-primary btn-sm" href="#">
                                                Query User
                                            </a>
                                            @endif
                                        </td>
                                    <tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    </form>
                </div>
                <div class="widget-footer query-button hide widget-content-area">
                    <button type="submit" class="btn btn-primary btn-sm">Query Selected User</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $('input[type=checkbox]').change(function(){
            if($(this).is(':checked')) {
                $('.query-button').removeClass('hide')
            } else {
                $('.query-button').addClass('hide')
            }
        });
        $('.widget-content .dynamic-queue').on('click', function (e) {
            e.preventDefault();
            const ipAPI = "{{ url('recover/loan/amount/'.hashId($loan->id)) }}"
            swal.queue([{
                title: 'Monthly Repayment',
                confirmButtonText: 'Confirm Debit Query',
                text: `You about to Query this user for the Monthly Loan Repaymnet amount`,
                type: 'warning',
                showCancelButton: true,
                showLoaderOnConfirm: true,
                preConfirm: function() {
                return fetch(ipAPI)
                    .then(function (response) { 
                        return response.json();
                    })
                    .then(function(data) {
                    return swal.insertQueueStep(data)
                    })
                    .catch(function() {
                    swal.insertQueueStep({
                        type: 'error',
                        title: 'Repayment has been Queued'
                    })
                    })
                }
            }])
        });
    </script>
@endsection