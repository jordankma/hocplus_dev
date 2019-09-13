<?php
$adminPrefix = '';
//$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function() {
    Route::get('hocplus/studentprofile/demo/log', 'DemoController@log')->name('hocplus.studentprofile.demo.log');
    Route::get('hocplus/studentprofile/demo/data', 'DemoController@data')->name('hocplus.studentprofile.demo.data');
    Route::get('hocplus/studentprofile/demo/manage', 'DemoController@manage')->name('hocplus.studentprofile.demo.manage');
    Route::get('hocplus/studentprofile/demo/create', 'DemoController@create')->name('hocplus.studentprofile.demo.create');
    Route::post('hocplus/studentprofile/demo/add', 'DemoController@add')->name('hocplus.studentprofile.demo.add');
    Route::get('hocplus/studentprofile/demo/show', 'DemoController@show')->name('hocplus.studentprofile.demo.show');
    Route::put('hocplus/studentprofile/demo/update', 'DemoController@update')->name('hocplus.studentprofile.demo.update');
    Route::get('hocplus/studentprofile/demo/delete', 'DemoController@delete')->name('hocplus.studentprofile.demo.delete');
    Route::get('hocplus/studentprofile/demo/confirm-delete', 'DemoController@getModalDelete')->name('hocplus.studentprofile.demo.confirm-delete');
    Route::any('ho-so-ca-nhan-hoc-sinh', 'StudentProfileController@index')->middleware('member.auth')->name('hocplus.studentprofile.index');
    Route::post('doi-mat-khau', 'StudentProfileController@changePassword')->middleware('member.auth')->name('hocplus.studentprofile.change-password');
    Route::get('avatar', 'StudentProfileController@avatar')->middleware('member.auth')->name('hocplus.studentprofile.avatar');
    Route::post('uploadfile', 'StudentProfileController@showUploadFile')->middleware('member.auth')->name('hocplus.studentprofile.showUploadFile');
    Route::get('khoa-hoc-da-thich', 'StudentProfileController@wishlist')->middleware('member.auth')->name('hocplus.studentprofile.khoa-hoc-cua-toi');
    Route::any('khoa-hoc-cua-toi', 'StudentProfileController@myCourse')->middleware('member.auth')->name('hocplus.studentprofile.bang-thong-tin');
    Route::any('quan-ly-binh-luan', 'StudentProfileController@myComment')->middleware('member.auth')->name('hocplus.studentprofile.binh-luan');
    Route::any('resource/api/ho-so-hoc-sinh', 'StudentProfileApiController@index')->name('hocplus.studentprofile.api.hosohocsinh');  
    Route::any('resource/api/profile', 'StudentProfileApiController@getinfo')->name('hocplus.studentprofile.api.profile');
    Route::any('resource/api/avatar', 'StudentProfileApiController@avatar')->name('hocplus.studentprofile.api.profile'); 
});