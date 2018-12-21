<?php

namespace Vne\Teacher\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherClassSubject extends Model {
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teacher_class_subject';

    protected $primaryKey = 'teacher_class_subject_id';

    // protected $fillable = ['name'];

    protected $dates = ['deleted_at'];
}
