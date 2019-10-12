<?php

namespace Vne\Course\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Vne\Course\App\Models\Course;
use Vne\Coursetemplate\App\Models\CourseTemplate;
use Vne\Classes\App\Models\Classes;
use Vne\Subject\App\Models\Subject;
use Vne\Templatelesson\App\Models\TemplateLesson;
use Vne\Course\App\Models\Lesson;
use Vne\Teacher\App\Models\TeacherClassSubject;
use Vne\Teacher\App\Models\Teacher;
use Spatie\Activitylog\Models\Activity;
use Validator;
use DB;

class CourseController extends Controller
{
    private $messages = array(       
        'required' => "Bắt buộc",
        'numeric'  => "Phải là số"
    );
    
    public function __construct()
    {
        parent::__construct();       
    }
    
    public function create(){
        $courseTemplates = CourseTemplate::customSearch([]);
        $classes = Classes::listClass();
        $subjects = Subject::listSubject(); 
        return view('VNE-COURSE::modules.course.create', compact('courseTemplates', 'classes', 'subjects'));
    }
    
    public function add(Request $request){
        try {           
            $validator = Validator::make($request->all(), [
                'type' => 'required',
                'course' => 'required'                               
            ], $this->messages);
            if ($validator->fails()) {
                throw new \Exception('Bạn chưa nhập đầy đủ thông tin');
            } else {
                
                $item = $request->course; 
                $date_start = $item['date_start']. ' ' . (isset($item['time_start']) ? $item['time_start'] : '00:00');
                $date_end = $item['date_end']. ' ' .(isset($item['time_end']) ? $item['time_end'] : '00:00');
                $classSubject = explode("-", $item['classes']);
                $dataInsert = [
                    'student_limit' => $item['student_limit'],
                    'time' => $item['time'],
                    'price' => $item['price'],
                    'date_start' => strtotime($date_start),
                    'date_end' => strtotime($date_end),                   
                    'active' => $item['active'],
                    'discount' => $item['discount'],
                    'discount_exp' => strtotime($item['discount_exp']),
                    'alias' => str_slug($item['name'], '-'),
                    'name' => $item['name'],
                    'avartar' => $item['avartar'],
                    'teacher_id' => $item['teacher_id'],
                    'video' => $item['video'],
                    'summary' => $item['summary'],                   
                    'will_learn' => $item['will_learn'],
                    'target' => $item['target'],
                    'request_content' => $item['request_content'],
                    'classes_id' =>  $classSubject[0],
                    'subject_id' =>  $classSubject[1],

                ];
                
                if(!empty($dataInsert)){
                    $course = Course::create($dataInsert);
                    if($course->course_id){
                        activity('hocplus_course')->performedOn($course)->withProperties($request->all())->log('Tạo khóa học - course_id: '.$course->course_id); 
                        
                        //update template Course
                        if($request->type == 'saveToTemplate'){
                            $template = CourseTemplate::findOrFail($item['course_template_id']);
                            $template->template_name = $course->name;
                            $template->template_avatar = $course->avartar;
                            $template->template_video_intro = $course->video;
                            $template->will_learn = $course->will_learn;
                            $template->target = $course->target;
                            $template->request_content = $course->request_content;
                            $template->summary = $course->summary;
                            $template->is_hot = $course->is_hot;
                            $template->classes_id = $course->classes_id;
                            $template->subject_id = $course->subject_id;
                            $template->teacher_id = $course->teacher_id;
                            $template->save();
                        }
                        
                        //insert lesson
                        $dataLesson = $request->lesson;
                        
                        $totalLesson = 0;
                        if(!empty($dataLesson['lesson_name'])){
                            foreach($dataLesson['lesson_name'] as $i => $lesson){
                                $totalLesson = $totalLesson + 1;
                                $insertLesson[] = [
                                    'name' => $lesson,
                                    'content' => $dataLesson['lesson_content'][$i],
                                    'date_start' => strtotime($dataLesson['lesson_date_start'][$i]),
                                    'active' => $dataLesson['lesson_active'][$i],
                                    'course_id' => $course->course_id,
                                    'ordinal' => $dataLesson['lesson_ordinal'][$i],
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'time_line' => $dataLesson['lesson_time_line'][$i]
                                ];

                                if($request->type == 'saveToTemplate'){
                                    TemplateLesson::where(['template_lesson_id' => $dataLesson['lesson_template_id'][$i]])->update([
                                        'name' => $lesson,
                                        'content' => $dataLesson['lesson_content'][$i],
                                        'active' => $dataLesson['lesson_active'][$i],
                                        'course_template_id' => $item['course_template_id'],
                                        'updated_at' => date('Y-m-d H:i:s'),
                                        'time_line' => $dataLesson['lesson_time_line'][$i]
                                    ]);
                                }
                            }

                            if(!empty($insertLesson)){
                                DB::table('hocplus_lesson')->insert($insertLesson); 
                                $course->number_lesson = $totalLesson; 
                                $course->save();
                            }
                        }
                        
                        
                        return response()->json([
                            'status' => true,
                            'msg' => 'Tạo khóa học thành công',
                            'redirect' => route('vne.course.manage')
                        ]);
                        
                    } else{
                        throw new \Exception('Tạo khóa học không thành công');
                    }
                }
               
                
            }
            
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'msg' => 'Lỗi: '.$ex->getMessage(),
                
            ]);
        }
                    
    }
    
    public function edit(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'course_id' => 'required',
                'name' => 'required',
                'date_start' => 'required|date_format:Y-m-d',
                'date_end' => 'required|date_format:Y-m-d|after_or_equal:date_start',
                'avartar' => 'required',
                'teacher' => 'required',
                'classes' => 'required',
                'student_limit' => 'required|numeric',
                'time' => 'required',
                'price' => 'required|numeric',
            ], $this->messages);
        if($validator->fails()){
            return redirect()->back()->with(['error' => $validator->errors()->first()]);  
        } else{
            $classSubject = explode("-", $request['classes']);
             
            $course = Course::findOrFail($request->course_id);
            $course->name  = $request->name;
            $course->alias  = str_slug($request->name, '-');
            $course->date_start  = strtotime($request->date_start);
            $course->date_end  = strtotime($request->date_end);
            $course->avartar  = $request->avartar;
            $course->teacher_id  = $request->teacher;
            $course->classes_id  = $classSubject[0];
            $course->subject_id  = $classSubject[1];
            $course->student_limit  = $request->student_limit;
            $course->time  = $request->time;
            $course->price  = $request->price;
            $course->summary  = $request->summary;
            $course->target  = $request->target;
            $course->will_learn  = $request->will_learn;
            $course->request_content  = $request->request_content;
            $course->active  = $request->active;
            $course->status  = $request->status;
            $course->discount  = $request->discount;
            $course->discount_exp  = !empty($request->discount_exp) ? strtotime($request->discount_exp) : 0;
            $course->save();
            activity('hocplus_course')->performedOn($course)->withProperties($request->all())->log('Cập nhật khóa học - course_id: '.$course->course_id); 
            return redirect()->route('vne.course.manage')->with(['success' => 'Cập nhật khóa học thành công']);
        }
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()]);  
        }
         
    }
    
    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required'           
        ], $this->messages);
        if($validator->fails()){
            return redirect()->back()->with(['error' => 'Không tìm thấy thông tin khóa học']);  
        } else {
            $course = Course::find($request->course_id);
            
            $teachers = Teacher::orderBy('teacher_id', 'desc')->get()->toArray();  
            
            $data = $this->_buildDataClassSubject($course->teacher_id);           
            return view('VNE-COURSE::modules.course.edit', compact('course', 'data', 'teachers'));
        }
    }
    
    public function manage(Request $request)
    {

        $params = [
            'name' => @$request->name_course,
            'teacher_id' => @$request->teacher
        ];
        $courses = Course::customSearch($params);
        
        $teachers = Teacher::orderBy('teacher_id', 'desc')->get()->toArray();
        return view('VNE-COURSE::modules.course.manage', compact('courses', 'teachers'));
    }
    
    public function delete(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required'           
        ], $this->messages);
        if($validator->fails()){
            return redirect()->back()->with(['error' => 'Xóa khóa học không thành công']);  
        } else {
            $course = Course::findOrFail($request->course_id);
            $course->deleted_at = date('Y-m-d H:i:s');
            $course->save();
            activity('hocplus_course')
                ->performedOn($course)
                ->withProperties($request->all())
                ->log('Xóa khóa học - course_id: '.$request->course_id);
            return redirect()->back()->with(['success' => 'Xóa  khóa học thành công']);
        }   
    }
    
    public function findTemplate(Request $request){
        $params = [
            'classes_id' => !empty($request->classes_id) ? $request->classes_id : 0,
            'subject_id' => !empty($request->subject_id) ? $request->subject_id : 0,
            'teacher_id' => !empty($request->teacher_id) ? $request->teacher_id : 0,
        ];        
        $templates = CourseTemplate::customSearch($params);
        $html = view('VNE-COURSE::modules.course._item_template', compact('templates'));
        $paginate = view('VNE-COURSE::modules.course._item_template_paginate', compact('templates'));
        return response()->json([
            'status' => true,
            'html' => $html->render(),
            'paginate' => $paginate->render()
        ]);
    }
    
    public function previewTemplate(Request $request){
        try {
            if(empty($request->template_couse_id)){
                throw new \Exception('Bạn chưa chọn template khóa học');
            }
            $courseTemplate = CourseTemplate::findOrFail($request->template_couse_id);
            $teachers = Teacher::orderBy('teacher_id', 'desc')->get()->toArray();  
            
            $data = $this->_buildDataClassSubject($courseTemplate->teacher_id);
                        
            $html = view('VNE-COURSE::modules.course._preview', compact('courseTemplate', 'data', 'teachers'));
            return response()->json([
                'status' => true,
                'html' => $html->render()               
            ]);
        } catch (\Exception $ex) {
            
            return response()->json([
                'status' => false,
                'msg' => 'Lỗi: '. $ex->getMessage()
            ]);
        }
    }
    
    public function getLessonTemplate(Request $request){
        try {          
            if(empty($request->template_id)){
                 throw new \Exception('Bạn chưa chọn template khóa học'); 
            } 
            $params = [
                'course_template_id' => $request->template_id,
                'sort' => 'asc'
            ];
            
            $lessons = TemplateLesson::customSearch($params);
            $courseTemplateId = $request->template_id;
            $html = view('VNE-COURSE::modules.course._item_lesson', compact('lessons', 'courseTemplateId'));
            return response()->json([
                'status' => true,
                'msg' => 'successfully',
                'html' => $html->render()
            ]);
        } catch (\Exception $ex) {
            
        }
    }        
    
    public function _buildDataClassSubject($teacher_id){
        $teacher = Teacher::findOrFail($teacher_id);
        $classes = $teacher->getClasses ? $teacher->getClasses->toArray() : [];
        $subjects = $teacher->getSubject ? $teacher->getSubject->toArray() : [];
        $data = [];
        foreach($classes as $class){
            if(!empty($class['get_subject'])){
                $data[$class['classes_id']] = [
                    'name' => $class['name']                        
                ];
                foreach($class['get_subject'] as $subject){                        
                    foreach($subjects as $sub){
                        if($sub['classes_id'] == $class['classes_id'] && $sub['subject_id'] == $subject['subject_id']){
                            $data[$class['classes_id']]['subject'][$sub['subject_id']] = ['name' => $subject['name']];
                        }
                    }                                               
                }
            }
        }
        return $data;
    }        
}
