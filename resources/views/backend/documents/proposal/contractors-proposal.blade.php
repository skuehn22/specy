<div class="proposal-create">
    <div class="row">
        <div class="col-md-12">
            <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-12" style="padding-left:25px;">
                            @include('backend.documents.progress-bar-step3')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><hr></div>
                        <div class="col-md-10" style="padding-left:62px; padding-right:62px; padding-bottom:15px;"><h4> <strong>Basic Information</strong></h4></div>
                        <div class="col-xs-12 col-md-12"  style="padding-left:62px;">
                                <strong>Your Company: </strong>{{$provider->name}}, {{$provider->address}}, {{$provider->city}} <i class="fas fa-pen"></i>
                        </div>
                        <div class="col-xs-12 col-md-12"  style="padding-left:62px; padding-bottom:15px;">
                           <input type="hidden" value="1" id="clients" name="clients"> <strong>Client: </strong>John Doe, Columbus Street, Dublin <i class="fas fa-pen"></i>
                        </div>
                        <div class="col-xs-12 col-md-6"  style="padding-left:62px; padding-right:62px; padding-bottom:15px;">
                            <div class="form-group">
                                <label for="date_proposal">Offer Date</label>
                                <input
                                        type="text"
                                        data-date-autoclose="true"
                                        data-date-clear-btn="true"
                                        data-date-format="dd.mm.yyyy"
                                        data-date-language="fr"
                                        data-date-today-highlight="true"
                                        data-date-end-date="+2m"
                                        data-date-start-date="-3d"
                                        data-provide="datepicker"
                                        class="form-control"
                                        name="date-proposal"
                                        id="date-proposal"
                                        value="{{$contract_data["date"]}}"
                                />
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6" style="padding-right:62px;">
                            <div class="form-group">
                                <label for="date_proposal">Expiration Date</label>
                                <input
                                        type="text"
                                        data-date-autoclose="true"
                                        data-date-clear-btn="true"
                                        data-date-format="dd.mm.yyyy"
                                        data-date-language="fr"
                                        data-date-today-highlight="true"
                                        data-date-end-date="+2m"
                                        data-date-start-date="-3d"
                                        data-provide="datepicker"
                                        class="form-control"
                                        name="expires-date"
                                        id="expires-date"
                                        value="30.09.2018"
                                />
                            </div>
                        </div>


                        <div class="col-xs-12 col-md-12"  style="padding-left:62px; padding-right:62px; padding-bottom:15px;">
                        <div class="form-group">
                            <label for="comment">Description:</label>
                            <textarea class="form-control" rows="5" id="desc">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</textarea>
                        </div>
                        </div>

                        <div class="col-xs-12 col-md-6"  style="padding-left:62px; padding-bottom:15px; float:left;">

                            <strong>Requested Price:</strong> <input type="text" class="form-control" value="1200,00 €" readonly/>

                        </div>
                        <div class="col-xs-12 col-md-6" style="padding-right:62px;">

                            <strong>Your Offer:</strong>  <input type="text" class="form-control" value="1100,00 €"/>

                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-12" style="text-align: right;  padding-right:62px; padding-bottom: 25px;">
                              <button type="submit" class="btn btn-orange load-modul" id="save-proposal-blank">Next Step</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>