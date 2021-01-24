<?php


class Role_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }
    //查询角色信息列表
    public function getroleAll()
    {
        $sql = "SELECT * FROM `role` order by rid desc";
        return $this->db->query($sql)->result_array();
    }
    //角色count
    public function getroleAllPage()
    {
        $sqlw = " where 1=1 ";
        $sql = "SELECT count(1) as number FROM `role` " . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //角色list
    public function getroleAllNew($pg)
    {
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sqlw = " where 1=1 ";
        $sql = "SELECT * FROM `role` " . $sqlw . " order by add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
	public function getRtomList($rid)
	{
		$sqlw = " where rid = $rid ";
		$sql = "SELECT * FROM `rtom` " . $sqlw;
		return $this->db->query($sql)->result_array();
	}
    //角色save
    public function role_save($rname, $rdetails, $add_time)
    {
        $rname = $this->db->escape($rname);
        $rdetails = $this->db->escape($rdetails);
        $add_time = $this->db->escape($add_time);

        $sql = "INSERT INTO `role` (rname,rdetails,add_time) VALUES ($rname,$rdetails,$add_time)";
		$this->db->query($sql);
		$rid=$this->db->insert_id();
		return $rid;
    }
	public function rtom_save($rid,$mid)
	{
		$sql = "INSERT INTO `rtom` (rid,mid) VALUES ($rid,$mid);";
		return $this->db->query($sql);
	}
    //角色delete
    public function role_delete($id)
    {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM role WHERE rid = $id";
        return $this->db->query($sql);
    }
	public function role_delete_rtom($rid)
	{
		$rid = $this->db->escape($rid);
		$sql = "DELETE FROM rtom WHERE rid = $rid";
		return $this->db->query($sql);
	}
    //角色byid
    public function getroleById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `role` where rid=$id ";
        return $this->db->query($sql)->row_array();
    }
	public function getroleByIdRtom($id,$mid)
	{
		$id = $this->db->escape($id);
		$mid = $this->db->escape($mid);
		$sql = "SELECT * FROM `rtom` where rid=$id and mid=$mid";
		return $this->db->query($sql)->row_array();
	}
    //角色byname
    public function getroleByname($rname)
    {
        $rname = $this->db->escape($rname);
        $sql = "SELECT * FROM `role` where rname=$rname ";
        return $this->db->query($sql)->row_array();
    }
    //角色save_edit
    public function role_save_edit($rid, $rname, $rdetails)
    {
        $rid = $this->db->escape($rid);
        $rname = $this->db->escape($rname);
        $rdetails = $this->db->escape($rdetails);

        $sql = "UPDATE `role` SET rname=$rname,rdetails=$rdetails WHERE rid = $rid";
        return $this->db->query($sql);
    }
}
