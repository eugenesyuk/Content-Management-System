jQuery(function($) {
    'use strict';

    (function() {
        
        $(window).on('load', function() {
            
            /* SPINNER */
            
            $(".skm-loader").fadeOut("slow");

            /* PARALLAX */
            
            parallaxInit();
            function parallaxInit() {
                $('.slider-parallax').parallax("30%", 0.1);
            }
            
           /* TYPED INTRO */
            
            $(".typed").each(function(){
                var $this = $(this);
                $this.typed({
                    strings: $this.attr('data-elements').split(','),
                    typeSpeed: 50, // typing speed
                    backDelay: 2000, // pause before backspacing
                    startDelay: 1000,
                    callback: function() {
                        $('.fadeIn').fadeIn('slow');
                    },
                    loop: false
                });
            });
        });
    
        /* MENU */    
        
        $("#menuzord").menuzord({
            align: "right",
            scrollable: true
        });
  
        /* MAILCHIMP */   
        
        $('#mc-form').ajaxChimp({
            url: "http://themerocks.us9.list-manage.com/subscribe/post?u=f04c804868966b1b4509daa9b&amp;id=825b9235c7"
        });
    
        /* MOSONRY */ 
        
        var $container = $('.masonry-container');
        $container.imagesLoaded(function() {
            $container.masonry({
                columnWidth: '.item',
                itemSelector: '.item'
            });
        });

        /* SEARCH OVERLAY */
       
        $("#filter-search").on('click', function() {
            $(".full-page-search").addClass("open-search");
        });
        $(".sr-overlay").on('click', function() {
            $(".full-page-search").removeClass("open-search");
        });          

    }());
});