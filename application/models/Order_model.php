<?php


class Order_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }

	public function getOrder1Count()
	{
		$sqlw = " where 1=1 ";
		$sql = "SELECT count(1) as number FROM `erp_xiangmuhetong` " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}

	public function getOrder2Count()
	{
		$sqlw = " where 1=1 and htype!=1";
		$sql = "SELECT count(1) as number FROM `erp_shengcanjihua` " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}

	public function getOrder3Count()
	{
		$sqlw = " where 1=1 ";
		$sql = "SELECT count(1) as number FROM `erp_zigongsi` " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}

	public function getOrder4Count()
	{
		$sqlw = " where 1=1 ";
		$sql = "SELECT count(1) as number FROM `admin_user` " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}

	public function getOrder5Count()
	{
		$sqlw = " where 1=1 ";
		$sql = "SELECT count(1) as number FROM `erp_yangmingmingxi` " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}

	public function getOrder6Count()
	{
		$sqlw = " where 1=1 ";
		$sql = "SELECT count(1) as number FROM `erp_zubie` " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
	public function getOrder11Count()
	{
		$sqlw = " where 1=1 ";
		$sql = "SELECT * FROM `erp_baojiaxiangmu` " . $sqlw . " group by kid";
		return $this->db->query($sql)->result_array();
	}
	public function getOrder22Count()
	{
		$sqlw = " where 1=1 ";
		$sql = "SELECT * FROM `erp_baojiaxiangmujue` " . $sqlw . " group by kid";
		return $this->db->query($sql)->result_array();
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
	public function getmemberinfoAllcsv1($user_name)
	{
		$sqlw = " where 1=1 ";
		if (!empty($user_name)) {
			$sqlw .= " and ( u.username like '%" . $user_name . "%' ) ";
		}
		$sql = "SELECT u.*,r.rname as rname FROM `admin_user` u left join `role` r on u.rid=r.rid " . $sqlw . " order by u.id desc";
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
