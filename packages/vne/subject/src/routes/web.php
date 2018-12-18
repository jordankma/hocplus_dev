<?php
$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function() {
    Route::group(['middleware' => ['adtech.auth', 'adtech.acl']], function () {

        Route::get('vne/subject/subject/log', 'SubjectController@log')->name('vne.subject.subject.log');
        Route::get('vne/subject/subject/data', 'SubjectController@data')->name('vne.subject.subject.data');
        Route::get('vne/subject/subject/manage', 'SubjectController@manage')->name('vne.subject.subject.manage')->where('as','Môn - Danh sách');
        Route::get('vne/subject/subject/create', 'SubjectController@create')->name('vne.subject.subject.create');
        Route::post('vne/subject/subject/add', 'SubjectController@add')->name('vne.subject.subject.add');
        Route::get('vne/subject/subject/show', 'SubjectController@show')->name('vne.subject.subject.show');
        Route::post('vne/subject/subject/update', 'SubjectController@update')->name('vne.subject.subject.update');
        Route::get('vne/subject/subject/delete', 'SubjectController@delete')->name('vne.subject.subject.delete');
        Route::get('vne/subject/subject/confirm-delete', 'SubjectController@getModalDelete')->name('vne.subject.subject.confirm-delete');

        Route::get('vne/subject/subject/list', 'SubjectController@getSubject')->name('vne.subject.subject.list');
    });
});