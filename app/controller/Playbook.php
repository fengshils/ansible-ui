<?php

namespace app\controller;

use app\BaseController;
use think\Request;
use app\model\Playbook as PlaybookModel;
use think\facade\View;
use think\facade\Db;

/**
 * Playbook 资源管理
 */
class Playbook extends BaseController

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
        $data = PlaybookModel::paginate(10);
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
        if (\request()->isPost()) {
//            halt( input('post.'));
            $playbook = PlaybookModel::where('name', input('post.name'))->findOrEmpty();
            if ($playbook->isEmpty()) {
                $playbook = new PlaybookModel();
                // post数组中只有name和email字段会写入
                $playbook->save($_POST);
                return redirect(url('playbook/index'));
            } else {
                trace('名称重复', 'log');
                echo '名称重复';
                exit();
            }

        } else {
            return View::fetch();
        }
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param int $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
        $id = input('get.id');
        $playbook = PlaybookModel::find($id);
        if (\request()->isPost()) {
            $playbook = PlaybookModel::find($id);
            $playbook->name = input('post.name');
            $playbook->path = input('post.path');
            $playbook->comment = input('post.comment');
            $playbook->tag = input('post.tag');
            $playbook->save();
            return redirect(url('playbook/index'));
        } else {
            View::assign('data', $playbook);
            return View::fetch();
        }
    }


    /**
     * 删除指定资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
        $id = input('get.id');
        $playbook = PlaybookModel::find($id);
        $playbook->delete();
        return redirect(url('playbook/index'));
    }


    /**
     * 删除指定资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function playbook_search()
    {
        //
        $q = input('get.q');
        $playbook = PlaybookModel::where('name', 'like', '%' . $q . '%') -> limit(3)->select();
        return json_encode($playbook);
    }

    /**
     * 删除指定资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function playbook_info()
    {
        //
        $playbook = input('get.playbook');
        $playbook = PlaybookModel::where('name', $playbook)->find();
        return $playbook['comment'];
    }

}