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

    public function findAll($type=null) {
        if($type == null ){
            $result = $this->model::query();
        } else {
            $result = $this->model::where('type', $type)->get(); 
        }
        
        
        return $result;
    }
}
