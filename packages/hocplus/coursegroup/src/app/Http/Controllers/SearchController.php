<?php

namespace Hocplus\Coursegroup\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\MController as Controller;

use Hocplus\Coursegroup\App\Models\ES_Course;
use Hocplus\Coursegroup\App\Models\ES_News;

use Auth,Validator;
class SearchController extends Controller
{
    private $messages = array(
        'name.regex' => "Sai định dạng",
        'required' => "Bắt buộc",
        'numeric'  => "Phải là số"
    );

    public function __construct()
    {
        parent::__construct();
    }

    public function search(Request $request){
        $keyword = $request->has('keyword') ? $request->input('keyword') : '';
        $page = $request->has('page') ? $request->input('page') : 1 ;
        $limit = $request->has('limit') ? $request->input('limit') : 6 ;

        $params_course['name'] = $keyword;
        $params_news['title'] = $keyword;

        $es_course = new ES_Course();
        $list_courses = $es_course->paginateSearch($params_course, $page, $limit);
        $es_news = new ES_News();
        $list_news = $es_news->paginateSearch($params_news, $page, $limit);
        $data = [
            'list_courses' => $list_courses,
            'list_news' => $list_news,
            'keyword' => $keyword

        ];
        // dd($data);
        return view('HOCPLUS-COURSEGROUP::modules.frontend.search.search',$data);
    }
}
