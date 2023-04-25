(function($){
    "use strict";
    
    // Header Sticky
    $(window).on('scroll',function() {
        if ($(this).scrollTop() > 120){  
            $('.navbar-area').addClass("is-sticky");
        }
        else{
            $('.navbar-area').removeClass("is-sticky");
        }
    });
    
    // Mean Menu
    jQuery('.mean-menu').meanmenu({
        meanScreenWidth: "1199"
	});
	
	// Search Menu JS
	$(".search-box i").on("click", function(){
		$(".search-overlay").toggleClass("search-overlay-active");
	});
	$(".search-overlay-close").on("click", function(){
		$(".search-overlay").removeClass("search-overlay-active");
	});

    // Banner slider Three
	$('.banner-slider').owlCarousel({
		items: 1,
		loop: true,
		margin: 0,
		nav: true,
		autoplay: true,
		autoplayHoverPause: true,
		dots: false,
		navText: [
			"<i class='las la-angle-left'></i>",
			"<i class='las la-angle-right'></i>"
		]
	})

    // Popup Video
	$('.popup-youtube').magnificPopup({
		disableOn: 320,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,
		fixedContentPos: false
    });
    
    // Odometer JS
	$('.odometer').appear(function(e) {
		var odo = $(".odometer");
		odo.each(function() {
			var countNumber = $(this).attr("data-count");
			$(this).html(countNumber);
		});
    });
    
    // Button Hover JS
    $(function() {
        $('.default-btn')
        .on('mouseenter', function(e) {
            var parentOffset = $(this).offset(),
            relX = e.pageX - parentOffset.left,
            relY = e.pageY - parentOffset.top;
            $(this).find('span').css({top:relY, left:relX})
        })
        .on('mouseout', function(e) {
            var parentOffset = $(this).offset(),
            relX = e.pageX - parentOffset.left,
            relY = e.pageY - parentOffset.top;
            $(this).find('span').css({top:relY, left:relX})
        });
    });

    // Accordion JS
	$('.accordion > li:eq(0) .title').addClass('active').next().slideDown();
	$('.accordion .title').click(function(j) {
		var dropDown = $(this).closest('li').find('.accordion-content');
		$(this).closest('.accordion').find('.accordion-content').not(dropDown).slideUp();
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
		} else {
			$(this).closest('.accordion').find('.title.active').removeClass('active');
			$(this).addClass('active');
		}
		dropDown.stop(false, true).slideToggle();
		j.preventDefault();
    });
    
    //  Testimonials Slider
	$('.testimonials-slider').owlCarousel({
		loop: true,
		margin: 0,
		nav: true,
		autoHeight: true,
		autoplay: true,
		autoplayHoverPause: true,
		dots: false,
		navText: [
			"<i class='las la-angle-left'></i>",
			"<i class='las la-angle-right'></i>"
		],
		responsive:{
			0:{
				items:1
			},
			576:{
				items:1
			},
			768:{
				items:1
			},
			1200:{
				items:1
			}
		}
	})
	
	// Testimonials Slider Two
	$('.testimonials-slider-two').owlCarousel({
		loop: true,
		margin: 30,
		dots: false,
		nav: true,
		autoplay: true,
		autoplayHoverPause: true,
		navText: [
			"<i class='las la-angle-left'></i>",
			"<i class='las la-angle-right'></i>"
		],
		responsive:{
			0:{
				items:1
			},
			576:{
				items:1
			},
			768:{
				items:1
			},
			992: {
				items:2
			},
			1200:{
				items:2
			}
		}
	})

    // Preloader JS
	jQuery(window).on('load',function(){
        jQuery(".preloader").fadeOut(500);
    });

    // Go to Top
	$(window).on('scroll', function() {
        if ($(this).scrollTop() > 0) {
            $('.go-top').addClass('active');
        } else {
            $('.go-top').removeClass('active');
        }
	});	
    $(function(){
        $(window).on('scroll', function(){
            var scrolled = $(window).scrollTop();
            if (scrolled > 600) $('.go-top').addClass('active');
            if (scrolled < 600) $('.go-top').removeClass('active');
        });  
        
        $('.go-top').on('click', function() {
            $("html, body").animate({ scrollTop: "0" },  500);
        });
    });

	// Buy Now Btn
    $('body').append("<a href='https://themeforest.net/checkout/from_item/29473773?license=regular&support=bundle_6month&_ga=2.248907271.1464546313.1649253347-1356931366.1645330919&_gac=1.217919716.1649351773.Cj0KCQjwl7qSBhD-ARIsACvV1X34Yvc4XKSYFq60iQ6auDlKjNhJLJW5j_1joCsZJCKQ-4m75Uw8RNcaArtlEALw_wcB' target='_blank' class='buy-now-btn'><img src='assets/img/envato.png' alt='envato'/>Buy Now</a>");

	// Switch Btn
	$('body').append("<div class='switch-box'><label id='switch' class='switch'><input type='checkbox' onchange='toggleTheme()' id='slider'><span class='slider round'></span></label></div>");

}(jQuery));

// function to set a given theme/color-scheme
function setTheme(themeName) {
	localStorage.setItem('ajol_theme', themeName);
	document.documentElement.className = themeName;
}
// function to toggle between light and dark theme
function toggleTheme() {
	if (localStorage.getItem('ajol_theme') === 'theme-dark') {
		setTheme('theme-light');
	} else {
		setTheme('theme-dark');
	}
}
// Immediately invoked function to set the theme on initial load
(function () {
	if (localStorage.getItem('ajol_theme') === 'theme-dark') {
		setTheme('theme-dark');
		document.getElementById('slider').checked = false;
	} else {
		setTheme('theme-light');
	document.getElementById('slider').checked = true;
	}
})();