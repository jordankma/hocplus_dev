<?php
$prefix = '';
Route::group(array('prefix' => $prefix), function() {
    Route::get('/danh-sach-khoa-hoc', 'CourseGroupController@index')->name('hocplus.course.list');
    Route::get('/khoa-hoc/{course_id?}', 'CourseController@index')->name('hocplus.course.detail');
    Route::get('/get-stream', 'CourseController@getStream')->name('hocplus.course.get.stream');
    Route::get('course/delete', 'CourseController@getDelete')->name('hocplus.course.get.delete');

    Route::post('add-wishlist', 'CourseController@addWishlist')->name('hocplus.course.add.wishlist');

    Route::get('ajax/get-subject', 'CourseController@getSubject')->name('hocplus.course.ajax.get-subject');

    Route::get('sync-course', 'CourseController@syncCourse')->name('sync_course');
    Route::get('search-course', 'CourseController@searchCourse')->name('search_course');

    Route::get('sync-news', 'NewsController@syncNews')->name('sync_news');
    Route::get('search-news', 'NewsController@searchNews')->name('search_news');

    Route::get('sync-teacher', 'TeacherController@syncTeacher')->name('sync_teacher');
    Route::get('search-teacher', 'TeacherController@searchTeacher')->name('search_teacher');

    Route::get('tim-kiem', 'SearchController@search')->name('hocplus.search');
});