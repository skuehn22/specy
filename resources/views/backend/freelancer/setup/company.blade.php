<div class="company">
    <div class="row">
        <div class="col-md-6">
            <h5>Company Details</h5>

        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p>Give details about your company / freelance activity</p>
            <form data-toggle="validator" role="form" id="company-data" name="company-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-row py-2">
                    <label class="col-md-3 col-form-label" for="firstname">First name</label>
                    <input id="firstname" type="text" class="form-control col-md-7" name="firstname" value="{{ $company->firstname or "" }}" required>
                </div>

                <div class="form-row py-2">
                    <label class="col-md-3 col-form-label" for="lastname">Last name</label>
                    <input id="lastname" type="text" class="form-control col-md-7" name="lastname" value="{{ $company->lastname or "" }}"  required>
                </div>

                <div class="form-row py-2">
                    <label class="col-md-3 col-form-label" for="company">Company</label>
                    <input id="company" type="text" class="form-control col-md-7" name="company" value="{{ $company->name or "" }}"  required>
                </div>

                <div class="form-row py-2">
                    <label class="col-md-3 col-form-label" for="address">Address</label>
                    <input id="address" type="text" class="form-control col-md-7" name="address" value="{{ $company->address or "" }}"  required>
                </div>

                <div class="form-row py-2">
                    <label class="col-md-3 col-form-label" for="city">City</label>
                    <input id="city" type="text" class="form-control col-md-7" name="city" value="{{ $company->city or "" }}"  required>
                </div>

                <div class="form-row py-2">
                    <label class="col-md-3 col-form-label" for="country">Country</label>
                    @include('backend.settings.countries', [ 'id' => 'country', 'class' => 'form-control col-md-7', 'default' => $user->country])
                </div>



            </form>

        </div>
        <div class="col-md-6">
            @include('ajax_upload')
        </div>
        <div class="col-md-2 pt-3" style="float: left; text-align: left;">
            <a id="prev-btn-step1" class="prev-btn" style="text-decoration: underline;">back</a>
        </div>
        <div class="col-md-10 pl-0 pt-3" style="float: right; text-align: right;">
            <div class="btn-group navbar-btn" role="group">
                <button class="btn btn-success next-btn save-company" id="next-btn" type="button">Next Step</button>
            </div>
        </div>
    </div>

</div>

@section("js")

@stop