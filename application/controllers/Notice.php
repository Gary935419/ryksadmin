<?php

/**
 * **********************************************************************
 * サブシステム名  ： Task
 * 機能名         ：公告
 * 作成者        ： Gary
 * **********************************************************************
 */
class Notice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        $this->load->model('Notice_model', 'notice');
        header("Content-type:text/html;charset=utf-8");
    }
    /**
     * 公告列表页
     */
    public function notice_list()
    {

        $ncontent = isset($_GET['ncontent']) ? $_GET['ncontent'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allpage = $this->notice->getnoticeAllPage($ncontent);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $data["list"] = $this->notice->getnoticeAll($page, $ncontent);
        $data["ncontent"] = $ncontent;
        $this->display("notice/notice_list", $data);
    }
    /**
     * 公告添加页
     */
    public function notice_add()
    {
        $this->display("notice/notice_add");
    }
    /**
     * 公告添加提交
     */
    public function notice_save()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
            return;
        }

        $ncontent = isset($_POST["ncontent"]) ? $_POST["ncontent"] : '';
        $add_time = time();

        $notice_info = $this->notice->getnoticeByname($ncontent);
        if (!empty($notice_info)) {
            echo json_encode(array('error' => true, 'msg' => "该公告已经存在。"));
            return;
        }
        $result = $this->notice->notice_save($ncontent,$add_time);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }
    /**
     * 公告删除
     */
    public function notice_delete()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        if ($this->notice->notice_delete($id)) {
            echo json_encode(array('success' => true, 'msg' => "删除成功"));
            return;
        } else {
            echo json_encode(array('success' => false, 'msg' => "删除失败"));
            return;
        }
    }
    /**
     * 公告修改页
     */
    public function notice_edit()
    {
        $nid = isset($_GET['nid']) ? $_GET['nid'] : 0;
        $notice_info = $this->notice->getnoticeById($nid);
        if (empty($notice_info)) {
            echo json_encode(array('error' => true, 'msg' => "数据错误"));
            return;
        }
        $data = array();
        $data['ncontent'] = $notice_info['ncontent'];
        $data['nid'] = $nid;
        $this->display("notice/notice_edit", $data);
    }
    /**
     * 公告修改提交
     */
    public function notice_save_edit()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }

        $ncontent = isset($_POST["ncontent"]) ? $_POST["ncontent"] : '';
        $nid = isset($_POST["nid"]) ? $_POST["nid"] : '';

        $notice_info = $this->notice->getnoticeById2($ncontent, $nid);
        if (!empty($notice_info)){
            echo json_encode(array('error' => false, 'msg' => "该公告已经存在"));
            return;
        }

        $result = $this->notice->notice_save_edit($nid, $ncontent);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }

}