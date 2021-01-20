<?php


class Notice_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }
    //count
    public function getnoticeAllPage($title)
    {
        $sqlw = " where 1=1 and type=2";
        if (!empty($title)) {
            $sqlw .= " and ( title like '%" . $title . "%' ) ";
        }
        $sql = "SELECT count(1) as number FROM `message` " . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //list
    public function getnoticeAll($pg,$ncontent)
    {
		$sqlw = " where 1=1 and type=2";
		if (!empty($title)) {
			$sqlw .= " and ( title like '%" . $title . "%' ) ";
		}
        $start = ($pg - 1) * 10;
        $stop = 10;

        $sql = "SELECT * FROM `message` " . $sqlw . " order by add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
	//count
	public function getnoticeAllPage1($title)
	{
		$sqlw = " where 1=1 and type=1";
		if (!empty($title)) {
			$sqlw .= " and ( title like '%" . $title . "%' ) ";
		}
		$sql = "SELECT count(1) as number FROM `message` " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	//list
	public function getnoticeAll1($pg,$ncontent)
	{
		$sqlw = " where 1=1 and type=1";
		if (!empty($title)) {
			$sqlw .= " and ( title like '%" . $title . "%' ) ";
		}
		$start = ($pg - 1) * 10;
		$stop = 10;

		$sql = "SELECT * FROM `message` " . $sqlw . " order by add_time desc LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}
    //save
    public function notice_save($title,$content,$type,$add_time)
    {
		$title = $this->db->escape($title);
		$content = $this->db->escape($content);
		$type = $this->db->escape($type);
        $add_time = $this->db->escape($add_time);

        $sql = "INSERT INTO `message` (title,content,type,add_time) VALUES ($title,$content,$type,$add_time)";
        return $this->db->query($sql);
    }
    //公告delete
    public function notice_delete($id)
    {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM message WHERE id = $id";
        return $this->db->query($sql);
    }
    //byid
    public function getnoticeById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `message` where id=$id ";
        return $this->db->query($sql)->row_array();
    }
    //公告byname
    public function getnoticeByname($ncontent)
    {
        $ncontent = $this->db->escape($ncontent);
        $sql = "SELECT * FROM `notice` where ncontent=$ncontent ";
        return $this->db->query($sql)->row_array();
    }
    //公告byname id
    public function getnoticeById2($ncontent, $nid)
    {
        $ncontent = $this->db->escape($ncontent);
        $nid = $this->db->escape($nid);
        $sql = "SELECT * FROM `notice` where ncontent=$ncontent and nid != $nid";
        return $this->db->query($sql)->row_array();
    }
    //公告save_edit
    public function notice_save_edit($nid, $ncontent)
    {
        $nid = $this->db->escape($nid);
        $ncontent = $this->db->escape($ncontent);
        $sql = "UPDATE `notice` SET ncontent=$ncontent WHERE nid = $nid";
        return $this->db->query($sql);
    }
}
