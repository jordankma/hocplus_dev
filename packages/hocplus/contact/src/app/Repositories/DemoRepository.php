<?php

namespace Hocplus\Contact\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\DB;

/**
 * Class DemoRepository
 * @package Hocplus\Contact\Repositories
 */
class DemoRepository extends Repository
{

    /**
     * @return string
     */
    public function model()
    {
        return 'Hocplus\Contact\App\Models\Demo';
    }

    public function findAll() {

        $result = $this->model::query();
        return $result;
    }
}
