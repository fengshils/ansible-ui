<?php

namespace app\model;

use think\Model;

/**
 * @mixin think\Model
 */
class User extends Model
{
    //
    protected  $pk='id';
    protected  $table='ansible_user';
}
