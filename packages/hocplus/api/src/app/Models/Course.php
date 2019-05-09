<?php

namespace Hocplus\Api\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hocplus\Api\App\Models\Lesson;

class Course extends Model {

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_course';

    protected $primaryKey = 'course_id';

    protected $dates = ['deleted_at'];
    
    public $timestamps = true;
    
    public function getLesson(){
        return $this->hasMany(Lesson::class, 'course_id');
    }
}
