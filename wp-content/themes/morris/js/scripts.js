jQuery(document).ready(function(){
    
    jQuery('.top-nav-links div > ul > li.menu-item-has-children > a').append('<i class="fi fi-rr-angle-small-down"></i>');
    jQuery('.main-nav-links div > ul > li.menu-item-has-children').prepend('<i class="nav-opener fi fi-rr-angle-small-down"></i>');
    jQuery('.main-nav-links div > ul > li.menu-item-has-children > a').append('<i class="desktop-icn fi fi-rr-angle-small-down"></i>');
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
    jQuery('.woocommerce.filters .widget h2').each(function(event){
        jQuery(this).next().addClass('none');
        // event.stopPropagation();
    });
    jQuery('.top-menu').click(function(){
        jQuery('.top-nav-links').toggle('slow');
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
        
        jQuery('.main-nav-links div > ul > li.menu-item-has-children > a i.nav-opener').remove();
        jQuery('.main-nav-links ul > li.menu-item-has-children i.nav-opener').on('click', function(event){
                if(jQuery(this).parent().find('> div.sub-menu-wrapper').length > 0 && !jQuery(this).find('> div.sub-menu-wrapper').hasClass('block')){
                    jQuery(this).parent().find('> div.sub-menu-wrapper').addClass('block');
                }
                else if(jQuery(this).parent().find('> ul.sub-menu').length > 0 && !jQuery(this).parent().find('> ul.sub-menu').hasClass('block')){
                    jQuery(this).parent().find('> ul.sub-menu').addClass('block');
                }
                else{
                    jQuery(this).parent().find('> div.sub-menu-wrapper').removeClass('block');
                    jQuery(this).parent().find('> ul.sub-menu').removeClass('block');
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
    jQuery('.menu-click').click(function(){
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
    jQuery('#enquire-form').submit(function(event){
        var quantity = '';
        (jQuery('#prQuantity').val()) ? quantity = jQuery('#prQuantity').val() : quantity = 1;
        var senderEmail = jQuery('#senderEmail').val();
        var businessName = jQuery('#businessName').val();
        var firstname = jQuery('#firstname').val();
        var lastname = jQuery('#lastname').val();
        var phonenumber = jQuery('#phonenumber').val();
        var postecode = jQuery('#postecode').val();
        var firstNameTester = techvertu_firstname_lastname_checker(firstname);
        var lastnameTester = techvertu_firstname_lastname_checker(lastname);
        var phoneNumberTested = techvertu_mobile_number_tester(phonenumber);
        var productTitle = jQuery("#productTitle").val();
        var sku = jQuery('#prSKU').val();
        var recaptcha = jQuery('#g-recaptcha-response').val();
        console.log(phoneNumberTested);
        var postalCodeResult = techvertu_gb_postalcode_tester(postecode);
        var note = jQuery('#note').val();
        jQuery('#enquire-form input, #enquire-form textarea').removeClass('red');
        
        if(quantity && senderEmail && businessName && firstname && firstNameTester == true && lastnameTester == true && lastname && postalCodeResult == true && note){
            jQuery('.spinner').removeClass('none');
            jQuery('.contact-submit').attr('disabled', 'disabled');
            jQuery('.techvertu-enquiry-form .alert').remove();
            jQuery.ajax({
                url: frontendajax.ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'techvertu_send_enquiry',
                    "quantity" : quantity, 
                    "senderEmail" : senderEmail,
                    "businessName" : businessName,
                    "firstname" : firstname,
                    "lastname" : lastname,
                    "productTitle" : productTitle,
                    "phonenumber" : phonenumber,
                    "postecode" : postecode,
                    "sku": sku,
                    "note" : note,
                    "g-recaptcha-response": recaptcha
                },
                success: function (response ) {
                    console.log(response);
                    jQuery('.spinner').addClass('none');
                    jQuery('.contact-submit').removeAttr('disabled');
                    jQuery('.techvertu-enquiry-form').prepend('<div class="alert green"><p>Your message has been successfully sent</p></div>');
                    jQuery('#enquire-form')[0].reset();
                },
                error: function (response) {
                    console.log(response);
                    jQuery('.spinner').addClass('none');
                    jQuery('.contact-submit').removeAttr('disabled');
                    techvertu_error_message();
                    jQuery('#enquire-form')[0].reset();
                    
                }
            });
            
            return false;
        } else {
            jQuery('.techvertu-enquiry-form .alert').remove();
            techvertu_error_message();
            techvertu_empty_field_detector(quantity , senderEmail , businessName , firstname , lastname , phonenumber , postecode , note, postalCodeResult, phoneNumberTested, firstNameTester, lastnameTester);
            return false;
        }
        event.stopImmediatePropagation();
    });
    function techvertu_empty_field_detector(quantity , senderEmail , businessName , firstname , lastname , phonenumber , postecode , note, postalCodeResult, phoneNumberTested, firstNameTester, lastnameTester){
        if(!quantity){
            jQuery('#prQuantity').addClass('red');
        }
        if(!senderEmail){
            jQuery('#senderEmail').addClass('red');
        }
        if(!businessName){
            jQuery('#businessName').addClass('red');
        }
        if(!firstname || firstNameTester == false){
            jQuery('#firstname').addClass('red');
        }
        if(!lastname || lastnameTester == false){
            jQuery('#lastname').addClass('red');
        }
        if(!phonenumber || phoneNumberTested == false){
            jQuery('#phonenumber').addClass('red');
        }
        if(!postecode || postalCodeResult == false){
            jQuery('#postecode').addClass('red');
        }
        if(!note){
            jQuery('#note').addClass('red');
        }
    }
    function techvertu_error_message(){
        jQuery('.techvertu-enquiry-form').prepend('<div class="alert red"><p>All fields are required. Please fill out all fields</p></div>');
    }
    function techvertu_mobile_number_tester(mobileNumber) {
        var regex = /^(?:(?:\(?(?:0(?:0|11)\)?[\s-]?\(?|\+)44\)?[\s-]?(?:\(?0\)?[\s-]?)?)|(?:\(?0))(?:(?:\d{5}\)?[\s-]?\d{4,5})|(?:\d{4}\)?[\s-]?(?:\d{5}|\d{3}[\s-]?\d{3}))|(?:\d{3}\)?[\s-]?\d{3}[\s-]?\d{3,4})|(?:\d{2}\)?[\s-]?\d{4}[\s-]?\d{4}))(?:[\s-]?(?:x|ext\.?|\#)\d{3,4})?$/;
        var result = regex.test(mobileNumber);
        return result;
    }
    function techvertu_firstname_lastname_checker(selectedName){
        var firstNameLastNameReg = new RegExp('^[a-zA-Z]+$');
        var selectedNameResult = firstNameLastNameReg.test(selectedName);
        return selectedNameResult;

    }
    function techvertu_gb_postalcode_tester(postalcode){
        var postalCodeRegex = new RegExp('^[a-zA-Z]{1,2}[0-9][0-9A-Za-z]{0,1} {0,1}[0-9][A-Za-z]{2}$');
        var psstalCodeRegexResult = postalCodeRegex.test(postalcode);
        return psstalCodeRegexResult;
    }
});

