<?php

namespace Vne\Teacher\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Vne\Teacher\App\Repositories\TeacherRepository;
use Vne\Teacher\App\Models\Teacher;
use Spatie\Activitylog\Models\Activity;
use Yajra\Datatables\Datatables;
use Validator;

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
        return view('VNE-TEACHER::modules.teacher.teacher.create');
    }

    public function add(Request $request)
    {
        $teachers = new Teacher($request->all());
        $teachers->save();

        if ($teachers->teacher_id) {

            activity('teacher')
                ->performedOn($teachers)
                ->withProperties($request->all())
                ->log('User: :causer.email - Add teacher - name: :properties.name, teacher_id: ' . $teachers->teacher_id);

            return redirect()->route('vne.teacher.teacher.manage')->with('success', trans('vne-teacher::language.messages.success.create'));
        } else {
            return redirect()->route('vne.teacher.teacher.manage')->with('error', trans('vne-teacher::language.messages.error.create'));
        }
    }

    public function show(Request $request)
    {
        $teacher_id = $request->input('teacher_id');
        $teacher = $this->teacher->find($teacher_id);
        $data = [
            'teacher' => $teacher
        ];

        return view('VNE-TEACHER::modules.teacher.teacher.edit', $data);
    }

    public function update(Request $request)
    {
        $teacher_id = $request->input('teacher_id');

        $teacher = $this->teacher->find($teacher_id);
        $teacher->name = $request->input('name');

        if ($teacher->save()) {

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
        $confirm_route = $error = null;
        $validator = Validator::make($request->all(), [
            'teacher_id' => 'required|numeric',
        ], $this->messages);
        if (!$validator->fails()) {
            try {
                $confirm_route = route('vne.teacher.teacher.delete', ['teacher_id' => $request->input('teacher_id')]);
                return view('includes.modal_confirmation', compact('error', 'model', 'confirm_route'));
            } catch (GroupNotFoundException $e) {
                return view('includes.modal_confirmation', compact('error', 'model', 'confirm_route'));
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
                return view('includes.modal_table', compact('error', 'model', 'confirm_route', 'logs'));
            } catch (GroupNotFoundException $e) {
                return view('includes.modal_table', compact('error', 'model', 'confirm_route'));
            }
        } else {
            return $validator->messages();
        }
    }

    //Table Data to index page
    public function data()
    {
        return Datatables::of($this->teacher->findAll())
            ->addColumn('actions', function ($teachers) {
                $actions = '<a href=' . route('vne.teacher.teacher.log', ['type' => 'teacher', 'id' => $teachers->teacher_id]) . ' data-toggle="modal" data-target="#log"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#F99928" data-hc="#F99928" title="log teacher"></i></a>
                        <a href=' . route('vne.teacher.teacher.show', ['teacher_id' => $teachers->teacher_id]) . '><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update teacher"></i></a>
                        <a href=' . route('vne.teacher.teacher.confirm-delete', ['teacher_id' => $teachers->teacher_id]) . ' data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="trash" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete teacher"></i></a>';

                return $actions;
            })
            ->addIndexColumn()
            ->rawColumns(['actions'])
            ->make();
    }
}
