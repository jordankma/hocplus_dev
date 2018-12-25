<?php

namespace Vne\Subject\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model {
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subject';

    protected $primaryKey = 'subject_id';

    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];

    public function getClass() {
        return $this->belongsToMany('Vne\Classes\App\Models\Classes', 'class_has_subject', 'subject_id', 'classes_id');
    }
    
    public static function listSubject(){
        $subjects =  Subject::where(['status' => 'enable'])->get()->toArray();
        return $subjects;
    }
}
