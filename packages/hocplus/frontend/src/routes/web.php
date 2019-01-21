<?php
$prefix = '';
Route::group(array('prefix' => $prefix), function() {

    /*
     * auth - login
     */

    Route::name('hocplus.frontend.auth.')->group(function () {

        Route::match(['get', 'post'], 'login', 'Auth\LoginController@login')->name('login');

        Route::match(['get', 'post'], 'register', 'Auth\RegisterController@create')->name('register');

        Route::match(['get', 'post'], 'forgot-password', 'Auth\ForgotPasswordController@forgot')->name('forgot');

        Route::match(['get', 'post'], 'reset-password/{reset_token}', 'Auth\ResetPasswordController@reset')->name('reset');

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
            Route::get('logout', 'Auth\LoginController@logout')->name('logout');
        });
    });

    Route::group(array('prefix' => 'api'), function() {
        Route::get('/getCourse', 'HomepageController@getCourseComming')->name('hocplus.frontend.api.getCourse');
        Route::get('/getCourseRun', 'HomepageController@getCourseRunning')->name('hocplus.frontend.api.getCourseRun');
    });

    Route::get('/', 'HomepageController@index')->name('hocplus.frontend.index');
});