<?php
$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function() {
    Route::group(['middleware' => ['adtech.auth', 'adtech.acl']], function () {
        Route::group(['prefix' => 'vne/course',], function (){
            Route::get('create', 'CourseController@create')->name('vne.course.create');
            Route::post('add', 'CourseController@add')->name('vne.course.add');
            Route::get('update', 'CourseController@update')->name('vne.course.update');
            Route::post('edit', 'CourseController@edit')->name('vne.course.edit');
            Route::get('manage', 'CourseController@manage')->name('vne.course.manage')->where('as','Khóa học - Danh sách');
            Route::get('delete', 'CourseController@delete')->name('vne.course.delete');
            Route::get('log', 'CourseController@log')->name('vne.course.log');
            Route::get('find-template', 'CourseController@findTemplate')->name('vne.course.findTemplate');
            Route::get('preview-template', 'CourseController@previewTemplate')->name('vne.course.previewTemplate');
        });
        
        Route::group(['prefix' => 'vne/lesson',], function (){
            Route::get('create', 'LessonController@create')->name('vne.lesson.create');
            Route::post('add', 'LessonController@add')->name('vne.lesson.add');
            Route::get('update', 'LessonController@update')->name('vne.lesson.update');
            Route::post('edit', 'LessonController@edit')->name('vne.lesson.edit');
            Route::get('manage', 'LessonController@manage')->name('vne.lesson.manage')->where('as','Buổi học - Danh sách');
            Route::get('delete', 'LessonController@delete')->name('vne.lesson.delete');
            Route::get('log', 'LessonController@log')->name('vne.lesson.log');
           
        });
        
    });
});