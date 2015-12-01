<?php
/**
 * Created by PhpStorm.
 * User: LJ
 * Date: 2015/11/30
 * Time: 22:43
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    protected $table = 'tbl_group';

    public function users() {
        return $this->hasMany(User::class, 'group_id');
    }

}