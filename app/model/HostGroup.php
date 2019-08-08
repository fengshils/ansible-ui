<?php

namespace app\model;

use think\Model;
use app\model\Host;

class HostGroup extends Model
{
    //
    protected  $pk='id';
    protected  $table='ansible_host_group';

    // 定义一对多关联
    public function hosts()
    {
    return $this->hasMany('Host');
    }
}
