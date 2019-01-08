<?php

namespace Hocplus\Frontend\App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\MController as Controller;
use Hocplus\Frontend\App\Repositories\NewsRepository;
use Hocplus\Frontend\App\Repositories\CourseRepository;
use Hocplus\Frontend\App\Repositories\TeacherRepository;

class HomepageController extends Controller
{
    public function __construct(CourseRepository $courseRepository, TeacherRepository $teacherRepository, NewsRepository $newsRepository)
    {
        parent::__construct();
        $this->news = $newsRepository;
        $this->course = $courseRepository;
        $this->teacher = $teacherRepository;
    }

    public function index(Request $request)
    {
        $listNews = $this->news->findAll();
        $listCourse = $this->course->findAll();
        $listTeacher = $this->teacher->findAll();
        $data = [
            'listNews' => $listNews,
            'listCourse' => $listCourse,
            'listTeacher' => $listTeacher
        ];
        return view('HOCPLUS-FRONTEND::modules.frontend.homepage.index', $data);
    }
}
