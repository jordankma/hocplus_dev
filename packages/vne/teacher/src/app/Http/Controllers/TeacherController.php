<?php

namespace Vne\Teacher\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Vne\Teacher\App\Repositories\TeacherRepository;
use Vne\Teacher\App\Models\Teacher;
use Vne\Teacher\App\Models\TeacherClassSubject;
use Spatie\Activitylog\Models\Activity;
use Yajra\Datatables\Datatables;
use Validator;

use Vne\Classes\App\Models\Classes;

class TeacherController extends Controller
{
    private $messages = array(
        'name.regex' => "Sai định dạng",
        'required' => "Bắt buộc",
        'numeric'  => "Phải là số"
    );

    public function __construct(TeacherRepository $teacherRepository)
    {
        parent::__construct();
        $this->teacher = $teacherRepository;
    }

    public function manage()
    {
        return view('VNE-TEACHER::modules.teacher.teacher.manage');
    }

    public function create()
    {
        $list_class = array();
        try {
            $list_class = Classes::with('getSubject')->get();
        } catch (\Throwable $th) {
            //throw $th;
        }
        $data = [
            'list_class' => $list_class
        ];
        return view('VNE-TEACHER::modules.teacher.teacher.create',$data);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], $this->messages);
        if (!$validator->fails()) {
            $class_subject = $request->input('class_subject');
            $teachers = new Teacher();
            $teachers->name = $request->input('name');
            $teachers->alias = str_slug( $request->input('name'), "-" );
            $teachers->phone = $request->input('phone');
            $teachers->email = $request->input('email');
            $teachers->intro = $request->input('intro');
            $teachers->year_graduation = $request->input('year_graduation');
            $teachers->address = $request->input('address');
            $teachers->facebook = $request->input('facebook');
            $teachers->experience = $request->input('experience');
            $teachers->workplace = $request->input('workplace');
            $teachers->avatar_index = $request->input('avatar_index');
            $teachers->avatar_detail = $request->input('avatar_detail');
            $teachers->video_intro = $request->input('video_intro');
            $teachers->achievements = $request->input('achievements');
            $teachers->rating = $request->input('rating');
            $teachers->degree = $request->input('degree');

            if ($teachers->save()) {
                if(!empty($class_subject)){
                    foreach($class_subject as $key => $value) {
                        $arr_temp = explode("-",$value);
                        $teacher_class_subject = new TeacherClassSubject();
                        $teacher_class_subject->classes_id =  $arr_temp[0];
                        $teacher_class_subject->subject_id =  $arr_temp[1];
                        $teacher_class_subject->teacher_id = $teachers->teacher_id;
                        $teacher_class_subject->save();
                    }
                }
                activity('teacher')
                    ->performedOn($teachers)
                    ->withProperties($request->all())
                    ->log('User: :causer.email - Add teacher - name: :properties.name, teacher_id: ' . $teachers->teacher_id);

                return redirect()->route('vne.teacher.teacher.manage')->with('success', trans('vne-teacher::language.messages.success.create'));
            } else {
                return redirect()->route('vne.teacher.teacher.manage')->with('error', trans('vne-teacher::language.messages.error.create'));
            }
        } else {
            return $validator->messages();
        }
    }

    public function show(Request $request)
    {
        $teacher_id = $request->input('teacher_id');
        
        $list_class_subject = TeacherClassSubject::where('teacher_id',$teacher_id)->get();
        $list_class = array();
        try {
            $list_class = Classes::with('getSubject')->get();
        } catch (\Throwable $th) {
            //throw $th;
        }
        $list_class_subject_arr = array();
        if(!empty($list_class_subject)){
            foreach($list_class_subject as $key => $value){
                $list_class_subject_arr[] = $value->classes_id . '-' . $value->subject_id;      
            }
        }
        $teacher = $this->teacher->find($teacher_id);
        $data = [
            'teacher' => $teacher,
            'list_class' => $list_class,
            'list_class_subject' => $list_class_subject,
            'list_class_subject_arr' => $list_class_subject_arr
        ];

        return view('VNE-TEACHER::modules.teacher.teacher.edit', $data);
    }

    public function update(Request $request)
    {
        $teacher_id = $request->input('teacher_id');
        $class_subject = $request->input('class_subject');
        $teacher = $this->teacher->find($teacher_id);
        $teacher->name = $request->input('name');
        $teacher->alias = str_slug( $request->input('name'), "-" );
        $teacher->phone = $request->input('phone');
        $teacher->email = $request->input('email');
        $teacher->intro = $request->input('intro');
        $teacher->year_graduation = $request->input('year_graduation');
        $teacher->address = $request->input('address');
        $teacher->facebook = $request->input('facebook');
        $teacher->experience = $request->input('experience');
        $teacher->workplace = $request->input('workplace');
        $teacher->avatar_index = $request->input('avatar_index');
        $teacher->avatar_detail = $request->input('avatar_detail');
        $teacher->achievements = $request->input('achievements');
        $teacher->rating = $request->input('rating');
        $teacher->degree = $request->input('degree');

        if ($teacher->save()) {
            TeacherClassSubject::where('teacher_id', $teacher->teacher_id)->delete();
            if(!empty($class_subject)){
                foreach($class_subject as $key => $value) {
                    $arr_temp = explode("-",$value);
                    $teacher_class_subject = new TeacherClassSubject();
                    $teacher_class_subject->classes_id =  $arr_temp[0];
                    $teacher_class_subject->subject_id =  $arr_temp[1];
                    $teacher_class_subject->teacher_id = $teacher->teacher_id;
                    $teacher_class_subject->save();
                }
            }
            activity('teacher')
                ->performedOn($teacher)
                ->withProperties($request->all())
                ->log('User: :causer.email - Update teacher - teacher_id: :properties.teacher_id, name: :properties.name');

            return redirect()->route('vne.teacher.teacher.manage')->with('success', trans('vne-teacher::language.messages.success.update'));
        } else {
            return redirect()->route('vne.teacher.teacher.show', ['teacher_id' => $request->input('teacher_id')])->with('error', trans('vne-teacher::language.messages.error.update'));
        }
    }
    
    public function getModalDelete(Request $request)
    {
        $model = 'teacher';
        $type = 'delete';
        $confirm_route = $error = null;
        $validator = Validator::make($request->all(), [
            'teacher_id' => 'required|numeric',
        ], $this->messages);
        if (!$validator->fails()) {
            try {
                $confirm_route = route('vne.teacher.teacher.delete', ['teacher_id' => $request->input('teacher_id')]);
                return view('VNE-TEACHER::modules.teacher.modal.modal_confirmation', compact('error', 'type', 'model', 'confirm_route'));
            } catch (GroupNotFoundException $e) {
                return view('VNE-TEACHER::modules.teacher.modal.modal_confirmation', compact('error', 'type', 'model', 'confirm_route'));
            }
        } else {
            return $validator->messages();
        }
    }

    public function delete(Request $request)
    {
        $teacher_id = $request->input('teacher_id');
        $teacher = $this->teacher->find($teacher_id);

        if (null != $teacher) {
            $this->teacher->delete($teacher_id);

            activity('teacher')
                ->performedOn($teacher)
                ->withProperties($request->all())
                ->log('User: :causer.email - Delete teacher - teacher_id: :properties.teacher_id, name: ' . $teacher->name);

            return redirect()->route('vne.teacher.teacher.manage')->with('success', trans('vne-teacher::language.messages.success.delete'));
        } else {
            return redirect()->route('vne.teacher.teacher.manage')->with('error', trans('vne-teacher::language.messages.error.delete'));
        }
    }  

    public function log(Request $request)
    {
        $model = 'teacher';
        $confirm_route = $error = null;
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'id' => 'required|numeric',
        ], $this->messages);
        if (!$validator->fails()) {
            try {
                $logs = Activity::where([
                    ['log_name', $model],
                    ['subject_id', $request->input('id')]
                ])->get();
                return view('VNE-TEACHER::modules.teacher.modal.modal_table', compact('error', 'model', 'confirm_route', 'logs'));
            } catch (GroupNotFoundException $e) {
                return view('VNE-TEACHER::modules.teacher.modal.modal_table', compact('error', 'model', 'confirm_route'));
            }
        } else {
            return $validator->messages();
        }
    }

    //Table Data to index page
    public function data()
    {
        $teachers = $this->teacher->findAll();
        return Datatables::of($teachers)
            ->addColumn('actions', function ($teachers) {
                $actions = '';
                if ($this->user->canAccess('vne.teacher.teacher.log')) {
                    $actions .= '<a href=' . route('vne.teacher.teacher.log', ['type' => 'teacher', 'id' => $teachers->teacher_id]) . ' data-toggle="modal" data-target="#log"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#F99928" data-hc="#F99928" title="log teacher"></i></a>';
                }
                if ($this->user->canAccess('vne.teacher.teacher.show')) {
                    $actions .= '<a href=' . route('vne.teacher.teacher.show', ['teacher_id' => $teachers->teacher_id]) . '><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update teacher"></i></a>';
                }        
                if ($this->user->canAccess('vne.teacher.teacher.confirm-delete')) {
                    $actions .= '<a href=' . route('vne.teacher.teacher.confirm-delete', ['teacher_id' => $teachers->teacher_id]) . ' data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="trash" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete teacher"></i></a>';
                }
                return $actions;
            })
            ->addIndexColumn()
            ->rawColumns(['actions'])
            ->make();
    }
}
