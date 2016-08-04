$(document).ready(function($) {
    "use strict";
	  /* === jQuery for page scrolling plugin === */

 /* ======= Navbar for Desktop and Mobile Devices ======= */
    (function () {

        var navbar      = $('.navbar-custom'),
            width       = Math.max($(window).width(), window.innerWidth),
            mobileTest;

        if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            mobileTest = true;
        }

        navbarSubmenu(width);
        // hoverDropdown(width, mobileTest);

        // $(window).resize(function() {
        //     var width = Math.max($(window).width(), window.innerWidth);
        //     hoverDropdown(width, mobileTest);
        // });

        /* ---------------------------------------------- /*
         * Navbar submenu
        /* ---------------------------------------------- */

        function navbarSubmenu(width) {
            if (width > 767) {
                $('.navbar-custom .navbar-nav > li.dropdown').hover(function() {
                    var MenuLeftOffset  = $('.dropdown-menu', $(this)).offset().left;
                    var Menu1LevelWidth = $('.dropdown-menu', $(this)).width();
                    // if (width - MenuLeftOffset > Menu1LevelWidth * 2) {
                    //     $(this).children('.dropdown-menu').css( {'right': 'auto', 'left': '0'});
                    // } else {
                    //     $(this).children('.dropdown-menu').css( {'right': '0', 'left': 'auto'});
                    // }
                    if ($('.dropdown', $(this)).length > 0) {
                        var Menu2LevelWidth = $('.dropdown-menu', $(this)).width();
                        if (width - MenuLeftOffset - Menu1LevelWidth < Menu2LevelWidth) {
                            $(this).children('.dropdown-menu').addClass('left-side');
                        } else {
                            $(this).children('.dropdown-menu').removeClass('left-side');
                        }
                    }
                });
            }
        }


        /* ---------------------------------------------- /*
         * Navbar hover dropdown on desktop
        /* ---------------------------------------------- */

        // function hoverDropdown(width, mobileTest) {
        //     if ((width > 767) && (mobileTest !== true)) {
        //         $('.navbar-custom .navbar-nav > li.dropdown, .navbar-custom li.dropdown > ul > li.dropdown').removeClass('open');
        //         var delay = 0;
        //         var setTimeoutConst;
        //         $('.navbar-custom .navbar-nav > li.dropdown, .navbar-custom li.dropdown > ul > li.dropdown').hover(function() {
        //             var $this = $(this);
        //             setTimeoutConst = setTimeout(function() {
        //                 $this.addClass('open');
        //                 $this.find('.dropdown-toggle').addClass('disabled');
        //             }, delay);
        //         },
        //         function() {
        //             clearTimeout(setTimeoutConst);
        //             $(this).removeClass('open');
        //             $(this).find('.dropdown-toggle').removeClass('disabled');
        //         });
        //     } else {
        //         $('.navbar-custom .navbar-nav > li.dropdown, .navbar-custom li.dropdown > ul > li.dropdown').unbind('mouseenter mouseleave');
        //         $('.navbar-custom [data-toggle=dropdown]').not('.binded').addClass('binded').on('click', function(event) {
        //             event.preventDefault();
        //             event.stopPropagation();
        //             $(this).parent().siblings().removeClass('open');
        //             $(this).parent().siblings().find('[data-toggle=dropdown]').parent().removeClass('open');
        //             $(this).parent().toggleClass('open');
        //         });
        //     }
        // }

        /* ---------------------------------------------- /*
         * Navbar collapse on click
        /* ---------------------------------------------- */

        $(document).on('click','.navbar-collapse.in',function(e) {
            if( $(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle' ) {
                $(this).collapse('hide');
            }
        });

    }());
	
	/* === Youtube Video Script === */
    if ($('.player').length > 0) {

        jQuery(".player").mb_YTPlayer();
        
    }

 	/* ======= Parallax  ======= */
        //
        // $.stellar({
        //     responsive: true,
        //     horizontalScrolling: false,
        //     verticalOffset: 0
        // });


	/* ======= Counter  ======= */
        // function countUp() {
        //     var dataperc;
        //     $('.statistic-percent').each(function(){
        //         dataperc = $(this).attr('data-perc'),
        //         $(this).find('.percentfactor').delay(6000).countTo({
        //             from: 0,                 // number to begin counting
        //             to: dataperc,
        //             speed: 1000,             // ms
        //             refreshInterval: 10,
        //         });
        //     });
        // }
        // $('.statistic-percent').waypoint(function() {
        //     countUp();
        // },
        // {
        //     offset: '95%',
        //     triggerOnce: true
        // });


    $(window).load(function(){
  /* === magnificPopup === */
    // $('.tt-lightbox').magnificPopup({
    //     type: 'image',
    //     mainClass: 'mfp-fade',
    //     removalDelay: 160,
    //     fixedContentPos: false
    //     // other options
    // });
 /* ======= shuffle js ======= */
    if ($('#portfolio-grid').length > 0) {
        /* initialize shuffle plugin */
        var $grid = $('#portfolio-grid');

        $grid.shuffle({
            itemSelector: '.portfolio-item' // the selector for the items in the grid
        });

        /* reshuffle when user clicks a filter item */
        $('#filter li').on('click', function (e) {
            e.preventDefault();

            // set active class
            $('#filter li').removeClass('active');
            $(this).addClass('active');

            // get group name from clicked item
            var groupName = $(this).attr('data-group');

            // reshuffle grid
            $grid.shuffle('shuffle', groupName );
        });
    }
	
	});

});
