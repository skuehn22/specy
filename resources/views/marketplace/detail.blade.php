<!DOCTYPE html>
<html>  
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="index, follow">
        <title>Marketplace - General Marketplace</title>
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:regular,700,600&amp;latin" type="text/css" />
        <!-- Essential styles -->
        <link rel="stylesheet" href="{{ asset('assets_marketplace/bootstrap/css/bootstrap.min.css') }} " type="text/css">
        <link rel="stylesheet" href="{{ asset('assets_marketplace/plugins/font-awesome/css/font-awesome.css') }}" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

        <!-- Favicon -->
        <link href="{{ asset('assets_marketplace/img/favicon.png') }}" rel="icon" type="image/png">

        <!-- Assets -->
        <link rel="stylesheet" href="{{ asset('assets_marketplace/plugins/owl-carousel/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('assets_marketplace/plugins/owl-carousel/owl.theme.css') }}">

        <!-- JS Library -->
        <script src="{{ asset('assets_marketplace/js/jquery.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" >
        <!-- Dlapak styles -->
        <link id="theme_style" type="text/css" href="{{ asset('assets_marketplace/css/style1.css') }}" rel="stylesheet" media="screen">


        <style>
            /* CSS used here will be applied after bootstrap.css */

            body{ margin-top:50px;}
            .nav-tabs .glyphicon:not(.no-margin) { margin-right:10px; }
            .tab-pane .list-group-item:first-child {border-top-right-radius: 0px;border-top-left-radius: 0px;}
            .tab-pane .list-group-item:last-child {border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;}
            .tab-pane .list-group .checkbox { display: inline-block;margin: 0px; }
            .tab-pane .list-group input[type="checkbox"]{ margin-top: 2px; }
            .tab-pane .list-group .glyphicon { margin-right:5px; }
            .tab-pane .list-group .glyphicon:hover { color:#FFBC00; }
            a.list-group-item.read { color: #222;background-color: #F3F3F3; }
            hr { margin-top: 5px;margin-bottom: 10px; }
            .nav-pills>li>a {padding: 5px 10px;}

            .ad { padding: 5px;background: #F5F5F5;color: #222;font-size: 80%;border: 1px solid #E5E5E5; }
            .ad a.title {color: #15C;text-decoration: none;font-weight: bold;font-size: 110%;}
            .ad a.url {color: #093;text-decoration: none;}
            h2 {color: #000;}
            .ui-dialog {
                z-index:4000;
            }

            .ui-widget-header {
                border: 1px solid #00e782;
                background: #00e782;
                color: #333333;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <header  class="navbar navbar-default navbar-fixed-top navbar-top">
                <div class="container">
                    <div class="navbar-header">
                        <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="index.blade.php" class="navbar-brand"><span class="logo"><i class="fa fa-recycle"></i> Marketplace</span></a>
                    </div>

                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="new-ads"><a href="account_create_post.html" class="btn btn-ads btn-block">Advertise</a></li>
                            <li><a href="signup.html">Sign up</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown"><strong class="caret"></strong>&nbsp;Pages</a>
                                <ul class="dropdown-menu">
                                    <li><a href="account_posts.html">My Ads</a></li>
                                    <li><a href="account_create_post.html">Create Ads</a></li>
                                    <li><a href="account_profile.html">My Profile</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-user"></i> <strong class="caret"></strong>&nbsp;</a>
                                <div class="dropdown-menu dropdown-login" style="padding:15px;min-width:250px">
                                    <form>                       
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon addon-login"><i class="fa fa-user"></i></span>
                                                <input type="text" placeholder="Username or email" required="required" class="form-control input-login">                                            
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon addon-login"><i class="addon fa fa-lock"></i></span>
                                                <input type="password" placeholder="Password" required="required" class="form-control input-login">                                            
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label class="string optional" for="user_remember_me">
                                                    <input type="checkbox" id="user_remember_me" style="">
                                                    Remember me
                                                </label>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-custom btn-block" value="Sign In">
                                        <a href="forgot_password.html" class="btn-block text-center">Forgot password?</a>
                                    </form>                                    
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </header>
            <section class="main">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="breadcrumb pull-left">
                                <li><a href="index.blade.php">Home</a></li>
                                <li><a href="/marketplace/categories">Category</a></li>
                                <li>Detail Product</li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 col-sm-8">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="post">
                                        <div class="post-price">
                                            $ 1200.00
                                        </div>
                                        <div class="post-title">
                                            <h2>2 rooms to paint</h2>
                                        </div>
                                        <div class="post-meta">
                                            <ul>
                                                <li><i class="fa fa-clock-o"></i> 2 minutes ago</li>
                                                <li><i class="fa fa-bars"></i> <a href="/marketplace/categories">Home</a>,<a href="/marketplace/categories">Painter</a></li>
                                                <li><i class="fa fa-map-marker"></i> <a href="/marketplace/categories">Main Street</a></li>
                                                <li><i class="fa fa-bookmark"></i> Project</li>
                                            </ul>
                                        </div>
                                        <div  >

                                                    <img alt="" class="img-detail" src="/assets_marketplace/img/products/item-1.jpg" />


                                        </div>
                                        <div class="post-body">
                                            <h4><strong>Spesification</strong></h4>
                                            <ul>
                                                <li>3 Rooms</li>
                                                <li>Budget</li>
                                                <li>Materials</li>
                                                <li>3 Weeks</li>
                                                <li>Freelancer only</li>
                                            </ul>
                                            <p>
                                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                                            </p>
                                            <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur 
                                            </p>
                                        </div>
                                        <div class="post-footer">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <button class="btn btn-warning" data-target="#sendMessageModal" data-toggle="modal"><i class="fa fa-envelope"></i> <span class="hidden-xs hidden-sm">Send Message</span></button>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="item-action pull-right">
                                                        <ul>
                                                            <li><a href="#" data-toggle="tooltip" data-placement="top" title="Save Favorite" class="btn btn-success btn"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="#" data-toggle="tooltip" data-placement="top" title="Show Details" class="btn btn-info btn"><i class="fa fa-share-alt"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-header">
                                        <h2>More From John Doe</h2>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="item-ads-grid">
                                                <div class="item-badge-grid featured-ads">
                                                    <a href="#">Featured Ads</a>
                                                </div>
                                                <div class="item-img-grid">
                                                    <img alt="" src="/assets_marketplace/img/products/product-1.jpg" class="img-responsive img-center">
                                                </div>
                                                <div class="item-title">
                                                    <a href="/marketplace/detail"><h4>Lenovo A326 Black 4GB RAM</h4></a>
                                                </div>
                                                <div class="item-meta">
                                                    <ul>
                                                        <li class="item-date"><i class="fa fa-clock-o"></i> Today 10.35 am</li>
                                                        <li class="item-cat"><i class="fa fa-bars"></i> <a href="/marketplace/categories">Electronics</a> , <a href="/marketplace/categories">Smartphone</a></li>
                                                        <li class="item-location"><a href="/marketplace/categories"><i class="fa fa-map-marker"></i> Manchester</a></li>
                                                        <li class="item-type"><i class="fa fa-bookmark"></i> New</li>
                                                    </ul>
                                                </div>
                                                <div class="product-footer">
                                                    <div class="item-price-grid pull-left">
                                                        <h3>$ 100</h3>
                                                        <span>Negotiable</span>
                                                    </div>
                                                    <div class="item-action-grid pull-right">
                                                        <ul>
                                                            <li><a href="#" data-toggle="tooltip" data-placement="top" title="Save Favorite" class="btn btn-default btn-sm"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="/marketplace/detail" data-toggle="tooltip" data-placement="top" title="Show Details" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="item-ads-grid highlight-ads">
                                                <div class="item-badge-grid hot-ads">
                                                    <a href="#">Featured Ads</a>
                                                </div>
                                                <div class="item-img-grid">
                                                    <img alt="" src="/assets_marketplace/img/products/product-2.jpg" class="img-responsive img-center">
                                                </div>
                                                <div class="item-title">
                                                    <a href="/marketplace/detail"><h4>Samsung Galaxy Grand Prime 530 8GB Grey</h4></a>
                                                </div>
                                                <div class="item-meta">
                                                    <ul>
                                                        <li class="item-date"><i class="fa fa-clock-o"></i> Today 10.35 am</li>
                                                        <li class="item-cat"><i class="fa fa-bars"></i> <a href="/marketplace/categories">Electronics</a> , <a href="/marketplace/categories">Smartphone</a></li>
                                                        <li class="item-location"><a href="/marketplace/categories"><i class="fa fa-map-marker"></i> Manchester</a></li>
                                                        <li class="item-type"><i class="fa fa-bookmark"></i> New</li>
                                                    </ul>
                                                </div>
                                                <div class="product-footer">
                                                    <div class="item-price-grid pull-left">
                                                        <h3>$ 100</h3>
                                                        <span>Negotiable</span>
                                                    </div>
                                                    <div class="item-action-grid pull-right">
                                                        <ul>
                                                            <li><a href="#" data-toggle="tooltip" data-placement="top" title="Save Favorite" class="btn btn-default btn-sm"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="/marketplace/detail" data-toggle="tooltip" data-placement="top" title="Show Details" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="item-ads-grid">
                                                <div class="item-badge-grid premium-ads">
                                                    <a href="#">Featured Ads</a>
                                                </div>
                                                <div class="item-img-grid">
                                                    <img alt="" src="/assets_marketplace/img/products/product-6.jpg" class="img-responsive img-center">
                                                </div>
                                                <div class="item-title">
                                                    <a href="/marketplace/detail"><h4>Samsung Tab 3 V 116</h4></a>
                                                </div>
                                                <div class="item-meta">
                                                    <ul>
                                                        <li class="item-date"><i class="fa fa-clock-o"></i> Today 10.35 am</li>
                                                        <li class="item-cat"><i class="fa fa-bars"></i> <a href="/marketplace/categories">Electronics</a> , <a href="/marketplace/categories">Smartphone</a></li>
                                                        <li class="item-location"><a href="/marketplace/categories"><i class="fa fa-map-marker"></i> Manchester</a></li>
                                                        <li class="item-type"><i class="fa fa-bookmark"></i> New</li>
                                                    </ul>
                                                </div>
                                                <div class="product-footer">
                                                    <div class="item-price-grid pull-left">
                                                        <h3>$ 100</h3>
                                                        <span>Negotiable</span>
                                                    </div>
                                                    <div class="item-action-grid pull-right">
                                                        <ul>
                                                            <li><a href="#" data-toggle="tooltip" data-placement="top" title="Save Favorite" class="btn btn-default btn-sm"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="/marketplace/detail" data-toggle="tooltip" data-placement="top" title="Show Details" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="widget">
                                <div class="widget-header">
                                    <h3>Seller</h3>
                                </div>
                                <div class="widget-body text-center">
                                    <img alt="avatar" src="/assets_marketplace/img/people/gie.jpg" class="seller-avatar img-responsive">
                                    <h2 class="seller-name">John Doe</h2>
                                    <p class="seller-detail">Location: <strong>Dublin</strong><br/>
                                        Joined : <strong>21 June 2018</strong></p>
                                </div>
                                <div class="widget-footer">
                                    <div class="row">
                                        <div class="col-sm-12" style="text-align: center;">
                                            <a href="#">
                                                <button class="btn btn-warning btn-block modal-btn" data-toggle="modal"  id="contract-types" data-target="#exampleModalCenter"><i class="fa fa-envelope"></i> Send Offer</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget" style="border: 1px solid #f0ad4e;">
                                <div class="widget-header" style="border-bottom: 0px; padding-bottom: 0px; text-align: center;">
                                    <span>Bookmark Project <input type="checkbox" class="form-check-input" id="exampleCheck1"></span>
                                </div>
                            </div>
                            <div class="widget">
                                <div class="widget-header">
                                    <h3>Browse by Category</h3>
                                </div>
                                <div class="widget-body">
                                    <ul class="trends">
                                        <li><a href="#">Home &nbsp;<span class="item-numbers">(2,342)</span></a></li>
                                        <li><a href="#">Music &nbsp;<span class="item-numbers">(2,342)</span></a></li>
                                        <li><a href="#">Car &nbsp;<span class="item-numbers">(2,342)</span></a></li>
                                        <li><a href="#">Wedding &nbsp;<span class="item-numbers">(2,342)</span></a></li>
                                        <li><a href="#">Accounting &nbsp;<span class="item-numbers">(2,342)</span></a></li>
                                        <li><a href="#">Law &nbsp;<span class="item-numbers">(2,342)</span></a></li>
                                        <li><a href="#">Photography &nbsp;<span class="item-numbers">(242)</span></a></li>
                                        <li><a href="#">Web Development &nbsp;<span class="item-numbers">(2,342)</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget">
                                <div class="widget-header">
                                    <h3>Browse by City</h3>
                                </div>
                                <div class="widget-body">
                                    <ul class="brands">
                                        <li><label><input type="checkbox"> Dublin</label></li>
                                        <li><label><input type="checkbox"> Cork</label></li>
                                        <li><label><input type="checkbox"> Kerry</label></li>
                                        <li><label><input type="checkbox"> Waterford</label></li>
                                        <li><label><input type="checkbox"> Wexford</label></li>
                                        <li><label><input type="checkbox"> Galway</label></li>
                                        <li><label><input type="checkbox"> Limerick</label></li>
                                    </ul>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="footer">
                <div class="container">
                <ul class="pull-left footer-menu">
                    <li>
                        <a href="index.blade.php"> Home </a>
                        <a href="about.html"> About us </a>
                        <a href="contact.html"> Contact us </a>
                    </li>
                </ul>
                <ul class="pull-right footer-menu">
                    <li> &copy; 2018 Marketplace </li>
                </ul>
                </div>
            </div>
        </div>

        <!-- Send Message Modal -->
        <div aria-labelledby="sendMessageModalLabel" role="dialog" tabindex="-1" id="sendMessageModal" class="modal fade in">
            <div role="document" class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                        <h4 id="sendMessageModalLabel" class="modal-title">Send Message to Seller</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label class="control-label">Name:</label>
                                <input type="text" class="form-control input-lg" placeholder="Your name" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Email:</label>
                                <input type="email" class="form-control input-lg" placeholder="Your email" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="message-text">Message:</label>
                                <textarea id="message-text" class="form-control input-lg" placeholder="Your message" required></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                        <button class="btn btn-custom" type="button"><i class="fa fa-paper-plane"></i> Send</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Message Modal -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        What do you need?
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal-body">

                    </div>
                    <!--
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                    -->
                </div>
            </div>
        </div>

        <div id="dialog" title="Caution">
            <p>Your description seems to be very short. Please describe exactly what your offer includes.</p><p> An exact description will prevent later misunderstandings. </p>
        </div>

        <div id="send-offer-dialog" title="Proposal sent!">
            <p>Your offer has been sent to John Doe.</p>
        </div>

        <!-- Essentials -->
        <script src="/assets_marketplace/bootstrap/js/bootstrap.min.js"></script>
        <script src="/assets_marketplace/plugins/owl-carousel/owl.carousel.js"></script>
        <script src="/assets_marketplace/plugins/counter/jquery.countTo.js"></script>
        <script src="/assets_marketplace/plugins/flexslider/jquery.flexslider.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript">

            $(document).ready(function () {

                loadScripts();
                $('#dialog').dialog();
                $('#dialog').dialog('close');
                $('#send-offer-dialog').dialog();
                $('#send-offer-dialog').dialog('close');
                // ==========tooltip initial=================
                $('[data-toggle="tooltip"]').tooltip();
            });


            function loadScripts(){

                $("#paymenttyp").on("change", function() {



                    var id = $(this).val();

                    if(id == 2){
                        $(".milestonepay").show();
                    }else{
                        $(".milestonepay").hide();
                    }
                });

                $(".add-row").click(function(){
                    var name = $("#name").val();
                    var percentages = $("#percentages").val();
                    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + name + "</td><td>" + percentages + " %</td><td style='text-align:right;'>550.00 €</td></tr><tr><td colspan='3'><hr></td></tr>";
                    $("table tbody").append(markup);
                    $('.create-offer').removeAttr("disabled")
                });

                $(".create-offer").click(function(){
                    $('.send-offer').removeAttr("disabled");
                    $('.create-offer').addClass("disabled");
                });

                $(".send-offer").click(function(){
                    $('#send-offer-dialog').dialog('open');
                });


                // Find and remove selected table rows
                $(".delete-row").click(function(){
                    $("table tbody").find('input[name="record"]').each(function(){
                        if($(this).is(":checked")){
                            $(this).parents("tr").remove();
                        }
                    });
                });

                $("#desc").focusout(function () {

                    $('#dialog').dialog('open');

                });

                //loads content for shortcuts
                $(".modal-btn").click(function() {
                    getModalContent($(this).attr('id'));
                });

                //loads content for shortcuts
                $(".load-modul").click(function() {

                    url=$(this).attr('id');

                    data = {};

                    obj = {
                        "client": "1",
                        "expiresdate": $("#expires-date").val(),
                        "dateproposal": $("#date-proposal").val()
                    };

                    data["proposal"] = JSON.stringify(obj);
                    action(url, data);

                });

                $( ".date_proposal" ).datepicker({
                    required: true,
                    minDate: +7,
                    numberOfMonths: 1,
                    clearText: 'delete', clearStatus: 'delete current date',
                    closeText: 'close', closeStatus: 'close without changes',
                    prevText: 'back', prevStatus: 'show last month',
                    nextText: 'forward', nextStatus: 'show next month',
                    currentText: 'today', currentStatus: '',
                    monthNames: ['January','February','March','April','May','June','July','August','September','October','November','December'],
                    monthNamesShort: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                    monthStatus: 'show other month', yearStatus: 'show other year',
                    weekHeader: 'We', weekStatus: 'Week of the month',
                    dayNames: ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
                    dayNamesShort: ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'],
                    dayNamesMin: ['Su','Mo','Tu','We','Th','Fr','Sa'],
                    dayStatus: 'Set DD as first Weekday', dateStatus: 'Choose D, M d',
                    dateFormat: 'dd.mm.yy', firstDay: 1,
                    initStatus: 'Select a date', isRTL: false,
                    onClose: function( selectedDate ) {
                        if(selectedDate!=null && selectedDate!=""){
                            var current_date = $.datepicker.parseDate('dd.mm.yy', selectedDate);
                            current_date.setDate(current_date.getDate()+1);
                            $( ".expires_date" ).datepicker( "show", "option", "minDate", current_date );
                        }
                    }
                });

                $( ".expires_date" ).datepicker({
                    required: true,
                    numberOfMonths: 1,
                    clearText: 'delete', clearStatus: 'delete current date',
                    closeText: 'close', closeStatus: 'close without changes',
                    prevText: 'back', prevStatus: 'show last month',
                    nextText: 'forward', nextStatus: 'show next month',
                    currentText: 'today', currentStatus: '',
                    monthNames: ['January','February','March','April','May','June',
                        'July','August','September','October','November','December'],
                    monthNamesShort: ['Jan','Feb','Mar','Apr','May','Jun',
                        'Jul','Aug','Sep','Oct','Nov','Dec'],
                    monthStatus: 'show other month', yearStatus: 'show other year',
                    weekHeader: 'We', weekStatus: 'Week of the month',
                    dayNames: ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
                    dayNamesShort: ['Su','Mo','Tu','Wed','Thu','Fri','Sat'],
                    dayNamesMin: ['Su','Mo','Tu','We','Th','Fr','Sa'],
                    dayStatus: 'Set DD as first Weekday', dateStatus: 'Wähle D, M d',
                    dateFormat: 'dd.mm.yy', firstDay: 1,
                    minDate: 0+1,
                    initStatus: 'Select a date', isRTL: false,
                    onClose: function( selectedDate ) {
                        if(selectedDate!=null && selectedDate!=""){
                            var current_date = $.datepicker.parseDate('dd.mm.yy', selectedDate);
                            current_date.setDate(current_date.getDate()-1);
                            $( ".expires_date" ).datepicker( "option", "minDate", current_date);
                            $( ".expires_date" ).datepicker( "show");
                        }
                    }
                });


            }

            function action(url, data){

                //alert($url);

                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }

                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("modal-body").innerHTML = xmlhttp.responseText;
                        loadScripts();
                    }
                };


                urlAddress = "{{env("MYHTTP")}}/{{$blade['locale']}}/provider/" + url;


                if(data != null && Object.keys(data).length > 0) {

                    urlAddress += "?";

                    for (var k in data) {
                        urlAddress += k + "=" + data[k] + "&";
                    }

                    urlAddress = urlAddress.slice(0, -1);

                }

                xmlhttp.open("GET", urlAddress, true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send();

            }


            function getModalContent($url){

                //alert($url);

                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }

                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("modal-body").innerHTML = xmlhttp.responseText;
                        loadScripts();
                    }
                }
                xmlhttp.open("GET","{{env("MYHTTP")}}/{{$blade['locale']}}/provider/"+ $url, true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send();

            }



        </script>

    </body>
</html> 