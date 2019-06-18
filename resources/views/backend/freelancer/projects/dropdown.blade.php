
<div class="form-group">
    <div class="form-inline">
    <label class="col-md-2 col-form-label" for="projects-dropdown">Projects</label>

    @if(count($projects)>0)

        @if(count($projects) == 1)
            <select name="projects-dropdown" id="projects-dropdown" class="col-md-3">
                @foreach($projects as $project)
                    <option value="{{$project->id}}">{{$project->name}}</option>
                @endforeach
            </select>
        @else
            <select name="projects-dropdown" id="projects-dropdown" class="col-md-3" required>
                <option></option>
                @foreach($projects as $project)
                    <option value="{{$project->id}}">{{$project->name}}</option>
                @endforeach
            </select>
            <div class="help-block with-errors"></div>
        @endif
    @else
        <div class="pt-2">
            No projects for this client yet. <a href="/{{$blade["ll"]}}/freelancer/projects/new">Create Project</a>
        </div>
    @endif

    </div>
</div>