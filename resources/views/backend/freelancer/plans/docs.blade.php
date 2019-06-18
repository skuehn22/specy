<div class="form-row py-2 pt-3 pl-0 ml-0">
     <span style="font-weight: 500;">Attached Documents</span>
</div>

@if(isset($docs))
    @foreach($docs as $doc)

        <p class="{{$doc->id}}">
            <span>@if(strlen($doc->name)>0) {{$doc->name}} @else {{$doc->filename}} @endif</span>
            <a href="#" data-id="{{$doc->id}}" data-toggle="tooltip" data-placement="top" title="" class="delete-doc" data-original-title="Delete">
                <i class="fas fa-trash green"></i>
            </a>
        </p>

    @endforeach
@endif


