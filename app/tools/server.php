<?php
$serv = new swoole_server("127.0.0.1", 9501);
//设置异步任务的工作进程数量
$serv->set(array('task_worker_num' => 4));
$serv->on('receive', function($serv, $fd, $from_id, $data) {
    //投递异步任务
    $task_id = $serv->task($data);
    echo "receive";
});
//处理异步任务
$serv->on('task', function ($serv, $task_id, $from_id, $data) {
    //sendScore($data);
    echo $data;
    exec($data);

    //返回任务执行的结果
    $serv->finish($data);
});
//处理异步任务的结果
$serv->on('finish', function ($serv, $task_id, $data) {
    echo "finish";
});
$serv->start();

function sendScore($data){
    //获取到$data
    $arr = json_decode($data,true);
    //判断数据是否异常
    //业务发奖代码
    return true;
}
