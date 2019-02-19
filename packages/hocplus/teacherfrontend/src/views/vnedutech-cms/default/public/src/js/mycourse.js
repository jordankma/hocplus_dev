$(document).ready(function () {
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
});