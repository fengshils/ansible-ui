<?php

namespace app\validate;

use think\Validate;

class HostGroup extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
//	protected $rule = [];
    protected $rule = [
        'name' => 'require|token',
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
//    protected $message = [];
    protected $message = [
        'name.require' => '名称必须',
    ];
}
