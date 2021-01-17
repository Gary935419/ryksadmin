<?php

/**
 * **********************************************************************
 * サブシステム名  ： Task
 * 機能名         ：流水
 * 作成者        ： Gary
 * **********************************************************************
 */
class Record extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        $this->load->model('Record_model', 'record');
        header("Content-type:text/html;charset=utf-8");
    }
    /**
     * 钱包流水列表页
     */
    public function wallet_list()
    {

        $start = isset($_GET['start']) ? $_GET['start'] : '';
        $end = isset($_GET['end']) ? $_GET['end'] : '';
        $wtype = isset($_GET['wtype']) ? $_GET['wtype'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;

        $allpage = $this->record->getwalletAllPage($wtype,$start,$end);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->record->getwalletAll($page, $wtype,$start,$end);
        $data["list"] = $list;
        $data["wtype"] = $wtype;
        $data["start"] = $start;
        $data["end"] = $end;
        $this->display("record/wallet_list", $data);
    }
    /**
     * 积分流水列表页
     */
    public function integral_list()
    {

        $start = isset($_GET['start']) ? $_GET['start'] : '';
        $end = isset($_GET['end']) ? $_GET['end'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;

        $allpage = $this->record->getintegralAllPage($start,$end);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->record->getintegralAll($page,$start,$end);
        $data["list"] = $list;
        $data["start"] = $start;
        $data["end"] = $end;
        $this->display("record/integral_list", $data);
    }

}