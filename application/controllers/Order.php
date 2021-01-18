<?php

/**
 * **********************************************************************
 * サブシステム名  ： Task
 * 機能名         ：订单
 * 作成者        ： Gary
 * **********************************************************************
 */
class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        $this->load->model('Order_model', 'order');
        header("Content-type:text/html;charset=utf-8");
    }

    /**
     * 代驾订单列表页
     */
    public function taskorder_list()
    {

        $start = isset($_GET['start']) ? $_GET['start'] : '';
        $end = isset($_GET['end']) ? $_GET['end'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;

        $allpage = $this->order->gettaskorderAllPage($start,$end);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->order->gettaskorderAll($page,$start,$end);
        $data["list"] = $list;
        $data["start"] = $start;
        $data["end"] = $end;
        $this->display("order/taskorder_list", $data);
    }
	/**
	 * 跑腿订单列表页
	 */
	public function taskorder_list1()
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
		$this->display("order/taskorder_list1", $data);
	}
	/**
	 * 认证审核详情 代驾
	 */
	public function driver_examine_details()
	{
		$data = array();
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$driver_info = $this->order->getorderById($id);
		$data['number'] = empty($driver_info['number'])?'':$driver_info['number'];
		$data['price'] = empty($driver_info['price'])?'':$driver_info['price'];
		$data['preferential_price'] = empty($driver_info['preferential_price'])?'':$driver_info['preferential_price'];
		$data['appointment_time'] = empty($driver_info['appointment_time'])?'':$driver_info['appointment_time'];
		$data['getorder_time'] = empty($driver_info['getorder_time'])?'':$driver_info['getorder_time'];
		$data['takeup_time'] = empty($driver_info['takeup_time'])?'':$driver_info['takeup_time'];
		$data['complete_time'] = empty($driver_info['complete_time'])?'':$driver_info['complete_time'];
		$data['remarks'] = empty($driver_info['remarks'])?'':$driver_info['remarks'];
		$data['distribution_km'] = empty($driver_info['distribution_km'])?'':$driver_info['distribution_km'];
		$data['tip_price'] = empty($driver_info['tip_price'])?'':$driver_info['tip_price'];
		$data['evaluate'] = empty($driver_info['evaluate'])?'':$driver_info['evaluate'];
		$data['address1'] = empty($driver_info['address1'])?'':$driver_info['address1'];
		$data['address2'] = empty($driver_info['address2'])?'':$driver_info['address2'];
		$this->display("order/driver_examine_details",$data);
	}
	/**
	 * 认证审核详情 跑腿
	 */
	public function driver_examine_details1()
	{
		$data = array();
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$driver_info = $this->order->getorderById1($id);
		$data['number'] = empty($driver_info['number'])?'':$driver_info['number'];
		$data['price'] = empty($driver_info['price'])?'':$driver_info['price'];
		$data['goods_name'] = empty($driver_info['goods_name'])?'':$driver_info['goods_name'];
		$data['preferential_price'] = empty($driver_info['preferential_price'])?'':$driver_info['preferential_price'];
		$data['appointment_time'] = empty($driver_info['appointment_time'])?'':$driver_info['appointment_time'];
		$data['getorder_time'] = empty($driver_info['getorder_time'])?'':$driver_info['getorder_time'];
		$data['takegoods_time'] = empty($driver_info['takegoods_time'])?'':$driver_info['takegoods_time'];
		$data['complete_time'] = empty($driver_info['complete_time'])?'':$driver_info['complete_time'];
		$data['goods_remarks'] = empty($driver_info['goods_remarks'])?'':$driver_info['goods_remarks'];
		$data['distribution_km'] = empty($driver_info['distribution_km'])?'':$driver_info['distribution_km'];
		$data['tip_price'] = empty($driver_info['tip_price'])?'':$driver_info['tip_price'];
		$data['protect_price'] = empty($driver_info['protect_price'])?'':$driver_info['protect_price'];
		$data['evaluate'] = empty($driver_info['evaluate'])?'':$driver_info['evaluate'];
		$data['address1'] = empty($driver_info['address1'])?'':$driver_info['address1'];
		$data['address2'] = empty($driver_info['address2'])?'':$driver_info['address2'];
		$data['name'] = empty($driver_info['name'])?'':$driver_info['name'];
		$data['tel'] = empty($driver_info['tel'])?'':$driver_info['tel'];
		$this->display("order/driver_examine_details1",$data);
	}
	/**
	 * 发送通知
	 */
	public function order_send()
	{
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$type = isset($_POST['type']) ? $_POST['type'] : 1;
		$param = array();
		$param['id'] = $id;
		$param['type'] = $type;
		$url = "https://ryks.ychlkj.cn/index.php/home/UserCall/order_send";
		if ($this->send_post($url, $param)) {
			echo json_encode(array('success' => true, 'msg' => "发送成功"));
			return;
		} else {
			echo json_encode(array('success' => false, 'msg' => "发送失败"));
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
}
