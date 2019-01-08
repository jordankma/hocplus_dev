<?php

namespace Hocplus\Frontend\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;

class SubjectRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Hocplus\Frontend\App\Models\Subject';
    }

    public function findAll() {
        $result = $this->model
            ->select('subject_id', 'name')
            ->get();
        return $result;
    }
}
