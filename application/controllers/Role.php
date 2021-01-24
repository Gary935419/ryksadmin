<?php

/**
 * **********************************************************************
 * サブシステム名  ： Task
 * 機能名         ：角色
 * 作成者        ： Gary
 * **********************************************************************
 */
class Role extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        $this->load->model('Users_model', 'users');
        $this->load->model('Role_model', 'role');
        header("Content-type:text/html;charset=utf-8");
    }
    /**
     * 角色列表页
     */
    public function role_list()
    {

        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allpage = $this->role->getroleAllPage();
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $data["list"] = $this->role->getroleAllNew($page);

        $this->display("role/role_list", $data);
    }
    /**
     * 角色添加页
     */
    public function role_add()
    {
        $this->display("role/role_add");
    }
    /**
     * 角色添加提交
     */
    public function role_save()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
            return;
        }

        $rname = isset($_POST["rname"]) ? $_POST["rname"] : '';
        $rdetails = isset($_POST["rdetails"]) ? $_POST["rdetails"] : '';
		$menu = isset($_POST["menu"]) ? $_POST["menu"] : '';
        $add_time = time();
        if (empty($rname) || empty($rdetails)) {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
        $role_info = $this->role->getroleByname($rname);
        if (!empty($role_info)) {
            echo json_encode(array('error' => true, 'msg' => "该角色已经存在。"));
            return;
        }
        $rid = $this->role->role_save($rname, $rdetails, $add_time);
        if ($rid) {
        	foreach ($menu as $k=>$v){
				$this->role->rtom_save($rid,$v);
			}
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }
    /**
     * 角色删除
     */
    public function role_delete()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        if ($this->role->role_delete($id)) {
			$this->role->role_delete_rtom($id);
            echo json_encode(array('success' => true, 'msg' => "删除成功"));
            return;
        } else {
            echo json_encode(array('success' => false, 'msg' => "删除失败"));
            return;
        }
    }
    /**
     * 角色修改页
     */
    public function role_edit()
    {
        $rid = isset($_GET['rid']) ? $_GET['rid'] : 0;
        $role_info = $this->role->getroleById($rid);
        if (empty($role_info)) {
            echo json_encode(array('error' => true, 'msg' => "数据错误"));
            return;
        }
        $data = array();
        $data['rname'] = $role_info['rname'];
        $data['rdetails'] = $role_info['rdetails'];
        $data['rid'] = $rid;
		$data['role_status1'] = empty($this->role->getroleByIdRtom($rid,1))?0:1;
		$data['role_status2'] = empty($this->role->getroleByIdRtom($rid,2))?0:1;
		$data['role_status3'] = empty($this->role->getroleByIdRtom($rid,3))?0:1;
		$data['role_status4'] = empty($this->role->getroleByIdRtom($rid,4))?0:1;
		$data['role_status5'] = empty($this->role->getroleByIdRtom($rid,5))?0:1;
		$data['role_status6'] = empty($this->role->getroleByIdRtom($rid,6))?0:1;
		$data['role_status7'] = empty($this->role->getroleByIdRtom($rid,7))?0:1;
		$data['role_status8'] = empty($this->role->getroleByIdRtom($rid,8))?0:1;
        $this->display("role/role_edit", $data);
    }
    /**
     * 角色修改提交
     */
    public function role_save_edit()
    {
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$rid = isset($_POST["rid"]) ? $_POST["rid"] : '';
		$rname = isset($_POST["rname"]) ? $_POST["rname"] : '';
		$rdetails = isset($_POST["rdetails"]) ? $_POST["rdetails"] : '';
		$menu = isset($_POST["menu"]) ? $_POST["menu"] : '';
		if (empty($rname) || empty($rdetails)) {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
			return;
		}
		$this->role->role_delete_rtom($rid);
		if ($rid) {
			foreach ($menu as $k=>$v){
				$this->role->rtom_save($rid,$v);
			}
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
			return;
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
			return;
		}
    }

}
