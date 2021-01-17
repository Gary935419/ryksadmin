<?php


class Set_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }
    //设置根据id
    public function getsetById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `setting` where sid=$id ";
        return $this->db->query($sql)->row_array();
    }
    //设置set_save_edit
    public function set_save_edit($name,$contentagent,$email,$customercode,$address,$sid,$contentnew)
    {
        $name = $this->db->escape($name);
        $email = $this->db->escape($email);
        $address = $this->db->escape($address);
        $sid = $this->db->escape($sid);
        $customercode = $this->db->escape($customercode);
        $contentnew = $this->db->escape($contentnew);
        $contentagent = $this->db->escape($contentagent);
        $sql = "UPDATE `setting` SET name=$name,contentagent=$contentagent,email=$email,contentnew=$contentnew,customercode=$customercode,address=$address WHERE sid = $sid";
        return $this->db->query($sql);
    }
    //广告count
    public function getadvertisementAllPage($aname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($aname)) {
            $sqlw .= " and ( aname like '%" . $aname . "%' ) ";
        }
        $sql = "SELECT count(1) as number FROM `advertisement` " . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //广告list
    public function getadvertisementAllNew($pg,$aname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($aname)) {
            $sqlw .= " and ( aname like '%" . $aname . "%' ) ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;

        $sql = "SELECT * FROM `advertisement` " . $sqlw . " order by add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //广告save
    public function advertisement_save($aname, $aimg, $add_time)
    {
        $aname = $this->db->escape($aname);
        $aimg = $this->db->escape($aimg);
        $add_time = $this->db->escape($add_time);

        $sql = "INSERT INTO `advertisement` (aname,aimg,add_time) VALUES ($aname,$aimg,$add_time)";
        return $this->db->query($sql);
    }
    //广告delete
    public function advertisement_delete($id)
    {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM advertisement WHERE aid = $id";
        return $this->db->query($sql);
    }
    //广告byid
    public function getadvertisementById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `advertisement` where aid=$id ";
        return $this->db->query($sql)->row_array();
    }
    //广告byname
    public function getadvertisementByname($aname)
    {
        $aname = $this->db->escape($aname);
        $sql = "SELECT * FROM `advertisement` where aname=$aname ";
        return $this->db->query($sql)->row_array();
    }
    //类型byname id
    public function getadvertisementById2($aname, $aid)
    {
        $aname = $this->db->escape($aname);
        $aid = $this->db->escape($aid);
        $sql = "SELECT * FROM `advertisement` where aname=$aname and aid != $aid";
        return $this->db->query($sql)->row_array();
    }
    //广告save_edit
    public function advertisement_save_edit($aid,$aname,$aimg)
    {
        $aid = $this->db->escape($aid);
        $aname = $this->db->escape($aname);
        $aimg = $this->db->escape($aimg);
        $sql = "UPDATE `advertisement` SET aname=$aname,aimg=$aimg WHERE aid = $aid";
        return $this->db->query($sql);
    }
}