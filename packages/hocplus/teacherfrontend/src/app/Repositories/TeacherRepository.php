<?php

namespace Hocplus\Teacherfrontend\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;

class TeacherRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Hocplus\Teacherfrontend\App\Models\Teacher';
    }

    public function findAll() {
        $result = $this->model
            ->select('teacher_id', 'name', 'avatar_index', 'intro')
            ->where('status', 1)
            ->skip(0)->take(10)->get();
        return $result;
    }
}
