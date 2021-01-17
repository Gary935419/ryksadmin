<?php

/**
 * **********************************************************************
 * サブシステム名  ： Task
 * 機能名         ：标签
 * 作成者        ： Gary
 * **********************************************************************
 */
class Label extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        $this->load->model('Label_model', 'label');
        header("Content-type:text/html;charset=utf-8");
    }
    /**
     * 标签列表页
     */
    public function label_list()
    {
        $lname = isset($_GET['lname']) ? $_GET['lname'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allpage = $this->label->getlabelAllPage($lname);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->label->getlabelAll($page, $lname);
        $data["list"] = $list;
        $data["lname"] = $lname;
        $this->display("label/label_list", $data);
    }
    /**
     * 标签添加页
     */
    public function label_add()
    {
        $this->display("label/label_add");
    }
    /**
     * 标签添加提交
     */
    public function label_save()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
            return;
        }

        $lname = isset($_POST["lname"]) ? $_POST["lname"] : '';
        $add_time = time();

        $label_info = $this->label->getlabelByname($lname);
        if (!empty($label_info)) {
            echo json_encode(array('error' => true, 'msg' => "该标签名称已经存在。"));
            return;
        }
        $result = $this->label->label_save($lname, $add_time);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }
    /**
     * 标签删除
     */
    public function label_delete()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        if ($this->label->label_delete($id)) {
            echo json_encode(array('success' => true, 'msg' => "删除成功"));
            return;
        } else {
            echo json_encode(array('success' => false, 'msg' => "删除失败"));
            return;
        }
    }
    /**
     * 标签修改页
     */
    public function label_edit()
    {
        $lid = isset($_GET['lid']) ? $_GET['lid'] : 0;
        $label_info = $this->label->getlabelById($lid);
        if (empty($label_info)) {
            echo json_encode(array('error' => true, 'msg' => "数据错误"));
            return;
        }
        $data = array();
        $data['lname'] = $label_info['lname'];
        $data['lid'] = $lid;
        $this->display("label/label_edit", $data);
    }
    /**
     * 标签修改提交
     */
    public function label_save_edit()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
        $lname = isset($_POST["lname"]) ? $_POST["lname"] : '';
        $lid = isset($_POST["lid"]) ? $_POST["lid"] : '';
        $label_info = $this->label->getlabelById2($lname, $lid);
        if (!empty($label_info)){
            echo json_encode(array('error' => false, 'msg' => "该标签名称已经存在"));
            return;
        }

        $result = $this->label->label_save_edit($lid, $lname);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }

}