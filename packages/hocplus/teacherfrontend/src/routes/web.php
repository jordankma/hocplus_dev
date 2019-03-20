<?php
$prefix = '';
Route::group(array('prefix' => $prefix), function() {
    Route::get('/dang-ky-giang-vien', 'TeacherfrontendController@index')->name('hocplus.get.register.teacher');
    Route::post('/dang-ky-gv', 'TeacherfrontendController@save')->name('hocplus.post.register.teacher');
    Route::group(['middleware' => ['teacher.auth']], function () {
        Route::get('/bang-thong-tin/t', 'TeacherfrontendController@getDashboard')->name('hocplus.get.my.dashboard.teacher');
        Route::get('/khoa-hoc-cua-toi/t/{alias?}', 'TeacherfrontendController@getMyCourse')->name('hocplus.get.my.course.teacher');
        Route::get('/get-stream/t', 'TeacherfrontendController@getStream')->name('hocplus.get.stream.teacher');

        Route::get('/quan-ly-tai-khoan/{alias?}', 'TeacherfrontendController@getEditProfile')->name('hocplus.get.edit.profile.teacher');
        Route::post('/post/quan-ly-tai-khoan/t/{alias?}', 'TeacherfrontendController@postEditProfile')->name('hocplus.post.edit.profile.teacher');
    });   
    Route::group(['middleware' => ['member.auth']], function () {
        Route::get('/khoa-hoc-cua-toi/s/{alias?}', 'StudentfrontendController@getMyCourse')->name('hocplus.get.my.course.student');
    });
});