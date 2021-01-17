<?php

/**
 * **********************************************************************
 * サブシステム名  ： TASK
 * 機能名         ：系统设置
 * 作成者        ： Gary
 * **********************************************************************
 */
class Set extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        $this->load->model('Set_model', 'set');
        header("Content-type:text/html;charset=utf-8");
    }
    /**
     * 设置修改页
     */
    public function set_edit()
    {
        $sid = 1;
        $set_info = $this->set->getsetById($sid);
        $data['name'] = $set_info['name'];
        $data['email'] = $set_info['email'];
        $data['address'] = $set_info['address'];
        $data['contentnew'] = $set_info['contentnew'];
        $data['contentagent'] = $set_info['contentagent'];
        $data['customercode'] = $set_info['customercode'];
        $this->display("set/set_edit", $data);
    }
    /**
     * 设置修改提交
     */
    public function set_save_edit()
    {

        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
        $sid = 1;
        $name = isset($_POST["name"]) ? $_POST["name"] : '';
        $email = isset($_POST["email"]) ? $_POST["email"] : '';
        $address = isset($_POST["address"]) ? $_POST["address"] : '';
        $customercode = isset($_POST["customercode"]) ? $_POST["customercode"] : '';
        $contentnew = isset($_POST["contentnew"]) ? $_POST["contentnew"] : '';
        $contentagent = isset($_POST["contentagent"]) ? $_POST["contentagent"] : '';
        $result = $this->set->set_save_edit($name,$contentagent,$email,$customercode,$address,$sid,$contentnew);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }

    }
    /**
     * 广告列表页
     */
    public function advertisement_list()
    {

        $aname = isset($_GET['aname']) ? $_GET['aname'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allpage = $this->set->getadvertisementAllPage($aname);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->set->getadvertisementAllNew($page, $aname);
        $data["list"] = $list;
        $data["aname"] = $aname;
        $this->display("set/advertisement_list", $data);
    }
    /**
     * 广告添加页
     */
    public function advertisement_add()
    {
        $this->display("set/advertisement_add");
    }
    /**
     * 广告添加提交
     */
    public function advertisement_save()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
            return;
        }

        $aname = isset($_POST["aname"]) ? $_POST["aname"] : '';
        $aimg = isset($_POST["aimg"]) ? $_POST["aimg"] : '';
        $add_time = time();

        $advertisement_info = $this->set->getadvertisementByname($aname);
        if (!empty($advertisement_info)) {
            echo json_encode(array('error' => true, 'msg' => "该广告名称已经存在。"));
            return;
        }
        $result = $this->set->advertisement_save($aname, $aimg, $add_time);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }
    /**
     * 广告删除
     */
    public function advertisement_delete()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        if ($this->set->advertisement_delete($id)) {
            echo json_encode(array('success' => true, 'msg' => "删除成功"));
            return;
        } else {
            echo json_encode(array('success' => false, 'msg' => "删除失败"));
            return;
        }
    }
    /**
     * 广告修改页
     */
    public function advertisement_edit()
    {
        $aid = isset($_GET['aid']) ? $_GET['aid'] : 0;
        $advertisement_info = $this->set->getadvertisementById($aid);
        if (empty($advertisement_info)) {
            echo json_encode(array('error' => true, 'msg' => "数据错误"));
            return;
        }
        $data = array();
        $data['aname'] = $advertisement_info['aname'];
        $data['aimg'] = $advertisement_info['aimg'];
        $data['aid'] = $aid;
        $this->display("set/advertisement_edit", $data);
    }
    /**
     * 广告修改提交
     */
    public function advertisement_save_edit()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
        $aname = isset($_POST["aname"]) ? $_POST["aname"] : '';
        $aimg = isset($_POST["aimg"]) ? $_POST["aimg"] : '';
        $aid = isset($_POST["aid"]) ? $_POST["aid"] : '';
        $advertisement_info = $this->set->getadvertisementById2($aname, $aid);
        if (!empty($advertisement_info)){
            echo json_encode(array('error' => false, 'msg' => "该类型名称已经存在"));
            return;
        }

        $result = $this->set->advertisement_save_edit($aid,$aname,$aimg);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }
}