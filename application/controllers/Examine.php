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
		$this->load->library('PHPExcel');
		$this->load->library('IOFactory');

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
	 * 提现列表页 用户
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
//		$data["ordercount1"] = $this->examine->getOrder1Count($start,$end);
//		$data["ordercount2"] = $this->examine->getOrder2Count($start,$end);
//		$data["ordercount3"] = $this->examine->getOrder3Count($start,$end);
		$data["orderprice1"] = $this->examine->getOrder5Price($start,$end);
		$data["orderprice2"] = $this->examine->getOrder6Price($start,$end);
		$data["orderprice3"] = $this->examine->getOrder7Price($start,$end);
		$data["orderprice4"] = $this->examine->getOrder8Price($start,$end);
		$data["orderprice5"] = $this->examine->getOrder9Price($start,$end);
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
//		$data["ordercount1"] = $this->examine->getOrder1Count1($start,$end);
		$data["orderprice1"] = $this->examine->getOrder5Price1($start,$end);
		$data["orderprice2"] = $this->examine->getOrder6Price1($start,$end);
		$data["orderprice3"] = $this->examine->getOrder7Price1($start,$end);
		$data["orderprice5"] = $this->examine->getOrder8Price1($start,$end);
		$this->display("examine/withdrawal_list3", $data);
	}
	/**
	 * 账单导出1
	 */
	public function examine_csv1()
	{
		$start = isset($_GET['start']) ? $_GET['start'] : '';
		$end = isset($_GET['end']) ? $_GET['end'] : '';

		$list = $this->order->gettaskorderAllcsv1($start,$end);
		$excel_filename = '跑腿账单' . date('Ymd_His');
		$headlist = array('账单时间', '账单类型', '账单状态', '账单总金额', '账单司机费', '账单小费', '账单保价费', '账单抽成费');
		$this->csv_export($list,$headlist,$excel_filename);
	}
	/**
	 * 账单导出2
	 */
	public function examine_csv2()
	{
		$start = isset($_GET['start']) ? $_GET['start'] : '';
		$end = isset($_GET['end']) ? $_GET['end'] : '';

		$list = $this->order->gettaskorderAllcsv2($start,$end);
		$excel_filename = '代驾账单' . date('Ymd_His');
		$headlist = array('账单时间', '账单类型', '账单状态', '账单总金额', '账单司机费', '账单小费', '账单抽成费');
		$this->csv_export1($list,$headlist,$excel_filename);
	}
	/**
	 * 账单导出3
	 */
	public function examine_csv3()
	{
		$start = isset($_GET['start']) ? $_GET['start'] : '';
		$end = isset($_GET['end']) ? $_GET['end'] : '';

		$list = $this->order->gettaskorderAllcsv3($start,$end);
		$excel_filename = '提现账单（用户）' . date('Ymd_His');
		$headlist = array('序号', '用户电话', '用户姓名', '提现金额', '提现时间');
		$this->csv_export3($list,$headlist,$excel_filename);
	}
	/**
	 * 账单导出4
	 */
	public function examine_csv4()
	{
		$start = isset($_GET['start']) ? $_GET['start'] : '';
		$end = isset($_GET['end']) ? $_GET['end'] : '';

		$list = $this->order->gettaskorderAllcsv4($start,$end);
		$excel_filename = '提现账单（司机）' . date('Ymd_His');
		$headlist = array('司机电话', '真实姓名', '开户行', '银行卡号', '提现金额','审核状态','审核备注','申请时间');
		$this->csv_export4($list,$headlist,$excel_filename);
	}
	public function csv_export4 ($data = array(), $headlist = array(), $fileName)
	{
		$PHPExcel = new PHPExcel(); //实例化PHPExcel类，类似于在桌面上新建一个Excel表格
		$PHPSheet = $PHPExcel->getActiveSheet(); //获得当前活动sheet的操作对象
		$PHPSheet->setTitle('提现账单'); //给当前活动sheet设置名称
		$PHPSheet->setCellValue('A1', '司机电话')
			->setCellValue('B1', '真实姓名')
			->setCellValue('C1', '开户行')
			->setCellValue('D1', '银行卡号')
			->setCellValue('E1', '提现金额')
			->setCellValue('F1', '审核状态')
			->setCellValue('G1', '审核备注')
			->setCellValue('H1', '申请时间');
		foreach ($data as $k1 => $v1) {
			$cell = $k1 + 2;
			if ($v1['status']==1) {
				$v1['status'] = '审核中';
			} elseif ($v1['status']==2) {
				$v1['status'] = "已通过";
			} elseif ($v1['status']==3) {
				$v1['status'] = "已驳回";
			} else {
				$v1['status'] = "数组错误";
			}
			$PHPSheet->setCellValue('A' . $cell, $v1['account'])
				->setCellValue('B' . $cell, $v1['name'])
				->setCellValue('C' . $cell, $v1['bank_account'])
				->setCellValue('D' . $cell, $v1['card_number'])
				->setCellValue('E' . $cell, $v1['money'])
				->setCellValue('F' . $cell, $v1['status'])
				->setCellValue('G' . $cell, $v1['notice'])
				->setCellValue('H' . $cell, date('Y-m-d H:i:s', $v1['add_time']))
			;
		}
		switch (2) {
			case '1':
				$PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007'); //按照指定格式生成Excel文件，‘Excel2007’表示生成2007版本的xlsx，
				$PHPWriter->save('handle.xlsx'); //表示在$path路径下面生成demo.xlsx文件
				break;
			case '2':
				// 生成2007excel格式的xlsx文件
				$IOFactory = new IOFactory();
				$PHPWriter = $IOFactory->createWriter($PHPExcel, 'Excel5'); //按照指定格式生成Excel文件，‘Excel2007’表示生成2007版本的xlsx
				header('Content-Type: text/html;charset=utf-8');
				header('Content-Type: xlsx');
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
				header('Cache-Control: max-age=0');
				$PHPWriter->save("php://output");
				break;
		}
	}
	public function csv_export3 ($data = array(), $headlist = array(), $fileName)
	{
		$PHPExcel = new PHPExcel(); //实例化PHPExcel类，类似于在桌面上新建一个Excel表格
		$PHPSheet = $PHPExcel->getActiveSheet(); //获得当前活动sheet的操作对象
		$PHPSheet->setTitle('提现账单'); //给当前活动sheet设置名称
		$PHPSheet->setCellValue('A1', '序号')
			->setCellValue('B1', '用户电话')
			->setCellValue('C1', '用户姓名')
			->setCellValue('D1', '提现金额（单位：元）')
			->setCellValue('E1', '提现时间');
		foreach ($data as $k1 => $v1) {
			$cell = $k1 + 2;
			$PHPSheet->setCellValue('A' . $cell, $k1 + 1)
				->setCellValue('B' . $cell, $v1['account'])
				->setCellValue('C' . $cell, $v1['name'])
				->setCellValue('D' . $cell, $v1['price'])
				->setCellValue('E' . $cell, date('Y-m-d H:i:s', $v1['add_time']))
			;
		}
		switch (2) {
			case '1':
				$PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007'); //按照指定格式生成Excel文件，‘Excel2007’表示生成2007版本的xlsx，
				$PHPWriter->save('handle.xlsx'); //表示在$path路径下面生成demo.xlsx文件
				break;
			case '2':
				// 生成2007excel格式的xlsx文件
				$IOFactory = new IOFactory();
				$PHPWriter = $IOFactory->createWriter($PHPExcel, 'Excel5'); //按照指定格式生成Excel文件，‘Excel2007’表示生成2007版本的xlsx
				header('Content-Type: text/html;charset=utf-8');
				header('Content-Type: xlsx');
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
				header('Cache-Control: max-age=0');
				$PHPWriter->save("php://output");
				break;
		}
	}
	public function csv_export ($data = array(), $headlist = array(), $fileName)
	{
		$PHPExcel = new PHPExcel(); //实例化PHPExcel类，类似于在桌面上新建一个Excel表格
		$PHPSheet = $PHPExcel->getActiveSheet(); //获得当前活动sheet的操作对象
		$PHPSheet->setTitle('跑腿账单'); //给当前活动sheet设置名称
		$PHPSheet->setCellValue('A1', '账单时间')
			->setCellValue('B1', '账单类型')
			->setCellValue('C1', '账单状态')
			->setCellValue('D1', '账单总金额（单位：元）')
			->setCellValue('E1', '账单司机费（单位：元）')
			->setCellValue('F1', '账单小费（单位：元）')
			->setCellValue('G1', '账单保价费（单位：元）')
			->setCellValue('H1', '账单抽成费（单位：元）');
		foreach ($data as $k1 => $v1) {
			$cell = $k1 + 2;
			if ($v1['order_type'] == 1) {
				$v1['order_type'] = '专车送';
			} elseif ($v1['order_type'] == 2) {
				$v1['order_type'] = "顺路送";
			} elseif ($v1['order_type'] == 3) {
				$v1['order_type'] = "代买";
			} elseif ($v1['order_type'] == 4) {
				$v1['order_type'] = "代驾";
			} else {
				$v1['order_type'] = "数组错误";
			}
			if ($v1['status']==7){
				$v1['order_status'] = "已取消";
			}elseif ($v1['order_status']==1){
				$v1['order_status'] = "未付款";
			}elseif ($v1['order_status']==2){
				$v1['order_status'] = "待接单";
			}elseif ($v1['order_status']==3){
				$v1['order_status'] = "已接单";
			}elseif ($v1['order_status']==4){
				$v1['order_status'] = "前往出发地";
			}elseif ($v1['order_status']==5){
				$v1['order_status'] = "到达出发地";
			}elseif ($v1['order_status']==6){
				$v1['order_status'] = "待验证提货码";
			}elseif ($v1['order_status']==7){
				$v1['order_status'] = "前往目的地";
			}elseif ($v1['order_status']==8){
				$v1['order_status'] = "已完成";
			}else{
				$v1['order_status'] = "数据错误";
			}
			$PHPSheet->setCellValue('A' . $cell, date('Y-m-d H:i:s', $v1['add_time']))
				->setCellValue('B' . $cell, $v1['order_type'])
				->setCellValue('C' . $cell, $v1['order_status'])
				->setCellValue('D' . $cell, empty($v1['price'])?0.00:$v1['price'])
				->setCellValue('E' . $cell, empty($v1['order_driver_price'])?0.00:$v1['order_driver_price'])
				->setCellValue('F' . $cell, empty($v1['tip_price'])?0.00:$v1['tip_price'])
				->setCellValue('G' . $cell, empty($v1['protect_price'])?0.00:$v1['protect_price'])
				->setCellValue('H' . $cell, empty($v1['cost_price'])?0.00:$v1['cost_price'])
			;
		}
		switch (2) {
			case '1':
				$PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007'); //按照指定格式生成Excel文件，‘Excel2007’表示生成2007版本的xlsx，
				$PHPWriter->save('handle.xlsx'); //表示在$path路径下面生成demo.xlsx文件
				break;
			case '2':
				// 生成2007excel格式的xlsx文件
				$IOFactory = new IOFactory();
				$PHPWriter = $IOFactory->createWriter($PHPExcel, 'Excel5'); //按照指定格式生成Excel文件，‘Excel2007’表示生成2007版本的xlsx
				header('Content-Type: text/html;charset=utf-8');
				header('Content-Type: xlsx');
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
				header('Cache-Control: max-age=0');
				$PHPWriter->save("php://output");
				break;
		}
	}
	public function csv_export1 ($data = array(), $headlist = array(), $fileName)
	{
		$PHPExcel = new PHPExcel(); //实例化PHPExcel类，类似于在桌面上新建一个Excel表格
		$PHPSheet = $PHPExcel->getActiveSheet(); //获得当前活动sheet的操作对象
		$PHPSheet->setTitle('跑腿账单'); //给当前活动sheet设置名称
		$PHPSheet->setCellValue('A1', '账单时间')
			->setCellValue('B1', '账单类型')
			->setCellValue('C1', '账单状态')
			->setCellValue('D1', '账单总金额（单位：元）')
			->setCellValue('E1', '账单司机费（单位：元）')
			->setCellValue('F1', '账单小费（单位：元）')
			->setCellValue('H1', '账单抽成费（单位：元）');
		foreach ($data as $k1 => $v1) {
			$cell = $k1 + 2;
			$v1['order_type'] = "代驾";
			if ($v1['status']==1){
				$v1['status'] = "待接单";
			}elseif ($v1['status']==2){
				$v1['status'] = "待接驾";
			}elseif ($v1['status']==3){
				$v1['status'] = "用户上车";
			}elseif ($v1['status']==4){
				$v1['status'] = "已开始";
			}elseif ($v1['status']==6){
				$v1['status'] = "已完成";
			}elseif ($v1['status']==7){
				$v1['status'] = "已取消";
			}else{
				$v1['status'] = "数据错误";
			}
			$PHPSheet->setCellValue('A' . $cell, date('Y-m-d H:i:s', $v1['add_time']))
				->setCellValue('B' . $cell, $v1['order_type'])
				->setCellValue('C' . $cell, $v1['status'])
				->setCellValue('D' . $cell, empty($v1['price'])?0.00:$v1['price'])
				->setCellValue('E' . $cell, empty($v1['order_driver_price'])?0.00:$v1['order_driver_price'])
				->setCellValue('F' . $cell, empty($v1['tip_price'])?0.00:$v1['tip_price'])
				->setCellValue('H' . $cell, empty($v1['cost_price'])?0.00:$v1['cost_price'])
			;
		}
		switch (2) {
			case '1':
				$PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007'); //按照指定格式生成Excel文件，‘Excel2007’表示生成2007版本的xlsx，
				$PHPWriter->save('handle.xlsx'); //表示在$path路径下面生成demo.xlsx文件
				break;
			case '2':
				// 生成2007excel格式的xlsx文件
				$IOFactory = new IOFactory();
				$PHPWriter = $IOFactory->createWriter($PHPExcel, 'Excel5'); //按照指定格式生成Excel文件，‘Excel2007’表示生成2007版本的xlsx
				header('Content-Type: text/html;charset=utf-8');
				header('Content-Type: xlsx');
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
				header('Cache-Control: max-age=0');
				$PHPWriter->save("php://output");
				break;
		}
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
