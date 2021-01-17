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
	 * 认证审核详情 跑腿
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
		$data['order_evaluation'] = empty($driver_info['order_evaluation'])?'':$driver_info['order_evaluation'];
		$data['address1'] = empty($driver_info['address1'])?'':$driver_info['address1'];
		$data['address2'] = empty($driver_info['address2'])?'':$driver_info['address2'];
		$this->display("order/driver_examine_details",$data);
	}
    /**
     * 积分订单列表页
     */
    public function integralorder_list()
    {

        $start = isset($_GET['start']) ? $_GET['start'] : '';
        $end = isset($_GET['end']) ? $_GET['end'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;

        $allpage = $this->order->getintegralorderAllPage($start,$end);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->order->getintegralorderAll($page,$start,$end);
        $data["list"] = $list;
        $data["start"] = $start;
        $data["end"] = $end;
        $this->display("order/integralorder_list", $data);
    }

}
