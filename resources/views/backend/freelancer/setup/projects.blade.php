<div class="clients">
    <div class="row">
        <div class="col-md-6">
            <h5>Create a Projects</h5>

        </div>
    </div>
    <form data-toggle="validator" role="form" id="project-data" name="project-data">
    <div class="row">
       <div class="col-md-12">
           <p>Give us some information about a project that you would like to charge.</p>

       </div>
        <div class="col-md-6">
            <h5>General Information</h5>
            <div class="form-row py-2 client-list" id="client-list"></div>
            <div class="form-row py-2">
                <label class="col-md-4 col-form-label" for="project-name">Name</label>
                <input type="text" class="form-control col-md-7" id="project-name" name="project-name">
            </div>
            <div class="form-row py-2">
                <label class="col-md-4 col-form-label"  for="project-description">Description</label>
                <textarea class="form-control col-md-7" rows="4" id="project-description" name="project-description"></textarea>
            </div>
            <div class="form-row py-2">
                <label class="col-md-4 col-form-label"  for="project-notes">Internal Notes</label>
                <textarea class="form-control col-md-7" rows="4" id="project-notes" name="project-notes"></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <h5>Address optional</h5>
            <div class="form-row py-2">
                <label class="col-md-3 col-form-label"  for="project-address1">Address1</label>
                <input type="text" class="form-control col-md-7" id="project-address1" name="project-address1">
            </div>
            <div class="form-row py-2">
                <label class="col-md-3 col-form-label"  for="project-address2">Address2</label>
                <input type="text" class="form-control col-md-7" id="project-address2" name="project-address1">
            </div>
            <div class="form-row py-3">
                <label class="col-md-3 col-form-label"  for="project-city">City</label>
                <input type="text" class="form-control col-md-7" id="project-city" name="project-city">
            </div>
            <div class="form-row py-2">
                <label class="col-md-3 col-form-label" for="country">Country</label>
                @include('backend.settings.countries', [ 'id' => 'country', 'class' => 'form-control col-md-7', 'default' => $user->country])
            </div>
        </div>
        <div class="col-md-2 pt-3" style="float: left; text-align: left;">
            <a id="prev-btn" class="prev-btn" style="text-decoration: underline;">back</a>
        </div>
        <div class="col-md-4">
            <div id="msg-project" style="color: green;text-align: right; float: right; padding-top: 18px;"></div>
        </div>
        <div class="col-md-5 pt-3" style="float: right; text-align: right;">
            <div class="btn-group navbar-btn" role="group">
                <button class="btn btn-success float-right text-right save-project" type="button" >Add Project</button>&nbsp;&nbsp;
                <button class="btn btn-secondary next-btn project-next" id="next-btn" type="button">Skip Step</button>
            </div>
        </div>

    </div>
    </form>
</div>