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
        $result = $this->model->with('isTeacher', 'isSubject', 'isClass', 'getLesson')->orderBy('course_id','desc')
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

    public function search($params){
        $timeNow = time();
        $query = $this->model->with('isTeacher', 'isSubject', 'isClass', 'getLesson')->orderBy('course_id','desc');
        if (!empty($params['classes_id']) && $params['classes_id'] != null && $params['classes_id'] != '0') {
            $query->where('classes_id',$params['classes_id']);    
        }
        if (!empty($params['subject_id']) && $params['subject_id'] != null && $params['subject_id'] != '0') {
            $query->where('subject_id',$params['subject_id']);    
        }
        if (!empty($params['course_early']) && $params['course_early'] != null) {
            $query->where('date_start', '>', $timeNow);    
        }
        if (!empty($params['course_now']) && $params['course_now'] != null) {
            $query->where('date_start', '<', $timeNow)->where('date_end', '>', $timeNow);    
        }
        if (!empty($params['sort']) && $params['sort'] != null) {
            switch ($params['sort']) {
                case 'new':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'old':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'price_up':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_down':
                    $query->orderBy('price', 'desc');
                    break;
            }   
        }
        $result = $query->paginate(3);
        return $result;
    }

}
