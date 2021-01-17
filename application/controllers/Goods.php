<?php

/**
 * **********************************************************************
 * サブシステム名  ： Task
 * 機能名         ：商品
 * 作成者        ： Gary
 * **********************************************************************
 */
class Goods extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        $this->load->model('Goods_model', 'goods');
        $this->load->model('Task_model', 'task');
        $this->load->model('Taskclass_model', 'taskclass');
        header("Content-type:text/html;charset=utf-8");
    }
    /**
     * 商品列表页
     */
    public function goods_list()
    {

        $gname = isset($_GET['gname']) ? $_GET['gname'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allpage = $this->goods->getgoodsAllPage($gname);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->goods->getgoodsAllNew($page, $gname);

        $data["gname"] = $gname;
        foreach ($list as $k=>$v){
            $tidone = $this->taskclass->gettaskclassById($v['tid']);
            $list[$k]['tname'] = $tidone['tname'];
        }

        $data["list"] = $list;
        $this->display("goods/goods_list", $data);
    }
    /**
     * 商品添加页
     */
    public function goods_add()
    {
        $tidlist = $this->task->gettidlist();
        $data['tidlist'] = $tidlist;
        $this->display("goods/goods_add",$data);
    }
    /**
     * 商品添加提交
     */
    public function goods_save()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
            return;
        }
        $tid = isset($_POST["tid"]) ? $_POST["tid"] : '';
        $gname = isset($_POST["gname"]) ? $_POST["gname"] : '';
        $gtitle = isset($_POST["gtitle"]) ? $_POST["gtitle"] : '';
        $gsort = isset($_POST["gsort"]) ? $_POST["gsort"] : '';
        $gimg = isset($_POST["gimg"]) ? $_POST["gimg"] : '';
        $avater = isset($_POST["avater"]) ? $_POST["avater"] : '';
        $gcontent = isset($_POST["gcontent"]) ? $_POST["gcontent"] : '';
        $addtime = time();
        $status = isset($_POST["status"]) ? $_POST["status"] : '0';
        $goods_info = $this->goods->getgoodsByname($gname);
        if (!empty($goods_info)) {
            echo json_encode(array('error' => true, 'msg' => "该商品名称已经存在。"));
            return;
        }
        $gid = $this->goods->goods_save($gname, $gtitle,$tid, $gsort,$gimg,$gcontent,$addtime,$status);

        if ($gid) {
            if (!empty($avater)){
                foreach ($avater as $k=>$v){
                    $this->goods->goodsimg_save($gid,$v);
                }
            }

            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }
    /**
     * 商品删除
     */
    public function goods_delete()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        if ($this->goods->goods_delete($id)) {
            echo json_encode(array('success' => true, 'msg' => "删除成功"));
            return;
        } else {
            echo json_encode(array('success' => false, 'msg' => "删除失败"));
            return;
        }
    }
    /**
     * 类型修改页
     */
    public function goods_edit()
    {
        $gid = isset($_GET['gid']) ? $_GET['gid'] : 0;
        $goods_info = $this->goods->getgoodsById($gid);
        if (empty($goods_info)) {
            echo json_encode(array('error' => true, 'msg' => "数据错误"));
            return;
        }
        $imgslist = $this->goods->getgoodsimgsAllNew($gid);
        $tidlist = $this->task->gettidlist();

        $data = array();
        $data['gname'] = $goods_info['gname'];
        $data['gtitle'] = $goods_info['gtitle'];
        $data['gcontent'] = $goods_info['gcontent'];
        $data['gimg'] = $goods_info['gimg'];
        $data['gsort'] = $goods_info['gsort'];
        $data['status'] = $goods_info['status'];
        $data['gid'] = $gid;
        $data['tid'] = $goods_info['tid'];
        $data['imgsall'] = $imgslist;
        $data['tidlist'] = $tidlist;
        $this->display("goods/goods_edit", $data);
    }
    /**
     * 商品修改提交
     */
    public function goods_save_edit()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
        $gid = isset($_POST["gid"]) ? $_POST["gid"] : '';
        $gname = isset($_POST["gname"]) ? $_POST["gname"] : '';
        $gtitle = isset($_POST["gtitle"]) ? $_POST["gtitle"] : '';
        $tid = isset($_POST["tid"]) ? $_POST["tid"] : '';
        $gsort = isset($_POST["gsort"]) ? $_POST["gsort"] : '';
        $gimg = isset($_POST["gimg"]) ? $_POST["gimg"] : '';
        $avater = isset($_POST["avater"]) ? $_POST["avater"] : '';
        $gcontent = isset($_POST["gcontent"]) ? $_POST["gcontent"] : '';
        $status = isset($_POST["status"]) ? $_POST["status"] : '0';
        $goods_info = $this->goods->getgoodsById2($gname,$gid);
        if (!empty($goods_info)) {
            echo json_encode(array('error' => true, 'msg' => "该商品名称已经存在。"));
            return;
        }

        $result = $this->goods->goods_save_edit($gid, $gname, $gtitle, $tid, $gsort, $gimg, $gcontent,$status);
        $this->goods->goodsimg_delete($gid);
        if (!empty($avater)){
            foreach ($avater as $k=>$v){
                $this->goods->goodsimg_save($gid,$v);
            }
        }
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }

}