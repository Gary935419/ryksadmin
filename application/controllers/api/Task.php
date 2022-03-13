<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * **********************************************************************
 * サブシステム名  ： TASK
 * 機能名         ：任务
 * 作成者        ： Gary
 * **********************************************************************
 */
class Task extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // 加载数据库类
        $this->load->model('Member_model', 'member');
        $this->load->model('Label_model', 'label');
        $this->load->model('Task_model', 'task');
        $this->load->model('Examine_model', 'examine');
    }
    /**
     * 分类列表
     */
    public function indexclasslists(){
        $indexclasslist = $this->member->getindexclasslist();
        $data['indexclasslist'] = empty($indexclasslist)?'':$indexclasslist;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 任务列表
     */
    public function tasklist(){
        //获得分类id
        $tid = $_POST['tid'];
        //获得关键字
        $keywords = $_POST['keywords'];
        //获得排序（pricestate  1：倒序 2：正序）
        $pricestate = $_POST['order'];
        $page = $_POST['pageNumber'];
        $tasklist = $this->member->gettasklist($tid,$keywords,$pricestate,$page);
        foreach ($tasklist as $k=>$v){
            $laids = $v['laids'];
            $laidsarr = explode(",", $laids);
            $arr = array();
            foreach ($laidsarr as $kk=>$vv){
                $label_info = $this->label->getlabelById($vv);
                if (!empty($label_info)){
                    $arr[] = $label_info['lname'];
                }
            }
            $tasklist[$k]['lname'] = $arr;
        }
        $data['tasklist'] = $tasklist;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 任务详情
     */
    public function taskdetails()
    {
        //验证loginCode是否传递
        if (!isset($_POST['taid']) || empty($_POST['taid'])) {
            $this->back_json(201, '未传递taid');
        }
        $taid = $_POST['taid'];
        $task_info = $this->task->gettaskById($taid);
        if (empty($task_info)) {
            $this->back_json(201, '数据错误');
        }
        $data = array();
        $data['taskdetails'] = $task_info;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 等级详情
     */
    public function gradedetails()
    {
        if (!isset($_POST['gid']) || empty($_POST['gid'])) {
            $this->back_json(201, '未传递gid');
        }
        $gid = $_POST['gid'];
        $grade_info = $this->task->getgradeById($gid);
        if (empty($grade_info)) {
            $this->back_json(201, '数据错误');
        }
        $data = array();
        $data['gradedetails'] = $grade_info;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 商家入驻详情
     */
    public function taskorderdetails()
    {
        //验证loginCode是否传递
        if (!isset($_POST['oid']) || empty($_POST['oid'])) {
            $this->back_json(201, '未传递oid');
        }
        $oid = $_POST['oid'];
        $task_info = $this->task->gettaskorderById($oid);
        if (empty($task_info)) {
            $this->back_json(201, '数据错误');
        }
        $taskimglist = $this->task->gettaskorderimglist($oid);
        foreach ($taskimglist as $k=>$v){
            $taskimglistarray[]=$v['oiimg'];
        }
        $task_info['imgs'] = $taskimglist;
        $task_info['imgslist'] = $taskimglistarray;
        $data = array();
        $task_info['tareject'] = empty($task_info['tareject'])?'暂无回馈信息！请耐心等待！':$task_info['tareject'];
        $data['taskdetails'] = $task_info;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 接任务
     */
    public function sendtask(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '未授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请重新登录');
        }
        if (!isset($_POST['taid']) || empty($_POST['taid'])) {
            $this->back_json(201, '为传递taid！');
        }
        $taid = $_POST['taid'];
        $mid = $member['mid'];
        $wallet = $member['wallet'];

        $task_info = $this->task->gettaskById($taid);
        $taskordecount = $this->task->gettaskordercount($taid,$mid);
        if ($taskordecount>=$task_info['constraintdays']){
            $this->back_json(204, '抱歉，每人限领次数用完，请选择其他任务！');
        }
        if ($task_info['tanums'] < 1){
            $this->back_json(204, '抱歉，任务名额不足，请选择其他任务！');
        }
        if ($wallet < $task_info['tadeposit']){
            $this->back_json(204, '抱歉，您的押金余额不足，请先交押金！');
        }else{
            //钱包更新
            $walletnew = floatval($wallet) - floatval($task_info['tadeposit']);
            $this->task->memberwallet_save_edit($walletnew,$mid);
            //任务名额更新
            $tanumsnew = floatval($task_info['tanums']) - 1;
            $this->task->tasktanums_save_edit($tanumsnew,$taid);
        }
        //任务下单
        $taid = $task_info['taid'];
        $otid = $task_info['tid'];
        $olaids = $task_info['laids'];
        $otanums = $task_info['tanums'];
        $otacontents = $task_info['tacontents'];
        $otacommission = $task_info['tacommission'];
        $otatitle = $task_info['tatitle'];
        $otaimg = $task_info['taimg'];
        $oif_recommend = $task_info['if_recommend'];
        $otatips = $task_info['tatips'];
        $oconstraintdays = $task_info['constraintdays'];
        $otadays = $task_info['tadays'];
        $otadeposit = $task_info['tadeposit'];
        $oexaminedays = $task_info['examinedays'];
        $orequirement = $task_info['requirement'];
        $otaintegral = $task_info['taintegral'];
        $otaurl = $task_info['taurl'];
        $add_time = time();
        $ostate = 1;
        $oid = $this->task->taskorder_save($otaurl,$olaids,$taid,$mid,$otid,$otanums,$otacontents,$otacommission, $otatitle,$otaimg,$oif_recommend,$otatips,$oconstraintdays,$otadays,$otadeposit,$oexaminedays,$orequirement,$otaintegral,$add_time,$ostate);

        //任务下单记录
        $wremark = "接任务，扣除押金";
        $wprice = $task_info['tadeposit'];
        $wtype = 2;
        $this->task->taskwater_save($mid,$wremark,$wprice,$wtype,$add_time);

        $data = array();
        $data['oid']=$oid;
        $this->back_json(200, '操作成功！',$data);
    }
    /**
     * 订单列表
     */
    public function taskorder(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '未授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请重新登录');
        }
        $page = $_POST['pageNumber'];
        $mid = $member['mid'];
        $taskorderlist = $this->task->gettaskorderlist($mid,$page);
        $taskorderlist2 = $this->task->gettaskorderlist2($mid,$page);
        $taskorderlist3 = $this->task->gettaskorderlist3($mid,$page);
        $taskorderlist4 = $this->task->gettaskorderlist4($mid,$page);
        if (!empty($taskorderlist)){
            foreach ($taskorderlist as $k=>$v){
                $taskorderlist[$k]['add_time'] = date("Y-m-d H:i:s",$v['add_time']);
            }
        }
        if (!empty($taskorderlist2)){
            foreach ($taskorderlist2 as $k=>$v){
                $taskorderlist2[$k]['add_time'] = date("Y-m-d H:i:s",$v['add_time']);
            }
        }
        if (!empty($taskorderlist3)){
            foreach ($taskorderlist3 as $k=>$v){
                $taskorderlist3[$k]['add_time'] = date("Y-m-d H:i:s",$v['add_time']);
            }
        }
        if (!empty($taskorderlist4)){
            foreach ($taskorderlist4 as $k=>$v){
                $taskorderlist4[$k]['add_time'] = date("Y-m-d H:i:s",$v['add_time']);
            }
        }
        $data['orderall'] = empty($taskorderlist)?array():$taskorderlist;
        $data['orderostate2'] = empty($taskorderlist2)?array():$taskorderlist2;
        $data['orderostate3'] = empty($taskorderlist3)?array():$taskorderlist3;
        $data['orderostate4'] = empty($taskorderlist4)?array():$taskorderlist4;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 任务提交审核
     */
    public function sendexamine(){
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
        //验证upload_picture_list是否传递
        if (!isset($_POST['upload_picture_list']) || empty($_POST['upload_picture_list'])) {
            $this->back_json(201, '请上传任务截图！');
        }
        //验证truename是否传递
        if (!isset($_POST['truename']) || empty($_POST['truename'])) {
            $this->back_json(201, '请上传姓名！');
        }
        //验证mobile是否传递
        if (!isset($_POST['mobile']) || empty($_POST['mobile'])) {
            $this->back_json(201, '请上传电话！');
        }
        //验证shopname是否传递
        if (!isset($_POST['shopname']) || empty($_POST['shopname'])) {
            $this->back_json(201, '请上传商家名称！');
        }
        //验证email是否传递
        if (!isset($_POST['email']) || empty($_POST['email'])) {
            $this->back_json(201, '请上传邮箱！');
        }
        //验证address是否传递
        if (!isset($_POST['address']) || empty($_POST['address'])) {
            $this->back_json(201, '请上传详细地址！');
        }
        //验证content是否传递
        if (!isset($_POST['content']) || empty($_POST['content'])) {
            $this->back_json(201, '请上传详细说明！');
        }

        $todayStart= strtotime(date('Y-m-d 00:00:00', time()));
        $todayEnd= strtotime(date('Y-m-d 23:59:59', time()));

        //获取会员当天盛情次数
        $shopscount = $this->task->getshopscount($mid,$todayStart,$todayEnd);
        if ($shopscount >= 3){
            $this->back_json(201, '会员每日只能申请入驻3次！请明日再来！');
        }
        $truename = $_POST['truename'];
        $mobile = $_POST['mobile'];
        $shopname = $_POST['shopname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $content = $_POST['content'];
        //截图
        $upload_picture_list =$_POST['upload_picture_list'];
        $ostate = 2;
        $add_time = time();
        $imgs = json_decode($upload_picture_list,true);
        $oid =$this->task->shoptaskorder_save($mid,$content,$address,$email,$shopname,$mobile,$truename,$ostate,$add_time);
        foreach ($imgs as $k => $v){
            $this->task->taskexamineimg_save($oid,$v['path_server']);
        }
        $this->back_json(200, '操作成功', array());
    }
    /**
     * 提现申请列表
     */
    public function withdrawallist(){
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
        //验证content是否传递
        if (!isset($_POST['wtype']) || empty($_POST['wtype'])) {
            $this->back_json(201, '请填写提现类型！');
        }
        $wtype = $_POST['wtype'];
        $page = $_POST['pageNumber'];
        $withdrawallist = $this->task->withdrawallist($mid,$wtype,$page);
        foreach ($withdrawallist as $k=>$v){
            $withdrawallist[$k]['add_time'] = date("Y-m-d H:i:s",$v['add_time']);
        }
        $data['withdrawallist'] = $withdrawallist;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 押金提现审核提交
     */
    public function withdrawalwrprice(){
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
        //验证是否可以提现
        if ($member['state'] == 2){
            $this->back_json(201, '抱歉!该提现权限没有开通!！');
        }
        //验证wrprice是否传递
        if (!isset($_POST['wrprice']) || empty($_POST['wrprice'])) {
            $this->back_json(201, '请输入您要提现的金额！');
        }

        //提现金额
        $wrprice = $_POST['wrprice'];
        $wallet = empty($member['wallet'])?'0':$member['wallet'];
        if ($wallet<$wrprice){
            $this->back_json(204, '抱歉！您的押金余额不足！');
        }
        $wrstate = 2;
        $wtype1 = 1;
        $add_time = time();
        $this->task->withdrawalwrprice($wtype1,$mid,$wrprice,$wrstate,$add_time);

        $walletnew = floatval($wallet) - floatval($wrprice);
        $this->task->updatawithdrawalwrprice($mid,$walletnew);

        $wprice = $wrprice;
        $add_time1=time();
        $wtype = 5;
        $wremark = "押金申请提现，金额扣除。";
        $this->examine->withdrawal_save($wprice,$add_time1,$mid,$wtype,$wremark);
        $this->back_json(200, '操作成功', array());
    }
    /**
     * 佣金提现审核提交
     */
    public function withdrawalwrpricecom(){
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
        //验证wrprice是否传递
        if (!isset($_POST['wrprice']) || empty($_POST['wrprice'])) {
            $this->back_json(201, '请输入您要提现的金额！');
        }
        //提现金额
        $wrprice = $_POST['wrprice'];
        $walletcommission = empty($member['walletcommission'])?'0':$member['walletcommission'];
        if ($walletcommission<$wrprice){
            $this->back_json(204, '抱歉！您的佣金余额不足！');
        }
        $wrstate = 2;
        $wtype1 = 2;
        $add_time = time();
        $this->task->withdrawalwrprice($wtype1,$mid,$wrprice,$wrstate,$add_time);

        $walletcommissionnew = floatval($walletcommission) - floatval($wrprice);
        $this->task->updatawithdrawalwrpricecom($mid,$walletcommissionnew);

        $wprice = $wrprice;
        $add_time1=time();
        $wtype = 7;
        $wremark = "佣金申请提现，金额扣除。";
        $this->examine->withdrawal_save($wprice,$add_time1,$mid,$wtype,$wremark);
        $this->back_json(200, '操作成功', array());
    }
    /**
     * 充值押金生成订单
     */
    public function payrechargeorder(){
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
        //验证money是否传递
        if (!isset($_POST['money']) || empty($_POST['money'])) {
            $this->back_json(201, '请输入金额！');
        }
        //充值金额
        $money = $_POST['money'];
        //获得最小充值押金金额
        $settinginfo = $this->task->getsettinginfo();
        $min_deposit = empty($settinginfo['min_deposit'])?'0':$settinginfo['min_deposit'];
        if ($money<$min_deposit){
            $this->back_json(204, '最低押金金额为:￥'.$min_deposit.'！');
        }
        $remarks = "会员押金充值！";
        $pstate = 2;
        $rtype = "微信支付";
        $paynumber = "PAY".time().$mid;
        $add_time = time();
        $recommend = empty($member['member_id'])?'':$member['member_id'];
        $this->task->rechargeordersave($recommend,$money,$mid,$remarks,$pstate,$rtype,$paynumber,$add_time);

        $data = array();
        $data['paynumber'] = $paynumber;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 支付成功回调
     */
    public function notify(){
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

        //$wx_total_fee = $data['total_fee'];
        // 判断签名是否正确  判断支付状态
        if (($sign === $dataSign) && ($data['return_code'] == 'SUCCESS') && ($data['result_code'] == 'SUCCESS')) {
            $paynumber = $data['out_trade_no'];
            //修改订单状态
            $this->task->updatarechargeorder($paynumber);
            //获得订单信息
            $rechargeorderinfo = $this->task->rechargeorderinfo($paynumber);
            $mid = $rechargeorderinfo['mid'];
            $money = $rechargeorderinfo['money'];
            $recommend = $rechargeorderinfo['recommend'];
            //获得用户信息
            $memberinfo = $this->task->memberinfo($mid);
            //推荐人ID
            $member_id = empty($memberinfo['member_id'])?'':$memberinfo['member_id'];
            //更新钱包
            $walletnew = floatval($memberinfo['wallet']) + floatval($money);
            //修改会员已经交押金状态
            $this->task->updatamemberifpay($mid);
            //修改用户钱包信息
            $this->task->updatamemberinfowallet($mid,$walletnew);
            //流水记录
            $wprice = $money;
            $add_time=time();
            $wtype = 4;
            $wremark = "微信支付充值钱包";
            $this->task->wallet_water_save($wprice,$add_time,$mid,$wtype,$wremark);

            //推荐人数据处理
            if (!empty($member_id)){
                //推荐人绑定时间
                $badd_time = $memberinfo['badd_time'];
                //等级更新判断
                $count = $this->task->getrechargeordercount($member_id,$badd_time);
                $gidlist = $this->examine->getgradeAll();
                $memberinfo1 = $this->task->memberinfo($member_id);
                $state = $memberinfo1['state'];
                $gid = 0;
                foreach ($gidlist as $k=>$v){
                    if ($count >= $v['recommend']){
                        $gid = $v['gid'];
                    }
                }
                //手动调整等级的问题
                if (empty($memberinfo1['gid'])){
                    $this->examine->member_save_edit_gid($member_id, $gid);
                }else{
                    $grade_info = $this->examine->getgradeById($memberinfo1['gid']);
                    $recommend = $grade_info['recommend'];
                    if ($recommend<=$count){
                        $this->examine->member_save_edit_gid($member_id, $gid);
                    }
                }
                $set_info = $this->examine->getsetById();
                //提现验证
                if ($state != 1){
                    if ($count >= $set_info['snum2']){
                        $this->examine->member_save_state($member_id);
                    }
                }
            }
            echo 'SUCCESS';
            exit();
        }
    }
    /**
     * 微信支付
     */
    public function wechatpay(){
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
        //验证money是否传递
        if (!isset($_POST['money']) || empty($_POST['money'])) {
            $this->back_json(201, '为传递money！');
        }
        //验证paynumber是否传递
        if (!isset($_POST['paynumber']) || empty($_POST['paynumber'])) {
            $this->back_json(201, '为传递paynumber！');
        }
        $money = $_POST['money'];
        $paynumber = $_POST['paynumber'];

//        $WX_APPID = 'wx7712ad5334d94749';//小程序appid
//        $WX_SECRET = '2e8e2737e5b856e5defeaae95517ea25';//小程序AppSecret
//        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=" . $WX_APPID . "&secret=" . $WX_SECRET . "&js_code=" . $code . "&grant_type=authorization_code";
//        $infos = json_decode(file_get_contents($url));
//        $openid = $infos->openid;

        $openid = $member['openid'];
        $fee = $money;//举例支付0.01
        $appid = 'wxa6f4b6f8bf75d380';//appid.如果是公众号 就是公众号的appid
        $body = '用户充值';
        $mch_id = '1563304301';  //商户号
        $nonce_str = $this->nonce_str();//随机字符串
        $notify_url = 'https://renwu.huaruishijia.com/index.php/api/Task/notify'; //回调的url【自己填写】
//        $openid = "omNtW48IAxirawisyAfDq5LzDuCg";
        $openid = $openid;
        $out_trade_no = $paynumber;//商户订单号
        $spbill_create_ip = $_SERVER['REMOTE_ADDR'];//服务器的ip【自己填写】;
        $total_fee = $fee*100;// 微信支付单位是分，所以这里需要*100
        $trade_type = 'JSAPI';//交易类型 默认
        //这里是按照顺序的 因为下面的签名是按照顺序 排序错误 肯定出错
        $post['appid'] = $appid;
        $post['body'] = $body;
        $post['mch_id'] = $mch_id;
        $post['nonce_str'] = $nonce_str;//随机字符串
        $post['notify_url'] = $notify_url;
        $post['openid'] = $openid;
        $post['out_trade_no'] = $out_trade_no;
        $post['spbill_create_ip'] = $spbill_create_ip;//终端的ip
        $post['total_fee'] = $total_fee;//总金额
        $post['trade_type'] = $trade_type;
        $sign = $this->sign($post);//签名
        $post_xml = '<xml>
           <appid>' . $appid . '</appid>
           <body>' . $body . '</body>
           <mch_id>' . $mch_id . '</mch_id>
           <nonce_str>' . $nonce_str . '</nonce_str>
           <notify_url>' . $notify_url . '</notify_url>
           <openid>' . $openid . '</openid>
           <out_trade_no>' . $out_trade_no . '</out_trade_no>
           <spbill_create_ip>' . $spbill_create_ip . '</spbill_create_ip>
           <total_fee>' . $total_fee . '</total_fee>
           <trade_type>' . $trade_type . '</trade_type>
           <sign>' . $sign . '</sign>
        </xml> ';

        //统一接口prepay_id
        $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        $xml = $this->http_request($url, $post_xml);
        $array = $this->xml($xml);//全要大写

        if ($array['RETURN_CODE'] == 'SUCCESS' && $array['RESULT_CODE'] == 'SUCCESS' && $array['RETURN_MSG'] == 'OK') {
            $time = time();
            $tmp = array();//临时数组用于签名
            $tmp['appId'] = $appid;
            $tmp['nonceStr'] = $nonce_str;
            $tmp['package'] = 'prepay_id=' . $array['PREPAY_ID'];
            $tmp['signType'] = 'MD5';
            $tmp['timeStamp'] = "$time";

            $data['state'] = 200;
            $data['timeStamp'] = "$time";//时间戳
            $data['nonceStr'] = $nonce_str;//随机字符串
            $data['signType'] = 'MD5';//签名算法，暂支持 MD5
            $data['package'] = 'prepay_id=' . $array['PREPAY_ID'];//统一下单接口返回的 prepay_id 参数值，提交格式如：prepay_id=*
            $data['paySign'] = $this->sign($tmp);//签名,具体签名方案参见微信公众号支付帮助文档;
            $data['out_trade_no'] = $out_trade_no;
            $this->back_json(200, '支付成功', $data);
        } else {
            $data['state'] = 0;
            $data['text'] = "错误";
            $data['RETURN_CODE'] = $array['RETURN_CODE'];
            $data['RETURN_MSG'] = $array['RETURN_MSG'];
            $data['ERR_CODE_DES'] = empty($array['ERR_CODE_DES'])?:$array['ERR_CODE_DES'];
            $this->back_json(204, '有错误', $data);
        }
    }
    /**
     * 分享绑定推荐人
     */
    public function updatashare(){
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
        //验证mid是否传递
        if (!isset($_POST['mid']) || empty($_POST['mid'])) {
            $this->back_json(201, '推荐人不存在！');
        }
        //推荐人id
        $member_id = $_POST['mid'];
        $badd_time = time();
        if ($member_id === $mid){
            $this->back_json(201, '不能绑定自己为推荐人！');
        }
        $this->task->updatashare($mid,$member_id,$badd_time);
        $this->back_json(200, '绑定成功', array());
    }
    //随机32位字符串
    private function nonce_str(){
        $result = '';
        $str = 'QWERTYUIOPASDFGHJKLZXVBNMqwertyuioplkjhgfdsamnbvcxz';
        for ($i=0;$i<32;$i++){
            $result .= $str[rand(0,48)];
        }
        return $result;
    }
    //签名 $data要先排好顺序
    private function sign($data){
        $stringA = '';
        foreach ($data as $key=>$value){
            if(!$value) continue;
            if($stringA) $stringA .= '&'.$key."=".$value;
            else $stringA = $key."=".$value;
        }
        $wx_key = 'FSKEPj7eHARPgmdAL5T8KtBPofhLq6JY';//申请支付后有给予一个商户账号和密码，登陆后自己设置的key
        $stringSignTemp = $stringA.'&key='.$wx_key;
        return strtoupper(md5($stringSignTemp));
    }
    //curl请求
    public function http_request($url,$data = null,$headers=array())
    {
        $curl = curl_init();
        if( count($headers) >= 1 ){
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
    //获取xml
    private function xml($xml){
        $p = xml_parser_create();

        xml_parse_into_struct($p, $xml, $vals, $index);
        xml_parser_free($p);
        $data = array();

        foreach ($index as $key=>$value) {
            if($key == 'XML'||$key == 'xml') continue;
            $tag = $vals[$value[0]]['tag'];
            $value = $vals[$value[0]]['value'];
            $data[$tag] = $value;
        }
        return $data;
    }
    //将XML转化成数组
    public function fromXml($xml){
        // 禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    }

    /**
     * 商家列表
     */
    public function goodslist(){

        $keywords = $_POST['keywords'];
        $page = $_POST['pageNumber'];
        if (!empty($_POST['status'])){
            $status = $_POST['status'];
            $goodslist = $this->task->goodsliststatus($keywords,$page,$status);
        }else{
            $goodslist = $this->task->goodslist($keywords,$page);
        }
        foreach ($goodslist as $k=>$v){
            $goodslist[$k]['addtime'] = date("Y-m-d H:i:s",$v['addtime']);
        }
        $data['goodslist'] = $goodslist;
        $this->back_json(200, '操作成功', $data);
    }

	/**
	 * 商品列表
	 */
	public function itemslist(){

		$keywords = $_POST['keywords'];
		$page = $_POST['pageNumber'];
		if (!empty($_POST['status'])){
			$status = $_POST['status'];
			$goodslist = $this->task->itemsliststatus($keywords,$page,$status);
		}else{
			$goodslist = $this->task->itemslist($keywords,$page);
		}
		foreach ($goodslist as $k=>$v){
			$goodslist[$k]['addtime'] = date("Y-m-d H:i:s",$v['addtime']);
		}
		$data['goodslist'] = $goodslist;
		$this->back_json(200, '操作成功', $data);
	}

    /**
     * 商家列表(类型)
     */
    public function goodslisttype(){

        $tid = $_POST['tid'];
        $page = $_POST['pageNumber'];
        $goodslist = $this->task->goodslisttype($tid,$page);
        foreach ($goodslist as $k=>$v){
            $goodslist[$k]['addtime'] = date("Y-m-d H:i:s",$v['addtime']);
        }
        $data['goodslist'] = $goodslist;
        $this->back_json(200, '操作成功', $data);
    }
	/**
	 * 商品列表(类型)
	 */
	public function itemslisttype(){

		$tid = $_POST['tid'];
		$page = $_POST['pageNumber'];
		$goodslist = $this->task->itemslisttype($tid,$page);
		foreach ($goodslist as $k=>$v){
			$goodslist[$k]['addtime'] = date("Y-m-d H:i:s",$v['addtime']);
		}
		$data['goodslist'] = $goodslist;
		$this->back_json(200, '操作成功', $data);
	}
    public function goodsdetails(){

        $gid = $_POST['gid'];
        //获取商品数据
        $goodsdetails = $this->task->goodsdetails($gid);
        $data['goodsdetails'] = $goodsdetails;
        $this->back_json(200, '操作成功', $data);
    }
	public function goodsdetails1(){
		$gid = $_POST['gid'];
		//获取商品数据
		$goodsdetails = $this->task->goodsdetails1($gid);
		$data['goodsdetails'] = $goodsdetails;
		$this->back_json(200, '操作成功', $data);
	}
	public function goodsdetails2(){
		$gid = $_POST['gid'];
		//获取商品数据
		$goodsdetails = $this->task->goodsdetails2($gid);
		$data['goodsdetails'] = $goodsdetails;
		$this->back_json(200, '操作成功', $data);
	}
	public function goodsdetails3(){
		$gid = $_POST['gid'];
		//获取商品数据
		$goodsdetails = $this->task->goodsdetails3($gid);
		$data['goodsdetails'] = $goodsdetails;
		$this->back_json(200, '操作成功', $data);
	}
	public function goodsdetails4(){
		$gid = $_POST['gid'];
		//获取商品数据
		$goodsdetails = $this->task->goodsdetails4($gid);
		$data['goodsdetails'] = $goodsdetails;
		$this->back_json(200, '操作成功', $data);
	}
	public function goodsdetails5(){
		$gid = $_POST['gid'];
		//获取商品数据
		$goodsdetails = $this->task->goodsdetails5($gid);
		$data['goodsdetails'] = $goodsdetails;
		$this->back_json(200, '操作成功', $data);
	}
	public function goodsdetails6(){
		$gid = $_POST['gid'];
		//获取商品数据
		$goodsdetails = $this->task->goodsdetails6($gid);
		$data['goodsdetails'] = $goodsdetails;
		$this->back_json(200, '操作成功', $data);
	}
	public function goodsdetails7(){

		//获取商品数据
		$goodsdetails = $this->task->goodsdetails7();
		$data['goodsdetails'] = $goodsdetails;
		$this->back_json(200, '操作成功', $data);
	}
	/**
	 * 客服详情
	 */
	public function goodsdetailskefu(){

		//获取商品数据
		$goodsdetails = $this->task->goodsdetailskefu();
		$data['goodsdetails'] = $goodsdetails;

		$this->back_json(200, '操作成功', $data);
	}
	/**
	 * 商品详情
	 */
	public function itemsdetails(){

		$gid = $_POST['gid'];
		//获取商品数据
		$goodsdetails = $this->task->itemsdetails($gid);
		//获得商品Banner数据
		$goodsimglist = $this->task->itemsimglist($gid);
		$data['goodsdetails'] = $goodsdetails;
		$data['goodsimglist'] = empty($goodsimglist)?array():$goodsimglist;
		$this->back_json(200, '操作成功', $data);
	}
    /**
     * 商家意向合作提交
     */
    public function sendgoods(){

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
        //验证gid是否传递
        if (!isset($_POST['gid']) || empty($_POST['gid'])) {
            $this->back_json(201, '请输入商品ID！');
        }
        //验证content是否传递
        if (!isset($_POST['content']) || empty($_POST['content'])) {
            $this->back_json(201, '请输入合作事宜！');
        }
        //验证email是否传递
        if (!isset($_POST['email']) || empty($_POST['email'])) {
            $this->back_json(201, '请输入邮件！');
        }
        //验证shopname是否传递
        if (!isset($_POST['shopname']) || empty($_POST['shopname'])) {
            $this->back_json(201, '请输入商家名称！');
        }
        //验证mobile是否传递
        if (!isset($_POST['mobile']) || empty($_POST['mobile'])) {
            $this->back_json(201, '请输入联系号码！');
        }
        //验证truename是否传递
        if (!isset($_POST['truename']) || empty($_POST['truename'])) {
            $this->back_json(201, '请输入真实姓名！');
        }
        $gid = $_POST['gid'];
        $content = $_POST['content'];
        $email = $_POST['email'];
        $shopname = $_POST['shopname'];
        $mobile = $_POST['mobile'];
        $truename = $_POST['truename'];
        $timeo = time();
        $timeon = floatval($timeo) - 3;
        $ordergoods_info_state = $this->task->getordergoodsByIdstate($gid,$mid,$timeon);
        if (!empty($ordergoods_info_state)){
            $this->back_json(201, '请勿重复操作！');
            return;
        }
        $todayStart= strtotime(date('Y-m-d 00:00:00', time()));
        $todayEnd= strtotime(date('Y-m-d 23:59:59', time()));

        //获取会员当天申请次数
        $shopscount = $this->task->getshopscountgoods($mid,$todayStart,$todayEnd);
        if ($shopscount >= 3){
            $this->back_json(201, '会员每日只能申请合作3次！请明日再来！');
        }

        //获取商品数据
        $goodsdetails = $this->task->goodsdetails($gid);

        //录入兑换下单
        $gname = $goodsdetails['gname'];
        $gtitle = $goodsdetails['gtitle'];
        $gcontent = $goodsdetails['gcontent'];
        $gimg = $goodsdetails['gimg'];
        $addtime = time();
        $ostate = 1; //1 已提交 2 已审核 3 已驳回
        $gsort = $goodsdetails['gsort'];
        $gid = $goodsdetails['gid'];

        $this->task->flowgoods_save($gname,$gtitle,$gcontent,$gimg,$addtime,$ostate,$gsort,$gid,$mid,$content,$email,$shopname,$mobile,$truename);
        $this->back_json(200, '操作成功', array());
    }
	/**
	 * 商品下单合作意向
	 */
	public function itemsordergo(){

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
		//验证gid是否传递
		if (!isset($_POST['gid']) || empty($_POST['gid'])) {
			$this->back_json(201, '请输入商品ID！');
		}
		//验证content是否传递
		if (!isset($_POST['content']) || empty($_POST['content'])) {
			$this->back_json(201, '请输入合作事宜！');
		}
		//验证email是否传递
		if (!isset($_POST['email']) || empty($_POST['email'])) {
			$this->back_json(201, '请输入邮件！');
		}
		//验证ename是否传递
		if (!isset($_POST['ename']) || empty($_POST['ename'])) {
			$this->back_json(201, '请输入商品名称！');
		}
		//验证mobile是否传递
		if (!isset($_POST['mobile']) || empty($_POST['mobile'])) {
			$this->back_json(201, '请输入联系号码！');
		}
		//验证truename是否传递
		if (!isset($_POST['truename']) || empty($_POST['truename'])) {
			$this->back_json(201, '请输入真实姓名！');
		}
		$gid = $_POST['gid'];
		$contentnew = $_POST['content'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$truename = $_POST['truename'];
		$timeo = time();
		$timeon = floatval($timeo) - 3;
		$ordergoods_info_state = $this->task->getorderitemsByIdstate($gid,$mid,$timeon);
		if (!empty($ordergoods_info_state)){
			$this->back_json(201, '请勿重复操作！');
			return;
		}
		$todayStart= strtotime(date('Y-m-d 00:00:00', time()));
		$todayEnd= strtotime(date('Y-m-d 23:59:59', time()));

		//获取会员当天申请次数
		$shopscount = $this->task->getshopscountitems($mid,$todayStart,$todayEnd);
		if ($shopscount >= 3){
			$this->back_json(201, '会员每日只能申请合作3次！请明日再来！');
		}

		//获取商品数据
		$goodsdetails = $this->task->itemsdetails($gid);

		$ename = $goodsdetails['ename'];
		$etitle = $goodsdetails['etitle'];
		$img = $goodsdetails['img'];
		$ishot = $goodsdetails['ishot'];
		$unitprice = $goodsdetails['unitprice'];
		$unitnums = $goodsdetails['unitnums'];
		$batchprice = $goodsdetails['batchprice'];
		$batchnums = $goodsdetails['batchnums'];
		$sumnums = $goodsdetails['sumnums'];
		$place = $goodsdetails['place'];
		$delivery = $goodsdetails['delivery'];
		$content = $goodsdetails['content'];
		$parameter = $goodsdetails['parameter'];
		$cid = $goodsdetails['cid'];
		$esort = $goodsdetails['esort'];
		$topprice = $goodsdetails['topprice'];
		$topnums = $goodsdetails['topnums'];
		$addtime = time();
		$ostate = 1; //1 已提交 2 已审核 3 已驳回

		$this->task->itemsordergo($mid,$ename,$etitle,$img,$ishot,$unitprice,$unitnums,$batchprice,$batchnums,$sumnums,$place,$delivery,$content,$parameter,$cid,$esort,$topprice,$topnums,$addtime,$ostate,$gid,$contentnew,$email,$mobile,$truename);
		$this->back_json(200, '操作成功', array());
	}
	/**
	 * 感兴趣
	 */
	public function interestgoods(){

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
		//验证gid是否传递
		if (!isset($_POST['gid']) || empty($_POST['gid'])) {
			$this->back_json(201, '请输入商品ID！');
		}
		//验证mobile是否传递
		if (!isset($_POST['mobile']) || empty($_POST['mobile'])) {
			$this->back_json(201, '请输入联系号码！');
		}
		$gid = $_POST['gid'];
		$mobile = $_POST['mobile'];

		$ordergoods = $this->task->getordergoodsinterset($gid,$mid);
		if (!empty($ordergoods)){
			$this->back_json(201, '当前商品你已经申请感兴趣啦！');
			return;
		}

		//获取商品数据
		$goodsdetails = $this->task->itemsdetails($gid);
		$ename = $goodsdetails['ename'];
		$cid = $goodsdetails['cid'];
		$img = $goodsdetails['img'];
		$itemsclassdetails = $this->task->itemsclassdetails($cid);
		$classname = $itemsclassdetails['cname'];

		$this->task->flowinterest_save($ename,$classname,$img,$mobile,time(),$mid,$gid);
		$this->back_json(200, '操作成功', array());
	}
    /**
     * 我的申请商家列表
     */
    public function mygoodslist(){

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
        $goodslist = $this->task->mygoodslist($page,$mid);
        foreach ($goodslist as $k=>$v){
            if ($v['ostate'] == 3){
                $goodslist[$k]['ostatename'] = "已驳回，请选择其他商家！";
            }elseif ($v['ostate'] == 2){
                $goodslist[$k]['ostatename'] = "已审核，工作人员会近期联系您！";
            }else{
                $goodslist[$k]['ostatename'] = "已提交，请耐心等待！";
            }
            $goodslist[$k]['addtime'] = date("Y-m-d H:i:s",$v['addtime']);
            $goodslist[$k]['gotime'] = empty($v['gotime'])?'':date("Y-m-d H:i:s",$v['gotime']);
            $goodslist[$k]['logistics'] = empty($v['logistics'])?'':$v['logistics'];
        }
        $data['goodslist'] = $goodslist;
        $this->back_json(200, '操作成功', $data);
    }

	/**
	 * 我的申请商品列表
	 */
	public function myitemslist(){

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
		$goodslist = $this->task->myitemslist($page,$mid);
		foreach ($goodslist as $k=>$v){
			if ($v['ostate'] == 3){
				$goodslist[$k]['ostatename'] = "已驳回，请选择其他商品！";
			}elseif ($v['ostate'] == 2){
				$goodslist[$k]['ostatename'] = "已审核，工作人员会近期联系您！";
			}else{
				$goodslist[$k]['ostatename'] = "已提交，请耐心等待！";
			}
			$goodslist[$k]['addtime'] = date("Y-m-d H:i:s",$v['addtime']);
			$goodslist[$k]['gotime'] = empty($v['gotime'])?'':date("Y-m-d H:i:s",$v['gotime']);
			$goodslist[$k]['logistics'] = empty($v['logistics'])?'':$v['logistics'];
		}
		$data['goodslist'] = $goodslist;
		$this->back_json(200, '操作成功', $data);
	}
}
