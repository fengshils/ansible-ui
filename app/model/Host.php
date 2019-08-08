<?php

namespace app\model;

use think\Model;
use app\model\HostGroup;

class Host extends Model
{
    //
    protected $pk='id';
    protected $table='ansible_host';

    // 开启时间戳自动写入
    protected $createTime = 'create_at';
    protected $autoWriteTimestamp = true;

    protected function getBirthdayAttr($create_at)
    {
        return date('Y-m-d', $create_at);
    }

    // 定义一对一关联
    public function host_group()
    {
//    return $this->hasOne('HostGroup');
    return $this->hasOne(HostGroup::class, 'g_id');
    }
}
