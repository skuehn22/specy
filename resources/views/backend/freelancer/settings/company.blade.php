

<div class="row">
    <div class="col-md-6">
        <form role="form" id="company-data" name="company-data" method="POST" action="/freelancer/settings/save-company">
        <h4>Your Company Details</h4>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-md-12 pl-0">

                <div class="form-row py-2">
                    <label class="col-md-3 col-form-label" for="company">
                        Company
                        <i class="fas fa-info-circle green" data-toggle="tooltip" data-placement="top" title="If you're a sole trader, just enter your name."></i>
                    </label>
                    <input id="company" type="text" class="form-control col-md-7" name="company" value="{{ $company->name or "" }}" required>
                </div>


                <div class="form-row py-2">
                    <label class="col-md-3 col-form-label" for="companytype">
                        Type
                    </label>

                    @if(isset($company->type))
                        {!! Form::select('companyType', $companyTypes, $company->type, ['class' => 'form-control col-md-7', 'id' => 'companyType','placeholder' => 'Select', 'required']) !!}
                    @else
                        {!! Form::select('companyType', $companyTypes, null, ['class' => 'form-control col-md-7', 'id' => 'companyType','placeholder' => 'Select', 'required']) !!}
                    @endif

                </div>

                <div class="form-row py-2">
                    <label class="col-md-3 col-form-label" for="address">Address 1</label>
                    <input id="address1" type="text" class="form-control col-md-7" name="address1" value="{{ $company->address1 or "" }}" required>
                </div>

                <div class="form-row py-2">
                    <label class="col-md-3 col-form-label" for="address2">Address 2</label>
                    <input id="address2" type="text" class="form-control col-md-7" name="address2" value="{{ $company->address2 or "" }}">
                </div>

                <div class="form-row py-2">
                    <label class="col-md-3 col-form-label" for="city">City</label>
                    <input id="city" type="text" class="form-control col-md-4" name="city" value="{{ $company->city or "" }}"  required>
                    <input id="postcode" type="text" class="form-control col-md-3" name="postcode" value="{{ $company->postcode or "" }}" placeholder="Post Code">
                </div>
                <div class="form-row py-2">
                    <label class="col-md-3 col-form-label" for="country">Country</label>


                    @if(isset($company->country_residence))
                        {!! Form::select('country', $countries, $company->country_residence, ['id' => 'country', 'required' => 'true', 'class' => 'form-control col-md-7']) !!}
                    @else
                        {!! Form::select('country', $countries, null, ['id' => 'country', 'required' => 'true', 'class' => 'form-control col-md-7']) !!}
                    @endif


                </div>
                <div class="form-row py-2">
                    <label class="col-md-3 col-form-label" for="city">Your Color</label>
                    <div id="color-picker-component" class="input-group colorpicker-component col-md-7 p-0">
                        <input type="text" value="{{ $company->color or "#19A3B8" }}" class="form-control  col-md-12" name="color"/><span class="input-group-addon"><i></i></span>
                    </div>
                </div>
            </div>
            <div class="form-row py-2 pt-5">
                <button type="submit" class="btn btn-classic">
                    <i class="fas fa-save"></i> Save Settings
                </button>
            </div>
        </form>
    </div>

    <div class="col-md-6">
        @include('ajax_upload')
    </div>
</div>


