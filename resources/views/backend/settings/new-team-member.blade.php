<form class="form-horizontal" role="form" method="POST" action="/provider/settings/save-team-member">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="company" class="col-md-2 control-label">First name</label>
        <div class="col-md-6">
            <input id="firstname" type="text" class="form-control" name="firstname">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-md-2 control-label">Last name</label>
        <div class="col-md-6">
            <input id="lastname" type="text" class="form-control" name="lastname">
        </div>
    </div>
    <div class="form-group">
        <label for="mail" class="col-md-2 control-label">E-Mail</label>
        <div class="col-md-6">
            <input id="mail" type="text" class="form-control" name="mail">
        </div>
    </div>
    <div class="form-group">
        <label for="phone" class="col-md-2 control-label">Phone</label>
        <div class="col-md-6">
            <input id="phone" type="text" class="form-control" name="phone">
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-md-2 control-label">Phone</label>
        <div class="col-md-6">
            <input type="password" class="form-control" id="password" name="password">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-10" style="float: right;">
            <button type="submit" class="btn btn-orange">
                <i class="fas fa-save"></i> Save Team Member
            </button>
            <button type="button" class="btn btn-outline-secondary load-content" id="cancel">
                <i class="fas fa-save"></i> Cancel
            </button>
        </div>
    </div>

</form>
