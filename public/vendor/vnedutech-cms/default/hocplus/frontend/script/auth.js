/* attach a submit handler to the form */
$("#form-register").submit(function(event) {
    $('#register-btn-submit').attr('disabled','disabled');

    /* stop form from submitting normally */
    event.preventDefault();

    /* get the action attribute from the <form action=""> element */
    var $form = $( this ),
        url = $form.attr( 'action' );

    /* Send the data using post with element id name and name2*/
    $.post( url, {
        email: $('#register-email').val(),
        password: $('#register-password').val(),
        confirmPassword: $('#register-confirm-password').val(),
        email_confirm: $('#register-email-confirm').val(),
        type: document.querySelector('input[name="exampleRadios"]:checked').value
    }, function ( data ) {
        console.log(data);
        data = jQuery.parseJSON( data );
        if (data.success) {
            $("#register-notification").css('display', 'none');
            $("#register-notification-done").css('display', 'block');
            setTimeout(function () {
                window.location.href = "/";
            }, 3000);
        } else {
            $('#register-btn-submit').attr('disabled', false);
            $("#register-notification-done").css('display', 'none');
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
    $('#login-btn-submit').attr('disabled','disabled');

    /* stop form from submitting normally */
    event.preventDefault();

    /* get the action attribute from the <form action=""> element */
    var $form = $( this ),
        url = $form.attr( 'action' );

    /* Send the data using post with element id name and name2*/
    $.post( url, { email: $('#login-email').val(), password: $('#login-password').val(), remember: $('#login-remember').val() }, function ( data ) {
        data = jQuery.parseJSON( data );
        if (data.success) {
            window.location.reload();
        } else {
            $('#login-btn-submit').attr('disabled', false);
            $("#login-notification").css('display', 'block');
        }
        // return false;
    });

    // document.getElementById("login-btn-submit").disabled = false;
});

$("#form-login-teacher").submit(function(event){
    $('#login-teacher-btn-submit').attr('disabled', 'disabled');

    /* stop form from submitting normally */
    event.preventDefault();

    /* get the action attribute from the <form action=""> element */
    var $form = $( this ),
        url = $form.attr( 'action' );

    /* Send the data using post with element id name and name2*/
    $.post( url, { email: $('#login-email-teacher').val(), password: $('#login-password-teacher').val(), remember: $('#login-remember-teacher').val() }, function ( data ) {
        data = jQuery.parseJSON( data );
        console.log(data);
        if (data.success) {
            window.location.reload();
        } else {
            $('#login-teacher-btn-submit').attr('disabled', false);
            $("#login-notification-teacher").css('display', 'block');
        }
        // return false;
    });
});

$("#form-forgot").submit(function(event){
    $('#forgot-btn-submit').attr('disabled', 'disabled');

    /* stop form from submitting normally */
    event.preventDefault();

    /* get the action attribute from the <form action=""> element */
    var $form = $( this ),
        url = $form.attr( 'action' );

    /* Send the data using post with element id name and name2*/
    $.post( url, { email: $('#forgot-email').val() }, function ( data ) {
        data = jQuery.parseJSON( data );
        // console.log(data);
        if (data.success) {
            $("#forgot-notification").css('display', 'block');
            setTimeout(function () {
                window.location.href = "/";
            }, 3000);
        } else {
            $('#forgot-btn-submit').attr('disabled', false);
            $("#forgot-notification-err").css('display', 'block');
        }
        // return false;
    });
});

$("#form-forgot-password").submit(function(event){
    $('#reset-btn-submit').attr('disabled', 'disabled');

    /* stop form from submitting normally */
    event.preventDefault();

    /* get the action attribute from the <form action=""> element */
    var $form = $( this ),
        url = $form.attr( 'action' );

    /* Send the data using post with element id name and name2*/
    $.post( url, { inputPassword: $('#forgot-password-new').val(), inputConfirmPassword: $('#forgot-password-renew').val() }, function ( data ) {
        data = jQuery.parseJSON( data );
        console.log(data);
        if (data.success) {
            $("#forgot-password-notification-err").css('display', 'none');
            $("#forgot-password-notification").css('display', 'block');
            setTimeout(function () {
                window.location.href = "/";
            }, 3000);
        } else {
            $('#reset-btn-submit').attr('disabled', false);
            $("#forgot-password-notification").css('display', 'none');
            $("#forgot-password-notification-err").css('display', 'block');
        }
        // return false;
    });
});