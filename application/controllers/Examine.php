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
        header("Content-type:text/html;charset=utf-8");
    }
    /**
     * 提现审核列表页
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
     * 提现审核通过操作页
     */
    public function withdrawal_examine()
    {
        $wrid = isset($_GET['wrid']) ? $_GET['wrid'] : 0;
        $data = array();
        $data['wrid'] = $wrid;
        $this->display("examine/withdrawal_examine", $data);
    }
    /**
     * 提现审核驳回操作页
     */
    public function withdrawalno_examine()
    {
        $wrid = isset($_GET['wrid']) ? $_GET['wrid'] : 0;
        $data = array();
        $data['wrid'] = $wrid;
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
        $wrid = isset($_POST["wrid"]) ? $_POST["wrid"] : '';
        $wrstate = isset($_POST["wrstate"]) ? $_POST["wrstate"] : '';
        $reject = isset($_POST["reject"]) ? $_POST["reject"] : '';

        $withdrawal_info_state = $this->examine->getwithdrawalByIdstate($wrid);
        if (!empty($withdrawal_info_state)){
            echo json_encode(array('error' => false, 'msg' => "请勿重复操作"));
            return;
        }
        $withdrawal_info = $this->examine->getwithdrawalById($wrid);
        $mid = $withdrawal_info['mid'];
        if ($wrstate == 3){
            $member_info = $this->examine->getmemberById($mid);
            $wallet = $member_info['wallet'];
            $walletcommission = $member_info['walletcommission'];
            $wrprice = $withdrawal_info['wrprice'];
            if ($withdrawal_info['wtype'] == 1){
                //押金驳回
                $newwallet = floatval($wallet) + floatval($wrprice);
                $this->examine->member_save_edit($mid, $newwallet);
                $wprice = $wrprice;
                $add_time1=time();
                $wtype = 6;
                $wremark = "押金提现审核不通过，金额返还。";
                $this->examine->withdrawal_save($wprice,$add_time1,$mid,$wtype,$wremark);
            }else{
                //佣金驳回
                $newwalletcommission = floatval($walletcommission) + floatval($wrprice);
                $this->examine->member_save_edit_new($mid, $newwalletcommission);
                $wprice = $wrprice;
                $add_time1=time();
                $wtype = 8;
                $wremark = "佣金提现审核不通过，金额返还。";
                $this->examine->withdrawal_save($wprice,$add_time1,$mid,$wtype,$wremark);
            }
        }
        //状态修改
        $this->examine->examine_new_save($wrid,$wrstate,$reject);
        $add_time = time();
        $if_flag = 2;
        //发送信息
        $result = $this->member->member_new_save($mid,$reject, $add_time, $if_flag);
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