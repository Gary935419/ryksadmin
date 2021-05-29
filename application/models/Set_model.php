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
    public function getsetById1($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `car_price_setting` where sid=$id ";
        return $this->db->query($sql)->row_array();
    }
	public function set_edit_new()
	{
		$sql = "SELECT * FROM `couponset` where id=1 ";
		return $this->db->query($sql)->row_array();
	}
    public function set_save_edit($price1,$price2,$price3)
    {
		$price1 = $this->db->escape($price1);
		$price2 = $this->db->escape($price2);
		$price3 = $this->db->escape($price3);
        $sql = "UPDATE `car_price_setting` SET price1 = $price1 , price2 = $price2 , price6 = $price3 WHERE sid=1";
        return $this->db->query($sql);
    }
	public function set_save_edit_new($price,$days)
	{
		$price = $this->db->escape($price);
		$days = $this->db->escape($days);

		$sql = "UPDATE `couponset` SET price = $price , days = $days WHERE id=1";
		return $this->db->query($sql);
	}
	public function set_save_edit1($price4,$price5,$price6,$price7,$price8,$price9)
	{
		$price4 = $this->db->escape($price4);
		$price5 = $this->db->escape($price5);
		$price6 = $this->db->escape($price6);
		$price7 = $this->db->escape($price7);
		$price8 = $this->db->escape($price8);
		$price9 = $this->db->escape($price9);
		$sql = "UPDATE `car_price_setting` SET price1 = $price4 , price2 = $price5 , price3 = $price6 , price4 = $price7 , price5 = $price8 , price6 = $price9 WHERE sid=2";
		return $this->db->query($sql);
	}
	public function set_save_edit2($price10,$price11,$price12)
	{
		$price10 = $this->db->escape($price10);
		$price11 = $this->db->escape($price11);
		$price12 = $this->db->escape($price12);
		$sql = "UPDATE `car_price_setting` SET price1 = $price10 , price6 = $price11 , price2 = $price12 WHERE sid=3";
		return $this->db->query($sql);
	}
	public function set_save_edit3($price13,$price14,$price15,$price16,$price17,$price18,$price19)
	{
		$price13 = $this->db->escape($price13);
		$price14 = $this->db->escape($price14);
		$price15 = $this->db->escape($price15);
		$price16 = $this->db->escape($price16);
		$price17 = $this->db->escape($price17);
		$price18 = $this->db->escape($price18);
		$price19 = $this->db->escape($price19);
		$sql = "UPDATE `car_price_setting` SET price11 = $price13 , price9 = $price14 , price10 = $price15 , price8 = $price16 , km1 = $price17 , kg1 = $price18 , km2 = $price19 WHERE sid=4";
		return $this->db->query($sql);
	}
	public function set_save_edit4($content1)
	{
		$content1 = $this->db->escape($content1);
		$sql = "UPDATE `car_price_setting` SET content1 = $content1 WHERE sid=1";
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
