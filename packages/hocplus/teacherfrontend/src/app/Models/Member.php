<?php

namespace Hocplus\Teacherfrontend\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hocplus\Teacherfrontend\App\Models\MemberHasCourse;
class Member extends Model {
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vne_members';

    protected $primaryKey = 'member_id';

    protected $dates = ['deleted_at'];

    public function getCourse(){
        return $this->hasMany(MemberHasCourse::class, 'member_id');
    }
}
