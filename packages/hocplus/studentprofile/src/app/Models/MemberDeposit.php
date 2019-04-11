<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hocplus\Studentprofile\App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class MemberDeposit extends Model
{
    use SoftDeletes;
    protected $table = 'hocplus_member_deposit';
    protected $primaryKey = 'member_deposit_id';
    
}