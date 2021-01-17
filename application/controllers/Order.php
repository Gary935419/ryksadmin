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
     * 充值订单列表页
     */
    public function rechargeorder_list()
    {

        $start = isset($_GET['start']) ? $_GET['start'] : '';
        $end = isset($_GET['end']) ? $_GET['end'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allpage = $this->order->getrechargeorderAllPage($start,$end);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->order->getrechargeorderAll($page,$start,$end);
        $data["list"] = $list;
        $data["start"] = $start;
        $data["end"] = $end;
        $this->display("order/rechargeorder_list", $data);
    }
    /**
     * 任务订单列表页
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