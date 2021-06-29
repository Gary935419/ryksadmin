<?php


class Order_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }
	//专车送 count
	public function getOrder1Count()
	{
		$sqlw = " where order_status > 1 and order_type = 1 ";
		$sql = "SELECT count(1) as number FROM `order_traffic` " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
	//顺风送 count
	public function getOrder2Count()
	{
		$sqlw = " where order_status > 1 and order_type = 2 ";
		$sql = "SELECT count(1) as number FROM `order_traffic` " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
	//代买 count
	public function getOrder3Count()
	{
		$sqlw = " where order_status > 1 and order_type = 3 ";
		$sql = "SELECT count(1) as number FROM `order_traffic` " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
	//代驾 count
	public function getOrder4Count()
	{
		$sqlw = " where order_status > 1 ";
		$sql = "SELECT count(1) as number FROM `order_town` " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
	//跑腿 未支付 count
	public function getOrder5Count()
	{
		$sqlw = " where order_status = 1 ";
		$sql = "SELECT count(1) as number FROM `order_traffic` " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
	//代驾 未支付 count
	public function getOrder6Count()
	{
		$sqlw = " where order_status = 1 ";
		$sql = "SELECT count(1) as number FROM `order_town` " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
	public function getdriverById($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `user` where id=$id ";
		return $this->db->query($sql)->row_array();
	}
    //count
    public function gettaskorderAllPage($starttime,$end,$account=array())
    {
        $sqlw = " where 1=1 and m.order_status != 1";
		if (!empty($account)) {
			$account = $this->db->escape($account);
			$sqlw .= " and (m.number = " . $account . " or me.name  = " . $account . " or me.account  = " . $account . ")";
		}
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

        $sql = "SELECT count(1) as number FROM `order_town` m  LEFT JOIN `user` me ON me.id = m.user_id " . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //list
    public function gettaskorderAll($pg,$starttime,$end,$account=array())
    {

		$sqlw = " where 1=1 and m.order_status != 1";
		if (!empty($account)) {
			$account = $this->db->escape($account);
			$sqlw .= " and (m.number = " . $account . " or me.name  = " . $account . " or me.account  = " . $account . ")";
		}
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
        $sql = "SELECT m.*,me.name,me.account FROM `order_town` m  LEFT JOIN `user` me ON me.id = m.user_id " . $sqlw . " order by m.add_time desc LIMIT $start, $stop";

        return $this->db->query($sql)->result_array();
    }
	public function gettaskorderAllcsv2($starttime,$end)
	{
		$sqlw = " where 1=1 and order_status != 1";
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
		$sql = "SELECT m.*,me.name,me.account FROM `order_town` m  LEFT JOIN `user` me ON me.id = m.user_id " . $sqlw . " order by m.add_time desc ";
		return $this->db->query($sql)->result_array();
	}
	public function gettaskorderAllcsv1($starttime,$end)
	{
		$sqlw = " where 1=1 and order_status != 1";
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
		$sql = "SELECT m.*,me.name,me.account FROM `order_traffic` m  LEFT JOIN `user` me ON me.id = m.user_id " . $sqlw . " order by m.add_time desc ";
		return $this->db->query($sql)->result_array();
	}
	public function gettaskorderAllcsv3($starttime,$end)
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

		$sql = "SELECT m.*,me.account,me.name FROM `user_withdrawal` m  LEFT JOIN `user` me ON me.id = m.user_id " . $sqlw . " order by m.add_time desc";
		return $this->db->query($sql)->result_array();
	}
	public function gettaskorderAllcsv4($starttime,$end)
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

		$sql = "SELECT m.*,me.account FROM `postal` m  LEFT JOIN `user` me ON me.id = m.driver_id " . $sqlw . " order by m.add_time desc ";
		return $this->db->query($sql)->result_array();
	}
    //认证byid
	public function getorderById($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `order_town` where id=$id ";
		return $this->db->query($sql)->row_array();
	}
    //count
	public function gettaskorderAllPage1($starttime,$end,$order_type,$account=array())
	{
		if (empty($order_type)){
			$sqlw = " where 1=1 and m.order_status != 1 and m.status != 7 ";
		}else{
			$sqlw = " where 1=1 and m.order_status != 1 and m.order_type = " . $order_type;
		}
		if (!empty($account)) {
			$account = $this->db->escape($account);
			$sqlw .= " and (m.number = " . $account . " or me.name  = " . $account . " or me.account  = " . $account . ")";
		}
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

		$sql = "SELECT count(1) as number FROM `order_traffic` m  LEFT JOIN `user` me ON me.id = m.user_id " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	//list
	public function gettaskorderAll1($pg,$starttime,$end,$order_type,$account=array())
	{
		if (empty($order_type)){
			$sqlw = " where 1=1 and m.order_status != 1 and m.status != 7 ";
		}else{
			$sqlw = " where 1=1 and m.order_status != 1 and m.order_type = " . $order_type;
		}
		if (!empty($account)) {
			$account = $this->db->escape($account);
			$sqlw .= " and (m.number = " . $account . " or me.name  = " . $account . " or me.account  = " . $account . ")";
		}
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
		$sql = "SELECT m.*,me.name,me.account FROM `order_traffic` m  LEFT JOIN `user` me ON me.id = m.user_id " . $sqlw . " order by m.add_time desc LIMIT $start, $stop";

		return $this->db->query($sql)->result_array();
	}
	//count
	public function gettaskorderupAllPage1($starttime,$end,$account=array())
	{
		$sqlw = " where 1=1 and m.status = 1 ";
		if (!empty($account)) {
			$account = $this->db->escape($account);
			$sqlw .= " and (m.paynumber = " . $account . " or me.account  = " . $account . ")";
		}
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and m.addtime >= $starttime and m.addtime <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and m.addtime >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and m.addtime <= $end ";
		}

		$sql = "SELECT count(1) as number FROM `topup` m  LEFT JOIN `user` me ON me.id = m.uid " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	//list
	public function gettaskorderupAll1($pg,$starttime,$end,$account=array())
	{
		$sqlw = " where 1=1 and m.status = 1 ";
		if (!empty($account)) {
			$account = $this->db->escape($account);
			$sqlw .= " and (m.paynumber = " . $account . " or me.account  = " . $account . ")";
		}
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and m.addtime >= $starttime and m.addtime <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and m.addtime >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and m.addtime <= $end ";
		}

		$start = ($pg - 1) * 10;
		$stop = 10;
		$sql = "SELECT m.*,me.name,me.account FROM `topup` m  LEFT JOIN `user` me ON me.id = m.uid " . $sqlw . " order by m.addtime desc LIMIT $start, $stop";

		return $this->db->query($sql)->result_array();
	}

	//count
	public function gettaskorderupAllPage123($starttime,$end,$account=array())
	{
		$sqlw = " where 1=1 ";
		if (!empty($account)) {
			$account = $this->db->escape($account);
			$sqlw .= " and (m.tabChangePnameValue = " . $account . " or m.tabChangePtelValue  = " . $account . ")";
		}
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

		$sql = "SELECT count(1) as number FROM `order_invoice` m  LEFT JOIN `user` me ON me.id = m.user_id " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	//list
	public function gettaskorderupAll123($pg,$starttime,$end,$account=array())
	{
		$sqlw = " where 1=1 ";
		if (!empty($account)) {
			$account = $this->db->escape($account);
			$sqlw .= " and (m.tabChangePnameValue = " . $account . " or m.tabChangePtelValue  = " . $account . ")";
		}
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
		$sql = "SELECT m.*,me.name,me.account FROM `order_invoice` m  LEFT JOIN `user` me ON me.id = m.user_id " . $sqlw . " order by m.add_time desc LIMIT $start, $stop";

		return $this->db->query($sql)->result_array();
	}


	//count
	public function gettaskorderAllPage2($starttime,$end)
	{
		$sqlw = " where 1=1 and order_status != 1 and status != 7 ";
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
		$sql = "SELECT count(1) as number FROM `order_town` m  LEFT JOIN `user` me ON me.id = m.user_id " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	//list
	public function gettaskorderAll2($pg,$starttime,$end)
	{
		$sqlw = " where 1=1 and order_status != 1 and status != 7 ";
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
		$sql = "SELECT m.*,me.name,me.account FROM `order_town` m  LEFT JOIN `user` me ON me.id = m.user_id " . $sqlw . " order by m.add_time desc LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}

	public function getorderById1($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `order_traffic` where id=$id ";
		return $this->db->query($sql)->row_array();
	}
	public function getorderById2($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `order_extend` where order_id=$id ";
		return $this->db->query($sql)->row_array();
	}









    //积分兑换count
    public function getintegralorderAllPage($starttime,$end)
    {
        $sqlw = " where 1=1 ";
        if (!empty($starttime) && !empty($end)) {
            $starttime = strtotime($starttime);
            $end = strtotime($end)+86400;
            $sqlw .= " and m.addtime >= $starttime and m.addtime <= $end ";
        } elseif (!empty($starttime) && empty($end)) {
            $starttime = strtotime($starttime);
            $sqlw .= " and m.addtime >= $starttime ";
        } elseif (empty($starttime) && !empty($end)) {
            $end = strtotime($end)+86400;
            $sqlw .= " and m.addtime <= $end ";
        }
        $sql = "SELECT count(1) as number FROM `ordergoods` m  LEFT JOIN `member` me ON me.mid = m.mid " . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //积分兑换list
    public function getintegralorderAll($pg,$starttime,$end)
    {
        $sqlw = " where 1=1 ";
        if (!empty($starttime) && !empty($end)) {
            $starttime = strtotime($starttime);
            $end = strtotime($end)+86400;
            $sqlw .= " and m.addtime >= $starttime and m.addtime <= $end ";
        } elseif (!empty($starttime) && empty($end)) {
            $starttime = strtotime($starttime);
            $sqlw .= " and m.addtime >= $starttime ";
        } elseif (empty($starttime) && !empty($end)) {
            $end = strtotime($end)+86400;
            $sqlw .= " and m.addtime <= $end ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;

        $sql = "SELECT m.*,me.nickname,me.address FROM `ordergoods` m  LEFT JOIN `member` me ON me.mid = m.mid " . $sqlw . " order by m.addtime desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
}
