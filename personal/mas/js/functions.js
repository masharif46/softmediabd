jQuery(document).ready(function($){
	
	"use strict";

	// sf menu
	jQuery('ul.sf-menu').superfish({
		animation:     {height:'show'},   
		animationOut:  {height:'hide'}, 
		speed:         'fast',           
		speedOut:      'fast', 
		delay:         800,
		pathClass:	'current'           
	});
    jQuery('ul.sf-menu li').each(function() {
        var mega = jQuery(this).find('.sf-mega');
        if ( mega.length ) {
            jQuery(this).addClass('megamenu');
        }
    });
    jQuery('ul.sf-menu li').each(function() {
        var list_item = jQuery('ul.sf-menu').find('li');
        jQuery(this).find('a, span').hover(function() {
            list_item.addClass('inactive');
            jQuery(this).parents('li').removeClass('inactive');
        }, function(){
            list_item.removeClass('inactive');
        });
    });
    jQuery('#header .logo-header').append('<div class="visible-xs visible-sm mobile-menu-action pull-right sb-toggle-right navbar-right"><i class="fa fa-bars"></i></div>');
    // Toggle Submenu Fuction
    jQuery.fn.toggle = function( fn, fn2 ) {
      if ( !jQuery.isFunction( fn ) || !jQuery.isFunction( fn2 ) ) {
        return oldToggle.apply( this, arguments );
      }
      var args = arguments,
      guid = fn.guid || jQuery.guid++,
      i = 0,
      toggler = function( event ) {
        var lastToggle = ( jQuery._data( this, "lastToggle" + fn.guid ) || 0 ) % i;
        jQuery._data( this, "lastToggle" + fn.guid, lastToggle + 1 );
        event.preventDefault();
        return args[ lastToggle ].apply( this, arguments ) || false;
      };
      toggler.guid = guid;
      while ( i < args.length ) {
        args[ i++ ].guid = guid;
      }
      return this.click( toggler );
    };

    // Responsive Mobile Menu
    var navlist = jQuery('.site-menu-container > nav ul').clone();
    var submenu = '<span class="submenu"><i class="fa fa-angle-double-down"></i></span>';
    navlist.removeClass().addClass('mobile-menu');
    
    navlist.find('ul').removeAttr('style');
    navlist.find('li:has(> ul) > a').after(submenu);;
    navlist.find('.submenu').toggle(function(){
        jQuery(this).parent().addClass('over').find('>ul').slideDown(200);
    },function(){
        jQuery(this).parent().removeClass('over').find('>ul').slideUp(200);
    });
    jQuery('.sb-slidebar .sb-menu-trigger').after(navlist[0]);

    // portfolio image
    function erika_hover(){

        // Affix
        jQuery('.header-fixed').affix({
            offset: {
                top: jQuery('#header').outerHeight(),
                bottom: function () {
                    return (this.bottom = jQuery('#footer').outerHeight(true))
                }
            }
        });
    
        jQuery('.portfolio-item').each(function() {
            var imgheight = jQuery(this).find('.portfolio-image').outerHeight();
            jQuery(this).find('.portfolio-info').css({'bottom' : -jQuery(this).find('.portfolio-info').height()})
            jQuery(this).hover(function(){
                jQuery(this).find('.portfolio-image img').stop().animate({'margin-top' : -185}, 600, 'jswing');
                jQuery(this).find('.portfolio-info').stop().animate({'bottom' : 0, 'opacity' : 1}, 200, 'jswing');
            }, function(){
                jQuery(this).find('.portfolio-image img').stop().animate({'margin-top' : 0}, 600, 'jswing');
                jQuery(this).find('.portfolio-info').stop().animate({'bottom' : -jQuery(this).find('.portfolio-info').height(), 'opacity' : 0}, 200, 'jswing');
            });
        });

        jQuery('.portfolio-area').each(function() {
            jQuery(this).find('.portfolio-item').hover(function() {
                jQuery('.portfolio-area').find('.portfolio-item').addClass('inactive');
                jQuery(this).removeClass('inactive').addClass('active');
            }, function(){
                jQuery('.portfolio-area').find('.portfolio-item').removeClass('inactive');
                jQuery(this).removeClass('active');
            });
        });

        jQuery('.service-box').each(function() {
            var iconheight = jQuery(this).find('.service-icon').outerHeight();
            jQuery(this).hover(function() {
                jQuery(this).find('.service-icon').stop().animate({'margin-top' : iconheight*-1-10, 'opacity' : 0}, 400, 'jswing');
            }, function(){
                jQuery(this).find('.service-icon').stop().animate({'margin-top' : 0, 'opacity' : 1}, 200, 'jswing');
            });
        });

        jQuery('.color-box-wrap').each(function() {
            
            var cwh = jQuery(this).width()/2-1;

            jQuery(this).find('.color-box').hover(function() {
                jQuery(this).addClass('active').removeClass('default');
                jQuery(this).stop().animate({'width' : cwh}, 500, 'jswing');
            }, function(){
                
                jQuery(this).stop().animate({
                    'width' : '100%'}, {
                    duration: 300,
                    easing: 'jswing',
                    complete: function() { 
                        jQuery(this).removeClass('active').addClass('default');
                    }
                });
            });

            jQuery(this).find('.color-box:last').addClass('last');

            jQuery(this).find('.color-box').each(function() {

                var cwj = jQuery(this).width();
                jQuery(this).find('.color-box-inner').css({ 'width' : cwj });

            });

        });

        jQuery('.imagebox').each(function() {
            
            var cth = jQuery(this).find('.imagebox-content').height();
            jQuery(this).find('.imagebox-content').css({ 'bottom' : (cth)*-1 });

            jQuery(this).hover(function() {
                jQuery(this).addClass('active');
                jQuery(this).find('.imagebox-mark').stop().animate({'opacity' : 1}, 300, 'jswing');
                jQuery(this).find('.imagebox-content').stop().animate({'bottom' : 0, 'opacity' : 1}, 300, 'jswing');
            }, function(){
                jQuery(this).removeClass('active');
                jQuery(this).find('.imagebox-mark').stop().animate({'opacity' : 0}, 300, 'jswing');
                jQuery(this).find('.imagebox-content').stop().animate({ 'bottom' : (cth)*-1, 'opacity' : 0 }, 300, 'jswing');
            });

        });

        jQuery('.probox').each(function() {
            
            var cth = jQuery(this).find('.probox-desc').height();
            jQuery(this).find('.probox-heading').css({ 'bottom' : (cth+25)*-1 });

            jQuery(this).hover(function() {
                jQuery(this).addClass('active');
                jQuery(this).find('.probox-desc').stop().animate({'opacity' : 1}, 300, 'jswing');
                jQuery(this).find('.probox-heading').stop().animate({ 'bottom' : 0 });
            }, function(){
                jQuery(this).removeClass('active');
                jQuery(this).find('.probox-desc').stop().animate({'opacity' : 0}, 300, 'jswing');
                jQuery(this).find('.probox-heading').stop().animate({ 'bottom' : (cth+25)*-1 });
            });

        });

        jQuery('.contactblock').each(function() {
            jQuery(this).css({'margin-top' : jQuery(this).outerHeight()/2*-1})
        });

        jQuery('.blog-item.small').each(function() {
            var tth = jQuery(this).find('.blog-title').outerHeight()/2*-1;
            jQuery(this).find('.blog-info').css({ 'bottom' : tth });
        });

        jQuery('.product-item').each(function() {

            jQuery(this).hover(function(){
                jQuery(this).addClass('hover');
                jQuery(this).find('.product-mark-inner-content').stop().animate({'bottom' : jQuery(this).height()/2-60, 'opacity' : 1}, 220, 'easeInSine');
            }, function(){
                jQuery(this).removeClass('hover');
                jQuery(this).find('.product-mark-inner-content').stop().animate({'bottom' : 0, 'opacity' : 0}, 220, 'easeOutSine');
            });
        });

        if ( $.isFunction($.fn.masonry) ) {

            var container = jQuery('#masonry');
            container.imagesLoaded(function(){
              container.masonry();
            });
        }

        // Masonry
        if ( $.isFunction($.fn.masonry) ) {

            var container = jQuery('#masonry');
            container.imagesLoaded(function(){
              container.masonry({
                itemSelector: '.msbox',
              });
            });

            container.infinitescroll({
                navSelector  : '.pagenavi',    // selector for the paged navigation 
                nextSelector : '.pagenavi a',  // selector for the NEXT link (to page 2)
                itemSelector : '.msbox',     // selector for all items you'll retrieve
                animate: true,
                loading: {
                    msgText: "Loading next posts ...",
                    finishedMsg: 'No more pages to load.',
                    img: 'http://i.imgur.com/6RMhx.gif'
                }
            },

            function( newElements ) {
                var newElems = jQuery( newElements ).css({ opacity: 0 });
                newElems.imagesLoaded(function(){
                    newElems.animate({ opacity: 1 });
                    container.masonry( 'appended', newElems, true ); 
                });
            });
        };

        jQuery('.timeline.blogtl').infinitescroll({
            navSelector  : '.pagenavi',    // selector for the paged navigation 
            nextSelector : '.pagenavi a',  // selector for the NEXT link (to page 2)
            itemSelector : '.msbox',     // selector for all items you'll retrieve
            loading: {
                msgText: "Loading next posts ...",
                finishedMsg: 'No more pages to load.',
                img: 'http://i.imgur.com/6RMhx.gif'
            }
        });

        jQuery('.entry-content table, #wp-calendar').addClass('table');
    };

    jQuery(window).load(function(){
        var resizeTimer;
        jQuery(window).resize(function() {
          clearTimeout(resizeTimer);
          resizeTimer = setTimeout(erika_hover, 0);
        }).resize();

        // Initiate Slidebars
        jQuery.slidebars({
            disableOver: 770,
        });
    });

    // header social
    jQuery('.social-info').each(function(){

        jQuery(this).find('li').hover(function() {
            jQuery('.social-info').find('li.active').removeClass('active');
            jQuery(this).addClass('active');
        });
    });

	// Search
    jQuery('.header-search').each(function(){
    	var ctsearch = jQuery(this),
    	ctsearchinput = ctsearch.find('input.header-search-input'),
    	body = jQuery('html,body'),
    	openSearch = function() {
    		ctsearch.data('open',true).addClass('header-search-open');
            jQuery('.site-menu-container, .cart-menu').css({'opacity' : 0});
    		ctsearchinput.focus();
    		return false;
    	},
    	closeSearch = function() {
    		ctsearch.data('open',false).removeClass('header-search-open');
            jQuery('.site-menu-container, .cart-menu').css({'opacity' : 1});
    	};
    	ctsearchinput.on('click',function(e) { e.stopPropagation(); ctsearch.data('open',true); });
    	ctsearch.on('click',function(e) {
    		e.stopPropagation();
    		if( !ctsearch.data('open') ) {
    			openSearch();
    			body.off( 'click' ).on( 'click', function(e) {
    				closeSearch();
    			} );
    		}
    		else {
    			if( ctsearchinput.val() === '' ) {
    				closeSearch();
    				return false;
    			};
    		}
    	});
    });

    // Eqal Height
    function equalHeight(group) {
        var tallest = 0;
        group.each(function() {
            var thisHeight = jQuery(this).height();
            if(thisHeight > tallest) {
                tallest = thisHeight;
            }
        });
        group.height(tallest);
    }

    equalHeight(jQuery('.height-group'));
    equalHeight(jQuery('.service-box'));
    equalHeight(jQuery('.review-gp'));

    // Section
    jQuery('.section').each(function(){
        var bg = jQuery(this);

        if(bg.data('bg')){
            bg.css('background-image','url('+bg.data('bg')+')');
        }
        if(bg.data('bgcolor')){
            bg.css('background-color',bg.data('bgcolor'));
        }
        if(bg.data('bgmark')){
            bg.append('<div class="section-bgwrap" />');
            bg.find('.section-bgwrap').css('background-color',bg.data('bgmark'));
        }

        bg.css('width',bg.data('width'));
        bg.css('min-height',bg.data('minheight'));
        bg.css('margin',bg.data('margin'));
        bg.css('padding',bg.data('padding'));
    });

    // Elements
    jQuery('.element').each(function(){
        var elm = jQuery(this);
        elm.css('margin',elm.data('margin'));
        elm.css('padding',elm.data('padding'));
    });

    jQuery('.accordion-item').each(function(){

        if ( jQuery(this).find('.accordion-title a').hasClass('collapsed') ) {
            jQuery(this).removeClass('active');
        } else {
            jQuery(this).addClass('active');
        }

        jQuery(this).find('.accordion-title a').click(function() {
            if ( jQuery(this).hasClass('collapsed') ) {
                jQuery(this).parents('.accordion-item').addClass('active');
            } else {
                jQuery(this).parents('.accordion-item').removeClass('active');
            }
        });

    });

    jQuery('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

    jQuery('.image-link').magnificPopup({
      type:'image',
    });


    // Testimonail Tabs
    jQuery('.testimonial .tabNavigation > li > a').hover( function(){
      jQuery(this).tab('show');
    });

    // Counto
    jQuery('.counter-content').waypoint(function () {
        jQuery(this).find('.counter').countTo({
            speed: 10000,           
            refreshInterval: 100,  
            decimals: 0,          
        });
    }, { offset: '100%' });

    // Progress Bar
    setTimeout(function(){
        jQuery('.progress .progress-bar').each(function() {
            var me = jQuery(this);
            var perc = me.data('percentage');
            var bgcolor = me.data('bgcolor');
            var current_perc = 0;
            var progress = setInterval(function() {
                if (current_perc>=perc) {
                    clearInterval(progress);
                } else {
                    current_perc +=1;
                    me.css('width', (current_perc)+'%');
                    me.css('background-color', (bgcolor))
                }
            }, 10);
        });
    },10);

    // Contact block
    jQuery('.contact-section').each(function(){
        jQuery(this).find('#pre-name').keyup(function(){
            jQuery('#contact-modal #name').val(jQuery(this).val());
        });
        jQuery(this).find('#pre-mail').keyup(function(){
            jQuery('#contact-modal #email').val(jQuery(this).val());
        });
        jQuery(this).find('#pre-title').keyup(function(){
            jQuery('#contact-modal #subject').val(jQuery(this).val());
        });
    });

    jQuery('[data-typer-targets]').typer({
        highlightSpeed    : 20,
        typeSpeed         : 100,
        clearDelay        : 500,
        typeDelay         : 200,
        clearOnHighlight  : true,
        typerDataAttr     : 'data-typer-targets',
        typerInterval     : 2000
    });

    // Bootrap Tooltip
    jQuery('*[data-toggle="tooltip"], .tagcloud a').tooltip();
    
    // Cilents Images
    jQuery('.cilent').each(function() {
        var oldurl = jQuery(this).attr('src');
        jQuery(this).hover(function(){
            jQuery(this).addClass('hover');
            if(jQuery(this).data('hover')){
                jQuery(this).attr("src", jQuery(this).data('hover'));
            }
        }, function(){
            jQuery(this).removeClass('hover');
            if(jQuery(this).data('hover')){
                jQuery(this).attr("src", oldurl);
            }
        });
    });

    // Carousel
    jQuery(window).load(function(){
        jQuery('.carouselbox').each(function() {
            var next = jQuery(this).find('.prev');
            var prev = jQuery(this).find('.next');
            
            if (jQuery(this).find('.carousel-area').length > 0) {
                jQuery(this).find('.carousel-area').carouFredSel({
                    circular: false,
                    responsive: true,
                    width: 'variable',
                    height: "variable",
                    align: "center",
                    padding: [15],
                    items: {
                        width: 320,
                        visible: {
                            min: 1,
                            max: 4
                        },
                        height: "variable"
                    },
                    next: next,
                    prev: prev,
                    scroll : {
                        items           : 1,
                        easing          : "jswing",
                        duration        : 1000,                         
                        pauseOnHover    : true
                    },
                    mousewheel : {
                        items           : 1,
                        easing          : "jswing",
                        duration        : 1000,                         
                        pauseOnHover    : false,
                    },
                    swipe : {
                        items           : 1,
                        easing          : "jswing",
                        duration        : 1000,                         
                        pauseOnHover    : false
                    } 
                });
            }
        });
    });
    
    // Init animation
    var wow = new WOW(
      {
        boxClass:     'wow',     
        animateClass: 'animated',
        offset:       0,          
        mobile:       false
      }
    );
    wow.init();
    
    // Slider
    jQuery('.slider').each(function() {
        jQuery(this).flexslider({
            animation: "fade",
            controlNav: true,              
            directionNav: true,
            prevText: '<i class="fa fa-chevron-left"></i>',           
            nextText: '<i class="fa fa-chevron-right"></i>',              
        });
    });

    // .Promoslider
    jQuery('.promoslider').each(function() {
        jQuery(this).flexslider({
            animation: 'slide',
            controlNav: false,              
            directionNav: true,
            easing: 'easeOutQuart',
            direction: 'vertical',
            prevText: '<i class="fa fa-chevron-left"></i>',           
            nextText: '<i class="fa fa-chevron-right"></i>',
            smoothHeight: true,              
        });
    });

    // Portfolio Filter
    jQuery(window).load(function(){

        var jQuerycontainer = jQuery('.portfolio-filter');

        if(jQuerycontainer.length) {

            jQuerycontainer.isotope({
                itemSelector: '.element',
                layoutMode: 'fitRows',
                isFitWidth: true
            });
        };

        jQuery('#options').on('change', function(){
          var filterValue = this.value;

          jQuerycontainer.isotope({
              filter: filterValue
          });

          var ptext = jQuery('.selectize-control.option-set').find('.item').text();
          jQuery('.portfolio-title-area .heading-title .portfolio-category-title').text(ptext);
        });

        jQuery('#portfolio-width').on('change', function(){
            jQuery('.portfolio-filter .element').removeClass('col-md-3 col-md-4 col-md-6').addClass('col-md-'+jQuery(this).val());
            jQuerycontainer.isotope('reLayout');
            jQuery('.option-portfolio').find('span').removeClass();
            jQuery(this).addClass('selected');
        });

    });

    // Chart
    jQuery('.chart').each(function() {
        jQuery(this).donutchart({'size': 140, 'fgColor': '#EF4A43', 'donutwidth':1 });
    });
    jQuery('.chart-trigger').waypoint(function () {
        jQuery(this).find('.chart').donutchart("animate");
    }, { offset: '100%' });

    // Twitter Feed
    jQuery('#last-tweet').tweecool({
        username : 'everislabs', 
        limit : 2,
        profile_image : false  
    });

    // jQuery Select
    jQuery('select').selectize();

    // scroll back to top
    (function($){$.fn.backToTop=function(options){var $this=$(this);$this.hide().click(function(){$("body, html").animate({scrollTop:"0px"});});var $window=$(window);$window.scroll(function(){if($window.scrollTop()>0){$this.fadeIn();}else{$this.fadeOut();}});return this;};})(jQuery);

    // adding back to top button
    jQuery('body').append('<a class="back-to-top"><i class="fa fa-angle-up"></i></a>');
    jQuery('.back-to-top').backToTop();

});