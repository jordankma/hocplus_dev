<?php

namespace Hocplus\Frontend\App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\MController as Controller;
use Hocplus\Frontend\App\Repositories\NewsRepository;
use Hocplus\Frontend\App\Repositories\CourseRepository;
use Hocplus\Frontend\App\Repositories\TeacherRepository;
use Hocplus\Frontend\App\Repositories\BannerRepository;

class HomepageController extends Controller
{
    public function __construct(CourseRepository $courseRepository, TeacherRepository $teacherRepository, NewsRepository $newsRepository, BannerRepository $bannerRepository)
    {
        parent::__construct();
        $this->news = $newsRepository;
        $this->course = $courseRepository;
        $this->banner = $bannerRepository;
        $this->teacher = $teacherRepository;
    }

    public function index(Request $request)
    {
        
        $listNews = $this->news->findForNews();
        $listEval = $this->news->findForEval();
        $listTeacher = $this->teacher->findAll();
        $listCourseRuning = $this->course->findRunning();
        $listCourseComming = $this->course->findComming();
        $allComming = $this->course->findAllComming();
        $allRunning = $this->course->findAllRunning();
        $bannerHome = $this->banner->findForBanner();
        $ads1Home = $this->banner->findForAds1();
        $whyHome = $this->banner->findForWhy();
        $libHome = $this->banner->findForLib();

        $arrSubjectComming = [];
        $arrClassesComming = [];
        $arrSubjectCommingID = [];
        $arrClassesCommingID = [];
        if (count($allComming) > 0) {
            foreach ($allComming as $result) {
                if (!in_array($result->isSubject->subject_id, $arrSubjectCommingID)) {
                    $arrSubjectCommingID[] = $result->isSubject->subject_id;
                    $arrSubjectComming[] = array('id' => $result->isSubject->subject_id, 'name' => $result->isSubject->name);
                }
                if (!in_array($result->isClass->classes_id, $arrClassesCommingID)) {
                    $arrClassesCommingID[] = $result->isClass->classes_id;
                    $arrClassesComming[] = array('id' => $result->isClass->classes_id, 'name' => $result->isClass->name);
                }
            }
        }
        asort($arrClassesComming);
        asort($arrSubjectComming);

        $arrSubjectRunning = [];
        $arrClassesRunning = [];
        $arrSubjectRunningID = [];
        $arrClassesRunningID = [];
        if (count($allRunning) > 0) {
            foreach ($allRunning as $result) {
                if (!in_array($result->isSubject->subject_id, $arrSubjectRunningID)) {
                    $arrSubjectRunningID[] = $result->isSubject->subject_id;
                    $arrSubjectRunning[] = array('id' => $result->isSubject->subject_id, 'name' => $result->isSubject->name);
                }
                if (!in_array($result->isClass->classes_id, $arrClassesRunningID)) {
                    $arrClassesRunningID[] = $result->isClass->classes_id;
                    $arrClassesRunning[] = array('id' => $result->isClass->classes_id, 'name' => $result->isClass->name);
                }
            }
        }
        asort($arrClassesRunning);
        asort($arrSubjectRunning);

        $data = [
            'libHome' => $libHome,
            'whyHome' => $whyHome,
            'ads1Home' => $ads1Home,
            'listEval' => $listEval,
            'listNews' => $listNews,
            'bannerHome' => $bannerHome,
            'listTeacher' => $listTeacher,
            'listCourseRuning' => $listCourseRuning,
            'listCourseComming' => $listCourseComming,
            'arrSubjectComming' => $arrSubjectComming,
            'arrClassesComming' => $arrClassesComming,
            'arrSubjectRunning' => $arrSubjectRunning,
            'arrClassesRunning' => $arrClassesRunning
        ];
        return view('HOCPLUS-FRONTEND::modules.frontend.homepage.index', $data);
    }

    public function getCourseComming(Request $request)
    {
        $classes_id = $request->input('classes_id');
        $subject_id = $request->input('subject_id');
        $listCourse = $this->course->findAllComming(0, $subject_id, $classes_id);
        $data = [
            'listCourse' => $listCourse
        ];
        return response()
            ->view('HOCPLUS-FRONTEND::modules.frontend.homepage._partial._course', $data, 200);
    }

    public function getCourseRunning(Request $request)
    {
        $classes_id = $request->input('classes_id');
        $subject_id = $request->input('subject_id');
        $listCourse = $this->course->findAllRunning(0, $subject_id, $classes_id);
        $data = [
            'listCourse' => $listCourse
        ];
        return response()
            ->view('HOCPLUS-FRONTEND::modules.frontend.homepage._partial._course', $data, 200);
    }
}
