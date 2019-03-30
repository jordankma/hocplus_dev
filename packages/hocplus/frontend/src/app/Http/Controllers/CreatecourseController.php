<?php

namespace Hocplus\Frontend\App\Http\Controllers;

use Auth;
use Session;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Adtech\Application\Cms\Controllers\MController as Controller;
use Hocplus\Frontend\App\Models\Teacher;
use Hocplus\Frontend\App\Models\Lesson;
use Hocplus\Frontend\App\Models\Course;
use Hocplus\Frontend\App\Models\CourseTemplate;
use Hocplus\Frontend\App\Models\TemplateLesson;
use Hocplus\Frontend\App\Models\TeacherClassSubject;
use Hocplus\Frontend\App\Repositories\TeacherRepository;
use Hocplus\Frontend\App\Repositories\CourseRepository;

class CreatecourseController extends Controller
{
    private $_passwordResetRepository;

    private function _guard()
    {
        return Auth::guard('teacher');
    }

    public function __construct(CourseRepository $courseRepository, TeacherRepository $teacherRepository)
    {
        parent::__construct();
        $this->course = $courseRepository;
        $this->teacher = $teacherRepository;
    }

    public function step1(Request $request)
    {
        $tab = 0;
        $teacher_id = $this->_guard()->id();
        if ($request->isMethod('post')) {

            $tab = 1;
            $validator = Validator::make($request->all(), [
                'template_name' => 'required|string|max:191',
                'template_will_learn' => 'required|numeric',
                'template_target' => 'required|string',
                'template_request_content' => 'required|string',
                'template_subject_id' => 'required|numeric',
                'template_class_id' => 'required|numeric',
                'template_numlesson' => 'required|numeric',
                'template_timelesson' => 'required|numeric',
                'template_avatar' => 'image|mimes:jpeg,bmp,png|size:2000'
            ]);

            if ($validator->fails()) {
                Session::flash('error', $validator->messages()->first());
            }

            $template_avatar = '';
            if ($request->hasFile('template_avatar')) {
                $template_avatar = $request->file('template_avatar')->storeAs(
                    'hocplus/teacher/' . $teacher_id . '/avatars', Input::file('template_avatar')->getClientOriginalName());
            }

            $newTemplate = CourseTemplate::create([
                'template_name' => $request->input('template_name', ''),
                'template_avatar' => $template_avatar,
                'template_video_intro' => $request->input('template_video_intro', ''),
                'will_learn' => $request->input('template_will_learn', ''),
                'target' => $request->input('template_target', ''),
                'request_content' => $request->input('template_request_content', ''),
                'classes_id' => (int) $request->input('template_classes_id', 0),
                'subject_id' => (int) $request->input('template_subject_id', 0),
                'teacher_id' => $teacher_id,
                'time' => (int) $request->input('template_timelesson', 0),
                'number_lesson' => (int) $request->input('template_numlesson', 0),
                'summary' => $request->input('template_summary', ''),
                'keyword' => $request->input('template_keyword', ''),
                'document' => $request->input('template_document', '')
            ]);

            if ($newTemplate->course_template_id) {

                $arrLesson = [];
                $content_lesson = [];
                $template_numlesson = (int) $request->input('template_numlesson', 0);
                if ($template_numlesson > 0) {
                    for ($i = 1; $i <= $template_numlesson; $i++) {
                        $content_lesson[] = $request->input('posts-'.$i, '');
                    }
                    if (count($content_lesson) > 0) {
                        foreach ($content_lesson as $k => $content) {
                            $arrLesson[] = [
                                'name' => 'Buổi ' . ($k + 1),
                                'content' => $content,
                                'course_template_id' => $newTemplate->course_template_id
                            ];
                        }
                        TemplateLesson::insert($arrLesson);
                    }
                }

                return redirect(route('hocplus.frontend.create-course.step2') . '?id=' . $newTemplate->course_template_id);
            }
        }

        $teacher = Teacher::where('teacher_id', $teacher_id)->with('getClasses','getSubject.getClasses')->first();

        $allCourse = CourseTemplate::where('teacher_id', $teacher_id)->get();
        $arrClasses = $teacher->getClasses;
        $arrSubject = $teacher->getSubject;
        // dd($allCourse);
        $data = [
            'tab' => $tab,
            'teacher' => $teacher,
            'allCourse' => $allCourse,
            'arrClasses' => $arrClasses,
            'arrSubject' => $arrSubject,
        ];

        return view('HOCPLUS-FRONTEND::modules.frontend.create-course.step1', $data);
    }

    public function step2(Request $request)
    {
        $teacher_id = $this->_guard()->id();
        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'course_date_start' => 'required',
                'course_date_end' => 'required',
                'course_price' => 'required|numeric',
                'course_student_limit' => 'numeric',
                'course_template_id' => 'required|numeric',

            ]);

            if ($validator->fails()) {
                Session::flash('error', $validator->messages()->first());
            }

            $course_template_id = (int) $request->input('course_template_id', 0);
            $course_student_limit = (int) $request->input('course_student_limit', 0);
            $templateDetail = CourseTemplate::with('getTemplateLesson')->find($course_template_id);
            if ($templateDetail) {
                if ($templateDetail->teacher_id == $teacher_id) {

                    $arrDocuments = [];
                    if(!empty($request->course_documents)){
                        foreach ($request->course_documents as $document) {
                            $template_avatar = $document->storeAs(
                                'hocplus/teacher/' . $teacher_id . '/documents', $document->getClientOriginalName());

                            $arrDocuments[] = $template_avatar;
                        }
                    }

                    $newCourse = Course::create([
                        'name' => $templateDetail->template_name,
                        'alias' => $templateDetail->template_name,
                        'avartar' => $templateDetail->template_avatar,
                        'video' => $templateDetail->template_video_intro,
                        'will_learn' => $templateDetail->will_learn,
                        'target' => $templateDetail->target,
                        'request_content' => $templateDetail->request_content,
                        'classes_id' => $templateDetail->classes_id,
                        'subject_id' => $templateDetail->subject_id,
                        'teacher_id' => $templateDetail->teacher_id,
                        'keyword' => $templateDetail->keyword,
                        'document' => json_encode($arrDocuments),
                        'time' => $templateDetail->time,
                        'date_start' => strtotime($request->input('course_date_start')),
                        'date_end' => strtotime($request->input('course_date_end')),
                        'price' => (int) $request->input('course_price', 0),
                        'student_limit' => $course_student_limit,
                        'status' => 0,
                        'active' => 0
                    ]);

                    if ($newCourse->course_id) {
                        $arrLesson = [];
                        if ($course_student_limit > 0) {
                            if (count($templateDetail->getTemplateLesson) > 0) {
                                foreach ($templateDetail->getTemplateLesson as $k => $lesson_template) {

                                    $time_start = strtotime($request->input('exampleInputTemplateDateStart-' . $lesson_template->template_lesson_id) . ' ' . $request->input('exampleInputTemplateTimeStart-' . $lesson_template->template_lesson_id));
                                    $time_end = strtotime($request->input('exampleInputTemplateDateEnd-' . $lesson_template->template_lesson_id) . ' ' . $request->input('exampleInputTemplateTimeEnd-' . $lesson_template->template_lesson_id));

                                    $arrLesson[] = [
                                        'name' => $lesson_template->name,
                                        'content' => $lesson_template->content,
                                        'course_id' => $newCourse->course_id,
                                        'date_start' => $time_start,
                                        'time_line' => ($time_end - $time_start) / 60
                                    ];
                                }
                                Lesson::insert($arrLesson);
                            }
                        }

                        return redirect(route('hocplus.frontend.create-course.step3') . '?id=' . $newCourse->course_id);
                    }
                }
            }

        }

        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect(route('hocplus.frontend.create-course.step1'));
        }

        $course_template_id = $request->input('id');

        $templateDetail = CourseTemplate::where('course_template_id', $course_template_id)->with('getTemplateLesson')->first();
        if (!$templateDetail) {
            return redirect(route('hocplus.frontend.create-course.step1'));
        }
        if ($templateDetail->teacher_id != $teacher_id) {
            return redirect(route('hocplus.frontend.create-course.step1'));
        }

        $teacher = Teacher::where('teacher_id',$teacher_id)->with('getClasses','getSubject')->first();

        $data = [
            'teacher' => $teacher,
            'templateDetail' => $templateDetail,
            'course_template_id' => $course_template_id,
        ];

        return view('HOCPLUS-FRONTEND::modules.frontend.create-course.step2', $data);
    }

    public function step3(Request $request)
    {
        $course_id = $request->input('id');
        $teacher_id = $this->_guard()->id();

        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect(route('hocplus.frontend.create-course.step1'));
        }

        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'courseName' => 'required',
//                'courseSubject' => 'required',
//                'courseClasses' => 'required',
                'courseTime' => 'required|numeric',
                'courseStudentLimit' => 'required|numeric'
            ]);

            if ($validator->fails()) {
                Session::flash('error', $validator->messages()->first());
            } else {
                $courseName = $request->input('courseName', '');
//                $courseSubject = $request->input('courseSubject', '');
//                $courseClasses = $request->input('courseClasses', '');
                $courseVideo = $request->input('courseVideo', '');
                $courseWillLearn = $request->input('courseWillLearn', '');
                $courseTarget = $request->input('courseTarget', '');
                $courseRequestContent = $request->input('courseRequestContent', '');
                $courseTime = (int) $request->input('courseTime', 0);
                $courseStudentLimit = (int) $request->input('courseStudentLimit', 0);
                $lessonName = $request->input('lessonName', []);
                $lessonContent = $request->input('lessonContent', []);
                $lessonStart = $request->input('lessonStart', []);
                $lessonEnd = $request->input('lessonEnd', []);
                $courseDetail = Course::where('course_id',$course_id)->first();
                if ($courseDetail) {
                    if ($courseDetail->teacher_id == $teacher_id) {
                        Course::where('course_id', $course_id)
                            ->update([
                                'name' => $courseName,
                                'video' => $courseVideo,
                                'time' => $courseTime,
                                'will_learn' => $courseWillLearn,
                                'target' => $courseTarget,
                                'request_content' => $courseRequestContent,
                                'student_limit' => $courseStudentLimit
                            ]);

                        if (count($lessonName) > 0) {
                            Lesson::where('course_id', $course_id)->delete();
                            foreach ($lessonName as $k => $name) {

                                $content = $lessonContent[$k];
                                $timeStart = strtotime($lessonStart[$k]);
                                // dd($timeStart);
                                $timeEnd = strtotime($lessonEnd[$k]);

                                $arrLesson[] = [
                                    'name' => $name,
                                    'content' => $content,
                                    'course_id' => $course_id,
                                    'date_start' => $timeStart,
                                    'time_line' => ($timeEnd - $timeStart) / 60
                                ];
                            }
                            Lesson::insert($arrLesson);
                        }

                    }
                    return redirect(route('hocplus.frontend.create-course.step4') . '?id=' . $course_id);
                }
            }
        }

        $teacher = Teacher::where('teacher_id',$teacher_id)->with('getClasses','getSubject')->first();
        $courseDetail = Course::where('course_id',$course_id)->with('getLesson', 'isClass', 'isSubject')->first();
        $data = [
            'teacher' => $teacher,
            'course' => $courseDetail,
        ];

        return view('HOCPLUS-FRONTEND::modules.frontend.create-course.step3', $data);
    }

    public function step4(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect(route('hocplus.frontend.create-course.step1'));
        }

        $course_id = $request->input('id');
        $teacher_id = $this->_guard()->id();
        $courseDetail = Course::where('course_id',$course_id)->with('getLesson', 'isClass', 'isSubject')->first();

        if (!$courseDetail) {
            return redirect(route('hocplus.frontend.create-course.step1'));
        }
        if ($courseDetail->teacher_id != $teacher_id) {
            return redirect(route('hocplus.frontend.create-course.step1'));
        }

        Course::where('course_id', $course_id)->update(['status' => 1, 'active' => 1]);

        return redirect(route('hocplus.get.my.course.teacher'));
    }

    public function getClassesSubjectTeacher(Request $request) {

        $arrWhere = [];
        $teacher_id = (int) $request->input('teacher_id');
        $classes_id = (int) $request->input('classes_id');
        $subject_id = (int) $request->input('subject_id');

        if ($teacher_id != 0) {
            $arrWhere[] = ['teacher_id', $teacher_id];
        }
        if ($classes_id != 0) {
            $arrWhere[] = ['classes_id', $classes_id];
        }
        if ($subject_id != 0) {
            $arrWhere[] = ['subject_id', $subject_id];
        }

        $arrData = [];
        $filterArr = TeacherClassSubject::with('getTeacher', 'getSubject', 'getClasses')->where($arrWhere)->get();
        if ($filterArr) {
            if (count($filterArr) > 0) {
                foreach ($filterArr as $items) {
                    $item = new \stdClass();
                    $item->id = $items->getTeacher->teacher_id;
                    $item->name = $items->getTeacher->name;
                    $arrData['teacher'][] = $item;

                    $item = new \stdClass();
                    $item->id = $items->getSubject->subject_id;
                    $item->name = $items->getSubject->name;
                    $arrData['subject'][] = $item;

                    $item = new \stdClass();
                    $item->id = $items->getClasses->classes_id;
                    $item->name = $items->getClasses->name;
                    $arrData['classes'][] = $item;
                }
            }
        }
        return response($arrData)->setStatusCode(200)->header('Content-Type', 'application/json; charset=utf-8');
    }
}