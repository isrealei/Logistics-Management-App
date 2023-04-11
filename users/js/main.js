(function(){
        "use strict";
        var windowWidth = $(window).width();
        var windowHeight =  $(window).height();

        // magicline
        function magicLinePositionChangeMainmenu() {
            $magicLineMainMenu.stop().animate({
                left: $magicLineMainMenu.data("origLeft"),
                width: $magicLineMainMenu.data("origWidth")
            });
        }
        function magicLinePositionChangeSubmenu() {
            $magicLineSubMenu.stop().animate({
                top: $magicLineSubMenu.data("origTop"),
                height: $magicLineSubMenu.data("origHeight")
            });
        }

        if (windowWidth >= 768){
            var $el, leftPos, newWidth,topPos,newHeight;

            if($('.navbar-nav').hasClass('magic_menu')){
                /* Add Magic Line markup via JavaScript, because it ain't gonna work without */
                $(".navbar-nav").append("<li class='magic-line'></li>");

                /* Cache it */
                var $magicLineMainMenu = $(".navbar-nav>.magic-line,.navbar-nav>.magic-line2");
                var $magicLineSubMenu = $(".drop_down_list>.magic-line,.drop_down_list>.magic-line2");

                $magicLineMainMenu
                    .stop().animate({
                        left: $(".navbar-nav .active").position().left + 20,
                        width: $(".navbar-nav .active").width() - 40
                    }, 100, "swing")
                    .data("origLeft", $(".navbar-nav .active").position().left + 20)
                    .data("origWidth", $(".navbar-nav .active").width() - 40);

                $(".navbar-nav>li").hover(function() {
                    $el = $(this);
                    leftPos = $el.position().left + 20;
                    newWidth = $el.width() - 40;

                    $magicLineMainMenu.stop().animate({
                        left: leftPos,
                        width: newWidth
                    });
                },magicLinePositionChangeMainmenu);

            }

        }

        /* mobile menu */
        $('.navbar-toggle').on('click',function(){
          $(this).toggleClass('open');
        });
        function mobileMenu(selector,dropdown){
            $(selector + '> a').on('click', function(){
                $(this).parent().toggleClass('open').siblings('li').removeClass('open');
                $(this).siblings(dropdown).slideToggle();
                $(dropdown).not($(this).siblings(dropdown)).slideUp();
                $('.dropdwon').not($(this).siblings('.dropdwon')).slideUp();
                $('.megamenu').not($(this).siblings('.megamenu')).slideUp();
            }).removeAttr('href');
        }
        if(windowWidth < 768){
            $('.dropdwon,.megamenu').hide();
            mobileMenu('.has_dropdown','.dropdwon');
            mobileMenu('.has_megamenu','.megamenu');
        }

        //Click event to scroll to top
      	$('.scroll_top').on('click', function(){
      		$('html, body').animate({scrollTop : 0},800);
      		return false;
      	});


        /* Login modal js*/
        $('.login_modal_wrapper').hide();
        $('.login_modal > a').on('click',function(){
            $('.login_modal_wrapper').fadeToggle(500);
        });

        /* accordion jquery */
        $('.panel-title > a').on('click',function(){
            $(this).parents('.panel-heading').toggleClass('active');
            $('.panel-heading').not($(this).parents('.panel-heading')).removeClass('active');
            $(this).children('span.fa').toggleClass('fa-minus fa-plus');
            $('.panel-title span.fa').not($(this).children('span.fa')).removeClass('fa-minus').addClass('fa-plus');
        });

        // function foe custom trigger
        function customOwlTrigger(slider){
            /* custom trigger */
            $('.prev').on('click', function() {
                slider.trigger('next.owl.carousel');
            });
            $('.next').on('click', function() {
                slider.trigger('prev.owl.carousel');
            });
        }
        /*========= all sliders js =========*/

        // hero slider
        var $heroSlider = $('.hero_sliders');

            if($heroSlider.length){
                /*camera slider*/
                var heroSliderHeight = windowHeight < 600 ? 500 : windowHeight;
                $('.hero_sliders').camera({
                    height: heroSliderHeight + 'px',
                    pagination: false,
                    thumbnails: false,
                    hover: false,
                    loader: false,
                    time: 7000,
                    playPause: false,
                    fx: 'random',
                    onEndTransition: function() {
                        $('.cameraSlide img').addClass('grow');
                    }
                });
                var cameraContent = document.querySelector('.cameraContents');
                heroSliderHeight < 600 ? cameraContent.classList.add('down') : cameraContent.classList.remove('down');
            }

        /* SERVICE  SLIDER */
        var serviceSlider =$('.service_slider');
        serviceSlider.owlCarousel({
            loop:true,
            margin: 30,
            nav: false,
            autoplay: false,
            dots: false,
            responsive:{
                0:{
                    items:1
                },
                480:{
                    items:2
                },
                768:{
                    items:3
                },
                1000:{
                    items:3
                }
            }
        });
        $('.counter').counterUp({
            delay: 100,
            time: 2000
        });

        //custom trigger for service slider
        customOwlTrigger(serviceSlider);

        /* BOG SLIDER */
        var blogSlider =$('.blog_slider');
        blogSlider.owlCarousel({
            loop:true,
            margin: 30,
            nav: false,
            autoplay: false,
            dots: false,
            responsive:{
                0:{
                    items:1
                },
                480:{
                    items:2
                },
                768:{
                    items:2
                },
                1000:{
                    items:3
                }
            }
        });

        //custom trigger for blog slider
        customOwlTrigger(blogSlider);

        $(".testimonial_slider").owlCarousel({
            loop:true,
            margin: 25,
            nav: false,
            autoplay: true,
            dots: false,
            responsive:{
                0:{
                    items:1
                },
                768:{
                    items:2,
                    margin: 50
                },
                1000:{
                    items:2
                }
            }
        });

        $(".single_item_testimonial_slider").owlCarousel({
            loop:true,
            margin: 25,
            nav: false,
            autoplay: true,
            dots: false,
            responsive:{
                0:{
                    items:1
                },
                768:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        });

        /* PARTNERS CAROUSEL*/
        $('.partner_slider').owlCarousel({
            loop:true,
            margin: 30,
            nav: false,
            autoplay: false,
            dots: false,
            responsive:{
                0:{
                    items:1
                },
                480:{
                    items:2
                },
                767:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        });

        /* RECENT POST CAROUSEL */
        var teamSlider = $('.team_slider');
        teamSlider.owlCarousel({
            loop:true,
            margin: 30,
            nav: false,
            autoplay: false,
            dots: false,
            responsive:{
                0:{
                    items:2
                },
                767:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        });

        /* venobox js */
        $('.venobox').venobox({
            numeratio: true
        });

        /* pricing table js*/
        var pricingTable = $('.single_price_table');
        pricingTable.on('mouseover',function(){
            pricingTable.removeClass('active');
        });
        pricingTable.on('mouseleave',function(){
            $('.business').addClass('active');
        });



        // Replace all SVG images with inline SVG
        $('img.svg').each(function(){
            var $img = $(this),
                imgID = $img.attr('id'),
                imgClass = $img.attr('class'),
                imgURL = $img.attr('src');

            $.get(imgURL, function(data) {
                // Get the SVG tag, ignore the rest
                var $svg = $(data).find('svg');

                // Add replaced image's ID to the new SVG
                if(typeof imgID !== 'undefined') {
                    $svg = $svg.attr('id', imgID);
                }
                // Add replaced image's classes to the new SVG
                if(typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass);
                }

                // Remove any invalid XML tags as per http://validator.w3.org
                $svg = $svg.removeAttr('xmlns:a');

                // Replace image with new SVG
                $img.replaceWith($svg);

            }, 'xml');

        });
    

        // jquery date picker
        if($.fn.datepicker){
            $('.datepicker').datepicker();
        }

        /* preloader js */
        $(window).on('load',function(){
            $('.preloader-container').fadeOut(1000);
            $('.preloader-bg').delay('500').fadeOut(1000);

            /*isotope and packery*/
            $('.portfolio_wrapper').isotope({
                layoutMode: 'packery',
                itemSelector: '.grid_item'
            });

            /*portfolio sorting*/
            $('.filter_list').on( 'click', 'li', function() {
                var filterValue = $(this).attr('data-filter');
                $('.portfolio_wrapper').isotope({ filter: filterValue });
                $(this).addClass('active');
                $('.filter_list li').not(this).removeClass('active');
            });
        });

        $(window).scroll(function(){

        });
        $('.panel-title > a').on('click',function(){
          $(this).parents('.single_acco_title').toggleClass('active');
          $('.single_acco_title').not($(this).parents('.single_acco_title')).removeClass('active');
          $(this).children('span.icofont').toggleClass('icofont-caret-down icofont-caret-up');
          $('.panel-title span.icofont').not($(this).children('span.icofont')).removeClass('icofont-caret-up').addClass('icofont-caret-down');
        });
})(jQuery)
