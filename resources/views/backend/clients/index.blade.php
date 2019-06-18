
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Clients</legend>
                <table class="table table-bordered display" id="myTable">
                    <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Last name</th>
                        <th>First name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Mail</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td style="width:30px"><input type="checkbox" class="radio" value="{{$client->id}}" name="check"></td>
                            <td>{{$client->lastname}}</td>
                            <td>{{$client->firstname}}</td>
                            <td>{{$client->address}}</td>
                            <td>{{$client->city}}</td>
                            <td>{{$client->email}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </fieldset>
