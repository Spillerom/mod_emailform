// Validate if all fields are filled out
var validateFields = function() {
    //  
    var validateEmptyField = function(id) {
        return true;
/*
        if( jQuery(id).val() == '' ) {
            jQuery(id).addClass('nbjt-emailform-error');
            return false;
        }
        return true;
*/
    }

    // 
    function validateEmail(email) {
        return true;
/*
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
*/
    }
    
    var retval = true;

    if( !validateEmptyField('#nbjt-emailform-name') ) {
        console.log('first name field cannot be empty');
        retval = false;
    }

    if( !validateEmptyField('#nbjt-emailform-email') ) {
        console.log('email field cannot be empty');
        retval = false;
    }

    if( !validateEmail(jQuery('#nbjt-emailform-email').val()) ) {
        console.log('Wrong email format');
        jQuery('#nbjt-emailform-email').addClass('nbjt-emailform-error');
        retval = false;
    }

    if( !validateEmptyField('#nbjt-emailform-phone') ) {
        console.log('mobile field cannot be empty');
        retval = false;
    }

    if( !validateEmptyField('#nbjt-emailform-postnumber') ) {
        console.log('last name field cannot be empty');
        retval = false;
    }

    if( !validateEmptyField('#nbjt-emailform-residencesize') ) {
        console.log('zipcode field cannot be empty');
        retval = false;
    }

    if( !validateEmptyField('#nbjt-emailform-message') ) {
        console.log('address field cannot be empty');
        retval = false;
    }

    // 
    return retval;
}



// 
jQuery(document).ready(function() {
    // Reset error-class on keypress:
    jQuery('input').keypress(function() {
        jQuery(this).removeClass('nbjt-emailform-error');
    });

    // Handle "send button" event:
    jQuery('#nbjt-emailform-button').click(function() {
        if( validateFields() ) {
            var name = jQuery('#nbjt-emailform-name').val();
            var email = jQuery('#nbjt-emailform-email').val();
            var phone = jQuery('#nbjt-emailform-phone').val();
            var postnumber = jQuery('#nbjt-emailform-postnumber').val();
            var residencesize = jQuery('#nbjt-emailform-residencesize').val();
            var message = jQuery('#nbjt-emailform-message').val();
            var pagetitle = document.title;
            var screenresolution = window.screen.width+'x'+window.screen.height;
            var referrerurl = document.referrerurl == undefined ? 'NULL' : document.referrerurl;

            // 
            jQuery.post( "index.php?option=com_ajax&module=emailform&method=storeFormData&format=json", {
                name: name,
                email: email,
                phone: phone,
                postnumber: postnumber,
                residencesize: residencesize,
                message: message,
                pagetitle: pagetitle,
                screenresolution: screenresolution,
                referrerurl: referrerurl }, function() {
            }).done(function(_result) {
                console.log(_result);
                var result = JSON.parse(_result);
                if( result.status === 'ok' ) {
                    alert('Takk for din henvendelse!');

                    jQuery('#nbjt-emailform-name').val('');
                    jQuery('#nbjt-emailform-email').val('');
                    jQuery('#nbjt-emailform-phone').val('');
                    jQuery('#nbjt-emailform-postnumber').val('');
                    jQuery('#nbjt-emailform-residencesize').val('');
                    jQuery('#nbjt-emailform-message').val('');
                } else {
                    jQuery('.nbjt-emailform-error').text(result.message);
                }
            }).fail(function(result) {
                console.log(result);
                alert('En uventet feil har oppstått, venligst prøv igjen senere.');
            }).always(function() {
                // 
            });
        }
    });
});


