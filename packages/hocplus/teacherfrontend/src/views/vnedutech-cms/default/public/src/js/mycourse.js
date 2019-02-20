const btnDelete = $('.js-btn-delete');
if (btnDelete) {

const btnDelete = $('.js-btn-delete');
const btnNo = $('.notification-delete .btn-no');
const body = $('body');
const ACTIVE_CLASS = 'notification-delete-active';
btnDelete.on('click', function () {
body.addClass(ACTIVE_CLASS);
return false;
});
btnNo.on('click', function () {
body.removeClass(ACTIVE_CLASS);
return false;
});
}
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