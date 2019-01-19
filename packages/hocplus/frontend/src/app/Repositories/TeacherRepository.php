<?php

namespace Hocplus\Frontend\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;

class TeacherRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Hocplus\Frontend\App\Models\Teacher';
    }

    public function findAll() {
        $result = $this->model->with('getClasses', 'getSubject')
            ->select('teacher_id', 'name', 'avatar_index', 'intro')
            ->where('status', 1)
            ->skip(0)->take(10)->get();
        return $result;
    }
}
