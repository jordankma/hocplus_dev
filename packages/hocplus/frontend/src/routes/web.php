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

        Route::get('reset-password/{reset_token}', 'HomepageController@index')->name('hocplus.frontend.index');

        Route::match(['post'], 'reset-password/{reset_token}', 'Auth\ResetPasswordController@reset')->name('reset');

        Route::get('logout', 'Auth\LoginController@logout')->name('logout');

        Route::group(['middleware' => ['member.auth']], function () {
            /*
             * Activate
             */
            Route::get('activate/{token}', 'ActivateController@activate')->name('activate');
            /*
             * Activate - Resend
             */
            Route::get('activate/resend', 'ActivateController@resend')->name('activate-resend');
            /*
             * Auth - Logout
             */
        });
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
        Route::get('/create-course-review', 'CreatecourseController@step3')->name('hocplus.frontend.create-course.step3');
        Route::get('/public-course', 'CreatecourseController@step4')->name('hocplus.frontend.create-course.step4');

        Route::get('/document-manage', 'TeacherdocumentController@index')->name('hocplus.frontend.teacher.document');
    });
});