<?php

/**
 * **********************************************************************
 * サブシステム名  ： TASK
 * 機能名         ：管理员
 * 作成者        ： Gary
 * **********************************************************************
 */
class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        $this->load->model('Users_model', 'users');
        header("Content-type:text/html;charset=utf-8");
    }
    /**
     * 管理员列表页
     */
    public function users_list()
    {
        $user_name = isset($_GET['user_name']) ? $_GET['user_name'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allpage = $this->users->getUserAllPage($user_name);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $data["list"] = $this->users->getUserAll($page, $user_name);
        $data["user_name1"] = $user_name;
        $this->display("users/users_list", $data);
    }
    /**
     * 管理员添加页
     */
    public function users_add()
    {
        $data = array();
        $ridlist = $this->users->getRole();
        $data['ridlist'] = $ridlist;
        $this->display("users/users_add", $data);
    }
	/**
	 * 管理员添加页
	 */
	public function users_add1()
	{
		$data = array();
		$ridlist = $this->users->getRole();
		$data['ridlist'] = $ridlist;
		$this->display("users/users_add1", $data);
	}
	public function users_add2()
	{
		$data = array();
		$ridlist = $this->users->getRole();
		$data['ridlist'] = $ridlist;
		$this->display("users/users_add2", $data);
	}
	public function users_add3()
	{
		$data = array();
		$ridlist = $this->users->getRole();
		$data['ridlist'] = $ridlist;
		$this->display("users/users_add3", $data);
	}
	public function users_add4()
	{
		$data = array();
		$ridlist = $this->users->getRole();
		$data['ridlist'] = $ridlist;
		$this->display("users/users_add4", $data);
	}
	public function users_add5()
	{
		$data = array();
		$ridlist = $this->users->getRole();
		$data['ridlist'] = $ridlist;
		$this->display("users/users_add5", $data);
	}
	/**
     * 管理员添加提交
     */
    public function users_save()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
            return;
        }

        $user_name = isset($_POST["user_name"]) ? $_POST["user_name"] : '';
        $user_pass = isset($_POST["user_pass"]) ? $_POST["user_pass"] : '';
        $rid = isset($_POST["rid"]) ? $_POST["rid"] : '';
        $user_state = isset($_POST["user_state"]) ? $_POST["user_state"] : 1;
        $add_time = time();
        $user_pass = md5($user_pass);

        $user_info = $this->users->getmemberById($user_name);
        if (!empty($user_info)) {
            echo json_encode(array('error' => true, 'msg' => "该账号已经存在。"));
            return;
        }
        $result = $this->users->member_save($user_name, $user_pass, $rid, $user_state, $add_time,$_POST["user_pass"]);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }
    /**
     * 管理员删除
     */
    public function users_delete()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        if ($this->users->users_delete($id)) {
            echo json_encode(array('success' => true, 'msg' => "删除成功"));
            return;
        } else {
            echo json_encode(array('success' => false, 'msg' => "删除失败"));
            return;
        }
    }
    /**
     * 管理员修改
     */
    public function users_edit()
    {
        $uid = isset($_GET['id']) ? $_GET['id'] : 0;
        $data = array();
        $ridlist = $this->users->getRole();
        $data['ridlist'] = $ridlist;

        $member_info = $this->users->getUserByIdnew($uid);
        $data['user_namenew'] = $member_info['username'];
        $data['ridnew'] = $member_info['rid'];
        $data['user_statenew'] = $member_info['user_state'];
        $data['uidnew'] = $uid;

        $this->display("users/users_edit", $data);
    }
    /**
     * 管理员修改提交
     */
    public function users_save_edit()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
        $uid = isset($_POST["uid"]) ? $_POST["uid"] : '';
        $user_name = isset($_POST["user_name"]) ? $_POST["user_name"] : '';
        $user_info = $this->users->getmemberById2($user_name,$uid);
        $user_pass = !empty($_POST["user_pass"]) ? md5($_POST["user_pass"]) : $user_info['userpwd'];
        $rid = isset($_POST["rid"]) ? $_POST["rid"] : '';
        $user_state = isset($_POST["user_state"]) ? $_POST["user_state"] : '1';
        $result = $this->users->users_save_edit($uid, $user_name, $user_pass, $rid, $user_state);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }

    }

}
