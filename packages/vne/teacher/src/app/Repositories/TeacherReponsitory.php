<?php

namespace Vne\Teacher\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\DB;

/**
 * Class TeacherRepository
 * @package Vne\Teacher\Repositories
 */
class TeacherRepository extends Repository
{

    /**
     * @return string
     */
    public function model()
    {
        return 'Vne\Teacher\App\Models\Teacher';
    }

    public function findAll() {

        $result = $this->model::query();
        return $result;
    }
}
