<?php

/**
 * **********************************************************************
 * サブシステム名  ： Task
 * 機能名         ：城市
 * 作成者        ： Gary
 * **********************************************************************
 */
class City extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        $this->load->model('City_model', 'city');
        header("Content-type:text/html;charset=utf-8");
    }
    /**
     * 城市列表页
     */
    public function city_list()
    {

        $cname = isset($_GET['cname']) ? $_GET['cname'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allpage = $this->city->getcityAllPage($cname);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $data["list"] = $this->city->getcityAll($page, $cname);
        $data["cname"] = $cname;
        $this->display("city/city_list", $data);
    }
    /**
     * 城市添加页
     */
    public function city_add()
    {
        $this->display("city/city_add");
    }
    /**
     * 城市添加提交
     */
    public function city_save()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
            return;
        }

        $cname = isset($_POST["cname"]) ? $_POST["cname"] : '';
        $add_time = time();

        $city_info = $this->city->getcityByname($cname);
        if (!empty($city_info)) {
            echo json_encode(array('error' => true, 'msg' => "该城市已经存在。"));
            return;
        }
        $result = $this->city->city_save($cname,$add_time);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }
    /**
     * 城市删除
     */
    public function city_delete()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        if ($this->city->city_delete($id)) {
            echo json_encode(array('success' => true, 'msg' => "删除成功"));
            return;
        } else {
            echo json_encode(array('success' => false, 'msg' => "删除失败"));
            return;
        }
    }
    /**
     * 城市修改页
     */
    public function city_edit()
    {
        $cid = isset($_GET['cid']) ? $_GET['cid'] : 0;
        $city_info = $this->city->getcityById($cid);
        if (empty($city_info)) {
            echo json_encode(array('error' => true, 'msg' => "数据错误"));
            return;
        }
        $data = array();
        $data['cname'] = $city_info['cname'];
        $data['cid'] = $cid;
        $this->display("city/city_edit", $data);
    }
    /**
     * 城市修改提交
     */
    public function city_save_edit()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }

        $cname = isset($_POST["cname"]) ? $_POST["cname"] : '';
        $cid = isset($_POST["cid"]) ? $_POST["cid"] : '';

        $city_info = $this->city->getcityById2($cname, $cid);
        if (!empty($city_info)){
            echo json_encode(array('error' => false, 'msg' => "该城市已经存在"));
            return;
        }

        $result = $this->city->city_save_edit($cid,$cname);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }

}