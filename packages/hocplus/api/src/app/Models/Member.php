<?php

namespace Hocplus\Api\App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $table = 'vne_members';

    protected $primaryKey = 'member_id';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['member_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'];

    protected $dates = ['deleted_at'];

    public function course()
    {
        return $this->belongsToMany('Hocplus\Api\App\Models\Course', 'hocplus_member_has_course', 'member_id', 'course_id');
    }
}
