<?php

namespace Hocplus\Frontend\App\Models;

use Illuminate\Database\Eloquent\Model;
use Hocplus\Frontend\App\Models\CourseTemplate;

class TemplateLesson extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_template_lesson';

    protected $primaryKey = 'template_lesson_id';

    protected $fillable = ['name', 'content', 'active', 'course_template_id'];

    protected $dates = ['deleted_at'];
    
    public $timestamps = true;
    
    public function getCourseTemplate(){
        return $this->belongsTo(Coursetemplate::class, 'course_template_id');
    }
}
