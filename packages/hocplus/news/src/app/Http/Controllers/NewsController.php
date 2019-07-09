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

class NewsController extends Controller
{
    private $messages = array(
        'name.regex' => "Sai định dạng",
        'required' => "Bắt buộc",
        'numeric'  => "Phải là số"
    );
    /*
     * danh sách tin
     */
    public function index() {
        $news = News::orderBy('created_at','DESC')->where('is_hot',2)->where('type_page','news')->paginate(10);
        $topnews = News::orderBy('views','DESC')->where('type_page','news')->limit(10)->get();
        $hotnews = News::where('is_hot',1)->where('type_page','news')->get()->first();
        if ($hotnews) {
            $features = News::where('is_hot',1)->where('type_page','news')->where('news_id','!=',$hotnews->news_id)->limit(4)->get();
        }
        else {
            $features = News::where('is_hot',1)->where('type_page','news')->limit(4)->get();
        }
        return view('HOCPLUS-NEWS::modules.news.index', compact('news','hotnews', 'topnews', 'features'));
    }
    /*
     * tin chi tiết
     */
    public function detail($news_id) {
        $news_id = intval($news_id);
        $news = News::find($news_id);
        //$user_id = $this->user->member_id;
        $member = $this->user;
        if ($member) {
            $user_id = $member->member_id;
        }
        else {
            $user_id = 0;
        }        
        if ($news) {
            $news->views = $news->views + 1;
            $news->save();
            $topnews = News::where('type_page','news')->orderBy('views','DESC')->limit(10)->get();    
            $comments = Comments::where('news_id','=',$news_id)->where('status',1)->orderBy('updated_at')->get();
            //print_r($comments[0]->getUser()); die();
            return view('HOCPLUS-NEWS::modules.news.detail', compact('news', 'topnews', 'comments', 'news_id', 'user_id'));
        }
        else {
            return redirect()->route('hocplus.frontend.index');
        }
    }
    
    public function tags($name)
    {
        $news = DB::table('vne_news')->join('vne_news_has_tag','vne_news.news_id','=','vne_news_has_tag.news_id')->join('vne_news_tag','vne_news_has_tag.news_tag_id','=','vne_news_tag.news_tag_id')->orderBy('vne_news.priority')->where('vne_news_tag.name','=',$name)->where('vne_news.deleted_at','=',NULL)->get();
        //print_r($news);
    }
}