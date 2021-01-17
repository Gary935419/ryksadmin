<?php


class City_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }
    //城市count
    public function getcityAllPage($cname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($cname)) {
            $sqlw .= " and ( cname like '%" . $cname . "%' ) ";
        }
        $sql = "SELECT count(1) as number FROM `city` " . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //城市list
    public function getcityAll($pg,$cname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($cname)) {
            $sqlw .= " and ( cname like '%" . $cname . "%' ) ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;

        $sql = "SELECT * FROM `city` " . $sqlw . " order by add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //城市save
    public function city_save($cname,$add_time)
    {
        $cname = $this->db->escape($cname);
        $add_time = $this->db->escape($add_time);

        $sql = "INSERT INTO `city` (cname,add_time) VALUES ($cname,$add_time)";
        return $this->db->query($sql);
    }
    //城市delete
    public function city_delete($id)
    {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM city WHERE cid = $id";
        return $this->db->query($sql);
    }
    //城市byid
    public function getcityById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `city` where cid=$id ";
        return $this->db->query($sql)->row_array();
    }
    //城市byname
    public function getcityByname($cname)
    {
        $cname = $this->db->escape($cname);
        $sql = "SELECT * FROM `city` where cname=$cname ";
        return $this->db->query($sql)->row_array();
    }
    //城市byname id
    public function getcityById2($cname, $cid)
    {
        $cname = $this->db->escape($cname);
        $cid = $this->db->escape($cid);
        $sql = "SELECT * FROM `city` where cname=$cname and cid != $cid";
        return $this->db->query($sql)->row_array();
    }
    //城市save_edit
    public function city_save_edit($cid, $cname)
    {
        $cid = $this->db->escape($cid);
        $cname = $this->db->escape($cname);
        $sql = "UPDATE `city` SET cname=$cname WHERE cid = $cid";
        return $this->db->query($sql);
    }
}