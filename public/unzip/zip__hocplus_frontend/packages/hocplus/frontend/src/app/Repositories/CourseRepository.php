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

    public function findAll() {
        $timeNow = time();
        $result = $this->model->with('isTeacher', 'isSubject', 'isClass', 'getLesson')
//            ->select('course_id', 'name', 'avartar', 'summary')
            ->whereHas('isTeacher', function ($query) { })
            ->whereHas('isSubject', function ($query) { })
            ->whereHas('isClass', function ($query) { })
            ->whereHas('getLesson', function ($query) { })
//            ->where('active', 1)
//            ->where('date_start', '>', $timeNow)
            ->skip(0)->take(10)->get();
        return $result;
    }
}
