<div class="form-row py-2 pt-0 pl-0 ml-0">
    <h4 class="pt-0">General Information</h4><br><br>
</div>


    <div class="form-group">
        <div class="form-inline">
            <label class="col-md-2 pl-0 col-form-label" for="creation-date">
                Project Title*  <i class="fas fa-info-circle green  pl-2" data-toggle="tooltip" data-placement="top" title="What is this payment plan for? e.g. website design, wedding photography"></i>
            </label>
            @if($plan->name)
                <input type="text" id="title" name="title" class="form-control col-md-3" value="{{$plan->name}}" required>
            @else
                <input type="text" id="title" name="title" class="form-control col-md-3" required>
            @endif
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="form-group">
        <div class="form-inline">
            <label class="col-md-2 pl-0 col-form-label" for="creation-date">
                Reference  <i class="fas fa-info-circle green  pl-2" data-toggle="tooltip" data-placement="top" title="Number or character from your internal system"></i>
            </label>
            @if($plan->reference)
                <input type="text" id="reference" name="reference" class="form-control col-md-3" value="{{$plan->reference}}">
            @else
                <input type="text" id="reference" name="reference" class="form-control col-md-3">
            @endif
            <div class="help-block with-errors"></div>
        </div>
    </div>


    <div class="form-group">
        <div class="form-inline">
            <label class="col-md-2 pl-0 col-form-label" for="creation-date">
                Date Created*
                 <i class="fas fa-info-circle green pl-2" data-toggle="tooltip" data-placement="top" title="This date is on the payment plan as the creation date of the plan"></i>
            </label>

            @if($plan->date)
                <input type="text" id="creation-date" name="creation-date" class="form-control col-md-3" value="{{ \Carbon\Carbon::parse($plan->date)->format('d/m/Y')}}" required>
            @else
                <input type="text" id="creation-date" name="creation-date" class="form-control col-md-3" required>
            @endif
            <div class="help-block with-errors"></div>
        </div>
    </div>

    @if(count($clients)>0)

    <div class="form-group">
        <div class="form-inline">
        <label class="col-md-2 pl-0 col-form-label" for="clients">Client*</label>
            <select name="clients" id="clients" class="col-md-3" required>
                <option></option>
                @foreach($clients as $client)
                    @if(isset($plan->clients_id_fk) && $client->id == $plan->clients_id_fk)
                        <option value="{{$client->id}}" selected>{{$client->firstname}} {{$client->lastname}}</option>
                    @else
                        <option value="{{$client->id}}">{{$client->firstname}} {{$client->lastname}}</option>
                    @endif
                @endforeach
            </select>
            <div class="help-block with-errors"></div>
        </div>
    </div>

    @else

       <div class="form-group" id="client-list">
           <div class="form-inline">
           <label class="col-md-2 pl-0 col-form-label" for="clients" id="client-lable">Client*</label>
           <div class="col-md-3" id="no-client"> No clients saved. <a href="#" id="create-client-fly">Create Client</a></div>
           </div>
       </div>

    @endif


<div class="form-row py-2">
    <div class="col-md-5 pt-1 text-right float-right">
        <button class="btn btn-success next-btn" id="next-btn" type="button">Next</button>
    </div>
</div>

