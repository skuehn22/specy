<div class="materialbox materialbox-inbox">
    <div class="row inbox">
        <div class="col-md-12">
            <div class="panel panel-primary">

                <div class="panel-heading">
                    <span class="panel-title">
                        <i class="far fa-envelope"></i> {{ trans('freelancer_backend.inbox') }} </span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-md-12">
                            @include('backend.freelancer.inbox.index')
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>