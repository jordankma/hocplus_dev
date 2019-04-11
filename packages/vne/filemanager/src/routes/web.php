<?php

Route::group(array('prefix' => '/file-manager/'), function() {
    Route::group(['middleware' => ['adtech.auth']], function () {

//        config(['filesystems.disks.static.root' => 'public/files']);

        Route::get('initialize', 'FileManagerController@initialize')->name('vne.filemanager.initialize');

        Route::get('content', 'FileManagerController@content')->name('vne.filemanager.content');

        Route::get('tree', 'FileManagerController@tree')->name('vne.filemanager.tree');

        Route::get('select-disk', 'FileManagerController@selectDisk')->name('vne.filemanager.select-disk');

        Route::post('upload', 'FileManagerController@upload')->name('vne.filemanager.upload');

        Route::post('delete', 'FileManagerController@delete')->name('vne.filemanager.delete');

        Route::post('paste', 'FileManagerController@paste')->name('vne.filemanager.paste');

        Route::post('rename', 'FileManagerController@rename')->name('vne.filemanager.rename');

        Route::get('download', 'FileManagerController@download')->name('vne.filemanager.download');

        Route::get('thumbnails', 'FileManagerController@thumbnails')->name('vne.filemanager.thumbnails');

        Route::get('preview', 'FileManagerController@preview')->name('vne.filemanager.preview');

        Route::get('url', 'FileManagerController@url')->name('vne.filemanager.url');

        Route::post('create-directory', 'FileManagerController@createDirectory')->name('vne.filemanager.create-directory');

        Route::post('create-file', 'FileManagerController@createFile')->name('vne.filemanager.create-file');

        Route::post('update-file', 'FileManagerController@updateFile')->name('vne.filemanager.update-file');

        Route::get('stream-file', 'FileManagerController@streamFile')->name('vne.filemanager.stream-file');

        Route::post('zip', 'FileManagerController@zip')->name('vne.filemanager.zip');

        Route::post('unzip', 'FileManagerController@unzip')->name('vne.filemanager.unzip');

        // Route::get('properties', 'FileManagerController@properties');

        // Integration with editors
        Route::get('ckeditor', 'FileManagerController@ckeditor')->name('vne.filemanager.ckeditor');
        Route::get('manage', 'FileManagerController@manage')->name('vne.filemanager.manage');
    });
});

Route::group(array('prefix' => '/teacher-manager/'), function() {
    Route::group(['middleware' => ['teacher.auth']], function () {

//        config(['filesystems.disks.static.root' => 'public/files/hocplus/teacher/38']);

        Route::get('initialize', 'TeacherManagerController@initialize')->name('vne.filemanager.initialize');

        Route::get('content', 'TeacherManagerController@content')->name('vne.filemanager.content');

        Route::get('tree', 'TeacherManagerController@tree')->name('vne.filemanager.tree');

        Route::get('select-disk', 'TeacherManagerController@selectDisk')->name('vne.filemanager.select-disk');

        Route::post('upload', 'TeacherManagerController@upload')->name('vne.filemanager.upload');

        Route::post('delete', 'TeacherManagerController@delete')->name('vne.filemanager.delete');

        Route::post('paste', 'TeacherManagerController@paste')->name('vne.filemanager.paste');

        Route::post('rename', 'TeacherManagerController@rename')->name('vne.filemanager.rename');

        Route::get('download', 'TeacherManagerController@download')->name('vne.filemanager.download');

        Route::get('thumbnails', 'TeacherManagerController@thumbnails')->name('vne.filemanager.thumbnails');

        Route::get('preview', 'TeacherManagerController@preview')->name('vne.filemanager.preview');

        Route::get('url', 'TeacherManagerController@url')->name('vne.filemanager.url');

        Route::post('create-directory', 'TeacherManagerController@createDirectory')->name('vne.filemanager.create-directory');

        Route::post('create-file', 'TeacherManagerController@createFile')->name('vne.filemanager.create-file');

        Route::post('update-file', 'TeacherManagerController@updateFile')->name('vne.filemanager.update-file');

        Route::get('stream-file', 'TeacherManagerController@streamFile')->name('vne.filemanager.stream-file');

        Route::post('zip', 'TeacherManagerController@zip')->name('vne.filemanager.zip');

        Route::post('unzip', 'TeacherManagerController@unzip')->name('vne.filemanager.unzip');

        // Route::get('properties', 'FileManagerController@properties');

        // Integration with editors
        Route::get('ckeditor', 'TeacherManagerController@ckeditor')->name('vne.filemanager.ckeditor');
        Route::get('manage', 'TeacherManagerController@manage')->name('vne.filemanager.manage');
    });
});