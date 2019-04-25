<?php

namespace Hocplus\Rating\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\DB;

/**
 * Class DemoRepository
 * @package Hocplus\Rating\Repositories
 */
class DemoRepository extends Repository
{

    /**
     * @return string
     */
    public function model()
    {
        return 'Hocplus\Rating\App\Models\Demo';
    }

    public function findAll() {

        $result = $this->model::query();
        return $result;
    }
}
