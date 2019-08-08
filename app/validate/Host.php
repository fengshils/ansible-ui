<?php

namespace app\validate;

use think\Validate;

class Host extends Validate
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
        'ip' => 'require|ip',
        'user' => 'require',
        'g_id' => 'require',
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
        'ip.require' => 'IP必须',
        'ip.ip' => 'IP必须符合要求',
        'user.require' => '用户必须',
        'g_id.require' => '分组必须',
    ];
}
