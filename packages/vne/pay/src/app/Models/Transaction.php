<?php

namespace Vne\Pay\App\Models;

use Illuminate\Database\Eloquent\Model;
use Vne\Pay\App\Models\Course;
use Auth;
class Transaction extends Model {    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_transactions';

    protected $primaryKey = 'transaction_id';    
    
    protected $fillable = ['order_code', 'member_id', 'course_id', 'money_payment', 'method', 'type', 'money_before', 'money_after', 'seri', 'code', 'card_type', 'message', 'class_id', 'subject_id', 'teacher_id'];

    public $timestamps = true;
    
    public static function customSearch($params){
        $limit = !empty($params['limit']) ? $params['limit'] : 10;
        $order = !empty($params['order']) ? $params['order'] : 'desc';
        $member_id = isset(Auth::guard('member')->user()->member_id) ? Auth::guard('member')->user()->member_id : 1;
        $query = Transaction::where('member_id', $member_id)->orderBy('transaction_id', $order);
        
        if(!empty($params['subject_id'])){
            $query->where('subject_id', $params['subject_id']);
        }
        if(!empty($params['class_id'])){
            $query->where('class_id', $params['class_id']);
        }
        if(!empty($params['teacher_id'])){
            $query->where('teacher_id', $params['teacher_id']);
        }
        if(!empty($params['teacher_id'])){
            $query->where('teacher_id', $params['teacher_id']);
        }
        if(!empty($params['start']) && !empty($params['end'])){
            $query = $query->whereBetween('created_at', [$params['start']." 00:00:00", $params['end']." 23:59:59"]);
        }
        return $query->paginate($limit)->appends($params);
    }

    public function isCourse(){
        return $this->hasOne(Course::class, 'course_id', 'course_id');
    }
}
