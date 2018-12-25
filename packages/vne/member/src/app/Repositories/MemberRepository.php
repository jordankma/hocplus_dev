<?php

namespace Vne\Member\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\DB;

/**
 * Class MemberRepository
 * @package Vne\Member\Repositories
 */
class MemberRepository extends Repository
{

    /**
     * @return string
     */
    public function model()
    {
        return 'Vne\Member\App\Models\Member';
    }

    public function findAll() {

        $result = $this->model::query();
        return $result;
    }
}
