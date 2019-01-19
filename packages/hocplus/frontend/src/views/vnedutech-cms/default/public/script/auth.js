/* attach a submit handler to the form */
$("#form-register").submit(function(event) {

    /* stop form from submitting normally */
    event.preventDefault();

    /* get the action attribute from the <form action=""> element */
    var $form = $( this ),
        url = $form.attr( 'action' );

    /* Send the data using post with element id name and name2*/
    $.post( url, { email: $('#register-email').val(), password: $('#register-password').val(), confirmPassword: $('#register-confirm-password').val(), email_confirm: $('#register-email-confirm').val() }, function ( data ) {
        console.log(data);
        data = jQuery.parseJSON( data );
        if (data.success) {
            window.location.reload();
        } else {
            $("#register-notification").css('display', 'block');
            // register-notification-text
            $("#register-notification-text").empty();
            jQuery.each( data, function( i, val ) {
                $("#register-notification-text").append(val + "</br>");
            });
        }
        // return false;
    });
});

$("#form-login").submit(function(event){

    /* stop form from submitting normally */
    event.preventDefault();

    /* get the action attribute from the <form action=""> element */
    var $form = $( this ),
        url = $form.attr( 'action' );

    /* Send the data using post with element id name and name2*/
    $.post( url, { email: $('#login-email').val(), password: $('#login-password').val(), remember: $('#login-remember').val() }, function ( data ) {
        data = jQuery.parseJSON( data );
        console.log(data);
        if (data.success) {
            window.location.reload();
        } else {
            $("#login-notification").css('display', 'block');
        }
        // return false;
    });
});