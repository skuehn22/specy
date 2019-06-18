
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Why do we need this information?</strong> This isn’t about collecting your data! There’s a lot of bad people out there (think traffickers and terrorists) trying to launder money through legitimate businesses, and we’re dedicated to preventing that. By properly verifying our users, we’re staying compliant with national and EU regulation and doing our part to stop them.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>


<div class="row">
    <div class="col-md-6 pb-5">
        <form role="form" id="company-data" name="company-data" method="POST" action="/freelancer/settings/save-legal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <h4>Legal Representative
            <i class="fas fa-info-circle green" data-toggle="tooltip" data-placement="top" title="This information is required for a payment out."></i>
        </h4>

        <div class="form-row py-2">
            <label class="col-md-3 col-form-label" for="firstname">
                First name*
                <i class="fas fa-info-circle green" data-toggle="tooltip" data-placement="top" title="Name of company’s legal representative person"></i>
            </label>
            <input id="firstname" type="text" class="form-control col-md-7" name="firstname" value="{{ $company->firstname or "" }}"required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>

        <div class="form-row py-2">
            <label class="col-md-3 col-form-label" for="address">Last name*</label>
            <input id="lastname" type="text" class="form-control col-md-7" name="lastname" value="{{ $company->lastname or "" }}" required>
        </div>

        <div class="form-row py-2">
            <label class="col-md-3 col-form-label" for="birthday">
                Birthday*
                <i class="fas fa-info-circle green" data-toggle="tooltip" data-placement="top" title="Birthday of company’s legal representative person"></i>
            </label>
            <input type="date" name="birthday" min="1000-01-01" max="3000-12-31" class="form-control col-md-7" value="{{  $company->birthday or "" }}" required>
        </div>
        <div class="form-row py-2">
            <label class="col-md-3 col-form-label" for="nationality">Nationality*</label>

            @if(isset($company->country_nationality))
                {!! Form::select('nationality', $countries, $company->country_nationality, ['id' => 'nationality', 'required' => 'true', 'class' => 'form-control col-md-7']) !!}
            @else
                {!! Form::select('nationality', $countries, null, ['id' => 'nationality', 'required' => 'true', 'class' => 'form-control col-md-7']) !!}
            @endif

        </div>
        <div class="form-row py-2 pt-5">
            <button type="submit" class="btn btn-classic">
                <i class="fas fa-save"></i> Save Settings
            </button>
        </div>
        </form>
    </div>
</div>
@if(isset($company->type))

    <p style="font-size: 12px;">As a  {{ trans('freelancer_backend.company_types_'.$company->type) }} you need following documents: {{$kyc_docs->mango_kyc_docs}}.</i> <a href="#" id="kyc-details"><strong>Details</strong></a></p>
@else
    <p style="color: orange">Please save your company first</p>

@endif
<div class="row">

    <div class="col-md-4 pl-0">
        <form data-toggle="validator" role="form" id="company-data" name="company-data" method="POST" action="/freelancer/settings/kyc-check"  enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-md-12">

                <label class="col-md-12 col-form-label pl-0" for="type">Document Type</label>
                <select name="type" id="type" class="form-control col-md-9">
                    <option value=""></option>


                    @if(isset($company->type) && $company->type == 1)

                        <option value="IDENTITY_PROOF">{{ trans('freelancer_backend.IDENTITY_PROOF') }}</option>
                        <option value="REGISTRATION_PROOF">{{ trans('freelancer_backend.REGISTRATION_PROOF') }}</option>

                    @elseif(isset($company->type) && $company->type == 2)

                        <option value="IDENTITY_PROOF">{{ trans('freelancer_backend.IDENTITY_PROOF') }}</option>
                        <option value="REGISTRATION_PROOF">{{ trans('freelancer_backend.REGISTRATION_PROOF') }}</option>
                        <option value="ARTICLES_OF_ASSOCIATION">{{ trans('freelancer_backend.ARTICLES_OF_ASSOCIATION') }}</option>
                        <option value="SHAREHOLDER_DECLARATION">{{ trans('freelancer_backend.SHAREHOLDER_DECLARATION') }}</option>

                    @else

                        <option value="IDENTITY_PROOF">{{ trans('freelancer_backend.IDENTITY_PROOF') }}</option>
                        <option value="REGISTRATION_PROOF">{{ trans('freelancer_backend.REGISTRATION_PROOF') }}</option>
                        <option value="ARTICLES_OF_ASSOCIATION">{{ trans('freelancer_backend.ARTICLES_OF_ASSOCIATION') }}</option>

                    @endif


                </select>

                <div class="form-group" style="padding-top: 15px;">
                    <input type="file" name="select_file" id="select_file" /><br><span class="logo-hint">*pdf, jpg, png, gif</span>
                </div>

                <p style="font-size: 11px;">
                    Note: Please make sure all pages are contained in the document e.g. front and back of driving license
                </p>

                <div class="form-group">
                    <div class="col-md-10 float-left text-left pt-5 pl-0">
                        <button type="submit" class="btn btn-classic">
                            <i class="fas fa-save"></i> Send Document
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-7">
        @if(count($kyc_doc_objs)>0)
            <label class="col-md-12 col-form-label pl-0" for="type">KYC process</label>
            <table  class="table" style="font-size: 10px;
">
                <thead>
                <tr>
                    <th scope="col">Document Type</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Status</th>
                    <th scope="col">Note</th>
                </tr>
                </thead>

                <tbody>
            @foreach($kyc_doc_objs as $kyc_doc_obj)
                <tr>
                    <td>{{$kyc_doc_obj->doc_type}}</td>
                    <td>{{ \Carbon\Carbon::parse($kyc_doc_obj->created_at)->format('d/m/Y H:i')}}</td>
                    <td>

                        @if($kyc_doc_obj->status == "VALIDATION_ASKED")
                            <i>pending</i>
                        @else
                            {{$kyc_doc_obj->status}}
                        @endif

                    </td>
                    <td>
                        @if($kyc_doc_obj->status == "REFUSED")
                            {{$kyc_doc_obj->refused_reason_type}}
                        @endif
                    </td>
                </tr>
            @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>


