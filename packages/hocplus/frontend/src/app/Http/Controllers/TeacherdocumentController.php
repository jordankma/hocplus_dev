<?php

namespace Hocplus\Frontend\App\Http\Controllers;

use Auth;
use Storage;
use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\MController as Controller;
use Hocplus\Frontend\App\Models\Teacher;

class TeacherdocumentController extends Controller
{
    private function _guard()
    {
        return Auth::guard('teacher');
    }

    public function __construct()
    {
        parent::__construct();

        setcookie('static_root_path', 'public/files');
    }

    public function index(Request $request)
    {
        $teacher_id = $this->_guard()->id();
        $directory = 'public/files/hocplus/teacher/';

        $directories = Storage::disk('static')->directories($directory);
        if (!in_array($teacher_id, $directories)) {
            Storage::disk('static')->makeDirectory('hocplus/teacher/' . $teacher_id . '/documents');
        }
        setcookie('static_root_path', $directory . $teacher_id . '/documents');

        //
        $teacher_id = $this->_guard()->id();
        $teacher = Teacher::where('teacher_id', $teacher_id)->with('getClasses','getSubject.getClasses')->first();

        $data = [
            'teacher' => $teacher
        ];

        return view('HOCPLUS-FRONTEND::modules.frontend.teacher.document', $data);
    }
}
