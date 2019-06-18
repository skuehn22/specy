<div class="col-md-9 p-0">
    <div class="form-row py-2 pt-0 pl-0 ml-0">
        <h3 class="pt-0">Add Documents</h3>
    </div>

    <p style="font-size: 11px;">Optional: Add the project plan, details of deliverables, your contract or your terms of service- anything that's relevant to the project. <br>Make sure you and your client have a written record of your agreement!</p>
    <hr>
    <div class="alert" id="message" style="display: none"></div>
    <div class="row py-2 pt-0 pl-0 ml-0">
        <div class="col-md-7" style="background-color: #ddd;">

            <input type="hidden" id="plan" name="plan" value="{{$plan->id}}">
            {{ csrf_field() }}

            <div class="form-row py-2">
                <label class="col-md-2 col-form-label" for="doc-name">
                    Name <i class="fas fa-info-circle green" data-toggle="tooltip" data-placement="top" title="document name will be shown if left blank"></i>
                </label>
                <input type="text" class="form-control col-md-5" id="doc-name" name="doc-name" required>
            </div>

            <div class="form-row py-2 pl-0">
                <div class="col-md-2">
                </div>
                <div class="col-md-7 pl-0">
                    <input type="file" name="select_file" id="select_file" /><br>
                    <p style="float: right;">
                        <br><br>
                        <span class="logo-hint">*pdf, jpg, png, gif</span>
                        <input type="submit" name="upload" id="upload" class="btn btn-secondary" value="Upload">
                    </p>
                </div>
            </div>

        </div>
        <div class="col-md-5">
            <div id="uploaded_image" class="d-none">
                <span style="font-weight: 500;">Attached Documents</span>
            </div>
        </div>
    </div>
    <div class="form-row py-2">
        <div class="col-md-12 pt-1">
            <div class="btn-group sw-btn-group" role="group" >
                <button class="btn btn-secondary prev-btn" id="prev-btn" type="button">Back</button>
                <button class="btn btn-success next-btn" id="next-btn" type="button">Next</button>
            </div>
        </div>
    </div>
</div>

