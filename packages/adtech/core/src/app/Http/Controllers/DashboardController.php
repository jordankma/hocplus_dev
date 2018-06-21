<?php

namespace Adtech\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Adtech\Core\App\Http\Requests\UploadRequest;
use Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $users = $blogs = [];
//        $request->session()->forget('tab');
        $analytics_error = $pageVisits = $blog_count = $visitors = $user_count = $month_visits = $year_visits = rand(100, 1000);
        return view('ADTECH-CORE::modules.core.dashboard.index',
            compact('analytics_error', 'users', 'blogs', 'pageVisits', 'blog_count', 'visitors', 'user_count', 'month_visits', 'year_visits'));
    }

    public function filemanage()
    {
        return view('ADTECH-CORE::modules.core.file.manage');
    }

    public function fileuploadtest(UploadRequest $request)
    {
        if ($request->isMethod('post')) {
            if ($request->hasFile('file_upload')) {

                dd(shell_exec('cd ../ && ftp 123.30.174.148'));
                die;
            }
        }
        return view('ADTECH-CORE::modules.core.file.upload');
    }
}
