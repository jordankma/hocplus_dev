<?php

namespace Hocplus\Teacher\App\Models;
use Hocplus\Teacher\App\Models\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TblClass extends Model
{
    use SoftDeletes;

    protected $table = 'vne_classes';

    protected $primaryKey = 'classes_id';

    //protected $fillable = ['name'];

    protected $dates = ['deleted_at']; 
    
    public function getSubject() {
        return $this->belongsToMany('Hocplus\Teacher\App\Models\Subject','vne_class_has_subject','classes_id','subject_id')->get();
    }
}
