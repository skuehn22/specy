<div class="clients">
    <div class="row">
        <div class="col-md-6">
            <h5>Add a Client</h5>

        </div>
    </div>

    <form data-toggle="validator" role="form" id="client-data" name="client-data">
    <div class="row">
        <div class="col-md-12">
            <p>Create one of your clients</p>
        </div>
        <div class="col-md-6">
                <h5>Contact</h5>
                <div class="form-row py-2">
                    <label class="col-md-4 col-form-label" for="firstname">First name</label>
                    <input type="text" class="form-control col-md-7" id="client-firstname" name="client-firstname" required>
                </div>
                <div class="form-row py-2">
                    <label class="col-md-4 col-form-label"  for="lastname">Last name</label>
                    <input type="text" class="form-control col-md-7" id="client-lastname" name="client-lastname" required>
                </div>
                <div class="form-row py-2">
                    <label class="col-md-4 col-form-label"  for="client-mail">Email address</label>
                    <input type="email" class="form-control col-md-7" id="client-mail" name="client-mail" aria-describedby="emailHelp" required>
                </div>
                <div class="form-row py-2">
                    <label class="col-md-4 col-form-label"  for="client-phone">Phone</label>
                    <input type="text" class="form-control col-md-7" id="client-phone" name="client-phone" required>
                </div>
                <div class="form-row py-2">
                    <label class="col-md-4 col-form-label"  for="client-mobile">Mobile</label>
                    <input type="text" class="form-control col-md-7" id="client-mobile" name="client-mobile" required>
                </div>


        </div>
        <div class="col-md-6">
            <h5>Billing</h5>
            <div class="form-row py-2">
                <label class="col-md-4 col-form-label" for="currency">Curreny</label>
               <select id="currency" name="currency" class="form-control col-md-7">
                   <option>select</option>
                   <option value="eur">EUR</option>
                   <option value="gbp">GBP</option>
               </select>
            </div>
            <div class="form-row py-2">
                <label class="col-md-4 col-form-label"  for="client-address1">Address 1</label>
                <input type="text" class="form-control col-md-7" id="client-address1" name="client-address1" required>
            </div>
            <div class="form-row py-2">
                <label class="col-md-4 col-form-label"  for="client-address2">Address 2</label>
                <input type="text" class="form-control col-md-7" id="client-address2" name="client-address2" required>
            </div>
            <div class="form-row py-2">
                <label class="col-md-4 col-form-label"  for="city">City</label>
                <input type="text" class="form-control col-md-7" id="client-city" name="client-city" required>
            </div>
            <div class="form-row py-2">
                <label class="col-md-4 col-form-label" for="country">Country</label>
                @include('backend.settings.countries', [ 'id' => 'country', 'class' => 'form-control col-md-12', 'default' => $user->country])
            </div>
        </div>
        <div class="col-md-2 pt-3" style="float: left; text-align: left;">
            <a id="prev-btn" class="prev-btn" style="text-decoration: underline;">back</a>
        </div>
        <div class="col-md-4">
            <div id="msg" style="color: green;text-align: right; float: right; padding-top: 18px;"></div>
        </div>
        <div class="col-md-5 pt-3" style="float: right; text-align: right;">
            <div class="btn-group navbar-btn" role="group">
                <button class="btn btn-success float-right text-right save-client" type="button" >Add Client</button>&nbsp;&nbsp;
                <button class="btn btn-secondary next-btn client-next" id="next-btn" type="button">Skip Step</button>
            </div>
        </div>

    </div>
    </form>
</div>