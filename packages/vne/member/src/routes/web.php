<?php
$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function() {
    Route::get('vne/member/member/check-username-exist', 'MemberController@checkUserNameExist')->name('vne.member.member.check-username-exist');
    Route::get('vne/member/member/check-email-exist', 'MemberController@checkEmailExist')->name('vne.member.member.check-email-exist');
    Route::get('vne/member/member/check-phone-exist', 'MemberController@checkPhoneExist')->name('vne.member.member.check-phone-exist');
    Route::group(['middleware' => ['adtech.auth', 'adtech.acl']], function () {
        Route::group(array('prefix' => 'vne/member/member'), function() {
            Route::get('log', 'MemberController@log')->name('vne.member.member.log');
            Route::get('data', 'MemberController@data')->name('vne.member.member.data');
            Route::get('data_student', 'MemberController@dataStudent')->name('vne.member.member.data.student');
            Route::get('data_parent', 'MemberController@dataParent')->name('vne.member.member.data.parent');
            Route::get('manage', 'MemberController@manage')->name('vne.member.member.manage')->where('as','Member - Danh sách');
            Route::get('manage_student', 'MemberController@manageStudent')->name('vne.member.member.manage.student')->where('as','Student - Danh sách');
            Route::get('manage_parent', 'MemberController@manageParent')->name('vne.member.member.manage.parent')->where('as','Parent - Danh sách');
            Route::get('create', 'MemberController@create')->name('vne.member.member.create');
            Route::post('add', 'MemberController@add')->name('vne.member.member.add');
            Route::get('show', 'MemberController@show')->name('vne.member.member.show');
            Route::post('update', 'MemberController@update')->name('vne.member.member.update');
            Route::get('delete', 'MemberController@delete')->name('vne.member.member.delete');
            Route::get('confirm-delete', 'MemberController@getModalDelete')->name('vne.member.member.confirm-delete');
        });
    });
});