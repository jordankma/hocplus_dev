<?php
$adminPrefix = '';
//$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function() {

    Route::get('hocplus/comments/demo/log', 'DemoController@log')->name('hocplus.comments.demo.log');
    Route::get('hocplus/comments/demo/data', 'DemoController@data')->name('hocplus.comments.demo.data');
    Route::get('hocplus/comments/demo/manage', 'DemoController@manage')->name('hocplus.comments.demo.manage');
    Route::get('hocplus/comments/demo/create', 'DemoController@create')->name('hocplus.comments.demo.create');
    Route::post('hocplus/comments/demo/add', 'DemoController@add')->name('hocplus.comments.demo.add');
    Route::get('hocplus/comments/demo/show', 'DemoController@show')->name('hocplus.comments.demo.show');
    Route::put('hocplus/comments/demo/update', 'DemoController@update')->name('hocplus.comments.demo.update');
    Route::get('hocplus/comments/demo/delete', 'DemoController@delete')->name('hocplus.comments.demo.delete');
    Route::get('hocplus/comments/demo/confirm-delete', 'DemoController@getModalDelete')->name('hocplus.comments.demo.confirm-delete');
});
Route::post('comments', 'CommentController@comments')->middleware('member.auth')->name('hocplus.comments.comments');
