<?php

namespace Hocplus\Api\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hocplus\Api\App\Models\Course;

class Lesson extends Model {

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_lesson';

    protected $primaryKey = 'lesson_id';

    protected $dates = ['deleted_at'];
    
    public $timestamps = true;
    
    public function getCourse(){
        return $this->belongsTo(Course::class, 'course_id');
    }       
}
