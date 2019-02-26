<?php

namespace Hocplus\Frontend\App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\MController as Controller;
use Hocplus\Frontend\App\Models\Teacher;

class TeacherdocumentController extends Controller
{
    private function _guard()
    {
        return Auth::guard('teacher');
    }

    public function index(Request $request)
    {
        $teacher_id = $this->_guard()->id();
        $teacher = Teacher::where('teacher_id', $teacher_id)->with('getClasses','getSubject.getClasses')->first();

        $data = [
            'teacher' => $teacher
        ];

        return view('HOCPLUS-FRONTEND::modules.frontend.teacher.document', $data);
    }
}
