<?php

namespace Vne\Course\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Spatie\Activitylog\Models\Activity;
use Vne\Course\App\Models\Course;
use Vne\Course\App\Models\Lesson;
use Validator;

class LessonController extends Controller
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
        if(empty($request->course_id)){
             return redirect()->back()->with(['error' => 'Không tìm thấy thông tin template buổi học']); 
        }                
        return view('VNE-COURSE::modules.course.lesson.create');
    }
    
    public function add(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'course_id' => 'required',
                    'content' => 'required',
                    'date_start' => 'required',
                    'ordinal' => 'required',
                ], $this->messages);
            if ($validator->fails()) {
                return $validator->messages();
            } else {
                foreach ($request->name as $i => $name) {
                    if (empty($name) || empty($request->content[$i])) {
                        return redirect()->back()->with(['error' => 'Thêm buổi học không thành công']);
                    }
                    $dataInsert[] = [
                        'name' => $name,
                        'course_id' => $request->course_id,
                        'content' => $request->content[$i],
                        'active' => $request->active[$i],
                        'ordinal' => $request->ordinal[$i],
                        'date_start' => strtotime($request->date_start[$i]),
                    ];
                }
                if (empty($dataInsert)) {
                    return redirect()->back()->with(['error' => 'Thêm buổi học không thành công']);
                }
                Lesson::insert($dataInsert);
                return redirect()->route('vne.lesson.manage', ['course_id' => $request->course_id])->with(['success' => 'Thêm buổi học thành công']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    
    public function update(Request $request){
        
        try{
            $validator = Validator::make($request->all(), [
                'lesson_id' => 'required'                    
            ], $this->messages);
            if($validator->fails()){
                return redirect()->back()->with(['error' => 'Không tìm thấy thông tin buổi học']);  
            } else {                
                $lesson = Lesson::findOrFail($request->lesson_id);                               
                return view('VNE-COURSE::modules.course.lesson.edit', compact('lesson'));
            }
            
        } catch(\Exception $e) {
             return redirect()->back()->with(['error' => $e->getMessage()]); 
        }
        
    }
    
    public function edit(Request $request){
        
         try{             
            $validator = Validator::make($request->all(), [
                'lesson_id' => 'required',
                'name' => 'required',                                
                'content' => 'required',
                'date_start' => 'required',
                'ordinal' => 'required',
                'course_id' => 'required'
            ], $this->messages);
            if($validator->fails()){                
                return redirect()->back()->with(['error' => 'Không tìm thấy thông tin buổi học']);  
            } else {
               
                $lesson = Lesson::findOrFail($request->lesson_id);
                $lesson->name = $request->name;                
                $lesson->content = $request->content;
                $lesson->active = $request->active;
                $lesson->ordinal = $request->ordinal;
                $lesson->date_start = strtotime($request->date_start);
                $lesson->save();
                 
                 activity('hocplus_lesson')
                ->performedOn($lesson)
                ->withProperties($request->all())
                ->log('Cập nhật buổi học - lesson_id: '.$lesson->lesson_id); 
                return redirect()->route('vne.lesson.manage', ['course_id' => $request->course_id])->with(['success' => 'Cập nhật buổi học thành công']);
            }
            
        } catch(\Exception $e) {
          
             return redirect()->back()->with(['error' => $e->getMessage()]); 
        }
    }
    
    public function manage(Request $request){
        
        if(empty($request->course_id)){
             return redirect()->back()->with(['error' => 'Không tìm thấy thông tin template buổi học']); 
        }
        $params = [
            'course_id' => !empty($request->course_id) ? $request->course_id : []
        ];
        
        $lessons = Lesson::customSearch($params);
             
        return view('VNE-COURSE::modules.course.lesson.manage', compact('lessons'));
    }
    
    public function delete(Request $request){
       
        $validator = Validator::make($request->all(), [
            'lesson_id' => 'required'           
        ], $this->messages);
        if($validator->fails()){
            return redirect()->back()->with(['error' => 'Xóa buổi học không thành công']);  
        } else {
            $lesson = Lesson::findOrFail($request->lesson_id);
            $lesson->deleted_at = date('Y-m-d H:i:s');
            $lesson->save();
            activity('hocplus_lesson')
                ->performedOn($lesson)
                ->withProperties($request->all())
                ->log('Xóa buổi học - lesson_id: '.$request->lesson_id);
            return redirect()->back()->with(['success' => 'Xóa buổi học thành công']);
        }
    }
}

