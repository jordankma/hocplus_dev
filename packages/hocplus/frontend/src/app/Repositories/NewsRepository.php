<?php

namespace Hocplus\Frontend\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;

class NewsRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Hocplus\Frontend\App\Models\News';
    }

    public function findForNews($catId = 1) {
        $result = $this->model->with('getCats')->orderBy('news_id', 'desc')
            ->whereHas('getCats', function ($query) use ($catId) {
                if ($catId != 0) $query->where('vne_news_has_cat.news_cat_id', $catId);
            })
            ->select('news_id', 'title', 'title_alias', 'image', 'desc')
            ->skip(0)->take(3)->get();
        return $result;
    }

    public function findForEval($catId = 2) {
        $result = $this->model->with('getCats')->orderBy('news_id', 'desc')
            ->whereHas('getCats', function ($query) use ($catId) {
                if ($catId != 0) $query->where('vne_news_has_cat.news_cat_id', $catId);
            })
            ->select('news_id', 'title', 'title_alias', 'image', 'desc')
            ->skip(0)->take(3)->get();
        return $result;
    }
}
