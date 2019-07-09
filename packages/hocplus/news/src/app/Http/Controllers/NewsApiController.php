<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hocplus\News\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\MController as Controller;
use Hocplus\News\App\Repositories\DemoRepository;
use Hocplus\News\App\Models\Demo;
use Hocplus\News\App\Models\News;
use Hocplus\News\App\Models\Comments;
use Spatie\Activitylog\Models\Activity;
use Yajra\Datatables\Datatables;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Hocplus\Teacher\App\Models\Subject;

class NewsApiController extends Controller
{

    /*
     * danh sách tin
     */
    public function index() {
        $news = News::paginate(10);
        //return response()->json($news);
		$data = array();
		foreach ($news as $item) {
			$data[]['id'] = $item->news_id;
			$data[]['title'] = $item->title;
			$data[]['image'] = $item->image;
			$data[]['desc'] = $item->desc;
			$data[]['view'] = $item->views;
		}
        $result = array('data' => $data);
		return $result;
    }
    
    public function detail($news_id) {
        $news_id = intval($news_id);
        $news = News::find($news_id);  
		$data = array();
		//foreach ($news as $item) {
			$data['id'] = $news->news_id;
			$data['title'] = $news->title;
			$data['image'] = $news->image;
			$data['desc'] = $news->desc;
			$data['view'] = $news->views;
		//}
        $result = array('data' => $data);
        return $result;
    }
}