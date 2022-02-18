<?php


class Taskclass_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }

    //类型byid
    public function gettaskclassById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `erp_xiangmufuzeren` u left join `admin_user` uu  on uu.id = u.uid  where u.xid=$id ";
		return $this->db->query($sql)->result_array();
    }
    
}
