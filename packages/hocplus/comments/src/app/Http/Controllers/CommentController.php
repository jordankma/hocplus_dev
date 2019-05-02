<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hocplus\Comments\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\MController as Controller;
use Hocplus\Comments\App\Repositories\DemoRepository;
use Hocplus\Comments\App\Models\Demo;
use Hocplus\Comments\App\Models\Comments;
use Spatie\Activitylog\Models\Activity;
use Yajra\Datatables\Datatables;
use Validator;
use Auth;

class CommentController extends Controller
{
    /*
     * comments
    */
    public function comments(Request $request) {
        //$USER_LOGGED
        $USER_LOGGED = $this->user;
        if ($USER_LOGGED) {
            /*$validatedData = $request->validate([
                'comment' => 'required',
            ], $this->messages());*/
            $comments = New Comments();
            if ($request->news_id) {
                $comments->news_id = $request->news_id;
            }
            if ($request->course_id) {
                $comments->course_id = $request->course_id;
            }
            $comments->comment = $request->comment;
            $comments->user_id = Auth::guard('member')->user()->member_id;
            $action = $comments->save();
            if ($action) {
                /*echo "Thành công";
                if ($comments->news_id) {
                    return redirect('/news/detail/'.$comments->news_id);
                }
                else
                if ($comments->course_id) {
                    return redirect('/khoa-hoc/'.$comments->course_id);
                }                
                else {
                    return redirect('/index.php');
                }*/
                return 1;
            }
            else {
                return 0;
            }
        }
        else {
            //echo "Yêu cầu, bạn phải đăng nhập";
            return 0;
        }
    }
    /*
     * 
     * 
     */
        
    public function messages()
    {
        return [
            'comment.required'  => 'Bạn nhập vào bình luận',
        ];
    }
}