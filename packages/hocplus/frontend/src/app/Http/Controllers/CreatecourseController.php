<?php

namespace Hocplus\Frontend\App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\MController as Controller;
use Hocplus\Frontend\App\Models\Teacher;

class CreatecourseController extends Controller
{
    private $_passwordResetRepository;

    private function _guard()
    {
        return Auth::guard('teacher');
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $teacher_id = $this->_guard()->id();
        $teacher = Teacher::where('teacher_id',$teacher_id)->with('getClasses','getSubject')->first();

        $data = [
            'teacher' => $teacher,
        ];

        return view('HOCPLUS-FRONTEND::modules.frontend.create-course.index', $data);
    }
}
