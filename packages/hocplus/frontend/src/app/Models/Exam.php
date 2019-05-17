<?php

namespace Hocplus\Frontend\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model {

	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_exam';

    protected $primaryKey = 'exam_id';

    protected $guarded = ['exam_id'];

    protected $fillable = ['name'];
}