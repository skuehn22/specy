@if(isset($project->state))

<div class="row">
    <div class="col-md-12 pl-5">
        <h4>{{$project->name or ''}}</h4>
    </div>
</div>

<div class="row">

    <div class="col-md-6 pl-5">
        <div class="row">
            <div class="col-md-12 pb-3">
               Client: {{$project->firstname or ''}} {{$project->lastname or ''}}
            </div>
            <div class="col-md-12">
                Address: {{$project->address1 or ''}} <br>{{$project->address2 or ''}} {{$project->city or ''}}
            </div>
        </div>
    </div>

    <div class="col-md-6 pl-5">
        <div class="row">
                <div class="col-md-12 pb-3">
                    Status:   <span class="status {{$project->color or ''}}">&bull;</span> {{$project->state or ''}}
                </div>
                <div class="col-md-12">
                    Plan Creation: {{date('d.m.Y', strtotime($project->date))}}
                </div>
                <div class="col-md-12">
                    @if(is_array($docs))
                        @if($docs != null && count($docs)>0)

                            <span>Attached Documents:</span>

                            @foreach( $docs as $doc)
                                {{$doc->name}}
                            @endforeach
                        @endif
                    @endif
                </div>
        </div>
    </div>


</div>


<div class="col-md-12" style="margin-top: -25px;">
    <div class="row">
        <div class="col-md-12">
            <h5>Payments</h5>
        </div>
    </div>
</div>

@if(isset($milestones))

        <div class="col-md-12">
            <div class="row p-3">

                @if(count($milestones)>1)
                    <div class="col-md-4 p-3  pl-4"   style="background-color: #e2e2e2; color: #566787;">
                        {{count($milestones)}} Milestones
                    </div>
                    <div class="col-md-4 p-3"   style="background-color: #e2e2e2; color: #566787;">
                    </div>
                    <div class="col-md-4 p-3 pr-4 text-right"   style="background-color: #e2e2e2;">
                        <span style="color: #566787;">
                             <a class="" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Show details <i class="fas fa-angle-double-down"></i>
                             </a>
                        </span>
                    </div>
                @else
                    <div class="col-md-1 p-3 text-left" style="background-color: #19A3B8; color: #fff; font-weight: 600">
                        {{ $milestones[0]->order }}
                    </div>
                    <div class="col-md-4 p-3"   style="background-color: #e2e2e2; color: #566787;">
                        {{$milestones[0]->name or ''}}
                    </div>
                    <div class="col-md-4 p-3"   style="background-color: #e2e2e2; color: #566787;">

                        Due on: {{date('d.m.Y', strtotime($milestones[0]->due_at ))}}

                    </div>
                    <div class="col-md-3 p-3"   style="background-color: #e2e2e2;">
                        <span style="color: #566787;">Status:</span>   <span class="status {{$milestones[0]->color or ''}}">&bull;</span> <span style="color: #566787;">{{$milestones[0]->state or ''}}</span>
                    </div>
                    <div class="col-md-12 pt-3 text-center">
                        <a style="color: #7f7f7f;" href="/freelancer/plans/payment-plan/{{$project->hash}}">Show details</a>
                    </div>
                @endif
        </div>
    </div>


    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            @foreach($milestones as $milestone)


                        <div class="col-md-12">
                            <div class="row p-3">
                                <div class="col-md-1 p-3 text-center" style="background-color: #19A3B8; color: #fff; font-weight: 600">
                                    {{ $milestone->order }}
                                </div>
                                <div class="col-md-4 p-3"   style="background-color: #e2e2e2; color: #566787;">
                                    {{$milestone->name or ''}}
                                </div>
                                <div class="col-md-4 p-3"   style="background-color: #e2e2e2; color: #566787;">

                                    Due on: {{date('d.m.Y', strtotime($milestone->due_at ))}}

                                </div>
                                <div class="col-md-3 p-3"   style="background-color: #e2e2e2;">
                                    <span style="color: #566787;">Status:</span>   <span class="status {{$milestone->color or ''}}">&bull;</span> <span style="color: #566787;">{{$milestone->state or ''}}</span>
                                </div>
                            </div>
                        </div>


            @endforeach
                <div class="col-md-12 text-center pt-4">
                    <a style="color: #7f7f7f" href="/freelancer/plans/payment-plan/{{$project->hash}}">Show Payment Plan</a>
                </div>
        </div>
    </div>
@endif
@endif