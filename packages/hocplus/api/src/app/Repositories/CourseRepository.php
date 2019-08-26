<?php

namespace Hocplus\Api\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\DB;

/**
 * Class DemoRepository
 * @package Hocplus\Api\Repositories
 */
class CourseRepository extends Repository
{

    /**
     * @return string
     */
    public function model()
    {
        return 'Hocplus\Api\App\Models\Course';
    }

    public function findAll() {

        $result = $this->model::query();
        return $result;
    }

    public function searchCourse($params){
        $timeNow = time();
        $query = $this->model->with('isTeacher');
        if (!empty($params['classes_id']) && $params['classes_id'] != null) {
            $query->where('classes_id',$params['classes_id']);    
        }
        if (!empty($params['subject_id']) && $params['subject_id'] != null) {
            $query->where('subject_id',$params['subject_id']);    
        }
        if ($params['type'] == 'early') {
            $query->where('date_start', 0);    
        }
        if ($params['type'] == 'now') {
            $query->where('date_start', '<', $timeNow)->where('date_end', '>', $timeNow);    
        }
        $result = $query->where('active',1)->where('status', 1)->paginate(20);
        return $result;
    }
}
