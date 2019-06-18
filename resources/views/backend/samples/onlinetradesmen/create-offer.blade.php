<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="step1">
                <input type="hidden" id="_hash" value="{{ csrf_token() }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <label for="exampleInputEmail1">Project</label>
                <form class="form-inline" action="#">
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" id="project_id" name="project_id" placeholder="Enter Project ID" required>
                    </div>
                    <button type="submit" class="btn btn-success mb-2 find-project">Find</button>
                </form>
                <br><br>
                <div class="form-group">
                    <label for="exampleInputEmail1">Your Offer</label>
                    <input type="number" class="form-control" id="offer_amount" name="offer_amount" placeholder="Enter Amount" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Comments</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success setup-payment" style="width:100%; background-color: #FF9340; border-color: #bebebe; border-radius: 2px;">Setup Payment Plan</button>
                </div>
            </div>
            <div class="step2" style="display:none;">
                <div class="row">
                    <div class="col-md-12"><h4>Select Payment Plan</h4></div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <select class="form-control" name="paymenttyp" id="paymenttyp">
                                <option value="0">select</option>
                                <option value="1">Single Deposit</option>
                                <option value="2">Milestone Plan</option>
                                <option value="3">Invoiced</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 milestonepay" style="display:none;"><h4>Set up Milestone Plan</h4></div>
                    <div class="col-md-12 milestonepay" style="display:none;">

                        <form>
                            <div class="row">
                                <div class="col-md-4"> <input type="text" id="name" placeholder="Milestone" class="form-control"></div>
                                <div class="col-md-4"> <input type="text" id="percentages" placeholder="Percentage" class="form-control"></div>
                                <div class="col-md-2"> <input type="button" class="add-row btn btn-orange" value="+"></div>
                                <div class="col-md-2"> <button type="button" class="delete-row btn btn-orange">-</button></div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-md-12" style="padding-top:25px;">
                                <table>
                                    <thead>
                                    <tr>
                                        <th style="width:100px;">Select</th>
                                        <th style="width:250px;">Name</th>
                                        <th style="width:300px;">Percentage</th>
                                        <th style="width:150px; text-align: right;">Amount  </th>
                                    </tr>
                                    <tr><td><input type='checkbox' name='record'></td><td>Project Start</td><td>50 %</td><td style="text-align: right;">550.00 €</td></tr>
                                    <tr>
                                        <td colspan="4" style="width:100%;"> <hr></td>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 send-offer" style="float:right; display: none;">
                        <button type="submit" class="btn btn-orange send-offer"id="save-proposal-blank">Send your offer</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4 project" style="display:none;">
            <h1><strong>To move a 2 bar circulation pump from third floor</strong></h1>
            <div class="row">
                <div class="col-md-12">
                    <strong>Trade</strong><br>Plumbing - Existing Property
                </div>
                <div class="col-md-12">
                    <strong>Town</strong><br>Rathgar
                </div>
                <div class="col-md-12">
                    <strong>County</strong><br>Dublin South
                </div>
                <div class="col-md-12">
                    <strong>Your Name:</strong><br>**********
                </div>
                <div class="col-md-12">
                    <strong>our Email:</strong><br>**********
                </div>
                <div class="col-md-12">
                    <strong>Your Mobile Phone:</strong><br>**********
                </div>
                <div class="col-md-12">
                    <strong>Description:</strong><br>To move a 2 bar circulation pump from third floor eaves to the ground floor under the stairs. The position would be adjacent to existing bathroom giving access to pipe work
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