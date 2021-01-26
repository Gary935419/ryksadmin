<?php

/**
 * **********************************************************************
 * サブシステム名  ： Task
 * 機能名         ：类型
 * 作成者        ： Gary
 * **********************************************************************
 */
class Taskclass extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        $this->load->model('Taskclass_model', 'taskclass');
        header("Content-type:text/html;charset=utf-8");
    }
	/**
	 * 实时监控
	 */
	public function monitoring()
	{
		$update_time = floatval(time()) - 300;
		$count1 = $this->taskclass->getdriverCount(1,$update_time);
		$count2 = $this->taskclass->getdriverCount(2,$update_time);
		$list = $this->taskclass->getdriverList($update_time);
		$data = array();
		$data['count1'] = $count1;
		$data['count2'] = floatval($count2) - floatval($count1);
		$str = "";
		$str_name = "";
		$str_account = "";
		$str_number = "";
		foreach ($list as $k => $v){
			if ($k < 1){
				$str = $v['latitude'] . "," . $v['longitude'];
				$str_name = $v['name'];
				$str_account = $v['account'];
				$str_number = $v['car_number'];
			}else{
				$str = $str . ";" . $v['latitude'] . "," . $v['longitude'];
				$str_name = $str_name . ";" . $v['name'];
				$str_account = $str_account . ";" . $v['account'];
				$str_number = $str_number . ";" . $v['car_number'];
			}
		}
		$data['str'] = $str;
		$data['str_name'] = $str_name;
		$data['str_account'] = $str_account;
		$data['str_number'] = $str_number;
		$this->display("taskclass/monitoring",$data);
	}
	public function monitoringing()
	{
		$update_time = floatval(time()) - 300;
		$count1 = $this->taskclass->getdriverCount(1,$update_time);
		$count2 = $this->taskclass->getdriverCount(2,$update_time);
		$list = $this->taskclass->getdriverList($update_time);
		$data = array();
		$data['count1'] = $count1;
		$data['count2'] = floatval($count2) - floatval($count1);
		$str = "";
		$str_name = "";
		$str_account = "";
		foreach ($list as $k => $v){
			if ($k < 1){
				$str = $v['latitude'] . "," . $v['longitude'];
				$str_name = $v['name'];
				$str_account = $v['account'];
			}else{
				$str = $str . ";" . $v['latitude'] . "," . $v['longitude'];
				$str_name = $str_name . ";" . $v['name'];
				$str_account = $str_account . ";" . $v['account'];
			}
		}
		$data['str'] = $str;
		$data['str_name'] = $str_name;
		$data['str_account'] = $str_account;
		echo json_encode(array('success' => true, 'str' => $str, 'str_name' => $str_name, 'str_account' => $str_account));
		return;
	}
    /**
     * 优惠券列表页
     */
    public function taskclass_list()
    {
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allpage = $this->taskclass->gettaskclassAllPage();
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->taskclass->gettaskclassAllNew($page);
        $data["list"] = $list;
        $this->display("taskclass/taskclass_list", $data);
    }
	/**
	 * 删除
	 */
	public function taskclass_delete()
	{
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		if ($this->taskclass->taskclass_delete($id)) {
			echo json_encode(array('success' => true, 'msg' => "删除成功"));
			return;
		} else {
			echo json_encode(array('success' => false, 'msg' => "删除失败"));
			return;
		}
	}
	/**
	 * 推荐金(司机)
	 */
	public function taskclass_list1()
	{
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->taskclass->gettaskclassAllPage1();
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->taskclass->gettaskclassAllNew1($page);
		$data["list"] = $list;
		$this->display("taskclass/taskclass_list1", $data);
	}




    /**
     * 类型添加页
     */
    public function taskclass_add()
    {
        $this->display("taskclass/taskclass_add");
    }
    /**
     * 类型添加提交
     */
    public function taskclass_save()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
            return;
        }

        $tname = isset($_POST["tname"]) ? $_POST["tname"] : '';
        $timg = isset($_POST["timg"]) ? $_POST["timg"] : '';
        $tsort = isset($_POST["tsort"]) ? $_POST["tsort"] : '';
        $add_time = time();

        $taskclass_info = $this->taskclass->gettaskclassByname($tname);
        if (!empty($taskclass_info)) {
            echo json_encode(array('error' => true, 'msg' => "该类型名称已经存在。"));
            return;
        }
        $result = $this->taskclass->taskclass_save($tname, $timg,$tsort, $add_time);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }

    /**
     * 类型修改页
     */
    public function taskclass_edit()
    {
        $tid = isset($_GET['tid']) ? $_GET['tid'] : 0;
        $taskclass_info = $this->taskclass->gettaskclassById($tid);
        if (empty($taskclass_info)) {
            echo json_encode(array('error' => true, 'msg' => "数据错误"));
            return;
        }
        $data = array();
        $data['tname'] = $taskclass_info['tname'];
        $data['timg'] = $taskclass_info['timg'];
        $data['tsort'] = $taskclass_info['tsort'];
        $data['tid'] = $tid;
        $this->display("taskclass/taskclass_edit", $data);
    }
    /**
     * 类型修改提交
     */
    public function taskclass_save_edit()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
        $tname = isset($_POST["tname"]) ? $_POST["tname"] : '';
        $timg = isset($_POST["timg"]) ? $_POST["timg"] : '';
        $tsort = isset($_POST["tsort"]) ? $_POST["tsort"] : '';
        $tid = isset($_POST["tid"]) ? $_POST["tid"] : '';
        $taskclass_info = $this->taskclass->gettaskclassById2($tname, $tid);
        if (!empty($taskclass_info)){
            echo json_encode(array('error' => false, 'msg' => "该类型名称已经存在"));
            return;
        }

        $result = $this->taskclass->taskclass_save_edit($tid, $tname, $timg, $tsort);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }

}
