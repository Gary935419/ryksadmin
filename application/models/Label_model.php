<?php


class Label_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }

    public function getlabelAllPage($lname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($lname)) {
            $sqlw .= " and ( lname like '%" . $lname . "%' ) ";
        }
        $sql = "SELECT count(1) as number FROM `erp_zigongsi` " . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }

    public function getlabelAll($pg,$lname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($lname)) {
            $sqlw .= " and ( lname like '%" . $lname . "%' ) ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;

        $sql = "SELECT * FROM `erp_zigongsi` " . $sqlw . " order by addtime desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }

    public function label_save($lname,$lpname,$ltel,$addtime)
    {
        $lname = $this->db->escape($lname);
		$lpname = $this->db->escape($lpname);
		$ltel = $this->db->escape($ltel);
		$addtime = $this->db->escape($addtime);
		$user_name = $this->db->escape($_SESSION['user_name']);
        $sql = "INSERT INTO `erp_zigongsi` (newren,lname,lpname,ltel,addtime) VALUES ($user_name,$lname,$lpname,$ltel,$addtime)";
        return $this->db->query($sql);
    }

    public function label_delete($id)
    {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM erp_zigongsi WHERE id = $id";
        return $this->db->query($sql);
    }

    public function getlabelById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `erp_zigongsi` where id=$id ";
        return $this->db->query($sql)->row_array();
    }

    public function getlabelByname($lname)
    {
        $lname = $this->db->escape($lname);
        $sql = "SELECT * FROM `erp_zigongsi` where lname=$lname ";
        return $this->db->query($sql)->row_array();
    }

    public function getlabelById2($lname, $id)
    {
        $lname = $this->db->escape($lname);
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `erp_zigongsi` where lname=$lname and id != $id";
        return $this->db->query($sql)->row_array();
    }

    public function label_save_edit($id,$lname,$lpname,$ltel)
    {
        $id = $this->db->escape($id);
        $lname = $this->db->escape($lname);
		$lpname = $this->db->escape($lpname);
		$ltel = $this->db->escape($ltel);
		$user_name = $this->db->escape($_SESSION['user_name']);
        $sql = "UPDATE `erp_zigongsi` SET newren=$user_name,lname=$lname,lpname=$lpname,ltel=$ltel WHERE id = $id";
        return $this->db->query($sql);
    }

	public function getlabelAllPageyangpin($kuanhao,$starttime,$end,$zid)
	{
		$sqlw = " where 1=1 and zid=$zid ";
		if (!empty($kuanhao)) {
			$sqlw .= " and ( kuanhao like '%" . $kuanhao . "%' ) ";
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
		$sql = "SELECT count(1) as number FROM `erp_yangmingmingxi` " . $sqlw . " order by addtime desc";

		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);

	}

	public function getlabelAllyangpin($pg,$kuanhao,$starttime,$end,$zid)
	{
		$sqlw = " where 1=1 and zid=$zid ";
		if (!empty($kuanhao)) {
			$sqlw .= " and ( kuanhao like '%" . $kuanhao . "%' ) ";
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

		$sql = "SELECT * FROM `erp_yangmingmingxi` " . $sqlw . " order by addtime desc LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}
	public function yangpin_delete($id)
	{
		$id = $this->db->escape($id);
		$sql = "DELETE FROM erp_yangmingmingxi WHERE id = $id";
		return $this->db->query($sql);
	}
	public function getlabelByIdyang($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_yangmingmingxi` where id=$id ";
		return $this->db->query($sql)->row_array();
	}


	public function getlabelAllPageg($lname)
	{
		$sqlw = " where 1=1 ";
		if (!empty($lname)) {
			$sqlw .= " and ( lname like '%" . $lname . "%' ) ";
		}
		$sql = "SELECT count(1) as number FROM `erp_zubie` " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}

	public function getlabelAllg($pg,$lname)
	{
		$sqlw = " where 1=1 ";
		if (!empty($lname)) {
			$sqlw .= " and ( lname like '%" . $lname . "%' ) ";
		}
		$start = ($pg - 1) * 10;
		$stop = 10;

		$sql = "SELECT * FROM `erp_zubie` " . $sqlw . " order by addtime desc LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}

	public function label_saveg($lname,$lpname,$ltel,$addtime)
	{
		$lname = $this->db->escape($lname);
		$lpname = $this->db->escape($lpname);
		$ltel = $this->db->escape($ltel);
		$addtime = $this->db->escape($addtime);
		$user_name = $this->db->escape($_SESSION['user_name']);
		$sql = "INSERT INTO `erp_zubie` (newren,lname,lpname,ltel,addtime) VALUES ($user_name,$lname,$lpname,$ltel,$addtime)";
		return $this->db->query($sql);
	}

	public function label_deleteg($id)
	{
		$id = $this->db->escape($id);
		$sql = "DELETE FROM erp_zubie WHERE id = $id";
		return $this->db->query($sql);
	}

	public function getlabelByIdg($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_zubie` where id=$id ";
		return $this->db->query($sql)->row_array();
	}

	public function getlabelBynameg($lname)
	{
		$lname = $this->db->escape($lname);
		$sql = "SELECT * FROM `erp_zubie` where lname=$lname ";
		return $this->db->query($sql)->row_array();
	}

	public function getlabelById2g($lname, $id)
	{
		$lname = $this->db->escape($lname);
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_zubie` where lname=$lname and id != $id";
		return $this->db->query($sql)->row_array();
	}

	public function label_save_editg($id,$lname,$lpname,$ltel)
	{
		$id = $this->db->escape($id);
		$lname = $this->db->escape($lname);
		$lpname = $this->db->escape($lpname);
		$ltel = $this->db->escape($ltel);
		$user_name = $this->db->escape($_SESSION['user_name']);
		$sql = "UPDATE `erp_zubie` SET newren=$user_name,lname=$lname,lpname=$lpname,ltel=$ltel WHERE id = $id";
		return $this->db->query($sql);
	}
}
