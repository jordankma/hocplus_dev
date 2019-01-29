<?php

namespace Hocplus\Teacher\App\Models;
use Hocplus\Teacher\App\Models\TblClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    /*
    protected $table = 'tbl_subjects';
    protected $primaryKey = 'subject_id';    
    */
    use SoftDeletes;

    protected $table = 'vne_subject';

    protected $primaryKey = 'subject_id';

    //protected $fillable = ['name'];

    protected $dates = ['deleted_at'];    
    
    public function getClass() {
        return $this->belongsToMany('Hocplus\Teacher\App\Models\TblClass', 'vne_class_has_subject', 'subject_id', 'classes_id')->get();
    }    
}
