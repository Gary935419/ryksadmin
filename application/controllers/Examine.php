<?php

/**
 * **********************************************************************
 * サブシステム名  ： Task
 * 機能名         ：审核
 * 作成者        ： Gary
 * **********************************************************************
 */
class Examine extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        $this->load->model('Examine_model', 'examine');
        $this->load->model('Member_model', 'member');
		$this->load->model('Order_model', 'order');
        header("Content-type:text/html;charset=utf-8");
    }
    /**
     * 提现审核列表页 司机
     */
    public function withdrawal_list()
    {

        $start = isset($_GET['start']) ? $_GET['start'] : '';
        $end = isset($_GET['end']) ? $_GET['end'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allpage = $this->examine->getwithdrawalAllPage($start,$end);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->examine->getwithdrawalAll($page,$start,$end);
        $data["list"] = $list;
        $data["start"] = $start;
        $data["end"] = $end;
        $this->display("examine/withdrawal_list", $data);
    }
	/**
	 * 提现列表页 乘客
	 */
	public function withdrawal_list1()
	{

		$start = isset($_GET['start']) ? $_GET['start'] : '';
		$end = isset($_GET['end']) ? $_GET['end'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->examine->getwithdrawalAllPage1($start,$end);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->examine->getwithdrawalAll1($page,$start,$end);
		$data["list"] = $list;
		$data["start"] = $start;
		$data["end"] = $end;
		$this->display("examine/withdrawal_list1", $data);
	}
	/**
	 * 跑腿订单列表页
	 */
	public function withdrawal_list2()
	{

		$start = isset($_GET['start']) ? $_GET['start'] : '';
		$end = isset($_GET['end']) ? $_GET['end'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;

		$allpage = $this->order->gettaskorderAllPage1($start,$end);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->order->gettaskorderAll1($page,$start,$end);
		$data["list"] = $list;
		$data["start"] = $start;
		$data["end"] = $end;
		$data["ordercount1"] = $this->examine->getOrder1Count($start,$end);
		$data["ordercount2"] = $this->examine->getOrder2Count($start,$end);
		$data["ordercount3"] = $this->examine->getOrder3Count($start,$end);
		$data["orderprice1"] = $this->examine->getOrder4Price($start,$end);
		$data["orderprice2"] = $this->examine->getOrder5Price($start,$end);
		$data["orderprice3"] = floatval($data["orderprice1"]) - floatval($data["orderprice2"]);
		$this->display("examine/withdrawal_list2", $data);
	}
	/**
	 * 代驾订单列表页
	 */
	public function withdrawal_list3()
	{

		$start = isset($_GET['start']) ? $_GET['start'] : '';
		$end = isset($_GET['end']) ? $_GET['end'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;

		$allpage = $this->order->gettaskorderAllPage2($start,$end);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->order->gettaskorderAll2($page,$start,$end);
		$data["list"] = $list;
		$data["start"] = $start;
		$data["end"] = $end;
		$data["ordercount1"] = $this->examine->getOrder1Count1($start,$end);
		$data["orderprice1"] = $this->examine->getOrder4Price1($start,$end);
		$data["orderprice2"] = $this->examine->getOrder5Price1($start,$end);
		$data["orderprice3"] = floatval($data["orderprice1"]) - floatval($data["orderprice2"]);
		$this->display("examine/withdrawal_list3", $data);
	}
    /**
     * 提现审核通过操作页
     */
    public function withdrawal_examine()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $data = array();
        $data['id'] = $id;
        $this->display("examine/withdrawal_examine", $data);
    }
    /**
     * 提现审核驳回操作页
     */
    public function withdrawalno_examine()
    {
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$data = array();
		$data['id'] = $id;
        $this->display("examine/withdrawalno_examine", $data);
    }
    /**
     * 审核操作提交
     */
    public function examine_new_save()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
        $id = isset($_POST["id"]) ? $_POST["id"] : '';
        $status = isset($_POST["status"]) ? $_POST["status"] : '';
        $reject = isset($_POST["reject"]) ? $_POST["reject"] : '';

        $withdrawal_info_state = $this->examine->getwithdrawalByIdstate($id);
        if (!empty($withdrawal_info_state)){
            echo json_encode(array('error' => false, 'msg' => "请勿重复操作"));
            return;
        }
        $withdrawal_info = $this->examine->getwithdrawalById($id);
        $driver_id = $withdrawal_info['driver_id'];
        if ($status == 2){
            $member_info = $this->examine->getmemberById($driver_id);
            $wallet = $member_info['money'];
            $wrprice = $withdrawal_info['money'];
            if($member_info['money'] < $withdrawal_info['money']){
				echo json_encode(array('error' => false, 'msg' => "抱歉!该用户余额不足!"));
				return;
			}
			$newwallet = floatval($wallet) - floatval($wrprice);
			$this->examine->member_save_edit($driver_id,$newwallet);
        }
        //状态修改
		$result = $this->examine->examine_new_save($id,$status,$reject);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }

    }
    /**
     * 任务审核列表页
     */
    public function task_list()
    {
        $start = isset($_GET['start']) ? $_GET['start'] : '';
        $end = isset($_GET['end']) ? $_GET['end'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allpage = $this->examine->gettaskAllPage($start,$end);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->examine->gettaskAll($page,$start,$end);
        $data["list"] = $list;
        $data["start"] = $start;
        $data["end"] = $end;
        $this->display("examine/task_list", $data);
    }
    /**
     * 任务审核详情列表页
     */
    public function task_examine_details()
    {
        $data = array();
        $oid = isset($_GET['oid']) ? $_GET['oid'] : 0;
        $task_info = $this->examine->gettaskById($oid);
        $data['address'] = empty($task_info['address'])?'':$task_info['address'];
        $data['content'] = empty($task_info['content'])?'':$task_info['content'];
        $data['email'] = empty($task_info['email'])?'':$task_info['email'];
        $oimgs = $this->examine->getoimgsall($oid);
        $data['oimgs'] = empty($oimgs)?'':$oimgs;
        $this->display("examine/task_examine_details",$data);
    }
    /**
     * 任务审核详情列表页
     */
    public function task_examine_details1()
    {
        $data = array();
        $ogid = isset($_GET['ogid']) ? $_GET['ogid'] : 0;
        $task_info = $this->examine->gettaskById1($ogid);
        $data['email'] = empty($task_info['email'])?'':$task_info['email'];
        $data['content'] = empty($task_info['content'])?'':$task_info['content'];
        $this->display("examine/task_examine_details1",$data);
    }
    /**
     * 任务审核通过操作页
     */
    public function task_examine()
    {
        $oid = isset($_GET['oid']) ? $_GET['oid'] : 0;
        $data = array();
        $data['oid'] = $oid;
        $this->display("examine/task_examine", $data);
    }
    /**
     * 任务审核驳回操作页
     */
    public function taskno_examine()
    {
        $oid = isset($_GET['oid']) ? $_GET['oid'] : 0;
        $data = array();
        $data['oid'] = $oid;
        $this->display("examine/taskno_examine", $data);
    }
    /**
     * 任务审核驳回操作页
     */
    public function goodsno_examine()
    {
        $ogid = isset($_GET['ogid']) ? $_GET['ogid'] : 0;
        $data = array();
        $data['ogid'] = $ogid;
        $this->display("examine/goodsno_examine", $data);
    }
    /**
     * 审核任务操作提交
     */
    public function examine_new_save_task()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
        $oid = isset($_POST["oid"]) ? $_POST["oid"] : '';
        $ostate = isset($_POST["ostate"]) ? $_POST["ostate"] : '';
        $tareject = isset($_POST["tareject"]) ? $_POST["tareject"] : '';

        $taorder_info_state = $this->examine->gettaorderByIdstate($oid);
        if (!empty($taorder_info_state)){
            echo json_encode(array('error' => false, 'msg' => "请勿重复操作"));
            return;
        }
        $taorder_info = $this->examine->gettaorderById($oid);
        $mid = $taorder_info['mid'];

        $result = $this->examine->examine_new_save_task($oid,$ostate,$tareject);
        if ($result) {
            $add_time = time();
            $if_flag = 2;
            //发送信息
            $this->member->member_new_save($mid,$tareject, $add_time, $if_flag);
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }

    }
    /**
     * 发货操作页
     */
    public function goods_examine()
    {
        $ogid = isset($_GET['ogid']) ? $_GET['ogid'] : 0;
        $data = array();
        $data['ogid'] = $ogid;
        $this->display("examine/goods_examine", $data);
    }
    /**
     * 发货操作提交
     */
    public function examinegoods_new_save_task()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
        $ogid = isset($_POST["ogid"]) ? $_POST["ogid"] : '';
        $tareject = isset($_POST["tareject"]) ? $_POST["tareject"] : '';
        $gotime = time();
        $taorder_info_state = $this->examine->getinorderByIdstate($ogid);
        if (!empty($taorder_info_state)){
            echo json_encode(array('error' => false, 'msg' => "请勿重复操作"));
            return;
        }
        $mid = $taorder_info_state['mid'];
        $result = $this->examine->examineintegral_new_save_task($ogid,$tareject,$gotime);
        if ($result) {
            $add_time = time();
            $if_flag = 2;
            //发送信息
            $this->member->member_new_save($mid,$tareject, $add_time, $if_flag);
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }
    /**
     * 发货操作提交
     */
    public function examinegoods_new_save_task1()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
        $ogid = isset($_POST["ogid"]) ? $_POST["ogid"] : '';
        $tareject = isset($_POST["tareject"]) ? $_POST["tareject"] : '';
        $gotime = time();
        $taorder_info_state = $this->examine->getinorderByIdstate1($ogid);
        if (!empty($taorder_info_state)){
            echo json_encode(array('error' => false, 'msg' => "请勿重复操作"));
            return;
        }
        $mid = $taorder_info_state['mid'];
        $result = $this->examine->examineintegral_new_save_task1($ogid,$tareject,$gotime);
        if ($result) {
            $add_time = time();
            $if_flag = 2;
            //发送信息
            $this->member->member_new_save($mid,$tareject, $add_time, $if_flag);
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }
}
