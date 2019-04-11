<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hocplus\Studentprofile\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vne\Member\App\Models\Member;
use Hocplus\Teacher\App\Models\Course;
class Comments extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];
    
    public function getUser(){
        /*$user = Member::find($this->user_id);
        if ($user) {
            return $user->name;
        }
        else {
            return null;
        }*/
        return $this->belongsTo(Member::class, 'user_id');
    }
    
    public function getCourse() {
        return $this->belongsTo(Course::class, 'course_id');
    }
}