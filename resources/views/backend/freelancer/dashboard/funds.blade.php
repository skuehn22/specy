<div class="row">


    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="materialbox materialbox-funds mb-4">
            <div class="card-body ">
                @if(count($plans)>0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="progress yellow">
                            <span class="progress-left">
                                <span class="progress-bar"></span>
                            </span>
                                    <span class="progress-right">
                                <span class="progress-bar" style="margin-left: -1px;"></span>
                            </span>
                            <div class="progress-value">{{ number_format($funds['pending'], 2) }} €</div>
                        </div>
                    </div>
                </div>
                <div class="row pending">
                    <div class="col-md-12 text-center pt-3">
                        <i class="fas fa-hourglass-end"></i> <span class="headline" style="color: ##fdcc52fdcc52;">Pending</span>
                    </div>
                </div>
                @else
                    No Payment Plans yet.
                @endif
            </div>
            <!--
            <div class="card-footer ">

               <div class="row">
                   <div class="col-md-6">
                       <a href="#">Last 7 Days</a>
                   </div>
                   <div class="col-md-6 text-right">
                       <a href="/freelancer/plans">Details</a>
                   </div>
               </div>
            </div>
            -->
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="materialbox materialbox-funds mb-4">
            <div class="card-body ">
                @if(count($plans)>0)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="progress green">
                            <span class="progress-left">
                                <span class="progress-bar"></span>
                            </span>
                                <span class="progress-right">
                                <span class="progress-bar"  style="margin-left: -1px;"></span>
                            </span>
                                <div class="progress-value"> {{ number_format($funds['funded'], 2) }} €</div>
                            </div>
                        </div>
                    </div>
                    <div class="row funded">
                        <div class="col-md-12 text-center pt-3">
                            <i class="fas fa-lock funded"></i> <span class="headline text-success">Funded</span>
                        </div>
                    </div>
                @else
                    No Payment Plans yet.
                @endif
            </div>
            <!--
            <div class="card-footer ">
                <div class="row">
                    <div class="col-md-6">
                        <a href="#">Last 7 Days</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="/freelancer/plans">Details</a>
                    </div>
                </div>
            </div>
            -->
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="materialbox materialbox-funds mb-4">
            <div class="card-body ">
                @if(count($plans)>0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="progress blue">
                            <span class="progress-left">
                                <span class="progress-bar"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar" style="margin-left: -1px;"></span>
                            </span>
                            <div class="progress-value">{{ number_format($funds['released'], 2) }} €</div>
                        </div>
                    </div>
                </div>
                <div class="row released">
                    <div class="col-md-12 text-center pt-3">
                        <i class="fas fa-dollar-sign"></i> <span class="headline" style="color: #19a3b8;">Released</span>
                    </div>
                </div>
                @else
                    No Payment Plans yet.
                @endif
            </div>
            <!--
            <div class="card-footer ">

                <div class="row">
                    <div class="col-md-6">
                        <a href="#">Last Month</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="/freelancer/plans">Details</a>
                    </div>
                </div>

            </div>
            -->
        </div>
    </div>

</div>