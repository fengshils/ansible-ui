<?php

namespace app\controller;

use app\BaseController;
use \think\facade\View;
use \app\common\Sclient;

class AnsibleCommand extends  BaseController
{

    protected $middleware = ['app\middleware\CheckLogin'];
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     *
     */
    public  function command(){
        if(\request()->isPost()){


            //获取的是主机组
            if(input('post.')['group']){
                $logFile = '/tmp/'.input('post.')['group'] . time().'.log';
                $data = 'ansible -i /tmp/hosts '. input('post.')['group'] . ' -m ' . input('post.')['module'] . ' -a "'. input('post.')['command'] . '"| tee -a '. $logFile;
                Sclient::client($msg=$data);
                $result = array('data'=>$data, 'logfile'=>$logFile);
                return json_encode($result);
                //获取的是主机名称
            }else if(input('post.')['host']){
                $logFile = '/tmp/'.input('post.')['host'] . time().'.log';
                $ip = \app\model\Host::where('name', input('post.')['host'])->find();
                $data = 'ansible -i /tmp/hosts '. $ip['ip'] . ' -m ' . input('post.')['module'] . ' -a " '. input('post.')['command'] . '"| tee -a '. $logFile;
                $result = array('data'=>$data, 'logfile'=>$logFile);
                Sclient::client($msg=$data);
                return json_encode($result);
                //获取的是主机ip
            }else if(input('post.')['ip']){
                $logFile = '/tmp/'.input('post.')['ip'] . time().'.log';
                $data = 'ansible -i /tmp/hosts '. input('post.')['ip'] . ' -m  "' . input('post.')['module'] . ' -a '. input('post.')['command'] . '"| tee -a '. $logFile;
                $result = array('data'=>$data, 'logfile'=>$logFile);
                Sclient::client($msg=$data);
                return json_encode($result);
            }

//            $group = input('post.group');
//            $host = input('post.host');
//            $command = input('post.command');
        }else{
            return View::fetch();
        }
    }

    //获取命令执行日志
    public function get_log(){
        $logfile = input('get.')['logfile'];
        $line = input('get.')['line'];
        if ($line != 0){
//            $file = SplFileInfo("$logfile", "r");
            $log=[];
            $i=0;
//            fseek($file,$line,SEEK_END);
            $ret = "";
            for( $i = $line ; $i < count(file($logfile)) ; $i++ )
            {
                $log[$i]= getLine($logfile, $i);//fgets()函数从文件指针中读取一行
                $i++;
            }




            //输出文本中所有的行，直到文件结束为止。
//            while(! feof($file))
//            {
//                trace('开始', 'log');
//                $log[$i]= fgets($file).'<br>';//fgets()函数从文件指针中读取一行
//                $i++;
//                trace($log,'log');
//            }
//            fclose($file);
            trace($ret, 'log');
            return json_encode( array(
                'log' => $ret,
                'line' => count(file($logfile)),
            ));
        }else{
            $file = fopen("$logfile", "r");
            $line = count(file($logfile));
            $log=[];
            $i=0;
            //输出文本中所有的行，直到文件结束为止。
            while(! feof($file))
            {
                $log[$i]= fgets($file);//fgets()函数从文件指针中读取一行
                $i++;
            }
            fclose($file);
            return json_encode(array(
                'log'=>$log,
                'line' => $line,
            ));
        }

        //判断是否第一次读取文件


    }
}
