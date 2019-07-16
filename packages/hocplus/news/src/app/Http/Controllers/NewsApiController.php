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
    public function index(Request $request) {
        $all = News::all();
        $total = count($all); 
        //echo $total; die;
        $news = News::paginate(10);
        $page= ($request->input('page')>0)?$request->input('page'):1;
        //return response()->json($news);
        $data = array();
        foreach ($news as $item) {
                $data[] = array(
                'id' => $item->news_id,
                'title' => $item->title,
                'image' => 'http://static.hocplus.vn'.$item->image,
                'desc' => $item->desc,
                'view' => $item->views);
        }
        $result = array(
            'data' => $data,
            "success" => true,
            "message" => "ok!",
            "page" => $page,
            "totalpage" => round($total/10)+1            
            );
		return response()->json($result);
    }
    
    public function detail(Request $request) {
		$news_id = ($request->input('news_id')>0)?$request->input('news_id'):0;
        $news_id = intval($news_id);
        $news = News::find($news_id);  
        $data = array();
        //foreach ($news as $item) {
        $data['id'] = $news->news_id;
        $data['title'] = $news->title;
        $data['image'] = 'http://static.hocplus.vn'.$news->image;
        $data['desc'] = $news->desc;
        $data['view'] = $news->views;
        //}
        $result = array('data' => $data,
            "success" => true,
            "message" => "ok!",
            "page" => 1,
            "totalpage" => 1 
            );
        return $result;
    }
}