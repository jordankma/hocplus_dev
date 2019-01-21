<?php

namespace Hocplus\News\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\DB;

/**
 * Class DemoRepository
 * @package Hocplus\News\Repositories
 */
class DemoRepository extends Repository
{

    /**
     * @return string
     */
    public function model()
    {
        return 'Hocplus\News\App\Models\Demo';
    }

    public function findAll() {
        $result = $this->model::query();
        return $result;
    }
}
