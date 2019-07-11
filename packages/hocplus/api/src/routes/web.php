<?php

$apiPrefix = '/resource';
Route::group(array('prefix' => $apiPrefix), function () {
    Route::get('store-record-lesson', 'GlobalController@record');
    Route::get('verify-token', 'GlobalController@verify');
    Route::get('{route_hash}', 'GlobalController@get');

    Route::group(array('prefix' => 'api'), function () {
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout');
        Route::get('verify-token', 'LoginController@verify');
        Route::post('register', 'RegisterController@register');
        Route::post('forgot-password', 'ForgotPasswordController@forgotPassword');
        Route::post('change-password', 'ResetPasswordController@changePassword');
        

        Route::get('list-mycourse', 'CourseController@listMyCourse');
        Route::get('list-course', 'CourseController@listCourse');
        Route::get('detail-course', 'CourseController@detailCourse');
        Route::get('list-lesson-course', 'CourseController@listLessonCourse');
        Route::get('get-token-course', 'CourseController@getTokenCourse');

        Route::get('list-comment', 'CourseController@listCommentCourse');
        Route::post('post-comment', 'CourseController@postCommentCourse');

        Route::post('post-rating', 'CourseController@postRatingCourse');

    });
});