<?php

namespace Vne\Templatelesson\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Vne\Templatelesson\App\Models\Demo;
use Spatie\Activitylog\Models\Activity;
use Vne\Classes\App\Models\Classes;
use Vne\Subject\App\Models\Subject;
use Vne\Coursetemplate\App\Models\CourseTemplate;
use Vne\Templatelesson\App\Models\TemplateLesson;
use Validator;

class TemplateLessonController extends Controller
{
    private $messages = array(        
        'required' => "Bắt buộc",
        'numeric'  => "Phải là số"
    );

    public function __construct()
    {
        parent::__construct();        
    }

    public function create(Request $request){
        if(empty($request->course_template_id)){
             return redirect()->back()->with(['error' => 'Không tìm thấy thông tin template buổi học']); 
        }                
        return view('VNE-TEMPLATELESSON::modules.templatelesson.create');
    }
    
    public function add(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                        'template_lesson_name' => 'required',
                        'course_template_id' => 'required',
                        'content' => 'required'
                            ], $this->messages);
            if ($validator->fails()) {
                return $validator->messages();
            } else {
                foreach ($request->template_lesson_name as $i => $name) {
                    if (empty($name) || empty($request->content[$i])) {
                        return redirect()->back()->with(['error' => 'Thêm template buổi học không thành công']);
                    }
                    $dataInsert[] = [
                        'name' => $name,
                        'course_template_id' => $request->course_template_id,
                        'content' => $request->content[$i],
                        'active' => $request->active[$i]
                    ];
                }
                if (empty($dataInsert)) {
                    return redirect()->back()->with(['error' => 'Thêm template buổi học không thành công']);
                }
                TemplateLesson::insert($dataInsert);
                return redirect()->route('vne.templatelesson.manage', ['course_template_id' => $request->course_template_id])->with(['success' => 'Thêm template buổi học thành công']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    
    public function update(Request $request){
        
        try{
            $validator = Validator::make($request->all(), [
                'template_lesson_id' => 'required'                    
            ], $this->messages);
            if($validator->fails()){
                return redirect()->back()->with(['error' => 'Không tìm thấy thông tin template buổi học']);  
            } else {
                
                $template = TemplateLesson::findOrFail($request->template_lesson_id);
                $courseTemplates = CourseTemplate::customSearch([]);
                $classes = Classes::listClass();
                $subjects = Subject::listSubject();
                
                return view('VNE-TEMPLATELESSON::modules.templatelesson.edit', compact('template', 'courseTemplates', 'classes', 'subjects'));
            }
            
        } catch(\Exception $e) {
             return redirect()->back()->with(['error' => $e->getMessage()]); 
        }
        
    }
    
    public function edit(Request $request){
        
         try{             
            $validator = Validator::make($request->all(), [
                'template_lesson_id' => 'required',
                'template_lesson_name' => 'required',                
                'course_template_id' => 'required',
                'content' => 'required'
            ], $this->messages);
            if($validator->fails()){
                
                return redirect()->back()->with(['error' => 'Không tìm thấy thông tin template buổi học']);  
            } else {
               
                $template = TemplateLesson::findOrFail($request->template_lesson_id);
                $template->name = $request->template_lesson_name;                
                $template->content = $request->content;
                $template->active = $request->active;
                $template->course_template_id = $request->course_template_id;
                $template->save();
                 
                 activity('hocplus_template_lesson')
                ->performedOn($template)
                ->withProperties($request->all())
                ->log('Cập nhật template buổi học - template_lesson_id: '.$template->template_lesson_id); 
                return redirect()->route('vne.templatelesson.manage', ['course_template_id' => $request->course_template_id])->with(['success' => 'Cập nhật template buổi học thành công']);
            }
            
        } catch(\Exception $e) {
          
             return redirect()->back()->with(['error' => $e->getMessage()]); 
        }
    }
    
    public function manage(Request $request){
        if(empty($request->course_template_id)){
             return redirect()->back()->with(['error' => 'Không tìm thấy thông tin template buổi học']); 
        }
        $params = [
            'course_template_id' => !empty($request->course_template_id) ? $request->course_template_id : []
        ];
        $templates = TemplateLesson::customSearch($params);        
        return view('VNE-TEMPLATELESSON::modules.templatelesson.manage', compact('templates'));
    }
    
    public function delete(Request $request){
        $validator = Validator::make($request->all(), [
            'template_lesson_id' => 'required'           
        ], $this->messages);
        if($validator->fails()){
            return redirect()->back()->with(['error' => 'Xóa template buổi học không thành công']);  
        } else {
            $template = TemplateLesson::findOrFail($request->template_lesson_id);
            $template->deleted_at = date('Y-m-d H:i:s');
            $template->save();
            activity('hocplus_template_lesson')
                ->performedOn($template)
                ->withProperties($request->all())
                ->log('Xóa template buổi học - template_lesson_id: '.$request->template_lesson_id);
            return redirect()->back()->with(['success' => 'Xóa template buổi học thành công']);
        }
    }
}

