<?php

namespace app\controller;

use app\middleware\CheckLogin;
use think\facade\Db;
use think\facade\View;
use app\BaseController;
use app\model\Host as HostModel;
use app\validate\Host as HostValidate;
use think\exception\ValidateException;


class Host extends BaseController
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
        $data = HostModel::paginate(10);
        View::assign('data', $data);
        return View::fetch();

    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
        return View::fetch();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save()
    {
        //

        if(request()->isPost()){
            //调用验证器验证数据是否正确
            try {
                validate(HostValidate::class)->check(input('post.'));
            } catch (ValidateException $e) {
                // 验证失败 输出错误信息
                dump($e->getError());exit();
            }
            $host = new HostModel;
            $gid = Db::name('host_group')
            // id 在 1到3之间的
                ->where('name', input('post.g_id'))
                ->select();
//            halt($gid);
            if ($host->data([
                'name' => input('post.name'),
                'ip' => input('post.ip'),
                'user' => input('post.user'),
                'password' => input('post.password'),
                'key' => input('post.key'),
                'g_id' => $gid[0]['id'],
            ])->save()) {
                return redirect('/host/index');
            } else {
                return $host->getError();exit;
            }
        }

    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit()
    {
        //
        $id = input('get.id');
        if (request()->isPost()){
            //调用验证器验证数据是否正确
            try {
                validate(HostValidate::class)->check(input('post.'));
            } catch (ValidateException $e) {
                // 验证失败 输出错误信息
                dump($e->getError());exit();
            }
            $host = new HostModel;
            $gid = Db::name('host_group')
                // id 在 1到3之间的
                ->where('name', input('post.g_id'))
                ->select();
            if ($host->data([
                'name' => input('post.name'),
                'ip' => input('post.ip'),
                'user' => input('post.user'),
                'password' => input('post.password'),
                'key' => input('post.key'),
                'g_id' => $gid[0]['id'],
            ])->save()) {
                return redirect('/host/index');
            } else {
                return $host->getError();exit;
            }
        }else{
            $data = HostModel::find($id);
            $group = Db::name('host_group')
                // id 在 1到3之间的
                ->where('id', $data['g_id'])
                ->find();
            View::assign('group', $group['name']);
            View::assign('data', $data);
            return View::fetch();
        }

    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $id = input('get.id');
        $host = HostModel::find($id);
        $host->delete();
        return redirect(url('host/index'));
    }




    //生成inventory文件
    public function  create_host(){

        $filename = '/tmp/hosts';
        $fp= fopen($filename, "w");  //w是写入模式，文件不存在则创建文件写入。
        $results = Db::table('ansible_host_group')->select()->toArray();
        foreach ( $results as $result){
            fwrite($fp, '['.$result['name'] .']'.chr(10));
            $hosts = Db::table('ansible_host')->where('g_id',$result['id'])->select()->toArray();
            foreach ($hosts as $host){
                if(!$host['key']){
                fwrite($fp, $host['ip'].'    ansible_ssh_user='.$host['user'].'     ansible_ssh_pass="'.$host['password'].'"'.chr(10));
                }else{
                    fwrite($fp, $host['ip'].chr(10));
                }
            }
        };

        fclose($fp);
        $result = 'hosts生成成功<a href="/host/index">点击返回</a>';
        return $result;
    }

    //主机搜索
    public function host_search(){
        $q = input('get.q');
        $host= new HostModel();
        $data = $host->where('name','like','%'.$q.'%')->limit(5)
            ->select();
        return json_encode($data);
    }

    //主机搜索
    public function ip_search(){
        $q = input('get.q');
        $host= new HostModel();
        $data = $host->where('ip','like','%'.$q.'%')->limit(5)
            ->select();
        return json_encode($data);
    }

}
