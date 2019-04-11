<?php

namespace Hocplus\Coursegroup\App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberHasWishlist extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vne_member_has_wishlist';

    protected $primaryKey = 'id';

    // protected $fillable = ['name'];
}
