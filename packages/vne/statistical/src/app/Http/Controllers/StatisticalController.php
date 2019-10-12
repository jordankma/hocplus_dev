<?php

namespace Vne\Statistical\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Validator;
use Carbon\Carbon;
use Vne\Pay\App\Models\Transaction;
use Hocplus\Teacherfrontend\App\Models\Teacher;
use Vne\Classes\App\Models\Classes;
use Vne\Subject\App\Models\Subject;

class StatisticalController extends Controller
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

    public function index()
    {
        $data = [];
        $teachers = Teacher::get()->toArray();
        $subjects = Subject::get()->toArray();
        $classes = Classes::get()->toArray();
        return view('VNE-STATISTICAL::modules.statistical.index', compact('data', 'teachers', 'subjects', 'classes'));
    }

    public function search(Request $request)
    {
        $data = $this->customSearch($request);
        $teachers = Teacher::get()->toArray();
        $subjects = Subject::get()->toArray();
        $classes = Classes::get()->toArray();
        return view('VNE-STATISTICAL::modules.statistical.index', compact('data', 'teachers', 'subjects', 'classes'));
    }

    public function customSearch($params)
    {
        $query = Transaction::orderBy('transaction_id', 'desc');
        
        if(!empty($params['teacher_id']))
        {
            $query->where('teacher_id', $params['teacher_id']);
        }

        if(!empty($params['class_id']))
        {
            $query->where('class_id', $params['class_id']);
        }
        

        if(!empty($params['subject_id']))
        {
            $query->where('subject_id', $params['subject_id']);
        }

        if(!empty($params['method']))
        {
            $query->where('method', $params['method']);
        }
       
        if(!empty($params['start']))
        {
            $dateEnd = \Carbon\Carbon::now()->format('Y-m-d');
            if(!empty($params['start']))
            {
                $dateEnd = $params['end'];
            }
            $query->whereBetween('created_at', [$params['start'], $dateEnd]);
        }

        return $query->paginate(20)->appends($params->all());
    }
}

