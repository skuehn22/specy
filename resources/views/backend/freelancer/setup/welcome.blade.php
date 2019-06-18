
<!--
    <div class="row">
        <div class="col-md-12 pl-0 pt-0 pr-0">
            <div class="alert alert-success error_message alert-welcome">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <h3>Welcome to trustfy.io</h3>
                <p>First set up your basic account.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 pl-0 pt-0 pr-0 border-content">
-->
            <!-- SmartWizard html -->
            <div id="smartwizard">
                <ul class="d-none" id="arrows">
                    <li><a href="#step-1">Step 1<br /><small>Your company details</small></a></li>
                    <li><a href="#step-2">Step 2<br /><small>Your client details</small></a></li>
                    <li><a href="#step-3">Step 3<br /><small>Create a project</small></a></li>
                    <li class="d-none"><a href="#step-4">Step 4<br /><small>Create a project</small></a></li>
                    <li class="d-none"><a href="#step-5">Step 5<br /><small>Create a project</small></a></li>

                </ul>

                <div class="">
                    <div id="step-1" class="">
                        @include('backend.freelancer.setup.start')
                    </div>
                    <div id="step-2" class="">
                        @include('backend.freelancer.setup.company')
                    </div>
                    <div id="step-3" class="">
                        @include('backend.freelancer.setup.clients')
                    </div>
                    <div id="step-4" class="">
                        @include('backend.freelancer.setup.projects')
                    </div>
                    <div id="step-5" class="">
                        @include('backend.freelancer.setup.end')
                    </div>


                </div>
            </div>


        </div>

    </div>

