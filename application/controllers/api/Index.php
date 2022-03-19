<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * **********************************************************************
 * サブシステム名  ： TASK
 * 機能名         ：个人中心
 * 作成者        ： Gary
 * **********************************************************************
 */
class Index extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // 加载数据库类
        $this->load->model('Member_model', 'member');
		$this->load->model('Task_model', 'task');
		$this->load->model('Goods_model', 'goods');
		$this->load->model('Role_model', 'role');
    }

    //获取合同
	public function baojiadan_list()
	{
		if (!isset($_POST['token']) || empty($_POST['token'])) {
			$this->back_json(205, '请您先去授权登录！');
		}
		$token = $_POST['token'];
		$member = $this->member->getMemberInfotoken($token);
		if (empty($member)){
			$this->back_json(205, '请您先去授权登录！');
		}
		$member_id = $member['member_id'];
		$gname = isset($_POST['gname']) ? $_POST['gname'] : '';
		$page = isset($_POST["page"]) ? $_POST["page"] : 1;
		$list = $this->goods->getbaojiadanAll($page,$gname,$member_id);
		foreach ($list as $k=>$v){
			$list[$k]['qianding'] = date("Y-m-d",$v['qianding']);
		}
		$data["gname"] = $gname;
		$data["list"] = $list;
		$this->back_json(200, '操作成功', $data);
	}
	//获取款号
	public function baojiadankuanhao_list()
	{
		if (!isset($_POST['token']) || empty($_POST['token'])) {
			$this->back_json(205, '请您先去授权登录！');
		}
		$token = $_POST['token'];
		$member = $this->member->getMemberInfotoken($token);
		if (empty($member)){
			$this->back_json(205, '请您先去授权登录！');
		}
		$mid = $member['mid'];
		$page = isset($_POST["page"]) ? $_POST["page"] : 1;
		$xid = isset($_POST["xid"]) ? $_POST["xid"] : '';
		$list = $this->goods->getbaojiadankuanhaoAll($page,$xid);
		foreach ($list as $k=>$v){
			$list[$k]['jiaohuoqi'] = date("Y-m-d",$v['jiaohuoqi']);
			$kuanhaoallone = $this->role->gettidlistpinmingkuanhao($v['kuanhao']);
			$list[$k]['yuanfuliaourl'] = empty($kuanhaoallone[0]['excelwendang'])?'':$kuanhaoallone[0]['excelwendang'];
		}
		$data["list"] = $list;
		$this->back_json(200, '操作成功', $data);
	}

	//获取班
	public function ban_list()
	{
		if (!isset($_POST['token']) || empty($_POST['token'])) {
			$this->back_json(205, '请您先去授权登录！');
		}
		$token = $_POST['token'];
		$member = $this->member->getMemberInfotoken($token);
		if (empty($member)){
			$this->back_json(205, '请您先去授权登录！');
		}
		$mid = $member['mid'];
		$page = isset($_POST["page"]) ? $_POST["page"] : 1;
		$list = $this->goods->getbanAll($page);
		$data["list"] = $list;
		$this->back_json(200, '操作成功', $data);
	}

	//获取公司
	public function gongsi_list()
	{
		if (!isset($_POST['token']) || empty($_POST['token'])) {
			$this->back_json(205, '请您先去授权登录！');
		}
		$token = $_POST['token'];
		$member = $this->member->getMemberInfotoken($token);
		if (empty($member)){
			$this->back_json(205, '请您先去授权登录！');
		}
		$mid = $member['mid'];
		$page = isset($_POST["page"]) ? $_POST["page"] : 1;
		$list = $this->goods->getgongsiAll($page);
		$data["list"] = $list;
		$this->back_json(200, '操作成功', $data);
	}

	//获取生产计划
	public function baojiadankuanhaoshengchan_list()
	{
		if (!isset($_POST['token']) || empty($_POST['token'])) {
			$this->back_json(205, '请您先去授权登录！');
		}
		$token = $_POST['token'];
		$member = $this->member->getMemberInfotoken($token);
		if (empty($member)){
			$this->back_json(205, '请您先去授权登录！');
		}
		$member_id = $member['member_id'];
		$page = isset($_POST["page"]) ? $_POST["page"] : 1;
		$zuname = isset($_POST["zu"]) ? $_POST["zu"] : "";
		$yue = isset($_POST["yue"]) ? $_POST["yue"] : "";
		$nian = isset($_POST["nian"]) ? $_POST["nian"] : "";
		$jihuariqi = $nian.'-'.$yue;
		$list = $this->goods->getshengchanjihuaAll($page,$jihuariqi,$zuname);
		$you_flg = false;
		foreach ($list as $k=>$v){
			$kuanhao = $v['zhipinfanhao'];
			$listcheck = $this->member->geterp_xiangmukuanhao($kuanhao);
			if (!empty($listcheck)){
				$xid = $listcheck['xid'];
				$listcheck1 = $this->member->geterp_xiangmukuanhaoxid($xid);
				if (!empty($listcheck1)){
					foreach ($listcheck1 as $kk=>$vv){
						if ($member_id == $vv['uid']){
							$you_flg = true;
						}
					}
				}
			}
		}
		if ($you_flg){
			$data["list"][0] = $list[0];
		}else{
			$data["list"] = array();
		}

		$this->back_json(200, '操作成功', $data);
	}

	//获取样品
	public function baojiadankuanhaoyangpin_list()
	{
		if (!isset($_POST['token']) || empty($_POST['token'])) {
			$this->back_json(205, '请您先去授权登录！');
		}
		$token = $_POST['token'];
		$member = $this->member->getMemberInfotoken($token);
		if (empty($member)){
			$this->back_json(205, '请您先去授权登录！');
		}
		$member_id = $member['member_id'];
		$page = isset($_POST["page"]) ? $_POST["page"] : 1;
		$zid = isset($_POST["zid"]) ? $_POST["zid"] : "";
		$list = $this->goods->getyangpinAll($page,$zid);

		$you_flg = false;
		foreach ($list as $k=>$v){
			$kuanhao = $v['kuanhao'];
			$listcheck = $this->member->geterp_xiangmukuanhao($kuanhao);
			if (!empty($listcheck)){
				$xid = $listcheck['xid'];
				$listcheck1 = $this->member->geterp_xiangmukuanhaoxid($xid);
				if (!empty($listcheck1)){
					foreach ($listcheck1 as $kk=>$vv){
						if ($member_id == $vv['uid']){
							$you_flg = true;
						}
					}
				}
			}
		}
		if ($you_flg){
			$data["list"][0] = $list[0];
		}else{
			$data["list"] = array();
		}
		$this->back_json(200, '操作成功', $data);
	}
    /**
     * 个人中心
     */
    public function memberinfo(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '请您先去授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请您先去授权登录！');
        }
        $mid = $member['mid'];
        //获得个人信息
        $data = array();
        if (empty($member['gid'])){
            $member['gname'] = "";
        }else{
            $grade = $this->member->getgradeInfo($member['gid']);
            $member['gname'] = $grade['gname'];
        }
        $data['member'] = $member;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 个人中心（分享页数据）
     */
    public function memberinfos(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '未授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请重新登录');
        }
        if (!isset($_POST['mid']) || empty($_POST['mid'])) {
            $this->back_json(201, '缺少推荐人id！');
        }
        $mid = $_POST['mid'];
        //获得个人信息
        $data = array();
        $member = $this->member->getMemberInfomid($mid);
        $data['member'] = $member;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 消息列表
     */
    public function newslist(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '未授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请重新登录');
        }
        $mid = $member['mid'];
        $page = $_POST['pageNumber'];
        $newslist = $this->member->getnewslist($mid,$page);
        foreach ($newslist as $k=>$v){
            $newslist[$k]['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
        }
        $data['newslist'] = $newslist;
        //消息标记已读
        $this->member->getnewsflge($mid);
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 积分明细
     */
    public function integrallist(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '未授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请重新登录');
        }
        $mid = $member['mid'];
        $page = $_POST['pageNumber'];
        $integrallist = $this->member->getintegrallist($mid,$page);
        foreach ($integrallist as $k=>$v){
            $integrallist[$k]['add_time'] = date("Y-m-d H:i:s",$v['add_time']);
        }
        $data['integrallist'] = $integrallist;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 钱包明细
     */
    public function walletlist(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '未授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请重新登录');
        }
        $mid = $member['mid'];
        $page = $_POST['pageNumber'];
        $walletlist = $this->member->getwalletllist($mid,$page);
        foreach ($walletlist as $k=>$v){
            $walletlist[$k]['add_time'] = date("Y-m-d H:i:s",$v['add_time']);
        }
        $data['walletlist'] = $walletlist;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 佣金明细
     */
    public function commissionlist(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '未授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请重新登录');
        }
        $mid = $member['mid'];
        $page = $_POST['pageNumber'];
        $commission = $this->member->getcommissionlist($mid,$page);
        foreach ($commission as $k=>$v){
            $commission[$k]['add_time'] = date("Y-m-d H:i:s",$v['add_time']);
        }
        $data['commissionlist'] = $commission;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 个人信息修改（设置）
     */
    public function memberupdatainfo(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '未授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请重新登录');
        }
        $mid = $member['mid'];
        //获得真实姓名
        $truename = empty($_POST['truename'])?'':$_POST['truename'];
        //获得联系电话
        $mobile = empty($_POST['mobile'])?'':$_POST['mobile'];
        //获得邮箱地址
        $email = empty($_POST['email'])?'':$_POST['email'];
        //获得收货地址
        $address = empty($_POST['address'])?'':$_POST['address'];
        $this->member->updatamemberinfo($mid,$truename,$mobile,$email,$address);

        $this->back_json(200, '更新成功', array());
    }
	/**
	 * 提问
	 */
	public function questioninsert(){
		//验证loginCode是否传递
		if (!isset($_POST['token']) || empty($_POST['token'])) {
			$this->back_json(205, '未授权登录！');
		}
		$token = $_POST['token'];
		$member = $this->member->getMemberInfotoken($token);
		if (empty($member)){
			$this->back_json(205, '请重新登录');
		}
		$mid = $member['mid'];
		if (!isset($_POST['question']) || empty($_POST['question'])) {
			$this->back_json(202, '未提交问题！');
		}
		$question = empty($_POST['question'])?'':$_POST['question'];
		$questionnow = $this->member->getquestionInfotoken($question);
		if (!empty($questionnow)){
			$this->back_json(202, '当前问题已经登录！');
		}
		$ostate = 1;
		$add_time = time();
		$this->member->registerquestion($mid,$question,$ostate,$add_time);
		$this->back_json(200, '提问成功', array());
	}
	/**
	 * 下单
	 */
	public function orderinsert(){
		//验证loginCode是否传递
		if (!isset($_POST['token']) || empty($_POST['token'])) {
			$this->back_json(205, '未授权登录！');
		}
		$token = $_POST['token'];
		$member = $this->member->getMemberInfotoken($token);
		if (empty($member)){
			$this->back_json(205, '登录超时！请重新授权！');
		}
//		if (!isset($_POST['email']) || empty($_POST['email'])) {
//			$this->back_json(202, '请上传联系邮箱！');
//		}
		if (empty($_POST['btype'])) {
			$btype = "学区需求";
			$school = $_POST['school'];
			$getitemsclassschoolname = $this->member->getitemsclassschoolname($school);
			$area = $getitemsclassschoolname['careaname'];
		}elseif ($_POST['btype'] == 1){
			$btype = "自住需求";
			$school = '';
			$area = $_POST['area'];
		}elseif ($_POST['btype'] == 2){
			$btype = "投资需求";
			$school = '';
			$area = $_POST['area'];
		}else{
			$btype = "数据错误";
			$school = '';
			$this->back_json(202, '请重新选择学校');
		}
		$money = $_POST['money'];
		$ftype = $_POST['ftype'];
		$price = $_POST['price'];
		$email = empty($_POST['email'])?'':$_POST['email'];
		$id = $_POST['id'];
		$addtime = time();
		$mid = $member['mid'];
		$status = 0;
		$paynumber = "P".time();

		$questionnow = $this->member->getreportorder($paynumber);
		if (!empty($questionnow)){
			$this->back_json(202, '当前已经下单！请稍后重试！');
		}
		$getReportinfo = $this->member->getReportinfo($id);
		$checktime = $getReportinfo['addtime'];
		$this->member->reportorderinsert($mid,$paynumber,$status,$addtime,$email,$price,$ftype,$money,$area,$school,$btype,$checktime,$id);

		$openid = $member['openid'];
		$appid = 'wx2807f1038eb33541';
		$key = "dalianzhiyeyoudao123456789012345";
		$mch_id = "1609582735";
		$money = $price;

		$orderCode = $paynumber;   //  订单号
//        随机字符串
		$str = "QWERTYUIPADGHJKLZXCVNM1234567890";
		$nonce = str_shuffle($str);

		$pay['appid'] = $appid;
		$pay['body'] = '订单支付';               //商品描述
		$pay['mch_id'] = $mch_id;            //商户号
		$pay['nonce_str'] = $nonce;        //随机字符串
		$pay['notify_url'] = 'https://dltqwy.com/index.php/api/Index/notify';
		$pay['openid'] = $openid;
		$pay['out_trade_no'] = $orderCode;       //订单号
		$pay['spbill_create_ip'] = $_SERVER['SERVER_ADDR']; // 终端IP
		$pay['total_fee'] = 100 * $money; //支付金额
		$pay['trade_type'] = 'JSAPI';    //交易类型
//        组建签名（不可换行 空格  否则哭吧）
		$stringA = "appid=" . $pay['appid'] . "&body=" . $pay['body'] . "&mch_id=" . $pay['mch_id'] . "&nonce_str=" . $pay['nonce_str'] . "&notify_url=" . $pay['notify_url'] . "&openid=" . $pay['openid'] . "&out_trade_no=" . $pay['out_trade_no'] . "&spbill_create_ip=" . $pay['spbill_create_ip'] . "&total_fee=" . $pay['total_fee'] . "&trade_type=" . $pay['trade_type'];
		$stringSignTemp = $stringA . "&key=" . $key; //注：key为商户平台设置的密钥key(这个还需要再确认一下)
		$sign = strtoupper(md5($stringSignTemp)); //注：MD5签名方式
		$pay['sign'] = $sign;              //签名
//        统一下单请求
		$url = "https://api.mch.weixin.qq.com/pay/unifiedorder";
		$data = $this->arrayToXml($pay);
		$res = $this->wxpost($url, $data);
//        对 统一下单返回得参数进行处理
		$pay_arr = $this->xmlToArray($res);  //这里是数组

		if ($pay_arr['return_code'] == 'FAIL' || $pay_arr['result_code'] == 'FAIL') {
			echo json_encode($res);
			exit;
		}
//        调起支付数据签名字段
		$timeStamp = time();
		$nonce_pay = str_shuffle($str);
		$package = $pay_arr['prepay_id'];
		$signType = "MD5";
		$stringPay = "appId=" . $appid . "&nonceStr=" . $nonce_pay . "&package=prepay_id=" . $package . "&signType=" . $signType . "&timeStamp=" . $timeStamp . "&key=" . $key;
		$paySign = strtoupper(md5($stringPay));
		$rpay['timeStamp'] = (string)$timeStamp;
		$rpay['nonceStr'] = $nonce_pay;
		$rpay['_package'] = "prepay_id=" . $package;
		$rpay['signType'] = $signType;
		$rpay['paySign'] = $paySign;
		$rpay['orders'] = $orderCode;

		$weixin_sign = [
			'order_no' => $paynumber,
			'money' => $money,
			'app_request' => $rpay,
		];

		$re = [
			'weixin_sign' => $weixin_sign ? $weixin_sign : (object)[],
			'id' => $id,
		];
		$this->back_json(200, '下单成功', $re);
	}
	/**
	 * 下单
	 */
	public function orderinsert1(){
		//验证loginCode是否传递
		if (!isset($_POST['token']) || empty($_POST['token'])) {
			$this->back_json(205, '未授权登录！');
		}
		$token = $_POST['token'];
		$member = $this->member->getMemberInfotoken($token);
		if (empty($member)){
			$this->back_json(205, '登录超时！请重新授权！');
		}

		$price = $_POST['price'];
		$addtime = time();
		$mid = $member['mid'];
		$status = 0;
		$paynumber = "P".time();

		$questionnow = $this->member->getreportorder1($paynumber);
		if (!empty($questionnow)){
			$this->back_json(202, '当前已经下单！请稍后重试！');
		}
		$this->member->reportorderinsert1($mid,$paynumber,$status,$addtime,$price);

		$openid = $member['openid'];
		$appid = 'wx2807f1038eb33541';
		$key = "dalianzhiyeyoudao123456789012345";
		$mch_id = "1609582735";
		$money = $price;

		$orderCode = $paynumber;   //  订单号
//        随机字符串
		$str = "QWERTYUIPADGHJKLZXCVNM1234567890";
		$nonce = str_shuffle($str);

		$pay['appid'] = $appid;
		$pay['body'] = '订单支付';               //商品描述
		$pay['mch_id'] = $mch_id;            //商户号
		$pay['nonce_str'] = $nonce;        //随机字符串
		$pay['notify_url'] = 'https://dltqwy.com/index.php/api/Index/notify1';
		$pay['openid'] = $openid;
		$pay['out_trade_no'] = $orderCode;       //订单号
		$pay['spbill_create_ip'] = $_SERVER['SERVER_ADDR']; // 终端IP
		$pay['total_fee'] = 100 * $money; //支付金额
		$pay['trade_type'] = 'JSAPI';    //交易类型
//        组建签名（不可换行 空格  否则哭吧）
		$stringA = "appid=" . $pay['appid'] . "&body=" . $pay['body'] . "&mch_id=" . $pay['mch_id'] . "&nonce_str=" . $pay['nonce_str'] . "&notify_url=" . $pay['notify_url'] . "&openid=" . $pay['openid'] . "&out_trade_no=" . $pay['out_trade_no'] . "&spbill_create_ip=" . $pay['spbill_create_ip'] . "&total_fee=" . $pay['total_fee'] . "&trade_type=" . $pay['trade_type'];
		$stringSignTemp = $stringA . "&key=" . $key; //注：key为商户平台设置的密钥key(这个还需要再确认一下)
		$sign = strtoupper(md5($stringSignTemp)); //注：MD5签名方式
		$pay['sign'] = $sign;              //签名
//        统一下单请求
		$url = "https://api.mch.weixin.qq.com/pay/unifiedorder";
		$data = $this->arrayToXml($pay);
		$res = $this->wxpost($url, $data);
//        对 统一下单返回得参数进行处理
		$pay_arr = $this->xmlToArray($res);  //这里是数组

		if ($pay_arr['return_code'] == 'FAIL' || $pay_arr['result_code'] == 'FAIL') {
			echo json_encode($res);
			exit;
		}
//        调起支付数据签名字段
		$timeStamp = time();
		$nonce_pay = str_shuffle($str);
		$package = $pay_arr['prepay_id'];
		$signType = "MD5";
		$stringPay = "appId=" . $appid . "&nonceStr=" . $nonce_pay . "&package=prepay_id=" . $package . "&signType=" . $signType . "&timeStamp=" . $timeStamp . "&key=" . $key;
		$paySign = strtoupper(md5($stringPay));
		$rpay['timeStamp'] = (string)$timeStamp;
		$rpay['nonceStr'] = $nonce_pay;
		$rpay['_package'] = "prepay_id=" . $package;
		$rpay['signType'] = $signType;
		$rpay['paySign'] = $paySign;
		$rpay['orders'] = $orderCode;

		$weixin_sign = [
			'order_no' => $paynumber,
			'money' => $money,
			'app_request' => $rpay,
		];

		$re = [
			'weixin_sign' => $weixin_sign ? $weixin_sign : (object)[],
		];
		$this->back_json(200, '下单成功', $re);
	}
	/**
	 * check是否支付
	 */
	public function getPay(){
		//验证loginCode是否传递
		if (!isset($_POST['token']) || empty($_POST['token'])) {
			$this->back_json(205, '未授权！请授权登录！');
		}
		$token = $_POST['token'];
		$member = $this->member->getMemberInfotoken($token);
		if (empty($member)){
			$this->back_json(205, '登录超时！请重新授权！');
		}
		if (empty($_POST['btype'])) {
			$btype = "学区需求";
			$school = $_POST['school'];
			$getitemsclassschoolname = $this->member->getitemsclassschoolname($school);
			$area = $getitemsclassschoolname['careaname'];
		}elseif ($_POST['btype'] == 1){
			$btype = "自住需求";
			$school = '';
			$area = $_POST['area'];
		}elseif ($_POST['btype'] == 2){
			$btype = "投资需求";
			$school = '';
			$area = $_POST['area'];
		}else{
			$btype = "数据错误";
			$school = '';
			$this->back_json(202, '请重新选择学校');
		}
		$money = $_POST['money'];
		$ftype = $_POST['ftype'];
		$mid = $member['mid'];
		$status = 1;
		$getpayInfo = $this->member->getpayInfo($btype,$school,$area,$money,$ftype,$mid,$status);

		if (!empty($getpayInfo)){
			$getpayInfo1 = $this->member->getpayInfo2($btype,$school,$area,$money,$ftype,$getpayInfo['checktime']);
			if (!empty($getpayInfo1)){
				$payflg = 1;
			}else{
				$payflg = 0;
			}
		}else{
			$payflg = 0;
		}
		$data['payflg'] = $payflg;
		$this->back_json(200, '操作成功', $data);
	}
	/**
	 * check是否支付
	 */
	public function getPayvip(){
		//验证loginCode是否传递
		if (!isset($_POST['token']) || empty($_POST['token'])) {
			$this->back_json(205, '未授权！请授权登录！');
		}
		$token = $_POST['token'];
		$member = $this->member->getMemberInfotoken($token);
		if (empty($member)){
			$this->back_json(205, '登录超时！请重新授权！');
		}

		$mid = $member['mid'];
		$status = 1;
		$getpayInfo = $this->member->getpayInfo1($mid,$status);
		if (!empty($getpayInfo)){
			$payflg = 1;
			$data['payflg'] = $payflg;
			$this->back_json(200, '操作成功', $data);
		}else{
			$payflg = 0;
			$data['payflg'] = $payflg;
			$this->back_json(300, '抱歉！您还没有购买vip服务！', $data);
		}
	}
	/**
	 * 获得报告信息
	 */
	public function getReportlist(){
		//验证loginCode是否传递
		if (!isset($_POST['token']) || empty($_POST['token'])) {
			$this->back_json(205, '未授权！请授权登录！');
		}
		$token = $_POST['token'];
		$member = $this->member->getMemberInfotoken($token);
		if (empty($member)){
			$this->back_json(205, '登录超时！请重新授权！');
		}
		if (empty($_POST['btype'])) {
			$btype = "学区需求";
			$school = $_POST['school'];
			$getitemsclassschoolname = $this->member->getitemsclassschoolname($school);
			$area = $getitemsclassschoolname['careaname'];
		}elseif ($_POST['btype'] == 1){
			$btype = "自住需求";
			$school = '';
			$area = $_POST['area'];
		}elseif ($_POST['btype'] == 2){
			$btype = "投资需求";
			$school = '';
			$area = $_POST['area'];
		}else{
			$btype = "数据错误";
			$school = '';
			$this->back_json(202, '请重新选择学校');
		}
		$money = $_POST['money'];
		$ftype = $_POST['ftype'];

		$getReportlist = $this->member->getReportlist($btype,$school,$area,$money,$ftype);

		$data['reportlist'] = empty($getReportlist)?array():$getReportlist;
		$this->back_json(200, '操作成功', $data);
	}
	/**
	 * 获得报告信息
	 */
	public function get_details(){
		//验证loginCode是否传递
		if (!isset($_POST['token']) || empty($_POST['token'])) {
			$this->back_json(205, '未授权登录！');
		}
		$token = $_POST['token'];
		$member = $this->member->getMemberInfotoken($token);
		if (empty($member)){
			$this->back_json(205, '请重新登录');
		}

		$id = $_POST['id'];
		$num = $_POST['num'];

		$settingdetails = $this->task->goodsdetailskefu();
		$getReportinfo = $this->member->getReportinfo($id);
		if ($getReportinfo['typename'] == '学区需求'){
			if ($num === '1'){
				$data['reportinfo'] = empty($settingdetails['content1'])?'':$settingdetails['content1'];
			}elseif ($num === '2'){
				$data['reportinfo'] = empty($settingdetails['content2'])?'':$settingdetails['content2'];
			}elseif ($num === '3'){
				$data['reportinfo'] = empty($settingdetails['content3'])?'':$settingdetails['content3'];
			}elseif ($num === '4'){
				if ($getReportinfo['areaname'] == '中山区'){
					$data['reportinfo'] = empty($settingdetails['content4'])?'':$settingdetails['content4'];
				}elseif ($getReportinfo['areaname'] == '西岗区'){
					$data['reportinfo'] = empty($settingdetails['content5'])?'':$settingdetails['content5'];
				}elseif ($getReportinfo['areaname'] == '沙河口区'){
					$data['reportinfo'] = empty($settingdetails['content6'])?'':$settingdetails['content6'];
				}elseif ($getReportinfo['areaname'] == '甘井子区'){
					$data['reportinfo'] = empty($settingdetails['content7'])?'':$settingdetails['content7'];
				}elseif ($getReportinfo['areaname'] == '高新园区'){
					$data['reportinfo'] = empty($settingdetails['content8'])?'':$settingdetails['content8'];
				}else{
					$this->back_json(205, '请求失败');
				}
			}elseif ($num === '5'){
				$data['reportinfo'] = empty($getReportinfo['gcontent4'])?'':$getReportinfo['gcontent4'];
			}else{
				$data['reportinfo'] = empty($getReportinfo['gcontent5'])?'':$getReportinfo['gcontent5'];
			}
		}elseif ($getReportinfo['typename'] == '自住需求'){
			if ($num === '1'){
				$data['reportinfo'] = empty($settingdetails['content9'])?'':$settingdetails['content9'];
			}elseif ($num === '2'){
				$data['reportinfo'] = empty($settingdetails['content10'])?'':$settingdetails['content10'];
			}elseif ($num === '3'){
				$data['reportinfo'] = empty($settingdetails['content11'])?'':$settingdetails['content11'];
			}elseif ($num === '4'){
				if ($getReportinfo['areaname'] == '中山区'){
					$data['reportinfo'] = empty($settingdetails['content12'])?'':$settingdetails['content12'];
				}elseif ($getReportinfo['areaname'] == '西岗区'){
					$data['reportinfo'] = empty($settingdetails['content13'])?'':$settingdetails['content13'];
				}elseif ($getReportinfo['areaname'] == '沙河口区'){
					$data['reportinfo'] = empty($settingdetails['content14'])?'':$settingdetails['content14'];
				}elseif ($getReportinfo['areaname'] == '甘井子区'){
					$data['reportinfo'] = empty($settingdetails['content15'])?'':$settingdetails['content15'];
				}elseif ($getReportinfo['areaname'] == '高新园区'){
					$data['reportinfo'] = empty($settingdetails['content16'])?'':$settingdetails['content16'];
				}else{
					$this->back_json(205, '请求失败');
				}
			}elseif ($num === '5'){
				$data['reportinfo'] = empty($getReportinfo['gcontent4'])?'':$getReportinfo['gcontent4'];
			}else{
				$data['reportinfo'] = empty($getReportinfo['gcontent5'])?'':$getReportinfo['gcontent5'];
			}
		}elseif ($getReportinfo['typename'] == '投资需求'){
			if ($num === '1'){
				$data['reportinfo'] = empty($settingdetails['content17'])?'':$settingdetails['content17'];
			}elseif ($num === '2'){
				$data['reportinfo'] = empty($settingdetails['content18'])?'':$settingdetails['content18'];
			}elseif ($num === '3'){
				$data['reportinfo'] = empty($settingdetails['content19'])?'':$settingdetails['content19'];
			}elseif ($num === '4'){
				if ($getReportinfo['areaname'] == '中山区'){
					$data['reportinfo'] = empty($settingdetails['content20'])?'':$settingdetails['content20'];
				}elseif ($getReportinfo['areaname'] == '西岗区'){
					$data['reportinfo'] = empty($settingdetails['content21'])?'':$settingdetails['content21'];
				}elseif ($getReportinfo['areaname'] == '沙河口区'){
					$data['reportinfo'] = empty($settingdetails['content22'])?'':$settingdetails['content22'];
				}elseif ($getReportinfo['areaname'] == '甘井子区'){
					$data['reportinfo'] = empty($settingdetails['content23'])?'':$settingdetails['content23'];
				}elseif ($getReportinfo['areaname'] == '高新园区'){
					$data['reportinfo'] = empty($settingdetails['content24'])?'':$settingdetails['content24'];
				}else{
					$this->back_json(205, '请求失败');
				}
			}elseif ($num === '5'){
				$data['reportinfo'] = empty($getReportinfo['gcontent4'])?'':$getReportinfo['gcontent4'];
			}else{
				$data['reportinfo'] = empty($getReportinfo['gcontent5'])?'':$getReportinfo['gcontent5'];
			}
		}else{
			$this->back_json(205, '请求失败');
		}

		$this->back_json(200, '操作成功', $data);
	}
	public function get_detailsmy(){
		//验证loginCode是否传递
		if (!isset($_POST['token']) || empty($_POST['token'])) {
			$this->back_json(205, '未授权登录！');
		}
		$token = $_POST['token'];
		$member = $this->member->getMemberInfotoken($token);
		if (empty($member)){
			$this->back_json(205, '请重新登录');
		}

		$id = $_POST['id'];
		$num = $_POST['num'];

		$getReportinfo = $this->member->getReportinfomy($id);
		if ($num == 1){
			$data['reportinfo'] = $getReportinfo['reportinfo1'];
		}elseif ($num == 2){
			$data['reportinfo'] = $getReportinfo['reportinfo2'];
		}elseif ($num == 3){
			$data['reportinfo'] = $getReportinfo['reportinfo3'];
		}elseif ($num == 4){
			$data['reportinfo'] = $getReportinfo['reportinfo4'];
		}elseif ($num == 5){
			$data['reportinfo'] = $getReportinfo['reportinfo5'];
		}else{
			$data['reportinfo'] = $getReportinfo['reportinfo6'];
		}

		$this->back_json(200, '操作成功', $data);
	}
	public function notify()
	{
		if (!$xml = file_get_contents('php://input')) {
//            return json(array('code' => 205, 'info' => "not found data"));
			$this->back_json(204, 'not found data！');
		}
		// 将服务器返回的XML数据转化为数组
		$data = $this->fromXml($xml);
		// 保存微信服务器返回的签名sign
		$dataSign = $data['sign'];
		// sign不参与签名算法
		unset($data['sign']);
		// 生成签名
		$sign = $this->sign($data);

		if (($sign === $dataSign) && ($data['return_code'] == 'SUCCESS') && ($data['result_code'] == 'SUCCESS')) {
			$paynumber = $data['out_trade_no'];
			$this->member->getupdatereportorder($paynumber);
			$orderinfo = $this->member->getreportorder($paynumber);
			$id = $orderinfo['rid'];
			$mid = $orderinfo['mid'];
			$shool = empty($orderinfo['school'])?'':'-'.$orderinfo['school'];
			$area = empty($orderinfo['area'])?'':'-'.$orderinfo['area'];
			$settingdetails = $this->task->goodsdetailskefu();
			$getReportinfo = $this->member->getReportinfo($id);
			if ($getReportinfo['typename'] == '学区需求'){
				$reportinfo1 = empty($settingdetails['content1'])?'':$settingdetails['content1'];
				$reportinfo2 = empty($settingdetails['content2'])?'':$settingdetails['content2'];
				$reportinfo3 = empty($settingdetails['content3'])?'':$settingdetails['content3'];
				if ($getReportinfo['areaname'] == '中山区'){
					$reportinfo4 = empty($settingdetails['content4'])?'':$settingdetails['content4'];
				}elseif ($getReportinfo['areaname'] == '西岗区'){
					$reportinfo4 = empty($settingdetails['content5'])?'':$settingdetails['content5'];
				}elseif ($getReportinfo['areaname'] == '沙河口区'){
					$reportinfo4 = empty($settingdetails['content6'])?'':$settingdetails['content6'];
				}elseif ($getReportinfo['areaname'] == '甘井子区'){
					$reportinfo4 = empty($settingdetails['content7'])?'':$settingdetails['content7'];
				}elseif ($getReportinfo['areaname'] == '高新园区'){
					$reportinfo4 = empty($settingdetails['content8'])?'':$settingdetails['content8'];
				}else{
					$this->back_json(205, '请求失败');
				}
				$reportinfo5 = empty($getReportinfo['gcontent4'])?'':$getReportinfo['gcontent4'];
				$reportinfo6 = empty($getReportinfo['gcontent5'])?'':$getReportinfo['gcontent5'];
			}elseif ($getReportinfo['typename'] == '自住需求'){
				$reportinfo1 = empty($settingdetails['content9'])?'':$settingdetails['content9'];
				$reportinfo2 = empty($settingdetails['content10'])?'':$settingdetails['content10'];
				$reportinfo3 = empty($settingdetails['content11'])?'':$settingdetails['content11'];
					if ($getReportinfo['areaname'] == '中山区'){
						$reportinfo4 = empty($settingdetails['content12'])?'':$settingdetails['content12'];
					}elseif ($getReportinfo['areaname'] == '西岗区'){
						$reportinfo4 = empty($settingdetails['content13'])?'':$settingdetails['content13'];
					}elseif ($getReportinfo['areaname'] == '沙河口区'){
						$reportinfo4 = empty($settingdetails['content14'])?'':$settingdetails['content14'];
					}elseif ($getReportinfo['areaname'] == '甘井子区'){
						$reportinfo4 = empty($settingdetails['content15'])?'':$settingdetails['content15'];
					}elseif ($getReportinfo['areaname'] == '高新园区'){
						$reportinfo4 = empty($settingdetails['content16'])?'':$settingdetails['content16'];
					}else{
						$this->back_json(205, '请求失败');
					}
				$reportinfo5 = empty($getReportinfo['gcontent4'])?'':$getReportinfo['gcontent4'];
				$reportinfo6 = empty($getReportinfo['gcontent5'])?'':$getReportinfo['gcontent5'];
			}elseif ($getReportinfo['typename'] == '投资需求'){
				$reportinfo1 = empty($settingdetails['content17'])?'':$settingdetails['content17'];
				$reportinfo2 = empty($settingdetails['content18'])?'':$settingdetails['content18'];
				$reportinfo3 = empty($settingdetails['content19'])?'':$settingdetails['content19'];
					if ($getReportinfo['areaname'] == '中山区'){
						$reportinfo4 = empty($settingdetails['content20'])?'':$settingdetails['content20'];
					}elseif ($getReportinfo['areaname'] == '西岗区'){
						$reportinfo4 = empty($settingdetails['content21'])?'':$settingdetails['content21'];
					}elseif ($getReportinfo['areaname'] == '沙河口区'){
						$reportinfo4 = empty($settingdetails['content22'])?'':$settingdetails['content22'];
					}elseif ($getReportinfo['areaname'] == '甘井子区'){
						$reportinfo4 = empty($settingdetails['content23'])?'':$settingdetails['content23'];
					}elseif ($getReportinfo['areaname'] == '高新园区'){
						$reportinfo4 = empty($settingdetails['content24'])?'':$settingdetails['content24'];
					}else{
						$this->back_json(205, '请求失败');
					}
				$reportinfo5 = empty($getReportinfo['gcontent4'])?'':$getReportinfo['gcontent4'];
				$reportinfo6 = empty($getReportinfo['gcontent5'])?'':$getReportinfo['gcontent5'];
			}else{
				$this->back_json(205, '请求失败');
			}
			$typename = $getReportinfo['typename'];
			$title = $getReportinfo['typename']."-".$getReportinfo['pricename']."-".$getReportinfo['classname'].$area.$shool;
			$addtime = date('Y-m-d H:i:s',time());
			$this->member->insertmeorder($title,$typename,$reportinfo1,$reportinfo2,$reportinfo3,$reportinfo4,$reportinfo5,$reportinfo6,$addtime,$mid);
			$this->member->member_edit11($mid);
			echo 'SUCCESS';
			exit();
		}
	}
	public function notify1()
	{
		if (!$xml = file_get_contents('php://input')) {
//            return json(array('code' => 205, 'info' => "not found data"));
			$this->back_json(204, 'not found data！');
		}
		// 将服务器返回的XML数据转化为数组
		$data = $this->fromXml($xml);
		// 保存微信服务器返回的签名sign
		$dataSign = $data['sign'];
		// sign不参与签名算法
		unset($data['sign']);
		// 生成签名
		$sign = $this->sign($data);

		if (($sign === $dataSign) && ($data['return_code'] == 'SUCCESS') && ($data['result_code'] == 'SUCCESS')) {
			$paynumber = $data['out_trade_no'];
			$this->member->getupdatereportorder1($paynumber);
			$orderinfo = $this->member->getreportorder1($paynumber);
			$this->member->member_edit1($orderinfo['mid']);
			echo 'SUCCESS';
			exit();
		}
	}
	//签名 $data要先排好顺序
	private function sign($data){
		$stringA = '';
		foreach ($data as $key=>$value){
			if(!$value) continue;
			if($stringA) $stringA .= '&'.$key."=".$value;
			else $stringA = $key."=".$value;
		}
		$wx_key = 'dalianzhiyeyoudao123456789012345';//申请支付后有给予一个商户账号和密码，登陆后自己设置的key
		$stringSignTemp = $stringA.'&key='.$wx_key;
		return strtoupper(md5($stringSignTemp));
	}
	//将XML转化成数组
	public function fromXml($xml){
		// 禁止引用外部xml实体
		libxml_disable_entity_loader(true);
		return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
	}
	/**
	 * @param $arr
	 * @return string
	 *
	 */
	function arrayToXml($arr)
	{
		$xml = "<xml>";
		foreach ($arr as $key => $val) {
			if (is_array($val)) {
				$xml .= "<" . $key . ">" . $this->arrayToXml($val) . "</" . $key . ">";
			} else {
				$xml .= "<" . $key . ">" . $val . "</" . $key . ">";
			}
		}
		$xml .= "</xml>";
		return $xml;
	}
	function wxpost($url, $post)
	{
		//初始化
		$curl = curl_init();
		$header[] = "Content-type: text/xml";//定义content-type为xml
		//设置抓取的url
		curl_setopt($curl, CURLOPT_URL, $url);
		//设置头文件的信息作为数据流输出
//        curl_setopt($curl, CURLOPT_HEADER, 1);
		//定义请求类型
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		//设置获取的信息以文件流的形式返回，而不是直接输出。
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		//设置post方式提交
		curl_setopt($curl, CURLOPT_POST, 1);
		//设置post数据
		$post_data = $post;
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
		//执行命令
		$data = curl_exec($curl);
		//关闭URL请求
		//显示获得的数据
//        print_r($data);
		if ($data) {
			curl_close($curl);
			return $data;
		} else {
			$res = curl_error($curl);
			curl_close($curl);
			return $res;
		}
	}
	function xmlToArray($xml, $type = '')
	{
		//禁止引用外部xml实体
		libxml_disable_entity_loader(true);
		//simplexml_load_string()解析读取xml数据，然后转成json格式
		$xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
		if ($type == "json") {
			$json = json_encode($xmlstring);
			return $json;
		}
		$arr = json_decode(json_encode($xmlstring), true);
		return $arr;
	}
    /**
     * 个人信息修改（银行卡）
     */
    public function memberupdatainfo1(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '未授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请重新登录');
        }
        $mid = $member['mid'];
        //获得开户行
        $opend_bank = empty($_POST['opend_bank'])?'':$_POST['opend_bank'];
        //获得银行卡号
        $bank_card = empty($_POST['bank_card'])?'':$_POST['bank_card'];
        $this->member->updatamemberinfo1($mid,$opend_bank,$bank_card);

        $this->back_json(200, '更新成功', array());
    }
    /**
     * 首页轮播图
     */
    public function indeximglist(){
        $indeximglist = $this->member->getindeximglist();
        $data['indeximglist'] = empty($indeximglist)?'':$indeximglist;
        $this->back_json(200, '操作成功', $data);
    }
	/**
	 * 首页学校
	 */
	public function indexschoollist(){
		$indexschoollist = $this->member->indexschoollist();
//		$indexpricellist = $this->member->indexpricellist();
//		$indexarealist = $this->member->indexarealist();
//		$indextypelist = $this->member->indextypelist();
		$data['schoollist'] = empty($indexschoollist)?'':$indexschoollist;
		$this->back_json(200, '操作成功', $data);
	}
	/**
	 * 首页价格
	 */
	public function getPrice(){
		$indeximglist = $this->member->getsetInfo();
		$data['price'] = empty($indeximglist['price'])?0.00:$indeximglist['price'];
		$data['sellstr'] = empty($indeximglist['contentagent'])?'':$indeximglist['contentagent'];
		$data['price1'] = empty($indeximglist['price1'])?0.00:$indeximglist['price1'];
		$data['sellstr1'] = empty($indeximglist['contentagent1'])?'':$indeximglist['contentagent1'];
		$this->back_json(200, '操作成功', $data);
	}
	/**
	 * 首页资讯
	 */
	public function indexnewlist(){
		$indexnewlist = $this->member->getindexnewlist();
		$data['indexnewlist'] = empty($indexnewlist)?array():$indexnewlist;
		$this->back_json(200, '操作成功', $data);
	}
	public function getPayorder(){
		//验证loginCode是否传递
		if (!isset($_POST['token']) || empty($_POST['token'])) {
			$this->back_json(205, '未授权！请授权登录！');
		}
		$token = $_POST['token'];
		$member = $this->member->getMemberInfotoken($token);
		if (empty($member)){
			$this->back_json(205, '登录超时！请重新授权！');
		}
		$id = $_POST['id'];
		$getInfo = $this->member->getpayInfoo($id);
		$data['info'] = $getInfo;
		$this->back_json(200, '操作成功', $data);
	}
	public function indexnewlisto(){
		//验证loginCode是否传递
		if (!isset($_POST['token']) || empty($_POST['token'])) {
			$this->back_json(205, '未授权登录！');
		}

		$token = $_POST['token'];
		$member = $this->member->getMemberInfotoken($token);
		if (empty($member)){
			$this->back_json(205, '请重新登录');
		}
		$mid = $member['mid'];
		$indexnewlist = $this->member->getindexnewlisto($mid);
		$data['indexnewlist'] = empty($indexnewlist)?array():$indexnewlist;
		$this->back_json(200, '操作成功', $data);
	}
	public function indexnewlist1(){
		$indexnewlist = $this->member->getindexnewlist1();
		$data['indexnewlist'] = empty($indexnewlist)?array():$indexnewlist;
		$this->back_json(200, '操作成功', $data);
	}
	public function indexnewlist2(){
		$indexnewlist = $this->member->getindexnewlist2();
		$data['indexnewlist'] = empty($indexnewlist)?array():$indexnewlist;
		$this->back_json(200, '操作成功', $data);
	}
	public function indexnewlist3(){
		$indexnewlist = $this->member->getindexnewlist3();
		$data['indexnewlist'] = empty($indexnewlist)?array():$indexnewlist;
		$this->back_json(200, '操作成功', $data);
	}
	public function indexnewlist4(){
		$indexnewlist = $this->member->getindexnewlist4();
		$data['indexnewlist'] = empty($indexnewlist)?array():$indexnewlist;
		$this->back_json(200, '操作成功', $data);
	}
	public function indexnewlist5(){
		$indexnewlist = $this->member->getindexnewlist5();
		$data['indexnewlist'] = empty($indexnewlist)?array():$indexnewlist;
		$this->back_json(200, '操作成功', $data);
	}
	public function indexnewlist6(){
		$indexnewlist = $this->member->getindexnewlist6();
		$data['indexnewlist'] = empty($indexnewlist)?array():$indexnewlist;
		$this->back_json(200, '操作成功', $data);
	}
	/**
	 * 首页问答
	 */
	public function questionlist(){
		//验证loginCode是否传递
		if (!isset($_POST['token']) || empty($_POST['token'])) {
			$this->back_json(205, '未授权登录！');
		}
		$token = $_POST['token'];
		$member = $this->member->getMemberInfotoken($token);
		if (empty($member)){
			$this->back_json(205, '请重新登录');
		}
		$mid = $member['mid'];
		$search = empty($_POST['search'])?'':$_POST['search'];
		$indexnewlist = $this->member->getquestionlist($search);
		foreach ($indexnewlist as $k=>$v){
			$indexnewlist[$k]['add_time'] = date('Y-m-d h:i:s',$v['add_time']);
			if (empty($v['tareject'])){
				$indexnewlist[$k]['tareject'] = "目前没有回答！";
			}
		}
		$data['questionlist'] = empty($indexnewlist)?array():$indexnewlist;
		$this->back_json(200, '操作成功', $data);
	}
    /**
     * 首页公告
     */
    public function indexnoticelist(){
        $indexnoticelist = $this->member->getindexnoticelist();
        $indexnotice = "";
        if (!empty($indexnoticelist)){
            foreach ($indexnoticelist as $k=>$v){
                if (!empty($indexnotice)){
                    $indexnotice = $indexnotice . ' ! ' . ' 、 ' . $v['ncontent'];
                }else{
                    $indexnotice = $v['ncontent'];
                }
            }
        }
        $data['indexnotice'] = $indexnotice;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 首页会员人数
     */
    public function indexmembernum(){
        //获取会员实际人数
        $indexmembernum = $this->member->getindexmembernum();
        //获取设置虚拟人数
        $set = $this->member->getsetInfo();
        $membernum = floatval($indexmembernum) + floatval($set['membernum']);
        $data['membernum'] = empty($membernum)?'0':$membernum;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 分类列表  商家
     */
    public function indexclasslist(){
        $indexclasslist = $this->member->getindexclasslist();
        $data['indexclasslist'] = empty($indexclasslist)?'':$indexclasslist;
        $this->back_json(200, '操作成功', $data);
    }
	/**
	 * 分类列表  商品  推荐
	 */
	public function indexitemsclasslist(){
		$indexclasslist = $this->member->getindexitemsclasslist();
		$data['indexclasslist'] = empty($indexclasslist)?'':$indexclasslist;
		$this->back_json(200, '操作成功', $data);
	}
	/**
	 * 分类列表  商品
	 */
	public function itemsclasslist(){
		$indexclasslist = $this->member->getitemsclasslist();
		$data['indexclasslist'] = empty($indexclasslist)?'':$indexclasslist;
		$this->back_json(200, '操作成功', $data);
	}
    /**
     * 个人中心（设置二维码）
     */
    public function memberinfoshare(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '未授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请重新登录');
        }
        $mid = $member['mid'];
        //获得个人信息
        $data = array();
        if (empty($member['gid'])){
            $member['gname'] = "";
        }else{
            $grade = $this->member->getgradeInfo($member['gid']);
            $member['gname'] = $grade['gname'];
        }
        $newcount = $this->member->getnewscount($mid);
        $commissionsum = $this->member->getcommissionsum($mid);
        $member['newcount'] = $newcount;
        $member['commissionsum'] = empty($commissionsum)?'0.00':$commissionsum;

        if (empty($member['mqrcode'])){
            //生成推荐二维码
            $this->getAccessTokenNew($mid);
            $member = $this->member->getMemberInfotoken($token);
        }
        $data['member'] = $member;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 个人中心（我的客服二维码）
     */
    public function customercode(){
        $data = array();
        $data['setinfo'] = $this->member->getsetInfo();
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 推荐人列表
     */
    public function sharelist(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '未授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请重新登录');
        }
        $mid = $member['mid'];
        $sharelist = $this->member->getsharelist($mid);
        foreach ($sharelist as $k=>$v){
            $sharelist[$k]['badd_time'] = date("Y-m-d H:i:s",$v['badd_time']);
        }
        $data['sharelist'] = $sharelist;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 城市列表
     */
    public function citylist(){
        $citylist = $this->member->getcitylist();
        $data = array();
        $city = array();
        array_push($city,'请选择');
        foreach ($citylist as $k=>$v){
            array_push($city,$v['cname']);
        }
        $data['citylist'] = $city;
        $this->back_json(200, '操作成功', $data);
    }
    public function getAccessTokenNew($mid){

        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appid}&secret={$this->secret}";
        $res = json_decode($this->curl_get($url),1);
        if (empty($res['access_token'])){
            $this->back_json(205, '操作失败', array());
        }
        $session_data = array();
        $session_data['access_token'] = $res['access_token'];
        $session_data['expire'] = time()+7000;

        $access_token=$res['access_token'];
        $path="pages/share/share?mid=".$mid;
        $width=430;
        $imgname = "Uploads/".$mid.".jpg";

        if (empty($access_token)||empty($path)||empty($width)||empty($imgname)) {
            return 'error';
        }
        $url = "https://api.weixin.qq.com/wxa/getwxacode?access_token={$access_token}";
        $data = array();
        $data['path'] = $path;
        //最大32个可见字符，只支持数字，大小写英文以及部分特殊字符：!#$&'()*+,/:;=?@-._~，其它字符请自行编码为合法字符（因不支持%，中文无法使用 urlencode 处理，请使用其他编码方式）
        $data['width'] = $width;
        //二维码的宽度，默认为 430px
        $json = $this->https_request($url,json_encode($data));

        $file = fopen($imgname,"w");//打开文件准备写入
        fwrite($file,$json);//写入,$res为图片二进制内容
        fclose($file);//关闭
        $src="/Uploads/".$mid.".jpg";
        $mqrcode = "https://renwu.huaruishijia.com".$src;
        $this->member->updatashare($mid,$mqrcode);

    }
    public function curl_get($url){
        $headers = array('User-Agent:Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.81 Safari/537.36');
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        curl_setopt($oCurl, CURLOPT_TIMEOUT, 20);
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);

        if (intval($aStatus["http_code"]) == 200) {
            return $sContent;
        } else {
            return false;
        }
    }
    // 获取带参数的二维码
    // 获取小程序码，适用于需要的码数量极多的业务场景。通过该接口生成的小程序码，永久有效，数量暂无限制。
    function https_request($url,$data = null){
        if(function_exists('curl_init')){
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
            if (!empty($data)){
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($curl);
            curl_close($curl);
            return $output;
        }else{
            return false;
        }
    }

	/**
	 * 检验数据的真实性，并且获取解密后的明文.
	 * @param $encryptedData string 加密的用户数据
	 * @param $iv string 与用户数据一同返回的初始向量
	 * @param $data string 解密后的原文
	 *
	 * @return int 成功0，失败返回对应的错误码
	 */
	public function checknumber()
	{
		//验证loginCode是否传递
		if (!isset($_POST['token']) || empty($_POST['token'])) {
			$this->back_json(205, '未授权登录！');
		}

		$token = $_POST['token'];
		$member = $this->member->getMemberInfotoken($token);
		if (empty($member)){
			$this->back_json(205, '请重新登录');
		}
		$mid = $member['mid'];
		$encrypdata = $_POST['encrypdata'];
		$ivdata = $_POST['ivdata'];
		$sessionKey = $_POST['sessionKey'];
		if (strlen($sessionKey) != 24) {
			$this->back_json(205, 'sessionKey数据错误！');
		}
		$aesKey=base64_decode($sessionKey);


		if (strlen($ivdata) != 24) {
			$this->back_json(205, 'ivdata数据错误！');
		}
		$aesIV=base64_decode($ivdata);

		$aesCipher=base64_decode($encrypdata);

		$result=openssl_decrypt( $aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);

		$dataObj=json_decode($result);

		if(empty($dataObj))
		{
			$this->back_json(205, '数据错误！');
		}
		if($dataObj->watermark->appid != 'wx2807f1038eb33541')
		{
			$this->back_json(205, '数据错误appid！');
		}
		$phone = $dataObj->phoneNumber;
		$this->member->member_edit2($mid,$phone);
		$this->back_json(200, 'success！');
	}
}
