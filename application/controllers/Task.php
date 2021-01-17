<?php

/**
 * **********************************************************************
 * サブシステム名  ： Task
 * 機能名         ：任务
 * 作成者        ： Gary
 * **********************************************************************
 */
class Task extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        $this->load->model('Task_model', 'task');
        header("Content-type:text/html;charset=utf-8");
    }
    /**
     * 任务列表页
     */
    public function task_list()
    {
        $tatitle = isset($_GET['tatitle']) ? $_GET['tatitle'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allpage = $this->task->gettaskAllPage($tatitle);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->task->gettaskAllNew($page, $tatitle);
        $data["list"] = $list;
        $data["tatitle"] = $tatitle;
        $this->display("task/task_list", $data);
    }
    /**
     * 任务添加页
     */
    public function task_add()
    {
        $data = array();
        $tidlist = $this->task->gettidlist();
        $data['tidlist'] = $tidlist;
        $laidslist = $this->task->getlaidslist();
        $data['laidslist'] = $laidslist;
        $this->display("task/task_add",$data);
    }
    /**
     * 任务添加提交
     */
    public function task_save()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
            return;
        }

        $tid = isset($_POST["tid"]) ? $_POST["tid"] : '';
        $tanums = isset($_POST["tanums"]) ? $_POST["tanums"] : '';
        $tacommission = isset($_POST["tacommission"]) ? $_POST["tacommission"] : '';
        $laids = isset($_POST["laids"]) ? $_POST["laids"] : '';
        $tatitle = isset($_POST["tatitle"]) ? $_POST["tatitle"] : '';
        $taimg = isset($_POST["taimg"]) ? $_POST["taimg"] : '';
        $if_recommend = isset($_POST["if_recommend"]) ? $_POST["if_recommend"] : '1';
        $constraintdays = isset($_POST["constraintdays"]) ? $_POST["constraintdays"] : '';
        $tadays = isset($_POST["tadays"]) ? $_POST["tadays"] : '';
        $examinedays = isset($_POST["examinedays"]) ? $_POST["examinedays"] : '';
        $tadeposit = isset($_POST["tadeposit"]) ? $_POST["tadeposit"] : '0';
        $taintegral = isset($_POST["taintegral"]) ? $_POST["taintegral"] : '';
        $requirement = isset($_POST["requirement"]) ? $_POST["requirement"] : '';
        $tatips = isset($_POST["tatips"]) ? $_POST["tatips"] : '';
        $tacontents = isset($_POST["tacontents"]) ? $_POST["tacontents"] : '';
        $taurl = isset($_POST["taurl"]) ? $_POST["taurl"] : '';
        $add_time = time();
        $laidsnew = "";
        if (!empty($laids)){
            foreach ($laids as $k=>$v){
                if (empty($laidsnew)){
                    $laidsnew = $v . ",";
                }else{
                    $laidsnew = $laidsnew . $v . ",";
                }
            }
        }
        $taid = $this->createNonceStr();
        $set_info = $this->task->getsetById();
        if ($set_info['min_deposit']>$tadeposit){
            echo json_encode(array('error' => true, 'msg' => "任务押金最小值为:".$set_info['min_deposit']."。"));
            return;
        }
//        $task_info = $this->task->gettaskByname($tatitle);
//        if (!empty($task_info)) {
//            echo json_encode(array('error' => true, 'msg' => "该任务标题已经存在。"));
//            return;
//        }

        $result = $this->task->task_save($taurl,$requirement,$tatips,$tacontents,$tid, $tanums,$tacommission,$laidsnew,$tatitle,$taimg,$if_recommend,$constraintdays,$tadays,$examinedays,$tadeposit,$taintegral,$add_time,$taid);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }
    /**
     * 生成随机字符串
     * @author
     * @param int $length
     * @return string
     */
    function createNonceStr($length = 20) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
    /**
     * 任务删除
     */
    public function task_delete()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        if ($this->task->task_delete($id)) {
            echo json_encode(array('success' => true, 'msg' => "删除成功"));
            return;
        } else {
            echo json_encode(array('success' => false, 'msg' => "删除失败"));
            return;
        }
    }
    /**
     * 任务修改页
     */
    public function task_edit()
    {
        $taid = isset($_GET['taid']) ? $_GET['taid'] : 0;
        $task_info = $this->task->gettaskById($taid);
        if (empty($task_info)) {
            echo json_encode(array('error' => true, 'msg' => "数据错误"));
            return;
        }
        $data = array();
        $data['tatitle'] = $task_info['tatitle'];
        $data['tid'] = $task_info['tid'];
        $data['tanums'] = $task_info['tanums'];
        $data['tacommission'] = $task_info['tacommission'];
        $data['taimg'] = $task_info['taimg'];
        $data['if_recommend'] = $task_info['if_recommend'];
        $data['taurl'] = $task_info['taurl'];
        $data['constraintdays'] = $task_info['constraintdays'];
        $data['tadays'] = $task_info['tadays'];
        $data['examinedays'] = $task_info['examinedays'];
        $data['tadeposit'] = $task_info['tadeposit'];
        $data['taintegral'] = $task_info['taintegral'];
        $laidsold = $task_info['laids'];
        $data['requirement'] = $task_info['requirement'];
        $data['tatips'] = $task_info['tatips'];
        $data['tacontents'] = $task_info['tacontents'];
        $data['taid'] = $taid;

        $laids = explode(",", $laidsold);
        $data['laids'] = $laids;
        $tidlist = $this->task->gettidlist();
        $data['tidlist'] = $tidlist;
        $laidslist = $this->task->getlaidslist();
        $data['laidslist'] = $laidslist;
        $this->display("task/task_edit", $data);
    }
    /**
     * 任务修改提交
     */
    public function task_save_edit()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
        $taid = isset($_POST["taid"]) ? $_POST["taid"] : '';
        $tid = isset($_POST["tid"]) ? $_POST["tid"] : '';
        $tanums = isset($_POST["tanums"]) ? $_POST["tanums"] : '';
        $tacommission = isset($_POST["tacommission"]) ? $_POST["tacommission"] : '';
        $laids = isset($_POST["laids"]) ? $_POST["laids"] : '';
        $tatitle = isset($_POST["tatitle"]) ? $_POST["tatitle"] : '';
        $taimg = isset($_POST["taimg"]) ? $_POST["taimg"] : '';
        $if_recommend = isset($_POST["if_recommend"]) ? $_POST["if_recommend"] : '1';
        $constraintdays = isset($_POST["constraintdays"]) ? $_POST["constraintdays"] : '';
        $tadays = isset($_POST["tadays"]) ? $_POST["tadays"] : '';
        $examinedays = isset($_POST["examinedays"]) ? $_POST["examinedays"] : '';
        $tadeposit = isset($_POST["tadeposit"]) ? $_POST["tadeposit"] : '0';
        $taintegral = isset($_POST["taintegral"]) ? $_POST["taintegral"] : '';
        $requirement = isset($_POST["requirement"]) ? $_POST["requirement"] : '';
        $tatips = isset($_POST["tatips"]) ? $_POST["tatips"] : '';
        $tacontents = isset($_POST["tacontents"]) ? $_POST["tacontents"] : '';
        $taurl = isset($_POST["taurl"]) ? $_POST["taurl"] : '';
        $add_time = time();
        $laidsnew = "";
        if (!empty($laids)){
            foreach ($laids as $k=>$v){
                if (empty($laidsnew)){
                    $laidsnew = $v . ",";
                }else{
                    $laidsnew = $laidsnew . $v . ",";
                }
            }
        }
        $set_info = $this->task->getsetById();
        if ($set_info['min_deposit']>$tadeposit){
            echo json_encode(array('error' => true, 'msg' => "任务押金最小值为:".$set_info['min_deposit']."。"));
            return;
        }
//        $task_info = $this->task->gettaskById2($tatitle, $taid);
//        if (!empty($task_info)){
//            echo json_encode(array('error' => false, 'msg' => "该类型名称已经存在"));
//            return;
//        }

        $result = $this->task->task_save_edit($taurl,$requirement,$tatips,$tacontents,$tid, $tanums,$tacommission,$laidsnew,$tatitle,$taimg,$if_recommend,$constraintdays,$tadays,$examinedays,$tadeposit,$taintegral,$add_time,$taid);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }

}