<?php


class Taskclass_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }
    //类型count
    public function gettaskclassAllPage($tname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($tname)) {
            $sqlw .= " and ( tname like '%" . $tname . "%' ) ";
        }
        $sql = "SELECT count(1) as number FROM `taskclass` " . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //类型list
    public function gettaskclassAllNew($pg,$tname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($tname)) {
            $sqlw .= " and ( tname like '%" . $tname . "%' ) ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;

        $sql = "SELECT * FROM `taskclass` " . $sqlw . " order by add_time desc LIMIT $start, $stop";
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
    //类型delete
    public function taskclass_delete($id)
    {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM taskclass WHERE tid = $id";
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