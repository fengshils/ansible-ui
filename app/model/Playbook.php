<?php

namespace app\model;

use think\Model;

/**
 * @mixin think\Model
 */
class Playbook extends Model
{
    //
    protected  $pk='id';
    protected  $table='ansible_playbook';

    // 开启时间戳自动写入
    protected $createTime = 'create_at';
    protected $autoWriteTimestamp = true;

    protected function getBirthdayAttr($create_at)
    {
        return date('Y-m-d', $create_at);
    }
}
