<?php


class Taskclass_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }
	//在线count
	public function getdriverCount($type,$update_time)
	{
		if ($type == 1){
			//在线
			$sqlw = " where 1=1 and update_time >= $update_time ";
			$sql = "SELECT count(1) as number FROM `user_working` " . $sqlw;
		}else{
			//离线
			$sqlw = " where 1=1 and type = 2 and user_check = 1 or driving_check = 1 ";
			$sql = "SELECT count(1) as number FROM `user` " . $sqlw;
		}
		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
    //在线list
	public function getdriverList($update_time)
	{
		$sqlw = " where 1=1 and co.update_time >= $update_time ";
		$sql = "SELECT co.longitude,co.latitude,us.name,us.account,us.car_number FROM `user_working` co LEFT JOIN `user` us ON us.id = co.driver_id " . $sqlw ;
		return $this->db->query($sql)->result_array();
	}
    //count
    public function gettaskclassAllPage()
    {
        $sqlw = " where 1=1 ";
        $sql = "SELECT count(1) as number FROM `coupon` co LEFT JOIN `user` us ON us.id = co.user_id " . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //list
    public function gettaskclassAllNew($pg)
    {
        $sqlw = " where 1=1 ";
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT co.*,us.name,us.account FROM `coupon` co LEFT JOIN `user` us ON us.id = co.user_id " . $sqlw . " order by co.add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //delete
	public function taskclass_delete($id)
	{
		$id = $this->db->escape($id);
		$sql = "DELETE FROM coupon WHERE id = $id";
		return $this->db->query($sql);
	}
    //count
	public function gettaskclassAllPage1()
	{
		$sqlw = " where 1=1 ";
		$sql = "SELECT count(1) as number FROM `user_recommended` co LEFT JOIN `user` us ON us.id = co.user_id " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	//list
	public function gettaskclassAllNew1($pg)
	{
		$sqlw = " where 1=1 ";
		$start = ($pg - 1) * 10;
		$stop = 10;
		$sql = "SELECT co.*,us.name,us.account FROM `user_recommended` co LEFT JOIN `user` us ON us.id = co.user_id " . $sqlw . " order by co.add_time desc LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}




    //类型save
    public function taskclass_save($tname, $timg,$tsort, $add_time)
    {
        $tname = $this->db->escape($tname);
        $timg = $this->db->escape($timg);
        $tsort = $this->db->escape($tsort);
        $add_time = $this->db->escape($add_time);

        $sql = "INSERT INTO `taskclass` (tname,timg,tsort,add_time) VALUES ($tname,$timg,$tsort,$add_time)";
        return $this->db->query($sql);
    }

    //类型byid
    public function gettaskclassById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `taskclass` where tid=$id ";
        return $this->db->query($sql)->row_array();
    }
    //类型byname
    public function gettaskclassByname($tname)
    {
        $tname = $this->db->escape($tname);
        $sql = "SELECT * FROM `taskclass` where tname=$tname ";
        return $this->db->query($sql)->row_array();
    }
    //类型byname id
    public function gettaskclassById2($tname, $tid)
    {
        $tname = $this->db->escape($tname);
        $tid = $this->db->escape($tid);
        $sql = "SELECT * FROM `taskclass` where tname=$tname and tid != $tid";
        return $this->db->query($sql)->row_array();
    }
    //类型save_edit
    public function taskclass_save_edit($tid, $tname, $timg, $tsort)
    {
        $tid = $this->db->escape($tid);
        $tname = $this->db->escape($tname);
        $timg = $this->db->escape($timg);
        $tsort = $this->db->escape($tsort);
        $sql = "UPDATE `taskclass` SET tname=$tname,timg=$timg,tsort=$tsort WHERE tid = $tid";
        return $this->db->query($sql);
    }
}
