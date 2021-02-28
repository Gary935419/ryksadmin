<?php


class Examine_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }
	//审核提现提交
	public function examine_new_save($id,$status,$reject,$price)
	{
		$id = $this->db->escape($id);
		$status = $this->db->escape($status);
		$reject = $this->db->escape($reject);
		$price = $this->db->escape($price);
		$sql = "UPDATE `postal` SET money=$price,status=$status,notice=$reject WHERE id = $id";
		return $this->db->query($sql);
	}
	//提现byid
	public function getwithdrawalById($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `postal` where id=$id ";
		return $this->db->query($sql)->row_array();
	}
	//避免重复点击
	public function getwithdrawalByIdstate($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `postal` where id=$id and status !=1 ";
		return $this->db->query($sql)->row_array();
	}
    //审核提现count
    public function getwithdrawalAllPage($starttime,$end)
    {
        $sqlw = " where 1=1 ";
        if (!empty($starttime) && !empty($end)) {
            $starttime = strtotime($starttime);
            $end = strtotime($end)+86400;
            $sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
        } elseif (!empty($starttime) && empty($end)) {
            $starttime = strtotime($starttime);
            $sqlw .= " and m.add_time >= $starttime ";
        } elseif (empty($starttime) && !empty($end)) {
            $end = strtotime($end)+86400;
            $sqlw .= " and m.add_time <= $end ";
        }
        $sql = "SELECT count(1) as number FROM `postal` m  LEFT JOIN `user` me ON me.id = m.driver_id " . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //审核提现list
    public function getwithdrawalAll($pg,$starttime,$end)
    {
        $sqlw = " where 1=1 ";
        if (!empty($starttime) && !empty($end)) {
            $starttime = strtotime($starttime);
            $end = strtotime($end)+86400;
            $sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
        } elseif (!empty($starttime) && empty($end)) {
            $starttime = strtotime($starttime);
            $sqlw .= " and m.add_time >= $starttime ";
        } elseif (empty($starttime) && !empty($end)) {
            $end = strtotime($end)+86400;
            $sqlw .= " and m.add_time <= $end ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;

        $sql = "SELECT m.*,me.account FROM `postal` m  LEFT JOIN `user` me ON me.id = m.driver_id " . $sqlw . " order by m.add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
   //提现count
	public function getwithdrawalAllPage1($starttime,$end)
	{
		$sqlw = " where 1=1 ";
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and m.add_time >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time <= $end ";
		}
		$sql = "SELECT count(1) as number FROM `user_withdrawal` m  LEFT JOIN `user` me ON me.id = m.user_id " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	//提现list
	public function getwithdrawalAll1($pg,$starttime,$end)
	{
		$sqlw = " where 1=1 ";
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and m.add_time >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time <= $end ";
		}
		$start = ($pg - 1) * 10;
		$stop = 10;

		$sql = "SELECT m.*,me.account,me.name FROM `user_withdrawal` m  LEFT JOIN `user` me ON me.id = m.user_id " . $sqlw . " order by m.add_time desc LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}
	//专车送 count
	public function getOrder1Count($starttime,$end)
	{
		$sqlw = " where order_status > 1 and order_type = 1 ";
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and m.add_time >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time <= $end ";
		}
		$sql = "SELECT count(1) as number FROM `order_traffic` m" . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
	//顺风送 count
	public function getOrder2Count($starttime,$end)
	{
		$sqlw = " where order_status > 1 and order_type = 2 ";
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and m.add_time >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time <= $end ";
		}
		$sql = "SELECT count(1) as number FROM `order_traffic` m" . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
	//代买 count
	public function getOrder3Count($starttime,$end)
	{
		$sqlw = " where order_status > 1 and order_type = 3 ";
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and m.add_time >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time <= $end ";
		}
		$sql = "SELECT count(1) as number FROM `order_traffic` m" . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
	//代驾 count
	public function getOrder1Count1($starttime,$end)
	{
		$sqlw = " where order_status > 1 ";
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and m.add_time >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time <= $end ";
		}
		$sql = "SELECT count(1) as number FROM `order_town` m" . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
	//账单总金额
	public function getOrder4Price($starttime,$end)
	{
		$sqlw = " where order_status > 1 ";
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and m.add_time >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time <= $end ";
		}
		$sql = "SELECT sum(price) as number FROM `order_traffic` m" . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
	//账单总金额 非取消
	public function getOrder5Price($starttime,$end)
	{
		$sqlw = " where order_status > 1 and status != 7";
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and m.add_time >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time <= $end ";
		}
		$sql = "SELECT sum(price) as number FROM `order_traffic` m" . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
	//司机总金额 非取消
	public function getOrder6Price($starttime,$end)
	{
		$sqlw = " where order_status > 1 and status != 7";
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and m.add_time >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time <= $end ";
		}
		$sql = "SELECT sum(order_driver_price) as number FROM `order_traffic` m" . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
	//平台总抽成 非取消
	public function getOrder7Price($starttime,$end)
	{
		$sqlw = " where order_status > 1 and status != 7";
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and m.add_time >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time <= $end ";
		}
		$sql = "SELECT sum(cost_price) as number FROM `order_traffic` m" . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
	//平台总保价 非取消
	public function getOrder8Price($starttime,$end)
	{
		$sqlw = " where order_status > 1 and status != 7";
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and m.add_time >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time <= $end ";
		}
		$sql = "SELECT sum(protect_price) as number FROM `order_traffic` m" . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
	//平台总小费 非取消
	public function getOrder9Price($starttime,$end)
	{
		$sqlw = " where order_status > 1 and status != 7";
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and m.add_time >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time <= $end ";
		}
		$sql = "SELECT sum(tip_price) as number FROM `order_traffic` m" . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
	//账单总金额 代驾
	public function getOrder4Price1($starttime,$end)
	{
		$sqlw = " where order_status > 1 ";
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and m.add_time >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time <= $end ";
		}
		$sql = "SELECT sum(price) as number FROM `order_town` m" . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
	//账单总金额 非取消 代驾
	public function getOrder5Price1($starttime,$end)
	{
		$sqlw = " where order_status > 1 and status != 7";
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and m.add_time >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time <= $end ";
		}
		$sql = "SELECT sum(price) as number FROM `order_town` m" . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
	//司机总金额 非取消 代驾
	public function getOrder6Price1($starttime,$end)
	{
		$sqlw = " where order_status > 1 and status != 7";
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and m.add_time >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time <= $end ";
		}
		$sql = "SELECT sum(order_driver_price) as number FROM `order_town` m" . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
	//平台总抽成 非取消 代驾
	public function getOrder7Price1($starttime,$end)
	{
		$sqlw = " where order_status > 1 and status != 7";
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and m.add_time >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time <= $end ";
		}
		$sql = "SELECT sum(cost_price) as number FROM `order_town` m" . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
	//平台总小费 非取消 代驾
	public function getOrder8Price1($starttime,$end)
	{
		$sqlw = " where order_status > 1 and status != 7";
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and m.add_time >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and m.add_time <= $end ";
		}
		$sql = "SELECT sum(tip_price) as number FROM `order_town` m" . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
    //任务byid
    public function gettaorderById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `taorder` where oid=$id ";
        return $this->db->query($sql)->row_array();
    }
    //等级byid
    public function getgradeById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `grade` where gid=$id ";
        return $this->db->query($sql)->row_array();
    }
    //会员byid
    public function getmemberById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `user` where id=$id ";
        return $this->db->query($sql)->row_array();
    }
    //审核通过金额扣除
    public function member_save_edit($mid,$newwallet)
    {
        $mid = $this->db->escape($mid);
        $newwallet = $this->db->escape($newwallet);
        $sql = "UPDATE `user` SET money=$newwallet WHERE id = $mid";
        return $this->db->query($sql);
    }
    //佣金驳回金额返还
    public function member_save_edit_new($mid, $newwalletcommission)
    {
        $mid = $this->db->escape($mid);
        $newwalletcommission = $this->db->escape($newwalletcommission);

        $sql = "UPDATE `member` SET walletcommission=$newwalletcommission WHERE mid = $mid";
        return $this->db->query($sql);
    }
    //任务通过效益结算
    public function member_save_edit1($mid, $newwallet,$newintegral,$newwalletcommission)
    {
        $mid = $this->db->escape($mid);
        $newwallet = $this->db->escape($newwallet);
        $newintegral = $this->db->escape($newintegral);
        $newwalletcommission = $this->db->escape($newwalletcommission);
        $sql = "UPDATE `member` SET wallet=$newwallet,walletcommission=$newwalletcommission,integral=$newintegral WHERE mid = $mid";
        return $this->db->query($sql);
    }
    //任务通过代理效益结算
    public function member_save_edit2($mid,$walletcommissionnew)
    {
        $mid = $this->db->escape($mid);
        $walletcommissionnew = $this->db->escape($walletcommissionnew);
        $sql = "UPDATE `member` SET walletcommission=$walletcommissionnew WHERE mid = $mid";
        return $this->db->query($sql);
    }
    //任务通过等级修改
    public function member_save_edit_gid($mid, $gid)
    {
        $mid = $this->db->escape($mid);
        $gid = $this->db->escape($gid);

        $sql = "UPDATE `member` SET gid=$gid WHERE mid = $mid";
        return $this->db->query($sql);
    }
    //任务通过满足提现
    public function member_save_state($mid)
    {
        $mid = $this->db->escape($mid);

        $sql = "UPDATE `member` SET state=1 WHERE mid = $mid";
        return $this->db->query($sql);
    }
    //任务完成count
    public function gettaordercunt($mid)
    {
        $sqlw = " where mid=$mid and ostate=3 ";

        $sql = "SELECT count(1) as number FROM `taorder`" . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return $number;
    }
    //查询等级信息列表
    public function getgradeAll()
    {
        $sql = "SELECT * FROM `grade` order by completion";
        return $this->db->query($sql)->result_array();
    }
    //任务count
    public function gettaskAllPage($starttime,$end)
    {
        $sqlw = " where 1=1 and m.ostate > 1 and m.ostate < 5";
        if (!empty($starttime) && !empty($end)) {
            $starttime = strtotime($starttime);
            $end = strtotime($end)+86400;
            $sqlw .= " and m.eadd_time >= $starttime and m.eadd_time <= $end ";
        } elseif (!empty($starttime) && empty($end)) {
            $starttime = strtotime($starttime);
            $sqlw .= " and m.eadd_time >= $starttime ";
        } elseif (empty($starttime) && !empty($end)) {
            $end = strtotime($end)+86400;
            $sqlw .= " and m.eadd_time <= $end ";
        }
        $sql = "SELECT count(1) as number FROM `taorder` m  LEFT JOIN `member` me ON me.mid = m.mid " . $sqlw . " order by m.oid DESC";

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //任务list
    public function gettaskAll($pg,$starttime,$end)
    {
        $sqlw = " where 1=1 and m.ostate > 1 and m.ostate < 5";
        if (!empty($starttime) && !empty($end)) {
            $starttime = strtotime($starttime);
            $end = strtotime($end)+86400;
            $sqlw .= " and m.eadd_time >= $starttime and m.eadd_time <= $end ";
        } elseif (!empty($starttime) && empty($end)) {
            $starttime = strtotime($starttime);
            $sqlw .= " and m.eadd_time >= $starttime ";
        } elseif (empty($starttime) && !empty($end)) {
            $end = strtotime($end)+86400;
            $sqlw .= " and m.eadd_time <= $end ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;

        $sql = "SELECT m.*,me.nickname FROM `taorder` m  LEFT JOIN `member` me ON me.mid = m.mid " . $sqlw . " order by m.oid desc LIMIT $start, $stop";

        return $this->db->query($sql)->result_array();
    }
    //任务byid
    public function gettaskById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `taorder` where oid=$id ";
        return $this->db->query($sql)->row_array();
    }
    //任务byid
    public function gettaskById1($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `ordergoods` where ogid=$id ";
        return $this->db->query($sql)->row_array();
    }
    //截图
    public function getoimgsall($oid)
    {
        $sqlw = " where oid=$oid ";

        $sql = "SELECT * FROM `oimgs` " . $sqlw . " order by oiid desc ";

        return $this->db->query($sql)->result_array();
    }
    //审核任务提交
    public function examine_new_save_task($oid,$ostate,$tareject)
    {
        $oid = $this->db->escape($oid);
        $ostate = $this->db->escape($ostate);
        $tareject = $this->db->escape($tareject);
        $sql = "UPDATE `taorder` SET ostate=$ostate,tareject=$tareject WHERE oid = $oid";
        return $this->db->query($sql);
    }
    //发货提交
    public function examineintegral_new_save_task($ogid,$tareject,$gotime)
    {
        $ogid = $this->db->escape($ogid);
        $tareject = $this->db->escape($tareject);
        $gotime = $this->db->escape($gotime);
        $sql = "UPDATE `ordergoods` SET ostate=2,tareject=$tareject,gotime=$gotime WHERE ogid = $ogid";
        return $this->db->query($sql);
    }
    //发货提交
    public function examineintegral_new_save_task1($ogid,$tareject,$gotime)
    {
        $ogid = $this->db->escape($ogid);
        $tareject = $this->db->escape($tareject);
        $gotime = $this->db->escape($gotime);
        $sql = "UPDATE `ordergoods` SET ostate=3,tareject=$tareject,gotime=$gotime WHERE ogid = $ogid";
        return $this->db->query($sql);
    }
    //积分明细save
    public function integralflow_save($integral,$add_time1,$mid,$ftype,$fremark)
    {
        $integral = $this->db->escape($integral);
        $add_time1 = $this->db->escape($add_time1);
        $mid = $this->db->escape($mid);
        $ftype = $this->db->escape($ftype);
        $fremark = $this->db->escape($fremark);
        $sql = "INSERT INTO `integralflow` (integral,add_time,mid,ftype,fremark) VALUES ($integral,$add_time1,$mid,$ftype,$fremark)";
        return $this->db->query($sql);
    }
    //钱包明细save
    public function withdrawal_save($wprice,$add_time1,$mid,$wtype,$wremark)
    {
        $wprice = $this->db->escape($wprice);
        $add_time1 = $this->db->escape($add_time1);
        $mid = $this->db->escape($mid);
        $wtype = $this->db->escape($wtype);
        $wremark = $this->db->escape($wremark);
        $sql = "INSERT INTO `walletwater` (wprice,add_time,mid,wtype,wremark) VALUES ($wprice,$add_time1,$mid,$wtype,$wremark)";
        return $this->db->query($sql);
    }
    //设置id
    public function getsetById()
    {
        $sql = "SELECT * FROM `setting` where sid=1 ";
        return $this->db->query($sql)->row_array();
    }
    //避免重复点击
    public function gettaorderByIdstate($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `taorder` where oid=$id and ostate>2";
        return $this->db->query($sql)->row_array();
    }

    //避免重复点击
    public function getinorderByIdstate($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `ordergoods` where ogid=$id and ostate=2";
        return $this->db->query($sql)->row_array();
    }
    //避免重复点击
    public function getinorderByIdstate1($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `ordergoods` where ogid=$id and ostate=3";
        return $this->db->query($sql)->row_array();
    }
}
