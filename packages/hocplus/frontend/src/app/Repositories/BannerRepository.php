<?php

namespace Hocplus\Frontend\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;

class BannerRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Hocplus\Frontend\App\Models\Banner';
    }

    public function findForBanner() {
        $result = $this->model->where('position', 2)->get();
        return $result;
    }

    public function findForWhy() {
        $result = $this->model->where('position', 3)->skip(0)->take(5)->get();
        return $result;
    }

    public function findForAds1() {
        $result = $this->model->where('position', 4)->first();
        return $result;
    }

//    public function findForAds2() {
//        $result = $this->model->where('position', 5)->first();
//        return $result;
//    }

    public function findForLib() {
        $result = $this->model->where('position', 5)->get();
        return $result;
    }
}
