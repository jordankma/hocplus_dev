<?php

namespace Hocplus\Coursegroup\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\MController as Controller;

use Hocplus\Coursegroup\App\Models\Subject;
use Hocplus\Coursegroup\App\Models\Classes;
use Hocplus\Coursegroup\App\Models\Banner;
use Hocplus\Coursegroup\App\Repositories\CourseRepository;

class CourseGroupController extends Controller
{
    public function __construct(CourseRepository $courseRepository)
    {
        parent::__construct();
        $this->course = $courseRepository;
    }

    public function index(Request $request, $subject_id = null, $classes_id = null)
    {
        $list_subjects = Subject::select('subject_id', 'name', 'icon')->get();
        $list_classes = Classes::select('classes_id', 'name')->get();
        $list_banners = Banner::select('banner_id', 'name','link','image')->where('position',1)->orderBy('priority','desc')->get();

        $listCourse = array();
        $params = $request->all();
        if(count($params) == 0){
            $listCourse = $this->course->findAll();
        } else{
            $listCourse = $this->course->search($params);    
        }
        // dd($listCourse);
        $data = [
            'list_subjects' => $list_subjects,   
            'list_classes' => $list_classes,   
            'list_banners' => $list_banners,   
            'listCourse' => $listCourse,   
            'params' => $params   
        ];
        return view('HOCPLUS-COURSEGROUP::modules.frontend.course-group.index',$data);
    }
}
