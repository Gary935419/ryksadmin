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
		$this->load->model('Set_model', 'set');
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
		$account = isset($_GET['account']) ? $_GET['account'] : '';
		$allpage = $this->member->getdriverupAllPage($start,$end,$account);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->member->getdriverupAll($page,$start,$end,$account);
		$data["list"] = $list;
		$data["start"] = $start;
		$data["end"] = $end;
		$data["account"] = $account;
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
		$data['name'] = empty($driver_info['name'])?'':$driver_info['name'];
		$data['account'] = empty($driver_info['account'])?'':$driver_info['account'];
		$data['sex'] = $driver_info['sex'] == 1?'男':'女';
		$data['brand'] = empty($driver_info['brand'])?'':$driver_info['brand'];
		$data['attribute'] = empty($driver_info['attribute'])?'':$driver_info['attribute'];
		$data['cards'] = empty($driver_info['cards'])?'':$driver_info['cards'];
		$data['times'] = empty($driver_info['times'])?'':$driver_info['times'];
		$data['car_number'] = empty($driver_info['car_number'])?'':$driver_info['car_number'];

		$data['img_cards_face'] = strpos($driver_info['img_cards_face'],'http') !== false?$driver_info['img_cards_face']:'https://ryks.dltqwy.com/'.$driver_info['img_cards_face'];
		$data['img_cards_side'] = strpos($driver_info['img_cards_side'],'http') !== false?$driver_info['img_cards_side']:'https://ryks.dltqwy.com/'.$driver_info['img_cards_side'];
		$data['img_drivers'] = strpos($driver_info['img_drivers'],'http') !== false?$driver_info['img_drivers']:'https://ryks.dltqwy.com/'.$driver_info['img_drivers'];
		$data['img_vehicle'] = strpos($driver_info['img_vehicle'],'http') !== false?$driver_info['img_vehicle']:'https://ryks.dltqwy.com/'.$driver_info['img_vehicle'];
		$data['img_car_user'] = strpos($driver_info['img_car_user'],'http') !== false?$driver_info['img_car_user']:'https://ryks.dltqwy.com/'.$driver_info['img_car_user'];
		$data['img_worker'] = strpos($driver_info['img_worker'],'http') !== false?$driver_info['img_worker']:'https://ryks.dltqwy.com/'.$driver_info['img_worker'];

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
	public function examine_new_save_task2()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$id = isset($_POST["id"]) ? $_POST["id"] : '';
		$status = isset($_POST["status"]) ? $_POST["status"] : '3';
		$reason = isset($_POST["reason"]) ? $_POST["reason"] : '';
		$apply_info = $this->member->apply_info($id);
		$this->member->examine_new_save_task22($id,$status,$reason);
		$result = $this->member->examine_new_save_task2($apply_info['user_id']);
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
	 * 认证审核通过操作页  商户
	 */
	public function driver_examine2()
	{
		$oid = isset($_GET['id']) ? $_GET['id'] : 0;
		$data = array();
		$data['id'] = $oid;
		$this->display("member/driver_examine2", $data);
	}
	/**
	 * 认证审核通过操作页  商户
	 */
	public function driverno_examine2()
	{
		$oid = isset($_GET['id']) ? $_GET['id'] : 0;
		$data = array();
		$data['id'] = $oid;
		$this->display("member/driverno_examine2", $data);
	}
	/**
	 * 认证审核详情 代驾
	 */
	public function driver_examine_details1()
	{
		$data = array();
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$driver_info = $this->member->getdriverById($id);
		$data['name'] = empty($driver_info['driving_name'])?'':$driver_info['driving_name'];
		$data['account'] = empty($driver_info['account'])?'':$driver_info['account'];
		$data['sex'] = $driver_info['sex'] == 1?'男':'女';
		$data['driving_cards'] = empty($driver_info['driving_cards'])?'':$driver_info['driving_cards'];
		$data['driving_times'] = empty($driver_info['driving_times'])?'':$driver_info['driving_times'];
		$data['driving_car_number'] = empty($driver_info['driving_car_number'])?'':$driver_info['driving_car_number'];

		$data['driving_img_cards_face'] = strpos($driver_info['driving_img_cards_face'],'http') !== false?$driver_info['driving_img_cards_face']:'https://ryks.dltqwy.com/'.$driver_info['driving_img_cards_face'];
		$data['driving_img_cards_side'] = strpos($driver_info['driving_img_cards_side'],'http') !== false?$driver_info['driving_img_cards_side']:'https://ryks.dltqwy.com/'.$driver_info['driving_img_cards_side'];
		$data['driving_img_drivers'] = strpos($driver_info['driving_img_drivers'],'http') !== false?$driver_info['driving_img_drivers']:'https://ryks.dltqwy.com/'.$driver_info['driving_img_drivers'];
		$data['driving_img_worker'] = strpos($driver_info['driving_img_worker'],'http') !== false?$driver_info['driving_img_worker']:'https://ryks.dltqwy.com/'.$driver_info['driving_img_worker'];

		$this->display("member/driver_examine_details1",$data);
	}
	/**
	 * 商户审核详情
	 */
	public function driver_examine_details2()
	{
		$data = array();
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$driver_info = $this->member->getapplyById($id);
		$data['tabChangeContentValue'] = empty($driver_info['tabChangeContentValue'])?'':$driver_info['tabChangeContentValue'];
		$data['tabChangePnameValue'] = empty($driver_info['tabChangePnameValue'])?'':$driver_info['tabChangePnameValue'];
		$data['tabChangePtelValue'] = empty($driver_info['tabChangePtelValue'])?'':$driver_info['tabChangePtelValue'];
		$data['tabChangePname1Value'] = empty($driver_info['tabChangePname1Value'])?'':$driver_info['tabChangePname1Value'];
		$data['tabChangePtel1Value'] = empty($driver_info['tabChangePtel1Value'])?'':$driver_info['tabChangePtel1Value'];
		$data['tabChangePcardValue'] = empty($driver_info['tabChangePcardValue'])?'':$driver_info['tabChangePcardValue'];
		$data['tabChangeNumber1Value'] = empty($driver_info['tabChangeNumber1Value'])?'':$driver_info['tabChangeNumber1Value'];

		$imgs = $this->member->getapplyimglist($id);
		foreach ($imgs as $k=>$v){
			$imgs[$k]['path_server'] = strpos($v['path_server'],'http') !== false?$v['path_server']:'https://ryks.dltqwy.com/'.$v['path_server'];
		}
		$data['imgs'] = $imgs;

		$this->display("member/driver_examine_details2",$data);
	}
	/**
	 * 认证审核  代驾
	 */
	public function driver_uplist1()
	{
		$start = isset($_GET['start']) ? $_GET['start'] : '';
		$end = isset($_GET['end']) ? $_GET['end'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$account = isset($_GET['account']) ? $_GET['account'] : '';
		$allpage = $this->member->getdriverupAllPage1($start,$end,$account);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->member->getdriverupAll1($page,$start,$end,$account);
		$data["list"] = $list;
		$data["start"] = $start;
		$data["end"] = $end;
		$data["account"] = $account;
		$this->display("member/driver_uplist1", $data);
	}
	/**
	 * 商户审核
	 */
	public function driver_uplist2()
	{
		$start = isset($_GET['start']) ? $_GET['start'] : '';
		$end = isset($_GET['end']) ? $_GET['end'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$account = isset($_GET['account']) ? $_GET['account'] : '';
		$allpage = $this->member->getapplyAllPage($start,$end,$account);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->member->getapplyAll($page,$start,$end,$account);
		$data["list"] = $list;
		$data["start"] = $start;
		$data["end"] = $end;
		$data["account"] = $account;
		$this->display("member/driver_uplist2", $data);
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
	public function member_edit_audit()
	{
		$mid = isset($_GET['id']) ? $_GET['id'] : 0;
		$utype = isset($_GET['utype']) ? $_GET['utype'] : 1;
		$data = array();

		$tidlist = $this->member->gettidlist();
		$data['tidlist'] = $tidlist;
		$data['utype'] = $utype;
		$data['mid'] = $mid;

		$this->display("member/member_edit_audit", $data);
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
	 * 会员修改页
	 */
	public function send_coupon()
	{
		$mid = isset($_GET['id']) ? $_GET['id'] : 0;
		$data = array();
		$data['mid'] = $mid;
		$this->display("member/send_coupon", $data);
	}
	/**
	 * 会员发放优惠券
	 */
	public function send_coupon_go()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法发送优惠券"));
			return;
		}
		$mid = isset($_POST["mid"]) ? $_POST["mid"] : '';
		$nums = isset($_POST["nums"]) ? $_POST["nums"] : 0;

		$set_info1 = $this->set->set_edit_new();
		$data['price'] = $set_info1['price'];
		$data['days'] = floatval($set_info1['days']) * 86400;

		$coupon = [
			'user_id' => $mid,
			'money' => $data['price'],
			'type' => 1,
			'add_time' => time(),
			'end_time' => time() + $data['days']
		];
		for ($i=1; $i<=$nums; $i++)
		{
			$this->member->send_coupon_go($coupon['user_id'],$coupon['money'],$coupon['type'],$coupon['add_time'],$coupon['end_time']);
		}
		echo json_encode(array('success' => true, 'msg' => "发放成功。"));
		return;
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
	public function member_save_edit_audit()
	{
		$param = array();
		$param['id'] = isset($_POST['mid']) ? $_POST['mid'] : '';
		$param['md5'] = '4EF82E3603825745124695977A46E8C2';
		$param['sex'] = isset($_POST['sex']) ? $_POST['sex'] : 1;
		$param['name'] = isset($_POST['name']) ? $_POST['name'] : '';
		$param['cards'] = isset($_POST['cards']) ? $_POST['cards'] : '';
		$param['times'] = isset($_POST['times']) ? $_POST['times'] : '';
		$param['brand'] = isset($_POST['brand']) ? $_POST['brand'] : '';
		$param['car_number'] = isset($_POST['car_number']) ? $_POST['car_number'] : '';
		$param['attribute'] = isset($_POST['attribute']) ? $_POST['attribute'] : '';
		$param['car_type_id'] = isset($_POST['car_type_id']) ? $_POST['car_type_id'] : '';
		$param['check_type'] = isset($_POST['utype']) ? $_POST['utype'] : '';
		$param['img_cards_face'] = isset($_POST['img_cards_face']) ? $_POST['img_cards_face'] : '';
		$param['img_cards_side'] = isset($_POST['img_cards_side']) ? $_POST['img_cards_side'] : '';
		$param['img_drivers'] = isset($_POST['img_drivers']) ? $_POST['img_drivers'] : '';
		$param['img_vehicle'] = isset($_POST['img_vehicle']) ? $_POST['img_vehicle'] : '';
		$param['img_car_user'] = isset($_POST['img_car_user']) ? $_POST['img_car_user'] : '';
		$param['img_worker'] = isset($_POST['img_worker']) ? $_POST['img_worker'] : '';
		$url = "https://ryks.dltqwy.com/index.php/home/User/probate_updata";
		if ($this->send_post($url, $param)) {
			echo json_encode(array('success' => true, 'msg' => "操作成功"));
			return;
		} else {
			echo json_encode(array('success' => false, 'msg' => "操作失败"));
			return;
		}
	}
	function send_post($url, $param)
	{
		if (empty($url) || empty($param)) {
			return false;
		}
		$postUrl = $url;
		$curlPost = $param;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$postUrl);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
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
