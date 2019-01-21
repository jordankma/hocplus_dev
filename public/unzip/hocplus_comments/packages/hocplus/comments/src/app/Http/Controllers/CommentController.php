<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hocplus\Comments\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Hocplus\Comments\App\Repositories\DemoRepository;
use Hocplus\Comments\App\Models\Demo;
use Hocplus\Comments\App\Models\Comments;
use Spatie\Activitylog\Models\Activity;
use Yajra\Datatables\Datatables;
use Validator;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
        /*
     * comments
     */
    public function comments(Request $request) {
        if (Auth::check()) {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required',
                'comment' => 'required',
            ], $this->messages());
            $comments = New Comments();
            $comments->news_id = $request->news_id;
            $comments->name = $request->name;
            $comments->email = $request->email;
            $comments->comment = $request->comment;
            $comments->user_id = Auth::id();
            $action = $comments->save();
            if ($action) {
                echo "Thành công";
                return redirect('/news/detail/'.$comments->news_id);
            }
            else {
                echo "Lỗi";
            }
        }
        else {
            echo "Yêu cầu, bạn phải đăng nhập";
        }
    }
    
        
    public function messages()
    {
        return [
            'name.required' => 'Bạn nhập vào tên',
            'email.required'  => 'Bạn nhập vào email',
            'comment.required'  => 'Bạn nhập vào bình luận',
        ];
    }
}