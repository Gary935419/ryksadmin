<?php


class Member_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }
	//审核认证count
	public function getdriverupAllPage($starttime,$end,$account=array())
	{
		$sqlw = " where 1=1 and type = 2 and user_check >= 1 ";
		if (!empty($account)) {
			$account = $this->db->escape($account);
			$sqlw .= " and (name = " . $account . " or account  = " . $account . " or cards  = " . $account . " or car_number  = " . $account . ")";
		}
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and add_time >= $starttime and add_time <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and add_time >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and add_time <= $end ";
		}
		$sql = "SELECT count(1) as number FROM `user` " . $sqlw;
		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	//审核认证count
	public function getdriverupAll($pg,$starttime,$end,$account=array())
	{
		$sqlw = " where 1=1 and type = 2 and user_check >= 1 ";
		if (!empty($account)) {
			$account = $this->db->escape($account);
			$sqlw .= " and (name = " . $account . " or account  = " . $account . " or cards  = " . $account . " or car_number  = " . $account . ")";
		}
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and add_time >= $starttime and add_time <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and add_time >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and add_time <= $end ";
		}
		$start = ($pg - 1) * 10;
		$stop = 10;
		$sql = "SELECT * FROM `user` " . $sqlw . " order by add_time desc LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}
	//认证byid
	public function getdriverById($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `user` where id=$id ";
		return $this->db->query($sql)->row_array();
	}
	//认证byid
	public function getapplyById($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `merchants_apply` where id=$id ";
		return $this->db->query($sql)->row_array();
	}
	public function car_info($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `car_type` where id=$id ";
		return $this->db->query($sql)->row_array();
	}
	//审核任务提交
	public function examine_new_save_task($id,$user_check,$reason)
	{
		$id = $this->db->escape($id);
		$user_check = $this->db->escape($user_check);
		$reason = $this->db->escape($reason);
		$sql = "UPDATE `user` SET user_check=$user_check,reason=$reason WHERE id = $id";
		return $this->db->query($sql);
	}
	public function examine_new_save_task1($id,$driving_check,$reason)
	{
		$id = $this->db->escape($id);
		$driving_check = $this->db->escape($driving_check);
		$reason = $this->db->escape($reason);
		$sql = "UPDATE `user` SET driving_check=$driving_check,reason1=$reason WHERE id = $id";
		return $this->db->query($sql);
	}
	public function examine_new_save_task22($id,$status,$reason)
	{
		$id = $this->db->escape($id);
		$status = $this->db->escape($status);
		$reason = $this->db->escape($reason);
		$sql = "UPDATE `merchants_apply` SET status=$status,rejected=$reason WHERE id = $id";
		return $this->db->query($sql);
	}
	public function apply_info($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `merchants_apply` where id=$id ";
		return $this->db->query($sql)->row_array();
	}
	public function examine_new_save_task2($id)
	{
		$id = $this->db->escape($id);
		$sql = "UPDATE `user` SET is_merchants=1 WHERE id = $id";
		return $this->db->query($sql);
	}
	//审核认证count
	public function getdriverupAllPage1($starttime,$end,$account=array())
	{
		$sqlw = " where 1=1 and type = 2 and driving_check >= 1 ";
		if (!empty($account)) {
			$account = $this->db->escape($account);
			$sqlw .= " and (driving_name = " . $account . " or account  = " . $account . " or driving_cards  = " . $account . ")";
		}
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and add_time >= $starttime and add_time <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and add_time >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and add_time <= $end ";
		}
		$sql = "SELECT count(1) as number FROM `user` " . $sqlw;
		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	//审核认证count
	public function getdriverupAll1($pg,$starttime,$end,$account=array())
	{
		$sqlw = " where 1=1 and type = 2 and driving_check >= 1 ";
		if (!empty($account)) {
			$account = $this->db->escape($account);
			$sqlw .= " and (driving_name = " . $account . " or account  = " . $account . " or driving_cards  = " . $account . ")";
		}
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and add_time >= $starttime and add_time <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and add_time >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and add_time <= $end ";
		}
		$start = ($pg - 1) * 10;
		$stop = 10;
		$sql = "SELECT * FROM `user` " . $sqlw . " order by add_time desc LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}
	//审核认证count
	public function getapplyAllPage($starttime,$end,$account=array())
	{
		$sqlw = " where 1=1 ";
		if (!empty($account)) {
			$account = $this->db->escape($account);
			$sqlw .= " and (tabChangeNameValue = " . $account . ")";
		}
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and addtime >= $starttime and addtime <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and addtime >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and addtime <= $end ";
		}
		$sql = "SELECT count(1) as number FROM `merchants_apply` " . $sqlw;
		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	//审核认证count
	public function getapplyAll($pg,$starttime,$end,$account=array())
	{
		$sqlw = " where 1=1 ";
		if (!empty($account)) {
			$account = $this->db->escape($account);
			$sqlw .= " and (tabChangeNameValue = " . $account . ")";
		}
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and addtime >= $starttime and addtime <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and addtime >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and addtime <= $end ";
		}
		$start = ($pg - 1) * 10;
		$stop = 10;
		$sql = "SELECT * FROM `merchants_apply` " . $sqlw . " order by addtime desc LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}
	//获取报备数量 跑腿
	public function getcomplaintAllPage($account)
	{
		$sqlw = " where 1=1 and oc.order_type = 1 ";
		if (!empty($account)) {
			$sqlw .= " and ( ot.number like '%" . $account . "%' ) ";
		}
		$sql = "SELECT count(1) as number FROM `order_complaint` oc  LEFT JOIN `user` me ON me.id = oc.uid LEFT JOIN `order_traffic` ot ON ot.id = oc.order_id " . $sqlw;
		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	//获取报备信息 跑腿
	public function getcomplaintAll($pg, $account)
	{
		$sqlw = " where 1=1 and oc.order_type = 1 ";
		if (!empty($account)) {
			$sqlw .= " and ( ot.number like '%" . $account . "%' ) ";
		}
		$start = ($pg - 1) * 10;
		$stop = 10;
		$sql = "SELECT oc.id,me.name,me.account,ot.number,oc.content,oc.dateline FROM `order_complaint` oc  LEFT JOIN `user` me ON me.id = oc.uid LEFT JOIN `order_traffic` ot ON ot.id = oc.order_id " . $sqlw . " order by oc.dateline desc LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}
	//获取报备数量  代驾
	public function getcomplaintAllPage1($account)
	{
		$sqlw = " where 1=1 and oc.order_type = 2 ";
		if (!empty($account)) {
			$sqlw .= " and ( ot.number like '%" . $account . "%' ) ";
		}
		$sql = "SELECT count(1) as number FROM `order_complaint` oc  LEFT JOIN `user` me ON me.id = oc.uid LEFT JOIN `order_town` ot ON ot.id = oc.order_id " . $sqlw;
		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	//获取报备信息  代驾
	public function getcomplaintAll1($pg, $account)
	{
		$sqlw = " where 1=1 and oc.order_type = 2 ";
		if (!empty($account)) {
			$sqlw .= " and ( ot.number like '%" . $account . "%' ) ";
		}
		$start = ($pg - 1) * 10;
		$stop = 10;
		$sql = "SELECT oc.id,me.name,me.account,ot.number,oc.content,oc.dateline FROM `order_complaint` oc  LEFT JOIN `user` me ON me.id = oc.uid LEFT JOIN `order_town` ot ON ot.id = oc.order_id " . $sqlw . " order by oc.dateline desc LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}
    //获取会员总人数  用户
    public function getmemberAllPage($account)
    {
        $sqlw = " where 1=1 and type = 1 ";
		if (!empty($account)) {
			$sqlw .= " and ( account like '%" . $account . "%' ) ";
		}
        $sql = "SELECT count(1) as number FROM `user` " . $sqlw;
        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //获取会员总信息 用户
    public function getmemberAll($pg, $account)
    {
		$sqlw = " where 1=1 and type = 1 ";
		if (!empty($account)) {
			$sqlw .= " and ( account like '%" . $account . "%' ) ";
		}
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `user` " . $sqlw . " order by add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //获取会员总人数  司机
	public function getmemberAllPage1($account)
	{
		$sqlw = " where type = 2 ";
		if (!empty($account)) {
			$sqlw .= " and user_check = 1 ";
//			$sqlw .= " and ( account like '%" . $account . "%' or name like '%" . $account . "%' or driving_name like '%" . $account . "%' or invitation_code2 like '%" . $account . "%' ) ";
			$account = $this->db->escape($account);
			$sqlw .= " and (account = " . $account . " or name  = " . $account . " or driving_name  = " . $account . " or invitation_code2  = " . $account . ")";
		}else{
			$sqlw .= " and user_check = 1 or driving_check = 1 ";
		}
		$sql = "SELECT count(1) as number FROM `user` " . $sqlw;
		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	//获取会员总信息 司机
	public function getmemberAll1($pg, $account)
	{
		$sqlw = " where type = 2 ";
		if (!empty($account)) {
			$sqlw .= " and user_check = 1 ";
//			$sqlw .= " and ( account like '%" . $account . "%' or name like '%" . $account . "%' or driving_name like '%" . $account . "%' or invitation_code2 like '%" . $account . "%' ) ";
			$account = $this->db->escape($account);
			$sqlw .= " and (account = " . $account . " or name  = " . $account . " or driving_name  = " . $account . " or invitation_code2  = " . $account . ")";
		}else{
			$sqlw .= " and user_check = 1 or driving_check = 1 ";
		}
		$start = ($pg - 1) * 10;
		$stop = 10;
		$sql = "SELECT * FROM `user` " . $sqlw . " order by add_time desc LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}
    //根据id查看详情
	public function getmemberById($mid)
	{
		$mid = $this->db->escape($mid);
		$sql = "SELECT * FROM `user` where id = $mid ";
		return $this->db->query($sql)->row_array();
	}
    //会員内容修改提交
	public function member_save_edit($mid,$credit_points,$is_logoff)
	{
		$credit_points = $this->db->escape($credit_points);
		$is_logoff = $this->db->escape($is_logoff);
		$mid = $this->db->escape($mid);
		$sql = "UPDATE `user` SET credit_points=$credit_points,is_logoff=$is_logoff WHERE id = $mid";
		return $this->db->query($sql);
	}
    //类型list
	public function gettidlist()
	{
		$sql = "SELECT * FROM `car_type` order by id desc ";
		return $this->db->query($sql)->result_array();
	}

    //图片list
	public function getapplyimglist($mid)
	{
		$mid = $this->db->escape($mid);
		$sql = "SELECT * FROM `merchants_img` where mid = $mid order by id desc ";
		return $this->db->query($sql)->result_array();
	}





    //获取会员总
    public function getmembernewAll($cityname)
    {
        $cityname = $this->db->escape($cityname);
        $sqlw = " where 1=1 and cityname = $cityname and is_agent = 1 ";
        $sql = "SELECT * FROM `member` " . $sqlw . " order by add_time desc ";
        return $this->db->query($sql)->result_array();
    }

    //查询等级信息列表
    public function getgradeAll()
    {
        $sql = "SELECT * FROM `grade` order by gid desc";
        return $this->db->query($sql)->result_array();
    }
    //查询城市信息列表
    public function getcnameAll()
    {
        $sql = "SELECT * FROM `city` order by cid desc";
        return $this->db->query($sql)->result_array();
    }
    //查询消息信息列表
    public function getnewslist($mid,$pg)
    {
        $mid = $this->db->escape($mid);
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `news` where mid = $mid order by add_time desc LIMIT $start, $stop";

        return $this->db->query($sql)->result_array();
    }
	public function send_coupon_go($user_id,$money,$type,$add_time,$end_time)
	{
		$user_id = $this->db->escape($user_id);
		$money = $this->db->escape($money);
		$type = $this->db->escape($type);
		$add_time = $this->db->escape($add_time);
		$end_time = $this->db->escape($end_time);
		$sql = "INSERT INTO `coupon` (user_id,money,type,add_time,end_time) VALUES ($user_id,$money,$type,$add_time,$end_time);";
		return $this->db->query($sql);
	}
    //会員消息保存
    public function member_new_save($mid,$ncontent, $add_time, $if_flag)
    {
        $mid = $this->db->escape($mid);
        $ncontent = $this->db->escape($ncontent);
        $add_time = $this->db->escape($add_time);
        $if_flag = $this->db->escape($if_flag);

        $sql = "INSERT INTO `news` (mid,ncontent,add_time,if_flag) VALUES ($mid,$ncontent,$add_time,$if_flag);";
        return $this->db->query($sql);
    }
    //验证发送信息频繁
    public function getnewsinfo($mid,$add_timeend,$add_time)
    {
        $sqlw = " where mid=$mid and add_time between $add_timeend and $add_time";
        $sql = "SELECT * FROM `news` " . $sqlw;
        return $this->db->query($sql)->result_array();
    }


    /* 小程序接口开始   　      * */
    /* 时间：2019/12/4       * */

    //根据opendid查看详情
    public function getMemberInfo($openid)
    {
        $openid = $this->db->escape($openid);
        $sql = "SELECT * FROM `member` where openid = $openid ";
        return $this->db->query($sql)->row_array();
    }
    //根据token查看详情
    public function getMemberInfotoken($token)
    {
        $token = $this->db->escape($token);
        $sql = "SELECT * FROM `member` where token = $token ";
        return $this->db->query($sql)->row_array();
    }
    //会员注册
    public function register($member_id,$badd_time,$is_agent,$cityname,$gid,$avater,$nickname,$sex,$openid,$token,$add_time,$wallet,$status,$integral,$state)
    {
        $member_id = $this->db->escape($member_id);
        $badd_time = $this->db->escape($badd_time);
        $is_agent = $this->db->escape($is_agent);
        $cityname = $this->db->escape($cityname);
        $gid = $this->db->escape($gid);
        $avater = $this->db->escape($avater);
        $nickname = $this->db->escape($nickname);
        $sex = $this->db->escape($sex);
        $openid = $this->db->escape($openid);
        $token = $this->db->escape($token);
        $add_time = $this->db->escape($add_time);
        $wallet = $this->db->escape($wallet);
        $status = $this->db->escape($status);
        $integral = $this->db->escape($integral);
        $state = $this->db->escape($state);
        $sql = "INSERT INTO `member` (member_id,badd_time,is_agent,cityname,gid,avater,nickname,sex,openid,token,add_time,wallet,status,integral,state) VALUES ($member_id,$badd_time,$is_agent,$cityname,$gid,$avater,$nickname,$sex,$openid,$token,$add_time,$wallet,$status,$integral,$state)";
        return $this->db->query($sql);
    }
    //会員登录
    public function member_edit($mid, $token)
    {
        $mid = $this->db->escape($mid);
        $token = $this->db->escape($token);
        $sql = "UPDATE `member` SET token=$token WHERE mid = $mid";
        return $this->db->query($sql);
    }
    //根据id查看详情
    public function getgradeInfo($gid)
    {
        $gid = $this->db->escape($gid);
        $sql = "SELECT * FROM `grade` where gid = $gid ";
        return $this->db->query($sql)->row_array();
    }
    //查看设置详情
    public function getsetInfo()
    {
        $sql = "SELECT * FROM `setting` where sid = 1 ";
        return $this->db->query($sql)->row_array();
    }
    //获得佣金统计
    public function getcommissionsum($mid)
    {
        $sqlw = " where mid=$mid and wtype = 1 ";
        $sql = "SELECT SUM(wprice) as number from walletwater " . $sqlw ;
        $number = $this->db->query($sql)->row()->number;
        return $number;
    }
    //获取会员未读消息统计
    public function getnewscount($mid)
    {
        $sqlw = " where 1=1 and mid =$mid and if_flag=2";

        $sql = "SELECT count(1) as number FROM `news` " . $sqlw;
        $number = $this->db->query($sql)->row()->number;
        return $number;
    }
    //获取会员待处理统计
    public function gettaorder1($mid)
    {
        $sqlw = " where 1=1 and mid=$mid and ostate=1";

        $sql = "SELECT count(1) as number FROM `taorder` " . $sqlw;
        $number = $this->db->query($sql)->row()->number;
        return $number;
    }
    //获取会员审核中统计
    public function gettaorder2($mid)
    {
        $sqlw = " where 1=1 and mid=$mid and ostate=2";

        $sql = "SELECT count(1) as number FROM `taorder` " . $sqlw;
        $number = $this->db->query($sql)->row()->number;
        return $number;
    }
    //获取会员已通过统计
    public function gettaorder3($mid)
    {
        $sqlw = " where 1=1 and mid=$mid and ostate=3";

        $sql = "SELECT count(1) as number FROM `taorder` " . $sqlw;
        $number = $this->db->query($sql)->row()->number;
        return $number;
    }
    //获取会员未通过统计
    public function gettaorder4($mid)
    {
        $sqlw = " where 1=1 and mid=$mid and ostate=4";

        $sql = "SELECT count(1) as number FROM `taorder` " . $sqlw;
        $number = $this->db->query($sql)->row()->number;
        return $number;
    }
    //获取城市列表
    public function getcitylist()
    {
        $sqlw = " where 1=1 ";
        $sql = "SELECT * FROM `city` " . $sqlw ;
        return $this->db->query($sql)->result_array();
    }
    //会員消息标记已读
    public function getnewsflge($mid)
    {
        $mid = $this->db->escape($mid);
        $sql = "UPDATE `news` SET if_flag=1 WHERE mid = $mid";
        return $this->db->query($sql);
    }
    //获取积分明细
    public function getintegrallist($mid,$pg)
    {
        $sqlw = " where 1=1 and mid = $mid";
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `integralflow` " . $sqlw . " order by add_time desc LIMIT $start, $stop";

        return $this->db->query($sql)->result_array();
    }
    //获取钱包明细
    public function getwalletllist($mid,$pg)
    {
        $sqlw = " where 1=1 and mid = $mid and wtype != 1 and wtype != 7 and wtype != 8 ";
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `walletwater` " . $sqlw . " order by add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //获取佣金明细
    public function getcommissionlist($mid,$pg)
    {
        $sqlw = " where 1=1 and mid = $mid and wtype=1 ";
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `walletwater` " . $sqlw . " order by add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //会員基础信息设置
    public function updatamemberinfo($mid,$truename,$mobile,$email,$address)
    {
        $mid = $this->db->escape($mid);
        $truename = $this->db->escape($truename);
        $mobile = $this->db->escape($mobile);
        $email = $this->db->escape($email);
        $address = $this->db->escape($address);
        $sql = "UPDATE `member` SET truename=$truename,mobile=$mobile,email=$email,address=$address WHERE mid = $mid";
        return $this->db->query($sql);
    }
    //会員基础信息银行卡
    public function updatamemberinfo1($mid,$opend_bank,$bank_card)
    {
        $mid = $this->db->escape($mid);
        $opend_bank = $this->db->escape($opend_bank);
        $bank_card = $this->db->escape($bank_card);
        $sql = "UPDATE `member` SET opend_bank=$opend_bank,bank_card=$bank_card WHERE mid = $mid";
        return $this->db->query($sql);
    }
    //获取广告列表
    public function getindeximglist()
    {
        $sqlw = " where 1=1";
        $sql = "SELECT * FROM `advertisement` " . $sqlw . " order by add_time desc ";
        return $this->db->query($sql)->result_array();
    }
    //获取公告列表
    public function getindexnoticelist()
    {
        $sqlw = " where 1=1";
        $sql = "SELECT * FROM `notice` " . $sqlw . " order by add_time desc ";
        return $this->db->query($sql)->result_array();
    }
    //获取分类列表
    public function getindexclasslist()
    {
        $sqlw = " where 1=1";
        $sql = "SELECT * FROM `taskclass` " . $sqlw . " order by tsort desc ";
        return $this->db->query($sql)->result_array();
    }
    //任务筛选条件查询
    public function gettasklist($tid,$keywords,$pricestate,$pg)
    {
        $sqlw = " where 1=1 and if_recommend=1";

        if (!empty($tid)) {
            $tid = $this->db->escape($tid);
            $sqlw .= " and tid = $tid ";
        }
        if (!empty($keywords)) {
            $sqlw .= " and ( tatitle like '%" . $keywords . "%') ";
        }
        if (!empty($pricestate)) {
            if ($pricestate == 1){
                $sqlw .= " order by tacommission desc ";
            }else{
                $sqlw .= " order by tacommission asc ";
            }
        }else{
            $sqlw .= " order by add_time desc ";
        }

        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `task` " . $sqlw ." LIMIT $start, $stop";
//        $sql = "SELECT * FROM `city` " . $sqlw . " order by add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //根据mid查看详情
    public function getMemberInfomid($mid)
    {
        $mid = $this->db->escape($mid);
        $sql = "SELECT * FROM `member` where mid = $mid ";
        return $this->db->query($sql)->row_array();
    }
    //updatashare
    public function updatashare($mid,$mqrcode)
    {
        $mid = $this->db->escape($mid);
        $mqrcode = $this->db->escape($mqrcode);
        $sql = "UPDATE `member` SET mqrcode=$mqrcode WHERE mid = $mid";
        return $this->db->query($sql);
    }
    //获取推荐人列表
    public function getsharelist($mid)
    {
        $sqlw = " where 1=1 and member_id = $mid and ifpay=1 ";
        $sql = "SELECT * FROM `member` " . $sqlw . " order by badd_time desc ";
        return $this->db->query($sql)->result_array();
    }
    //获取会员总人数
    public function getindexmembernum()
    {
        $sqlw = " where 1=1 ";
        $sql = "SELECT count(1) as number FROM `member` " . $sqlw;
        $number = $this->db->query($sql)->row()->number;
        return $number;
    }
    //格式化数据库
    public function deleteall()
    {
        $sql =  "DELETE FROM integralflow";
        $sql1 = "DELETE FROM member";
        $sql2 = "DELETE FROM news";
        $sql3 = "DELETE FROM oimgs";
        $sql4 = "DELETE FROM rechargeorder";
        $sql5 = "DELETE FROM taorder";
        $sql6 = "DELETE FROM task";
        $sql7 = "DELETE FROM walletwater";
        $sql8 = "DELETE FROM withdrawal";
        $this->db->query($sql);
        $this->db->query($sql1);
        $this->db->query($sql2);
        $this->db->query($sql3);
        $this->db->query($sql4);
        $this->db->query($sql5);
        $this->db->query($sql6);
        $this->db->query($sql7);
        $this->db->query($sql8);
    }
}
