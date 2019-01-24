<?php

namespace Hocplus\Teacherfrontend\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;

class NewsRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Hocplus\Teacherfrontend\App\Models\News';
    }

    public function findAll() {
        $result = $this->model
            ->select('news_id', 'title', 'image', 'desc')
            ->skip(0)->take(3)->get();
        return $result;
    }
}
