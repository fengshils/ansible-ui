<?php
namespace app\common;

class Sclient {


    static  function client($msg){
        $client = new \swoole_client(\SWOOLE_SOCK_TCP);
        //连接到服务器
        if (!$client->connect('127.0.0.1', 9501, 1)){
            //
        }
        //向服务器发送数据
        if (!$client->send($msg)){
            //
        }
        //关闭连接
        $client->close();
    }
}


