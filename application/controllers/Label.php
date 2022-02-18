<?php

/**
 * **********************************************************************
 * サブシステム名  ： ERP
 * 機能名         ：子公司
 * 作成者        ： Gary
 * **********************************************************************
 */
class Label extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        $this->load->model('Label_model', 'label');
		$this->load->model('Task_model', 'task');
        header("Content-type:text/html;charset=utf-8");
    }
    public function label_list()
    {
        $lname = isset($_GET['lname']) ? $_GET['lname'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allpage = $this->label->getlabelAllPage($lname);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->label->getlabelAll($page, $lname);
        $data["list"] = $list;
        $data["lname"] = $lname;
        $this->display("label/label_list", $data);
    }
    public function label_add()
    {
        $this->display("label/label_add");
    }
    public function label_save()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
            return;
        }

        $lname = isset($_POST["lname"]) ? $_POST["lname"] : '';
		$lpname = isset($_POST["lpname"]) ? $_POST["lpname"] : '';
		$ltel = isset($_POST["ltel"]) ? $_POST["ltel"] : '';
        $add_time = time();

        $label_info = $this->label->getlabelByname($lname);
        if (!empty($label_info)) {
            echo json_encode(array('error' => true, 'msg' => "该公司名称已经存在。"));
            return;
        }
        $result = $this->label->label_save($lname,$lpname,$ltel,$add_time);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
        }
    }
    public function label_delete()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        if ($this->label->label_delete($id)) {
            echo json_encode(array('success' => true, 'msg' => "删除成功"));
        } else {
            echo json_encode(array('success' => false, 'msg' => "删除失败"));
        }
    }
    public function label_edit()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $label_info = $this->label->getlabelById($id);
        if (empty($label_info)) {
            echo json_encode(array('error' => true, 'msg' => "数据错误"));
            return;
        }
        $data = array();
        $data['lname'] = $label_info['lname'];
		$data['lpname'] = $label_info['lpname'];
		$data['ltel'] = $label_info['ltel'];
        $data['id'] = $id;
        $this->display("label/label_edit", $data);
    }
    public function label_save_edit()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
		$lname = isset($_POST["lname"]) ? $_POST["lname"] : '';
		$lpname = isset($_POST["lpname"]) ? $_POST["lpname"] : '';
		$ltel = isset($_POST["ltel"]) ? $_POST["ltel"] : '';
        $id = isset($_POST["id"]) ? $_POST["id"] : '';
        $label_info = $this->label->getlabelById2($lname,$id);
        if (!empty($label_info)){
            echo json_encode(array('error' => false, 'msg' => "该标签名称已经存在"));
            return;
        }

        $result = $this->label->label_save_edit($id,$lname,$lpname,$ltel);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
        }
    }
	public function yangpin_add()
	{
		$id = isset($_GET['zid']) ? $_GET['zid'] : '';
		$data["id"] = $id;
		$this->display("label/yangpin_add", $data);
	}
	public function yangpin_list()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$start = isset($_GET['start']) ? $_GET['start'] : '';
		$end = isset($_GET['end']) ? $_GET['end'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$kuanhao = isset($_GET["kuanhao"]) ? $_GET["kuanhao"] : '';
		$allpage = $this->label->getlabelAllPageyangpin($kuanhao,$start,$end,$id);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page,$allpage, $_GET);
		$data["page"] = $page;
		$data["id"] = $id;
		$data["start"] = $start;
		$data["end"] = $end;
		$data["allpage"] = $allpage;
		$list = $this->label->getlabelAllyangpin($page,$kuanhao,$start,$end,$id);
		$data["list"] = $list;
		$data["kuanhao"] = $kuanhao;
		$this->display("label/yangpin_list", $data);
	}
	public function yangpin_delete()
	{
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		if ($this->label->yangpin_delete($id)) {
			echo json_encode(array('success' => true, 'msg' => "删除成功"));
		} else {
			echo json_encode(array('success' => false, 'msg' => "删除失败"));
		}
	}
	public function yangpin_edit()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$label_info = $this->label->getlabelByIdyang($id);
		if (empty($label_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$data = array();
		$data['kuhumingcheng'] = $label_info['kuhumingcheng'];
		$data['dandangzhe'] = $label_info['dandangzhe'];
		$data['kuanhao'] = $label_info['kuanhao'];
		$data['kuanshi'] = $label_info['kuanshi'];
		$data['yangpinxingzhi'] = $label_info['yangpinxingzhi'];
		$data['shuliang'] = $label_info['shuliang'];
		$data['yangpindanjia'] = $label_info['yangpindanjia'];
		$data['shoudaoriqi'] = $label_info['shoudaoriqi'];
		$data['fachuriqi'] = $label_info['fachuriqi'];
		$data['zhizuozhe'] = $label_info['zhizuozhe'];
		$data['id'] = $id;
		$this->display("label/yangpin_edit", $data);
	}
	public function label_edit_cai()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$ltype = isset($_GET['ltype']) ? $_GET['ltype'] : 1;
		$data['id'] = $id;
		$data['ltype'] = $ltype;
		$gettidlistpinming_caiinfo = $this->task->gettidlistpinming_cai($id);
		$data['infomation'] = str_replace("<br>","\n",$gettidlistpinming_caiinfo[0]['zhuangxiangxinxi']);
		$this->display("label/label_edit_cai", $data);
	}
	public function label_save_edit_cai()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$sumnumber = isset($_POST["sumnumber"]) ? $_POST["sumnumber"] : '';
		$id = isset($_POST["id"]) ? $_POST["id"] : '';
		$gettidlistpinming_caiinfo = $this->task->gettidlistpinming_cai($id);
		$caiduanzong = 0;
		$str = "";
		$sehaoarr = array();
		$newkey = 0;
		$this->task->erp_caiduanbaogaoshuzhuangde($id);
		foreach ($gettidlistpinming_caiinfo as $k=>$v){
			$caiduanzongnow = 0;
			$caiduanzongnow = $caiduanzongnow + $v['caiduanshu'];
			if ($caiduanzongnow > $sumnumber){
				$a = floor($caiduanzongnow/$sumnumber);
				$b = $caiduanzongnow % $sumnumber;
				$str = $str.$v['sehao'].$v['pinfan']."自身装".$a."箱,每箱裁断数量为:".$sumnumber."个!<br>";
				for ($i=1; $i<=$a; $i++)
				{
					$this->task->erp_caiduanbaogaoshuzhuang($id,$v['sehao'],$v['pinfan'],$sumnumber,time(),$sumnumber);
				}
				if (!empty($b)){
					$newkey = $newkey + 1;
					$sehaoarr[$newkey]['sehao'] = $v['sehao'];
					$sehaoarr[$newkey]['pinfan'] = $v['pinfan'];
					$sehaoarr[$newkey]['shuliang'] = $b;
				}
			}elseif ($caiduanzongnow == $sumnumber){
				$a = floor($caiduanzongnow/$sumnumber);
				$str = $str.$v['sehao'].$v['pinfan']."自身装".$a."箱,每箱裁断数量为:".$sumnumber."个!<br>";
				for ($i=1; $i<=$a; $i++)
				{
					$this->task->erp_caiduanbaogaoshuzhuang($id,$v['sehao'],$v['pinfan'],$sumnumber,time(),$sumnumber);
				}
			}else {
				if (!empty($caiduanzongnow)){
					$newkey = $newkey + 1;
					$sehaoarr[$newkey]['sehao'] = $v['sehao'];
					$sehaoarr[$newkey]['pinfan'] = $v['pinfan'];
					$sehaoarr[$newkey]['shuliang'] = $caiduanzongnow;
				}
			}
			$caiduanzong = floatval($caiduanzong) + $v['caiduanshu'];
		}

		$shuliang = 0;
		foreach ($sehaoarr as $kk=>$vv){
			if (empty($vv['shuliang'])){
				break;
			}
			$shuliang = $shuliang + $vv['shuliang'];
			if ($shuliang > $sumnumber){
				$aaa = $shuliang - $vv['shuliang'];
				$bbb = $sumnumber - $aaa;
				$shuliang = $shuliang - $sumnumber;
				if ($shuliang > $sumnumber){
					$str = $str.$vv['sehao'].$vv['pinfan']."裁断数量为:".$bbb."个组成1箱,剩余裁断数量:".$shuliang."个!与";
					$this->task->erp_caiduanbaogaoshuzhuang($id,$vv['sehao'],$vv['pinfan'],$bbb,time(),$sumnumber);
					$this->task->erp_caiduanbaogaoshuzhuang($id,$vv['sehao'],$vv['pinfan'],$shuliang,time(),$sumnumber);
				}else{
					if (empty($sehaoarr[$kk+1]['shuliang'])){
						$str = $str.$vv['sehao'].$vv['pinfan']."裁断数量为:".$bbb."个组成1箱,剩余裁断数量:".$shuliang."个组成1箱。";
						$this->task->erp_caiduanbaogaoshuzhuang($id,$vv['sehao'],$vv['pinfan'],$bbb,time(),$sumnumber);
						$this->task->erp_caiduanbaogaoshuzhuang($id,$vv['sehao'],$vv['pinfan'],$shuliang,time(),$sumnumber);
					}else{
						$str = $str.$vv['sehao'].$vv['pinfan']."裁断数量为:".$bbb."个组成1箱,剩余裁断数量:".$shuliang."个!与";
						$this->task->erp_caiduanbaogaoshuzhuang($id,$vv['sehao'],$vv['pinfan'],$bbb,time(),$sumnumber);
						$this->task->erp_caiduanbaogaoshuzhuang($id,$vv['sehao'],$vv['pinfan'],$shuliang,time(),$sumnumber);
					}
				}
			}elseif ($shuliang < $sumnumber){
				if (empty($sehaoarr[$kk+1]['shuliang'])){
					$str = $str.$vv['sehao'].$vv['pinfan']."剩余裁断数量:".$vv['shuliang']."个组成1箱。<br>";
					$this->task->erp_caiduanbaogaoshuzhuang($id,$vv['sehao'],$vv['pinfan'],$vv['shuliang'],time(),$sumnumber);
				}else{
					$str = $str.$vv['sehao'].$vv['pinfan']."裁断数量为:".$vv['shuliang']."个!与";
					$this->task->erp_caiduanbaogaoshuzhuang($id,$vv['sehao'],$vv['pinfan'],$vv['shuliang'],time(),$sumnumber);
				}
			}else{
				$str = $str.$vv['sehao'].$vv['pinfan']."裁断数量:". $vv['shuliang']."个组成1箱。<br>";
				$this->task->erp_caiduanbaogaoshuzhuang($id,$vv['sehao'],$vv['pinfan'],$vv['shuliang'],time(),$sumnumber);
				$shuliang = $shuliang - $sumnumber;
			}
		}
		$xiangshu = ceil(floatval($caiduanzong)/$sumnumber);
		$msg = "装箱成功!总共装箱:".$xiangshu."箱!<br>".$str;
		$this->task->gettidlistpinming_cai_zhuangxiang($id,$msg,$xiangshu);
		echo json_encode(array('success' => true, 'msg' => $msg));
	}

	public function group_list()
	{
		$lname = isset($_GET['lname']) ? $_GET['lname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->label->getlabelAllPageg($lname);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->label->getlabelAllg($page, $lname);
		$data["list"] = $list;
		$data["lname"] = $lname;
		$this->display("label/group_list", $data);
	}
	public function group_add()
	{
		$this->display("label/group_add");
	}
	public function group_save()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}

		$lname = isset($_POST["lname"]) ? $_POST["lname"] : '';
		$lpname = isset($_POST["lpname"]) ? $_POST["lpname"] : '';
		$ltel = isset($_POST["ltel"]) ? $_POST["ltel"] : '';
		$add_time = time();

		$label_info = $this->label->getlabelBynameg($lname);
		if (!empty($label_info)) {
			echo json_encode(array('error' => true, 'msg' => "该组名称已经存在。"));
			return;
		}
		$result = $this->label->label_saveg($lname,$lpname,$ltel,$add_time);
		if ($result) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
		}
	}
	public function group_delete()
	{
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		if ($this->label->label_deleteg($id)) {
			echo json_encode(array('success' => true, 'msg' => "删除成功"));
		} else {
			echo json_encode(array('success' => false, 'msg' => "删除失败"));
		}
	}
	public function group_edit()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$label_info = $this->label->getlabelByIdg($id);
		if (empty($label_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$data = array();
		$data['lname'] = $label_info['lname'];
		$data['lpname'] = $label_info['lpname'];
		$data['ltel'] = $label_info['ltel'];
		$data['id'] = $id;
		$this->display("label/group_edit", $data);
	}
	public function group_save_edit()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$lname = isset($_POST["lname"]) ? $_POST["lname"] : '';
		$lpname = isset($_POST["lpname"]) ? $_POST["lpname"] : '';
		$ltel = isset($_POST["ltel"]) ? $_POST["ltel"] : '';
		$id = isset($_POST["id"]) ? $_POST["id"] : '';
		$label_info = $this->label->getlabelById2g($lname,$id);
		if (!empty($label_info)){
			echo json_encode(array('error' => false, 'msg' => "该组名称已经存在"));
			return;
		}

		$result = $this->label->label_save_editg($id,$lname,$lpname,$ltel);
		if ($result) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
		}
	}
}
