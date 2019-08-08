<?php

namespace app\controller;

use function MongoDB\BSON\toJSON;
use think\facade\Db;
use think\Request;
use \think\facade\View;
use \app\common\Sclient;

class AnsibleCommand
{
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
                $data = 'ansible -i /tmp/hosts '. input('post.')['group'] . ' -m ' . input('post.')['module'] . ' -a '. input('post.')['command'] . '| tee -a '. $logFile;
                Sclient::client($msg=$data);
                $result = array('data'=>$data, 'logfile'=>$logFile);
                return json_encode($result);
                //获取的是主机名称
            }else if(input('post.')['host']){
                $logFile = '/tmp/'.input('post.')['host'] . time().'.log';
                $ip = \app\model\Host::where('name', input('post.')['host'])->find();
                $data = 'ansible -i /tmp/hosts '. $ip['ip'] . ' -m ' . input('post.')['module'] . ' -a '. input('post.')['command'] . '| tee -a '. $logFile;
                $result = array('data'=>$data, 'logfile'=>$logFile);
                Sclient::client($msg=$data);
                return json_encode($result);
                //获取的是主机ip
            }else if(input('post.')['ip']){
                $logFile = '/tmp/'.input('post.')['ip'] . time().'.log';
                $data = 'ansible -i /tmp/hosts '. input('post.')['ip'] . ' -m ' . input('post.')['module'] . ' -a '. input('post.')['command'] . '| tee -a '. $logFile;
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
//////        halt($logfile);
//////        return $logfile;
//        $myfile = fopen($logfile, "r") or die("Unable to open file!");
////        // 读取文件每一行，直到文件结尾
//        $log = '';
//        while(!feof($myfile))
//        {
//////            array_push($log,fgets($myfile). "<br>" );
//            $log = $log.fgets($myfile)."<br>";
//        }
//////
//        fclose($myfile);
//        var_dump($log);
        $file = fopen("$logfile", "r");
        $user=[];
        $i=0;
//输出文本中所有的行，直到文件结束为止。
        while(! feof($file))
        {
            $user[$i]= fgets($file).'<br>';//fgets()函数从文件指针中读取一行
            $i++;
        }
        fclose($file);
        echo implode($user);
    }
}
