
<div class="form-inline">
    <label class="col-md-2 pl-0 col-form-label" for="clients">Client*</label>
    @if(isset($clients) && count($clients)>0)
        <select name="{{$para['name'] or ''}}" id="{{$para['id'] or ''}}" class="col-md-3" required>
            <option value="0">select</option>
            @foreach($clients as $client)
                <option value="{{$client->id}}">{{$client->firstname}} {{$client->lastname}}</option>
            @endforeach
        </select>
    @else
        <div class="pt-2">
            <div  id="no-client"> No clients saved. <a href="#" id="create-client-fly">Create Client</a></div>
        </div>

    @endif

    <div class="help-block with-errors"></div>

</div>