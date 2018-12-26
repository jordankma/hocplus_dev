<?php
$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function() {
    Route::group(['middleware' => ['adtech.auth', 'adtech.acl']], function () {
    
        Route::group(['prefix' => 'vne/coursetemplate',], function (){
            Route::get('create', 'CourseTemplateController@create')->name('vne.coursetemplate.create');
            Route::post('add', 'CourseTemplateController@add')->name('vne.coursetemplate.add');
            Route::get('update', 'CourseTemplateController@update')->name('vne.coursetemplate.update');
            Route::post('edit', 'CourseTemplateController@edit')->name('vne.coursetemplate.edit');
            Route::get('manage', 'CourseTemplateController@manage')->name('vne.coursetemplate.manage')->where('as','Template Khóa học - Danh sách');
            Route::get('delete', 'CourseTemplateController@delete')->name('vne.coursetemplate.delete');
            Route::get('log', 'CourseTemplateController@log')->name('vne.coursetemplate.log');
            Route::get('find-teacher', 'CourseTemplateController@findTeacher')->name('vne.coursetemplate.findTeacher');
            Route::get('find-class-subject', 'CourseTemplateController@findClassSubject')->name('vne.coursetemplate.findClassSubject');
        });
    });
});