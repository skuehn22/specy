jQuery(document).ready(function(){var mainContent=$('.cd-main-content'),header=$('.cd-main-header'),sidebar=$('.cd-side-nav'),sidebarTrigger=$('.cd-nav-trigger'),topNavigation=$('.cd-top-nav'),searchForm=$('.cd-search'),accountInfo=$('.account');var resizing=false;moveNavigation();$(window).on('resize',function(){if(!resizing){(!window.requestAnimationFrame)?setTimeout(moveNavigation,300):window.requestAnimationFrame(moveNavigation);resizing=true;}});var scrolling=false;checkScrollbarPosition();$(window).on('scroll',function(){if(!scrolling){(!window.requestAnimationFrame)?setTimeout(checkScrollbarPosition,300):window.requestAnimationFrame(checkScrollbarPosition);scrolling=true;}});sidebarTrigger.on('click',function(event){event.preventDefault();$([sidebar,sidebarTrigger]).toggleClass('nav-is-visible');});$('.has-children > a').on('click',function(event){var mq=checkMQ(),selectedItem=$(this);if(mq=='mobile'||mq=='tablet'){event.preventDefault();if(selectedItem.parent('li').hasClass('selected')){selectedItem.parent('li').removeClass('selected');}else{sidebar.find('.has-children.selected').removeClass('selected');accountInfo.removeClass('selected');selectedItem.parent('li').addClass('selected');}}});accountInfo.children('a').on('click',function(event){var mq=checkMQ(),selectedItem=$(this);if(mq=='desktop'){event.preventDefault();accountInfo.toggleClass('selected');sidebar.find('.has-children.selected').removeClass('selected');}});$(document).on('click',function(event){if(!$(event.target).is('.has-children a')){sidebar.find('.has-children.selected').removeClass('selected');accountInfo.removeClass('selected');}});sidebar.children('ul').menuAim({activate:function(row){$(row).addClass('hover');},deactivate:function(row){$(row).removeClass('hover');},exitMenu:function(){sidebar.find('.hover').removeClass('hover');return true;},submenuSelector:".has-children",});function checkMQ(){return window.getComputedStyle(document.querySelector('.cd-main-content'),'::before').getPropertyValue('content').replace(/'/g,"").replace(/"/g,"");}
    function moveNavigation(){var mq=checkMQ();if(mq=='mobile'&&topNavigation.parents('.cd-side-nav').length==0){detachElements();topNavigation.appendTo(sidebar);searchForm.removeClass('is-hidden').prependTo(sidebar);}else if((mq=='tablet'||mq=='desktop')&&topNavigation.parents('.cd-side-nav').length>0){detachElements();searchForm.insertAfter(header.find('.cd-logo'));topNavigation.appendTo(header.find('.cd-nav'));}
        checkSelected(mq);resizing=false;}
    function detachElements(){topNavigation.detach();searchForm.detach();}
    function checkSelected(mq){if(mq=='desktop')$('.has-children.selected').removeClass('selected');}
    function checkScrollbarPosition(){var mq=checkMQ();if(mq!='mobile'){var sidebarHeight=sidebar.outerHeight(),windowHeight=$(window).height(),mainContentHeight=mainContent.outerHeight(),scrollTop=$(window).scrollTop();((scrollTop+windowHeight>sidebarHeight)&&(mainContentHeight-sidebarHeight!=0))?sidebar.addClass('is-fixed').css('bottom',0):sidebar.removeClass('is-fixed').attr('style','');}
        scrolling=false;}});


jQuery(document).ready(function($){
    //check if a .cd-tour-wrapper exists in the DOM - if yes, initialize it
    $('.cd-tour-wrapper').exists() && initTour();

    function initTour() {
        var tourWrapper = $('.cd-tour-wrapper'),
            tourSteps = tourWrapper.children('li'),
            stepsNumber = tourSteps.length,
            coverLayer = $('.cd-cover-layer'),
            tourStepInfo = $('.cd-more-info'),
            tourTrigger = $('#cd-tour-trigger');

        //create the navigation for each step of the tour
        createNavigation(tourSteps, stepsNumber);

        tourTrigger.on('click', function(){
            //start tour
            if(!tourWrapper.hasClass('active')) {
                //in that case, the tour has not been started yet
                tourWrapper.addClass('active');
                showStep(tourSteps.eq(0), coverLayer);
            }
        });

        //change visible step
        tourStepInfo.on('click', '.cd-prev', function(event){
            //go to prev step - if available
            ( !$(event.target).hasClass('inactive') ) && changeStep(tourSteps, coverLayer, 'prev');
        });
        tourStepInfo.on('click', '.cd-next', function(event){
            //go to next step - if available
            ( !$(event.target).hasClass('inactive') ) && changeStep(tourSteps, coverLayer, 'next');
        });

        //close tour
        tourStepInfo.on('click', '.cd-close', function(event){
            closeTour(tourSteps, tourWrapper, coverLayer);
        });

        //detect swipe event on mobile - change visible step
        tourStepInfo.on('swiperight', function(event){
            //go to prev step - if available
            if( !$(this).find('.cd-prev').hasClass('inactive') && viewportSize() == 'mobile' ) changeStep(tourSteps, coverLayer, 'prev');
        });
        tourStepInfo.on('swipeleft', function(event){
            //go to next step - if available
            if( !$(this).find('.cd-next').hasClass('inactive') && viewportSize() == 'mobile' ) changeStep(tourSteps, coverLayer, 'next');
        });

        //keyboard navigation
        $(document).keyup(function(event){
            if( event.which=='37' && !tourSteps.filter('.is-selected').find('.cd-prev').hasClass('inactive') ) {
                changeStep(tourSteps, coverLayer, 'prev');
            } else if( event.which=='39' && !tourSteps.filter('.is-selected').find('.cd-next').hasClass('inactive') ) {
                changeStep(tourSteps, coverLayer, 'next');
            } else if( event.which=='27' ) {
                closeTour(tourSteps, tourWrapper, coverLayer);
            }
        });
    }

    function createNavigation(steps, n) {
        var tourNavigationHtml = '<div class="cd-nav"><span><b class="cd-actual-step">1</b> of '+n+'</span><ul class="cd-tour-nav"><li><a href="#0" class="cd-prev">&#171; Previous</a></li><li><a href="#0" class="cd-next">Next &#187;</a></li></ul></div><a href="#0" class="cd-close">Close</a>';

        steps.each(function(index){
            var step = $(this),
                stepNumber = index + 1,
                nextClass = ( stepNumber < n ) ? '' : 'inactive',
                prevClass = ( stepNumber == 1 ) ? 'inactive' : '';
            var nav = $(tourNavigationHtml).find('.cd-next').addClass(nextClass).end().find('.cd-prev').addClass(prevClass).end().find('.cd-actual-step').html(stepNumber).end().appendTo(step.children('.cd-more-info'));
        });
    }

    function showStep(step, layer) {
        step.addClass('is-selected').removeClass('move-left');
        smoothScroll(step.children('.cd-more-info'));
        showLayer(layer);
    }

    function smoothScroll(element) {
        (element.offset().top < $(window).scrollTop()) && $('body,html').animate({'scrollTop': element.offset().top}, 100);
        (element.offset().top + element.height() > $(window).scrollTop() + $(window).height() ) && $('body,html').animate({'scrollTop': element.offset().top + element.height() - $(window).height()}, 100);
    }

    function showLayer(layer) {
        layer.addClass('is-visible').on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(){
            layer.removeClass('is-visible');
        });
    }

    function changeStep(steps, layer, bool) {
        var visibleStep = steps.filter('.is-selected'),
            delay = (viewportSize() == 'desktop') ? 300: 0;
        visibleStep.removeClass('is-selected');

        (bool == 'next') && visibleStep.addClass('move-left');

        setTimeout(function(){
            ( bool == 'next' )
                ? showStep(visibleStep.next(), layer)
                : showStep(visibleStep.prev(), layer);
        }, delay);
    }

    function closeTour(steps, wrapper, layer) {
        steps.removeClass('is-selected move-left');
        wrapper.removeClass('active');
        layer.removeClass('is-visible');
    }

    function viewportSize() {
        /* retrieve the content value of .cd-main::before to check the actua mq */
        return window.getComputedStyle(document.querySelector('.cd-tour-wrapper'), '::before').getPropertyValue('content').replace(/"/g, "").replace(/'/g, "");
    }
});

//check if an element exists in the DOM
jQuery.fn.exists = function(){ return this.length > 0; }