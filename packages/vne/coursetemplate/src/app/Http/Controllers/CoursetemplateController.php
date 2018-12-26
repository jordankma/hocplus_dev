<?php

namespace Vne\CourseTemplate\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Spatie\Activitylog\Models\Activity;
use Vne\CourseTemplate\App\Models\CourseTemplate;
use Validator;
use Vne\Classes\App\Models\Classes;
use Vne\Subject\App\Models\Subject;
use Vne\Teacher\App\Models\TeacherClassSubject;
use Vne\Teacher\App\Models\Teacher;
use DB;

class CoursetemplateController extends Controller
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
        //$classes = Classes::listClass();
        //$subjects = Subject::listSubject(); 
        $teachers = Teacher::orderBy('teacher_id', 'desc')->get()->toArray();
        return view('VNE-COURSETEMPLATE::modules.coursetemplate.create', compact('teachers'));
    }

    public function add(Request $request){       
        $validator = Validator::make($request->all(), [
            'template_name' => 'required',
            'template_avatar' => 'required',
            'classes' => 'required',            
            'teacher' => 'required'
        ], $this->messages);
        if ($validator->fails()) {
            return $validator->messages();
        } else {
            
            foreach($request->classes as $class){
                $classSubject = explode("-", $class);
                if(empty($classSubject)){
                    return redirect()->back()->with(['error' => 'Đã có lỗi xảy lúc chọn môn học, vui lòng thêm lại']);
                }
                if(empty($classSubject[0]) || empty($classSubject[1])){
                    return redirect()->back()->with(['error' => 'Đã có lỗi xảy lúc chọn môn học, vui lòng thêm lại']);
                }
            }
            
            //duyet mang oke
            
            foreach($request->classes as $class){
                $classSubject = explode("-", $class);
               
                $courseTemplate = CourseTemplate::create([
                    'template_name' => $request->template_name,
                    'template_avatar' => $request->template_avatar,
                    'template_video_intro' => $request->template_video_intro,
                    'will_learn' => $request->will_learn,
                    'target' => $request->target,
                    'request_content' => $request->request_content,
                    'summary' => $request->summary,
                    'is_hot' => $request->is_hot,
                    'teacher_id' => $request->teacher,
                    'classes_id' => $classSubject[0],
                    'subject_id' => $classSubject[1]
                ]);
                if($courseTemplate->course_template_id){
                    activity('hocplus_course_templates')
                    ->performedOn($courseTemplate)
                    ->withProperties($request->all())
                    ->log('Thêm template khóa học - course_template_id: '.$courseTemplate->course_template_id);                     
                } 
            }
            
            return redirect()->route('vne.coursetemplate.manage')->with(['success' => 'Tạo template khóa học thành công']);
                       
        }
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'course_template_id' => 'required'                    
        ], $this->messages);
        if($validator->fails()){
            return redirect()->back()->with(['error' => 'Không tìm thấy thông tin template khóa học']);  
        } else{
            $courseTemplate = CourseTemplate::findOrFail($request->course_template_id);
            $teachers = Teacher::orderBy('teacher_id', 'desc')->get()->toArray();            
                        
            $data = $this->_buildDataClassSubject($courseTemplate->teacher_id);           
            
            return view('VNE-COURSETEMPLATE::modules.coursetemplate.edit', compact('courseTemplate', 'teachers', 'data')); 
        }
    }

    public function edit(Request $request){
        
        $validator = Validator::make($request->all(), [
            'course_template_id' => 'required',
            'template_name' => 'required',
            'template_avatar' => 'required',
            'classes' => 'required',            
            'teacher' => 'required'
        ], $this->messages);
        if($validator->fails()){
            return $validator->messages();
        } else {
            $classSubject = explode("-", $request->classes[0]);
            
            $courseTemplate = CourseTemplate::findOrFail($request->course_template_id);
           
            //update
            $courseTemplate->template_name = $request->template_name;
            $courseTemplate->template_avatar = $request->template_avatar;
            $courseTemplate->template_video_intro = $request->template_video_intro;
            $courseTemplate->classes_id = $classSubject[0];
            $courseTemplate->subject_id = $classSubject[1];
            $courseTemplate->teacher_id = $request->teacher;
            $courseTemplate->will_learn = $request->will_learn;
            $courseTemplate->target = $request->target;
            $courseTemplate->request_content = $request->request_content;
            $courseTemplate->summary = $request->summary;
            $courseTemplate->is_hot = $request->is_hot;             
            $courseTemplate->save();
            
            activity('hocplus_course_templates')
                ->performedOn($courseTemplate)
                ->withProperties($request->all())
                ->log('Cập nhật template khóa học - course_template_id: '.$courseTemplate->course_template_id);
            return redirect()->route('vne.coursetemplate.manage')->with(['success' => 'Cập nhật template khóa học thành công']);
        }
         
    }

    public function manage(Request $request){
        $params = [
            'classes_id' => '',
            'subject_id' => '',
            'teacher_id' => '',
            'template_name' => ''
        ];
        $courseTemplates = CourseTemplate::customSearch($params);
        return view('VNE-COURSETEMPLATE::modules.coursetemplate.manage', compact('courseTemplates'));
    }

    public function delete(Request $request){
        $validator = Validator::make($request->all(), [
            'course_template_id' => 'required'           
        ], $this->messages);
        if($validator->fails()){
            return redirect()->back()->with(['error' => 'Xóa template khóa học không thành công']);  
        } else {
            $courseTemplate = CourseTemplate::findOrFail($request->course_template_id);
            $courseTemplate->deleted_at = date('Y-m-d H:i:s');
            $courseTemplate->save();
            activity('hocplus_course_templates')
                ->performedOn($courseTemplate)
                ->withProperties($request->all())
                ->log('Xóa template khóa học - course_template_id: '.$request->course_template_id);
            return redirect()->back()->with(['success' => 'Xóa template khóa học thành công']);
        }                
    }
    
    public function findTeacher(Request $request){
        if(empty($request->class_id) && empty($request->subject_id)){
            return response()->json([
                'status' => false,
                'msg' => 'Dữ liệu không hợp lệ'
            ]);
        } else {
            $params = [
              'classes_id' => !empty($request->class_id) ?   $request->class_id : 0,
              'subject_id' => !empty($request->subject_id) ?   $request->subject_id : 0,
            ];
            $teachers = TeacherClassSubject::findTeacher($params);
                        
            $html = view('VNE-COURSETEMPLATE::modules.coursetemplate._item_teacher', compact('teachers'));
            return response()->json([
                'status' => true,
                'msg' => 'Successfully',
                'html' => $html->render()
            ]);
        }   
    }
    
    public function findClassSubject(Request $request){
        try{
            if(empty($request->teacher_id)){
                throw new \Exception('Bạn chưa chọn giáo viên');
            } 
            $type = !empty($request->type) ? $request->type : 'edit';                     
            $data = $this->_buildDataClassSubject($request->teacher_id);
           
            $html = view('VNE-COURSETEMPLATE::modules.coursetemplate._item_class_subject', compact('data', 'type'));
            return response()->json([
                'status' => true,
                'msg' => 'Successfully',
                'html' => $html->render()
            ]);
            
        } catch (\Exception $e){
           return response()->json([
                'status' => false,
                'msg' => 'Lỗi: '.$e->getMessage(),                
            ]);
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
