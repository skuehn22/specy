<div class="row">
    <div class="col-md-12">
        <h4>Add your logo</h4>
        <div class="alert" id="message" style="display: none"></div>

        </form>
        <br />

    </div>
</div>
<div class="row">
    <form method="post" id="upload_form" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-md-6">
        <input type="file" name="select_file" id="select_file" /><br><span class="logo-hint">*jpg, png, gif</span>
    </div>
    <div class="col-md-6 pt-5">
        <input type="submit" name="upload" id="upload" class="btn btn-secondary btn-upload" value="Upload">
    </div>
    </form>
</div>
<div class="row pt-5">
    <div class="col-md-12">
        <span id="uploaded_image">
        @if(isset($company->logo))
        <img src="/uploads/companies/logo/{{$company->logo or ''}}" class="img-thumbnail" width="300">
        <a style="color: #1b1e21" href="#" id="delete-image"><i class="fas fa-minus-circle"></i> delete</a>
        @endif
        </span>
    </div>
</div>