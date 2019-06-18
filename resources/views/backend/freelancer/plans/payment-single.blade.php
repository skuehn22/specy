<div class="form-row py-2">
    <label class="col-md-2 col-form-label" for="creation-date">
        Title* <i class="fas fa-info-circle green" data-toggle="tooltip" data-placement="top" title="For example Deposit / Down payment"></i>
    </label>

    @if(isset($milestones) && $milestones->name)
        <input type="text" id="title-milestone" name="title-milestone" class="form-control col-md-3" value="{{$milestones->name}}">
    @else
        <input type="text" id="title-milestone" name="title-milestone" class="form-control col-md-3">
    @endif

</div>

<div class="form-row py-2">

    <label class="col-md-2 col-form-label" for="creation-date">
        Description <i class="fas fa-info-circle green" data-toggle="tooltip" data-placement="top" title="Explain your client what is the milestone about."></i>
    </label>


    @if(isset($milestones) && $milestones->desc)
        <textarea class="form-control col-md-3" rows="4"  name="desc-milestone" id="desc-milestone">{{$milestones->desc}}</textarea>
    @else
        <textarea class="form-control col-md-3" rows="4"  name="desc-milestone" id="desc-milestone"></textarea>
    @endif

</div>

<div class="form-row py-2 d-none">

    <label class="col-md-2 col-form-label" for="pay-due">To Pay At*</label>

    <select class="form-control col-md-3" name="pay-due" id="pay-due">
        <option value="0">select</option>
        <option value="1">Project Start</option>
        <option value="2">Project End</option>
        <option value="3" selected>Specific Date</option>
    </select>

</div>

<div class="form-row py-2 due">
    <label class="col-md-2 col-form-label" for="due-date">Due Date*</label>

    @if(isset($milestones) && $milestones->due_at)
        <input type="text" id="due-date" name="due-date" class="form-control col-md-3" value="{{$milestones->due_at}}">
    @else
        <input type="text" id="due-date" name="due-date" class="form-control col-md-3">
    @endif


</div>

<div class="form-row py-2 amount">
    <label class="col-md-2 col-form-label" for="single-amount">Amount*</label>

    @if(isset($milestones) && $milestones->amount)
        <input type="number" id="single-amount" name="single-amount" class="form-control col-md-2" value="{{$milestones->amount}}">
    @else
        <input type="number" id="single-amount" name="single-amount" class="form-control col-md-2">
    @endif

    <select name="currency" id="currency" class="form-control col-md-1">
        <option value="EUR">EUR</option>
        <option value="GBP">GBP</option>
        <option value="USD">USD</option>
    </select>



</div>
