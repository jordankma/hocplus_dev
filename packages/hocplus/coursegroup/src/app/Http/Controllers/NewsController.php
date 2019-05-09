<?php

namespace Hocplus\Coursegroup\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\MController as Controller;

use Hocplus\Coursegroup\App\Models\ES_News;

use Auth,Validator;
class NewsController extends Controller
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

    public function syncNews(Request $request){
        $limit = !empty($request->input('limit')) ? (int)$request->input('limit') : 2000;
        $list = ES_News::where('sync_es', 1)->take($limit)->get();
        if (!empty($list)) {
            try {
                $list->addToIndex();
                $arr = [];
                foreach ($list as $item){
                    $arr[] = $item->news_id;
                }
                if(ES_News::whereIn('news_id',$arr)->update(['sync_es' => 2])){
                    echo "<pre>";
                    print_r( ' - done');
                    echo "</pre>";
                };
            } catch (\Exception $e) {
                echo "<pre>";
                print_r($e->getMessage());
                echo "</pre>";
                die;
            }
        } else {
            echo "<pre>";
            print_r('all done');
            echo "</pre>";
            die;
        }
    }
    
    public function searchNews(Request $request){
        $news = [];
        // if ($request->ajax()) {
            if($request->has('q')){
                $params['title'] = $request->input('q');
                $offset = $request->has('offset') ? $request->input('offset') : 1;
                $limit = $request->has('limit') ? $request->input('limit') : 4 ;
                $list_news = ES_News::customSearch($params, $offset, $limit);
                foreach($list_news as $item){
                    $news[] = [
                        'name' => $item['title'],
                        'image' => ($item['image'] != '' || file_exists(substr($item['image'], 1))) ? config('site.url_static') . $item['image'] : 'http://static.giaothonghocduong.com.vn/files/photos/phuon2.jpg',
                        'url' => route('hocplus.news.detail', $item['news_id'] . '-' . $item['title_alias'])
                    ];
                }
            }
        // }
        echo json_encode($news);
    }
}
