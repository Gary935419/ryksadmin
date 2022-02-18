<?php


class Task_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }
    
    public function gettidlist()
    {
        $sql = "SELECT * FROM `admin_user` order by id desc ";
        return $this->db->query($sql)->result_array();
    }
	public function gettidlistfuze($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT uid FROM `erp_xiangmufuzeren` where xid = $id ";
		return $this->db->query($sql)->result_array();
	}
	public function gettidlistguige($kuanhao)
	{
		$kuanhao = $this->db->escape($kuanhao);
		$sql = "SELECT * FROM `erp_yuanfuliaoguige` where kuanhao = $kuanhao ";
		return $this->db->query($sql)->result_array();
	}
	public function gettidlistpinming($kuanhao)
	{
		$kuanhao = $this->db->escape($kuanhao);
		$sql = "SELECT * FROM `erp_yuanfuliaopinghengbian` where kuanhao = $kuanhao ";
		return $this->db->query($sql)->result_array();
	}
	public function gettidlistpinming_cai($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_caiduanbaogaoshu` where kid = $id order by sehao";
		return $this->db->query($sql)->result_array();
	}
	public function gettidlistpinming_caij($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_caiduanbaogaoshujue` where kid = $id ";
		return $this->db->query($sql)->result_array();
	}
	public function gettidlistjichu($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_baojiadanfeiyong` where kid = $id ";
		return $this->db->query($sql)->result_array();
	}
	public function gettidlistxiangmu($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_baojiaxiangmu` where kid = $id ";
		return $this->db->query($sql)->result_array();
	}


	public function gettidlistjichujue($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_baojiadanfeiyongjue` where kid = $id ";
		return $this->db->query($sql)->result_array();
	}
	public function gettidlistxiangmujue($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_baojiaxiangmujue` where kid = $id ";
		return $this->db->query($sql)->result_array();
	}


	public function gettidlistkuanhao($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_xiangmukuanhao` where xid = $id ";
		return $this->db->query($sql)->result_array();
	}

  
	public function gettidlistjichu1($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_baojiaxiangmu` where kid = $id ";
		return $this->db->query($sql)->result_array();
	}
	public function gettidlistjichu1jue($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_baojiaxiangmujue` where kid = $id ";
		return $this->db->query($sql)->result_array();
	}
	public function gettidlistfuzeyusuan($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT uid FROM `erp_baojiafuzeren` where bid = $id ";
		return $this->db->query($sql)->result_array();
	}
	public function gettidlistfuzeyusuanjue($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT uid FROM `erp_baojiafuzerenjue` where bid = $id ";
		return $this->db->query($sql)->result_array();
	}
	public function gettidlistfuzeall($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_xiangmufuzeren` where xid = $id ";
		return $this->db->query($sql)->result_array();
	}
	public function getqubieduibiresult($kid,$a,$a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9,$a10,$a11)
	{
		$kid = $this->db->escape($kid);
		$a = $this->db->escape($a);
		$a1 = $this->db->escape($a1);
		$a2 = $this->db->escape($a2);
		$a3 = $this->db->escape($a3);
		$a4 = $this->db->escape($a4);
		$a5 = $this->db->escape($a5);
		$a6 = $this->db->escape($a6);
		$a7 = $this->db->escape($a7);
		$a8 = $this->db->escape($a8);
		$a9 = $this->db->escape($a9);
		$a10 = $this->db->escape($a10);
		$a11 = $this->db->escape($a11);
		$sql = "SELECT * FROM `erp_baojiaxiangmujue` where kid=$kid and xiangmu=$a and mingcheng=$a1 and guige=$a2 and danwei=$a3 and danjia=$a4 and danwei1=$a5 and yongliang=$a6 and danwei2=$a7 and jine=$a8 and danwei3=$a9 and qidingliang=$a10 and beizhu=$a11";
		return $this->db->query($sql)->row_array();
	}
	public function getzigongsilist()
	{
		$sql = "SELECT * FROM `erp_zigongsi` order by id desc ";
		return $this->db->query($sql)->result_array();
	}
	public function getzulist()
	{
		$sql = "SELECT * FROM `erp_zubie` order by id ";
		return $this->db->query($sql)->result_array();
	}
	public function gettidlistpinming_cai_zhuangxiang($id,$msg,$xiangshu)
	{
		$id = $this->db->escape($id);
		$msg = $this->db->escape($msg);
		$xiangshu = $this->db->escape($xiangshu);
		$user_name = $this->db->escape($_SESSION['user_name']);
		$sql = "UPDATE `erp_caiduanbaogaoshu` SET newren=$user_name,zhuangxiangxinxi=$msg,zhuangxiangshuliang=$xiangshu WHERE kid = $id";
		return $this->db->query($sql);
	}

	public function gettidlistjichu1cai($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_caiduanbaogaoshu` where kid = $id order by sehao";
		return $this->db->query($sql)->result_array();
	}
	public function gettidlistjichu1juecai($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_caiduanbaogaoshujue` where kid = $id ";
		return $this->db->query($sql)->result_array();
	}
	public function getqubieduibiresultcai($kid,$a,$a1,$a2,$a3)
	{
		$kid = $this->db->escape($kid);
		$a = $this->db->escape($a);
		$a1 = $this->db->escape($a1);
		$a2 = $this->db->escape($a2);
		$a3 = $this->db->escape($a3);

		$sql = "SELECT * FROM `erp_caiduanbaogaoshujue` where kid=$kid and sehao=$a and pinfan=$a1 and caiduanshu=$a2 and zhishishu=$a3";
		return $this->db->query($sql)->row_array();
	}
	public function gettidlistjihua()
	{
		$sql = "SELECT * FROM `erp_zubie` order by id desc ";
		return $this->db->query($sql)->result_array();
	}
	public function erp_caiduanbaogaoshuzhuang($kid,$sehao,$pinfan,$caiduanshu,$addtime,$shuliang)
	{
		$kid = $this->db->escape($kid);
		$sehao = $this->db->escape($sehao);
		$pinfan = $this->db->escape($pinfan);
		$caiduanshu = $this->db->escape($caiduanshu);
		$addtime = $this->db->escape($addtime);
		$shuliang = $this->db->escape($shuliang);
		$user_name = $this->db->escape($_SESSION['user_name']);
		$sql = "INSERT INTO `erp_caiduanbaogaoshuzhuang` (newren,kid,sehao,pinfan,caiduanshu,addtime,shuliang) VALUES ($user_name,$kid,$sehao,$pinfan,$caiduanshu,$addtime,$shuliang)";
		return $this->db->query($sql);
	}
	public function erp_caiduanbaogaoshuzhuangde($id)
	{
		$id = $this->db->escape($id);
		$sql = "DELETE FROM erp_caiduanbaogaoshuzhuang WHERE kid = $id";
		return $this->db->query($sql);
	}
}
