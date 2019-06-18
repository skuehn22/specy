@if(isset($plan->due_date))
<div class="row">
    <div class="col-md-12">
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-2 text-left">
        <strong>Plan Type:</strong>
    </div>
    <div class="col-md-4">
        <span>Single Payment/Deposit</span>
    </div>
    <div class="col-md-2 text-left">
        <strong>Due to:</strong>
    </div>
    <div class="col-md-4">
        <span>{{date('d.m.Y', strtotime($plan->due_date))}}</span>
    </div>
</div>
<div class="row pt-3">
    <div class="col-md-2 text-left">
        <strong>Amount:</strong>
    </div>
    <div class="col-md-4">
        <span> {{ number_format($plan->amount, 2) }} EUR</span>
    </div>
    <div class="col-md-2 text-left">
        <strong>State:</strong>
    </div>
    <div class="col-md-4">
        <span class="status {{$plan->color}}">&bull;</span> {{$plan->state}}
    </div>
</div>
@endif