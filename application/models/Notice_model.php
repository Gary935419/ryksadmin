<?php


class Notice_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }
    //公告count
    public function getnoticeAllPage($ncontent)
    {
        $sqlw = " where 1=1 ";
        if (!empty($ncontent)) {
            $sqlw .= " and ( ncontent like '%" . $ncontent . "%' ) ";
        }
        $sql = "SELECT count(1) as number FROM `notice` " . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //公告list
    public function getnoticeAll($pg,$ncontent)
    {
        $sqlw = " where 1=1 ";
        if (!empty($ncontent)) {
            $sqlw .= " and ( ncontent like '%" . $ncontent . "%' ) ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;

        $sql = "SELECT * FROM `notice` " . $sqlw . " order by add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //公告save
    public function notice_save($ncontent,$add_time)
    {
        $ncontent = $this->db->escape($ncontent);
        $add_time = $this->db->escape($add_time);

        $sql = "INSERT INTO `notice` (ncontent,add_time) VALUES ($ncontent,$add_time)";
        return $this->db->query($sql);
    }
    //公告delete
    public function notice_delete($id)
    {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM notice WHERE nid = $id";
        return $this->db->query($sql);
    }
    //公告byid
    public function getnoticeById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `notice` where nid=$id ";
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