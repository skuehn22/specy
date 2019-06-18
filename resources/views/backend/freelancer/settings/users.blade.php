@if(Session::has('success'))
    <div class="alert alert-success error_message">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        {{ Session::get('success') }}
    </div>
@endif
<div class="inner-panel">
<table class="table">
    <thead>
    <tr>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>

    @if(isset($team))
    @foreach($team as $member)

        <tr>
            <td>{{$member->firstname}}</td>
            <td>{{$member->lastname}}</td>
            <td>{{$member->email}}</td>
        </tr>

    @endforeach
    @endif


    </tbody>
</table>

<div id="content-container">
    <button type="button" class="btn btn-outline-dark load-content" id="new-team-member">New Team Member</button>
    @if(isset($button)){{$button}}@endif
</div>

</div>
