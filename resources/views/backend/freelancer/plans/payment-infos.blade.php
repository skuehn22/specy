<div class="form-row py-2 pt-0 pl-0 ml-0">
    <h4 class="pt-0">Payment Plan</h4>
</div>
<div class="form-row py-2">
    <label class="col-md-2 col-form-label" for="typ">Type*</label>


        {!! Form::select('typ', $types, null , ['class' => 'form-control col-md-3', 'id' => 'typ', 'placeholder' => 'select']) !!}



</div>
<div id="plan-typ-response"></div>
<div class="form-row py-2">
    <div class="col-md-5 pt-1 text-right button-bar-footer">
        <div class="btn-group sw-btn-group" role="group" >
            <button class="btn btn-secondary prev-btn" id="prev-btn" type="button">Back</button>
            <button class="btn btn-success next-btn" id="next-btn" type="button">Next</button>
        </div>
    </div>
</div>
