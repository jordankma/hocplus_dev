<?php

namespace Vne\Classes\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\DB;

/**
 * Class ClassesRepository
 * @package Vne\Classes\Repositories
 */
class ClassesRepository extends Repository
{

    /**
     * @return string
     */
    public function model()
    {
        return 'Vne\Classes\App\Models\Classes';
    }

    public function findAll() {

        DB::statement(DB::raw('set @rownum=0'));
        $result = $this->model::query();
        $result->select('vne_classes.*', DB::raw('@rownum  := @rownum  + 1 AS rownum'));
        return $result;
    }

}
