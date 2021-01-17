<?php


class Label_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }
    //标签count
    public function getlabelAllPage($lname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($lname)) {
            $sqlw .= " and ( lname like '%" . $lname . "%' ) ";
        }
        $sql = "SELECT count(1) as number FROM `label` " . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //标签list
    public function getlabelAll($pg,$lname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($lname)) {
            $sqlw .= " and ( lname like '%" . $lname . "%' ) ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;

        $sql = "SELECT * FROM `label` " . $sqlw . " order by add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //标签save
    public function label_save($lname,$add_time)
    {
        $lname = $this->db->escape($lname);
        $add_time = $this->db->escape($add_time);

        $sql = "INSERT INTO `label` (lname,add_time) VALUES ($lname,$add_time)";
        return $this->db->query($sql);
    }
    //标签delete
    public function label_delete($id)
    {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM label WHERE lid = $id";
        return $this->db->query($sql);
    }
    //标签byid
    public function getlabelById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `label` where lid=$id ";
        return $this->db->query($sql)->row_array();
    }
    //标签byname
    public function getlabelByname($lname)
    {
        $lname = $this->db->escape($lname);
        $sql = "SELECT * FROM `label` where lname=$lname ";
        return $this->db->query($sql)->row_array();
    }
    //标签byname id
    public function getlabelById2($lname, $lid)
    {
        $lname = $this->db->escape($lname);
        $lid = $this->db->escape($lid);
        $sql = "SELECT * FROM `label` where lname=$lname and lid != $lid";
        return $this->db->query($sql)->row_array();
    }
    //标签save_edit
    public function label_save_edit($lid, $lname)
    {
        $lid = $this->db->escape($lid);
        $lname = $this->db->escape($lname);

        $sql = "UPDATE `label` SET lname=$lname WHERE lid = $lid";
        return $this->db->query($sql);
    }
}