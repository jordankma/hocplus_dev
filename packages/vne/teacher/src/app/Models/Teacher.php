<?php

namespace Vne\Teacher\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model {
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_teachers';

    protected $primaryKey = 'teacher_id';

    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];
}
