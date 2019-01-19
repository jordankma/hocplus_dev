<?php

namespace Hocplus\Frontend\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;

class CourseRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Hocplus\Frontend\App\Models\Course';
    }

//    public function findAllFilterComming($teacherId = 0, $subjectId = 0, $classId = 0) {
//        $timeNow = time();
//        $result = $this->model->with('isTeacher', 'isSubject', 'isClass', 'getLesson')
//            ->select('subject_id', 'classes_id')
//            ->whereHas('isTeacher', function ($query) use ($teacherId) {
//                if ($teacherId != 0) $query->where('hocplus_course.teacher_id', $teacherId);
//            })
//            ->whereHas('isSubject', function ($query) use ($subjectId) {
//                if ($subjectId != 0) $query->where('hocplus_course.subject_id', $subjectId);
//            })
//            ->whereHas('isClass', function ($query) use ($classId) {
//                if ($classId != 0) $query->where('hocplus_course.classes_id', $classId);
//            })
//            ->whereHas('getLesson', function ($query) { })
//            ->where('active', 1)
//            ->where('date_start', '>', $timeNow)
//            ->groupBy('subject_id', 'classes_id')
//            ->get();
//        return $result;
//    }
//
//    public function findAllFilterRunning($teacherId = 0, $subjectId = 0, $classId = 0) {
//        $timeNow = time();
//        $result = $this->model->with('isTeacher', 'isSubject', 'isClass', 'getLesson')
//            ->select('subject_id', 'classes_id', 'subject.name as subject_name', 'classes.name as classes_name')
//            ->whereHas('isTeacher', function ($query) use ($teacherId) {
//                if ($teacherId != 0) $query->where('hocplus_course.teacher_id', $teacherId);
//            })
//            ->whereHas('isSubject', function ($query) use ($subjectId) {
//                if ($subjectId != 0) $query->where('hocplus_course.subject_id', $subjectId);
//            })
//            ->whereHas('isClass', function ($query) use ($classId) {
//                if ($classId != 0) $query->where('hocplus_course.classes_id', $classId);
//            })
//            ->whereHas('getLesson', function ($query) { })
//            ->where('date_start', '<', $timeNow)
//            ->where('date_end', '>', $timeNow)
//            ->where('active', 1)
//            ->groupBy('subject_id', 'classes_id')
//            ->get();
//        return $result;
//    }

    public function findAllComming($teacherId = 0, $subjectId = 0, $classId = 0) {
        $timeNow = time();
        $result = $this->model->with('isTeacher', 'isSubject', 'isClass', 'getLesson')
            ->whereHas('isTeacher', function ($query) use ($teacherId) {
                if ($teacherId != 0) $query->where('hocplus_course.teacher_id', $teacherId);
            })
            ->whereHas('isSubject', function ($query) use ($subjectId) {
                if ($subjectId != 0) $query->where('hocplus_course.subject_id', $subjectId);
            })
            ->whereHas('isClass', function ($query) use ($classId) {
                if ($classId != 0) $query->where('hocplus_course.classes_id', $classId);
            })
            ->whereHas('getLesson', function ($query) { })
            ->where('active', 1)
            ->where('date_start', '>', $timeNow)
            ->get();
        return $result;
    }

    public function findComming($teacherId = 0, $subjectId = 0, $classId = 0) {
        $timeNow = time();
        $result = $this->model->with('isTeacher', 'isSubject', 'isClass', 'getLesson')
            ->whereHas('isTeacher', function ($query) use ($teacherId) {
                if ($teacherId != 0) $query->where('hocplus_course.teacher_id', $teacherId);
            })
            ->whereHas('isSubject', function ($query) use ($subjectId) {
                if ($subjectId != 0) $query->where('hocplus_course.subject_id', $subjectId);
            })
            ->whereHas('isClass', function ($query) use ($classId) {
                if ($classId != 0) $query->where('hocplus_course.classes_id', $classId);
            })
            ->whereHas('getLesson', function ($query) { })
            ->where('active', 1)
            ->where('date_start', '>', $timeNow)
            ->skip(0)->take(10)->get();
        return $result;
    }

    public function findAllRunning($teacherId = 0, $subjectId = 0, $classId = 0) {
        $timeNow = time();
        $result = $this->model->with('isTeacher', 'isSubject', 'isClass', 'getLesson')
            ->whereHas('isTeacher', function ($query) use ($teacherId) {
                if ($teacherId != 0) $query->where('hocplus_course.teacher_id', $teacherId);
            })
            ->whereHas('isSubject', function ($query) use ($subjectId) {
                if ($subjectId != 0) $query->where('hocplus_course.subject_id', $subjectId);
            })
            ->whereHas('isClass', function ($query) use ($classId) {
                if ($classId != 0) $query->where('hocplus_course.classes_id', $classId);
            })
            ->whereHas('getLesson', function ($query) { })
            ->where('date_start', '<', $timeNow)
            ->where('date_end', '>', $timeNow)
            ->where('active', 1)
            ->get();
        return $result;
    }

    public function findRunning($teacherId = 0, $subjectId = 0, $classId = 0) {
        $timeNow = time();
        $result = $this->model->with('isTeacher', 'isSubject', 'isClass', 'getLesson')
            ->whereHas('isTeacher', function ($query) use ($teacherId) {
                if ($teacherId != 0) $query->where('hocplus_course.teacher_id', $teacherId);
            })
            ->whereHas('isSubject', function ($query) use ($subjectId) {
                if ($subjectId != 0) $query->where('hocplus_course.subject_id', $subjectId);
            })
            ->whereHas('isClass', function ($query) use ($classId) {
                if ($classId != 0) $query->where('hocplus_course.classes_id', $classId);
            })
            ->whereHas('getLesson', function ($query) { })
            ->where('date_start', '<', $timeNow)
            ->where('date_end', '>', $timeNow)
            ->where('active', 1)
            ->skip(0)->take(10)->get();
        return $result;
    }
}
