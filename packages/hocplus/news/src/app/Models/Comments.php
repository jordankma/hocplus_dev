<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hocplus\News\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Adtech\Core\App\Models\User;
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
    //protected static $cat;
    //protected $guarded = ['news_id'];
    protected $dates = ['deleted_at'];
    public function getUser(){
        $user = User::find($this->user_id);
        return $user->contact_name;
    }
}