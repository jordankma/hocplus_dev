<?php
$prefix = '';
Route::group(array('prefix' => $prefix), function() {

    /*
     * auth - login
     */

    Route::name('hocplus.frontend.auth.')->group(function () {

        Route::match(['get', 'post'], 'login', 'Auth\LoginController@login')->name('login');

        Route::match(['get', 'post'], 'login-teacher', 'Auth\LoginController@loginTeacher')->name('login-teacher');

        Route::match(['get', 'post'], 'register', 'Auth\RegisterController@create')->name('register');

        Route::match(['get', 'post'], 'forgot-password', 'Auth\ForgotPasswordController@forgot')->name('forgot');

        Route::match(['get', 'post'], 'forgot-password-teacher', 'Auth\ForgotPasswordController@forgotTeacher')->name('forgot-teacher');

        Route::get('reset-password/{reset_token}', 'HomepageController@index')->name('hocplus.frontend.index');

        Route::match(['get', 'post'], 'verify-otp', 'Auth\ResetPasswordController@verifyOTP')->name('verify-otp');
        
        Route::match(['post'], 'reset-password/{reset_token}', 'Auth\ResetPasswordController@reset')->name('reset');

        Route::match(['post'], 'reset-password-teacher/{reset_token}', 'Auth\ResetPasswordController@resetTeacher')->name('reset-teacher');

        Route::get('logout', 'Auth\LoginController@logout')->name('logout');

        Route::get('send-otp-sms', 'Auth\SmsController@sendOtpSms')->name('send-otp-sms');

        // Route::group(['middleware' => ['member.auth']], function () {
            /*
             * Activate
             */
            Route::post('activate', 'Auth\ActivateController@activate')->name('activate');
            /*
             * Activate - Resend
             */
            Route::get('activate/resend', 'Auth\ActivateController@resend')->name('activate-resend');
            /*
             * Auth - Logout
             */
        // });
    });

    Route::group(array('prefix' => 'api'), function() {
        Route::get('/getCourse', 'HomepageController@getCourseComming')->name('hocplus.frontend.api.getCourse');
        Route::get('/getCourseRun', 'HomepageController@getCourseRunning')->name('hocplus.frontend.api.getCourseRun');
    });

    Route::get('/', 'HomepageController@index')->name('hocplus.frontend.index');

    Route::get('/filter-teacher-classes-subject', 'CreatecourseController@getClassesSubjectTeacher')->name('hocplus.frontend.create-course.filter');
    Route::group(['middleware' => ['teacher.auth']], function () {
        Route::any('/create-course', 'CreatecourseController@step1')->name('hocplus.frontend.create-course.step1');
        Route::any('/create-course-detail', 'CreatecourseController@step2')->name('hocplus.frontend.create-course.step2');
        Route::any('/create-course-review', 'CreatecourseController@step3')->name('hocplus.frontend.create-course.step3');
        Route::any('/public-course', 'CreatecourseController@step4')->name('hocplus.frontend.create-course.step4');

        Route::get('/document-manage', 'TeacherdocumentController@index')->name('hocplus.frontend.teacher.document');
    });
});