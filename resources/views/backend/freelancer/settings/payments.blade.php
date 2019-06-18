<form class="form-horizontal" role="form" method="POST" action="/freelancer/settings/save-bank">
<div class="row">

    <div class="col-md-6">

            <h4 class="pb-3">Your Bank Details
                <i class="fas fa-info-circle green" data-toggle="tooltip" data-placement="top" title="Which account should we release payments to?"></i>
            </h4>

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-md-12 pl-0">

                <div class="form-row py-2">
                    <label for="name" class="col-md-4 control-label  pl-0 pb-3">Owner Name
                        <i class="fas fa-info-circle green" data-toggle="tooltip" data-placement="top" title="This must match the company or the legal representative"></i>
                    </label>
                    <input id="name" type="text" class="form-control col-md-7" name="name" value="{{$bank->name or ''}}" required>
                </div>

                <div class="form-row py-2">
                    <label for="iban" class="col-md-4 control-label  pl-0 pb-3">IBAN</label>
                    <input id="iban" type="text" class="form-control col-md-7" name="iban" value="{{$bank->iban or ''}}" required>
                </div>

                <div class="form-row py-2">
                    <label for="bic" class="col-md-4 control-label  pl-0 pb-3">BIC</label>
                    <input id="bic" type="text" class="form-control col-md-7" name="bic" value="{{$bank->bic or ''}}" required>
                </div>
            </div>
    </div>

    <div class="col-md-6">
        <h4>Address <i class="fas fa-info-circle green" data-toggle="tooltip" data-placement="top" title="The address of the owner of the bank account"></i>
        </h4>

        <div class="form-row py-2">
            <label for="address1" class="col-md-3 col-form-label">Address Line 1

            </label>
            <input id="address1" type="text" class="form-control col-md-7" name="address1" value="{{$bank->address1 or ''}}" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>

        <div class="form-row py-2">
            <label for="address2" class="col-md-3 col-form-label">Address Line 2</label>
            <input id="address2" type="text" class="form-control col-md-7" name="address2" value="{{$bank->address2 or ''}}">
        </div>

        <div class="form-row py-2">
            <label for="city" class="col-md-3 col-form-label">City</label>
            <input id="city" type="text" class="form-control col-md-7" name="city" value="{{$bank->city or ''}}" required>
        </div>

        <div class="form-row py-2">
            <label for="code" class="col-md-3 col-form-label">Postal Code</label>
            <input id="code" type="text" class="form-control col-md-7" name="code" value="{{$bank->zip or ''}}">
        </div>


        <div class="form-row py-2">
            <label class="col-md-3 col-form-label" for="nationality">Country*</label>

            @if(isset($bank->country))
                {!! Form::select('country', $countries, $bank->country, ['id' => 'country_bank', 'required' => 'true', 'class' => 'form-control col-md-7']) !!}
            @else
                {!! Form::select('country', $countries, null, ['id' => 'country', 'required' => 'true', 'class' => 'form-control col-md-7']) !!}
            @endif
            <input type="hidden" id="country_iso" name="country_iso" value="{{$bank->country_iso or ''}}">
        </div>

        <div class="form-group">
            <div class="col-md-10 float-left text-left pt-5 pl-0">
                <button type="submit" class="btn btn-classic">
                    <i class="fas fa-save"></i> Save Settings
                </button>
            </div>
        </div>



    </div>
</div>

</form>