<?php

namespace Hocplus\Frontend\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\MController as Controller;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        return view('HOCPLUS-FRONTEND::modules.frontend.course.index');
    }
}
