<?php

namespace Hocplus\Frontend\App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Member extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, Notifiable, SoftDeletes;

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

    private $rules = array(
        'email' => 'required|email|unique:vne_members',
        'password' => 'required|min:6|confirmed',
        'password_confirmation' => 'required|min:6'
    );

    public function validate($data)
    {
        $validator = Validator::make($data, $this->rules, $this->messages);
        return $validator;
    }
}
