<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hocplus\News\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Hocplus\News\App\Repositories\DemoRepository;
use Hocplus\News\App\Models\Demo;
use Spatie\Activitylog\Models\Activity;
use Yajra\Datatables\Datatables;
use Validator;

use Newsletter;

class NewsletterController extends Controller
{
    public function create() {
        return view('HOCPLUS-NEWS::modules.news.newsletter');
    }
    public function store(Request $request)
    {
        //echo $request->email; die;
        if ( ! Newsletter::isSubscribed($request->email) ) 
        {
            Newsletter::subscribePending($request->email);
            //echo "sucess";
            return redirect('newsletter')->with('success', 'Đăng ký nhận tin thành công');
        }
        return redirect('newsletter')->with('failure', 'Xin lỗi! Bạn đã đăng ký nhận tin');
        //echo "failure";    
    }
}