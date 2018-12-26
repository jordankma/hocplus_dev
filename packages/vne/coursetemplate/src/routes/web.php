<?php
$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function() {
    Route::group(['middleware' => ['adtech.auth', 'adtech.acl']], function () {
    
        Route::group(['prefix' => 'vne/coursetemplate',], function (){
            Route::get('create', 'CoursetemplateController@create')->name('vne.coursetemplate.create');
            Route::post('add', 'CoursetemplateController@add')->name('vne.coursetemplate.add');
            Route::get('update', 'CoursetemplateController@update')->name('vne.coursetemplate.update');
            Route::post('edit', 'CoursetemplateController@edit')->name('vne.coursetemplate.edit');
            Route::get('manage', 'CoursetemplateController@manage')->name('vne.coursetemplate.manage')->where('as','Template Khóa học - Danh sách');
            Route::get('delete', 'CoursetemplateController@delete')->name('vne.coursetemplate.delete');
            Route::get('log', 'CoursetemplateController@log')->name('vne.coursetemplate.log');
            Route::get('find-teacher', 'CoursetemplateController@findTeacher')->name('vne.coursetemplate.findTeacher');
            Route::get('find-class-subject', 'CoursetemplateController@findClassSubject')->name('vne.coursetemplate.findClassSubject');
        });
    });
});