<?php

/**
 * **********************************************************************
 * サブシステム名  ： TASK
 * 機能名         ：修改密码
 * 作成者        ： Gary
 * **********************************************************************
 */
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        header("Content-type:text/html;charset=utf-8");
		$this->load->model('Users_model', 'users');
		$this->load->model('Role_model', 'role');
    }
    /**
     * 后台首页
     */
    public function index()
    {
		$rid = $_SESSION['rid'];
		$data['role_status1'] = empty($this->role->getroleByIdRtom($rid,1))?0:1;
		$data['role_status2'] = empty($this->role->getroleByIdRtom($rid,2))?0:1;
		$data['role_status3'] = empty($this->role->getroleByIdRtom($rid,3))?0:1;
		$data['role_status4'] = empty($this->role->getroleByIdRtom($rid,4))?0:1;
		$data['role_status5'] = empty($this->role->getroleByIdRtom($rid,5))?0:1;
		$data['role_status6'] = empty($this->role->getroleByIdRtom($rid,6))?0:1;
		$data['role_status7'] = empty($this->role->getroleByIdRtom($rid,7))?0:1;
		$data['role_status8'] = empty($this->role->getroleByIdRtom($rid,8))?0:1;
        $this->display("index",$data);
    }
    /**
     * 修改密码页
     */
    public function passwordedit()
    {
        $this->display("passwordedit");
    }
    /**
     * 修改密码提交
     */
    public function userpassportsave()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改密码"));
            return;
        }
        $user_name = $_SESSION['user_name'];

        $passold = isset($_POST["passold"]) ? $_POST["passold"] : '';
        $pass = isset($_POST["pass"]) ? $_POST["pass"] : '';

        $rest = $this->users->getUserById($user_name, $passold);
        if (empty($rest)) {
            echo json_encode(array('error' => false, 'msg' => "你输入的旧密码不匹配。"));
            return;
        }

        $result = $this->users->userpassportsave($user_name, $pass);

        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }
}
