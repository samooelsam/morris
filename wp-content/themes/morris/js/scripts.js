jQuery(document).ready(function(){
    jQuery('.main-nav-links div > ul > li.menu-item-has-children > a').append('<i class="fi fi-rr-angle-small-down"></i>');
    jQuery('.top-nav-links div > ul > li.menu-item-has-children > a').append('<i class="fi fi-rr-angle-small-down"></i>');
    jQuery('.menu-main-header-container').prepend('<i class="close-mobile-menu fi fi-rr-circle-xmark"></i>');
    jQuery('.shop-icn').click(function(){
        jQuery('.mencart-wrapper').toggleClass('block');
        jQuery('.blur-overlay').toggleClass('block');
    });
    jQuery('.close-search').click(function(event){
        jQuery('.search-wrapper').removeClass('block');
        event.stopPropagation();
    });
    jQuery('span.search-icn').click(function(event){
        jQuery('.search-wrapper').addClass('block');
        if(jQuery('.mencart-wrapper').hasClass('block')){
            jQuery('.mencart-wrapper').removeClass('block');
            jQuery('.blur-overlay').removeClass('block');
        }
        event.preventDefault();
    });
    jQuery('.main-nav-links ul.sub-menu ul.sub-menu').wrap( "<div class='sub-menu-wrapper'></div>" );
    jQuery('.woocommerce.filters .widget h2').append('<i class="fi fi-rr-angle-small-down"></i>');
    jQuery('.woocommerce.filters .widget h2').click(function(){
        jQuery(this).find('i').toggleClass('fi-rr-angle-small-down');
        jQuery(this).find('i').toggleClass('fi-rr-angle-small-up');
        jQuery(this).next().toggleClass('none');
    });
    jQuery('.woocommerce.filters .widget h2').each(function(){
        jQuery(this).next().addClass('none');
    });
    if(jQuery(window).width() >= 720){
		//Update Header Style and Scroll to Top
		jQuery(window).on('scroll', function() {
			if(jQuery('.techvertu-navigate-to-section').length){
				var windowpos = jQuery(window).scrollTop();
				var siteHeader = jQuery('.techvertu-navigate-to-section');
				var sticky_header = jQuery('.techvertu-navigate-to-section.sticky');
				if (windowpos > 700) {
					siteHeader.addClass('fixed-top'); 
					sticky_header.addClass("animated slideInDown");
				} else {
					siteHeader.removeClass('fixed-top');
					sticky_header.removeClass("animated slideInDown");
				}
			}
		});
        jQuery('.main-nav-links ul > li.menu-item-has-children').on({
            mouseenter: function(){
                if(jQuery(this).find('> div.sub-menu-wrapper').length > 0){
                    jQuery(this).find('> div.sub-menu-wrapper').addClass('block');
                }
                else{
                    jQuery(this).find('> ul.sub-menu').addClass('block');
                }
                if(!jQuery('.blur-overlay').hasClass('block')){
                    jQuery('.blur-overlay').addClass('block');
                }
            },
            mouseleave: function(){
                let This = jQuery(this);
                if(This.find('> div.sub-menu-wrapper').length > 0){
                    This.find('> div.sub-menu-wrapper').removeClass('block');
                }
                else{
                    This.find('> ul.sub-menu').removeClass('block');
                }
                if(jQuery('.blur-overlay').hasClass('block') && !jQuery('.mencart-wrapper').hasClass('block')){
    
                    jQuery('.blur-overlay').removeClass('block');
                }
            } 
        });
	} else if (jQuery(window).width() <= 720){
        jQuery('.main-nav-links ul > li.menu-item-has-children').on('click', function(event){
                if(jQuery(this).find('> div.sub-menu-wrapper').length > 0 && !jQuery(this).find('> div.sub-menu-wrapper').hasClass('block')){
                    jQuery(this).find('> div.sub-menu-wrapper').addClass('block');
                }
                else if(jQuery(this).find('> ul.sub-menu').length > 0 && !jQuery(this).find('> ul.sub-menu').hasClass('block')){
                    jQuery(this).find('> ul.sub-menu').addClass('block');
                }
                else{
                    jQuery(this).find('> div.sub-menu-wrapper').removeClass('block');
                    jQuery(this).find('> ul.sub-menu').removeClass('block');
                }
        });
    }
    jQuery('.techvertu-navigate-to-section ul li a').click(function(){
        jQuery('.techvertu-navigate-to-section ul li a').removeClass('active');
        jQuery(this).toggleClass('active');
    });
    jQuery('.close-mobile-menu').click(function(){
        jQuery('.menu-main-header-container').removeClass('block');
    });
    jQuery('.mobile-menu').click(function(){
        jQuery('.menu-main-header-container').addClass('block');
    });
    jQuery('.small-image-news .elementor-post__thumbnail').append('<i class="fi fi-rr-link-alt"></i>');
    jQuery('.form-holder').on('change', function(){
        var kva = jQuery('.kva').val();
        var volts = jQuery('.volts').val();
        let phaseValue = fliterBoxChoosePhase(jQuery('.phase').val());
        if(kva && volts){
                var result = (kva * 1000) / (volts * phaseValue);
                jQuery('.amps').val(result.toFixed(2));
        }
        
    });
    if(jQuery('.techvertu-no-product').length > 0){
        jQuery('.techvertu-no-product').parent().wrap("<div class='no-product-holder clearfix'></div>");
        // jQuery('.techvertu-no-product').parent().addClass('nope-product-background');
    }
    const swiper = new Swiper('.techvertu-swiper', {
        direction: 'horizontal',
        slidesPerView: 5,
        spaceBetween: 20,
        breakpoints: {
            320: {
              slidesPerView: 1,
              spaceBetween: 10
            },
            480: {
              slidesPerView: 1,
              spaceBetween: 10
            },
            640: {
              slidesPerView: 3,
              spaceBetween: 15
            },
            920: {
                slidesPerView: 5,
                spaceBetween: 15
              }
        },
        pagination: {
            el: '.swiper-pagination',
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        scrollbar: {
             el: '.swiper-scrollbar',
        },
    });
    if(jQuery('.filters').length > 0){

        jQuery('.filters > div').each(function(){
            jQuery(this).find('li.chosen').parent().removeClass('none');
            jQuery(this).find('h2 i').toggleClass('fi-rr-angle-small-down');
            jQuery(this).find('h2 i').toggleClass('fi-rr-angle-small-up');
        });
    }
    function fliterBoxChoosePhase(phase){
        switch (parseInt(phase)) {
            case 1:
                phaseValue = 1;
              break;
            case 2:
                phaseValue = 2;
              break;
            case 3:
                phaseValue = 1.73;
              break;
            case 4:
                phaseValue = 3;
              break;
            default:
                phaseValue = 1;
                    
          }
          return phaseValue;
    }
    
});

