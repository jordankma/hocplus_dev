<?php

namespace Hocplus\Coursegroup\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;

class CourseRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Hocplus\Coursegroup\App\Models\Course';
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
            ->paginate(3);
        return $result;
    }
}
