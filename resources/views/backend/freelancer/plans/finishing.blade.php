<div class="form-group">
    <div class="form-inline">
        <span style="font-weight: 500;"> Payment Method
                <i class="fas fa-info-circle green" data-toggle="tooltip" data-placement="top" title="Which payment methods would you like to accept? Flat fee of 3% for both payment types."></i>
        </span>
    </div>
</div>

<div class="form-group">
    <div class="form-inline">
        <div class="col-md-2  pl-0">
            Credit Card:
        </div>
        <div class="col-md-3">
            <label class="switch">
                <input type="checkbox" name="cc" id="togBtn" value="false">
                <div class="slider round"><!--ADDED HTML -->
                    <span class="on">ON</span>
                    <span class="off">OFF</span><!--END-->
                </div>
            </label>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="form-inline">
        <div class="col-md-2  pl-0">
            Bank Transfer:
        </div>
        <div class="col-md-3">
            <label class="switch">
                <input type="checkbox" name="bt" id="togBtnBt"  value="false">
                <div class="slider round"><!--ADDED HTML -->
                    <span class="on">ON</span>
                    <span class="off">OFF</span><!--END-->
                </div>
            </label>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md 6">
        <div class="form-row py-2">
            <span style="font-weight: 500;"> Personal Message
                <i class="fas fa-info-circle green" data-toggle="tooltip" data-placement="top" title="Will be added to your payment plan"></i>
            </span>
        </div>
        <div class="form-group">
            @if($plan->comment)
                <textarea class="form-control col-md-12" rows="4"  name="comment" id="comment">{{$plan->comment}}</textarea>
            @else
                <textarea class="form-control col-md-12" rows="4"  name="comment" id="comment" placeholder="Hi John, &#10;I'm really looking forward to working together! &#10;Best,&#10;Jane"></textarea>
            @endif

            <input type="hidden" value="false" id="test-mail" name="test-mail">

        </div>
        <div class="form-row py-2">
            <div class="col-md-12 pt-1 text-right">
                <div class="btn-group sw-btn-group" role="group" >
                    <button class="btn btn-secondary prev-btn" id="prev-btn" type="button">Back</button>
                    <button class="btn btn-success next-btn load-preview" id="next-btn" type="button">Preview</button>
                </div>
            </div>
        </div>
    </div>
</div>