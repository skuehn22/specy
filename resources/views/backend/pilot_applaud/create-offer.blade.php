<div class="container">
    <div class="row">
        <div class="col-md-4">
            <input type="hidden" id="_hash" value="{{ csrf_token() }}">

            <div class="form-group">
                <label for="exampleInputEmail1">Performer</label>
                <select class="form-control" id="performers">
                    <option value="">select</option>
                    <option value="performer@applaud.com">Emma Langford</option>
                    <option value="performer@applaud.com">Eamonn Moran</option>
                    <option value="performer@applaud.com">Philip Dunne</option>
                    <option value="performer@applaud.com">David Kiernan</option>
                    <option value="performer@applaud.com">Natalie Turner</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Client</label>
                <select class="form-control" id="clients_" name="clients_">
                    <option value="">select</option>
                    <option value="client@applaud.com">Client 1</option>
                    <option value="client@applaud.com">Client 2</option>
                    <option value="client@applaud.com">Client 3</option>
                    <option value="client@applaud.com">Client 4</option>
                </select>
            </div>
            <!--
            <div class="form-group">
                <label for="exampleInputEmail1">Firstname</label>
                <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="emailHelp" placeholder="Enter Firstname" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Lastname</label>
                <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="emailHelp" placeholder="Enter Lastname" required>
            </div>
            -->
            <div class="form-group">
                <label for="exampleInputEmail1">Amount</label>
                <input type="number" class="form-control" id="offer_amount" name="offer_amount" placeholder="Enter Amount" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Performer Fee (%)</label>
                <input type="text" class="form-control" id="service_fee_performer" name="service_fee_performer" value="5" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Client Fee (%)</label>
                <input type="text" class="form-control" id="service_fee_client" name="service_fee_client" value="8" required>
            </div>

        </div>
        <div class="col-md-4">
            <h4><strong>Calculation</strong></h4>

            <div class="row">
                <div class="col-md-6">
                    Amount Offer
                </div>
                <div class="col-md-6 calculation">
                    <span class="calculation-amount">0.00 €</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    Performer Fee
                </div>
                <div class="col-md-6 calculation">
                    <span class="calculation-performer-fee">0.00 €</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    Client Fee
                </div>
                <div class="col-md-6 calculation">
                    <span class="calculation-client-fee">0.00 €</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Client Offer
                </div>
                <div class="col-md-6 calculation">
                    <span class="calculation-client-offer">0.00 €</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Performer Offer
                </div>
                <div class="col-md-6 calculation">
                    <span class="calculation-performer-offer">0.00 €</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Applaud
                </div>
                <div class="col-md-6 calculation">
                    <span class="calculation-applaud-offer">0.00 €</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="padding-top: 15px; text-align: right;">
                    <button type="submit" class="btn btn-primary" id="create-button">Create Payment Button</button>
                </div>
            </div>

            <div class="row button-area" style="display:none;">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="pay-buttom">Pay Button:</label><br>
                        <p><a class="btn btn-success payin-btn" href="" target="_blank" role="button">Secure Escrow</a></p>
                        <p><textarea rows="2" cols="48" id="pay-button-area"></textarea></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>