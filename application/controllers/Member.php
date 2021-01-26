<?php

/**
 * **********************************************************************
 * サブシステム名  ： TASK
 * 機能名         ：会员
 * 作成者        ： Gary
 * **********************************************************************
 */
class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        $this->load->model('Member_model', 'member');
        header("Content-type:text/html;charset=utf-8");
    }
	/**
	 * 认证审核  跑腿
	 */
	public function driver_uplist()
	{
		$start = isset($_GET['start']) ? $_GET['start'] : '';
		$end = isset($_GET['end']) ? $_GET['end'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->member->getdriverupAllPage($start,$end);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->member->getdriverupAll($page,$start,$end);
		$data["list"] = $list;
		$data["start"] = $start;
		$data["end"] = $end;
		$this->display("member/driver_uplist", $data);
	}
	/**
	 * 认证审核详情 跑腿
	 */
	public function driver_examine_details()
	{
		$data = array();
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$driver_info = $this->member->getdriverById($id);
		$car_info = $this->member->car_info($driver_info['car_type_id']);
		$data['car_name'] = empty($car_info['name'])?'':$car_info['name'];
		$data['brand'] = empty($driver_info['brand'])?'':$driver_info['brand'];
		$data['attribute'] = empty($driver_info['attribute'])?'':$driver_info['attribute'];
		$data['cards'] = empty($driver_info['cards'])?'':$driver_info['cards'];
		$data['times'] = empty($driver_info['times'])?'':$driver_info['times'];
		$data['car_number'] = empty($driver_info['car_number'])?'':$driver_info['car_number'];
		$data['img_cards_face'] = empty($driver_info['img_cards_face'])?'':$driver_info['img_cards_face'];
		$data['img_cards_side'] = empty($driver_info['img_cards_side'])?'':$driver_info['img_cards_side'];
		$data['img_drivers'] = empty($driver_info['img_drivers'])?'':$driver_info['img_drivers'];
		$data['img_vehicle'] = empty($driver_info['img_vehicle'])?'':$driver_info['img_vehicle'];
		$data['img_car_user'] = empty($driver_info['img_car_user'])?'':$driver_info['img_car_user'];
		$data['img_worker'] = empty($driver_info['img_worker'])?'':$driver_info['img_worker'];
		$this->display("member/driver_examine_details",$data);
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
		$id = isset($_POST["id"]) ? $_POST["id"] : '';
		$user_check = isset($_POST["user_check"]) ? $_POST["user_check"] : '3';
		$reason = isset($_POST["reason"]) ? $_POST["reason"] : '';

		$result = $this->member->examine_new_save_task($id,$user_check,$reason);
		if ($result) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
			return;
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
			return;
		}
	}
	public function examine_new_save_task1()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$id = isset($_POST["id"]) ? $_POST["id"] : '';
		$driving_check = isset($_POST["driving_check"]) ? $_POST["driving_check"] : '3';
		$reason = isset($_POST["reason"]) ? $_POST["reason"] : '';

		$result = $this->member->examine_new_save_task1($id,$driving_check,$reason);
		if ($result) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
			return;
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
			return;
		}
	}
	/**
	 * 认证审核通过操作页  跑腿
	 */
	public function driver_examine()
	{
		$oid = isset($_GET['id']) ? $_GET['id'] : 0;
		$data = array();
		$data['id'] = $oid;
		$this->display("member/driver_examine", $data);
	}
	/**
	 * 认证审核通过操作页  跑腿
	 */
	public function driverno_examine()
	{
		$oid = isset($_GET['id']) ? $_GET['id'] : 0;
		$data = array();
		$data['id'] = $oid;
		$this->display("member/driverno_examine", $data);
	}
	/**
	 * 认证审核通过操作页  代驾
	 */
	public function driver_examine1()
	{
		$oid = isset($_GET['id']) ? $_GET['id'] : 0;
		$data = array();
		$data['id'] = $oid;
		$this->display("member/driver_examine1", $data);
	}
	/**
	 * 认证审核通过操作页  代驾
	 */
	public function driverno_examine1()
	{
		$oid = isset($_GET['id']) ? $_GET['id'] : 0;
		$data = array();
		$data['id'] = $oid;
		$this->display("member/driverno_examine1", $data);
	}
	/**
	 * 认证审核详情 代驾
	 */
	public function driver_examine_details1()
	{
		$data = array();
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$driver_info = $this->member->getdriverById($id);
		$data['driving_cards'] = empty($driver_info['driving_cards'])?'':$driver_info['driving_cards'];
		$data['driving_times'] = empty($driver_info['driving_times'])?'':$driver_info['driving_times'];
		$data['driving_car_number'] = empty($driver_info['driving_car_number'])?'':$driver_info['driving_car_number'];
		$data['driving_img_cards_face'] = empty($driver_info['driving_img_cards_face'])?'':$driver_info['driving_img_cards_face'];
		$data['driving_img_cards_side'] = empty($driver_info['driving_img_cards_side'])?'':$driver_info['driving_img_cards_side'];
		$data['driving_img_drivers'] = empty($driver_info['driving_img_drivers'])?'':$driver_info['driving_img_drivers'];
		$data['driving_img_worker'] = empty($driver_info['driving_img_worker'])?'':$driver_info['driving_img_worker'];
		$this->display("member/driver_examine_details1",$data);
	}
	/**
	 * 认证审核  代驾
	 */
	public function driver_uplist1()
	{
		$start = isset($_GET['start']) ? $_GET['start'] : '';
		$end = isset($_GET['end']) ? $_GET['end'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->member->getdriverupAllPage1($start,$end);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->member->getdriverupAll1($page,$start,$end);
		$data["list"] = $list;
		$data["start"] = $start;
		$data["end"] = $end;
		$this->display("member/driver_uplist1", $data);
	}
	/**
	 * 报备一览  跑腿
	 */
	public function complaint_list()
	{
		$account = isset($_GET['account']) ? $_GET['account'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->member->getcomplaintAllPage($account);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->member->getcomplaintAll($page, $account);
		$data["list"] = $list;
		$data["account"] = $account;
		$this->display("member/complaint_list", $data);
	}
	/**
	 * 报备一览  代驾
	 */
	public function complaint_list1()
	{
		$account = isset($_GET['account']) ? $_GET['account'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->member->getcomplaintAllPage1($account);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->member->getcomplaintAll1($page, $account);
		$data["list"] = $list;
		$data["account"] = $account;
		$this->display("member/complaint_list1", $data);
	}
    /**
     * 用户列表页
     */
    public function member_list()
    {
        $account = isset($_GET['account']) ? $_GET['account'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allpage = $this->member->getmemberAllPage($account);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->member->getmemberAll($page, $account);
        $data["list"] = $list;
        $data["account"] = $account;
        $this->display("member/member_list", $data);
    }
	/**
	 * 司机列表页
	 */
	public function member_list1()
	{
		$account = isset($_GET['account']) ? $_GET['account'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->member->getmemberAllPage1($account);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->member->getmemberAll1($page, $account);
		$data["list"] = $list;
		$data["account"] = $account;
		$this->display("member/member_list1", $data);
	}
	/**
	 * 司机列表页  派单   代驾
	 */
	public function member_list2()
	{
		$account = isset($_GET['account']) ? $_GET['account'] : '';
		$order_id = isset($_GET['id']) ? $_GET['id'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->member->getmemberAllPage1($account);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->member->getmemberAll1($page, $account);
		foreach ($list as $k=>$v){
			$list[$k]['order_id'] = $order_id;
		}
		$data["list"] = $list;
		$data["account"] = $account;
		$data["order_id"] = $order_id;
		$this->display("member/member_list2", $data);
	}
	/**
	 * 司机列表页  派单  跑腿
	 */
	public function member_list3()
	{
		$account = isset($_GET['account']) ? $_GET['account'] : '';
		$order_id = isset($_GET['id']) ? $_GET['id'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->member->getmemberAllPage1($account);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->member->getmemberAll1($page, $account);
		foreach ($list as $k=>$v){
			$list[$k]['order_id'] = $order_id;
		}
		$data["list"] = $list;
		$data["account"] = $account;
		$data["order_id"] = $order_id;
		$this->display("member/member_list3", $data);
	}
    /**
     * 会员修改页
     */
    public function member_edit()
    {
        $mid = isset($_GET['id']) ? $_GET['id'] : 0;
        $data = array();

        $member_info = $this->member->getmemberById($mid);
        $data['credit_points'] = $member_info['credit_points'];
        $data['is_logoff'] = $member_info['is_logoff'];
		$data['user_type'] = $member_info['type'] == 2 ? 1:0;
        $data['mid'] = $mid;

        $this->display("member/member_edit", $data);
    }
    /**
     * 会员修改提交
     */
    public function member_save_edit()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
        $mid = isset($_POST["mid"]) ? $_POST["mid"] : '';
        $credit_points = isset($_POST["credit_points"]) ? $_POST["credit_points"] : '100';
        $is_logoff = isset($_POST["is_logoff"]) ? $_POST["is_logoff"] : '1';
        $result = $this->member->member_save_edit($mid,$credit_points,$is_logoff);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }

    }
    /**
     * 发送消息页
     */
    public function send_news()
    {
        $mid = isset($_GET['mid']) ? $_GET['mid'] : 0;
        $data = array();
        $data['mid'] = $mid;
        $this->display("member/send_news", $data);
    }
    /**
     * 发送消息提交
     */
    public function member_new_save()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
        $mid = isset($_POST["mid"]) ? $_POST["mid"] : '';
        $ncontent = isset($_POST["ncontent"]) ? $_POST["ncontent"] : '';
        $add_time = time();
        $add_timeend = time()-5;
        $if_flag = 2;
        $news_info = $this->member->getnewsinfo($mid,$add_timeend,$add_time);
        if (!empty($news_info)){
            echo json_encode(array('error' => false, 'msg' => "发送消息过于频繁,请稍后再试。"));
            return;
        }
        $result = $this->member->member_new_save($mid,$ncontent, $add_time, $if_flag);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }
}
