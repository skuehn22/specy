<div class="upcoming">
    <div class="col-lg-12 col-md-12 col-sm-12 p-0">
        <div class="materialbox materialbox-upcoming p-0 mb-4">
            <div class="card-body pb-1">
                <div class="row">
                    <div class="col-4 col-md-4 pt-3">
                        <div class="text-center">
                            <i class="fas fa-map-marker-alt green"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-6 pt-3 text-center">
                        <div class="">
                            <p class="headline green">Upcoming </br>Payment</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center  pt-2 pb-2">
                <div class="text">
                    @if(count($plans)>0 && $upcoming != false)
                       Plan Name: {{ $upcoming->planName or '' }}<br>
                       Due on: {{date('d.m.Y', strtotime($upcoming->due_at))}} -  € {{ number_format($upcoming->amount, 2) }}
                    @else
                        No payments yet!.
                    @endif
                </div>
            </div>
        </div>
        <div class="materialbox materialbox-upcoming p-0">
        <div class="col-md-12 pl-5 pt-4 pb-2">
            <p class="headline green">New Payment Plan</p>


            @if(count($clients)>0)
                <form class="form-horizontal" role="form" method="POST" action="/freelancer/plans/new">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <select name="clients" id="clients" class="form-control col-md-11" required>
                    <option></option>
                    @foreach($clients as $client)
                            <option value="{{$client->id}}">{{$client->firstname}} {{$client->lastname}}</option>
                    @endforeach
                </select>
                    <p class="pt-3"><button type="submit" class="btn btn-success btn-normal col-md-11">Create</button></p>
                <div class="help-block with-errors"></div>
                </form>
            @else
                <span id="client-list"></span>

                <div class="pt-2">
                    <div  id="no-client">No clients created yet. <a href="#" id="create-client-fly"><br>Create Client</a></div>
                </div>

            @endif



        </div>
        </div>
    </div>
</div>

