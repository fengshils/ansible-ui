<?php

namespace app\controller;

use think\facade\View;
use app\BaseController;
use app\model\HostGroup as HostGroupModel;
use app\validate\HostGroup as HostGroupValidate;
use think\exception\ValidateException;



class HostGroup extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        $data = HostGroupModel::paginate(10);
        View::assign('data', $data);
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
                validate(HostGroupValidate::class)->check(input('post.'));
            } catch (ValidateException $e) {
                // 验证失败 输出错误信息
                dump($e->getError());exit();
            }
        }
        $name = input('post.name');

            //实例化模型字段
            $hostGroup = new HostGroupModel;


            if (        $hostGroup->save([
                    'name' => $name
                ]
            )) {
                return redirect('/host_group/index');
            } else {
                return $hostGroup->getError();exit;
            }
        }



    /**
     * 删除指定资源
     *
     * @param
     * @return \think\Response
     */
    public function group_search()
    {

        $q = input('get.q');
        $hostGroup = new HostGroupModel;
        $data = $hostGroup->where('name','like','%'.$q.'%')->limit(5)
            ->select();
//        var_dump($data);
//        halt($data);
        return json_encode($data);
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
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $id = input('get.id');
        if (request()->isPost()){
            //调用验证器验证数据是否正确
            try {
                validate(HostGroupValidate::class)->check(input('post.'));
            } catch (ValidateException $e) {
                // 验证失败 输出错误信息
                dump($e->getError());exit();
            }
            $host_group = HostGroupModel::find($id);
            if ($host_group->data([
                'name' => input('post.name'),
            ])->save()) {
                return redirect('/host_group/index');
            } else {
                return $host_group->getError();exit;
            }
        }else{
            $data = HostGroupModel::find($id);
            View::assign('data', $data);
            return View::fetch();
        }
    }



    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete()
    {
        $id = input('get.id');
        $host_group = HostGroupModel::find($id);
        $host_group->delete();
        return redirect(url('host_group/index'));
    }


}
