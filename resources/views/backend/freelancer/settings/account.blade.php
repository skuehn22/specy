<div class="row">
    <div class="col-md-6">
        <form class="form-horizontal" role="form" method="POST" action="/freelancer/settings/change-password">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h4 class="pb-3">Privacy Settings</h4>
            <div class="form-group">
                <label for="email" class="col-md-5 control-label  pl-0">E-Mail</label>
                <div class="col-md-8 pl-0">
                    <input id="email" type="text" class="form-control" name="email" value="{{$user->email}}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-5 control-label  pl-0">New Password</label>
                <div class="col-md-8 pl-0">
                    <input id="password" type="password" class="form-control" name="password" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="col-md-5 control-label  pl-0">Confirm New Password</label>
                <div class="col-md-8 pl-0">
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" value="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 pl-0">
                    <button type="submit" class="btn btn-classic">
                        <i class="fas fa-save"></i> Save Password
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6">

        <form class="form-horizontal" role="form" method="POST" action="/freelancer/settings/email-pref">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h4 class="pb-3">E-Mail Preferences</h4>
            <div class="form-check pb-4">

                @if(isset($user_pref) && $user_pref->nl == 1)
                    <input class="form-check-input" type="checkbox" value="check" name="newsletter" id="newsletter" checked>
                @else
                    <input class="form-check-input" type="checkbox" value="check" name="newsletter" id="newsletter">
                @endif

                <label class="form-check-label" for="defaultCheck1">
                    &nbsp;&nbsp;Trustfy Newsletter
                </label>
            </div>
            <div class="form-check pb-4">

                @if(isset($user_pref) && $user_pref->special_offer == 1)
                    <input class="form-check-input" type="checkbox" value="check" name="offers" id="offers" checked>
                @else
                    <input class="form-check-input" type="checkbox" value="check" name="offers" id="offers">
                @endif

                <label class="form-check-label" for="defaultCheck1">
                    &nbsp;&nbsp;Special offers and updates
                </label>
            </div>
            <div class="form-group">
                <div class="col-md-10 pl-0">
                    <button type="submit" class="btn btn-classic">
                        <i class="fas fa-save"></i> Save Preferences
                    </button>
                </div>
            </div>
        </form>

        <!--
        <h4  class="pt-3">Manage Database</h4>
        <div class="row">
            <div class="col-md-6 pt-0">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <h5 class="pt-5">Reset Account</h5>
                    <p>Deletes all clients and project data.</p>
                    <div class="form-group">
                        <div class="col-md-10 pl-0">
                            <button type="button" class="btn btn-alternative reset-account">
                                <i class="fas fa-trash-alt"></i> Reset Account
                            </button>
                        </div>
                    </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <h5 class="pt-5">Installation Demo Data</h5>
                <p>Installs a package with demo data.</p>
                <div class="form-group">
                    <div class="col-md-10 pl-0">
                        <button type="button" class="btn btn-info" id="install-demo" style="width: 200px;">
                            <i class="fas fa-plus-square"></i> Install Demo
                        </button>
                    </div>
                </div>
            </div>


        </div>
 -->
    </div>

</div>
