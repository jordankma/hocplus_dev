<?php

namespace Hocplus\Frontend\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classes extends Model {

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vne_classes';

    protected $primaryKey = 'classes_id';

    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];

    public function getSubject() {
        return $this->belongsToMany('Hocplus\Frontend\App\Models\Subject','vne_class_has_subject','classes_id','subject_id');
    }
}
