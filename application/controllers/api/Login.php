<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * **********************************************************************
 * サブシステム名  ： TASK
 * 機能名         ：注册/登录
 * 作成者        ： Gary
 * **********************************************************************
 */
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // 加载数据库类
        $this->load->model('Member_model', 'member');
    }
    /**
     * 注册/登录
     */
    public function register()
    {
		if (!isset($_POST['account']) || empty($_POST['account'])) {
			$this->back_json(201, '请输入员工账号！');
		}
		if (!isset($_POST['password']) || empty($_POST['password'])) {
			$this->back_json(201, '请输入员工密码！');
		}
		$Member = $this->member->getMember($_POST['account'],$_POST['password']);
		if (empty($Member)) {
			$this->back_json(201, '抱歉!账号或密码错误!');
		}
		$uid = $Member['id'];
        //验证loginCode是否传递
        if (!isset($_POST['loginCode']) || empty($_POST['loginCode'])) {
            $this->back_json(201, '未传递loginCode');
        }
        //验证nickname是否传递
        if (!isset($_POST['nickname']) || empty($_POST['nickname'])) {
            $this->back_json(201, '未传递nickname');
        }
        //验证avatarurl是否传递
        if (!isset($_POST['avatarurl']) || empty($_POST['avatarurl'])) {
            $this->back_json(201, '未传递avatarurl');
        }
		if (empty($_POST['avatarurl']) || $_POST['nickname'] == "微信用户"){
			$this->back_json(201, '数据错误请重新授权！');
		}
        // 取得信息 
        $loginCode = $_POST['loginCode'];
        //获得昵称
        $nickname = $_POST['nickname'];
        //获得图像
        $avatarurl = $_POST['avatarurl'];
        //获得性别
        $gender = $_POST['gender'];
		$account = $_POST['account'];
		$password = $_POST['password'];
        // 取得登录凭证 
        $resultnew = $this->get_code2Session($this->appid, $this->secret, $loginCode);

        //openid设置2
        $openid = $resultnew['openid'];
        if (empty($resultnew['openid'])){
            $this->back_json(205, '数据错误',array());
        }
        //用户是否注册判断
        $member_info_one = $this->member->getMemberInfo($openid);
        //验证会员
        if (empty($member_info_one)) {
            if (empty($_POST['sharemid'])){
                $member_id = "";
                $badd_time = "";
            }else{
                $member_id = $_POST['sharemid'];
                $badd_time = time();
            }
            //获得城市
            $cityname = "中国";
            /**注册操作*/
            $gid = 0;
            $avater = $avatarurl;
            $sex = $gender;
            $token = $this->_get_token($member_info_one['mid']);
            $add_time = time();
            $wallet = 0;
            $status = 1;
            $integral = 0;
            $state = 2;
            $is_agent = 2;
			$idnumber = $this->GetRandStr(6);
            // 注册操作
            $this->member->register($uid,$account,$password,$member_id,$badd_time,$is_agent,$cityname,$gid,$avater,$nickname,$sex,$openid,$token,$add_time,$wallet,$status,$integral,$state,$idnumber);

            $member_newinfo = $this->member->getMemberInfo($openid);
			$member_newinfo['session_key'] = $resultnew['session_key'];
            $this->back_json(200, '操作成功',$member_newinfo);

        } else {
            /**登录操作*/
            $token = $this->_get_token($member_info_one['mid']);
            $this->member->member_edit($member_info_one['mid'], $token);
            $member_info_one_new = $this->member->getmemberById($member_info_one['mid']);
            $this->back_json(200, '操作成功',$member_info_one_new);
        }
    }
	function GetRandStr($length){
		//字符组合
		$str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$len = strlen($str)-1;
		$randstr = '';
		for ($i=0;$i<$length;$i++) {
			$num=mt_rand(0,$len);
			$randstr .= $str[$num];
		}
		return $randstr;
	}
    /**
     * 登录生成token
     */
    private function _get_token($member_id)
    {
        //生成新的token
        $token = md5($member_id . strval(time()) . strval(rand(0, 999999)));
        return $token;
    }
    /**
     * 获得临时登录凭
     * @param type $appid 小程序 appId
     * @param type $secret 小程序 appSecret
     * @param type $loginCode 登录时获取的 code
     *
     * @return Array 用户信息
     */
    function get_code2Session($appid, $secret, $loginCode) {
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=' . $appid . '&secret=' . $secret . '&grant_type=authorization_code&js_code=' . $loginCode;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //禁止调用时就输出获取到的数据
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $result = curl_exec($ch);
        curl_close($ch);
        $resultnew = json_decode($result, true);
        return $resultnew;
    }
}
