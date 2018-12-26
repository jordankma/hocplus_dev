<?php
$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function() {
    Route::group(['middleware' => ['adtech.auth', 'adtech.acl']], function () {

        Route::group(['prefix' => 'vne/templatelesson',], function (){
            Route::get('create', 'TemplateLessonController@create')->name('vne.templatelesson.create');
            Route::post('add', 'TemplateLessonController@add')->name('vne.templatelesson.add');
            Route::get('update', 'TemplateLessonController@update')->name('vne.templatelesson.update');
            Route::post('edit', 'TemplateLessonController@edit')->name('vne.templatelesson.edit');
            Route::get('manage', 'TemplateLessonController@manage')->name('vne.templatelesson.manage')->where('as','Template buổi học - Danh sách');
            Route::get('delete', 'TemplateLessonController@delete')->name('vne.templatelesson.delete');
            Route::get('log', 'TemplateLessonController@log')->name('vne.templatelesson.log');           
        });
    });
});