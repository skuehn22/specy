
<form class="form-horizontal" role="form" method="POST" action="/provider/settings/save-company">
    <input type="hidden" name="tour" id="tour" value="true">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="company" class="col-md-3 control-label">Company</label>
        <div class="col-md-6">
            <input id="company" type="text" class="form-control" name="company" value="{{$company->name}}">
        </div>
    </div>
    <div class="form-group">
        <label for="address" class="col-md-3 control-label">Address</label>
        <div class="col-md-6">
            <input id="address" type="text" class="form-control" name="address" value="{{$company->address}}">
        </div>
    </div>
    <div class="form-group">
        <label for="country" class="col-md-3 control-label">Country</label>
        <div class="col-md-6">
            <input id="country" type="text" class="form-control" name="country" value="{{$company->country}}">
        </div>
    </div>
    <div class="form-group">
        <label for="city" class="col-md-3 control-label">City</label>
        <div class="col-md-6">
            <input id="city" type="text" class="form-control" name="city" value="{{$company->city}}">
        </div>
    </div>
    <div class="form-group">
        <label for="contact" class="col-md-3 control-label">Contact User</label>
        <div class="col-md-6">
            <select class="form-control" required="true" id="contact" name="contact">
                @foreach( $team as $member)
                    @if($provider->contact_users_fk == $member->id)
                        <option value="{{$member->id}}" disabled selected>{{$member->firstname}} {{$member->lastname}}</option>
                    @else
                        <option value="{{$member->id}}">{{$member->firstname}} {{$member->lastname}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-3 col-md-6">
            <button type="submit" class="btn btn-orange">
                <i class="fas fa-save"></i> Save Setti
            </button>
        </div>
    </div>
</form>

