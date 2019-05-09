<?php

namespace Hocplus\Coursegroup\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\MController as Controller;

use Hocplus\Coursegroup\App\Models\ES_Teacher;

use Auth,Validator;
class TeacherController extends Controller
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

    public function syncTeacher(Request $request){
        $limit = !empty($request->input('limit')) ? (int)$request->input('limit') : 2000;
        $list = ES_Teacher::where('sync_es', 1)->with('getClasses', 'getSubject')->take($limit)->get();
        if (!empty($list)) {
            try {
                $list->addToIndex();
                $arr = [];
                foreach ($list as $item){
                    $arr[] = $item->teacher_id;
                }
                if(ES_Teacher::whereIn('teacher_id',$arr)->update(['sync_es' => 2])){
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
    
    public function searchTeacher(Request $request){
        $teacher = [];
        // if ($request->ajax()) {
            if($request->has('q')){
                $params['name'] = $request->input('q');
                $offset = $request->has('offset') ? $request->input('offset') : 1;
                $limit = $request->has('limit') ? $request->input('limit') : 4 ;
                $list_teacher = ES_Teacher::customSearch($params, $offset, $limit);
                dd($list_teacher);
                foreach($list_teacher as $item){
                    $teacher[] = [
                        'name' => $item['name']
                    ];
                }
            }
        // }
        echo json_encode($teacher);
    }
}
