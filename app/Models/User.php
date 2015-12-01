<?php
/**
 * Created by PhpStorm.
 * User: LJ
 * Date: 2015/11/30
 * Time: 22:36
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table = 'tbl_user';

    public function group() {
        return $this->belongsTo(Group::class, 'group_id');
    }
}