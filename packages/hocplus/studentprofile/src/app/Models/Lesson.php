<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Hocplus\Studentprofile\App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hocplus\Studentprofile\App\Models\Course;

class Lesson extends Model {

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_lesson';

    protected $primaryKey = 'lesson_id';

    protected $fillable = ['name', 'date_start', 'content', 'active', 'status', 'url'];

    protected $dates = ['deleted_at'];
    
    public $timestamps = true;
    
    public function getCourse(){
        return $this->belongsTo(Course::class, 'course_id');
    }       
}
