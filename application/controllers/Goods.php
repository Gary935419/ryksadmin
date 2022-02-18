<?php

/**
 * **********************************************************************
 * サブシステム名  ： Task
 * 機能名         ：商品
 * 作成者        ： Gary
 * **********************************************************************
 */
class Goods extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['user_name'])) {
			header("Location:" . RUN . '/login/logout');
		}
		$this->load->model('Goods_model', 'goods');
		$this->load->model('Role_model', 'role');
		$this->load->model('Task_model', 'task');
		$this->load->model('Set_model', 'set');
		$this->load->model('Taskclass_model', 'taskclass');
		$this->load->library('PHPExcel');
		$this->load->library('IOFactory');
		header("Content-type:text/html;charset=utf-8");
	}
	public function goods_save()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$bianhao = isset($_POST["bianhao"]) ? $_POST["bianhao"] : '';
		$mingcheng = isset($_POST["mingcheng"]) ? $_POST["mingcheng"] : '';
		$qianding = isset($_POST["qianding"]) ? $_POST["qianding"] : '';
		$jiaohuoqi = isset($_POST["jiaohuoqi"]) ? $_POST["jiaohuoqi"] : '';
		$menu = isset($_POST["menu"]) ? $_POST["menu"] : '';
		$kuanhao = isset($_POST["kuanhao"]) ? $_POST["kuanhao"] : '';
		if (empty($kuanhao[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加合同款号!"));
			return;
		}
		$add_time = time();
		$role_info = $this->role->getroleByname1($bianhao);
		if (!empty($role_info)) {
			echo json_encode(array('error' => true, 'msg' => "该合同编号已经存在。请去项目列表查看!"));
			return;
		}
		foreach ($kuanhao as $kkk => $vvv) {
			if (empty($vvv)) {
				continue;
			}
			$kuanhao_info = $this->role->getroleBynamekuanhao($vvv);
			if (!empty($kuanhao_info)) {
				echo json_encode(array('error' => true, 'msg' => "该款号" . $vvv . "已经存在!"));
				return;
			}
		}
		$qianding = strtotime($qianding);

		$rid = $this->role->role_save1($bianhao, $mingcheng, $qianding, $add_time);
		if ($rid) {
			foreach ($menu as $k => $v) {
				$this->role->rtom_save1($rid, $v);
			}
			foreach ($kuanhao as $kk => $vv) {
				if (empty($vv)) {
					continue;
				}
				$this->role->rtom_save2($rid, $vv, $add_time,strtotime($jiaohuoqi[$kk]));
			}
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
		}
	}
	public function goods_save1()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}

		$guiges = isset($_POST["guige"]) ? $_POST["guige"] : '';
		if (empty($guiges[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加规格!"));
			return;
		}
		$sehaos = isset($_POST["sehao"]) ? $_POST["sehao"] : '';
		if (empty($sehaos[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加色号!"));
			return;
		}
		$shuzhis = isset($_POST["shuzhi"]) ? $_POST["shuzhi"] : '';
		if (empty($shuzhis[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加数值!"));
			return;
		}

		foreach ($guiges as $k => $v) {
			if (empty($v) || empty($sehaos[$k]) || empty($shuzhis[$k])) {
				continue;
			}
			$this->role->role_save12($v, $sehaos[$k], $shuzhis[$k], $id, time());
		}
		echo json_encode(array('success' => true, 'msg' => "操作成功。"));
	}
	public function goods_save_edit()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}

		$id = isset($_POST["id"]) ? $_POST["id"] : '';
		$bianhao = isset($_POST["bianhao"]) ? $_POST["bianhao"] : '';
		$mingcheng = isset($_POST["mingcheng"]) ? $_POST["mingcheng"] : '';
		$qianding = isset($_POST["qianding"]) ? $_POST["qianding"] : '';
		$jiaohuoqi = isset($_POST["jiaohuoqi"]) ? $_POST["jiaohuoqi"] : '';
		$menu = isset($_POST["menu"]) ? $_POST["menu"] : '';
		$kuanhao = isset($_POST["kuanhao"]) ? $_POST["kuanhao"] : '';
		if (empty($kuanhao[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加合同款号!"));
			return;
		}
		$add_time = time();
		$role_info = $this->role->getgoodsById22($bianhao, $id);
		if (!empty($role_info)) {
			echo json_encode(array('error' => true, 'msg' => "该合同编号已经存在!"));
			return;
		}
		foreach ($kuanhao as $kkk => $vvv) {
			if (empty($vvv)) {
				continue;
			}
			$kuanhao_info = $this->role->getgoodsById22kuanhao($vvv, $id);
			if (!empty($kuanhao_info)) {
				echo json_encode(array('error' => true, 'msg' => "该款号" . $vvv . "已经存在!"));
				return;
			}
		}
		$qianding = strtotime($qianding);
		$result = $this->role->goods_save_edit($bianhao, $mingcheng, $qianding, $add_time, $id);
		$this->role->goodsimg_delete1($id);
		$this->role->goodsimg_delete2($id);
		if ($result) {
			foreach ($menu as $k => $v) {
				$this->role->rtom_save1($id, $v);
			}
			foreach ($kuanhao as $kk => $vv) {
				if (empty($vv)) {
					continue;
				}
				$this->role->rtom_save2($id, $vv, $add_time,strtotime($jiaohuoqi[$kk]));
			}
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
		}
	}
	public function goods_save_edit1()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$id = isset($_POST["id"]) ? $_POST["id"] : '';

		$guiges = isset($_POST["guige"]) ? $_POST["guige"] : '';
		if (empty($guiges[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加规格!"));
			return;
		}
		$sehaos = isset($_POST["sehao"]) ? $_POST["sehao"] : '';
		if (empty($sehaos[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加色号!"));
			return;
		}
		$shuzhis = isset($_POST["shuzhi"]) ? $_POST["shuzhi"] : '';
		if (empty($shuzhis[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加数值!"));
			return;
		}
		$this->role->goodsimg_delete3($id);
		foreach ($guiges as $k => $v) {
			if (empty($v) || empty($sehaos[$k]) || empty($shuzhis[$k])) {
				continue;
			}
			$this->role->role_save12($v, $sehaos[$k], $shuzhis[$k], $id, time());
		}

		echo json_encode(array('success' => true, 'msg' => "操作成功。"));

	}
	public function goods_save2()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}

		$pinmings = isset($_POST["pinming"]) ? $_POST["pinming"] : '';
		if (empty($pinmings[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加品名!"));
			return;
		}
		$pinfans = isset($_POST["pinfan"]) ? $_POST["pinfan"] : '';
		if (empty($pinfans[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加品番!"));
			return;
		}
		$sehaos = isset($_POST["sehao"]) ? $_POST["sehao"] : '';
		if (empty($sehaos[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加色号!"));
			return;
		}
		$guiges = isset($_POST["guige"]) ? $_POST["guige"] : '';
		if (empty($guiges[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加规格!"));
			return;
		}
		$danweis = isset($_POST["danwei"]) ? $_POST["danwei"] : '';
		if (empty($danweis[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单位!"));
			return;
		}
		$tidanshu = isset($_POST["tidanshu"]) ? $_POST["tidanshu"] : '';
		if (empty($tidanshu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加提单数!"));
			return;
		}
		$qingdianshu = isset($_POST["qingdianshu"]) ? $_POST["qingdianshu"] : '';
		if (empty($qingdianshu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加请点数!"));
			return;
		}
		$yangzhishi = isset($_POST["yangzhishi"]) ? $_POST["yangzhishi"] : '';
		if (empty($yangzhishi[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加样指示!"));
			return;
		}
		$shiji = isset($_POST["shiji"]) ? $_POST["shiji"] : '';
		if (empty($shiji[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加实际!"));
			return;
		}
		$sunhao = isset($_POST["sunhao"]) ? $_POST["sunhao"] : '';
		if (empty($sunhao[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加损耗!"));
			return;
		}
		$jianshu = isset($_POST["jianshu"]) ? $_POST["jianshu"] : '';
		if (empty($jianshu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加件数!"));
			return;
		}
		$sunhaoyongliang = isset($_POST["sunhaoyongliang"]) ? $_POST["sunhaoyongliang"] : '';
		if (empty($sunhaoyongliang[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加增减数量!"));
			return;
		}
		$daoliaori = isset($_POST["daoliaori"]) ? $_POST["daoliaori"] : '';
		if (empty($daoliaori[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加到料日!"));
			return;
		}
		foreach ($pinmings as $k => $v) {
			if (empty($v) || empty($pinfans[$k]) || empty($sehaos[$k]) || empty($guiges[$k]) || empty($danweis[$k]) || empty($tidanshu[$k]) || empty($qingdianshu[$k]) || empty($yangzhishi[$k]) || empty($shiji[$k]) || empty($sunhao[$k]) || empty($jianshu[$k]) || empty($sunhaoyongliang[$k]) || empty($daoliaori[$k])) {
				continue;
			}
			$zhishiyongliang = floatval($yangzhishi[$k]) * floatval($jianshu[$k]);
			$shijiyongliang = floatval($shiji[$k]) * floatval($jianshu[$k]);
			$shengyu = floatval($tidanshu[$k]) - floatval($zhishiyongliang);;
			$this->role->role_save123($v,$pinfans[$k],$sehaos[$k],$guiges[$k],$danweis[$k],$tidanshu[$k],$qingdianshu[$k],$yangzhishi[$k],$shiji[$k],$sunhao[$k],$jianshu[$k],$sunhaoyongliang[$k],$zhishiyongliang,$shijiyongliang,$shengyu,$daoliaori[$k],$id,time());
		}
		echo json_encode(array('success' => true, 'msg' => "操作成功。"));
	}
	public function goods_save_edit2()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$id = isset($_POST["id"]) ? $_POST["id"] : '';

		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}

		$pinmings = isset($_POST["pinming"]) ? $_POST["pinming"] : '';
		if (empty($pinmings[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加品名!"));
			return;
		}
		$pinfans = isset($_POST["pinfan"]) ? $_POST["pinfan"] : '';
		if (empty($pinfans[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加品番!"));
			return;
		}
		$sehaos = isset($_POST["sehao"]) ? $_POST["sehao"] : '';
		if (empty($sehaos[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加色号!"));
			return;
		}
		$guiges = isset($_POST["guige"]) ? $_POST["guige"] : '';
		if (empty($guiges[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加规格!"));
			return;
		}
		$danweis = isset($_POST["danwei"]) ? $_POST["danwei"] : '';
		if (empty($danweis[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单位!"));
			return;
		}
		$tidanshu = isset($_POST["tidanshu"]) ? $_POST["tidanshu"] : '';
		if (empty($tidanshu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加提单数!"));
			return;
		}
		$qingdianshu = isset($_POST["qingdianshu"]) ? $_POST["qingdianshu"] : '';
		if (empty($qingdianshu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加请点数!"));
			return;
		}
		$yangzhishi = isset($_POST["yangzhishi"]) ? $_POST["yangzhishi"] : '';
		if (empty($yangzhishi[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加样指示!"));
			return;
		}
		$shiji = isset($_POST["shiji"]) ? $_POST["shiji"] : '';
		if (empty($shiji[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加实际!"));
			return;
		}
		$sunhao = isset($_POST["sunhao"]) ? $_POST["sunhao"] : '';
		if (empty($sunhao[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加损耗!"));
			return;
		}
		$jianshu = isset($_POST["jianshu"]) ? $_POST["jianshu"] : '';
		if (empty($jianshu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加件数!"));
			return;
		}
		$sunhaoyongliang = isset($_POST["sunhaoyongliang"]) ? $_POST["sunhaoyongliang"] : '';
		if (empty($sunhaoyongliang[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加增减数量!"));
			return;
		}
		$daoliaori = isset($_POST["daoliaori"]) ? $_POST["daoliaori"] : '';
		if (empty($daoliaori[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加到料日!"));
			return;
		}
		$this->role->goodsimg_delete4($id);
		foreach ($pinmings as $k => $v) {
			if (empty($v) || empty($pinfans[$k]) || empty($sehaos[$k]) || empty($guiges[$k]) || empty($danweis[$k]) || empty($tidanshu[$k]) || empty($qingdianshu[$k]) || empty($yangzhishi[$k]) || empty($shiji[$k]) || empty($sunhao[$k]) || empty($jianshu[$k]) || empty($sunhaoyongliang[$k]) || empty($daoliaori[$k])) {
				continue;
			}
			$zhishiyongliang = floatval($yangzhishi[$k]) * floatval($jianshu[$k]);
			$shijiyongliang = floatval($shiji[$k]) * floatval($jianshu[$k]);
			$shengyu = floatval($tidanshu[$k]) - floatval($zhishiyongliang);;
			$this->role->role_save123($v,$pinfans[$k],$sehaos[$k],$guiges[$k],$danweis[$k],$tidanshu[$k],$qingdianshu[$k],$yangzhishi[$k],$shiji[$k],$sunhao[$k],$jianshu[$k],$sunhaoyongliang[$k],$zhishiyongliang,$shijiyongliang,$shengyu,$daoliaori[$k],$id,time());
		}

		echo json_encode(array('success' => true, 'msg' => "操作成功。"));

	}
	public function goods_list()
	{

		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage($gname);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew($page, $gname);
		$data["gname"] = $gname;

		foreach ($list as $k=>$v){
			$list[$k]['kuanhaoshu'] = $this->role->getgoodsAllNewcount($v['id']);
			$tname = "";
			$tidARR = $this->taskclass->gettaskclassById($v['id']);
			foreach ($tidARR as $kk=>$vv){
				if ($kk < 1){
					$tname = $vv['username'];
				}else{
					$tname = $tname.";".$vv['username'];
				}
			}
			$list[$k]['newrennew'] = $tname;
		}
		$data["list"] = $list;
		$this->display("goods/goods_list", $data);
	}
	public function goods_add()
	{
		$tidlist = $this->task->gettidlist();
		$data['tidlist'] = $tidlist;
		$this->display("goods/goods_add", $data);
	}
	public function goods_add1()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$data['id'] = $id;
		$this->display("goods/goods_add1", $data);
	}
	public function goods_delete()
	{
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		if ($this->role->goods_delete($id)) {
			$this->role->goodsimg_delete1($id);
			$this->role->goodsimg_delete2($id);
			echo json_encode(array('success' => true, 'msg' => "删除成功"));
			return;
		} else {
			echo json_encode(array('success' => false, 'msg' => "删除失败"));
			return;
		}
	}
	public function goods_edit()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->role->getgoodsById($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$tidlist = $this->task->gettidlist();
		$data = array();
		$data['bianhao'] = $goods_info['bianhao'];
		$data['mingcheng'] = $goods_info['mingcheng'];
		$data['qianding'] = $goods_info['qianding'];
		$data['jiaohuoqi'] = $goods_info['jiaohuoqi'];
		$data['id'] = $id;
		$data['tidlist'] = $tidlist;
		$mefuze = $this->task->gettidlistfuze($id);
		foreach ($mefuze as $k => $v) {
			$data['mefuze'][] = $v['uid'];
		}
		$kuanhaos = $this->task->gettidlistkuanhao($id);
		$data['kuanhao1'] = '';
		$data['kuanhao2'] = '';
		$data['kuanhao3'] = '';
		$data['kuanhao4'] = '';
		$data['kuanhao5'] = '';
		$data['kuanhao6'] = '';
		$data['kuanhao7'] = '';
		$data['kuanhao8'] = '';
		$data['kuanhao9'] = '';
		$data['kuanhao10'] = '';
		if (!empty($kuanhaos[0]['kuanhao'])) {
			$data['kuanhao1'] = $kuanhaos[0]['kuanhao'];
		}
		if (!empty($kuanhaos[1]['kuanhao'])) {
			$data['kuanhao2'] = $kuanhaos[1]['kuanhao'];
		}
		if (!empty($kuanhaos[2]['kuanhao'])) {
			$data['kuanhao3'] = $kuanhaos[2]['kuanhao'];
		}
		if (!empty($kuanhaos[3]['kuanhao'])) {
			$data['kuanhao4'] = $kuanhaos[3]['kuanhao'];
		}
		if (!empty($kuanhaos[4]['kuanhao'])) {
			$data['kuanhao5'] = $kuanhaos[4]['kuanhao'];
		}
		if (!empty($kuanhaos[5]['kuanhao'])) {
			$data['kuanhao6'] = $kuanhaos[5]['kuanhao'];
		}
		if (!empty($kuanhaos[6]['kuanhao'])) {
			$data['kuanhao7'] = $kuanhaos[6]['kuanhao'];
		}
		if (!empty($kuanhaos[7]['kuanhao'])) {
			$data['kuanhao8'] = $kuanhaos[7]['kuanhao'];
		}
		if (!empty($kuanhaos[8]['kuanhao'])) {
			$data['kuanhao9'] = $kuanhaos[8]['kuanhao'];
		}
		if (!empty($kuanhaos[9]['kuanhao'])) {
			$data['kuanhao10'] = $kuanhaos[9]['kuanhao'];
		}
		$this->display("goods/goods_edit", $data);
	}
	public function goods_list1()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage1($gname,$id);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page,$allpage,$_GET);
		$data["page"] = $page;
		$data["id"] = $id;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew1($page,$gname,$id);
		$data["gname"] = $gname;
		foreach ($list as $k => $v) {
			$guiges = $this->task->gettidlistguige($v['id']);
			if (!empty($guiges)) {
				$list[$k]['openflg'] = 1;
			} else {
				$list[$k]['openflg'] = 0;
			}

			$pinmings = $this->task->gettidlistpinming($v['id']);
			if (!empty($pinmings)) {
				$list[$k]['openflg1'] = 1;
			} else {
				$list[$k]['openflg1'] = 0;
			}

			$kuanhaoallone = $this->role->gettidlistpinmingkuanhao($v['kuanhao']);
			$list[$k]['excelwendang'] = empty($kuanhaoallone[0]['excelwendang'])?'#':$kuanhaoallone[0]['excelwendang'];

		}
		$data["list"] = $list;
		$this->display("goods/goods_list1", $data);
	}
	public function goods_edit1()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$data = array();
		$data['id'] = $id;
		$kuanhaos = $this->task->gettidlistguige($id);

		$data['guige1'] = '';
		$data['sehao1'] = '';
		$data['shuzhi1'] = '';
		$data['guige2'] = '';
		$data['sehao2'] = '';
		$data['shuzhi2'] = '';
		$data['guige3'] = '';
		$data['sehao3'] = '';
		$data['shuzhi3'] = '';
		$data['guige4'] = '';
		$data['sehao4'] = '';
		$data['shuzhi4'] = '';
		$data['guige5'] = '';
		$data['sehao5'] = '';
		$data['shuzhi5'] = '';
		$data['guige6'] = '';
		$data['sehao6'] = '';
		$data['shuzhi6'] = '';
		$data['guige7'] = '';
		$data['sehao7'] = '';
		$data['shuzhi7'] = '';
		$data['guige8'] = '';
		$data['sehao8'] = '';
		$data['shuzhi8'] = '';
		$data['guige9'] = '';
		$data['sehao9'] = '';
		$data['shuzhi9'] = '';
		$data['guige10'] = '';
		$data['sehao10'] = '';
		$data['shuzhi10'] = '';
		if (!empty($kuanhaos[0]['guige'])) {
			$data['guige1'] = $kuanhaos[0]['guige'];
			$data['sehao1'] = $kuanhaos[0]['sehao'];
			$data['shuzhi1'] = $kuanhaos[0]['shuzhi'];
		}
		if (!empty($kuanhaos[1]['guige'])) {
			$data['guige2'] = $kuanhaos[1]['guige'];
			$data['sehao2'] = $kuanhaos[1]['sehao'];
			$data['shuzhi2'] = $kuanhaos[1]['shuzhi'];
		}
		if (!empty($kuanhaos[2]['guige'])) {
			$data['guige3'] = $kuanhaos[2]['guige'];
			$data['sehao3'] = $kuanhaos[2]['sehao'];
			$data['shuzhi3'] = $kuanhaos[2]['shuzhi'];
		}
		if (!empty($kuanhaos[3]['guige'])) {
			$data['guige4'] = $kuanhaos[3]['guige'];
			$data['sehao4'] = $kuanhaos[3]['sehao'];
			$data['shuzhi4'] = $kuanhaos[3]['shuzhi'];
		}
		if (!empty($kuanhaos[4]['guige'])) {
			$data['guige5'] = $kuanhaos[4]['guige'];
			$data['sehao5'] = $kuanhaos[4]['sehao'];
			$data['shuzhi5'] = $kuanhaos[4]['shuzhi'];
		}
		if (!empty($kuanhaos[5]['guige'])) {
			$data['guige6'] = $kuanhaos[5]['guige'];
			$data['sehao6'] = $kuanhaos[5]['sehao'];
			$data['shuzhi6'] = $kuanhaos[5]['shuzhi'];
		}
		if (!empty($kuanhaos[6]['guige'])) {
			$data['guige7'] = $kuanhaos[6]['guige'];
			$data['sehao7'] = $kuanhaos[6]['sehao'];
			$data['shuzhi7'] = $kuanhaos[6]['shuzhi'];
		}
		if (!empty($kuanhaos[7]['guige'])) {
			$data['guige8'] = $kuanhaos[7]['guige'];
			$data['sehao8'] = $kuanhaos[7]['sehao'];
			$data['shuzhi8'] = $kuanhaos[7]['shuzhi'];
		}
		if (!empty($kuanhaos[8]['guige'])) {
			$data['guige9'] = $kuanhaos[8]['guige'];
			$data['sehao9'] = $kuanhaos[8]['sehao'];
			$data['shuzhi9'] = $kuanhaos[8]['shuzhi'];
		}
		if (!empty($kuanhaos[9]['guige'])) {
			$data['guige10'] = $kuanhaos[9]['guige'];
			$data['sehao10'] = $kuanhaos[9]['sehao'];
			$data['shuzhi10'] = $kuanhaos[9]['shuzhi'];
		}
		$this->display("goods/goods_edit1", $data);
	}
	public function goods_add2()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$data['id'] = $id;
		$this->display("goods/goods_add2", $data);
	}
	public function goods_edit2()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$data = array();
		$data['id'] = $id;
		$kuanhaos = $this->task->gettidlistpinming($id);

		$data['pinming1'] = '';
		$data['pinfan1'] = '';
		$data['sehao1'] = '';
		$data['guige1'] = '';
		$data['danwei1'] = '';
		$data['tidanshu1'] = '';
		$data['qingdianshu1'] = '';
		$data['yangzhishi1'] = '';
		$data['shiji1'] = '';
		$data['sunhao1'] = '';
		$data['jianshu1'] = '';
		$data['sunhaoyongliang1'] = '';
		$data['daoliaori1'] = '';

		$data['pinming2'] = '';
		$data['pinfan2'] = '';
		$data['sehao2'] = '';
		$data['guige2'] = '';
		$data['danwei2'] = '';
		$data['tidanshu2'] = '';
		$data['qingdianshu2'] = '';
		$data['yangzhishi2'] = '';
		$data['shiji2'] = '';
		$data['sunhao2'] = '';
		$data['jianshu2'] = '';
		$data['sunhaoyongliang2'] = '';
		$data['daoliaori2'] = '';

		$data['pinming3'] = '';
		$data['pinfan3'] = '';
		$data['sehao3'] = '';
		$data['guige3'] = '';
		$data['danwei3'] = '';
		$data['tidanshu3'] = '';
		$data['qingdianshu3'] = '';
		$data['yangzhishi3'] = '';
		$data['shiji3'] = '';
		$data['sunhao3'] = '';
		$data['jianshu3'] = '';
		$data['sunhaoyongliang3'] = '';
		$data['daoliaori3'] = '';

		$data['pinming4'] = '';
		$data['pinfan4'] = '';
		$data['sehao4'] = '';
		$data['guige4'] = '';
		$data['danwei4'] = '';
		$data['tidanshu4'] = '';
		$data['qingdianshu4'] = '';
		$data['yangzhishi4'] = '';
		$data['shiji4'] = '';
		$data['sunhao4'] = '';
		$data['jianshu4'] = '';
		$data['sunhaoyongliang4'] = '';
		$data['daoliaori4'] = '';

		$data['pinming5'] = '';
		$data['pinfan5'] = '';
		$data['sehao5'] = '';
		$data['guige5'] = '';
		$data['danwei5'] = '';
		$data['tidanshu5'] = '';
		$data['qingdianshu5'] = '';
		$data['yangzhishi5'] = '';
		$data['shiji5'] = '';
		$data['sunhao5'] = '';
		$data['jianshu5'] = '';
		$data['sunhaoyongliang5'] = '';
		$data['daoliaori5'] = '';

		$data['pinming6'] = '';
		$data['pinfan6'] = '';
		$data['sehao6'] = '';
		$data['guige6'] = '';
		$data['danwei6'] = '';
		$data['tidanshu6'] = '';
		$data['qingdianshu6'] = '';
		$data['yangzhishi6'] = '';
		$data['shiji6'] = '';
		$data['sunhao6'] = '';
		$data['jianshu6'] = '';
		$data['sunhaoyongliang6'] = '';
		$data['daoliaori6'] = '';

		$data['pinming7'] = '';
		$data['pinfan7'] = '';
		$data['sehao7'] = '';
		$data['guige7'] = '';
		$data['danwei7'] = '';
		$data['tidanshu7'] = '';
		$data['qingdianshu7'] = '';
		$data['yangzhishi7'] = '';
		$data['shiji7'] = '';
		$data['sunhao7'] = '';
		$data['jianshu7'] = '';
		$data['sunhaoyongliang7'] = '';
		$data['daoliaori7'] = '';

		$data['pinming8'] = '';
		$data['pinfan8'] = '';
		$data['sehao8'] = '';
		$data['guige8'] = '';
		$data['danwei8'] = '';
		$data['tidanshu8'] = '';
		$data['qingdianshu8'] = '';
		$data['yangzhishi8'] = '';
		$data['shiji8'] = '';
		$data['sunhao8'] = '';
		$data['jianshu8'] = '';
		$data['sunhaoyongliang8'] = '';
		$data['daoliaori8'] = '';

		$data['pinming9'] = '';
		$data['pinfan9'] = '';
		$data['sehao9'] = '';
		$data['guige9'] = '';
		$data['danwei9'] = '';
		$data['tidanshu9'] = '';
		$data['qingdianshu9'] = '';
		$data['yangzhishi9'] = '';
		$data['shiji9'] = '';
		$data['sunhao9'] = '';
		$data['jianshu9'] = '';
		$data['sunhaoyongliang9'] = '';
		$data['daoliaori9'] = '';

		$data['pinming10'] = '';
		$data['pinfan10'] = '';
		$data['sehao10'] = '';
		$data['guige10'] = '';
		$data['danwei10'] = '';
		$data['tidanshu10'] = '';
		$data['qingdianshu10'] = '';
		$data['yangzhishi10'] = '';
		$data['shiji10'] = '';
		$data['sunhao10'] = '';
		$data['jianshu10'] = '';
		$data['sunhaoyongliang10'] = '';
		$data['daoliaori10'] = '';

		if (!empty($kuanhaos[0]['pinming'])) {
			$data['pinming1'] = $kuanhaos[0]['pinming'];
			$data['pinfan1'] = $kuanhaos[0]['pinfan'];
			$data['sehao1'] = $kuanhaos[0]['sehao'];
			$data['guige1'] = $kuanhaos[0]['guige'];
			$data['danwei1'] = $kuanhaos[0]['danwei'];
			$data['tidanshu1'] = $kuanhaos[0]['tidanshu'];
			$data['qingdianshu1'] = $kuanhaos[0]['qingdianshu'];
			$data['yangzhishi1'] = $kuanhaos[0]['yangzhishi'];
			$data['shiji1'] = $kuanhaos[0]['shiji'];
			$data['sunhao1'] = $kuanhaos[0]['sunhao'];
			$data['jianshu1'] = $kuanhaos[0]['jianshu'];
			$data['sunhaoyongliang1'] = $kuanhaos[0]['sunhaoyongliang'];
			$data['daoliaori1'] = $kuanhaos[0]['daoliaori'];
		}
		if (!empty($kuanhaos[1]['pinming'])) {
			$data['pinming2'] = $kuanhaos[1]['pinming'];
			$data['pinfan2'] = $kuanhaos[1]['pinfan'];
			$data['sehao2'] = $kuanhaos[1]['sehao'];
			$data['guige2'] = $kuanhaos[1]['guige'];
			$data['danwei2'] = $kuanhaos[1]['danwei'];
			$data['tidanshu2'] = $kuanhaos[1]['tidanshu'];
			$data['qingdianshu2'] = $kuanhaos[1]['qingdianshu'];
			$data['yangzhishi2'] = $kuanhaos[1]['yangzhishi'];
			$data['shiji2'] = $kuanhaos[1]['shiji'];
			$data['sunhao2'] = $kuanhaos[1]['sunhao'];
			$data['jianshu2'] = $kuanhaos[1]['jianshu'];
			$data['sunhaoyongliang2'] = $kuanhaos[1]['sunhaoyongliang'];
			$data['daoliaori2'] = $kuanhaos[1]['daoliaori'];
		}
		if (!empty($kuanhaos[2]['pinming'])) {
			$data['pinming3'] = $kuanhaos[2]['pinming'];
			$data['pinfan3'] = $kuanhaos[2]['pinfan'];
			$data['sehao3'] = $kuanhaos[2]['sehao'];
			$data['guige3'] = $kuanhaos[2]['guige'];
			$data['danwei3'] = $kuanhaos[2]['danwei'];
			$data['tidanshu3'] = $kuanhaos[2]['tidanshu'];
			$data['qingdianshu3'] = $kuanhaos[2]['qingdianshu'];
			$data['yangzhishi3'] = $kuanhaos[2]['yangzhishi'];
			$data['shiji3'] = $kuanhaos[2]['shiji'];
			$data['sunhao3'] = $kuanhaos[2]['sunhao'];
			$data['jianshu3'] = $kuanhaos[2]['jianshu'];
			$data['sunhaoyongliang3'] = $kuanhaos[2]['sunhaoyongliang'];
			$data['daoliaori3'] = $kuanhaos[2]['daoliaori'];
		}
		if (!empty($kuanhaos[3]['pinming'])) {
			$data['pinming4'] = $kuanhaos[3]['pinming'];
			$data['pinfan4'] = $kuanhaos[3]['pinfan'];
			$data['sehao4'] = $kuanhaos[3]['sehao'];
			$data['guige4'] = $kuanhaos[3]['guige'];
			$data['danwei4'] = $kuanhaos[3]['danwei'];
			$data['tidanshu4'] = $kuanhaos[3]['tidanshu'];
			$data['qingdianshu4'] = $kuanhaos[3]['qingdianshu'];
			$data['yangzhishi4'] = $kuanhaos[3]['yangzhishi'];
			$data['shiji4'] = $kuanhaos[3]['shiji'];
			$data['sunhao4'] = $kuanhaos[3]['sunhao'];
			$data['jianshu4'] = $kuanhaos[3]['jianshu'];
			$data['sunhaoyongliang4'] = $kuanhaos[3]['sunhaoyongliang'];
			$data['daoliaori4'] = $kuanhaos[3]['daoliaori'];
		}
		if (!empty($kuanhaos[4]['pinming'])) {
			$data['pinming5'] = $kuanhaos[4]['pinming'];
			$data['pinfan5'] = $kuanhaos[4]['pinfan'];
			$data['sehao5'] = $kuanhaos[4]['sehao'];
			$data['guige5'] = $kuanhaos[4]['guige'];
			$data['danwei5'] = $kuanhaos[4]['danwei'];
			$data['tidanshu5'] = $kuanhaos[4]['tidanshu'];
			$data['qingdianshu5'] = $kuanhaos[4]['qingdianshu'];
			$data['yangzhishi5'] = $kuanhaos[4]['yangzhishi'];
			$data['shiji5'] = $kuanhaos[4]['shiji'];
			$data['sunhao5'] = $kuanhaos[4]['sunhao'];
			$data['jianshu5'] = $kuanhaos[4]['jianshu'];
			$data['sunhaoyongliang5'] = $kuanhaos[4]['sunhaoyongliang'];
			$data['daoliaori5'] = $kuanhaos[4]['daoliaori'];
		}
		if (!empty($kuanhaos[5]['pinming'])) {
			$data['pinming6'] = $kuanhaos[5]['pinming'];
			$data['pinfan6'] = $kuanhaos[5]['pinfan'];
			$data['sehao6'] = $kuanhaos[5]['sehao'];
			$data['guige6'] = $kuanhaos[5]['guige'];
			$data['danwei6'] = $kuanhaos[5]['danwei'];
			$data['tidanshu6'] = $kuanhaos[5]['tidanshu'];
			$data['qingdianshu6'] = $kuanhaos[5]['qingdianshu'];
			$data['yangzhishi6'] = $kuanhaos[5]['yangzhishi'];
			$data['shiji6'] = $kuanhaos[5]['shiji'];
			$data['sunhao6'] = $kuanhaos[5]['sunhao'];
			$data['jianshu6'] = $kuanhaos[5]['jianshu'];
			$data['sunhaoyongliang6'] = $kuanhaos[5]['sunhaoyongliang'];
			$data['daoliaori6'] = $kuanhaos[5]['daoliaori'];
		}
		if (!empty($kuanhaos[6]['pinming'])) {
			$data['pinming7'] = $kuanhaos[6]['pinming'];
			$data['pinfan7'] = $kuanhaos[6]['pinfan'];
			$data['sehao7'] = $kuanhaos[6]['sehao'];
			$data['guige7'] = $kuanhaos[6]['guige'];
			$data['danwei7'] = $kuanhaos[6]['danwei'];
			$data['tidanshu7'] = $kuanhaos[6]['tidanshu'];
			$data['qingdianshu7'] = $kuanhaos[6]['qingdianshu'];
			$data['yangzhishi7'] = $kuanhaos[6]['yangzhishi'];
			$data['shiji7'] = $kuanhaos[6]['shiji'];
			$data['sunhao7'] = $kuanhaos[6]['sunhao'];
			$data['jianshu7'] = $kuanhaos[6]['jianshu'];
			$data['sunhaoyongliang7'] = $kuanhaos[6]['sunhaoyongliang'];
			$data['daoliaori7'] = $kuanhaos[6]['daoliaori'];
		}
		if (!empty($kuanhaos[7]['pinming'])) {
			$data['pinming8'] = $kuanhaos[7]['pinming'];
			$data['pinfan8'] = $kuanhaos[7]['pinfan'];
			$data['sehao8'] = $kuanhaos[7]['sehao'];
			$data['guige8'] = $kuanhaos[7]['guige'];
			$data['danwei8'] = $kuanhaos[7]['danwei'];
			$data['tidanshu8'] = $kuanhaos[7]['tidanshu'];
			$data['qingdianshu8'] = $kuanhaos[7]['qingdianshu'];
			$data['yangzhishi8'] = $kuanhaos[7]['yangzhishi'];
			$data['shiji8'] = $kuanhaos[7]['shiji'];
			$data['sunhao8'] = $kuanhaos[7]['sunhao'];
			$data['jianshu8'] = $kuanhaos[7]['jianshu'];
			$data['sunhaoyongliang8'] = $kuanhaos[7]['sunhaoyongliang'];
			$data['daoliaori8'] = $kuanhaos[7]['daoliaori'];
		}
		if (!empty($kuanhaos[8]['pinming'])) {
			$data['pinming9'] = $kuanhaos[8]['pinming'];
			$data['pinfan9'] = $kuanhaos[8]['pinfan'];
			$data['sehao9'] = $kuanhaos[8]['sehao'];
			$data['guige9'] = $kuanhaos[8]['guige'];
			$data['danwei9'] = $kuanhaos[8]['danwei'];
			$data['tidanshu9'] = $kuanhaos[8]['tidanshu'];
			$data['qingdianshu9'] = $kuanhaos[8]['qingdianshu'];
			$data['yangzhishi9'] = $kuanhaos[8]['yangzhishi'];
			$data['shiji9'] = $kuanhaos[8]['shiji'];
			$data['sunhao9'] = $kuanhaos[8]['sunhao'];
			$data['jianshu9'] = $kuanhaos[8]['jianshu'];
			$data['sunhaoyongliang9'] = $kuanhaos[8]['sunhaoyongliang'];
			$data['daoliaori9'] = $kuanhaos[8]['daoliaori'];
		}
		if (!empty($kuanhaos[9]['pinming'])) {
			$data['pinming10'] = $kuanhaos[9]['pinming'];
			$data['pinfan10'] = $kuanhaos[9]['pinfan'];
			$data['sehao10'] = $kuanhaos[9]['sehao'];
			$data['guige10'] = $kuanhaos[9]['guige'];
			$data['danwei10'] = $kuanhaos[9]['danwei'];
			$data['tidanshu10'] = $kuanhaos[9]['tidanshu'];
			$data['qingdianshu10'] = $kuanhaos[9]['qingdianshu'];
			$data['yangzhishi10'] = $kuanhaos[9]['yangzhishi'];
			$data['shiji10'] = $kuanhaos[9]['shiji'];
			$data['sunhao10'] = $kuanhaos[9]['sunhao'];
			$data['jianshu10'] = $kuanhaos[9]['jianshu'];
			$data['sunhaoyongliang10'] = $kuanhaos[9]['sunhaoyongliang'];
			$data['daoliaori10'] = $kuanhaos[9]['daoliaori'];
		}
		$this->display("goods/goods_edit2", $data);
	}
	public function goods_add_new()
	{
		$tidlist = $this->task->gettidlist();
		$data['tidlist'] = $tidlist;
		$this->display("goods/goods_add_new", $data);
	}
	public function goods_edit_new()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->role->getgoodsById($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$tidlist = $this->task->gettidlist();
		$data = array();
		$data['bianhao'] = $goods_info['bianhao'];
		$data['mingcheng'] = $goods_info['mingcheng'];
		$data['qianding'] = $goods_info['qianding'];
		$data['jiaohuoqi'] = $goods_info['jiaohuoqi'];
		$data['id'] = $id;
		$data['tidlist'] = $tidlist;
		$mefuze = $this->task->gettidlistfuze($id);
		foreach ($mefuze as $k => $v) {
			$data['mefuze'][] = $v['uid'];
		}
		$kuanhaos = $this->task->gettidlistkuanhao($id);
		$data['kuanhao1'] = '';
		$data['kuanhao2'] = '';
		$data['kuanhao3'] = '';
		$data['kuanhao4'] = '';
		$data['kuanhao5'] = '';
		$data['kuanhao6'] = '';
		$data['kuanhao7'] = '';
		$data['kuanhao8'] = '';
		$data['kuanhao9'] = '';
		$data['kuanhao10'] = '';
		$data['jiaohuoqi1'] = '';
		$data['jiaohuoqi2'] = '';
		$data['jiaohuoqi3'] = '';
		$data['jiaohuoqi4'] = '';
		$data['jiaohuoqi5'] = '';
		$data['jiaohuoqi6'] = '';
		$data['jiaohuoqi7'] = '';
		$data['jiaohuoqi8'] = '';
		$data['jiaohuoqi9'] = '';
		$data['jiaohuoqi10'] = '';
		if (!empty($kuanhaos[0]['kuanhao'])) {
			$data['kuanhao1'] = $kuanhaos[0]['kuanhao'];
			$data['jiaohuoqi1'] = $kuanhaos[0]['jiaohuoqi'];
		}
		if (!empty($kuanhaos[1]['kuanhao'])) {
			$data['kuanhao2'] = $kuanhaos[1]['kuanhao'];
			$data['jiaohuoqi2'] = $kuanhaos[1]['jiaohuoqi'];
		}
		if (!empty($kuanhaos[2]['kuanhao'])) {
			$data['kuanhao3'] = $kuanhaos[2]['kuanhao'];
			$data['jiaohuoqi3'] = $kuanhaos[1]['jiaohuoqi'];
		}
		if (!empty($kuanhaos[3]['kuanhao'])) {
			$data['kuanhao4'] = $kuanhaos[3]['kuanhao'];
			$data['jiaohuoqi4'] = $kuanhaos[1]['jiaohuoqi'];
		}
		if (!empty($kuanhaos[4]['kuanhao'])) {
			$data['kuanhao5'] = $kuanhaos[4]['kuanhao'];
			$data['jiaohuoqi5'] = $kuanhaos[1]['jiaohuoqi'];
		}
		if (!empty($kuanhaos[5]['kuanhao'])) {
			$data['kuanhao6'] = $kuanhaos[5]['kuanhao'];
			$data['jiaohuoqi6'] = $kuanhaos[1]['jiaohuoqi'];
		}
		if (!empty($kuanhaos[6]['kuanhao'])) {
			$data['kuanhao7'] = $kuanhaos[6]['kuanhao'];
			$data['jiaohuoqi7'] = $kuanhaos[1]['jiaohuoqi'];
		}
		if (!empty($kuanhaos[7]['kuanhao'])) {
			$data['kuanhao8'] = $kuanhaos[7]['kuanhao'];
			$data['jiaohuoqi8'] = $kuanhaos[1]['jiaohuoqi'];
		}
		if (!empty($kuanhaos[8]['kuanhao'])) {
			$data['kuanhao9'] = $kuanhaos[8]['kuanhao'];
			$data['jiaohuoqi9'] = $kuanhaos[1]['jiaohuoqi'];
		}
		if (!empty($kuanhaos[9]['kuanhao'])) {
			$data['kuanhao10'] = $kuanhaos[9]['kuanhao'];
			$data['jiaohuoqi10'] = $kuanhaos[1]['jiaohuoqi'];
		}
		$this->display("goods/goods_edit_new", $data);
	}
	public function goods_add_new1()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$data['id'] = $id;
		$this->display("goods/goods_add_new1", $data);
	}
	public function goods_edit_new1()
	{
		$kuanhao = isset($_GET['kuanhao']) ? $_GET['kuanhao'] : "";

		$data = array();
		$data['kuanhao'] = $kuanhao;
		$kuanhaos = $this->task->gettidlistguige($kuanhao);
		$data['list'] = $kuanhaos;
		$this->display("goods/goods_edit_new1", $data);
	}
	public function goods_add_new2()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$data['id'] = $id;
		$this->display("goods/goods_add_new2", $data);
	}
	public function goods_edit_new2()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$data = array();
		$data['id'] = $id;
		$kuanhaos = $this->task->gettidlistpinming($id);

		$data['pinming1'] = '';
		$data['pinfan1'] = '';
		$data['sehao1'] = '';
		$data['guige1'] = '';
		$data['danwei1'] = '';
		$data['tidanshu1'] = '';
		$data['qingdianshu1'] = '';
		$data['yangzhishi1'] = '';
		$data['shiji1'] = '';
		$data['sunhao1'] = '';
		$data['jianshu1'] = '';
		$data['sunhaoyongliang1'] = '';
		$data['daoliaori1'] = '';

		$data['pinming2'] = '';
		$data['pinfan2'] = '';
		$data['sehao2'] = '';
		$data['guige2'] = '';
		$data['danwei2'] = '';
		$data['tidanshu2'] = '';
		$data['qingdianshu2'] = '';
		$data['yangzhishi2'] = '';
		$data['shiji2'] = '';
		$data['sunhao2'] = '';
		$data['jianshu2'] = '';
		$data['sunhaoyongliang2'] = '';
		$data['daoliaori2'] = '';

		$data['pinming3'] = '';
		$data['pinfan3'] = '';
		$data['sehao3'] = '';
		$data['guige3'] = '';
		$data['danwei3'] = '';
		$data['tidanshu3'] = '';
		$data['qingdianshu3'] = '';
		$data['yangzhishi3'] = '';
		$data['shiji3'] = '';
		$data['sunhao3'] = '';
		$data['jianshu3'] = '';
		$data['sunhaoyongliang3'] = '';
		$data['daoliaori3'] = '';

		$data['pinming4'] = '';
		$data['pinfan4'] = '';
		$data['sehao4'] = '';
		$data['guige4'] = '';
		$data['danwei4'] = '';
		$data['tidanshu4'] = '';
		$data['qingdianshu4'] = '';
		$data['yangzhishi4'] = '';
		$data['shiji4'] = '';
		$data['sunhao4'] = '';
		$data['jianshu4'] = '';
		$data['sunhaoyongliang4'] = '';
		$data['daoliaori4'] = '';

		$data['pinming5'] = '';
		$data['pinfan5'] = '';
		$data['sehao5'] = '';
		$data['guige5'] = '';
		$data['danwei5'] = '';
		$data['tidanshu5'] = '';
		$data['qingdianshu5'] = '';
		$data['yangzhishi5'] = '';
		$data['shiji5'] = '';
		$data['sunhao5'] = '';
		$data['jianshu5'] = '';
		$data['sunhaoyongliang5'] = '';
		$data['daoliaori5'] = '';

		$data['pinming6'] = '';
		$data['pinfan6'] = '';
		$data['sehao6'] = '';
		$data['guige6'] = '';
		$data['danwei6'] = '';
		$data['tidanshu6'] = '';
		$data['qingdianshu6'] = '';
		$data['yangzhishi6'] = '';
		$data['shiji6'] = '';
		$data['sunhao6'] = '';
		$data['jianshu6'] = '';
		$data['sunhaoyongliang6'] = '';
		$data['daoliaori6'] = '';

		$data['pinming7'] = '';
		$data['pinfan7'] = '';
		$data['sehao7'] = '';
		$data['guige7'] = '';
		$data['danwei7'] = '';
		$data['tidanshu7'] = '';
		$data['qingdianshu7'] = '';
		$data['yangzhishi7'] = '';
		$data['shiji7'] = '';
		$data['sunhao7'] = '';
		$data['jianshu7'] = '';
		$data['sunhaoyongliang7'] = '';
		$data['daoliaori7'] = '';

		$data['pinming8'] = '';
		$data['pinfan8'] = '';
		$data['sehao8'] = '';
		$data['guige8'] = '';
		$data['danwei8'] = '';
		$data['tidanshu8'] = '';
		$data['qingdianshu8'] = '';
		$data['yangzhishi8'] = '';
		$data['shiji8'] = '';
		$data['sunhao8'] = '';
		$data['jianshu8'] = '';
		$data['sunhaoyongliang8'] = '';
		$data['daoliaori8'] = '';

		$data['pinming9'] = '';
		$data['pinfan9'] = '';
		$data['sehao9'] = '';
		$data['guige9'] = '';
		$data['danwei9'] = '';
		$data['tidanshu9'] = '';
		$data['qingdianshu9'] = '';
		$data['yangzhishi9'] = '';
		$data['shiji9'] = '';
		$data['sunhao9'] = '';
		$data['jianshu9'] = '';
		$data['sunhaoyongliang9'] = '';
		$data['daoliaori9'] = '';

		$data['pinming10'] = '';
		$data['pinfan10'] = '';
		$data['sehao10'] = '';
		$data['guige10'] = '';
		$data['danwei10'] = '';
		$data['tidanshu10'] = '';
		$data['qingdianshu10'] = '';
		$data['yangzhishi10'] = '';
		$data['shiji10'] = '';
		$data['sunhao10'] = '';
		$data['jianshu10'] = '';
		$data['sunhaoyongliang10'] = '';
		$data['daoliaori10'] = '';

		if (!empty($kuanhaos[0]['pinming'])) {
			$data['pinming1'] = $kuanhaos[0]['pinming'];
			$data['pinfan1'] = $kuanhaos[0]['pinfan'];
			$data['sehao1'] = $kuanhaos[0]['sehao'];
			$data['guige1'] = $kuanhaos[0]['guige'];
			$data['danwei1'] = $kuanhaos[0]['danwei'];
			$data['tidanshu1'] = $kuanhaos[0]['tidanshu'];
			$data['qingdianshu1'] = $kuanhaos[0]['qingdianshu'];
			$data['yangzhishi1'] = $kuanhaos[0]['yangzhishi'];
			$data['shiji1'] = $kuanhaos[0]['shiji'];
			$data['sunhao1'] = $kuanhaos[0]['sunhao'];
			$data['jianshu1'] = $kuanhaos[0]['jianshu'];
			$data['sunhaoyongliang1'] = $kuanhaos[0]['sunhaoyongliang'];
			$data['daoliaori1'] = $kuanhaos[0]['daoliaori'];
		}
		if (!empty($kuanhaos[1]['pinming'])) {
			$data['pinming2'] = $kuanhaos[1]['pinming'];
			$data['pinfan2'] = $kuanhaos[1]['pinfan'];
			$data['sehao2'] = $kuanhaos[1]['sehao'];
			$data['guige2'] = $kuanhaos[1]['guige'];
			$data['danwei2'] = $kuanhaos[1]['danwei'];
			$data['tidanshu2'] = $kuanhaos[1]['tidanshu'];
			$data['qingdianshu2'] = $kuanhaos[1]['qingdianshu'];
			$data['yangzhishi2'] = $kuanhaos[1]['yangzhishi'];
			$data['shiji2'] = $kuanhaos[1]['shiji'];
			$data['sunhao2'] = $kuanhaos[1]['sunhao'];
			$data['jianshu2'] = $kuanhaos[1]['jianshu'];
			$data['sunhaoyongliang2'] = $kuanhaos[1]['sunhaoyongliang'];
			$data['daoliaori2'] = $kuanhaos[1]['daoliaori'];
		}
		if (!empty($kuanhaos[2]['pinming'])) {
			$data['pinming3'] = $kuanhaos[2]['pinming'];
			$data['pinfan3'] = $kuanhaos[2]['pinfan'];
			$data['sehao3'] = $kuanhaos[2]['sehao'];
			$data['guige3'] = $kuanhaos[2]['guige'];
			$data['danwei3'] = $kuanhaos[2]['danwei'];
			$data['tidanshu3'] = $kuanhaos[2]['tidanshu'];
			$data['qingdianshu3'] = $kuanhaos[2]['qingdianshu'];
			$data['yangzhishi3'] = $kuanhaos[2]['yangzhishi'];
			$data['shiji3'] = $kuanhaos[2]['shiji'];
			$data['sunhao3'] = $kuanhaos[2]['sunhao'];
			$data['jianshu3'] = $kuanhaos[2]['jianshu'];
			$data['sunhaoyongliang3'] = $kuanhaos[2]['sunhaoyongliang'];
			$data['daoliaori3'] = $kuanhaos[2]['daoliaori'];
		}
		if (!empty($kuanhaos[3]['pinming'])) {
			$data['pinming4'] = $kuanhaos[3]['pinming'];
			$data['pinfan4'] = $kuanhaos[3]['pinfan'];
			$data['sehao4'] = $kuanhaos[3]['sehao'];
			$data['guige4'] = $kuanhaos[3]['guige'];
			$data['danwei4'] = $kuanhaos[3]['danwei'];
			$data['tidanshu4'] = $kuanhaos[3]['tidanshu'];
			$data['qingdianshu4'] = $kuanhaos[3]['qingdianshu'];
			$data['yangzhishi4'] = $kuanhaos[3]['yangzhishi'];
			$data['shiji4'] = $kuanhaos[3]['shiji'];
			$data['sunhao4'] = $kuanhaos[3]['sunhao'];
			$data['jianshu4'] = $kuanhaos[3]['jianshu'];
			$data['sunhaoyongliang4'] = $kuanhaos[3]['sunhaoyongliang'];
			$data['daoliaori4'] = $kuanhaos[3]['daoliaori'];
		}
		if (!empty($kuanhaos[4]['pinming'])) {
			$data['pinming5'] = $kuanhaos[4]['pinming'];
			$data['pinfan5'] = $kuanhaos[4]['pinfan'];
			$data['sehao5'] = $kuanhaos[4]['sehao'];
			$data['guige5'] = $kuanhaos[4]['guige'];
			$data['danwei5'] = $kuanhaos[4]['danwei'];
			$data['tidanshu5'] = $kuanhaos[4]['tidanshu'];
			$data['qingdianshu5'] = $kuanhaos[4]['qingdianshu'];
			$data['yangzhishi5'] = $kuanhaos[4]['yangzhishi'];
			$data['shiji5'] = $kuanhaos[4]['shiji'];
			$data['sunhao5'] = $kuanhaos[4]['sunhao'];
			$data['jianshu5'] = $kuanhaos[4]['jianshu'];
			$data['sunhaoyongliang5'] = $kuanhaos[4]['sunhaoyongliang'];
			$data['daoliaori5'] = $kuanhaos[4]['daoliaori'];
		}
		if (!empty($kuanhaos[5]['pinming'])) {
			$data['pinming6'] = $kuanhaos[5]['pinming'];
			$data['pinfan6'] = $kuanhaos[5]['pinfan'];
			$data['sehao6'] = $kuanhaos[5]['sehao'];
			$data['guige6'] = $kuanhaos[5]['guige'];
			$data['danwei6'] = $kuanhaos[5]['danwei'];
			$data['tidanshu6'] = $kuanhaos[5]['tidanshu'];
			$data['qingdianshu6'] = $kuanhaos[5]['qingdianshu'];
			$data['yangzhishi6'] = $kuanhaos[5]['yangzhishi'];
			$data['shiji6'] = $kuanhaos[5]['shiji'];
			$data['sunhao6'] = $kuanhaos[5]['sunhao'];
			$data['jianshu6'] = $kuanhaos[5]['jianshu'];
			$data['sunhaoyongliang6'] = $kuanhaos[5]['sunhaoyongliang'];
			$data['daoliaori6'] = $kuanhaos[5]['daoliaori'];
		}
		if (!empty($kuanhaos[6]['pinming'])) {
			$data['pinming7'] = $kuanhaos[6]['pinming'];
			$data['pinfan7'] = $kuanhaos[6]['pinfan'];
			$data['sehao7'] = $kuanhaos[6]['sehao'];
			$data['guige7'] = $kuanhaos[6]['guige'];
			$data['danwei7'] = $kuanhaos[6]['danwei'];
			$data['tidanshu7'] = $kuanhaos[6]['tidanshu'];
			$data['qingdianshu7'] = $kuanhaos[6]['qingdianshu'];
			$data['yangzhishi7'] = $kuanhaos[6]['yangzhishi'];
			$data['shiji7'] = $kuanhaos[6]['shiji'];
			$data['sunhao7'] = $kuanhaos[6]['sunhao'];
			$data['jianshu7'] = $kuanhaos[6]['jianshu'];
			$data['sunhaoyongliang7'] = $kuanhaos[6]['sunhaoyongliang'];
			$data['daoliaori7'] = $kuanhaos[6]['daoliaori'];
		}
		if (!empty($kuanhaos[7]['pinming'])) {
			$data['pinming8'] = $kuanhaos[7]['pinming'];
			$data['pinfan8'] = $kuanhaos[7]['pinfan'];
			$data['sehao8'] = $kuanhaos[7]['sehao'];
			$data['guige8'] = $kuanhaos[7]['guige'];
			$data['danwei8'] = $kuanhaos[7]['danwei'];
			$data['tidanshu8'] = $kuanhaos[7]['tidanshu'];
			$data['qingdianshu8'] = $kuanhaos[7]['qingdianshu'];
			$data['yangzhishi8'] = $kuanhaos[7]['yangzhishi'];
			$data['shiji8'] = $kuanhaos[7]['shiji'];
			$data['sunhao8'] = $kuanhaos[7]['sunhao'];
			$data['jianshu8'] = $kuanhaos[7]['jianshu'];
			$data['sunhaoyongliang8'] = $kuanhaos[7]['sunhaoyongliang'];
			$data['daoliaori8'] = $kuanhaos[7]['daoliaori'];
		}
		if (!empty($kuanhaos[8]['pinming'])) {
			$data['pinming9'] = $kuanhaos[8]['pinming'];
			$data['pinfan9'] = $kuanhaos[8]['pinfan'];
			$data['sehao9'] = $kuanhaos[8]['sehao'];
			$data['guige9'] = $kuanhaos[8]['guige'];
			$data['danwei9'] = $kuanhaos[8]['danwei'];
			$data['tidanshu9'] = $kuanhaos[8]['tidanshu'];
			$data['qingdianshu9'] = $kuanhaos[8]['qingdianshu'];
			$data['yangzhishi9'] = $kuanhaos[8]['yangzhishi'];
			$data['shiji9'] = $kuanhaos[8]['shiji'];
			$data['sunhao9'] = $kuanhaos[8]['sunhao'];
			$data['jianshu9'] = $kuanhaos[8]['jianshu'];
			$data['sunhaoyongliang9'] = $kuanhaos[8]['sunhaoyongliang'];
			$data['daoliaori9'] = $kuanhaos[8]['daoliaori'];
		}
		if (!empty($kuanhaos[9]['pinming'])) {
			$data['pinming10'] = $kuanhaos[9]['pinming'];
			$data['pinfan10'] = $kuanhaos[9]['pinfan'];
			$data['sehao10'] = $kuanhaos[9]['sehao'];
			$data['guige10'] = $kuanhaos[9]['guige'];
			$data['danwei10'] = $kuanhaos[9]['danwei'];
			$data['tidanshu10'] = $kuanhaos[9]['tidanshu'];
			$data['qingdianshu10'] = $kuanhaos[9]['qingdianshu'];
			$data['yangzhishi10'] = $kuanhaos[9]['yangzhishi'];
			$data['shiji10'] = $kuanhaos[9]['shiji'];
			$data['sunhao10'] = $kuanhaos[9]['sunhao'];
			$data['jianshu10'] = $kuanhaos[9]['jianshu'];
			$data['sunhaoyongliang10'] = $kuanhaos[9]['sunhaoyongliang'];
			$data['daoliaori10'] = $kuanhaos[9]['daoliaori'];
		}
		$this->display("goods/goods_edit_new2", $data);
	}
	public function goods_add_new22()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$data['id'] = $id;
		$this->display("goods/goods_add_new22", $data);
	}
	public function goods_edit_new22()
	{
		$kuanhao = isset($_GET['kuanhao']) ? $_GET['kuanhao'] : "";

		$data = array();
		$data['kuanhao'] = $kuanhao;
		$kuanhaos = $this->task->gettidlistpinming($kuanhao);

		$data['list'] = $kuanhaos;
		$this->display("goods/goods_edit_new22", $data);
	}
	public function goods_list_yuan()
	{
		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage($gname);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew($page, $gname);
		foreach ($list as $k=>$v){
			$list[$k]['kuanhaoshu'] = $this->role->getgoodsAllNewcount($v['id']);
		}
		$data["gname"] = $gname;
		$data["list"] = $list;
		$this->display("goods/goods_list_yuan", $data);
	}
	public function goods_list_bao()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage($gname);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["id"] = $id;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew($page, $gname);
		foreach ($list as $k=>$v){
			$list[$k]['kuanhaoshu'] = $this->role->getgoodsAllNewcount($v['id']);
		}
		$data["gname"] = $gname;
		$data["list"] = $list;
		$this->display("goods/goods_list_bao", $data);
	}
	public function goods_list_yu()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$btype = isset($_GET['btype']) ? $_GET['btype'] : 1;
		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage1($gname,$id);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page,$allpage,$_GET);
		$data["page"] = $page;
		$data["id"] = $id;
		$data["shenheflg"] = 2;
		if($_SESSION['rid'] == 1 || $_SESSION['rid'] == 18){
			$data["shenheflg"] = 1;
		}
		$data["btype"] = $btype;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew1($page,$gname,$id);
		$data["gname"] = $gname;
		$sunhao = 1.03;
		foreach ($list as $k => $v) {
			if ($btype == 1){
				$guiges = $this->task->gettidlistjichu($v['id']);
			}else{
				$guiges = $this->task->gettidlistjichujue($v['id']);
			}

			$list[$k]['kehuming'] = empty($guiges[0]['kehuming'])?'暂无数据':$guiges[0]['kehuming'];
			$list[$k]['shengcanshuliang'] = empty($guiges[0]['shengcanshuliang'])?'暂无数据':$guiges[0]['shengcanshuliang'];
			$list[$k]['addtime'] = empty($guiges[0]['addtime'])?'':$guiges[0]['addtime'];
			if (!empty($guiges)) {
				$list[$k]['openflg'] = 1;
				$list[$k]['status1'] = $guiges[0]['status'];
				$list[$k]['state1'] = $guiges[0]['state'];
				$a = empty($guiges[0]['jiagongfeidanjia'])?0:$guiges[0]['jiagongfeidanjia']*$guiges[0]['jiagongfeiyongliang'];
				$a1 = empty($guiges[0]['ercijiagongfeidanjia'])?0:$guiges[0]['ercijiagongfeidanjia']*$guiges[0]['ercijiagongfeiyongliang'];
				$a2 = empty($guiges[0]['jianpinfeidanjia'])?0:$guiges[0]['jianpinfeidanjia']*$guiges[0]['jianpinfeiyongliang'];
				$a3 = empty($guiges[0]['tongguanfeidanjia'])?0:$guiges[0]['tongguanfeidanjia']*$guiges[0]['tongguanfeiyongliang'];
				$a4 = empty($guiges[0]['mianliaojiancedanjia'])?0:$guiges[0]['mianliaojiancedanjia']*$guiges[0]['mianliaojianceyongliang'];
				$a5 = empty($guiges[0]['yunfeidanjia'])?0:$guiges[0]['yunfeidanjia']*$guiges[0]['yunfeiyongliang'];
				$a6 = empty($guiges[0]['qitadanjia'])?0:$guiges[0]['qitadanjia']*$guiges[0]['qitayongliang'];
				$q = $a + $a1 + $a2 + $a3 + $a4 + $a5 + $a6;
			} else {
				$list[$k]['openflg'] = 0;
				$list[$k]['status1'] = 999;
				$list[$k]['state1'] = 999;
				$q = 0;
			}
			if ($btype == 1){
				$pinmings = $this->task->gettidlistxiangmu($v['id']);
			}else{
				$pinmings = $this->task->gettidlistxiangmujue($v['id']);
			}
			$q1 = 0;
			if (!empty($pinmings)) {
				$list[$k]['openflg1'] = 1;
				$list[$k]['status2'] = $pinmings[0]['status'];
				$list[$k]['state2'] = $pinmings[0]['state'];
				foreach ($pinmings as $kk=>$vv){
					$q1 = $q1 + $vv['jine'];
				}
				$list[$k]['feiyong'] = $q1*$sunhao+$q;
			} else {
				$list[$k]['openflg1'] = 0;
				$list[$k]['status2'] = 888;
				$list[$k]['state2'] = 888;
				$list[$k]['feiyong'] = 0;
			}
		}
		foreach ($list as $kk=>$vv){
			$flg1 = 0;
			$flg2 = 0;
			$kid = $vv['id'];
			//预算表数据获取
			$listone1 = $this->role->getgoodsByIdxiaojiejeiduibi($kid);
			$listone2 = $this->role->getgoodsByIdxiaojiejeiduibi1($kid);
			if (!empty($listone1) || !empty($listone2)){
				$flg1 = 1;
			}
			//决算表数据获取
			$listone11 = $this->role->getgoodsByIdxiaojiejeiduibi11($kid);
			$listone22 = $this->role->getgoodsByIdxiaojiejeiduibi22($kid);
			if (!empty($listone11) || !empty($listone22)){
				$flg2 = 1;
			}
			if ($flg1 == 1 && $flg2 == 1){
				$list[$kk]['duibiflg'] = 1;
			}else{
				$list[$kk]['duibiflg'] = 0;
			}
		}
		$data["list"] = $list;
		$this->display("goods/goods_list_yu", $data);
	}
	public function goods_list_shenhe()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$btype = isset($_GET['btype']) ? $_GET['btype'] : 1;
		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage1($gname,$id);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page,$allpage,$_GET);
		$data["page"] = $page;
		$data["id"] = $id;
		$data["shenheflg"] = 2;
		if($_SESSION['rid'] == 1 || $_SESSION['rid'] == 18){
			$data["shenheflg"] = 1;
		}
		$data["btype"] = $btype;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew1($page,$gname,$id);
		$data["gname"] = $gname;
		$sunhao = 1.03;
		foreach ($list as $k => $v) {
			if ($btype == 1){
				$guiges = $this->task->gettidlistjichu($v['id']);
			}else{
				$guiges = $this->task->gettidlistjichujue($v['id']);
			}

			$list[$k]['kehuming'] = empty($guiges[0]['kehuming'])?'暂无数据':$guiges[0]['kehuming'];
			$list[$k]['shengcanshuliang'] = empty($guiges[0]['shengcanshuliang'])?'暂无数据':$guiges[0]['shengcanshuliang'];
			$list[$k]['addtime'] = empty($guiges[0]['addtime'])?'':$guiges[0]['addtime'];
			if (!empty($guiges)) {
				$list[$k]['openflg'] = 1;
				$list[$k]['status1'] = $guiges[0]['status'];
				$list[$k]['state1'] = $guiges[0]['state'];
				$a = empty($guiges[0]['jiagongfeidanjia'])?0:$guiges[0]['jiagongfeidanjia']*$guiges[0]['jiagongfeiyongliang'];
				$a1 = empty($guiges[0]['ercijiagongfeidanjia'])?0:$guiges[0]['ercijiagongfeidanjia']*$guiges[0]['ercijiagongfeiyongliang'];
				$a2 = empty($guiges[0]['jianpinfeidanjia'])?0:$guiges[0]['jianpinfeidanjia']*$guiges[0]['jianpinfeiyongliang'];
				$a3 = empty($guiges[0]['tongguanfeidanjia'])?0:$guiges[0]['tongguanfeidanjia']*$guiges[0]['tongguanfeiyongliang'];
				$a4 = empty($guiges[0]['mianliaojiancedanjia'])?0:$guiges[0]['mianliaojiancedanjia']*$guiges[0]['mianliaojianceyongliang'];
				$a5 = empty($guiges[0]['yunfeidanjia'])?0:$guiges[0]['yunfeidanjia']*$guiges[0]['yunfeiyongliang'];
				$a6 = empty($guiges[0]['qitadanjia'])?0:$guiges[0]['qitadanjia']*$guiges[0]['qitayongliang'];
				$q = $a + $a1 + $a2 + $a3 + $a4 + $a5 + $a6;
			} else {
				$list[$k]['openflg'] = 0;
				$list[$k]['status1'] = 999;
				$list[$k]['state1'] = 999;
				$q = 0;
			}
			if ($btype == 1){
				$pinmings = $this->task->gettidlistxiangmu($v['id']);
			}else{
				$pinmings = $this->task->gettidlistxiangmujue($v['id']);
			}
			$q1 = 0;
			if (!empty($pinmings)) {
				$list[$k]['openflg1'] = 1;
				$list[$k]['status2'] = $pinmings[0]['status'];
				$list[$k]['state2'] = $pinmings[0]['state'];
				foreach ($pinmings as $kk=>$vv){
					$q1 = $q1 + $vv['jine'];
				}
				$list[$k]['feiyong'] = $q1*$sunhao+$q;
			} else {
				$list[$k]['openflg1'] = 0;
				$list[$k]['status2'] = 888;
				$list[$k]['state2'] = 888;
				$list[$k]['feiyong'] = 0;
			}
		}
		$data["list"] = $list;
		$this->display("goods/goods_list_shenhe", $data);
	}
	public function goods_add_jichufei()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$btype = isset($_GET['btype']) ? $_GET['btype'] : 1;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$data = array();
		$data['id'] = $id;
		$data['btype'] = $btype;
		$tidlist = $this->task->gettidlist();
		$data['tidlist'] = $tidlist;
		$this->display("goods/goods_add_jichufei", $data);
	}
	public function goods_save_jichufei()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$add_time = time();
		$kid = isset($_POST["id"]) ? $_POST["id"] : '';
		$btype = isset($_POST["btype"]) ? $_POST["btype"] : '';
		$kehuming = isset($_POST["kehuming"]) ? $_POST["kehuming"] : '';
		$riqi = isset($_POST["riqi"]) ? $_POST["riqi"] : '';
		$riqi = strtotime($riqi);
		$shengcanshuliang = isset($_POST["shengcanshuliang"]) ? $_POST["shengcanshuliang"] : '';
		$sunhao = isset($_POST["sunhao"]) ? $_POST["sunhao"] : '';
		$xiaoji = isset($_POST["xiaoji"]) ? $_POST["xiaoji"] : '';
		$jiagongfeidanjia = isset($_POST["jiagongfeidanjia"]) ? $_POST["jiagongfeidanjia"] : '';
		$jiagongfeiyongliang = isset($_POST["jiagongfeiyongliang"]) ? $_POST["jiagongfeiyongliang"] : '';
		$ercijiagongfeidanjia = isset($_POST["ercijiagongfeidanjia"]) ? $_POST["ercijiagongfeidanjia"] : '';
		$ercijiagongfeiyongliang = isset($_POST["ercijiagongfeiyongliang"]) ? $_POST["ercijiagongfeiyongliang"] : '';
		$jianpinfeidanjia = isset($_POST["jianpinfeidanjia"]) ? $_POST["jianpinfeidanjia"] : '';
		$jianpinfeiyongliang = isset($_POST["jianpinfeiyongliang"]) ? $_POST["jianpinfeiyongliang"] : '';
		$tongguanfeidanjia = isset($_POST["tongguanfeidanjia"]) ? $_POST["tongguanfeidanjia"] : '';
		$tongguanfeiyongliang = isset($_POST["tongguanfeiyongliang"]) ? $_POST["tongguanfeiyongliang"] : '';
		$mianliaojiancedanjia = isset($_POST["mianliaojiancedanjia"]) ? $_POST["mianliaojiancedanjia"] : '';
		$mianliaojianceyongliang = isset($_POST["mianliaojianceyongliang"]) ? $_POST["mianliaojianceyongliang"] : '';
		$yunfeidanjia = isset($_POST["yunfeidanjia"]) ? $_POST["yunfeidanjia"] : '';
		$yunfeiyongliang = isset($_POST["yunfeiyongliang"]) ? $_POST["yunfeiyongliang"] : '';
		$qitadanjia = isset($_POST["qitadanjia"]) ? $_POST["qitadanjia"] : '';
		$qitayongliang = isset($_POST["qitayongliang"]) ? $_POST["qitayongliang"] : '';
		$status = isset($_POST["status"]) ? $_POST["status"] : 1;
		$state = isset($_POST["state"]) ? $_POST["state"] : 4;
		if ($btype == 1){
			$rid = $this->role->role_save_yusuan($kid,$kehuming,$riqi,$shengcanshuliang,$sunhao,$xiaoji,$jiagongfeidanjia,$jiagongfeiyongliang,$ercijiagongfeidanjia,$ercijiagongfeiyongliang,$jianpinfeidanjia,$jianpinfeiyongliang,$tongguanfeidanjia,$tongguanfeiyongliang,$mianliaojiancedanjia,$mianliaojianceyongliang,$yunfeidanjia,$yunfeiyongliang,$qitadanjia,$qitayongliang,$add_time,$status,$state);
		}else{
			$rid = $this->role->role_save_yusuanjue($kid,$kehuming,$riqi,$shengcanshuliang,$sunhao,$xiaoji,$jiagongfeidanjia,$jiagongfeiyongliang,$ercijiagongfeidanjia,$ercijiagongfeiyongliang,$jianpinfeidanjia,$jianpinfeiyongliang,$tongguanfeidanjia,$tongguanfeiyongliang,$mianliaojiancedanjia,$mianliaojianceyongliang,$yunfeidanjia,$yunfeiyongliang,$qitadanjia,$qitayongliang,$add_time,$status,$state);
		}

		if ($rid) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
		}
	}
	public function goods_edit_jichufei()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$btype = isset($_GET['btype']) ? $_GET['btype'] : 1;
		if ($btype == 1 || $btype == 3){
			$goods_info = $this->role->getgoodsByIdxiaojiejei($id);
		}
        if ($btype == 2 || $btype == 4){
			$goods_info = $this->role->getgoodsByIdxiaojiejeijue($id);
		}
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$tidlist = $this->task->gettidlist();
		$data = array();
		$data['id'] = $id;
		$data['btype'] = $btype;
		$data['kehuming'] = $goods_info['kehuming'];
		$data['riqi'] = $goods_info['riqi'];
		$data['shengcanshuliang'] = $goods_info['shengcanshuliang'];
		$data['sunhao'] = $goods_info['sunhao'];
		$data['xiaoji'] = $goods_info['xiaoji'];
		$data['jiagongfeidanjia'] = $goods_info['jiagongfeidanjia'];
		$data['jiagongfeiyongliang'] = $goods_info['jiagongfeiyongliang'];
		$data['ercijiagongfeidanjia'] = $goods_info['ercijiagongfeidanjia'];
		$data['ercijiagongfeiyongliang'] = $goods_info['ercijiagongfeiyongliang'];
		$data['jianpinfeidanjia'] = $goods_info['jianpinfeidanjia'];
		$data['jianpinfeiyongliang'] = $goods_info['jianpinfeiyongliang'];
		$data['tongguanfeidanjia'] = $goods_info['tongguanfeidanjia'];
		$data['tongguanfeiyongliang'] = $goods_info['tongguanfeiyongliang'];
		$data['mianliaojiancedanjia'] = $goods_info['mianliaojiancedanjia'];
		$data['mianliaojianceyongliang'] = $goods_info['mianliaojianceyongliang'];
		$data['yunfeidanjia'] = $goods_info['yunfeidanjia'];
		$data['yunfeiyongliang'] = $goods_info['yunfeiyongliang'];
		$data['qitadanjia'] = $goods_info['qitadanjia'];
		$data['qitayongliang'] = $goods_info['qitayongliang'];
        $data['infomation'] = $goods_info['infomation'];
		$data['tidlist'] = $tidlist;

		$this->display("goods/goods_edit_jichufei", $data);
	}
	public function goods_save_jichufei_edit()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$add_time = time();
		$kid = isset($_POST["id"]) ? $_POST["id"] : '';
		$btype = isset($_POST["btype"]) ? $_POST["btype"] : 1;
		$kehuming = isset($_POST["kehuming"]) ? $_POST["kehuming"] : '';
		$riqi = isset($_POST["riqi"]) ? $_POST["riqi"] : '';
		$riqi = strtotime($riqi);
		$shengcanshuliang = isset($_POST["shengcanshuliang"]) ? $_POST["shengcanshuliang"] : '';
		$sunhao = isset($_POST["sunhao"]) ? $_POST["sunhao"] : '';
		$xiaoji = isset($_POST["xiaoji"]) ? $_POST["xiaoji"] : '';
		$jiagongfeidanjia = isset($_POST["jiagongfeidanjia"]) ? $_POST["jiagongfeidanjia"] : '';
		$jiagongfeiyongliang = isset($_POST["jiagongfeiyongliang"]) ? $_POST["jiagongfeiyongliang"] : '';
		$ercijiagongfeidanjia = isset($_POST["ercijiagongfeidanjia"]) ? $_POST["ercijiagongfeidanjia"] : '';
		$ercijiagongfeiyongliang = isset($_POST["ercijiagongfeiyongliang"]) ? $_POST["ercijiagongfeiyongliang"] : '';
		$jianpinfeidanjia = isset($_POST["jianpinfeidanjia"]) ? $_POST["jianpinfeidanjia"] : '';
		$jianpinfeiyongliang = isset($_POST["jianpinfeiyongliang"]) ? $_POST["jianpinfeiyongliang"] : '';
		$tongguanfeidanjia = isset($_POST["tongguanfeidanjia"]) ? $_POST["tongguanfeidanjia"] : '';
		$tongguanfeiyongliang = isset($_POST["tongguanfeiyongliang"]) ? $_POST["tongguanfeiyongliang"] : '';
		$mianliaojiancedanjia = isset($_POST["mianliaojiancedanjia"]) ? $_POST["mianliaojiancedanjia"] : '';
		$mianliaojianceyongliang = isset($_POST["mianliaojianceyongliang"]) ? $_POST["mianliaojianceyongliang"] : '';
		$yunfeidanjia = isset($_POST["yunfeidanjia"]) ? $_POST["yunfeidanjia"] : '';
		$yunfeiyongliang = isset($_POST["yunfeiyongliang"]) ? $_POST["yunfeiyongliang"] : '';
		$qitadanjia = isset($_POST["qitadanjia"]) ? $_POST["qitadanjia"] : '';
		$qitayongliang = isset($_POST["qitayongliang"]) ? $_POST["qitayongliang"] : '';
		$infomation = isset($_POST["infomation"]) ? $_POST["infomation"] : '';
        $status = isset($_POST["status"]) ? $_POST["status"] : 1;
		$state = isset($_POST["state"]) ? $_POST["state"] : 4;
		if($state == 1 || $state == 4){
			$infomation = "";
		}
		if ($btype==1 || $btype==3){
			$result = $this->role->goods_save_edit_yusuan($infomation,$status,$state,$kid,$kehuming,$riqi,$shengcanshuliang,$sunhao,$xiaoji,$jiagongfeidanjia,$jiagongfeiyongliang,$ercijiagongfeidanjia,$ercijiagongfeiyongliang,$jianpinfeidanjia,$jianpinfeiyongliang,$tongguanfeidanjia,$tongguanfeiyongliang,$mianliaojiancedanjia,$mianliaojianceyongliang,$yunfeidanjia,$yunfeiyongliang,$qitadanjia,$qitayongliang,$add_time);
		}else{
			$result = $this->role->goods_save_edit_yusuanjue($infomation,$status,$state,$kid,$kehuming,$riqi,$shengcanshuliang,$sunhao,$xiaoji,$jiagongfeidanjia,$jiagongfeiyongliang,$ercijiagongfeidanjia,$ercijiagongfeiyongliang,$jianpinfeidanjia,$jianpinfeiyongliang,$tongguanfeidanjia,$tongguanfeiyongliang,$mianliaojiancedanjia,$mianliaojianceyongliang,$yunfeidanjia,$yunfeiyongliang,$qitadanjia,$qitayongliang,$add_time);
		}

		if ($result) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
		}
	}
	public function goods_add_jichu()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$data['id'] = $id;
		$btype = isset($_GET['btype']) ? $_GET['btype'] : 1;
		$data['btype'] = $btype;
		$this->display("goods/goods_add_jichu", $data);
	}
	public function goods_save_jichu()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$btype = isset($_POST['btype']) ? $_POST['btype'] : 1;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$goods_info1 = $this->role->getgoodsById($goods_info['xid']);
		$xiangmu = isset($_POST["xiangmu"]) ? $_POST["xiangmu"] : '';
		if (empty($xiangmu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加项目!"));
			return;
		}
		$mingcheng = isset($_POST["mingcheng"]) ? $_POST["mingcheng"] : '';
		if (empty($mingcheng[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加名称!"));
			return;
		}
		$guige = isset($_POST["guige"]) ? $_POST["guige"] : '';
		if (empty($guige[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加规格!"));
			return;
		}
		$danweis = isset($_POST["danwei"]) ? $_POST["danwei"] : '';
		if (empty($danweis[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单位!"));
			return;
		}
		$danjia = isset($_POST["danjia"]) ? $_POST["danjia"] : '';
		if (empty($danjia[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单价!"));
			return;
		}
		$danwei1 = isset($_POST["danwei1"]) ? $_POST["danwei1"] : '';
		if (empty($danwei1[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单位!"));
			return;
		}
		$yongliang = isset($_POST["yongliang"]) ? $_POST["yongliang"] : '';
		if (empty($yongliang[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加用量!"));
			return;
		}
		$danwei2 = isset($_POST["danwei2"]) ? $_POST["danwei2"] : '';
		if (empty($danwei2[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单位!"));
			return;
		}
		$jine = isset($_POST["jine"]) ? $_POST["jine"] : '';
		if (empty($jine[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加金额!"));
			return;
		}
		$danwei3 = isset($_POST["danwei3"]) ? $_POST["danwei3"] : '';
		if (empty($danwei3[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单位!"));
			return;
		}
		$qidingliang = isset($_POST["qidingliang"]) ? $_POST["qidingliang"] : '';
		if (empty($qidingliang[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加起订量!"));
			return;
		}
		$beizhu = isset($_POST["beizhu"]) ? $_POST["beizhu"] : '';
		if (empty($beizhu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加备注!"));
			return;
		}
		$infomation = isset($_POST["infomation"]) ? $_POST["infomation"] : '';
		$status = isset($_POST["status"]) ? $_POST["status"] : 1;
		$state = isset($_POST["state"]) ? $_POST["state"] : 4;
		if($state == 1 || $state == 4){
			$infomation = "";
		}
		$xiaoji = 0;
		foreach ($xiangmu as $k => $v) {
			if (empty($v) || empty($mingcheng[$k]) || empty($guige[$k]) || empty($danweis[$k]) || empty($danjia[$k]) || empty($danwei1[$k]) || empty($yongliang[$k]) || empty($danwei2[$k]) || empty($jine[$k]) || empty($danwei3[$k]) || empty($qidingliang[$k]) || empty($beizhu[$k])) {
				continue;
			}
			if ($btype==1){
				$this->role->role_save_edit_jichu($infomation,$status,$state,$v,$mingcheng[$k],$guige[$k],$danweis[$k],$danjia[$k],$danwei1[$k],$yongliang[$k],$danwei2[$k],$jine[$k],$danwei3[$k],$qidingliang[$k],$beizhu[$k],$id,time());
			}else{
				$this->role->role_save_edit_jichujue($infomation,$status,$state,$v,$mingcheng[$k],$guige[$k],$danweis[$k],$danjia[$k],$danwei1[$k],$yongliang[$k],$danwei2[$k],$jine[$k],$danwei3[$k],$qidingliang[$k],$beizhu[$k],$id,time());
			}
			$xiaoji = $xiaoji + $jine[$k];
		}

		$add_time = time();
		$kid = isset($_POST["id"]) ? $_POST["id"] : '';
		$btype = isset($_POST["btype"]) ? $_POST["btype"] : '';
		$kehuming = $goods_info1['mingcheng'];
		$riqi = $goods_info['addtime'];
		$shengcanshuliang = 100;
		$sunhao = 1.03;
		$name1 = isset($_POST["name1"]) ? $_POST["name1"] : '';
		$jiagongfeidanjia = isset($_POST["jiagongfeidanjia"]) ? $_POST["jiagongfeidanjia"] : '';
		$jiagongfeiyongliang = isset($_POST["jiagongfeiyongliang"]) ? $_POST["jiagongfeiyongliang"] : '';
		$name2 = isset($_POST["name2"]) ? $_POST["name2"] : '';
		$ercijiagongfeidanjia = isset($_POST["ercijiagongfeidanjia"]) ? $_POST["ercijiagongfeidanjia"] : '';
		$ercijiagongfeiyongliang = isset($_POST["ercijiagongfeiyongliang"]) ? $_POST["ercijiagongfeiyongliang"] : '';
		$name3 = isset($_POST["name3"]) ? $_POST["name3"] : '';
		$jianpinfeidanjia = isset($_POST["jianpinfeidanjia"]) ? $_POST["jianpinfeidanjia"] : '';
		$jianpinfeiyongliang = isset($_POST["jianpinfeiyongliang"]) ? $_POST["jianpinfeiyongliang"] : '';
		$name4 = isset($_POST["name4"]) ? $_POST["name4"] : '';
		$tongguanfeidanjia = isset($_POST["tongguanfeidanjia"]) ? $_POST["tongguanfeidanjia"] : '';
		$tongguanfeiyongliang = isset($_POST["tongguanfeiyongliang"]) ? $_POST["tongguanfeiyongliang"] : '';
		$name5 = isset($_POST["name5"]) ? $_POST["name5"] : '';
		$mianliaojiancedanjia = isset($_POST["mianliaojiancedanjia"]) ? $_POST["mianliaojiancedanjia"] : '';
		$mianliaojianceyongliang = isset($_POST["mianliaojianceyongliang"]) ? $_POST["mianliaojianceyongliang"] : '';
		$name6 = isset($_POST["name6"]) ? $_POST["name6"] : '';
		$yunfeidanjia = isset($_POST["yunfeidanjia"]) ? $_POST["yunfeidanjia"] : '';
		$yunfeiyongliang = isset($_POST["yunfeiyongliang"]) ? $_POST["yunfeiyongliang"] : '';
		$name7 = isset($_POST["name7"]) ? $_POST["name7"] : '';
		$qitadanjia = isset($_POST["qitadanjia"]) ? $_POST["qitadanjia"] : '';
		$qitayongliang = isset($_POST["qitayongliang"]) ? $_POST["qitayongliang"] : '';
		if ($btype == 1){
			$this->role->role_save_yusuan($name1,$name2,$name3,$name4,$name5,$name6,$name7,$kid,$kehuming,$riqi,$shengcanshuliang,$sunhao,$xiaoji,$jiagongfeidanjia,$jiagongfeiyongliang,$ercijiagongfeidanjia,$ercijiagongfeiyongliang,$jianpinfeidanjia,$jianpinfeiyongliang,$tongguanfeidanjia,$tongguanfeiyongliang,$mianliaojiancedanjia,$mianliaojianceyongliang,$yunfeidanjia,$yunfeiyongliang,$qitadanjia,$qitayongliang,$add_time,$status,$state);
		}else{
			$this->role->role_save_yusuanjue($name1,$name2,$name3,$name4,$name5,$name6,$name7,$kid,$kehuming,$riqi,$shengcanshuliang,$sunhao,$xiaoji,$jiagongfeidanjia,$jiagongfeiyongliang,$ercijiagongfeidanjia,$ercijiagongfeiyongliang,$jianpinfeidanjia,$jianpinfeiyongliang,$tongguanfeidanjia,$tongguanfeiyongliang,$mianliaojiancedanjia,$mianliaojianceyongliang,$yunfeidanjia,$yunfeiyongliang,$qitadanjia,$qitayongliang,$add_time,$status,$state);
		}

		echo json_encode(array('success' => true, 'msg' => "操作成功。"));
	}
	public function goods_edit_jichu()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$btype = isset($_GET['btype']) ? $_GET['btype'] : 1;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误1"));
			return;
		}
		$data = array();
		$data['id'] = $id;
		$data['btype'] = $btype;
        if ($btype == 1 || $btype == 3 || $btype == 888){
			$kuanhaos = $this->task->gettidlistjichu1($id);
		}
        if ($btype == 2 || $btype == 4 || $btype == 999){
			$kuanhaos = $this->task->gettidlistjichu1jue($id);
		}
		$data['infomation'] = empty($kuanhaos[0]['infomation'])?'':$kuanhaos[0]['infomation'];
		$data['status'] = empty($kuanhaos[0]['status'])?'':$kuanhaos[0]['status'];
		$data['state'] = empty($kuanhaos[0]['state'])?'':$kuanhaos[0]['state'];
		$data['xiangmu1'] = '';
		$data['mingcheng1'] = '';
		$data['guige1'] = '';
		$data['danwei1'] = '';
		$data['danjia1'] = '';
		$data['danwei1_1'] = '';
		$data['yongliang1'] = '';
		$data['danwei2_1'] = '';
		$data['jine1'] = '';
		$data['danwei3_1'] = '';
		$data['qidingliang1'] = '';
		$data['beizhu1'] = '';

		$data['xiangmu2'] = '';
		$data['mingcheng2'] = '';
		$data['guige2'] = '';
		$data['danwei2'] = '';
		$data['danjia2'] = '';
		$data['danwei1_2'] = '';
		$data['yongliang2'] = '';
		$data['danwei2_2'] = '';
		$data['jine2'] = '';
		$data['danwei3_2'] = '';
		$data['qidingliang2'] = '';
		$data['beizhu2'] = '';

		$data['xiangmu3'] = '';
		$data['mingcheng3'] = '';
		$data['guige3'] = '';
		$data['danwei3'] = '';
		$data['danjia3'] = '';
		$data['danwei1_3'] = '';
		$data['yongliang3'] = '';
		$data['danwei2_3'] = '';
		$data['jine3'] = '';
		$data['danwei3_3'] = '';
		$data['qidingliang3'] = '';
		$data['beizhu3'] = '';

		$data['xiangmu4'] = '';
		$data['mingcheng4'] = '';
		$data['guige4'] = '';
		$data['danwei4'] = '';
		$data['danjia4'] = '';
		$data['danwei1_4'] = '';
		$data['yongliang4'] = '';
		$data['danwei2_4'] = '';
		$data['jine4'] = '';
		$data['danwei3_4'] = '';
		$data['qidingliang4'] = '';
		$data['beizhu4'] = '';

		$data['xiangmu5'] = '';
		$data['mingcheng5'] = '';
		$data['guige5'] = '';
		$data['danwei5'] = '';
		$data['danjia5'] = '';
		$data['danwei1_5'] = '';
		$data['yongliang5'] = '';
		$data['danwei2_5'] = '';
		$data['jine5'] = '';
		$data['danwei3_5'] = '';
		$data['qidingliang5'] = '';
		$data['beizhu5'] = '';

		$data['xiangmu6'] = '';
		$data['mingcheng6'] = '';
		$data['guige6'] = '';
		$data['danwei6'] = '';
		$data['danjia6'] = '';
		$data['danwei1_6'] = '';
		$data['yongliang6'] = '';
		$data['danwei2_6'] = '';
		$data['jine6'] = '';
		$data['danwei3_6'] = '';
		$data['qidingliang6'] = '';
		$data['beizhu6'] = '';

		$data['xiangmu7'] = '';
		$data['mingcheng7'] = '';
		$data['guige7'] = '';
		$data['danwei7'] = '';
		$data['danjia7'] = '';
		$data['danwei1_7'] = '';
		$data['yongliang7'] = '';
		$data['danwei2_7'] = '';
		$data['jine7'] = '';
		$data['danwei3_7'] = '';
		$data['qidingliang7'] = '';
		$data['beizhu7'] = '';

		$data['xiangmu8'] = '';
		$data['mingcheng8'] = '';
		$data['guige8'] = '';
		$data['danwei8'] = '';
		$data['danjia8'] = '';
		$data['danwei1_8'] = '';
		$data['yongliang8'] = '';
		$data['danwei2_8'] = '';
		$data['jine8'] = '';
		$data['danwei3_8'] = '';
		$data['qidingliang8'] = '';
		$data['beizhu8'] = '';

		$data['xiangmu9'] = '';
		$data['mingcheng9'] = '';
		$data['guige9'] = '';
		$data['danwei9'] = '';
		$data['danjia9'] = '';
		$data['danwei1_9'] = '';
		$data['yongliang9'] = '';
		$data['danwei2_9'] = '';
		$data['jine9'] = '';
		$data['danwei3_9'] = '';
		$data['qidingliang9'] = '';
		$data['beizhu9'] = '';

		$data['xiangmu10'] = '';
		$data['mingcheng10'] = '';
		$data['guige10'] = '';
		$data['danwei10'] = '';
		$data['danjia10'] = '';
		$data['danwei1_10'] = '';
		$data['yongliang10'] = '';
		$data['danwei2_10'] = '';
		$data['jine10'] = '';
		$data['danwei3_10'] = '';
		$data['qidingliang10'] = '';
		$data['beizhu10'] = '';

		if (!empty($kuanhaos[0]['xiangmu'])) {
			$data['xiangmu1'] = $kuanhaos[0]['xiangmu'];
			$data['mingcheng1'] = $kuanhaos[0]['mingcheng'];
			$data['guige1'] = $kuanhaos[0]['guige'];
			$data['danwei1'] = $kuanhaos[0]['danwei'];
			$data['danjia1'] = $kuanhaos[0]['danjia'];
			$data['danwei1_1'] = $kuanhaos[0]['danwei1'];
			$data['yongliang1'] = $kuanhaos[0]['yongliang'];
			$data['danwei2_1'] = $kuanhaos[0]['danwei2'];
			$data['jine1'] = $kuanhaos[0]['jine'];
			$data['danwei3_1'] = $kuanhaos[0]['danwei3'];
			$data['qidingliang1'] = $kuanhaos[0]['qidingliang'];
			$data['beizhu1'] = $kuanhaos[0]['beizhu'];
		}
		if (!empty($kuanhaos[1]['xiangmu'])) {
			$data['xiangmu2'] = $kuanhaos[1]['xiangmu'];
			$data['mingcheng2'] = $kuanhaos[1]['mingcheng'];
			$data['guige2'] = $kuanhaos[1]['guige'];
			$data['danwei2'] = $kuanhaos[1]['danwei'];
			$data['danjia2'] = $kuanhaos[1]['danjia'];
			$data['danwei1_2'] = $kuanhaos[1]['danwei1'];
			$data['yongliang2'] = $kuanhaos[1]['yongliang'];
			$data['danwei2_2'] = $kuanhaos[1]['danwei2'];
			$data['jine2'] = $kuanhaos[1]['jine'];
			$data['danwei3_2'] = $kuanhaos[1]['danwei3'];
			$data['qidingliang2'] = $kuanhaos[1]['qidingliang'];
			$data['beizhu2'] = $kuanhaos[1]['beizhu'];
		}
		if (!empty($kuanhaos[2]['xiangmu'])) {
			$data['xiangmu3'] = $kuanhaos[2]['xiangmu'];
			$data['mingcheng3'] = $kuanhaos[2]['mingcheng'];
			$data['guige3'] = $kuanhaos[2]['guige'];
			$data['danwei3'] = $kuanhaos[2]['danwei'];
			$data['danjia3'] = $kuanhaos[2]['danjia'];
			$data['danwei1_3'] = $kuanhaos[2]['danwei1'];
			$data['yongliang3'] = $kuanhaos[2]['yongliang'];
			$data['danwei2_3'] = $kuanhaos[2]['danwei2'];
			$data['jine3'] = $kuanhaos[2]['jine'];
			$data['danwei3_3'] = $kuanhaos[2]['danwei3'];
			$data['qidingliang3'] = $kuanhaos[2]['qidingliang'];
			$data['beizhu3'] = $kuanhaos[2]['beizhu'];
		}
		if (!empty($kuanhaos[3]['xiangmu'])) {
			$data['xiangmu4'] = $kuanhaos[3]['xiangmu'];
			$data['mingcheng4'] = $kuanhaos[3]['mingcheng'];
			$data['guige4'] = $kuanhaos[3]['guige'];
			$data['danwei4'] = $kuanhaos[3]['danwei'];
			$data['danjia4'] = $kuanhaos[3]['danjia'];
			$data['danwei1_4'] = $kuanhaos[3]['danwei1'];
			$data['yongliang4'] = $kuanhaos[3]['yongliang'];
			$data['danwei2_4'] = $kuanhaos[3]['danwei2'];
			$data['jine4'] = $kuanhaos[3]['jine'];
			$data['danwei3_4'] = $kuanhaos[3]['danwei3'];
			$data['qidingliang4'] = $kuanhaos[3]['qidingliang'];
			$data['beizhu4'] = $kuanhaos[3]['beizhu'];
		}
		if (!empty($kuanhaos[4]['xiangmu'])) {
			$data['xiangmu5'] = $kuanhaos[4]['xiangmu'];
			$data['mingcheng5'] = $kuanhaos[4]['mingcheng'];
			$data['guige5'] = $kuanhaos[4]['guige'];
			$data['danwei5'] = $kuanhaos[4]['danwei'];
			$data['danjia5'] = $kuanhaos[4]['danjia'];
			$data['danwei1_5'] = $kuanhaos[4]['danwei1'];
			$data['yongliang5'] = $kuanhaos[4]['yongliang'];
			$data['danwei2_5'] = $kuanhaos[4]['danwei2'];
			$data['jine5'] = $kuanhaos[4]['jine'];
			$data['danwei3_5'] = $kuanhaos[4]['danwei3'];
			$data['qidingliang5'] = $kuanhaos[4]['qidingliang'];
			$data['beizhu5'] = $kuanhaos[4]['beizhu'];
		}
		if (!empty($kuanhaos[5]['xiangmu'])) {
			$data['xiangmu6'] = $kuanhaos[5]['xiangmu'];
			$data['mingcheng6'] = $kuanhaos[5]['mingcheng'];
			$data['guige6'] = $kuanhaos[5]['guige'];
			$data['danwei6'] = $kuanhaos[5]['danwei'];
			$data['danjia6'] = $kuanhaos[5]['danjia'];
			$data['danwei1_6'] = $kuanhaos[5]['danwei1'];
			$data['yongliang6'] = $kuanhaos[5]['yongliang'];
			$data['danwei2_6'] = $kuanhaos[5]['danwei2'];
			$data['jine6'] = $kuanhaos[5]['jine'];
			$data['danwei3_6'] = $kuanhaos[5]['danwei3'];
			$data['qidingliang6'] = $kuanhaos[5]['qidingliang'];
			$data['beizhu6'] = $kuanhaos[5]['beizhu'];
		}
		if (!empty($kuanhaos[6]['xiangmu'])) {
			$data['xiangmu7'] = $kuanhaos[6]['xiangmu'];
			$data['mingcheng7'] = $kuanhaos[6]['mingcheng'];
			$data['guige7'] = $kuanhaos[6]['guige'];
			$data['danwei7'] = $kuanhaos[6]['danwei'];
			$data['danjia7'] = $kuanhaos[6]['danjia'];
			$data['danwei1_7'] = $kuanhaos[6]['danwei1'];
			$data['yongliang7'] = $kuanhaos[6]['yongliang'];
			$data['danwei2_7'] = $kuanhaos[6]['danwei2'];
			$data['jine7'] = $kuanhaos[6]['jine'];
			$data['danwei3_7'] = $kuanhaos[6]['danwei3'];
			$data['qidingliang7'] = $kuanhaos[6]['qidingliang'];
			$data['beizhu7'] = $kuanhaos[6]['beizhu'];
		}
		if (!empty($kuanhaos[7]['xiangmu'])) {
			$data['xiangmu8'] = $kuanhaos[7]['xiangmu'];
			$data['mingcheng8'] = $kuanhaos[7]['mingcheng'];
			$data['guige8'] = $kuanhaos[7]['guige'];
			$data['danwei8'] = $kuanhaos[7]['danwei'];
			$data['danjia8'] = $kuanhaos[7]['danjia'];
			$data['danwei1_8'] = $kuanhaos[7]['danwei1'];
			$data['yongliang8'] = $kuanhaos[7]['yongliang'];
			$data['danwei2_8'] = $kuanhaos[7]['danwei2'];
			$data['jine8'] = $kuanhaos[7]['jine'];
			$data['danwei3_8'] = $kuanhaos[7]['danwei3'];
			$data['qidingliang8'] = $kuanhaos[7]['qidingliang'];
			$data['beizhu8'] = $kuanhaos[7]['beizhu'];
		}
		if (!empty($kuanhaos[8]['xiangmu'])) {
			$data['xiangmu9'] = $kuanhaos[8]['xiangmu'];
			$data['mingcheng9'] = $kuanhaos[8]['mingcheng'];
			$data['guige9'] = $kuanhaos[8]['guige'];
			$data['danwei9'] = $kuanhaos[8]['danwei'];
			$data['danjia9'] = $kuanhaos[8]['danjia'];
			$data['danwei1_9'] = $kuanhaos[8]['danwei1'];
			$data['yongliang9'] = $kuanhaos[8]['yongliang'];
			$data['danwei2_9'] = $kuanhaos[8]['danwei2'];
			$data['jine9'] = $kuanhaos[8]['jine'];
			$data['danwei3_9'] = $kuanhaos[8]['danwei3'];
			$data['qidingliang9'] = $kuanhaos[8]['qidingliang'];
			$data['beizhu9'] = $kuanhaos[8]['beizhu'];
		}
		if (!empty($kuanhaos[9]['xiangmu'])) {
			$data['xiangmu10'] = $kuanhaos[9]['xiangmu'];
			$data['mingcheng10'] = $kuanhaos[9]['mingcheng'];
			$data['guige10'] = $kuanhaos[9]['guige'];
			$data['danwei10'] = $kuanhaos[9]['danwei'];
			$data['danjia10'] = $kuanhaos[9]['danjia'];
			$data['danwei1_10'] = $kuanhaos[9]['danwei1'];
			$data['yongliang10'] = $kuanhaos[9]['yongliang'];
			$data['danwei2_10'] = $kuanhaos[9]['danwei2'];
			$data['jine10'] = $kuanhaos[9]['jine'];
			$data['danwei3_10'] = $kuanhaos[9]['danwei3'];
			$data['qidingliang10'] = $kuanhaos[9]['qidingliang'];
			$data['beizhu10'] = $kuanhaos[9]['beizhu'];
		}

		if ($btype == 1 || $btype == 3 || $btype == 888){
			$goods_info = $this->role->getgoodsByIdxiaojiejei($id);
		}
		if ($btype == 2 || $btype == 4 || $btype == 999){
			$goods_info = $this->role->getgoodsByIdxiaojiejeijue($id);
		}
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误2"));
			return;
		}

		$data['kehuming'] = $goods_info['kehuming'];
		$data['riqi'] = $goods_info['riqi'];
		$data['shengcanshuliang'] = $goods_info['shengcanshuliang'];
		$data['sunhao'] = $goods_info['sunhao'];
		$data['xiaoji'] = $goods_info['xiaoji'];
		$data['name1'] = $goods_info['name1'];
		$data['name2'] = $goods_info['name2'];
		$data['name3'] = $goods_info['name3'];
		$data['name4'] = $goods_info['name4'];
		$data['name5'] = $goods_info['name5'];
		$data['name6'] = $goods_info['name6'];
		$data['name7'] = $goods_info['name7'];
		$data['jiagongfeidanjia'] = $goods_info['jiagongfeidanjia'];
		$data['jiagongfeiyongliang'] = $goods_info['jiagongfeiyongliang'];
		$data['ercijiagongfeidanjia'] = $goods_info['ercijiagongfeidanjia'];
		$data['ercijiagongfeiyongliang'] = $goods_info['ercijiagongfeiyongliang'];
		$data['jianpinfeidanjia'] = $goods_info['jianpinfeidanjia'];
		$data['jianpinfeiyongliang'] = $goods_info['jianpinfeiyongliang'];
		$data['tongguanfeidanjia'] = $goods_info['tongguanfeidanjia'];
		$data['tongguanfeiyongliang'] = $goods_info['tongguanfeiyongliang'];
		$data['mianliaojiancedanjia'] = $goods_info['mianliaojiancedanjia'];
		$data['mianliaojianceyongliang'] = $goods_info['mianliaojianceyongliang'];
		$data['yunfeidanjia'] = $goods_info['yunfeidanjia'];
		$data['yunfeiyongliang'] = $goods_info['yunfeiyongliang'];
		$data['qitadanjia'] = $goods_info['qitadanjia'];
		$data['qitayongliang'] = $goods_info['qitayongliang'];

		$this->display("goods/goods_edit_jichu", $data);
	}
	public function goods_save_edit_jichu()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$btype = isset($_POST['btype']) ? $_POST['btype'] : 1;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$goods_info1 = $this->role->getgoodsById($goods_info['xid']);
		$xiangmu = isset($_POST["xiangmu"]) ? $_POST["xiangmu"] : '';
		if (empty($xiangmu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加项目!"));
			return;
		}
		$mingcheng = isset($_POST["mingcheng"]) ? $_POST["mingcheng"] : '';
		if (empty($mingcheng[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加名称!"));
			return;
		}
		$guige = isset($_POST["guige"]) ? $_POST["guige"] : '';
		if (empty($guige[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加规格!"));
			return;
		}
		$danweis = isset($_POST["danwei"]) ? $_POST["danwei"] : '';
		if (empty($danweis[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单位!"));
			return;
		}
		$danjia = isset($_POST["danjia"]) ? $_POST["danjia"] : '';
		if (empty($danjia[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单价!"));
			return;
		}
		$danwei1 = isset($_POST["danwei1"]) ? $_POST["danwei1"] : '';
		if (empty($danwei1[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单位!"));
			return;
		}
		$yongliang = isset($_POST["yongliang"]) ? $_POST["yongliang"] : '';
		if (empty($yongliang[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加用量!"));
			return;
		}
		$danwei2 = isset($_POST["danwei2"]) ? $_POST["danwei2"] : '';
		if (empty($danwei2[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单位!"));
			return;
		}
		$jine = isset($_POST["jine"]) ? $_POST["jine"] : '';
		if (empty($jine[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加金额!"));
			return;
		}
		$danwei3 = isset($_POST["danwei3"]) ? $_POST["danwei3"] : '';
		if (empty($danwei3[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单位!"));
			return;
		}
		$qidingliang = isset($_POST["qidingliang"]) ? $_POST["qidingliang"] : '';
		if (empty($qidingliang[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加起订量!"));
			return;
		}
		$beizhu = isset($_POST["beizhu"]) ? $_POST["beizhu"] : '';
		if (empty($beizhu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加备注!"));
			return;
		}
		$infomation = isset($_POST["infomation"]) ? $_POST["infomation"] : '';
		$status = isset($_POST["status"]) ? $_POST["status"] : 1;
		$state = isset($_POST["state"]) ? $_POST["state"] : 4;
		if($state == 1 || $state == 4){
			$infomation = "";
		}
		if ($btype==1 || $btype==3 || $btype==888){
			$this->role->goodsimg_delete_jichu($id);
		}else{
			$this->role->goodsimg_delete_jichujue($id);
		}
		$xiaoji = 0;
		foreach ($xiangmu as $k => $v) {
			if (empty($v) || empty($mingcheng[$k]) || empty($guige[$k]) || empty($danweis[$k]) || empty($danjia[$k]) || empty($danwei1[$k]) || empty($yongliang[$k]) || empty($danwei2[$k]) || empty($jine[$k]) || empty($danwei3[$k]) || empty($qidingliang[$k]) || empty($beizhu[$k])) {
				continue;
			}
			if ($btype==1 || $btype==3 || $btype==888){
				$this->role->role_save_edit_jichu($infomation,$status,$state,$v,$mingcheng[$k],$guige[$k],$danweis[$k],$danjia[$k],$danwei1[$k],$yongliang[$k],$danwei2[$k],$jine[$k],$danwei3[$k],$qidingliang[$k],$beizhu[$k],$id,time());
			}else{
				$this->role->role_save_edit_jichujue($infomation,$status,$state,$v,$mingcheng[$k],$guige[$k],$danweis[$k],$danjia[$k],$danwei1[$k],$yongliang[$k],$danwei2[$k],$jine[$k],$danwei3[$k],$qidingliang[$k],$beizhu[$k],$id,time());
			}
			$xiaoji = $xiaoji + $jine[$k];
		}

		$add_time = time();
		$kid = isset($_POST["id"]) ? $_POST["id"] : '';
		$btype = isset($_POST["btype"]) ? $_POST["btype"] : '';
		$kehuming = $goods_info1['mingcheng'];
		$riqi = $goods_info['addtime'];
		$shengcanshuliang = 100;
		$sunhao = 1.03;
		$name1 = isset($_POST["name1"]) ? $_POST["name1"] : '';
		$jiagongfeidanjia = isset($_POST["jiagongfeidanjia"]) ? $_POST["jiagongfeidanjia"] : '';
		$jiagongfeiyongliang = isset($_POST["jiagongfeiyongliang"]) ? $_POST["jiagongfeiyongliang"] : '';
		$name2 = isset($_POST["name2"]) ? $_POST["name2"] : '';
		$ercijiagongfeidanjia = isset($_POST["ercijiagongfeidanjia"]) ? $_POST["ercijiagongfeidanjia"] : '';
		$ercijiagongfeiyongliang = isset($_POST["ercijiagongfeiyongliang"]) ? $_POST["ercijiagongfeiyongliang"] : '';
		$name3 = isset($_POST["name3"]) ? $_POST["name3"] : '';
		$jianpinfeidanjia = isset($_POST["jianpinfeidanjia"]) ? $_POST["jianpinfeidanjia"] : '';
		$jianpinfeiyongliang = isset($_POST["jianpinfeiyongliang"]) ? $_POST["jianpinfeiyongliang"] : '';
		$name4 = isset($_POST["name4"]) ? $_POST["name4"] : '';
		$tongguanfeidanjia = isset($_POST["tongguanfeidanjia"]) ? $_POST["tongguanfeidanjia"] : '';
		$tongguanfeiyongliang = isset($_POST["tongguanfeiyongliang"]) ? $_POST["tongguanfeiyongliang"] : '';
		$name5 = isset($_POST["name5"]) ? $_POST["name5"] : '';
		$mianliaojiancedanjia = isset($_POST["mianliaojiancedanjia"]) ? $_POST["mianliaojiancedanjia"] : '';
		$mianliaojianceyongliang = isset($_POST["mianliaojianceyongliang"]) ? $_POST["mianliaojianceyongliang"] : '';
		$name6 = isset($_POST["name6"]) ? $_POST["name6"] : '';
		$yunfeidanjia = isset($_POST["yunfeidanjia"]) ? $_POST["yunfeidanjia"] : '';
		$yunfeiyongliang = isset($_POST["yunfeiyongliang"]) ? $_POST["yunfeiyongliang"] : '';
		$name7 = isset($_POST["name7"]) ? $_POST["name7"] : '';
		$qitadanjia = isset($_POST["qitadanjia"]) ? $_POST["qitadanjia"] : '';
		$qitayongliang = isset($_POST["qitayongliang"]) ? $_POST["qitayongliang"] : '';
		if ($btype==1 || $btype==3 || $btype==888){
			$this->role->goods_save_edit_yusuan($name1,$name2,$name3,$name4,$name5,$name6,$name7,$infomation,$status,$state,$kid,$kehuming,$riqi,$shengcanshuliang,$sunhao,$xiaoji,$jiagongfeidanjia,$jiagongfeiyongliang,$ercijiagongfeidanjia,$ercijiagongfeiyongliang,$jianpinfeidanjia,$jianpinfeiyongliang,$tongguanfeidanjia,$tongguanfeiyongliang,$mianliaojiancedanjia,$mianliaojianceyongliang,$yunfeidanjia,$yunfeiyongliang,$qitadanjia,$qitayongliang,$add_time);
		}else{
			$this->role->goods_save_edit_yusuanjue($name1,$name2,$name3,$name4,$name5,$name6,$name7,$infomation,$status,$state,$kid,$kehuming,$riqi,$shengcanshuliang,$sunhao,$xiaoji,$jiagongfeidanjia,$jiagongfeiyongliang,$ercijiagongfeidanjia,$ercijiagongfeiyongliang,$jianpinfeidanjia,$jianpinfeiyongliang,$tongguanfeidanjia,$tongguanfeiyongliang,$mianliaojiancedanjia,$mianliaojianceyongliang,$yunfeidanjia,$yunfeiyongliang,$qitadanjia,$qitayongliang,$add_time);
		}
		echo json_encode(array('success' => true, 'msg' => "操作成功。"));

	}
	public function goods_list_bao_duibi()
	{
		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage1duibi($gname);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew1duibi($page, $gname);
		$data["gname"] = $gname;
		foreach ($list as $k=>$v){
			$flg1 = 0;
			$flg2 = 0;
			$kid = $v['id'];
			//预算表数据获取
			$listone1 = $this->role->getgoodsByIdxiaojiejeiduibi($kid);
			$listone2 = $this->role->getgoodsByIdxiaojiejeiduibi1($kid);
			if (!empty($listone1) || !empty($listone2)){
				$flg1 = 1;
			}
			//决算表数据获取
			$listone11 = $this->role->getgoodsByIdxiaojiejeiduibi11($kid);
			$listone22 = $this->role->getgoodsByIdxiaojiejeiduibi22($kid);
			if (!empty($listone11) || !empty($listone22)){
				$flg2 = 1;
			}
			if ($flg1 == 1 && $flg2 == 1){
				$list[$k]['duibiflg'] = 1;
			}else{
				$list[$k]['duibiflg'] = 0;
			}
		}
		$data["list"] = $list;
		$this->display("goods/goods_list_bao_duibi", $data);
	}
	public function goods_list_bao_duibi_details()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;

		$goods_info_yusuan = $this->role->getgoodsByIdxiaojiejei($id);
		$goods_info_juesuan = $this->role->getgoodsByIdxiaojiejeijue($id);

		$data = array();
//		$data['kehumingy'] = $goods_info_yusuan['kehuming'];
//		$data['riqiy'] = $goods_info_yusuan['riqi'];
//		$data['shengcanshuliangy'] = $goods_info_yusuan['shengcanshuliang'];
//		$data['sunhaoy'] = $goods_info_yusuan['sunhao'];
//		$data['xiaojiy'] = $goods_info_yusuan['xiaoji'];
		$data['name1y'] = $goods_info_yusuan['name1'];
		$data['name2y'] = $goods_info_yusuan['name2'];
		$data['name3y'] = $goods_info_yusuan['name3'];
		$data['name4y'] = $goods_info_yusuan['name4'];
		$data['name5y'] = $goods_info_yusuan['name5'];
		$data['name6y'] = $goods_info_yusuan['name6'];
		$data['name7y'] = $goods_info_yusuan['name7'];
		$data['jiagongfeidanjiay'] = $goods_info_yusuan['jiagongfeidanjia'];
		$data['jiagongfeiyongliangy'] = $goods_info_yusuan['jiagongfeiyongliang'];
		$data['ercijiagongfeidanjiay'] = $goods_info_yusuan['ercijiagongfeidanjia'];
		$data['ercijiagongfeiyongliangy'] = $goods_info_yusuan['ercijiagongfeiyongliang'];
		$data['jianpinfeidanjiay'] = $goods_info_yusuan['jianpinfeidanjia'];
		$data['jianpinfeiyongliangy'] = $goods_info_yusuan['jianpinfeiyongliang'];
		$data['tongguanfeidanjiay'] = $goods_info_yusuan['tongguanfeidanjia'];
		$data['tongguanfeiyongliangy'] = $goods_info_yusuan['tongguanfeiyongliang'];
		$data['mianliaojiancedanjiay'] = $goods_info_yusuan['mianliaojiancedanjia'];
		$data['mianliaojianceyongliangy'] = $goods_info_yusuan['mianliaojianceyongliang'];
		$data['yunfeidanjiay'] = $goods_info_yusuan['yunfeidanjia'];
		$data['yunfeiyongliangy'] = $goods_info_yusuan['yunfeiyongliang'];
		$data['qitadanjiay'] = $goods_info_yusuan['qitadanjia'];
		$data['qitayongliangy'] = $goods_info_yusuan['qitayongliang'];

//		$data['kehumingj'] = $goods_info_juesuan['kehuming'];
//		$data['riqij'] = $goods_info_juesuan['riqi'];
//		$data['shengcanshuliangj'] = $goods_info_juesuan['shengcanshuliang'];
//		$data['sunhaoj'] = $goods_info_juesuan['sunhao'];
//		$data['xiaojij'] = $goods_info_juesuan['xiaoji'];
		$data['name1j'] = $goods_info_juesuan['name1'];
		$data['name2j'] = $goods_info_juesuan['name2'];
		$data['name3j'] = $goods_info_juesuan['name3'];
		$data['name4j'] = $goods_info_juesuan['name4'];
		$data['name5j'] = $goods_info_juesuan['name5'];
		$data['name6j'] = $goods_info_juesuan['name6'];
		$data['name7j'] = $goods_info_juesuan['name7'];
		$data['jiagongfeidanjiaj'] = $goods_info_juesuan['jiagongfeidanjia'];
		$data['jiagongfeiyongliangj'] = $goods_info_juesuan['jiagongfeiyongliang'];
		$data['ercijiagongfeidanjiaj'] = $goods_info_juesuan['ercijiagongfeidanjia'];
		$data['ercijiagongfeiyongliangj'] = $goods_info_juesuan['ercijiagongfeiyongliang'];
		$data['jianpinfeidanjiaj'] = $goods_info_juesuan['jianpinfeidanjia'];
		$data['jianpinfeiyongliangj'] = $goods_info_juesuan['jianpinfeiyongliang'];
		$data['tongguanfeidanjiaj'] = $goods_info_juesuan['tongguanfeidanjia'];
		$data['tongguanfeiyongliangj'] = $goods_info_juesuan['tongguanfeiyongliang'];
		$data['mianliaojiancedanjiaj'] = $goods_info_juesuan['mianliaojiancedanjia'];
		$data['mianliaojianceyongliangj'] = $goods_info_juesuan['mianliaojianceyongliang'];
		$data['yunfeidanjiaj'] = $goods_info_juesuan['yunfeidanjia'];
		$data['yunfeiyongliangj'] = $goods_info_juesuan['yunfeiyongliang'];
		$data['qitadanjiaj'] = $goods_info_juesuan['qitadanjia'];
		$data['qitayongliangj'] = $goods_info_juesuan['qitayongliang'];


		$data['name1_flg'] = 0;
		if ($data['name1y'] != $data['name1j']){
			$data['name1_flg'] = 1;
		}
		$data['name2_flg'] = 0;
		if ($data['name2y'] != $data['name2j']){
			$data['name2_flg'] = 1;
		}
		$data['name3_flg'] = 0;
		if ($data['name3y'] != $data['name3j']){
			$data['name3_flg'] = 1;
		}
		$data['name4_flg'] = 0;
		if ($data['name4y'] != $data['name4j']){
			$data['name4_flg'] = 1;
		}
		$data['name5_flg'] = 0;
		if ($data['name5y'] != $data['name5j']){
			$data['name5_flg'] = 1;
		}
		$data['name6_flg'] = 0;
		if ($data['name6y'] != $data['name6j']){
			$data['name6_flg'] = 1;
		}
		$data['name7_flg'] = 0;
		if ($data['name7y'] != $data['name7j']){
			$data['name7_flg'] = 1;
		}
		$data['jiagongfeidanjia_flg'] = 0;
		if ($data['jiagongfeidanjiay'] != $data['jiagongfeidanjiaj']){
			$data['jiagongfeidanjia_flg'] = 1;
		}
		$data['jiagongfeiyongliang_flg'] = 0;
		if ($data['jiagongfeiyongliangy'] != $data['jiagongfeiyongliangj']){
			$data['jiagongfeiyongliang_flg'] = 1;
		}
		$data['ercijiagongfeidanjia_flg'] = 0;
		if ($data['ercijiagongfeidanjiaj'] != $data['ercijiagongfeidanjiay']){
			$data['ercijiagongfeidanjia_flg'] = 1;
		}
		$data['ercijiagongfeiyongliang_flg'] = 0;
		if ($data['ercijiagongfeiyongliangj'] != $data['ercijiagongfeiyongliangy']){
			$data['ercijiagongfeiyongliang_flg'] = 1;
		}
		$data['jianpinfeidanjia_flg'] = 0;
		if ($data['jianpinfeidanjiaj'] != $data['jianpinfeidanjiay']){
			$data['jianpinfeidanjia_flg'] = 1;
		}
		$data['jianpinfeiyongliang_flg'] = 0;
		if ($data['jianpinfeiyongliangj'] != $data['jianpinfeiyongliangy']){
			$data['jianpinfeiyongliang_flg'] = 1;
		}
		$data['tongguanfeidanjia_flg'] = 0;
		if ($data['tongguanfeidanjiaj'] != $data['tongguanfeidanjiay']){
			$data['tongguanfeidanjia_flg'] = 1;
		}
		$data['tongguanfeiyongliang_flg'] = 0;
		if ($data['tongguanfeiyongliangj'] != $data['tongguanfeiyongliangy']){
			$data['tongguanfeiyongliang_flg'] = 1;
		}
		$data['mianliaojiancedanjia_flg'] = 0;
		if ($data['mianliaojiancedanjiaj'] != $data['mianliaojiancedanjiay']){
			$data['mianliaojiancedanjia_flg'] = 1;
		}
		$data['mianliaojianceyongliang_flg'] = 0;
		if ($data['mianliaojianceyongliangj'] != $data['mianliaojianceyongliangy']){
			$data['mianliaojianceyongliang_flg'] = 1;
		}
		$data['yunfeidanjia_flg'] = 0;
		if ($data['yunfeidanjiaj'] != $data['yunfeidanjiay']){
			$data['yunfeidanjia_flg'] = 1;
		}
		$data['yunfeiyongliang_flg'] = 0;
		if ($data['yunfeiyongliangj'] != $data['yunfeiyongliangy']){
			$data['yunfeiyongliang_flg'] = 1;
		}
		$data['qitadanjia_flg'] = 0;
		if ($data['qitadanjiaj'] != $data['qitadanjiay']){
			$data['qitadanjia_flg'] = 1;
		}
		$data['qitayongliang_flg'] = 0;
		if ($data['qitayongliangj'] != $data['qitayongliangy']){
			$data['qitayongliang_flg'] = 1;
		}

		$kuanhaosyusuan = $this->task->gettidlistjichu1($id);
		$kuanhaosjuesuan = $this->task->gettidlistjichu1jue($id);

		$data['yxiangmu1'] = '';
		$data['ymingcheng1'] = '';
		$data['yguige1'] = '';
		$data['ydanwei1'] = '';
		$data['ydanjia1'] = '';
		$data['ydanwei1_1'] = '';
		$data['yyongliang1'] = '';
		$data['ydanwei2_1'] = '';
		$data['yjine1'] = '';
		$data['ydanwei3_1'] = '';
		$data['yqidingliang1'] = '';
		$data['ybeizhu1'] = '';

		$data['yxiangmu2'] = '';
		$data['ymingcheng2'] = '';
		$data['yguige2'] = '';
		$data['ydanwei2'] = '';
		$data['ydanjia2'] = '';
		$data['ydanwei1_2'] = '';
		$data['yyongliang2'] = '';
		$data['ydanwei2_2'] = '';
		$data['yjine2'] = '';
		$data['ydanwei3_2'] = '';
		$data['yqidingliang2'] = '';
		$data['ybeizhu2'] = '';

		$data['yxiangmu3'] = '';
		$data['ymingcheng3'] = '';
		$data['yguige3'] = '';
		$data['ydanwei3'] = '';
		$data['ydanjia3'] = '';
		$data['ydanwei1_3'] = '';
		$data['yyongliang3'] = '';
		$data['ydanwei2_3'] = '';
		$data['yjine3'] = '';
		$data['ydanwei3_3'] = '';
		$data['yqidingliang3'] = '';
		$data['ybeizhu3'] = '';

		$data['yxiangmu4'] = '';
		$data['ymingcheng4'] = '';
		$data['yguige4'] = '';
		$data['ydanwei4'] = '';
		$data['ydanjia4'] = '';
		$data['ydanwei1_4'] = '';
		$data['yyongliang4'] = '';
		$data['ydanwei2_4'] = '';
		$data['yjine4'] = '';
		$data['ydanwei3_4'] = '';
		$data['yqidingliang4'] = '';
		$data['ybeizhu4'] = '';

		$data['yxiangmu5'] = '';
		$data['ymingcheng5'] = '';
		$data['yguige5'] = '';
		$data['ydanwei5'] = '';
		$data['ydanjia5'] = '';
		$data['ydanwei1_5'] = '';
		$data['yyongliang5'] = '';
		$data['ydanwei2_5'] = '';
		$data['yjine5'] = '';
		$data['ydanwei3_5'] = '';
		$data['yqidingliang5'] = '';
		$data['ybeizhu5'] = '';

		$data['yxiangmu6'] = '';
		$data['ymingcheng6'] = '';
		$data['yguige6'] = '';
		$data['ydanwei6'] = '';
		$data['ydanjia6'] = '';
		$data['ydanwei1_6'] = '';
		$data['yyongliang6'] = '';
		$data['ydanwei2_6'] = '';
		$data['yjine6'] = '';
		$data['ydanwei3_6'] = '';
		$data['yqidingliang6'] = '';
		$data['ybeizhu6'] = '';

		$data['yxiangmu7'] = '';
		$data['ymingcheng7'] = '';
		$data['yguige7'] = '';
		$data['ydanwei7'] = '';
		$data['ydanjia7'] = '';
		$data['ydanwei1_7'] = '';
		$data['yyongliang7'] = '';
		$data['ydanwei2_7'] = '';
		$data['yjine7'] = '';
		$data['ydanwei3_7'] = '';
		$data['yqidingliang7'] = '';
		$data['ybeizhu7'] = '';

		$data['yxiangmu8'] = '';
		$data['ymingcheng8'] = '';
		$data['yguige8'] = '';
		$data['ydanwei8'] = '';
		$data['ydanjia8'] = '';
		$data['ydanwei1_8'] = '';
		$data['yyongliang8'] = '';
		$data['ydanwei2_8'] = '';
		$data['yjine8'] = '';
		$data['ydanwei3_8'] = '';
		$data['yqidingliang8'] = '';
		$data['ybeizhu8'] = '';

		$data['yxiangmu9'] = '';
		$data['ymingcheng9'] = '';
		$data['yguige9'] = '';
		$data['ydanwei9'] = '';
		$data['ydanjia9'] = '';
		$data['ydanwei1_9'] = '';
		$data['yyongliang9'] = '';
		$data['ydanwei2_9'] = '';
		$data['yjine9'] = '';
		$data['ydanwei3_9'] = '';
		$data['yqidingliang9'] = '';
		$data['ybeizhu9'] = '';

		$data['yxiangmu10'] = '';
		$data['ymingcheng10'] = '';
		$data['yguige10'] = '';
		$data['ydanwei10'] = '';
		$data['ydanjia10'] = '';
		$data['ydanwei1_10'] = '';
		$data['yyongliang10'] = '';
		$data['ydanwei2_10'] = '';
		$data['yjine10'] = '';
		$data['ydanwei3_10'] = '';
		$data['yqidingliang10'] = '';
		$data['ybeizhu10'] = '';

		$data['yi_flg'] = 0;
		if (!empty($kuanhaosyusuan[0]['xiangmu'])) {
			$data['yxiangmu1'] = $kuanhaosyusuan[0]['xiangmu'];
			$data['ymingcheng1'] = $kuanhaosyusuan[0]['mingcheng'];
			$data['yguige1'] = $kuanhaosyusuan[0]['guige'];
			$data['ydanwei1'] = $kuanhaosyusuan[0]['danwei'];
			$data['ydanjia1'] = $kuanhaosyusuan[0]['danjia'];
			$data['ydanwei1_1'] = $kuanhaosyusuan[0]['danwei1'];
			$data['yyongliang1'] = $kuanhaosyusuan[0]['yongliang'];
			$data['ydanwei2_1'] = $kuanhaosyusuan[0]['danwei2'];
			$data['yjine1'] = $kuanhaosyusuan[0]['jine'];
			$data['ydanwei3_1'] = $kuanhaosyusuan[0]['danwei3'];
			$data['yqidingliang1'] = $kuanhaosyusuan[0]['qidingliang'];
			$data['ybeizhu1'] = $kuanhaosyusuan[0]['beizhu'];
			$yi_result = $this->task->getqubieduibiresult($id,$data['yxiangmu1'],$data['ymingcheng1'],$data['yguige1'],$data['ydanwei1'],$data['ydanjia1'],$data['ydanwei1_1'],$data['yyongliang1'],$data['ydanwei2_1'],$data['yjine1'],$data['ydanwei3_1'],$data['yqidingliang1'],$data['ybeizhu1']);
			if(empty($yi_result)){
				$data['yi_flg'] = 1;
			}
		}

		$data['er_flg'] = 0;
		if (!empty($kuanhaosyusuan[1]['xiangmu'])) {
			$data['yxiangmu2'] = $kuanhaosyusuan[1]['xiangmu'];
			$data['ymingcheng2'] = $kuanhaosyusuan[1]['mingcheng'];
			$data['yguige2'] = $kuanhaosyusuan[1]['guige'];
			$data['ydanwei2'] = $kuanhaosyusuan[1]['danwei'];
			$data['ydanjia2'] = $kuanhaosyusuan[1]['danjia'];
			$data['ydanwei1_2'] = $kuanhaosyusuan[1]['danwei1'];
			$data['yyongliang2'] = $kuanhaosyusuan[1]['yongliang'];
			$data['ydanwei2_2'] = $kuanhaosyusuan[1]['danwei2'];
			$data['yjine2'] = $kuanhaosyusuan[1]['jine'];
			$data['ydanwei3_2'] = $kuanhaosyusuan[1]['danwei3'];
			$data['yqidingliang2'] = $kuanhaosyusuan[1]['qidingliang'];
			$data['ybeizhu2'] = $kuanhaosyusuan[1]['beizhu'];
			$er_result = $this->task->getqubieduibiresult($id,$data['yxiangmu2'],$data['ymingcheng2'],$data['yguige2'],$data['ydanwei2'],$data['ydanjia2'],$data['ydanwei1_2'],$data['yyongliang2'],$data['ydanwei2_2'],$data['yjine2'],$data['ydanwei3_2'],$data['yqidingliang2'],$data['ybeizhu2']);
			if(empty($er_result)){
				$data['er_flg'] = 1;
			}
		}

		$data['san_flg'] = 0;
		if (!empty($kuanhaosyusuan[2]['xiangmu'])) {
			$data['yxiangmu3'] = $kuanhaosyusuan[2]['xiangmu'];
			$data['ymingcheng3'] = $kuanhaosyusuan[2]['mingcheng'];
			$data['yguige3'] = $kuanhaosyusuan[2]['guige'];
			$data['ydanwei3'] = $kuanhaosyusuan[2]['danwei'];
			$data['ydanjia3'] = $kuanhaosyusuan[2]['danjia'];
			$data['ydanwei1_3'] = $kuanhaosyusuan[2]['danwei1'];
			$data['yyongliang3'] = $kuanhaosyusuan[2]['yongliang'];
			$data['ydanwei2_3'] = $kuanhaosyusuan[2]['danwei2'];
			$data['yjine3'] = $kuanhaosyusuan[2]['jine'];
			$data['ydanwei3_3'] = $kuanhaosyusuan[2]['danwei3'];
			$data['yqidingliang3'] = $kuanhaosyusuan[2]['qidingliang'];
			$data['ybeizhu3'] = $kuanhaosyusuan[2]['beizhu'];
			$san_result = $this->task->getqubieduibiresult($id,$data['yxiangmu3'],$data['ymingcheng3'],$data['yguige3'],$data['ydanwei3'],$data['ydanjia3'],$data['ydanwei1_3'],$data['yyongliang3'],$data['ydanwei2_3'],$data['yjine3'],$data['ydanwei3_3'],$data['yqidingliang3'],$data['ybeizhu3']);
			if(empty($san_result)){
				$data['san_flg'] = 1;
			}
		}

		$data['si_flg'] = 0;
		if (!empty($kuanhaosyusuan[3]['xiangmu'])) {
			$data['yxiangmu4'] = $kuanhaosyusuan[3]['xiangmu'];
			$data['ymingcheng4'] = $kuanhaosyusuan[3]['mingcheng'];
			$data['yguige4'] = $kuanhaosyusuan[3]['guige'];
			$data['ydanwei4'] = $kuanhaosyusuan[3]['danwei'];
			$data['ydanjia4'] = $kuanhaosyusuan[3]['danjia'];
			$data['ydanwei1_4'] = $kuanhaosyusuan[3]['danwei1'];
			$data['yyongliang4'] = $kuanhaosyusuan[3]['yongliang'];
			$data['ydanwei2_4'] = $kuanhaosyusuan[3]['danwei2'];
			$data['yjine4'] = $kuanhaosyusuan[3]['jine'];
			$data['ydanwei3_4'] = $kuanhaosyusuan[3]['danwei3'];
			$data['yqidingliang4'] = $kuanhaosyusuan[3]['qidingliang'];
			$data['ybeizhu4'] = $kuanhaosyusuan[3]['beizhu'];
			$si_result = $this->task->getqubieduibiresult($id,$data['yxiangmu4'],$data['ymingcheng4'],$data['yguige4'],$data['ydanwei4'],$data['ydanjia4'],$data['ydanwei1_4'],$data['yyongliang4'],$data['ydanwei2_4'],$data['yjine4'],$data['ydanwei3_4'],$data['yqidingliang4'],$data['ybeizhu4']);
			if(empty($si_result)){
				$data['si_flg'] = 1;
			}
		}

		$data['wu_flg'] = 0;
		if (!empty($kuanhaosyusuan[4]['xiangmu'])) {
			$data['yxiangmu5'] = $kuanhaosyusuan[4]['xiangmu'];
			$data['ymingcheng5'] = $kuanhaosyusuan[4]['mingcheng'];
			$data['yguige5'] = $kuanhaosyusuan[4]['guige'];
			$data['ydanwei5'] = $kuanhaosyusuan[4]['danwei'];
			$data['ydanjia5'] = $kuanhaosyusuan[4]['danjia'];
			$data['ydanwei1_5'] = $kuanhaosyusuan[4]['danwei1'];
			$data['yyongliang5'] = $kuanhaosyusuan[4]['yongliang'];
			$data['ydanwei2_5'] = $kuanhaosyusuan[4]['danwei2'];
			$data['yjine5'] = $kuanhaosyusuan[4]['jine'];
			$data['ydanwei3_5'] = $kuanhaosyusuan[4]['danwei3'];
			$data['yqidingliang5'] = $kuanhaosyusuan[4]['qidingliang'];
			$data['ybeizhu5'] = $kuanhaosyusuan[4]['beizhu'];
			$wu_result = $this->task->getqubieduibiresult($id,$data['yxiangmu5'],$data['ymingcheng5'],$data['yguige5'],$data['ydanwei5'],$data['ydanjia5'],$data['ydanwei1_5'],$data['yyongliang5'],$data['ydanwei2_5'],$data['yjine5'],$data['ydanwei3_5'],$data['yqidingliang5'],$data['ybeizhu5']);
			if(empty($wu_result)){
				$data['wu_flg'] = 1;
			}
		}

		$data['liu_flg'] = 0;
		if (!empty($kuanhaosyusuan[5]['xiangmu'])) {
			$data['yxiangmu6'] = $kuanhaosyusuan[5]['xiangmu'];
			$data['ymingcheng6'] = $kuanhaosyusuan[5]['mingcheng'];
			$data['yguige6'] = $kuanhaosyusuan[5]['guige'];
			$data['ydanwei6'] = $kuanhaosyusuan[5]['danwei'];
			$data['ydanjia6'] = $kuanhaosyusuan[5]['danjia'];
			$data['ydanwei1_6'] = $kuanhaosyusuan[5]['danwei1'];
			$data['yyongliang6'] = $kuanhaosyusuan[5]['yongliang'];
			$data['ydanwei2_6'] = $kuanhaosyusuan[5]['danwei2'];
			$data['yjine6'] = $kuanhaosyusuan[5]['jine'];
			$data['ydanwei3_6'] = $kuanhaosyusuan[5]['danwei3'];
			$data['yqidingliang6'] = $kuanhaosyusuan[5]['qidingliang'];
			$data['ybeizhu6'] = $kuanhaosyusuan[5]['beizhu'];
			$liu_result = $this->task->getqubieduibiresult($id,$data['yxiangmu6'],$data['ymingcheng6'],$data['yguige6'],$data['ydanwei6'],$data['ydanjia6'],$data['ydanwei1_6'],$data['yyongliang6'],$data['ydanwei2_6'],$data['yjine6'],$data['ydanwei3_6'],$data['yqidingliang6'],$data['ybeizhu6']);
			if(empty($liu_result)){
				$data['liu_flg'] = 1;
			}
		}

		$data['qi_flg'] = 0;
		if (!empty($kuanhaosyusuan[6]['xiangmu'])) {
			$data['yxiangmu7'] = $kuanhaosyusuan[6]['xiangmu'];
			$data['ymingcheng7'] = $kuanhaosyusuan[6]['mingcheng'];
			$data['yguige7'] = $kuanhaosyusuan[6]['guige'];
			$data['ydanwei7'] = $kuanhaosyusuan[6]['danwei'];
			$data['ydanjia7'] = $kuanhaosyusuan[6]['danjia'];
			$data['ydanwei1_7'] = $kuanhaosyusuan[6]['danwei1'];
			$data['yyongliang7'] = $kuanhaosyusuan[6]['yongliang'];
			$data['ydanwei2_7'] = $kuanhaosyusuan[6]['danwei2'];
			$data['yjine7'] = $kuanhaosyusuan[6]['jine'];
			$data['ydanwei3_7'] = $kuanhaosyusuan[6]['danwei3'];
			$data['yqidingliang7'] = $kuanhaosyusuan[6]['qidingliang'];
			$data['ybeizhu7'] = $kuanhaosyusuan[6]['beizhu'];
			$qi_result = $this->task->getqubieduibiresult($id,$data['yxiangmu7'],$data['ymingcheng7'],$data['yguige7'],$data['ydanwei7'],$data['ydanjia7'],$data['ydanwei1_7'],$data['yyongliang7'],$data['ydanwei2_7'],$data['yjine7'],$data['ydanwei3_7'],$data['yqidingliang7'],$data['ybeizhu7']);
			if(empty($qi_result)){
				$data['qi_flg'] = 1;
			}
		}

		$data['ba_flg'] = 0;
		if (!empty($kuanhaosyusuan[7]['xiangmu'])) {
			$data['yxiangmu8'] = $kuanhaosyusuan[7]['xiangmu'];
			$data['ymingcheng8'] = $kuanhaosyusuan[7]['mingcheng'];
			$data['yguige8'] = $kuanhaosyusuan[7]['guige'];
			$data['ydanwei8'] = $kuanhaosyusuan[7]['danwei'];
			$data['ydanjia8'] = $kuanhaosyusuan[7]['danjia'];
			$data['ydanwei1_8'] = $kuanhaosyusuan[7]['danwei1'];
			$data['yyongliang8'] = $kuanhaosyusuan[7]['yongliang'];
			$data['ydanwei2_8'] = $kuanhaosyusuan[7]['danwei2'];
			$data['yjine8'] = $kuanhaosyusuan[7]['jine'];
			$data['ydanwei3_8'] = $kuanhaosyusuan[7]['danwei3'];
			$data['yqidingliang8'] = $kuanhaosyusuan[7]['qidingliang'];
			$data['ybeizhu8'] = $kuanhaosyusuan[7]['beizhu'];
			$ba_result = $this->task->getqubieduibiresult($id,$data['yxiangmu8'],$data['ymingcheng8'],$data['yguige8'],$data['ydanwei8'],$data['ydanjia8'],$data['ydanwei1_8'],$data['yyongliang8'],$data['ydanwei2_8'],$data['yjine8'],$data['ydanwei3_8'],$data['yqidingliang8'],$data['ybeizhu8']);
			if(empty($ba_result)){
				$data['ba_flg'] = 1;
			}
		}

		$data['jiu_flg'] = 0;
		if (!empty($kuanhaosyusuan[8]['xiangmu'])) {
			$data['yxiangmu9'] = $kuanhaosyusuan[8]['xiangmu'];
			$data['ymingcheng9'] = $kuanhaosyusuan[8]['mingcheng'];
			$data['yguige9'] = $kuanhaosyusuan[8]['guige'];
			$data['ydanwei9'] = $kuanhaosyusuan[8]['danwei'];
			$data['ydanjia9'] = $kuanhaosyusuan[8]['danjia'];
			$data['ydanwei1_9'] = $kuanhaosyusuan[8]['danwei1'];
			$data['yyongliang9'] = $kuanhaosyusuan[8]['yongliang'];
			$data['ydanwei2_9'] = $kuanhaosyusuan[8]['danwei2'];
			$data['yjine9'] = $kuanhaosyusuan[8]['jine'];
			$data['ydanwei3_9'] = $kuanhaosyusuan[8]['danwei3'];
			$data['yqidingliang9'] = $kuanhaosyusuan[8]['qidingliang'];
			$data['ybeizhu9'] = $kuanhaosyusuan[8]['beizhu'];
			$jiu_result = $this->task->getqubieduibiresult($id,$data['yxiangmu9'],$data['ymingcheng9'],$data['yguige9'],$data['ydanwei9'],$data['ydanjia9'],$data['ydanwei1_9'],$data['yyongliang9'],$data['ydanwei2_9'],$data['yjine9'],$data['ydanwei3_9'],$data['yqidingliang9'],$data['ybeizhu9']);
			if(empty($jiu_result)){
				$data['jiu_flg'] = 1;
			}
		}

		$data['shi_flg'] = 0;
		if (!empty($kuanhaosyusuan[9]['xiangmu'])) {
			$data['yxiangmu10'] = $kuanhaosyusuan[9]['xiangmu'];
			$data['ymingcheng10'] = $kuanhaosyusuan[9]['mingcheng'];
			$data['yguige10'] = $kuanhaosyusuan[9]['guige'];
			$data['ydanwei10'] = $kuanhaosyusuan[9]['danwei'];
			$data['ydanjia10'] = $kuanhaosyusuan[9]['danjia'];
			$data['ydanwei1_10'] = $kuanhaosyusuan[9]['danwei1'];
			$data['yyongliang10'] = $kuanhaosyusuan[9]['yongliang'];
			$data['ydanwei2_10'] = $kuanhaosyusuan[9]['danwei2'];
			$data['yjine10'] = $kuanhaosyusuan[9]['jine'];
			$data['ydanwei3_10'] = $kuanhaosyusuan[9]['danwei3'];
			$data['yqidingliang10'] = $kuanhaosyusuan[9]['qidingliang'];
			$data['ybeizhu10'] = $kuanhaosyusuan[9]['beizhu'];
			$shi_result = $this->task->getqubieduibiresult($id,$data['yxiangmu10'],$data['ymingcheng10'],$data['yguige10'],$data['ydanwei10'],$data['ydanjia10'],$data['ydanwei1_10'],$data['yyongliang10'],$data['ydanwei2_10'],$data['yjine10'],$data['ydanwei3_10'],$data['yqidingliang10'],$data['ybeizhu10']);
			if(empty($shi_result)){
				$data['shi_flg'] = 1;
			}
		}


		$data['jxiangmu1'] = '';
		$data['jmingcheng1'] = '';
		$data['jguige1'] = '';
		$data['jdanwei1'] = '';
		$data['jdanjia1'] = '';
		$data['jdanwei1_1'] = '';
		$data['jyongliang1'] = '';
		$data['jdanwei2_1'] = '';
		$data['jjine1'] = '';
		$data['jdanwei3_1'] = '';
		$data['jqidingliang1'] = '';
		$data['jbeizhu1'] = '';

		$data['jxiangmu2'] = '';
		$data['jmingcheng2'] = '';
		$data['jguige2'] = '';
		$data['jdanwei2'] = '';
		$data['jdanjia2'] = '';
		$data['jdanwei1_2'] = '';
		$data['jyongliang2'] = '';
		$data['jdanwei2_2'] = '';
		$data['jjine2'] = '';
		$data['jdanwei3_2'] = '';
		$data['jqidingliang2'] = '';
		$data['jbeizhu2'] = '';

		$data['jxiangmu3'] = '';
		$data['jmingcheng3'] = '';
		$data['jguige3'] = '';
		$data['jdanwei3'] = '';
		$data['jdanjia3'] = '';
		$data['jdanwei1_3'] = '';
		$data['jyongliang3'] = '';
		$data['jdanwei2_3'] = '';
		$data['jjine3'] = '';
		$data['jdanwei3_3'] = '';
		$data['jqidingliang3'] = '';
		$data['jbeizhu3'] = '';

		$data['jxiangmu4'] = '';
		$data['jmingcheng4'] = '';
		$data['jguige4'] = '';
		$data['jdanwei4'] = '';
		$data['jdanjia4'] = '';
		$data['jdanwei1_4'] = '';
		$data['jyongliang4'] = '';
		$data['jdanwei2_4'] = '';
		$data['jjine4'] = '';
		$data['jdanwei3_4'] = '';
		$data['jqidingliang4'] = '';
		$data['jbeizhu4'] = '';

		$data['jxiangmu5'] = '';
		$data['jmingcheng5'] = '';
		$data['jguige5'] = '';
		$data['jdanwei5'] = '';
		$data['jdanjia5'] = '';
		$data['jdanwei1_5'] = '';
		$data['jyongliang5'] = '';
		$data['jdanwei2_5'] = '';
		$data['jjine5'] = '';
		$data['jdanwei3_5'] = '';
		$data['jqidingliang5'] = '';
		$data['jbeizhu5'] = '';

		$data['jxiangmu6'] = '';
		$data['jmingcheng6'] = '';
		$data['jguige6'] = '';
		$data['jdanwei6'] = '';
		$data['jdanjia6'] = '';
		$data['jdanwei1_6'] = '';
		$data['jyongliang6'] = '';
		$data['jdanwei2_6'] = '';
		$data['jjine6'] = '';
		$data['jdanwei3_6'] = '';
		$data['jqidingliang6'] = '';
		$data['jbeizhu6'] = '';

		$data['jxiangmu7'] = '';
		$data['jmingcheng7'] = '';
		$data['jguige7'] = '';
		$data['jdanwei7'] = '';
		$data['jdanjia7'] = '';
		$data['jdanwei1_7'] = '';
		$data['jyongliang7'] = '';
		$data['jdanwei2_7'] = '';
		$data['jjine7'] = '';
		$data['jdanwei3_7'] = '';
		$data['jqidingliang7'] = '';
		$data['jbeizhu7'] = '';

		$data['jxiangmu8'] = '';
		$data['jmingcheng8'] = '';
		$data['jguige8'] = '';
		$data['jdanwei8'] = '';
		$data['jdanjia8'] = '';
		$data['jdanwei1_8'] = '';
		$data['jyongliang8'] = '';
		$data['jdanwei2_8'] = '';
		$data['jjine8'] = '';
		$data['jdanwei3_8'] = '';
		$data['jqidingliang8'] = '';
		$data['jbeizhu8'] = '';

		$data['jxiangmu9'] = '';
		$data['jmingcheng9'] = '';
		$data['jguige9'] = '';
		$data['jdanwei9'] = '';
		$data['jdanjia9'] = '';
		$data['jdanwei1_9'] = '';
		$data['jyongliang9'] = '';
		$data['jdanwei2_9'] = '';
		$data['jjine9'] = '';
		$data['jdanwei3_9'] = '';
		$data['jqidingliang9'] = '';
		$data['jbeizhu9'] = '';

		$data['jxiangmu10'] = '';
		$data['jmingcheng10'] = '';
		$data['jguige10'] = '';
		$data['jdanwei10'] = '';
		$data['jdanjia10'] = '';
		$data['jdanwei1_10'] = '';
		$data['jyongliang10'] = '';
		$data['jdanwei2_10'] = '';
		$data['jjine10'] = '';
		$data['jdanwei3_10'] = '';
		$data['jqidingliang10'] = '';
		$data['jbeizhu10'] = '';

		if (!empty($kuanhaosjuesuan[0]['xiangmu'])) {
			$data['jxiangmu1'] = $kuanhaosjuesuan[0]['xiangmu'];
			$data['jmingcheng1'] = $kuanhaosjuesuan[0]['mingcheng'];
			$data['jguige1'] = $kuanhaosjuesuan[0]['guige'];
			$data['jdanwei1'] = $kuanhaosjuesuan[0]['danwei'];
			$data['jdanjia1'] = $kuanhaosjuesuan[0]['danjia'];
			$data['jdanwei1_1'] = $kuanhaosjuesuan[0]['danwei1'];
			$data['jyongliang1'] = $kuanhaosjuesuan[0]['yongliang'];
			$data['jdanwei2_1'] = $kuanhaosjuesuan[0]['danwei2'];
			$data['jjine1'] = $kuanhaosjuesuan[0]['jine'];
			$data['jdanwei3_1'] = $kuanhaosjuesuan[0]['danwei3'];
			$data['jqidingliang1'] = $kuanhaosjuesuan[0]['qidingliang'];
			$data['jbeizhu1'] = $kuanhaosjuesuan[0]['beizhu'];
			if (empty($kuanhaosyusuan[0]['xiangmu'])){
				$data['yi_flg'] = 1;
			}
		}
		if (!empty($kuanhaosjuesuan[1]['xiangmu'])) {
			$data['jxiangmu2'] = $kuanhaosjuesuan[1]['xiangmu'];
			$data['jmingcheng2'] = $kuanhaosjuesuan[1]['mingcheng'];
			$data['jguige2'] = $kuanhaosjuesuan[1]['guige'];
			$data['jdanwei2'] = $kuanhaosjuesuan[1]['danwei'];
			$data['jdanjia2'] = $kuanhaosjuesuan[1]['danjia'];
			$data['jdanwei1_2'] = $kuanhaosjuesuan[1]['danwei1'];
			$data['jyongliang2'] = $kuanhaosjuesuan[1]['yongliang'];
			$data['jdanwei2_2'] = $kuanhaosjuesuan[1]['danwei2'];
			$data['jjine2'] = $kuanhaosjuesuan[1]['jine'];
			$data['jdanwei3_2'] = $kuanhaosjuesuan[1]['danwei3'];
			$data['jqidingliang2'] = $kuanhaosjuesuan[1]['qidingliang'];
			$data['jbeizhu2'] = $kuanhaosjuesuan[1]['beizhu'];
			if (empty($kuanhaosyusuan[1]['xiangmu'])){
				$data['er_flg'] = 1;
			}
		}
		if (!empty($kuanhaosjuesuan[2]['xiangmu'])) {
			$data['jxiangmu3'] = $kuanhaosjuesuan[2]['xiangmu'];
			$data['jmingcheng3'] = $kuanhaosjuesuan[2]['mingcheng'];
			$data['jguige3'] = $kuanhaosjuesuan[2]['guige'];
			$data['jdanwei3'] = $kuanhaosjuesuan[2]['danwei'];
			$data['jdanjia3'] = $kuanhaosjuesuan[2]['danjia'];
			$data['jdanwei1_3'] = $kuanhaosjuesuan[2]['danwei1'];
			$data['jyongliang3'] = $kuanhaosjuesuan[2]['yongliang'];
			$data['jdanwei2_3'] = $kuanhaosjuesuan[2]['danwei2'];
			$data['jjine3'] = $kuanhaosjuesuan[2]['jine'];
			$data['jdanwei3_3'] = $kuanhaosjuesuan[2]['danwei3'];
			$data['jqidingliang3'] = $kuanhaosjuesuan[2]['qidingliang'];
			$data['jbeizhu3'] = $kuanhaosjuesuan[2]['beizhu'];
			if (empty($kuanhaosyusuan[2]['xiangmu'])){
				$data['san_flg'] = 1;
			}
		}
		if (!empty($kuanhaosjuesuan[3]['xiangmu'])) {
			$data['jxiangmu4'] = $kuanhaosjuesuan[3]['xiangmu'];
			$data['jmingcheng4'] = $kuanhaosjuesuan[3]['mingcheng'];
			$data['jguige4'] = $kuanhaosjuesuan[3]['guige'];
			$data['jdanwei4'] = $kuanhaosjuesuan[3]['danwei'];
			$data['jdanjia4'] = $kuanhaosjuesuan[3]['danjia'];
			$data['jdanwei1_4'] = $kuanhaosjuesuan[3]['danwei1'];
			$data['jyongliang4'] = $kuanhaosjuesuan[3]['yongliang'];
			$data['jdanwei2_4'] = $kuanhaosjuesuan[3]['danwei2'];
			$data['jjine4'] = $kuanhaosjuesuan[3]['jine'];
			$data['jdanwei3_4'] = $kuanhaosjuesuan[3]['danwei3'];
			$data['jqidingliang4'] = $kuanhaosjuesuan[3]['qidingliang'];
			$data['jbeizhu4'] = $kuanhaosjuesuan[3]['beizhu'];
			if (empty($kuanhaosyusuan[3]['xiangmu'])){
				$data['si_flg'] = 1;
			}
		}
		if (!empty($kuanhaosjuesuan[4]['xiangmu'])) {
			$data['jxiangmu5'] = $kuanhaosjuesuan[4]['xiangmu'];
			$data['jmingcheng5'] = $kuanhaosjuesuan[4]['mingcheng'];
			$data['jguige5'] = $kuanhaosjuesuan[4]['guige'];
			$data['jdanwei5'] = $kuanhaosjuesuan[4]['danwei'];
			$data['jdanjia5'] = $kuanhaosjuesuan[4]['danjia'];
			$data['jdanwei1_5'] = $kuanhaosjuesuan[4]['danwei1'];
			$data['jyongliang5'] = $kuanhaosjuesuan[4]['yongliang'];
			$data['jdanwei2_5'] = $kuanhaosjuesuan[4]['danwei2'];
			$data['jjine5'] = $kuanhaosjuesuan[4]['jine'];
			$data['jdanwei3_5'] = $kuanhaosjuesuan[4]['danwei3'];
			$data['jqidingliang5'] = $kuanhaosjuesuan[4]['qidingliang'];
			$data['jbeizhu5'] = $kuanhaosjuesuan[4]['beizhu'];
			if (empty($kuanhaosyusuan[4]['xiangmu'])){
				$data['wu_flg'] = 1;
			}
		}
		if (!empty($kuanhaosjuesuan[5]['xiangmu'])) {
			$data['jxiangmu6'] = $kuanhaosjuesuan[5]['xiangmu'];
			$data['jmingcheng6'] = $kuanhaosjuesuan[5]['mingcheng'];
			$data['jguige6'] = $kuanhaosjuesuan[5]['guige'];
			$data['jdanwei6'] = $kuanhaosjuesuan[5]['danwei'];
			$data['jdanjia6'] = $kuanhaosjuesuan[5]['danjia'];
			$data['jdanwei1_6'] = $kuanhaosjuesuan[5]['danwei1'];
			$data['jyongliang6'] = $kuanhaosjuesuan[5]['yongliang'];
			$data['jdanwei2_6'] = $kuanhaosjuesuan[5]['danwei2'];
			$data['jjine6'] = $kuanhaosjuesuan[5]['jine'];
			$data['jdanwei3_6'] = $kuanhaosjuesuan[5]['danwei3'];
			$data['jqidingliang6'] = $kuanhaosjuesuan[5]['qidingliang'];
			$data['jbeizhu6'] = $kuanhaosjuesuan[5]['beizhu'];
			if (empty($kuanhaosyusuan[5]['xiangmu'])){
				$data['liu_flg'] = 1;
			}
		}
		if (!empty($kuanhaosjuesuan[6]['xiangmu'])) {
			$data['jxiangmu7'] = $kuanhaosjuesuan[6]['xiangmu'];
			$data['jmingcheng7'] = $kuanhaosjuesuan[6]['mingcheng'];
			$data['jguige7'] = $kuanhaosjuesuan[6]['guige'];
			$data['jdanwei7'] = $kuanhaosjuesuan[6]['danwei'];
			$data['jdanjia7'] = $kuanhaosjuesuan[6]['danjia'];
			$data['jdanwei1_7'] = $kuanhaosjuesuan[6]['danwei1'];
			$data['jyongliang7'] = $kuanhaosjuesuan[6]['yongliang'];
			$data['jdanwei2_7'] = $kuanhaosjuesuan[6]['danwei2'];
			$data['jjine7'] = $kuanhaosjuesuan[6]['jine'];
			$data['jdanwei3_7'] = $kuanhaosjuesuan[6]['danwei3'];
			$data['jqidingliang7'] = $kuanhaosjuesuan[6]['qidingliang'];
			$data['jbeizhu7'] = $kuanhaosjuesuan[6]['beizhu'];
			if (empty($kuanhaosyusuan[6]['xiangmu'])){
				$data['qi_flg'] = 1;
			}
		}
		if (!empty($kuanhaosjuesuan[7]['xiangmu'])) {
			$data['jxiangmu8'] = $kuanhaosjuesuan[7]['xiangmu'];
			$data['jmingcheng8'] = $kuanhaosjuesuan[7]['mingcheng'];
			$data['jguige8'] = $kuanhaosjuesuan[7]['guige'];
			$data['jdanwei8'] = $kuanhaosjuesuan[7]['danwei'];
			$data['jdanjia8'] = $kuanhaosjuesuan[7]['danjia'];
			$data['jdanwei1_8'] = $kuanhaosjuesuan[7]['danwei1'];
			$data['jyongliang8'] = $kuanhaosjuesuan[7]['yongliang'];
			$data['jdanwei2_8'] = $kuanhaosjuesuan[7]['danwei2'];
			$data['jjine8'] = $kuanhaosjuesuan[7]['jine'];
			$data['jdanwei3_8'] = $kuanhaosjuesuan[7]['danwei3'];
			$data['jqidingliang8'] = $kuanhaosjuesuan[7]['qidingliang'];
			$data['jbeizhu8'] = $kuanhaosjuesuan[7]['beizhu'];
			if (empty($kuanhaosyusuan[7]['xiangmu'])){
				$data['ba_flg'] = 1;
			}
		}
		if (!empty($kuanhaosjuesuan[8]['xiangmu'])) {
			$data['jxiangmu9'] = $kuanhaosjuesuan[8]['xiangmu'];
			$data['jmingcheng9'] = $kuanhaosjuesuan[8]['mingcheng'];
			$data['jguige9'] = $kuanhaosjuesuan[8]['guige'];
			$data['jdanwei9'] = $kuanhaosjuesuan[8]['danwei'];
			$data['jdanjia9'] = $kuanhaosjuesuan[8]['danjia'];
			$data['jdanwei1_9'] = $kuanhaosjuesuan[8]['danwei1'];
			$data['jyongliang9'] = $kuanhaosjuesuan[8]['yongliang'];
			$data['jdanwei2_9'] = $kuanhaosjuesuan[8]['danwei2'];
			$data['jjine9'] = $kuanhaosjuesuan[8]['jine'];
			$data['jdanwei3_9'] = $kuanhaosjuesuan[8]['danwei3'];
			$data['jqidingliang9'] = $kuanhaosjuesuan[8]['qidingliang'];
			$data['jbeizhu9'] = $kuanhaosjuesuan[8]['beizhu'];
			if (empty($kuanhaosyusuan[8]['xiangmu'])){
				$data['jiu_flg'] = 1;
			}
		}
		if (!empty($kuanhaosjuesuan[9]['xiangmu'])) {
			$data['jxiangmu10'] = $kuanhaosjuesuan[9]['xiangmu'];
			$data['jmingcheng10'] = $kuanhaosjuesuan[9]['mingcheng'];
			$data['jguige10'] = $kuanhaosjuesuan[9]['guige'];
			$data['jdanwei10'] = $kuanhaosjuesuan[9]['danwei'];
			$data['jdanjia10'] = $kuanhaosjuesuan[9]['danjia'];
			$data['jdanwei1_10'] = $kuanhaosjuesuan[9]['danwei1'];
			$data['jyongliang10'] = $kuanhaosjuesuan[9]['yongliang'];
			$data['jdanwei2_10'] = $kuanhaosjuesuan[9]['danwei2'];
			$data['jjine10'] = $kuanhaosjuesuan[9]['jine'];
			$data['jdanwei3_10'] = $kuanhaosjuesuan[9]['danwei3'];
			$data['jqidingliang10'] = $kuanhaosjuesuan[9]['qidingliang'];
			$data['jbeizhu10'] = $kuanhaosjuesuan[9]['beizhu'];
			if (empty($kuanhaosyusuan[9]['xiangmu'])){
				$data['shi_flg'] = 1;
			}
		}

		$this->display("goods/goods_list_bao_duibi_details", $data);
	}
	public function goods_yangpin_xiangmu()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage($gname);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["id"] = $id;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew($page, $gname);
		$data["gname"] = $gname;
		$data["list"] = $list;
		$this->display("goods/goods_yangpin_xiangmu", $data);
	}
	public function yangpin_save()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$zid = isset($_POST['id']) ? $_POST['id'] : 0;

		$kuhumingcheng = isset($_POST["kuhumingcheng"]) ? $_POST["kuhumingcheng"] : '';
		if (empty($kuhumingcheng[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加客户姓名!"));
			return;
		}
		$dandangzhe = isset($_POST["dandangzhe"]) ? $_POST["dandangzhe"] : '';
		if (empty($dandangzhe[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加担当者!"));
			return;
		}
		$kuanhao = isset($_POST["kuanhao"]) ? $_POST["kuanhao"] : '';
		if (empty($kuanhao[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加款号!"));
			return;
		}
		$kuanshi = isset($_POST["kuanshi"]) ? $_POST["kuanshi"] : '';
		if (empty($kuanshi[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加款式!"));
			return;
		}
		$yangpinxingzhi = isset($_POST["yangpinxingzhi"]) ? $_POST["yangpinxingzhi"] : '';
		if (empty($yangpinxingzhi[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加样品性质!"));
			return;
		}
		$shuliang = isset($_POST["shuliang"]) ? $_POST["shuliang"] : '';
		if (empty($shuliang[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加数量!"));
			return;
		}
		$yangpindanjia = isset($_POST["yangpindanjia"]) ? $_POST["yangpindanjia"] : '';
		if (empty($yangpindanjia[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加样品单价!"));
			return;
		}
		$shoudaoriqi = isset($_POST["shoudaoriqi"]) ? $_POST["shoudaoriqi"] : '';
		if (empty($shoudaoriqi[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加收到日期!"));
			return;
		}
		$fachuriqi = isset($_POST["fachuriqi"]) ? $_POST["fachuriqi"] : '';
		if (empty($fachuriqi[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加发出日期!"));
			return;
		}
		$zhizuozhe = isset($_POST["zhizuozhe"]) ? $_POST["zhizuozhe"] : '';
		if (empty($zhizuozhe[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加制作者!"));
			return;
		}

		foreach ($kuhumingcheng as $k => $v) {
			if (empty($v) || empty($dandangzhe[$k]) || empty($kuanhao[$k]) || empty($kuanshi[$k]) || empty($yangpinxingzhi[$k]) || empty($shuliang[$k]) || empty($yangpindanjia[$k]) || empty($shoudaoriqi[$k]) || empty($fachuriqi[$k]) || empty($zhizuozhe[$k])) {
				continue;
			}
			$this->role->role_save_yangpin($zid,$v,$dandangzhe[$k],$kuanhao[$k],$kuanshi[$k],$yangpinxingzhi[$k],$shuliang[$k],$yangpindanjia[$k],strtotime($shoudaoriqi[$k]),strtotime($fachuriqi[$k]),$zhizuozhe[$k],time());
		}

		echo json_encode(array('success' => true, 'msg' => "操作成功。"));
	}
	public function yangpin_save_edit()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$kuhumingcheng = isset($_POST["kuhumingcheng"]) ? $_POST["kuhumingcheng"] : '';
		$dandangzhe = isset($_POST["dandangzhe"]) ? $_POST["dandangzhe"] : '';
		$kuanhao = isset($_POST["kuanhao"]) ? $_POST["kuanhao"] : '';
		$kuanshi = isset($_POST["kuanshi"]) ? $_POST["kuanshi"] : '';
		$yangpinxingzhi = isset($_POST["yangpinxingzhi"]) ? $_POST["yangpinxingzhi"] : '';
		$shuliang = isset($_POST["shuliang"]) ? $_POST["shuliang"] : '';
		$yangpindanjia = isset($_POST["yangpindanjia"]) ? $_POST["yangpindanjia"] : '';
		$shoudaoriqi = isset($_POST["shoudaoriqi"]) ? $_POST["shoudaoriqi"] : '';
		$fachuriqi = isset($_POST["fachuriqi"]) ? $_POST["fachuriqi"] : '';
		$zhizuozhe = isset($_POST["zhizuozhe"]) ? $_POST["zhizuozhe"] : '';
		$id = isset($_POST["id"]) ? $_POST["id"] : '';
//		$label_info = $this->label->getlabelById2($lname,$id);
//		if (!empty($label_info)){
//			echo json_encode(array('error' => false, 'msg' => "该标签名称已经存在"));
//			return;
//		}

		$result = $this->role->yangpin_save_edit($id,$kuhumingcheng,$dandangzhe,$kuanhao,$kuanshi,$yangpinxingzhi,$shuliang,$yangpindanjia,strtotime($shoudaoriqi),strtotime($fachuriqi),$zhizuozhe);
		if ($result) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
		}
	}

	public function goods_list_cai()
	{
		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage($gname);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew($page, $gname);
		foreach ($list as $k=>$v){
			$list[$k]['kuanhaoshu'] = $this->role->getgoodsAllNewcount($v['id']);
		}
		$data["gname"] = $gname;
		$data["list"] = $list;
		$this->display("goods/goods_list_cai", $data);
	}
	public function goods_list_caiduan()
	{
		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage($gname);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew($page, $gname);
		foreach ($list as $k=>$v){
			$list[$k]['kuanhaoshu'] = $this->role->getgoodsAllNewcount($v['id']);
		}
		$data["gname"] = $gname;
		$data["list"] = $list;
		$this->display("goods/goods_list_caiduan", $data);
	}
	public function goods_list_caiduanzhuangxiang()
	{
		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage($gname);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew($page, $gname);
		foreach ($list as $k=>$v){
			$list[$k]['kuanhaoshu'] = $this->role->getgoodsAllNewcount($v['id']);
		}
		$data["gname"] = $gname;
		$data["list"] = $list;
		$this->display("goods/goods_list_caiduanzhuangxiang", $data);
	}
	public function goods_list_caiduanshutongji()
	{
		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage($gname);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew($page, $gname);
		foreach ($list as $k=>$v){
			$list[$k]['kuanhaoshu'] = $this->role->getgoodsAllNewcount($v['id']);
		}
		$data["gname"] = $gname;
		$data["list"] = $list;
		$this->display("goods/goods_list_caiduanshutongji", $data);
	}
	public function goods_list1_cai()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage1($gname,$id);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page,$allpage,$_GET);
		$data["page"] = $page;
		$data["id"] = $id;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew1($page,$gname,$id);
		$data["gname"] = $gname;
		foreach ($list as $k => $v) {
			$pinmings = $this->task->gettidlistpinming_cai($v['id']);
			if (!empty($pinmings)) {
				$list[$k]['openflg1'] = 1;
			} else {
				$list[$k]['openflg1'] = 0;
			}
			if (!empty($pinmings[0]['zhuangxiangxinxi'])) {
				$list[$k]['openflg'] = 1;
			} else {
				$list[$k]['openflg'] = 0;
			}
			$nsum = 0;
			$zsum = 0;
			foreach ($pinmings as $kk=>$vv){
				$nsum = $nsum + 1;
				$zsum = $zsum + $vv['zhishishu'];
			}
			$list[$k]['pinlei'] = $nsum;
			$list[$k]['heji'] = $zsum;
		}
		$data["list"] = $list;
		$this->display("goods/goods_list1_cai", $data);
	}
	public function goods_list1_caiduan()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage1($gname,$id);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page,$allpage,$_GET);
		$data["page"] = $page;
		$data["id"] = $id;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew1($page,$gname,$id);
		$data["gname"] = $gname;
		foreach ($list as $k => $v) {
			$pinmings = $this->task->gettidlistpinming_cai($v['id']);
			if (!empty($pinmings)) {
				$list[$k]['openflg1'] = 1;
			} else {
				$list[$k]['openflg1'] = 0;
			}
			if (!empty($pinmings[0]['zhuangxiangxinxi'])) {
				$list[$k]['openflg'] = 1;
			} else {
				$list[$k]['openflg'] = 0;
			}
			$nsum = 0;
			$zsum = 0;
			foreach ($pinmings as $kk=>$vv){
				$nsum = $nsum + 1;
				$zsum = $zsum + $vv['zhishishu'];
			}
			$list[$k]['pinlei'] = $nsum;
			$list[$k]['heji'] = $zsum;
		}
		$data["list"] = $list;
		$this->display("goods/goods_list1_caiduan", $data);
	}
	public function goods_list1_caiduanzhuangxiang()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage1($gname,$id);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page,$allpage,$_GET);
		$data["page"] = $page;
		$data["id"] = $id;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew1($page,$gname,$id);
		$data["gname"] = $gname;
		foreach ($list as $k => $v) {
			$pinmings = $this->task->gettidlistpinming_cai($v['id']);
			if (!empty($pinmings)) {
				$list[$k]['openflg1'] = 1;
			} else {
				$list[$k]['openflg1'] = 0;
			}
			if (!empty($pinmings[0]['zhuangxiangxinxi'])) {
				$list[$k]['openflg'] = 1;
			} else {
				$list[$k]['openflg'] = 0;
			}
			$nsum = 0;
			$zsum = 0;
			$list[$k]['openflg2'] = 0;
			foreach ($pinmings as $kk=>$vv){
				$nsum = $nsum + 1;
				$zsum = $zsum + $vv['zhishishu'];
				if (!empty($vv['caiduanshu'])){
					$list[$k]['openflg2'] = 1;
				}
			}
			$list[$k]['pinlei'] = $nsum;
			$list[$k]['heji'] = $zsum;
			$list[$k]['zhuangxiangshuliang'] = empty($pinmings[0]['zhuangxiangshuliang'])?0:$pinmings[0]['zhuangxiangshuliang'];
		}
		$data["list"] = $list;
		$this->display("goods/goods_list1_caiduanzhuangxiang", $data);
	}
	public function goods_list1_caiduanshutongji()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage1($gname,$id);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page,$allpage,$_GET);
		$data["page"] = $page;
		$data["id"] = $id;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew1($page,$gname,$id);
		$data["gname"] = $gname;
		foreach ($list as $k => $v) {
			$pinmings = $this->task->gettidlistpinming_cai($v['id']);
			if (!empty($pinmings)) {
				$list[$k]['openflg1'] = 1;
			} else {
				$list[$k]['openflg1'] = 0;
			}
			if (!empty($pinmings[0]['zhuangxiangxinxi'])) {
				$list[$k]['openflg'] = 1;
			} else {
				$list[$k]['openflg'] = 0;
			}
			$nsum = 0;
			$zsum = 0;
			$list[$k]['openflg2'] = 0;
			foreach ($pinmings as $kk=>$vv){
				$nsum = $nsum + 1;
				$zsum = $zsum + $vv['zhishishu'];
				if (!empty($vv['caiduanshu'])){
					$list[$k]['openflg2'] = 1;
				}
			}
			$list[$k]['pinlei'] = $nsum;
			$list[$k]['heji'] = $zsum;
			$list[$k]['zhuangxiangshuliang'] = empty($pinmings[0]['zhuangxiangshuliang'])?0:$pinmings[0]['zhuangxiangshuliang'];
		}
		$data["list"] = $list;
		$this->display("goods/goods_list1_caiduanshutongji", $data);
	}
	public function goods_add_new22_cai()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$data['id'] = $id;
		$this->display("goods/goods_add_new22_cai", $data);
	}
	public function goods_save2_cai()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}

		$sehaos = isset($_POST["sehao"]) ? $_POST["sehao"] : '';
		if (empty($sehaos[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加色号!"));
			return;
		}
		$pinfan = isset($_POST["pinfan"]) ? $_POST["pinfan"] : '';
		if (empty($pinfan[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加品番!"));
			return;
		}
//		$caiduanshu = isset($_POST["caiduanshu"]) ? $_POST["caiduanshu"] : '';
//		if (empty($caiduanshu[0])) {
//			echo json_encode(array('error' => true, 'msg' => "请添加裁断数量!"));
//			return;
//		}
		$zhishishu = isset($_POST["zhishishu"]) ? $_POST["zhishishu"] : '';
		if (empty($zhishishu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加指示数量!"));
			return;
		}

		foreach ($sehaos as $k => $v) {
			if (empty($v) || empty($pinfan[$k]) || empty($zhishishu[$k])) {
				continue;
			}
			$this->role->role_save123_cai($v,$pinfan[$k],0,$zhishishu[$k],$id,time());
		}
		echo json_encode(array('success' => true, 'msg' => "操作成功。"));
	}
	public function goods_edit_new22_cai()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$data = array();
		$data['id'] = $id;
		$kuanhaos = $this->task->gettidlistpinming_cai($id);

		$data['caiduanshu1'] = '';
		$data['pinfan1'] = '';
		$data['sehao1'] = '';
		$data['zhishishu1'] = '';

		$data['caiduanshu2'] = '';
		$data['pinfan2'] = '';
		$data['sehao2'] = '';
		$data['zhishishu2'] = '';

		$data['caiduanshu3'] = '';
		$data['pinfan3'] = '';
		$data['sehao3'] = '';
		$data['zhishishu3'] = '';

		$data['caiduanshu4'] = '';
		$data['pinfan4'] = '';
		$data['sehao4'] = '';
		$data['zhishishu4'] = '';

		$data['caiduanshu5'] = '';
		$data['pinfan5'] = '';
		$data['sehao5'] = '';
		$data['zhishishu5'] = '';

		$data['caiduanshu6'] = '';
		$data['pinfan6'] = '';
		$data['sehao6'] = '';
		$data['zhishishu6'] = '';

		$data['caiduanshu7'] = '';
		$data['pinfan7'] = '';
		$data['sehao7'] = '';
		$data['zhishishu7'] = '';

		$data['caiduanshu8'] = '';
		$data['pinfan8'] = '';
		$data['sehao8'] = '';
		$data['zhishishu8'] = '';

		$data['caiduanshu9'] = '';
		$data['pinfan9'] = '';
		$data['sehao9'] = '';
		$data['zhishishu9'] = '';

		$data['caiduanshu10'] = '';
		$data['pinfan10'] = '';
		$data['sehao10'] = '';
		$data['zhishishu10'] = '';

		if (!empty($kuanhaos[0]['sehao'])) {
			$data['sehao1'] = $kuanhaos[0]['sehao'];
			$data['pinfan1'] = $kuanhaos[0]['pinfan'];
			$data['caiduanshu1'] = $kuanhaos[0]['caiduanshu'];
			$data['zhishishu1'] = $kuanhaos[0]['zhishishu'];
		}

		if (!empty($kuanhaos[1]['sehao'])) {
			$data['sehao2'] = $kuanhaos[1]['sehao'];
			$data['pinfan2'] = $kuanhaos[1]['pinfan'];
			$data['caiduanshu2'] = $kuanhaos[1]['caiduanshu'];
			$data['zhishishu2'] = $kuanhaos[1]['zhishishu'];
		}

		if (!empty($kuanhaos[2]['sehao'])) {
			$data['sehao3'] = $kuanhaos[2]['sehao'];
			$data['pinfan3'] = $kuanhaos[2]['pinfan'];
			$data['caiduanshu3'] = $kuanhaos[2]['caiduanshu'];
			$data['zhishishu3'] = $kuanhaos[2]['zhishishu'];
		}

		if (!empty($kuanhaos[3]['sehao'])) {
			$data['sehao4'] = $kuanhaos[3]['sehao'];
			$data['pinfan4'] = $kuanhaos[3]['pinfan'];
			$data['caiduanshu4'] = $kuanhaos[3]['caiduanshu'];
			$data['zhishishu4'] = $kuanhaos[3]['zhishishu'];
		}

		if (!empty($kuanhaos[4]['sehao'])) {
			$data['sehao5'] = $kuanhaos[4]['sehao'];
			$data['pinfan5'] = $kuanhaos[4]['pinfan'];
			$data['caiduanshu5'] = $kuanhaos[4]['caiduanshu'];
			$data['zhishishu5'] = $kuanhaos[4]['zhishishu'];
		}

		if (!empty($kuanhaos[5]['sehao'])) {
			$data['sehao6'] = $kuanhaos[5]['sehao'];
			$data['pinfan6'] = $kuanhaos[5]['pinfan'];
			$data['caiduanshu6'] = $kuanhaos[5]['caiduanshu'];
			$data['zhishishu6'] = $kuanhaos[5]['zhishishu'];
		}

		if (!empty($kuanhaos[6]['sehao'])) {
			$data['sehao7'] = $kuanhaos[6]['sehao'];
			$data['pinfan7'] = $kuanhaos[6]['pinfan'];
			$data['caiduanshu7'] = $kuanhaos[6]['caiduanshu'];
			$data['zhishishu7'] = $kuanhaos[6]['zhishishu'];
		}

		if (!empty($kuanhaos[7]['sehao'])) {
			$data['sehao8'] = $kuanhaos[7]['sehao'];
			$data['pinfan8'] = $kuanhaos[7]['pinfan'];
			$data['caiduanshu8'] = $kuanhaos[7]['caiduanshu'];
			$data['zhishishu8'] = $kuanhaos[7]['zhishishu'];
		}

		if (!empty($kuanhaos[8]['sehao'])) {
			$data['sehao9'] = $kuanhaos[8]['sehao'];
			$data['pinfan9'] = $kuanhaos[8]['pinfan'];
			$data['caiduanshu9'] = $kuanhaos[8]['caiduanshu'];
			$data['zhishishu9'] = $kuanhaos[8]['zhishishu'];
		}

		if (!empty($kuanhaos[9]['sehao'])) {
			$data['sehao10'] = $kuanhaos[9]['sehao'];
			$data['pinfan10'] = $kuanhaos[9]['pinfan'];
			$data['caiduanshu10'] = $kuanhaos[9]['caiduanshu'];
			$data['zhishishu10'] = $kuanhaos[9]['zhishishu'];
		}
		$this->display("goods/goods_edit_new22_cai", $data);
	}
	public function goods_edit_new22_caiduan()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$data = array();
		$data['id'] = $id;
		$kuanhaos = $this->task->gettidlistpinming_cai($id);

		$data['caiduanshu1'] = '';
		$data['pinfan1'] = '';
		$data['sehao1'] = '';
		$data['zhishishu1'] = '';

		$data['caiduanshu2'] = '';
		$data['pinfan2'] = '';
		$data['sehao2'] = '';
		$data['zhishishu2'] = '';

		$data['caiduanshu3'] = '';
		$data['pinfan3'] = '';
		$data['sehao3'] = '';
		$data['zhishishu3'] = '';

		$data['caiduanshu4'] = '';
		$data['pinfan4'] = '';
		$data['sehao4'] = '';
		$data['zhishishu4'] = '';

		$data['caiduanshu5'] = '';
		$data['pinfan5'] = '';
		$data['sehao5'] = '';
		$data['zhishishu5'] = '';

		$data['caiduanshu6'] = '';
		$data['pinfan6'] = '';
		$data['sehao6'] = '';
		$data['zhishishu6'] = '';

		$data['caiduanshu7'] = '';
		$data['pinfan7'] = '';
		$data['sehao7'] = '';
		$data['zhishishu7'] = '';

		$data['caiduanshu8'] = '';
		$data['pinfan8'] = '';
		$data['sehao8'] = '';
		$data['zhishishu8'] = '';

		$data['caiduanshu9'] = '';
		$data['pinfan9'] = '';
		$data['sehao9'] = '';
		$data['zhishishu9'] = '';

		$data['caiduanshu10'] = '';
		$data['pinfan10'] = '';
		$data['sehao10'] = '';
		$data['zhishishu10'] = '';

		if (!empty($kuanhaos[0]['sehao'])) {
			$data['sehao1'] = $kuanhaos[0]['sehao'];
			$data['pinfan1'] = $kuanhaos[0]['pinfan'];
			$data['caiduanshu1'] = $kuanhaos[0]['caiduanshu'];
			$data['zhishishu1'] = $kuanhaos[0]['zhishishu'];
		}

		if (!empty($kuanhaos[1]['sehao'])) {
			$data['sehao2'] = $kuanhaos[1]['sehao'];
			$data['pinfan2'] = $kuanhaos[1]['pinfan'];
			$data['caiduanshu2'] = $kuanhaos[1]['caiduanshu'];
			$data['zhishishu2'] = $kuanhaos[1]['zhishishu'];
		}

		if (!empty($kuanhaos[2]['sehao'])) {
			$data['sehao3'] = $kuanhaos[2]['sehao'];
			$data['pinfan3'] = $kuanhaos[2]['pinfan'];
			$data['caiduanshu3'] = $kuanhaos[2]['caiduanshu'];
			$data['zhishishu3'] = $kuanhaos[2]['zhishishu'];
		}

		if (!empty($kuanhaos[3]['sehao'])) {
			$data['sehao4'] = $kuanhaos[3]['sehao'];
			$data['pinfan4'] = $kuanhaos[3]['pinfan'];
			$data['caiduanshu4'] = $kuanhaos[3]['caiduanshu'];
			$data['zhishishu4'] = $kuanhaos[3]['zhishishu'];
		}

		if (!empty($kuanhaos[4]['sehao'])) {
			$data['sehao5'] = $kuanhaos[4]['sehao'];
			$data['pinfan5'] = $kuanhaos[4]['pinfan'];
			$data['caiduanshu5'] = $kuanhaos[4]['caiduanshu'];
			$data['zhishishu5'] = $kuanhaos[4]['zhishishu'];
		}

		if (!empty($kuanhaos[5]['sehao'])) {
			$data['sehao6'] = $kuanhaos[5]['sehao'];
			$data['pinfan6'] = $kuanhaos[5]['pinfan'];
			$data['caiduanshu6'] = $kuanhaos[5]['caiduanshu'];
			$data['zhishishu6'] = $kuanhaos[5]['zhishishu'];
		}

		if (!empty($kuanhaos[6]['sehao'])) {
			$data['sehao7'] = $kuanhaos[6]['sehao'];
			$data['pinfan7'] = $kuanhaos[6]['pinfan'];
			$data['caiduanshu7'] = $kuanhaos[6]['caiduanshu'];
			$data['zhishishu7'] = $kuanhaos[6]['zhishishu'];
		}

		if (!empty($kuanhaos[7]['sehao'])) {
			$data['sehao8'] = $kuanhaos[7]['sehao'];
			$data['pinfan8'] = $kuanhaos[7]['pinfan'];
			$data['caiduanshu8'] = $kuanhaos[7]['caiduanshu'];
			$data['zhishishu8'] = $kuanhaos[7]['zhishishu'];
		}

		if (!empty($kuanhaos[8]['sehao'])) {
			$data['sehao9'] = $kuanhaos[8]['sehao'];
			$data['pinfan9'] = $kuanhaos[8]['pinfan'];
			$data['caiduanshu9'] = $kuanhaos[8]['caiduanshu'];
			$data['zhishishu9'] = $kuanhaos[8]['zhishishu'];
		}

		if (!empty($kuanhaos[9]['sehao'])) {
			$data['sehao10'] = $kuanhaos[9]['sehao'];
			$data['pinfan10'] = $kuanhaos[9]['pinfan'];
			$data['caiduanshu10'] = $kuanhaos[9]['caiduanshu'];
			$data['zhishishu10'] = $kuanhaos[9]['zhishishu'];
		}
		$this->display("goods/goods_edit_new22_caiduan", $data);
	}
	public function goods_save_edit2_cai()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}

		$sehaos = isset($_POST["sehao"]) ? $_POST["sehao"] : '';
		if (empty($sehaos[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加色号!"));
			return;
		}
		$pinfan = isset($_POST["pinfan"]) ? $_POST["pinfan"] : '';
		if (empty($pinfan[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加品番!"));
			return;
		}
		$caiduanshu = isset($_POST["caiduanshu"]) ? $_POST["caiduanshu"] : '';
//		if (empty($caiduanshu[0])) {
//			echo json_encode(array('error' => true, 'msg' => "请添加裁断数量!"));
//			return;
//		}
		$zhishishu = isset($_POST["zhishishu"]) ? $_POST["zhishishu"] : '';
		if (empty($zhishishu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加指示数量!"));
			return;
		}
		$this->role->goodsimg_delete4_cai($id);
		foreach ($sehaos as $k => $v) {
			if (empty($v) || empty($pinfan[$k]) || empty($zhishishu[$k])) {
				continue;
			}
			if (empty($caiduanshu[$k])){
				$caiduanshu[$k] = 0;
			}
			$this->role->role_save123_cai($v,$pinfan[$k],$caiduanshu[$k],$zhishishu[$k],$id,time());
		}

		echo json_encode(array('success' => true, 'msg' => "操作成功。"));

	}

	public function goods_list_caij()
	{
		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage($gname);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew($page, $gname);
		$data["gname"] = $gname;
		$data["list"] = $list;
		$this->display("goods/goods_list_caij", $data);
	}
	public function goods_list1_caij()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage1($gname,$id);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page,$allpage,$_GET);
		$data["page"] = $page;
		$data["id"] = $id;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew1($page,$gname,$id);
		$data["gname"] = $gname;
		foreach ($list as $k => $v) {
			$pinmings = $this->task->gettidlistpinming_caij($v['id']);
			if (!empty($pinmings)) {
				$list[$k]['openflg1'] = 1;
			} else {
				$list[$k]['openflg1'] = 0;
			}
		}
		foreach ($list as $kk=>$vv){
			$flg1 = 0;
			$flg2 = 0;
			$kid = $vv['id'];
			//预算表数据获取
			$listone1 = $this->role->getgoodsByIdxiaojiejeiduibiyu($kid);
//			$listone2 = $this->role->getgoodsByIdxiaojiejeiduibi1($kid);
			if (!empty($listone1) || !empty($listone2)){
				$flg1 = 1;
			}
			//决算表数据获取
			$listone11 = $this->role->getgoodsByIdxiaojiejeiduibijue($kid);
//			$listone22 = $this->role->getgoodsByIdxiaojiejeiduibi22($kid);
			if (!empty($listone11) || !empty($listone22)){
				$flg2 = 1;
			}
			if ($flg1 == 1 && $flg2 == 1){
				$list[$kk]['duibiflg'] = 1;
			}else{
				$list[$kk]['duibiflg'] = 0;
			}
		}
		$data["list"] = $list;
		$this->display("goods/goods_list1_caij", $data);
	}
	public function goods_add_new22_caij()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$data['id'] = $id;
		$this->display("goods/goods_add_new22_caij", $data);
	}
	public function goods_save2_caij()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}

		$sehaos = isset($_POST["sehao"]) ? $_POST["sehao"] : '';
		if (empty($sehaos[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加色号!"));
			return;
		}
		$pinfan = isset($_POST["pinfan"]) ? $_POST["pinfan"] : '';
		if (empty($pinfan[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加品番!"));
			return;
		}
		$caiduanshu = isset($_POST["caiduanshu"]) ? $_POST["caiduanshu"] : '';
		if (empty($caiduanshu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加裁断数量!"));
			return;
		}
		$zhishishu = isset($_POST["zhishishu"]) ? $_POST["zhishishu"] : '';
		if (empty($zhishishu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加指示数量!"));
			return;
		}

		foreach ($sehaos as $k => $v) {
			if (empty($v) || empty($pinfan[$k]) || empty($caiduanshu[$k]) || empty($zhishishu[$k])) {
				continue;
			}
			$this->role->role_save123_caij($v,$pinfan[$k],$caiduanshu[$k],$zhishishu[$k],$id,time());
		}
		echo json_encode(array('success' => true, 'msg' => "操作成功。"));
	}
	public function goods_edit_new22_caij()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$data = array();
		$data['id'] = $id;
		$kuanhaos = $this->task->gettidlistpinming_caij($id);

		$data['caiduanshu1'] = '';
		$data['pinfan1'] = '';
		$data['sehao1'] = '';
		$data['zhishishu1'] = '';

		$data['caiduanshu2'] = '';
		$data['pinfan2'] = '';
		$data['sehao2'] = '';
		$data['zhishishu2'] = '';

		$data['caiduanshu3'] = '';
		$data['pinfan3'] = '';
		$data['sehao3'] = '';
		$data['zhishishu3'] = '';

		$data['caiduanshu4'] = '';
		$data['pinfan4'] = '';
		$data['sehao4'] = '';
		$data['zhishishu4'] = '';

		$data['caiduanshu5'] = '';
		$data['pinfan5'] = '';
		$data['sehao5'] = '';
		$data['zhishishu5'] = '';

		$data['caiduanshu6'] = '';
		$data['pinfan6'] = '';
		$data['sehao6'] = '';
		$data['zhishishu6'] = '';

		$data['caiduanshu7'] = '';
		$data['pinfan7'] = '';
		$data['sehao7'] = '';
		$data['zhishishu7'] = '';

		$data['caiduanshu8'] = '';
		$data['pinfan8'] = '';
		$data['sehao8'] = '';
		$data['zhishishu8'] = '';

		$data['caiduanshu9'] = '';
		$data['pinfan9'] = '';
		$data['sehao9'] = '';
		$data['zhishishu9'] = '';

		$data['caiduanshu10'] = '';
		$data['pinfan10'] = '';
		$data['sehao10'] = '';
		$data['zhishishu10'] = '';

		if (!empty($kuanhaos[0]['sehao'])) {
			$data['sehao1'] = $kuanhaos[0]['sehao'];
			$data['pinfan1'] = $kuanhaos[0]['pinfan'];
			$data['caiduanshu1'] = $kuanhaos[0]['caiduanshu'];
			$data['zhishishu1'] = $kuanhaos[0]['zhishishu'];
		}

		if (!empty($kuanhaos[1]['sehao'])) {
			$data['sehao2'] = $kuanhaos[1]['sehao'];
			$data['pinfan2'] = $kuanhaos[1]['pinfan'];
			$data['caiduanshu2'] = $kuanhaos[1]['caiduanshu'];
			$data['zhishishu2'] = $kuanhaos[1]['zhishishu'];
		}

		if (!empty($kuanhaos[2]['sehao'])) {
			$data['sehao3'] = $kuanhaos[2]['sehao'];
			$data['pinfan3'] = $kuanhaos[2]['pinfan'];
			$data['caiduanshu3'] = $kuanhaos[2]['caiduanshu'];
			$data['zhishishu3'] = $kuanhaos[2]['zhishishu'];
		}

		if (!empty($kuanhaos[3]['sehao'])) {
			$data['sehao4'] = $kuanhaos[3]['sehao'];
			$data['pinfan4'] = $kuanhaos[3]['pinfan'];
			$data['caiduanshu4'] = $kuanhaos[3]['caiduanshu'];
			$data['zhishishu4'] = $kuanhaos[3]['zhishishu'];
		}

		if (!empty($kuanhaos[4]['sehao'])) {
			$data['sehao5'] = $kuanhaos[4]['sehao'];
			$data['pinfan5'] = $kuanhaos[4]['pinfan'];
			$data['caiduanshu5'] = $kuanhaos[4]['caiduanshu'];
			$data['zhishishu5'] = $kuanhaos[4]['zhishishu'];
		}

		if (!empty($kuanhaos[5]['sehao'])) {
			$data['sehao6'] = $kuanhaos[5]['sehao'];
			$data['pinfan6'] = $kuanhaos[5]['pinfan'];
			$data['caiduanshu6'] = $kuanhaos[5]['caiduanshu'];
			$data['zhishishu6'] = $kuanhaos[5]['zhishishu'];
		}

		if (!empty($kuanhaos[6]['sehao'])) {
			$data['sehao7'] = $kuanhaos[6]['sehao'];
			$data['pinfan7'] = $kuanhaos[6]['pinfan'];
			$data['caiduanshu7'] = $kuanhaos[6]['caiduanshu'];
			$data['zhishishu7'] = $kuanhaos[6]['zhishishu'];
		}

		if (!empty($kuanhaos[7]['sehao'])) {
			$data['sehao8'] = $kuanhaos[7]['sehao'];
			$data['pinfan8'] = $kuanhaos[7]['pinfan'];
			$data['caiduanshu8'] = $kuanhaos[7]['caiduanshu'];
			$data['zhishishu8'] = $kuanhaos[7]['zhishishu'];
		}

		if (!empty($kuanhaos[8]['sehao'])) {
			$data['sehao9'] = $kuanhaos[8]['sehao'];
			$data['pinfan9'] = $kuanhaos[8]['pinfan'];
			$data['caiduanshu9'] = $kuanhaos[8]['caiduanshu'];
			$data['zhishishu9'] = $kuanhaos[8]['zhishishu'];
		}

		if (!empty($kuanhaos[9]['sehao'])) {
			$data['sehao10'] = $kuanhaos[9]['sehao'];
			$data['pinfan10'] = $kuanhaos[9]['pinfan'];
			$data['caiduanshu10'] = $kuanhaos[9]['caiduanshu'];
			$data['zhishishu10'] = $kuanhaos[9]['zhishishu'];
		}
		$this->display("goods/goods_edit_new22_caij", $data);
	}
	public function goods_edit_new22_caitongji()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$data = array();
		$data['id'] = $id;
		$kuanhaos = $this->task->gettidlistpinming_cai($id);

		$data['caiduanshu1'] = '';
		$data['pinfan1'] = '';
		$data['sehao1'] = '';
		$data['zhishishu1'] = '';
		$data['biaoji1'] = '';
		$data['beizhu1'] = '';
		$data['zhuangxiangxinxi1'] = '';
		$data['zhuangxiangshuliang1'] = '';

		$data['caiduanshu2'] = '';
		$data['pinfan2'] = '';
		$data['sehao2'] = '';
		$data['zhishishu2'] = '';
		$data['biaoji2'] = '';
		$data['beizhu2'] = '';
		$data['zhuangxiangxinxi2'] = '';
		$data['zhuangxiangshuliang2'] = '';

		$data['caiduanshu3'] = '';
		$data['pinfan3'] = '';
		$data['sehao3'] = '';
		$data['zhishishu3'] = '';
		$data['biaoji3'] = '';
		$data['beizhu3'] = '';
		$data['zhuangxiangxinxi3'] = '';
		$data['zhuangxiangshuliang3'] = '';

		$data['caiduanshu4'] = '';
		$data['pinfan4'] = '';
		$data['sehao4'] = '';
		$data['zhishishu4'] = '';
		$data['biaoji4'] = '';
		$data['beizhu4'] = '';
		$data['zhuangxiangxinxi4'] = '';
		$data['zhuangxiangshuliang4'] = '';

		$data['caiduanshu5'] = '';
		$data['pinfan5'] = '';
		$data['sehao5'] = '';
		$data['zhishishu5'] = '';
		$data['biaoji5'] = '';
		$data['beizhu5'] = '';
		$data['zhuangxiangxinxi5'] = '';
		$data['zhuangxiangshuliang5'] = '';

		$data['caiduanshu6'] = '';
		$data['pinfan6'] = '';
		$data['sehao6'] = '';
		$data['zhishishu6'] = '';
		$data['biaoji6'] = '';
		$data['beizhu6'] = '';
		$data['zhuangxiangxinxi6'] = '';
		$data['zhuangxiangshuliang6'] = '';

		$data['caiduanshu7'] = '';
		$data['pinfan7'] = '';
		$data['sehao7'] = '';
		$data['zhishishu7'] = '';
		$data['biaoji7'] = '';
		$data['beizhu7'] = '';
		$data['zhuangxiangxinxi7'] = '';
		$data['zhuangxiangshuliang7'] = '';

		$data['caiduanshu8'] = '';
		$data['pinfan8'] = '';
		$data['sehao8'] = '';
		$data['zhishishu8'] = '';
		$data['biaoji8'] = '';
		$data['beizhu8'] = '';
		$data['zhuangxiangxinxi8'] = '';
		$data['zhuangxiangshuliang8'] = '';

		$data['caiduanshu9'] = '';
		$data['pinfan9'] = '';
		$data['sehao9'] = '';
		$data['zhishishu9'] = '';
		$data['biaoji9'] = '';
		$data['beizhu9'] = '';
		$data['zhuangxiangxinxi9'] = '';
		$data['zhuangxiangshuliang9'] = '';

		$data['caiduanshu10'] = '';
		$data['pinfan10'] = '';
		$data['sehao10'] = '';
		$data['zhishishu10'] = '';
		$data['biaoji10'] = '';
		$data['beizhu10'] = '';
		$data['zhuangxiangxinxi10'] = '';
		$data['zhuangxiangshuliang10'] = '';

		if (!empty($kuanhaos[0]['sehao'])) {
			$data['sehao1'] = $kuanhaos[0]['sehao'];
			$data['pinfan1'] = $kuanhaos[0]['pinfan'];
			$data['caiduanshu1'] = $kuanhaos[0]['caiduanshu'];
			$data['zhishishu1'] = $kuanhaos[0]['zhishishu'];
			$data['biaoji1'] = $kuanhaos[0]['biaoji'];
			$data['beizhu1'] = $kuanhaos[0]['beizhu'];
			$data['zhuangxiangxinxi1'] = $kuanhaos[0]['zhuangxiangxinxi'];
			$data['zhuangxiangshuliang1'] = $kuanhaos[0]['zhuangxiangshuliang'];
		}

		if (!empty($kuanhaos[1]['sehao'])) {
			$data['sehao2'] = $kuanhaos[1]['sehao'];
			$data['pinfan2'] = $kuanhaos[1]['pinfan'];
			$data['caiduanshu2'] = $kuanhaos[1]['caiduanshu'];
			$data['zhishishu2'] = $kuanhaos[1]['zhishishu'];
			$data['biaoji2'] = $kuanhaos[1]['biaoji'];
			$data['beizhu2'] = $kuanhaos[1]['beizhu'];
			$data['zhuangxiangxinxi2'] = $kuanhaos[1]['zhuangxiangxinxi'];
			$data['zhuangxiangshuliang2'] = $kuanhaos[1]['zhuangxiangshuliang'];
		}

		if (!empty($kuanhaos[2]['sehao'])) {
			$data['sehao3'] = $kuanhaos[2]['sehao'];
			$data['pinfan3'] = $kuanhaos[2]['pinfan'];
			$data['caiduanshu3'] = $kuanhaos[2]['caiduanshu'];
			$data['zhishishu3'] = $kuanhaos[2]['zhishishu'];
			$data['biaoji3'] = $kuanhaos[2]['biaoji'];
			$data['beizhu3'] = $kuanhaos[2]['beizhu'];
			$data['zhuangxiangxinxi3'] = $kuanhaos[2]['zhuangxiangxinxi'];
			$data['zhuangxiangshuliang3'] = $kuanhaos[2]['zhuangxiangshuliang'];
		}

		if (!empty($kuanhaos[3]['sehao'])) {
			$data['sehao4'] = $kuanhaos[3]['sehao'];
			$data['pinfan4'] = $kuanhaos[3]['pinfan'];
			$data['caiduanshu4'] = $kuanhaos[3]['caiduanshu'];
			$data['zhishishu4'] = $kuanhaos[3]['zhishishu'];
			$data['biaoji4'] = $kuanhaos[3]['biaoji'];
			$data['beizhu4'] = $kuanhaos[3]['beizhu'];
			$data['zhuangxiangxinxi4'] = $kuanhaos[3]['zhuangxiangxinxi'];
			$data['zhuangxiangshuliang4'] = $kuanhaos[3]['zhuangxiangshuliang'];
		}

		if (!empty($kuanhaos[4]['sehao'])) {
			$data['sehao5'] = $kuanhaos[4]['sehao'];
			$data['pinfan5'] = $kuanhaos[4]['pinfan'];
			$data['caiduanshu5'] = $kuanhaos[4]['caiduanshu'];
			$data['zhishishu5'] = $kuanhaos[4]['zhishishu'];
			$data['biaoji5'] = $kuanhaos[4]['biaoji'];
			$data['beizhu5'] = $kuanhaos[4]['beizhu'];
			$data['zhuangxiangxinxi5'] = $kuanhaos[4]['zhuangxiangxinxi'];
			$data['zhuangxiangshuliang5'] = $kuanhaos[4]['zhuangxiangshuliang'];
		}

		if (!empty($kuanhaos[5]['sehao'])) {
			$data['sehao6'] = $kuanhaos[5]['sehao'];
			$data['pinfan6'] = $kuanhaos[5]['pinfan'];
			$data['caiduanshu6'] = $kuanhaos[5]['caiduanshu'];
			$data['zhishishu6'] = $kuanhaos[5]['zhishishu'];
			$data['biaoji6'] = $kuanhaos[5]['biaoji'];
			$data['beizhu6'] = $kuanhaos[5]['beizhu'];
			$data['zhuangxiangxinxi6'] = $kuanhaos[5]['zhuangxiangxinxi'];
			$data['zhuangxiangshuliang6'] = $kuanhaos[5]['zhuangxiangshuliang'];
		}

		if (!empty($kuanhaos[6]['sehao'])) {
			$data['sehao7'] = $kuanhaos[6]['sehao'];
			$data['pinfan7'] = $kuanhaos[6]['pinfan'];
			$data['caiduanshu7'] = $kuanhaos[6]['caiduanshu'];
			$data['zhishishu7'] = $kuanhaos[6]['zhishishu'];
			$data['biaoji7'] = $kuanhaos[6]['biaoji'];
			$data['beizhu7'] = $kuanhaos[6]['beizhu'];
			$data['zhuangxiangxinxi7'] = $kuanhaos[6]['zhuangxiangxinxi'];
			$data['zhuangxiangshuliang7'] = $kuanhaos[6]['zhuangxiangshuliang'];
		}

		if (!empty($kuanhaos[7]['sehao'])) {
			$data['sehao8'] = $kuanhaos[7]['sehao'];
			$data['pinfan8'] = $kuanhaos[7]['pinfan'];
			$data['caiduanshu8'] = $kuanhaos[7]['caiduanshu'];
			$data['zhishishu8'] = $kuanhaos[7]['zhishishu'];
			$data['biaoji8'] = $kuanhaos[7]['biaoji'];
			$data['beizhu8'] = $kuanhaos[7]['beizhu'];
			$data['zhuangxiangxinxi8'] = $kuanhaos[7]['zhuangxiangxinxi'];
			$data['zhuangxiangshuliang8'] = $kuanhaos[7]['zhuangxiangshuliang'];
		}

		if (!empty($kuanhaos[8]['sehao'])) {
			$data['sehao9'] = $kuanhaos[8]['sehao'];
			$data['pinfan9'] = $kuanhaos[8]['pinfan'];
			$data['caiduanshu9'] = $kuanhaos[8]['caiduanshu'];
			$data['zhishishu9'] = $kuanhaos[8]['zhishishu'];
			$data['biaoji9'] = $kuanhaos[8]['biaoji'];
			$data['beizhu9'] = $kuanhaos[8]['beizhu'];
			$data['zhuangxiangxinxi9'] = $kuanhaos[8]['zhuangxiangxinxi'];
			$data['zhuangxiangshuliang9'] = $kuanhaos[8]['zhuangxiangshuliang'];
		}

		if (!empty($kuanhaos[9]['sehao'])) {
			$data['sehao10'] = $kuanhaos[9]['sehao'];
			$data['pinfan10'] = $kuanhaos[9]['pinfan'];
			$data['caiduanshu10'] = $kuanhaos[9]['caiduanshu'];
			$data['zhishishu10'] = $kuanhaos[9]['zhishishu'];
			$data['biaoji10'] = $kuanhaos[9]['biaoji'];
			$data['beizhu10'] = $kuanhaos[9]['beizhu'];
			$data['zhuangxiangxinxi10'] = $kuanhaos[9]['zhuangxiangxinxi'];
			$data['zhuangxiangshuliang10'] = $kuanhaos[9]['zhuangxiangshuliang'];
		}
		$this->display("goods/goods_edit_new22_caitongji", $data);
	}
	public function goods_save_edit2_caij()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}

		$sehaos = isset($_POST["sehao"]) ? $_POST["sehao"] : '';
		if (empty($sehaos[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加色号!"));
			return;
		}
		$pinfan = isset($_POST["pinfan"]) ? $_POST["pinfan"] : '';
		if (empty($pinfan[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加品番!"));
			return;
		}
		$caiduanshu = isset($_POST["caiduanshu"]) ? $_POST["caiduanshu"] : '';
		if (empty($caiduanshu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加裁断数量!"));
			return;
		}
		$zhishishu = isset($_POST["zhishishu"]) ? $_POST["zhishishu"] : '';
		if (empty($zhishishu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加指示数量!"));
			return;
		}
		$this->role->goodsimg_delete4_caij($id);
		foreach ($sehaos as $k => $v) {
			if (empty($v) || empty($pinfan[$k]) || empty($caiduanshu[$k]) || empty($zhishishu[$k])) {
				continue;
			}
			$this->role->role_save123_caij($v,$pinfan[$k],$caiduanshu[$k],$zhishishu[$k],$id,time());
		}

		echo json_encode(array('success' => true, 'msg' => "操作成功。"));

	}
	public function goods_save_edit2_caitongji()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}

		$sehaos = isset($_POST["sehao"]) ? $_POST["sehao"] : '';
		if (empty($sehaos[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加色号!"));
			return;
		}
		$pinfan = isset($_POST["pinfan"]) ? $_POST["pinfan"] : '';
		if (empty($pinfan[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加品番!"));
			return;
		}
		$caiduanshu = isset($_POST["caiduanshu"]) ? $_POST["caiduanshu"] : '';
		if (empty($caiduanshu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加裁断数量!"));
			return;
		}
		$zhishishu = isset($_POST["zhishishu"]) ? $_POST["zhishishu"] : '';
		if (empty($zhishishu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加指示数量!"));
			return;
		}
		$zhuangxiangxinxi = isset($_POST["zhuangxiangxinxi"]) ? $_POST["zhuangxiangxinxi"] : '';
		$zhuangxiangshuliang = isset($_POST["zhuangxiangshuliang"]) ? $_POST["zhuangxiangshuliang"] : '';

		$biaoji = isset($_POST["biaoji"]) ? $_POST["biaoji"] : '';
		if (empty($biaoji[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加标记!"));
			return;
		}
		$beizhu = isset($_POST["beizhu"]) ? $_POST["beizhu"] : '';
		if (empty($beizhu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加备注!"));
			return;
		}
		$this->role->goodsimg_delete4_cai($id);
		foreach ($sehaos as $k => $v) {
			if (empty($v) || empty($pinfan[$k]) || empty($caiduanshu[$k]) || empty($zhishishu[$k]) || empty($biaoji[$k]) || empty($beizhu[$k])) {
				continue;
			}
			if (empty($zhuangxiangxinxi[$k])){
				$zhuangxiangxinxi[$k] = 0;
			}
			if (empty($zhuangxiangshuliang[$k])){
				$zhuangxiangshuliang[$k] = 0;
			}
			$this->role->role_save123_caitongji($v,$pinfan[$k],$caiduanshu[$k],$zhishishu[$k],$id,time(),$zhuangxiangxinxi[$k],$zhuangxiangshuliang[$k],$biaoji[$k],$beizhu[$k]);
		}

		echo json_encode(array('success' => true, 'msg' => "操作成功。"));

	}
	public function goods_list_bao_duibi_details_jue()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$data = array();

		$kuanhaosyusuan = $this->task->gettidlistjichu1cai($id);
		$kuanhaosjuesuan = $this->task->gettidlistjichu1juecai($id);

		$data['sehao1'] = '';
		$data['pinfan1'] = '';
		$data['caiduanshu1'] = '';
		$data['zhishishu1'] = '';

		$data['sehao2'] = '';
		$data['pinfan2'] = '';
		$data['caiduanshu2'] = '';
		$data['zhishishu2'] = '';

		$data['sehao3'] = '';
		$data['pinfan3'] = '';
		$data['caiduanshu3'] = '';
		$data['zhishishu3'] = '';

		$data['sehao4'] = '';
		$data['pinfan4'] = '';
		$data['caiduanshu4'] = '';
		$data['zhishishu4'] = '';

		$data['sehao5'] = '';
		$data['pinfan5'] = '';
		$data['caiduanshu5'] = '';
		$data['zhishishu5'] = '';

		$data['sehao6'] = '';
		$data['pinfan6'] = '';
		$data['caiduanshu6'] = '';
		$data['zhishishu6'] = '';

		$data['sehao7'] = '';
		$data['pinfan7'] = '';
		$data['caiduanshu7'] = '';
		$data['zhishishu7'] = '';

		$data['sehao8'] = '';
		$data['pinfan8'] = '';
		$data['caiduanshu8'] = '';
		$data['zhishishu8'] = '';

		$data['sehao9'] = '';
		$data['pinfan9'] = '';
		$data['caiduanshu9'] = '';
		$data['zhishishu9'] = '';

		$data['sehao10'] = '';
		$data['pinfan10'] = '';
		$data['caiduanshu10'] = '';
		$data['zhishishu10'] = '';

		$data['yi_flg'] = 0;
		if (!empty($kuanhaosyusuan[0]['sehao'])) {
			$data['sehao1'] = $kuanhaosyusuan[0]['sehao'];
			$data['pinfan1'] = $kuanhaosyusuan[0]['pinfan'];
			$data['caiduanshu1'] = $kuanhaosyusuan[0]['caiduanshu'];
			$data['zhishishu1'] = $kuanhaosyusuan[0]['zhishishu'];
			$yi_result = $this->task->getqubieduibiresultcai($id,$data['sehao1'],$data['pinfan1'],$data['caiduanshu1'],$data['zhishishu1']);
			if(empty($yi_result)){
				$data['yi_flg'] = 1;
			}
		}

		$data['er_flg'] = 0;
		if (!empty($kuanhaosyusuan[1]['sehao'])) {
			$data['sehao2'] = $kuanhaosyusuan[1]['sehao'];
			$data['pinfan2'] = $kuanhaosyusuan[1]['pinfan'];
			$data['caiduanshu2'] = $kuanhaosyusuan[1]['caiduanshu'];
			$data['zhishishu2'] = $kuanhaosyusuan[1]['zhishishu'];
			$er_result = $this->task->getqubieduibiresultcai($id,$data['sehao2'],$data['pinfan2'],$data['caiduanshu2'],$data['zhishishu2']);
			if(empty($er_result)){
				$data['er_flg'] = 1;
			}
		}

		$data['san_flg'] = 0;
		if (!empty($kuanhaosyusuan[2]['sehao'])) {
			$data['sehao3'] = $kuanhaosyusuan[2]['sehao'];
			$data['pinfan3'] = $kuanhaosyusuan[2]['pinfan'];
			$data['caiduanshu3'] = $kuanhaosyusuan[2]['caiduanshu'];
			$data['zhishishu3'] = $kuanhaosyusuan[2]['zhishishu'];
			$san_result = $this->task->getqubieduibiresultcai($id,$data['sehao3'],$data['pinfan3'],$data['caiduanshu3'],$data['zhishishu3']);
			if(empty($san_result)){
				$data['san_flg'] = 1;
			}
		}

		$data['si_flg'] = 0;
		if (!empty($kuanhaosyusuan[3]['sehao'])) {
			$data['sehao4'] = $kuanhaosyusuan[3]['sehao'];
			$data['pinfan4'] = $kuanhaosyusuan[3]['pinfan'];
			$data['caiduanshu4'] = $kuanhaosyusuan[3]['caiduanshu'];
			$data['zhishishu4'] = $kuanhaosyusuan[3]['zhishishu'];
			$si_result = $this->task->getqubieduibiresultcai($id,$data['sehao4'],$data['pinfan4'],$data['caiduanshu4'],$data['zhishishu4']);
			if(empty($si_result)){
				$data['si_flg'] = 1;
			}
		}

		$data['wu_flg'] = 0;
		if (!empty($kuanhaosyusuan[4]['sehao'])) {
			$data['sehao5'] = $kuanhaosyusuan[4]['sehao'];
			$data['pinfan5'] = $kuanhaosyusuan[4]['pinfan'];
			$data['caiduanshu5'] = $kuanhaosyusuan[4]['caiduanshu'];
			$data['zhishishu5'] = $kuanhaosyusuan[4]['zhishishu'];
			$wu_result = $this->task->getqubieduibiresultcai($id,$data['sehao5'],$data['pinfan5'],$data['caiduanshu5'],$data['zhishishu5']);
			if(empty($wu_result)){
				$data['wu_flg'] = 1;
			}
		}

		$data['liu_flg'] = 0;
		if (!empty($kuanhaosyusuan[5]['sehao'])) {
			$data['sehao6'] = $kuanhaosyusuan[5]['sehao'];
			$data['pinfan6'] = $kuanhaosyusuan[5]['pinfan'];
			$data['caiduanshu6'] = $kuanhaosyusuan[5]['caiduanshu'];
			$data['zhishishu6'] = $kuanhaosyusuan[5]['zhishishu'];
			$liu_result = $this->task->getqubieduibiresultcai($id,$data['sehao6'],$data['pinfan6'],$data['caiduanshu6'],$data['zhishishu6']);
			if(empty($liu_result)){
				$data['liu_flg'] = 1;
			}
		}

		$data['qi_flg'] = 0;
		if (!empty($kuanhaosyusuan[6]['sehao'])) {
			$data['sehao7'] = $kuanhaosyusuan[6]['sehao'];
			$data['pinfan7'] = $kuanhaosyusuan[6]['pinfan'];
			$data['caiduanshu7'] = $kuanhaosyusuan[6]['caiduanshu'];
			$data['zhishishu7'] = $kuanhaosyusuan[6]['zhishishu'];
			$qi_result = $this->task->getqubieduibiresultcai($id,$data['sehao7'],$data['pinfan7'],$data['caiduanshu7'],$data['zhishishu7']);
			if(empty($qi_result)){
				$data['qi_flg'] = 1;
			}
		}

		$data['ba_flg'] = 0;
		if (!empty($kuanhaosyusuan[7]['sehao'])) {
			$data['sehao8'] = $kuanhaosyusuan[7]['sehao'];
			$data['pinfan8'] = $kuanhaosyusuan[7]['pinfan'];
			$data['caiduanshu8'] = $kuanhaosyusuan[7]['caiduanshu'];
			$data['zhishishu8'] = $kuanhaosyusuan[7]['zhishishu'];
			$ba_result = $this->task->getqubieduibiresultcai($id,$data['sehao8'],$data['pinfan8'],$data['caiduanshu8'],$data['zhishishu8']);
			if(empty($ba_result)){
				$data['ba_flg'] = 1;
			}
		}

		$data['jiu_flg'] = 0;
		if (!empty($kuanhaosyusuan[8]['sehao'])) {
			$data['sehao9'] = $kuanhaosyusuan[8]['sehao'];
			$data['pinfan9'] = $kuanhaosyusuan[8]['pinfan'];
			$data['caiduanshu9'] = $kuanhaosyusuan[8]['caiduanshu'];
			$data['zhishishu9'] = $kuanhaosyusuan[8]['zhishishu'];
			$jiu_result = $this->task->getqubieduibiresultcai($id,$data['sehao9'],$data['pinfan9'],$data['caiduanshu9'],$data['zhishishu9']);
			if(empty($jiu_result)){
				$data['jiu_flg'] = 1;
			}
		}

		$data['shi_flg'] = 0;
		if (!empty($kuanhaosyusuan[9]['sehao'])) {
			$data['sehao10'] = $kuanhaosyusuan[9]['sehao'];
			$data['pinfan10'] = $kuanhaosyusuan[9]['pinfan'];
			$data['caiduanshu10'] = $kuanhaosyusuan[9]['caiduanshu'];
			$data['zhishishu10'] = $kuanhaosyusuan[9]['zhishishu'];
			$shi_result = $this->task->getqubieduibiresultcai($id,$data['sehao10'],$data['pinfan10'],$data['caiduanshu10'],$data['zhishishu10']);
			if(empty($shi_result)){
				$data['shi_flg'] = 1;
			}
		}


		$data['jsehao1'] = '';
		$data['jpinfan1'] = '';
		$data['jcaiduanshu1'] = '';
		$data['jzhishishu1'] = '';

		$data['jsehao2'] = '';
		$data['jpinfan2'] = '';
		$data['jcaiduanshu2'] = '';
		$data['jzhishishu2'] = '';

		$data['jsehao3'] = '';
		$data['jpinfan3'] = '';
		$data['jcaiduanshu3'] = '';
		$data['jzhishishu3'] = '';

		$data['jsehao4'] = '';
		$data['jpinfan4'] = '';
		$data['jcaiduanshu4'] = '';
		$data['jzhishishu4'] = '';

		$data['jsehao5'] = '';
		$data['jpinfan5'] = '';
		$data['jcaiduanshu5'] = '';
		$data['jzhishishu5'] = '';

		$data['jsehao6'] = '';
		$data['jpinfan6'] = '';
		$data['jcaiduanshu6'] = '';
		$data['jzhishishu6'] = '';

		$data['jsehao7'] = '';
		$data['jpinfan7'] = '';
		$data['jcaiduanshu7'] = '';
		$data['jzhishishu7'] = '';

		$data['jsehao8'] = '';
		$data['jpinfan8'] = '';
		$data['jcaiduanshu8'] = '';
		$data['jzhishishu8'] = '';

		$data['jsehao9'] = '';
		$data['jpinfan9'] = '';
		$data['jcaiduanshu9'] = '';
		$data['jzhishishu9'] = '';

		$data['jsehao10'] = '';
		$data['jpinfan10'] = '';
		$data['jcaiduanshu10'] = '';
		$data['jzhishishu10'] = '';

		if (!empty($kuanhaosjuesuan[0]['sehao'])) {
			$data['jsehao1'] = $kuanhaosjuesuan[0]['sehao'];
			$data['jpinfan1'] = $kuanhaosjuesuan[0]['pinfan'];
			$data['jcaiduanshu1'] = $kuanhaosjuesuan[0]['caiduanshu'];
			$data['jzhishishu1'] = $kuanhaosjuesuan[0]['zhishishu'];
			if (empty($kuanhaosyusuan[0]['sehao'])){
				$data['yi_flg'] = 1;
			}
		}
		if (!empty($kuanhaosjuesuan[1]['sehao'])) {
			$data['jsehao2'] = $kuanhaosjuesuan[1]['sehao'];
			$data['jpinfan2'] = $kuanhaosjuesuan[1]['pinfan'];
			$data['jcaiduanshu2'] = $kuanhaosjuesuan[1]['caiduanshu'];
			$data['jzhishishu2'] = $kuanhaosjuesuan[1]['zhishishu'];
			if (empty($kuanhaosyusuan[1]['sehao'])){
				$data['er_flg'] = 1;
			}
		}
		if (!empty($kuanhaosjuesuan[2]['sehao'])) {
			$data['jsehao3'] = $kuanhaosjuesuan[2]['sehao'];
			$data['jpinfan3'] = $kuanhaosjuesuan[2]['pinfan'];
			$data['jcaiduanshu3'] = $kuanhaosjuesuan[2]['caiduanshu'];
			$data['jzhishishu3'] = $kuanhaosjuesuan[2]['zhishishu'];
			if (empty($kuanhaosyusuan[2]['sehao'])){
				$data['san_flg'] = 1;
			}
		}
		if (!empty($kuanhaosjuesuan[3]['sehao'])) {
			$data['jsehao4'] = $kuanhaosjuesuan[3]['sehao'];
			$data['jpinfan4'] = $kuanhaosjuesuan[3]['pinfan'];
			$data['jcaiduanshu4'] = $kuanhaosjuesuan[3]['caiduanshu'];
			$data['jzhishishu4'] = $kuanhaosjuesuan[3]['zhishishu'];
			if (empty($kuanhaosyusuan[3]['sehao'])){
				$data['si_flg'] = 1;
			}
		}
		if (!empty($kuanhaosjuesuan[4]['sehao'])) {
			$data['jsehao5'] = $kuanhaosjuesuan[4]['sehao'];
			$data['jpinfan5'] = $kuanhaosjuesuan[4]['pinfan'];
			$data['jcaiduanshu5'] = $kuanhaosjuesuan[4]['caiduanshu'];
			$data['jzhishishu5'] = $kuanhaosjuesuan[4]['zhishishu'];
			if (empty($kuanhaosyusuan[4]['sehao'])){
				$data['wu_flg'] = 1;
			}
		}
		if (!empty($kuanhaosjuesuan[5]['sehao'])) {
			$data['jsehao6'] = $kuanhaosjuesuan[5]['sehao'];
			$data['jpinfan6'] = $kuanhaosjuesuan[5]['pinfan'];
			$data['jcaiduanshu6'] = $kuanhaosjuesuan[5]['caiduanshu'];
			$data['jzhishishu6'] = $kuanhaosjuesuan[5]['zhishishu'];
			if (empty($kuanhaosyusuan[5]['sehao'])){
				$data['liu_flg'] = 1;
			}
		}
		if (!empty($kuanhaosjuesuan[6]['sehao'])) {
			$data['jsehao7'] = $kuanhaosjuesuan[6]['sehao'];
			$data['jpinfan7'] = $kuanhaosjuesuan[6]['pinfan'];
			$data['jcaiduanshu7'] = $kuanhaosjuesuan[6]['caiduanshu'];
			$data['jzhishishu7'] = $kuanhaosjuesuan[6]['zhishishu'];
			if (empty($kuanhaosyusuan[6]['sehao'])){
				$data['qi_flg'] = 1;
			}
		}
		if (!empty($kuanhaosjuesuan[7]['sehao'])) {
			$data['jsehao8'] = $kuanhaosjuesuan[7]['sehao'];
			$data['jpinfan8'] = $kuanhaosjuesuan[7]['pinfan'];
			$data['jcaiduanshu8'] = $kuanhaosjuesuan[7]['caiduanshu'];
			$data['jzhishishu8'] = $kuanhaosjuesuan[7]['zhishishu'];
			if (empty($kuanhaosyusuan[7]['sehao'])){
				$data['ba_flg'] = 1;
			}
		}
		if (!empty($kuanhaosjuesuan[8]['sehao'])) {
			$data['jsehao9'] = $kuanhaosjuesuan[8]['sehao'];
			$data['jpinfan9'] = $kuanhaosjuesuan[8]['pinfan'];
			$data['jcaiduanshu9'] = $kuanhaosjuesuan[8]['caiduanshu'];
			$data['jzhishishu9'] = $kuanhaosjuesuan[8]['zhishishu'];
			if (empty($kuanhaosyusuan[8]['sehao'])){
				$data['jiu_flg'] = 1;
			}
		}
		if (!empty($kuanhaosjuesuan[9]['sehao'])) {
			$data['jsehao10'] = $kuanhaosjuesuan[9]['sehao'];
			$data['jpinfan10'] = $kuanhaosjuesuan[9]['pinfan'];
			$data['jcaiduanshu10'] = $kuanhaosjuesuan[9]['caiduanshu'];
			$data['jzhishishu10'] = $kuanhaosjuesuan[9]['zhishishu'];
			if (empty($kuanhaosyusuan[9]['sehao'])){
				$data['shi_flg'] = 1;
			}
		}

		$this->display("goods/goods_list_bao_duibi_details_jue", $data);
	}

	public function goods_add_new_shengchan()
	{
		$tidlist = $this->task->gettidlistjihua();
		$data['tidlist'] = $tidlist;
		$this->display("goods/goods_add_new_shengchan", $data);
	}
	public function goods_save_jihua()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$zuname = isset($_POST["zuname"]) ? $_POST["zuname"] : '';
		$zhipinfanhao = isset($_POST["zhipinfanhao"]) ? $_POST["zhipinfanhao"] : '';
		$pinming = isset($_POST["pinming"]) ? $_POST["pinming"] : '';
		$qihuashu = isset($_POST["qihuashu"]) ? $_POST["qihuashu"] : '';
		$naqi = isset($_POST["naqi"]) ? $_POST["naqi"] : '';
		$jihuariqi = isset($_POST["jihuariqi"]) ? $_POST["jihuariqi"] : '';
		$shangyue = isset($_POST["shangyue"]) ? $_POST["shangyue"] : 0;
		$add_time = time();
		$role_info = $this->role->getroleByname1_zhipinfanhao($zhipinfanhao,$zuname,$jihuariqi);
		if (!empty($role_info)) {
			echo json_encode(array('error' => true, 'msg' => "该制品番号:".$zhipinfanhao."在当前".$zuname.$jihuariqi."月份已经存在!"));
			return;
		}

//		$role_info1 = $this->role->getroleByname1_jihuariqi($jihuariqi);
//		if (!empty($role_info1)) {
//			echo json_encode(array('error' => true, 'msg' => "该计划日期已经存在!"));
//			return;
//		}

		$naqi = strtotime($naqi);
		$rid = $this->role->role_save1_jihua($zuname, $zhipinfanhao, $pinming, $qihuashu, $naqi, $jihuariqi, $add_time,$shangyue);
		if ($rid) {
			$this->role->role_saveerp_shengcanjihuadateold($rid,$add_time);
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
		}
	}
	public function goods_list_shengchan()
	{

		$zuname = isset($_GET['zuname']) ? $_GET['zuname'] : '';
		$jihuariqi = isset($_GET['jihuariqi']) ? $_GET['jihuariqi'] : date('Y-m',time());
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPageshengchandetails($zuname,$jihuariqi);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNewshengchandetails($page,$zuname,$jihuariqi);
		$data["zuname"] = $zuname;
		$data["jihuariqi"] = $jihuariqi;
		$data["excelwendang"] = $list[0]['excelwendang'];

		foreach ($list as $k=>$v){
			$sid = $v['id'];
			$rowdata = $this->role->geterp_shengcanjihuadate($sid);
			$list[$k]['y1'] = $rowdata['y1'];
			$list[$k]['y2'] = $rowdata['y2'];
			$list[$k]['y3'] = $rowdata['y3'];
			$list[$k]['y4'] = $rowdata['y4'];
			$list[$k]['y5'] = $rowdata['y5'];
			$list[$k]['y6'] = $rowdata['y6'];
			$list[$k]['y7'] = $rowdata['y7'];
			$list[$k]['y8'] = $rowdata['y8'];
			$list[$k]['y9'] = $rowdata['y9'];
			$list[$k]['y10'] = $rowdata['y10'];
			$list[$k]['y11'] = $rowdata['y11'];
			$list[$k]['y12'] = $rowdata['y12'];
			$list[$k]['y13'] = $rowdata['y13'];
			$list[$k]['y14'] = $rowdata['y14'];
			$list[$k]['y15'] = $rowdata['y15'];
			$list[$k]['y16'] = $rowdata['y16'];
			$list[$k]['y17'] = $rowdata['y17'];
			$list[$k]['y18'] = $rowdata['y18'];
			$list[$k]['y19'] = $rowdata['y19'];
			$list[$k]['y20'] = $rowdata['y20'];
			$list[$k]['y21'] = $rowdata['y21'];
			$list[$k]['y22'] = $rowdata['y22'];
			$list[$k]['y23'] = $rowdata['y23'];
			$list[$k]['y24'] = $rowdata['y24'];
			$list[$k]['y25'] = $rowdata['y25'];
			$list[$k]['y26'] = $rowdata['y26'];
			$list[$k]['y27'] = $rowdata['y27'];
			$list[$k]['y28'] = $rowdata['y28'];
			$list[$k]['y29'] = $rowdata['y29'];
			$list[$k]['y30'] = $rowdata['y30'];
			$list[$k]['y31'] = $rowdata['y31'];
			$list[$k]['heji'] = $rowdata['heji'];
			$list[$k]['zengjian'] = $rowdata['zengjian'];
			$list[$k]['shuoming'] = $rowdata['shuoming'];
			$list[$k]['danjia'] = $rowdata['danjia'];
		}
		
		$data["list"] = $list;
		$this->display("goods/goods_list_shengchan", $data);
	}
	function getchanzhi($id,$list){
        $onces=0;
        foreach ($list as $num => $once){
            if($once[$id]>0){
               $onces=$onces+$once[$id]*$once['danjia']; 
            }
        }
        return $onces;
    }
	public function goods_edit_new_shengchan()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->role->getgoodsByIdshengchan($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$tidlist = $this->task->gettidlistjihua();
		$data = array();
		$data['zuname'] = $goods_info['zuname'];
		$data['zhipinfanhao'] = $goods_info['zhipinfanhao'];
		$data['pinming'] = $goods_info['pinming'];
		$data['qihuashu'] = $goods_info['qihuashu'];
		$data['naqi'] = $goods_info['naqi'];
		$data['jihuariqi'] = $goods_info['jihuariqi'];
		$data['shangyue'] = $goods_info['shangyue'];
		$data['id'] = $id;
		$data['tidlist'] = $tidlist;

		$this->display("goods/goods_edit_new_shengchan", $data);
	}
	public function goods_save_edit_shengchan()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}

		$id = isset($_POST["id"]) ? $_POST["id"] : '';
		$zuname = isset($_POST["zuname"]) ? $_POST["zuname"] : '';
		$zhipinfanhao = isset($_POST["zhipinfanhao"]) ? $_POST["zhipinfanhao"] : '';
		$pinming = isset($_POST["pinming"]) ? $_POST["pinming"] : '';
		$qihuashu = isset($_POST["qihuashu"]) ? $_POST["qihuashu"] : '';
		$naqi = isset($_POST["naqi"]) ? $_POST["naqi"] : '';
		$jihuariqi = isset($_POST["jihuariqi"]) ? $_POST["jihuariqi"] : '';
		$add_time = time();

		$role_info = $this->role->getgoodsById22shengchan($zhipinfanhao,$zuname,$jihuariqi,$id);
		if (!empty($role_info)) {
			echo json_encode(array('error' => true, 'msg' => "该制品番号:".$zhipinfanhao."在当前".$zuname.$jihuariqi."月份已经存在!"));
			return;
		}

//		$role_info1 = $this->role->getgoodsById22shengchan_jihuariqi($jihuariqi, $id);
//		if (!empty($role_info1)) {
//			echo json_encode(array('error' => true, 'msg' => "该计划日期已经存在!"));
//			return;
//		}

		$naqi = strtotime($naqi);
		$result = $this->role->goods_save_edit_shengchan($zuname, $zhipinfanhao, $pinming, $qihuashu, $naqi, $jihuariqi, $add_time, $id);
		if ($result) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
		}
	}
	public function goods_delete_shengchan()
	{
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		if ($this->role->goods_delete_shengchan($id)) {
			echo json_encode(array('success' => true, 'msg' => "删除成功"));
		} else {
			echo json_encode(array('success' => false, 'msg' => "删除失败"));
		}
	}
	public function goods_edit_jichu_shengchan()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$label_info = $this->role->getlabelByIdyang_shengchan($id);
		if (empty($label_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$data = array();
		$data['id'] = $id;
		$data['y1'] = empty($label_info['y1'])?'0':$label_info['y1'];
		$data['y2'] = empty($label_info['y2'])?'0':$label_info['y2'];
		$data['y3'] = empty($label_info['y3'])?'0':$label_info['y3'];
		$data['y4'] = empty($label_info['y4'])?'0':$label_info['y4'];
		$data['y5'] = empty($label_info['y5'])?'0':$label_info['y5'];
		$data['y6'] = empty($label_info['y6'])?'0':$label_info['y6'];
		$data['y7'] = empty($label_info['y7'])?'0':$label_info['y7'];
		$data['y8'] = empty($label_info['y8'])?'0':$label_info['y8'];
		$data['y9'] = empty($label_info['y9'])?'0':$label_info['y9'];
		$data['y10'] = empty($label_info['y10'])?'0':$label_info['y10'];
		$data['y11'] = empty($label_info['y11'])?'0':$label_info['y11'];
		$data['y12'] = empty($label_info['y12'])?'0':$label_info['y12'];
		$data['y13'] = empty($label_info['y13'])?'0':$label_info['y13'];
		$data['y14'] = empty($label_info['y14'])?'0':$label_info['y14'];
		$data['y15'] = empty($label_info['y15'])?'0':$label_info['y15'];
		$data['y16'] = empty($label_info['y16'])?'0':$label_info['y16'];
		$data['y17'] = empty($label_info['y17'])?'0':$label_info['y17'];
		$data['y18'] = empty($label_info['y18'])?'0':$label_info['y18'];
		$data['y19'] = empty($label_info['y19'])?'0':$label_info['y19'];
		$data['y20'] = empty($label_info['y20'])?'0':$label_info['y20'];
		$data['y21'] = empty($label_info['y21'])?'0':$label_info['y21'];
		$data['y22'] = empty($label_info['y22'])?'0':$label_info['y22'];
		$data['y23'] = empty($label_info['y23'])?'0':$label_info['y23'];
		$data['y24'] = empty($label_info['y24'])?'0':$label_info['y24'];
		$data['y25'] = empty($label_info['y25'])?'0':$label_info['y25'];
		$data['y26'] = empty($label_info['y26'])?'0':$label_info['y26'];
		$data['y27'] = empty($label_info['y27'])?'0':$label_info['y27'];
		$data['y28'] = empty($label_info['y28'])?'0':$label_info['y28'];
		$data['y29'] = empty($label_info['y29'])?'0':$label_info['y29'];
		$data['y30'] = empty($label_info['y30'])?'0':$label_info['y30'];
		$data['y31'] = empty($label_info['y31'])?'0':$label_info['y31'];

		$data['j1'] = empty($label_info['j1'])?'0':$label_info['j1'];
		$data['j2'] = empty($label_info['j2'])?'0':$label_info['j2'];
		$data['j3'] = empty($label_info['j3'])?'0':$label_info['j3'];
		$data['j4'] = empty($label_info['j4'])?'0':$label_info['j4'];
		$data['j5'] = empty($label_info['j5'])?'0':$label_info['j5'];
		$data['j6'] = empty($label_info['j6'])?'0':$label_info['j6'];
		$data['j7'] = empty($label_info['j7'])?'0':$label_info['j7'];
		$data['j8'] = empty($label_info['j8'])?'0':$label_info['j8'];
		$data['j9'] = empty($label_info['j9'])?'0':$label_info['j9'];
		$data['j10'] = empty($label_info['j10'])?'0':$label_info['j10'];
		$data['j11'] = empty($label_info['j11'])?'0':$label_info['j11'];
		$data['j12'] = empty($label_info['j12'])?'0':$label_info['j12'];
		$data['j13'] = empty($label_info['j13'])?'0':$label_info['j13'];
		$data['j14'] = empty($label_info['j14'])?'0':$label_info['j14'];
		$data['j15'] = empty($label_info['j15'])?'0':$label_info['j15'];
		$data['j16'] = empty($label_info['j16'])?'0':$label_info['j16'];
		$data['j17'] = empty($label_info['j17'])?'0':$label_info['j17'];
		$data['j18'] = empty($label_info['j18'])?'0':$label_info['j18'];
		$data['j19'] = empty($label_info['j19'])?'0':$label_info['j19'];
		$data['j20'] = empty($label_info['j20'])?'0':$label_info['j20'];
		$data['j21'] = empty($label_info['j21'])?'0':$label_info['j21'];
		$data['j22'] = empty($label_info['j22'])?'0':$label_info['j22'];
		$data['j23'] = empty($label_info['j23'])?'0':$label_info['j23'];
		$data['j24'] = empty($label_info['j24'])?'0':$label_info['j24'];
		$data['j25'] = empty($label_info['j25'])?'0':$label_info['j25'];
		$data['j26'] = empty($label_info['j26'])?'0':$label_info['j26'];
		$data['j27'] = empty($label_info['j27'])?'0':$label_info['j27'];
		$data['j28'] = empty($label_info['j28'])?'0':$label_info['j28'];
		$data['j29'] = empty($label_info['j29'])?'0':$label_info['j29'];
		$data['j30'] = empty($label_info['j30'])?'0':$label_info['j30'];
		$data['j31'] = empty($label_info['j31'])?'0':$label_info['j31'];
		$this->display("goods/goods_edit_jichu_shengchan", $data);
	}
	public function goods_edit_jichu_shengchan_detail()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$label_info = $this->role->getlabelByIdyang_shengchan($id);
		if (empty($label_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$data = array();
		$data['id'] = $id;
		$data['y1'] = empty($label_info['y1'])?0:$label_info['y1'];
		$data['y2'] = empty($label_info['y2'])?0:$label_info['y2'];
		$data['y3'] = empty($label_info['y3'])?0:$label_info['y3'];
		$data['y4'] = empty($label_info['y4'])?0:$label_info['y4'];
		$data['y5'] = empty($label_info['y5'])?0:$label_info['y5'];
		$data['y6'] = empty($label_info['y6'])?0:$label_info['y6'];
		$data['y7'] = empty($label_info['y7'])?0:$label_info['y7'];
		$data['y8'] = empty($label_info['y8'])?0:$label_info['y8'];
		$data['y9'] = empty($label_info['y9'])?0:$label_info['y9'];
		$data['y10'] = empty($label_info['y10'])?0:$label_info['y10'];
		$data['y11'] = empty($label_info['y11'])?0:$label_info['y11'];
		$data['y12'] = empty($label_info['y12'])?0:$label_info['y12'];
		$data['y13'] = empty($label_info['y13'])?0:$label_info['y13'];
		$data['y14'] = empty($label_info['y14'])?0:$label_info['y14'];
		$data['y15'] = empty($label_info['y15'])?0:$label_info['y15'];
		$data['y16'] = empty($label_info['y16'])?0:$label_info['y16'];
		$data['y17'] = empty($label_info['y17'])?0:$label_info['y17'];
		$data['y18'] = empty($label_info['y18'])?0:$label_info['y18'];
		$data['y19'] = empty($label_info['y19'])?0:$label_info['y19'];
		$data['y20'] = empty($label_info['y20'])?0:$label_info['y20'];
		$data['y21'] = empty($label_info['y21'])?0:$label_info['y21'];
		$data['y22'] = empty($label_info['y22'])?0:$label_info['y22'];
		$data['y23'] = empty($label_info['y23'])?0:$label_info['y23'];
		$data['y24'] = empty($label_info['y24'])?0:$label_info['y24'];
		$data['y25'] = empty($label_info['y25'])?0:$label_info['y25'];
		$data['y26'] = empty($label_info['y26'])?0:$label_info['y26'];
		$data['y27'] = empty($label_info['y27'])?0:$label_info['y27'];
		$data['y28'] = empty($label_info['y28'])?0:$label_info['y28'];
		$data['y29'] = empty($label_info['y29'])?0:$label_info['y29'];
		$data['y30'] = empty($label_info['y30'])?0:$label_info['y30'];
		$data['y31'] = empty($label_info['y31'])?0:$label_info['y31'];

		$data['j1'] = empty($label_info['j1'])?0:$label_info['j1'];
		$data['j2'] = empty($label_info['j2'])?0:$label_info['j2'];
		$data['j3'] = empty($label_info['j3'])?0:$label_info['j3'];
		$data['j4'] = empty($label_info['j4'])?0:$label_info['j4'];
		$data['j5'] = empty($label_info['j5'])?0:$label_info['j5'];
		$data['j6'] = empty($label_info['j6'])?0:$label_info['j6'];
		$data['j7'] = empty($label_info['j7'])?0:$label_info['j7'];
		$data['j8'] = empty($label_info['j8'])?0:$label_info['j8'];
		$data['j9'] = empty($label_info['j9'])?0:$label_info['j9'];
		$data['j10'] = empty($label_info['j10'])?0:$label_info['j10'];
		$data['j11'] = empty($label_info['j11'])?0:$label_info['j11'];
		$data['j12'] = empty($label_info['j12'])?0:$label_info['j12'];
		$data['j13'] = empty($label_info['j13'])?0:$label_info['j13'];
		$data['j14'] = empty($label_info['j14'])?0:$label_info['j14'];
		$data['j15'] = empty($label_info['j15'])?0:$label_info['j15'];
		$data['j16'] = empty($label_info['j16'])?0:$label_info['j16'];
		$data['j17'] = empty($label_info['j17'])?0:$label_info['j17'];
		$data['j18'] = empty($label_info['j18'])?0:$label_info['j18'];
		$data['j19'] = empty($label_info['j19'])?0:$label_info['j19'];
		$data['j20'] = empty($label_info['j20'])?0:$label_info['j20'];
		$data['j21'] = empty($label_info['j21'])?0:$label_info['j21'];
		$data['j22'] = empty($label_info['j22'])?0:$label_info['j22'];
		$data['j23'] = empty($label_info['j23'])?0:$label_info['j23'];
		$data['j24'] = empty($label_info['j24'])?0:$label_info['j24'];
		$data['j25'] = empty($label_info['j25'])?0:$label_info['j25'];
		$data['j26'] = empty($label_info['j26'])?0:$label_info['j26'];
		$data['j27'] = empty($label_info['j27'])?0:$label_info['j27'];
		$data['j28'] = empty($label_info['j28'])?0:$label_info['j28'];
		$data['j29'] = empty($label_info['j29'])?0:$label_info['j29'];
		$data['j30'] = empty($label_info['j30'])?0:$label_info['j30'];
		$data['j31'] = empty($label_info['j31'])?0:$label_info['j31'];
		$this->display("goods/goods_edit_jichu_shengchan_detail", $data);
	}
	public function goods_save_edit_jichu_shengchan()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$sid = isset($_POST['id']) ? $_POST['id'] : 0;
		$add_time = time();
		$y1 = !empty($_POST["y1"]) ? $_POST["y1"] : '0';
		$y2 = !empty($_POST["y2"]) ? $_POST["y2"] : '0';
		$y3 = !empty($_POST["y3"]) ? $_POST["y3"] : '0';
		$y4 = !empty($_POST["y4"]) ? $_POST["y4"] : '0';
		$y5 = !empty($_POST["y5"]) ? $_POST["y5"] : '0';
		$y6 = !empty($_POST["y6"]) ? $_POST["y6"] : '0';
		$y7 = !empty($_POST["y7"]) ? $_POST["y7"] : '0';
		$y8 = !empty($_POST["y8"]) ? $_POST["y8"] : '0';
		$y9 = !empty($_POST["y9"]) ? $_POST["y9"] : '0';
		$y10 = !empty($_POST["y10"]) ? $_POST["y10"] : '0';
		$y11 = !empty($_POST["y11"]) ? $_POST["y11"] : '0';
		$y12 = !empty($_POST["y12"]) ? $_POST["y12"] : '0';
		$y13 = !empty($_POST["y13"]) ? $_POST["y13"] : '0';
		$y14 = !empty($_POST["y14"]) ? $_POST["y14"] : '0';
		$y15 = !empty($_POST["y15"]) ? $_POST["y15"] : '0';
		$y16 = !empty($_POST["y16"]) ? $_POST["y16"] : '0';
		$y17 = !empty($_POST["y17"]) ? $_POST["y17"] : '0';
		$y18 = !empty($_POST["y18"]) ? $_POST["y18"] : '0';
		$y19 = !empty($_POST["y19"]) ? $_POST["y19"] : '0';
		$y20 = !empty($_POST["y20"]) ? $_POST["y20"] : '0';
		$y21 = !empty($_POST["y21"]) ? $_POST["y21"] : '0';
		$y22 = !empty($_POST["y22"]) ? $_POST["y22"] : '0';
		$y23 = !empty($_POST["y23"]) ? $_POST["y23"] : '0';
		$y24 = !empty($_POST["y24"]) ? $_POST["y24"] : '0';
		$y25 = !empty($_POST["y25"]) ? $_POST["y25"] : '0';
		$y26 = !empty($_POST["y26"]) ? $_POST["y26"] : '0';
		$y27 = !empty($_POST["y27"]) ? $_POST["y27"] : '0';
		$y28 = !empty($_POST["y28"]) ? $_POST["y28"] : '0';
		$y29 = !empty($_POST["y29"]) ? $_POST["y29"] : '0';
		$y30 = !empty($_POST["y30"]) ? $_POST["y30"] : '0';
		$y31 = !empty($_POST["y31"]) ? $_POST["y31"] : '0';

		$j1 = !empty($_POST["j1"]) ? $_POST["j1"] : '0';
		$j2 = !empty($_POST["j2"]) ? $_POST["j2"] : '0';
		$j3 = !empty($_POST["j3"]) ? $_POST["j3"] : '0';
		$j4 = !empty($_POST["j4"]) ? $_POST["j4"] : '0';
		$j5 = !empty($_POST["j5"]) ? $_POST["j5"] : '0';
		$j6 = !empty($_POST["j6"]) ? $_POST["j6"] : '0';
		$j7 = !empty($_POST["j7"]) ? $_POST["j7"] : '0';
		$j8 = !empty($_POST["j8"]) ? $_POST["j8"] : '0';
		$j9 = !empty($_POST["j9"]) ? $_POST["j9"] : '0';
		$j10 = !empty($_POST["j10"]) ? $_POST["j10"] : '0';
		$j11 = !empty($_POST["j11"]) ? $_POST["j11"] : '0';
		$j12 = !empty($_POST["j12"]) ? $_POST["j12"] : '0';
		$j13 = !empty($_POST["j13"]) ? $_POST["j13"] : '0';
		$j14 = !empty($_POST["j14"]) ? $_POST["j14"] : '0';
		$j15 = !empty($_POST["j15"]) ? $_POST["j15"] : '0';
		$j16 = !empty($_POST["j16"]) ? $_POST["j16"] : '0';
		$j17 = !empty($_POST["j17"]) ? $_POST["j17"] : '0';
		$j18 = !empty($_POST["j18"]) ? $_POST["j18"] : '0';
		$j19 = !empty($_POST["j19"]) ? $_POST["j19"] : '0';
		$j20 = !empty($_POST["j20"]) ? $_POST["j20"] : '0';
		$j21 = !empty($_POST["j21"]) ? $_POST["j21"] : '0';
		$j22 = !empty($_POST["j22"]) ? $_POST["j22"] : '0';
		$j23 = !empty($_POST["j23"]) ? $_POST["j23"] : '0';
		$j24 = !empty($_POST["j24"]) ? $_POST["j24"] : '0';
		$j25 = !empty($_POST["j25"]) ? $_POST["j25"] : '0';
		$j26 = !empty($_POST["j26"]) ? $_POST["j26"] : '0';
		$j27 = !empty($_POST["j27"]) ? $_POST["j27"] : '0';
		$j28 = !empty($_POST["j28"]) ? $_POST["j28"] : '0';
		$j29 = !empty($_POST["j29"]) ? $_POST["j29"] : '0';
		$j30 = !empty($_POST["j30"]) ? $_POST["j30"] : '0';
		$j31 = !empty($_POST["j31"]) ? $_POST["j31"] : '0';

		$this->role->goods_edit_jichu_shengchan($sid);
		$this->role->role_saveerp_shengcanjihuadate_insert($sid,$add_time,$y1,$y2,$y3,$y4,$y5,$y6,$y7,$y8,$y9,$y10,$y11,$y12,$y13,$y14,$y15,$y16,$y17,$y18,$y19,$y20,$y21,$y22,$y23,$y24,$y25,$y26,$y27,$y28,$y29,$y30,$y31,$j1,$j2,$j3,$j4,$j5,$j6,$j7,$j8,$j9,$j10,$j11,$j12,$j13,$j14,$j15,$j16,$j17,$j18,$j19,$j20,$j21,$j22,$j23,$j24,$j25,$j26,$j27,$j28,$j29,$j30,$j31);
		echo json_encode(array('success' => true, 'msg' => "操作成功。"));

	}

	public function goodsup()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$btype = isset($_POST['btype']) ? $_POST['btype'] : 1;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}

		$status = 2;
		$state = 5;

		if ($btype==1){
			$this->role->goodsimg_delete_jichu_up($id,$status,$state);
			$this->role->goodsimg_delete_jichu_up1($id,$status,$state);
		}else{
			$this->role->goodsimg_delete_jichu_up2($id,$status,$state);
			$this->role->goodsimg_delete_jichu_up3($id,$status,$state);
		}

		echo json_encode(array('success' => true, 'msg' => "操作成功。"));

	}

	public function shengchan_excel()
	{
		$tidlist = $this->task->gettidlist();
		$data['tidlist'] = $tidlist;
		$this->display("goods/shengchan_excel", $data);
	}
	/**
	 * 原辅料平衡表导出
	 */
	public function goods_csv()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';

		$list = $this->role->getgoodsAllNewid($id);
		$list1 = $this->role->gettidlistguige($id);
		$list2 = $this->role->gettidlistpinming($id);

		$inputFileName = "./static/uploads/yflphb.xls";
		date_default_timezone_set('PRC');
		// 读取excel文件
		try {
			$IOFactory = new IOFactory();
			$inputFileType = $IOFactory->identify($inputFileName);
			$objReader = $IOFactory->createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);

		} catch(\Exception $e) {
			die('加载文件发生错误："'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		//对应的列都附上数据和编号
		$objPHPExcel->getActiveSheet()->setCellValue( 'C13',$list['bianhao']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'G13',$list['kuanhao']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'K13',date('Y-m-d',$list['qianding']));

		$GUIGE_ARR = array();
		$SEHAO_ARR = array();
		$SHUZHI_ARR = array();
		foreach ($list1 as $k=>$v){
			$GUIGE_ARR[] = $v['guige'];
			$SEHAO_ARR[] = $v['sehao'];
			$SHUZHI_ARR[] = $v['shuzhi'];
		}
		$GUIGE_ARR = array_unique($GUIGE_ARR);
		$SEHAO_ARR = array_unique($SEHAO_ARR);
		$arr1 = array();
		$rowold = -1;
		foreach ($SEHAO_ARR as $kk=>$vv){
			$rowold = $rowold + 1;
			$row = $rowold + 3;
			$objPHPExcel->getActiveSheet()->setCellValue( 'M'.$row,$vv);
			foreach ($list1 as $key=>$val){
				if ($vv == $val['sehao']){
					$arr1[$key]['lin'] = $row;
					$arr1[$key]['guigeold'] = $val['guige'];
					$arr1[$key]['shuzihold'] = $val['shuzhi'];
				}
			}
		}
		$zimu = 'N';
		$rowold1 = -1;
		foreach ($GUIGE_ARR as $kkk=>$vvv){
			$rowold1 = $rowold1 + 1;
			if ($rowold1 == 0){
				$objPHPExcel->getActiveSheet()->setCellValue( 'N1',$vvv);
				$zimu = 'N';
			}
			if ($rowold1 == 1){
				$objPHPExcel->getActiveSheet()->setCellValue( 'O1',$vvv);
				$zimu = 'O';
			}
			if ($rowold1 == 2){
				$objPHPExcel->getActiveSheet()->setCellValue( 'P1',$vvv);
				$zimu = 'P';
			}
			if ($rowold1 == 3){
				$objPHPExcel->getActiveSheet()->setCellValue( 'Q1',$vvv);
				$zimu = 'Q';
			}
			if ($rowold1 == 4){
				$objPHPExcel->getActiveSheet()->setCellValue( 'R1',$vvv);
				$zimu = 'R';
			}
			if ($rowold1 == 5){
				$objPHPExcel->getActiveSheet()->setCellValue( 'S1',$vvv);
				$zimu = 'S';
			}
			if ($rowold1 == 6){
				$objPHPExcel->getActiveSheet()->setCellValue( 'T1',$vvv);
				$zimu = 'T';
			}
			if ($rowold1 == 7){
				$objPHPExcel->getActiveSheet()->setCellValue( 'U1',$vvv);
				$zimu = 'U';
			}
			if ($rowold1 == 8){
				$objPHPExcel->getActiveSheet()->setCellValue( 'V1',$vvv);
				$zimu = 'V';
			}
			if ($rowold1 == 9){
				$objPHPExcel->getActiveSheet()->setCellValue( 'W1',$vvv);
				$zimu = 'W';
			}
			foreach ($arr1 as $keyy=>$vall){
				if ($vall['guigeold'] == $vvv){
					$objPHPExcel->getActiveSheet()->setCellValue($zimu.$vall['lin'],$vall['shuzihold']);
				}
			}
		}

		$rownew = 16;
		$rowoldnew1 = -1;
		foreach ($list2 as $kp=>$vp){
			$rowoldnew1 = $rowoldnew1 + 1;
			$row11 = $rownew + $rowoldnew1;
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row11,$vp['pinming']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row11,$vp['pinfan']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row11,$vp['sehao']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row11,$vp['guige']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row11,$vp['danwei']);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row11,$vp['tidanshu']);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$row11,$vp['qingdianshu']);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$row11,$vp['yangzhishi']);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$row11,$vp['shiji']);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$row11,$vp['sunhao']);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$row11,$vp['jianshu']);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$row11,$vp['sunhaoyongliang']);
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$row11,$vp['zhishiyongliang']);
			$objPHPExcel->getActiveSheet()->setCellValue('O'.$row11,$vp['shijiyongliang']);
			$objPHPExcel->getActiveSheet()->setCellValue('Q'.$row11,$vp['shengyu']);
			$objPHPExcel->getActiveSheet()->setCellValue('X'.$row11,$vp['daoliaori']);
		}

		ob_end_clean();//清除缓存区，解决乱码问题
		$fileName = '原辅材料平衡表' . date('Ymd_His');
		// 生成2007excel格式的xlsx文件
		$IOFactory = new IOFactory();
		$PHPWriter = $IOFactory->createWriter($objPHPExcel, 'Excel5');
		header('Content-Type: text/html;charset=utf-8');
		header('Content-Type: xlsx');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
		header('Cache-Control: max-age=0');
		$PHPWriter->save("php://output");
		exit;
	}

	/**
	 * 报价单导出
	 */
	public function goods_csv_baojiadan()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$btype = isset($_GET['btype']) ? $_GET['btype'] : 1;
		if ($btype == 1){
			$fileName = '预算报价单' . date('Ymd_His');
			//预算
			$baojiaxiangmu = $this->role->geterp_baojiaxiangmu($id);
			$baojiadanfeiyong = $this->role->getgoodsByIdxiaojiejei($id);
		}else{
			$fileName = '决算报价单' . date('Ymd_His');
			//决算
			$baojiaxiangmu = $this->role->geterp_baojiaxiangmujue($id);
			$baojiadanfeiyong = $this->role->getgoodsByIdxiaojiejeijue($id);
		}
		$list = $this->role->getgoodsAllNewid($id);
		$set_info1 = $this->set->set_edit_new();
		$huilv = $set_info1['price'];

		$baojiafuzerenone = $this->role->geterp_xiangmukuanhao($id);
		$xid = $baojiafuzerenone['xid'];
		$baojiafuzeren = $this->role->geterp_baojiafuzeren($xid);
		$fuzeren = '';
		if (!empty($baojiafuzeren)){
			foreach ($baojiafuzeren as $k=>$v){
				if ($k<1){
					$fuzeren = $fuzeren.$v['username'];
				}else{
					$fuzeren = $fuzeren."、".$v['username'];
				}
			}
		}
		$inputFileName = "./static/uploads/fzbjd.xls";
		date_default_timezone_set('PRC');
		// 读取excel文件
		try {
			$IOFactory = new IOFactory();
			$inputFileType = $IOFactory->identify($inputFileName);
			$objReader = $IOFactory->createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);

		} catch(\Exception $e) {
			die('加载文件发生错误："'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		//对应的列都附上数据和编号
		$objPHPExcel->getActiveSheet()->setCellValue( 'B3',$baojiadanfeiyong['kehuming']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'F3',$list['kuanhao']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'F2',$fuzeren);
		$objPHPExcel->getActiveSheet()->setCellValue( 'L2',date('Y-m-d',$baojiadanfeiyong['riqi']));
//		$objPHPExcel->getActiveSheet()->setCellValue( 'L3',$baojiadanfeiyong['shengcanshuliang']);
//		$objPHPExcel->getActiveSheet()->setCellValue( 'E17',$baojiadanfeiyong['sunhao']);
//		$objPHPExcel->getActiveSheet()->setCellValue( 'G17',$baojiadanfeiyong['xiaoji']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'A18',$baojiadanfeiyong['name1']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'A19',$baojiadanfeiyong['name2']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'A20',$baojiadanfeiyong['name3']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'A21',$baojiadanfeiyong['name4']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'A22',$baojiadanfeiyong['name5']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'A23',$baojiadanfeiyong['name6']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'A24',$baojiadanfeiyong['name7']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'E18',$baojiadanfeiyong['jiagongfeidanjia']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'G18',$baojiadanfeiyong['jiagongfeiyongliang']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'E19',$baojiadanfeiyong['ercijiagongfeidanjia']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'G19',$baojiadanfeiyong['ercijiagongfeiyongliang']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'E20',$baojiadanfeiyong['jianpinfeidanjia']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'G20',$baojiadanfeiyong['jianpinfeiyongliang']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'E21',$baojiadanfeiyong['tongguanfeidanjia']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'G21',$baojiadanfeiyong['tongguanfeiyongliang']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'E22',$baojiadanfeiyong['mianliaojiancedanjia']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'G22',$baojiadanfeiyong['mianliaojianceyongliang']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'E23',$baojiadanfeiyong['yunfeidanjia']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'G23',$baojiadanfeiyong['yunfeiyongliang']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'E24',$baojiadanfeiyong['qitadanjia']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'G24',$baojiadanfeiyong['qitayongliang']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'I26',$huilv);

		$rownew = 6;
		$rowoldnew1 = -1;
		foreach ($baojiaxiangmu as $kp=>$vp){
			$rowoldnew1 = $rowoldnew1 + 1;
			$row11 = $rownew + $rowoldnew1;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row11,$vp['xiangmu']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row11,$vp['mingcheng']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row11,$vp['guige']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row11,$vp['danwei']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row11,$vp['danjia']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row11,$vp['danwei1']);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row11,$vp['yongliang']);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$row11,$vp['danwei2']);
//			$objPHPExcel->getActiveSheet()->setCellValue('I'.$row11,$vp['jine']);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$row11,$vp['danwei3']);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$row11,$vp['qidingliang']);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$row11,$vp['beizhu']);
		}

		ob_end_clean();//清除缓存区，解决乱码问题

		// 生成2007excel格式的xlsx文件
		$IOFactory = new IOFactory();
		$PHPWriter = $IOFactory->createWriter($objPHPExcel, 'Excel5');
		header('Content-Type: text/html;charset=utf-8');
		header('Content-Type: xlsx');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
		header('Cache-Control: max-age=0');
		$PHPWriter->save("php://output");
		exit;
	}

	/**
	 * 样品制作收发明细导出
	 */
	public function goods_yangpin_csv()
	{
		$zid = isset($_GET['zid']) ? $_GET['zid'] : '';
		$start = isset($_GET['start']) ? $_GET['start'] : '';
		$end = isset($_GET['end']) ? $_GET['end'] : '';
		$kuanhao = isset($_GET['kuanhao']) ? $_GET['kuanhao'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getyangpinlistpage($zid,$start,$end,$kuanhao);
		$page = $allpage > $page ? $page : $allpage;
		$list = $this->role->getyangpinlist($zid,$start,$end,$kuanhao,$page);

		$inputFileName = "./static/uploads/yangpin.xls";
		date_default_timezone_set('PRC');
		// 读取excel文件
		try {
			$IOFactory = new IOFactory();
			$inputFileType = $IOFactory->identify($inputFileName);
			$objReader = $IOFactory->createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);

		} catch(\Exception $e) {
			die('加载文件发生错误："'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		$rownew = 3;
		$rowoldnew1 = -1;
		foreach ($list as $kp=>$vp){
			$rowoldnew1 = $rowoldnew1 + 1;
			$row11 = $rownew + $rowoldnew1;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row11,$kp+1);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row11,$vp['kuhumingcheng']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row11,$vp['dandangzhe']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row11,$vp['kuanhao']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row11,$vp['kuanshi']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row11,$vp['yangpinxingzhi']);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row11,$vp['shuliang']);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$row11,$vp['yangpindanjia']);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$row11,date('Y-m-d',$vp['shoudaoriqi']));
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$row11,date('Y-m-d',$vp['fachuriqi']));
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$row11,$vp['zhizuozhe']);
		}

		ob_end_clean();//清除缓存区，解决乱码问题
		$fileName = '样品制作收发明细' . date('Ymd_His');
		// 生成2007excel格式的xlsx文件
		$IOFactory = new IOFactory();
		$PHPWriter = $IOFactory->createWriter($objPHPExcel, 'Excel5');
		header('Content-Type: text/html;charset=utf-8');
		header('Content-Type: xlsx');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
		header('Cache-Control: max-age=0');
		$PHPWriter->save("php://output");
		exit;
	}

	/**
	 * 预算裁断书导出
	 */
	public function goods_csv_cai()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';

		$list1 = $this->role->gettidlistguige_cai($id);
		$inputFileName = "./static/uploads/cdbgs.xls";
		date_default_timezone_set('PRC');
		// 读取excel文件
		try {
			$IOFactory = new IOFactory();
			$inputFileType = $IOFactory->identify($inputFileName);
			$objReader = $IOFactory->createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		} catch(\Exception $e) {
			die('加载文件发生错误："'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		$GUIGE_ARR = array();
		$SEHAO_ARR = array();
		$SHUZHI_ARR = array();
		$SHUZHIZHI_ARR = array();
		foreach ($list1 as $k=>$v){
			$GUIGE_ARR[] = $v['pinfan'];
			$SEHAO_ARR[] = $v['sehao'];
			$SHUZHI_ARR[] = $v['caiduanshu'];
			$SHUZHIZHI_ARR[] = $v['zhishishu'];
		}
		$GUIGE_ARR = array_unique($GUIGE_ARR);
		$SEHAO_ARR = array_unique($SEHAO_ARR);

		$arr1 = array();
		$rowold = -2;
		foreach ($SEHAO_ARR as $kk=>$vv){
			$rowold = $rowold + 2;
			$row = $rowold + 8;
			$objPHPExcel->getActiveSheet()->setCellValue( 'B'.$row,$vv);
			foreach ($list1 as $key=>$val){
				if ($vv == $val['sehao']){
					$arr1[$key]['lin'] = $row;
					$arr1[$key]['pinfanold'] = $val['pinfan'];
					$arr1[$key]['zhishishuold'] = $val['zhishishu'];
					$arr1[$key]['caiduanshuold'] = $val['caiduanshu'];
				}
			}
		}
		$zimu = 'C';
		$rowold1 = -1;

		foreach ($GUIGE_ARR as $kkk=>$vvv){
			$rowold1 = $rowold1 + 1;
			if ($rowold1 == 0){
				$objPHPExcel->getActiveSheet()->setCellValue( 'C7',$vvv);
				$zimu = 'C';
			}
			if ($rowold1 == 1){
				$objPHPExcel->getActiveSheet()->setCellValue( 'D7',$vvv);
				$zimu = 'D';
			}
			if ($rowold1 == 2){
				$objPHPExcel->getActiveSheet()->setCellValue( 'E7',$vvv);
				$zimu = 'E';
			}
			if ($rowold1 == 3){
				$objPHPExcel->getActiveSheet()->setCellValue( 'F7',$vvv);
				$zimu = 'F';
			}
			if ($rowold1 == 4){
				$objPHPExcel->getActiveSheet()->setCellValue( 'G7',$vvv);
				$zimu = 'G';
			}
			if ($rowold1 == 5){
				$objPHPExcel->getActiveSheet()->setCellValue( 'H7',$vvv);
				$zimu = 'H';
			}
			if ($rowold1 == 6){
				$objPHPExcel->getActiveSheet()->setCellValue( 'I7',$vvv);
				$zimu = 'I';
			}
			if ($rowold1 == 7){
				$objPHPExcel->getActiveSheet()->setCellValue( 'J7',$vvv);
				$zimu = 'J';
			}
			if ($rowold1 == 8){
				$objPHPExcel->getActiveSheet()->setCellValue( 'K7',$vvv);
				$zimu = 'K';
			}
			if ($rowold1 == 9){
				$objPHPExcel->getActiveSheet()->setCellValue( 'L7',$vvv);
				$zimu = 'L';
			}
			foreach ($arr1 as $keyy=>$vall){
				if ($vall['pinfanold'] == $vvv){
					$objPHPExcel->getActiveSheet()->setCellValue($zimu.$vall['lin'],$vall['caiduanshuold']);
					$objPHPExcel->getActiveSheet()->setCellValue($zimu.($vall['lin']+1),$vall['zhishishuold']);
				}
			}
		}

		ob_end_clean();//清除缓存区，解决乱码问题
		$fileName = '裁断报告书' . date('Ymd_His');
		// 生成2007excel格式的xlsx文件
		$IOFactory = new IOFactory();
		$PHPWriter = $IOFactory->createWriter($objPHPExcel, 'Excel5');
		header('Content-Type: text/html;charset=utf-8');
		header('Content-Type: xlsx');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
		header('Cache-Control: max-age=0');
		$PHPWriter->save("php://output");
		exit;
	}

	/**
	 * 决算裁断书导出
	 */
	public function goods_csv_caij()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';

		$list1 = $this->role->gettidlistguige_cai($id);
		$inputFileName = "./static/uploads/cdbgs.xls";
		date_default_timezone_set('PRC');
		// 读取excel文件
		try {
			$IOFactory = new IOFactory();
			$inputFileType = $IOFactory->identify($inputFileName);
			$objReader = $IOFactory->createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		} catch(\Exception $e) {
			die('加载文件发生错误："'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		$GUIGE_ARR = array();
		$SEHAO_ARR = array();
		$SHUZHI_ARR = array();
		$SHUZHIZHI_ARR = array();
		foreach ($list1 as $k=>$v){
			$GUIGE_ARR[] = $v['pinfan'];
			$SEHAO_ARR[] = $v['sehao'];
			$SHUZHI_ARR[] = $v['caiduanshu'];
			$SHUZHIZHI_ARR[] = $v['zhishishu'];
		}
		$GUIGE_ARR = array_unique($GUIGE_ARR);
		$SEHAO_ARR = array_unique($SEHAO_ARR);

		$arr1 = array();
		$rowold = -2;
		foreach ($SEHAO_ARR as $kk=>$vv){
			$rowold = $rowold + 2;
			$row = $rowold + 8;
			$objPHPExcel->getActiveSheet()->setCellValue( 'B'.$row,$vv);
			foreach ($list1 as $key=>$val){
				if ($vv == $val['sehao']){
					$arr1[$key]['lin'] = $row;
					$arr1[$key]['pinfanold'] = $val['pinfan'];
					$arr1[$key]['zhishishuold'] = $val['zhishishu'];
					$arr1[$key]['caiduanshuold'] = $val['caiduanshu'];
				}
			}
		}
		$zimu = 'C';
		$rowold1 = -1;

		foreach ($GUIGE_ARR as $kkk=>$vvv){
			$rowold1 = $rowold1 + 1;
			if ($rowold1 == 0){
				$objPHPExcel->getActiveSheet()->setCellValue( 'C7',$vvv);
				$zimu = 'C';
			}
			if ($rowold1 == 1){
				$objPHPExcel->getActiveSheet()->setCellValue( 'D7',$vvv);
				$zimu = 'D';
			}
			if ($rowold1 == 2){
				$objPHPExcel->getActiveSheet()->setCellValue( 'E7',$vvv);
				$zimu = 'E';
			}
			if ($rowold1 == 3){
				$objPHPExcel->getActiveSheet()->setCellValue( 'F7',$vvv);
				$zimu = 'F';
			}
			if ($rowold1 == 4){
				$objPHPExcel->getActiveSheet()->setCellValue( 'G7',$vvv);
				$zimu = 'G';
			}
			if ($rowold1 == 5){
				$objPHPExcel->getActiveSheet()->setCellValue( 'H7',$vvv);
				$zimu = 'H';
			}
			if ($rowold1 == 6){
				$objPHPExcel->getActiveSheet()->setCellValue( 'I7',$vvv);
				$zimu = 'I';
			}
			if ($rowold1 == 7){
				$objPHPExcel->getActiveSheet()->setCellValue( 'J7',$vvv);
				$zimu = 'J';
			}
			if ($rowold1 == 8){
				$objPHPExcel->getActiveSheet()->setCellValue( 'K7',$vvv);
				$zimu = 'K';
			}
			if ($rowold1 == 9){
				$objPHPExcel->getActiveSheet()->setCellValue( 'L7',$vvv);
				$zimu = 'L';
			}
			foreach ($arr1 as $keyy=>$vall){
				if ($vall['pinfanold'] == $vvv){
					$objPHPExcel->getActiveSheet()->setCellValue($zimu.$vall['lin'],$vall['caiduanshuold']);
					$objPHPExcel->getActiveSheet()->setCellValue($zimu.($vall['lin']+1),$vall['zhishishuold']);
				}
			}
		}

		ob_end_clean();//清除缓存区，解决乱码问题
		$fileName = '决算裁断报告书' . date('Ymd_His');
		// 生成2007excel格式的xlsx文件
		$IOFactory = new IOFactory();
		$PHPWriter = $IOFactory->createWriter($objPHPExcel, 'Excel5');
		header('Content-Type: text/html;charset=utf-8');
		header('Content-Type: xlsx');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
		header('Cache-Control: max-age=0');
		$PHPWriter->save("php://output");
		exit;
	}

	/**
	 * 生产计划表导出 确认
	 */
	public function goods_csv_shengchan_confirm()
	{
		$jihuariqi = isset($_POST['jihuariqi']) ? $_POST['jihuariqi'] : '';
		$list = $this->role->gettidlistguige_shengchanjihua($jihuariqi);
		if (empty($list)) {
			echo json_encode(array('error' => true, 'msg' => "当前月份没有生产计划!"));
		}else{
			echo json_encode(array('success' => true, 'msg' => "当前月份有生产计划!请点击导出按钮!"));
		}
	}

	/**
	 * 生产计划表导出
	 */
	public function goods_csv_shengchan()
	{
		$jihuariqi = isset($_GET['jihuariqi']) ? $_GET['jihuariqi'] : '';
		$list = $this->role->gettidlistguige_shengchanjihua($jihuariqi);
		if (empty($list)) {
			echo json_encode(array('error' => true, 'msg' => "当前月份没有生产计划!"));
			return;
		}

		$inputFileName = "./static/uploads/scydb.xls";
		date_default_timezone_set('PRC');
		// 读取excel文件
		try {
			$IOFactory = new IOFactory();
			$inputFileType = $IOFactory->identify($inputFileName);
			$objReader = $IOFactory->createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);

		} catch(\Exception $e) {
			die('加载文件发生错误："'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		//对应的列都附上数据和编号
		$objPHPExcel->getActiveSheet()->setCellValue( 'A1',$jihuariqi."月 生产预定表");

		$ZU_ARR = array();
		foreach ($list as $k=>$v){
			$ZU_ARR[] = $v['zuname'];
		}
		$ZU_ARR = array_unique($ZU_ARR);
		$row = -1;
		foreach ($ZU_ARR as $kk=>$vv){
			if ($kk<1){
				$row = 3;
				$rownew = -1;
			}elseif ($kk==1){
				$row = 39;
				$rownew = 35;
			}else{
				$row = $row + 40;
				$rownew = $row - 4;
			}
			$objPHPExcel->getActiveSheet()->setCellValue( 'A'.$row,$vv);
			foreach ($list as $key=>$val){
				if ($vv == $val['zuname']){
					$shengchandate = $this->role->getlabelByIdyang_shengchan_date($val['id']);
					$rownew = $rownew + 4;
					$objPHPExcel->getActiveSheet()->setCellValue( 'B'.$rownew,$val['zhipinfanhao']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'C'.$rownew,$val['pinming']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'D'.$rownew,$val['qihuashu']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'E'.$rownew,date('Y-m-d',$val['naqi']));
					$rownewy = $rownew + 1;
					$rownewj = $rownew + 3;
					$objPHPExcel->getActiveSheet()->setCellValue( 'F'.$rownewy,$shengchandate['y1']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'F'.$rownewj,$shengchandate['j1']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'G'.$rownewy,$shengchandate['y2']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'G'.$rownewj,$shengchandate['j2']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'H'.$rownewy,$shengchandate['y3']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'H'.$rownewj,$shengchandate['j3']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'I'.$rownewy,$shengchandate['y4']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'I'.$rownewj,$shengchandate['j4']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'J'.$rownewy,$shengchandate['y5']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'J'.$rownewj,$shengchandate['j5']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'K'.$rownewy,$shengchandate['y6']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'K'.$rownewj,$shengchandate['j6']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'L'.$rownewy,$shengchandate['y7']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'L'.$rownewj,$shengchandate['j7']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'M'.$rownewy,$shengchandate['y8']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'M'.$rownewj,$shengchandate['j8']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'N'.$rownewy,$shengchandate['y9']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'N'.$rownewj,$shengchandate['j9']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'O'.$rownewy,$shengchandate['y10']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'O'.$rownewj,$shengchandate['j10']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'P'.$rownewy,$shengchandate['y11']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'P'.$rownewj,$shengchandate['j11']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'Q'.$rownewy,$shengchandate['y12']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'Q'.$rownewj,$shengchandate['j12']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'R'.$rownewy,$shengchandate['y13']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'R'.$rownewj,$shengchandate['j13']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'S'.$rownewy,$shengchandate['y14']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'S'.$rownewj,$shengchandate['j14']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'T'.$rownewy,$shengchandate['y15']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'T'.$rownewj,$shengchandate['j15']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'U'.$rownewy,$shengchandate['y16']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'U'.$rownewj,$shengchandate['j16']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'V'.$rownewy,$shengchandate['y17']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'V'.$rownewj,$shengchandate['j17']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'W'.$rownewy,$shengchandate['y18']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'W'.$rownewj,$shengchandate['j18']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'X'.$rownewy,$shengchandate['y19']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'X'.$rownewj,$shengchandate['j19']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'Y'.$rownewy,$shengchandate['y20']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'Y'.$rownewj,$shengchandate['j20']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'Z'.$rownewy,$shengchandate['y21']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'Z'.$rownewj,$shengchandate['j21']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'AA'.$rownewy,$shengchandate['y22']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'AA'.$rownewj,$shengchandate['j22']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'AB'.$rownewy,$shengchandate['y23']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'AB'.$rownewj,$shengchandate['j23']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'AC'.$rownewy,$shengchandate['y24']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'AC'.$rownewj,$shengchandate['j24']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'AD'.$rownewy,$shengchandate['y25']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'AD'.$rownewj,$shengchandate['j25']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'AE'.$rownewy,$shengchandate['y26']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'AE'.$rownewj,$shengchandate['j26']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'AF'.$rownewy,$shengchandate['y27']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'AF'.$rownewj,$shengchandate['j27']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'AG'.$rownewy,$shengchandate['y28']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'AG'.$rownewj,$shengchandate['j28']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'AH'.$rownewy,$shengchandate['y29']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'AH'.$rownewj,$shengchandate['j29']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'AI'.$rownewy,$shengchandate['y30']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'AI'.$rownewj,$shengchandate['j30']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'AJ'.$rownewy,$shengchandate['y31']);
					$objPHPExcel->getActiveSheet()->setCellValue( 'AJ'.$rownewj,$shengchandate['j31']);
				}
			}
		}

		ob_end_clean();//清除缓存区，解决乱码问题
		$fileName = '生产计划预定表' . date('Ymd_His');
		// 生成2007excel格式的xlsx文件
		$IOFactory = new IOFactory();
		$PHPWriter = $IOFactory->createWriter($objPHPExcel, 'Excel5');
		header('Content-Type: text/html;charset=utf-8');
		header('Content-Type: xlsx');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
		header('Cache-Control: max-age=0');
		$PHPWriter->save("php://output");
		exit;
	}

	/**
	 * 装箱导出
	 */
	public function goods_csv_caizhuangxiang()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';

		$list1 = $this->role->gettidlistguige_caizhuangxiang($id);
		$list = $this->role->getgoodsAllNewid($id);
		$list2 = $this->role->gettidlistguige_cai($id);
		$inputFileName = "./static/uploads/zxmx.xls";
		date_default_timezone_set('PRC');
		// 读取excel文件
		try {
			$IOFactory = new IOFactory();
			$inputFileType = $IOFactory->identify($inputFileName);
			$objReader = $IOFactory->createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		} catch(\Exception $e) {
			die('加载文件发生错误："'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		$numnew = 0;
		foreach ($list1 as $kkk=>$vvv){
			$numnew = $numnew + 1;
		}

		$objPHPExcel->getActiveSheet()->setCellValue( 'G1',empty($list2[0]['zhuangxiangshuliang'])?0:$list2[0]['zhuangxiangshuliang']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'G2',$numnew);
		$objPHPExcel->getActiveSheet()->setCellValue( 'M1',empty($list2[0]['zhuangxiangshuliang'])?0:$list2[0]['zhuangxiangshuliang']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'M2',$numnew);

		$objPHPExcel->getActiveSheet()->setCellValue( 'C6',$list['kuanhao']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'C3',$list['bianhao']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'G3',date('Y-m-d',$list['qianding']));
		$objPHPExcel->getActiveSheet()->setCellValue( 'M3',date('Y-m-d',$list['addtime']));
		$GUIGE_ARR = array();
		$SEHAO_ARR = array();
		$SHUZHI_ARR = array();
		foreach ($list1 as $k=>$v){
			$GUIGE_ARR[] = $v['pinfan'];
			$SEHAO_ARR[] = $v['sehao'];
			$SHUZHI_ARR[] = $v['caiduanshu'];
			$ID_ARR[] = $v['id'];
		}

		$sumnumber = $list1[0]['shuliang'];
		$arr1 = array();
		$rowold = -1;
		foreach ($SEHAO_ARR as $kk=>$vv){
			$rowold = $rowold + 1;
			$row = $rowold + 6;
//			if ($a != $vv){
//				$a = $vv;
//				$objPHPExcel->getActiveSheet()->setCellValue( 'D'.$row,$vv);
//			}
			$objPHPExcel->getActiveSheet()->setCellValue( 'D'.$row,$vv);
			$arr1[$kk]['lin'] = $row;
			$arr1[$kk]['caiduanshuold'] = $SHUZHI_ARR[$kk];
			$arr1[$kk]['idold'] = $ID_ARR[$kk];
			$arr1[$kk]['pinfanold'] = $GUIGE_ARR[$kk];
		}

//		$ords = array();
//		foreach($arr1 as $v1){
//			$ords[] = $v1['idold'];
//		}
//        array_multisort($arr1, SORT_ASC, $ords);

		$zimu = 'E';
		$rowold1 = -1;
		$GUIGE_ARR = array_unique($GUIGE_ARR);
		$ANEW1 = 0;
		$BNEW1 = 0;
		$Vsum = 0;
		$arrnew = array();
		foreach ($GUIGE_ARR as $kkk=>$vvv){
			$rowold1 = $rowold1 + 1;
			if ($rowold1 == 0){
				$objPHPExcel->getActiveSheet()->setCellValue( 'E5',$vvv);
				$zimu = 'E';
			}
			if ($rowold1 == 1){
				$objPHPExcel->getActiveSheet()->setCellValue( 'F5',$vvv);
				$zimu = 'F';
			}
			if ($rowold1 == 2){
				$objPHPExcel->getActiveSheet()->setCellValue( 'G5',$vvv);
				$zimu = 'G';
			}
			if ($rowold1 == 3){
				$objPHPExcel->getActiveSheet()->setCellValue( 'H5',$vvv);
				$zimu = 'H';
			}
			if ($rowold1 == 4){
				$objPHPExcel->getActiveSheet()->setCellValue( 'I5',$vvv);
				$zimu = 'I';
			}
			if ($rowold1 == 5){
				$objPHPExcel->getActiveSheet()->setCellValue( 'J5',$vvv);
				$zimu = 'J';
			}
			if ($rowold1 == 6){
				$objPHPExcel->getActiveSheet()->setCellValue( 'K5',$vvv);
				$zimu = 'K';
			}
			if ($rowold1 == 7){
				$objPHPExcel->getActiveSheet()->setCellValue( 'L5',$vvv);
				$zimu = 'L';
			}
			if ($rowold1 == 8){
				$objPHPExcel->getActiveSheet()->setCellValue( 'M5',$vvv);
				$zimu = 'M';
			}
			if ($rowold1 == 9){
				$objPHPExcel->getActiveSheet()->setCellValue( 'N5',$vvv);
				$zimu = 'N';
			}
			foreach ($arr1 as $keyy=>$vall){
				if ($vall['pinfanold'] == $vvv){
					if ($vall['caiduanshuold'] == $sumnumber){
						$ANEW1 = $ANEW1 + 1;
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$vall['lin'],$ANEW1);
						$objPHPExcel->getActiveSheet()->setCellValue($zimu.$vall['lin'],$vall['caiduanshuold']);
					}else{
						$arrnew[$keyy]['pinfannew'] = $vvv;
						$arrnew[$keyy]['linnew'] = $vall['lin'];
						$arrnew[$keyy]['caiduanshunew'] = $vall['caiduanshuold'];
					}
				}
			}
		}
		foreach ($GUIGE_ARR as $kkk=>$vvv){
			foreach ($arrnew as $kkyy=>$vvkk){
				if ($vvkk['pinfannew'] == $vvv){
					$Vsum = $Vsum + $vvkk['caiduanshunew'];
					if ($Vsum == $sumnumber){
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$vvkk['linnew'],$BNEW1);
						$BNEW1 = 0;
					}else{
						if (empty($BNEW1)){
							$BNEW1 = $ANEW1 + 1;
							$ANEW1 = $ANEW1 + 1;
						}
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$vvkk['linnew'],$BNEW1);
					}
					$objPHPExcel->getActiveSheet()->setCellValue($zimu.$vvkk['linnew'],$vvkk['caiduanshunew']);
				}
			}
		}

		ob_end_clean();//清除缓存区，解决乱码问题
		$fileName = '装箱明细' . date('Ymd_His');
		// 生成2007excel格式的xlsx文件
		$IOFactory = new IOFactory();
		$PHPWriter = $IOFactory->createWriter($objPHPExcel, 'Excel5');
		header('Content-Type: text/html;charset=utf-8');
		header('Content-Type: xlsx');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
		header('Cache-Control: max-age=0');
		$PHPWriter->save("php://output");
		exit;
	}

	public function goods_add_new_shengchan_excel()
	{
		$tidlist = $this->task->gettidlistjihua();
		$zuname = isset($_GET['zuname']) ? $_GET['zuname'] : '';
		$data['tidlist'] = $tidlist;
		$data['zuname'] = $zuname;
		$this->display("goods/goods_add_new_shengchan_excel", $data);
	}
	public function goods_save_jihua_excel()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$zuname = isset($_POST["zuname"]) ? $_POST["zuname"] : '';
		$jihuariqi = isset($_POST["jihuariqi"]) ? $_POST["jihuariqi"] : '';

		$getjihuariqizuname = $this->role->getjihuariqizuname($zuname,$jihuariqi);
		if (!empty($getjihuariqizuname)){
			foreach ($getjihuariqizuname as $k=>$v){
				$sid = $v['id'];
				$this->role->getjihuariqizunamedelete($sid);
			}
			$this->role->getjihuariqizunamedelete1($zuname,$jihuariqi);
		}
		$excelwendang = isset($_POST["excelwendang"]) ? $_POST["excelwendang"] : '';
		$inputFileName = "./static/uploads/".substr($_POST["excelwendang"], -17);
		date_default_timezone_set('PRC');
		// 读取excel文件
		try {
			$IOFactory = new IOFactory();
			$inputFileType = $IOFactory->identify($inputFileName);
			$objReader = $IOFactory->createReader($inputFileType);
			$objPHPExcelReader = $objReader->load($inputFileName);
		} catch(\Exception $e) {
			die('加载文件发生错误："'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		$reader = $objPHPExcelReader->getWorksheetIterator();
		//循环读取sheet
		foreach($reader as $sheet) {
			//读取表内容
			$content = $sheet->getRowIterator();
			//逐行处理
			$res_arr = array();
			foreach($content as $key => $items) {
				$rows = $items->getRowIndex();              //行
				$columns = $items->getCellIterator();       //列
				$row_arr = array();
				//确定从哪一行开始读取
				if($rows < 2){
					continue;
				}
				//逐列读取
				foreach($columns as $head => $cell) {
					//获取cell中数据
					$data = $cell->getValue();
					$row_arr[] = $data;
				}
				$res_arr[] = $row_arr;
			}
		}
		for ($i=1; $i<=21; $i++)
		{
			$zhipinfanhao = $res_arr[$i][1];
			$pinming = $res_arr[$i][2];
			$qihuashu = $res_arr[$i][3];
			$naqi = $res_arr[$i][4];
			if ($zhipinfanhao == "产值"){
				$htype = 1;
				$chanliangzhi = 0;
				// $chanliangzhi = $res_arr[$i][6]+$res_arr[$i][7]+$res_arr[$i][8]+$res_arr[$i][9]+$res_arr[$i][10]+$res_arr[$i][11]+$res_arr[$i][12]+$res_arr[$i][13]
				// 	+$res_arr[$i][14]+$res_arr[$i][15]+$res_arr[$i][16]+$res_arr[$i][17]+$res_arr[$i][18]+$res_arr[$i][19]
				// 	+$res_arr[$i][20]+$res_arr[$i][21]+$res_arr[$i][22]+$res_arr[$i][23]+$res_arr[$i][24]+$res_arr[$i][25]
				// 	+$res_arr[$i][26]+$res_arr[$i][27]+$res_arr[$i][28]+$res_arr[$i][29]+$res_arr[$i][30]+$res_arr[$i][31]
				// 	+$res_arr[$i][32]+$res_arr[$i][33]+$res_arr[$i][34]+$res_arr[$i][35]+$res_arr[$i][36]+$res_arr[$i][37];

				$heji = 0;
				$zengjian = $chanliangzhi;
			}else{
				if (empty($zhipinfanhao) || empty($pinming) || empty($qihuashu) || empty($naqi)){
					continue;
				}
				$htype = 0;
				$chanliangzhi = 0;
				$heji = $res_arr[$i][5]+$res_arr[$i][6]+$res_arr[$i][7]+$res_arr[$i][8]+$res_arr[$i][9]+$res_arr[$i][10]+$res_arr[$i][11]+$res_arr[$i][12]+$res_arr[$i][13]
					+$res_arr[$i][14]+$res_arr[$i][15]+$res_arr[$i][16]+$res_arr[$i][17]+$res_arr[$i][18]+$res_arr[$i][19]
					+$res_arr[$i][20]+$res_arr[$i][21]+$res_arr[$i][22]+$res_arr[$i][23]+$res_arr[$i][24]+$res_arr[$i][25]
					+$res_arr[$i][26]+$res_arr[$i][27]+$res_arr[$i][28]+$res_arr[$i][29]+$res_arr[$i][30]+$res_arr[$i][31]
					+$res_arr[$i][32]+$res_arr[$i][33]+$res_arr[$i][34]+$res_arr[$i][35]+$res_arr[$i][36];
				$zengjian = $heji - $res_arr[$i][3];
			}

			$shangyue = $res_arr[$i][5];

			$add_time = time();
			$role_info = $this->role->getroleByname1_zhipinfanhao($zhipinfanhao,$zuname,$jihuariqi);
			if (!empty($role_info)) {
				continue;
			}
			$naqi = strtotime($naqi);
			$rid = $this->role->role_save1_jihua($zuname, $zhipinfanhao, $pinming, $qihuashu, $naqi, $jihuariqi, $add_time,$shangyue,$htype,$chanliangzhi,$excelwendang);

			$this->role->role_saveerp_shengcanjihuadate(
				$rid,$add_time,$res_arr[$i][6],$res_arr[$i][7],$res_arr[$i][8],$res_arr[$i][9],$res_arr[$i][10],$res_arr[$i][11]
				,$res_arr[$i][12],$res_arr[$i][13],$res_arr[$i][14],$res_arr[$i][15],$res_arr[$i][16],$res_arr[$i][17]
				,$res_arr[$i][18],$res_arr[$i][19],$res_arr[$i][20],$res_arr[$i][21],$res_arr[$i][22],$res_arr[$i][23]
				,$res_arr[$i][24],$res_arr[$i][25],$res_arr[$i][26],$res_arr[$i][27],$res_arr[$i][28],$res_arr[$i][29]
				,$res_arr[$i][30],$res_arr[$i][31],$res_arr[$i][32],$res_arr[$i][33],$res_arr[$i][34],$res_arr[$i][35]
				,$res_arr[$i][36],$heji,$zengjian,$res_arr[$i][39],$res_arr[$i][40]
			);
		}
		echo json_encode(array('success' => true, 'msg' => "处理完成。"));
	}
	public function goods_list_shengchannew()
	{
		$jihuariqi = isset($_GET['jihuariqi']) ? $_GET['jihuariqi'] : '';
		$zuname = isset($_GET['zuname']) ? $_GET['zuname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPageshengchan($zuname,$jihuariqi);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNewshengchan($page,$zuname,$jihuariqi);
		$data["zuname"] = $zuname;
		$data["jihuariqi"] = $jihuariqi;
		foreach ($list as $k=>$v){
			$time = $v['jihuariqi'];
			$nums = $this->role->getgoodsAllPageshengchannew1($zuname,$time);
			$list[$k]['kuanhaoliang'] = $nums;
			
    		$zunamenew = $v['zuname'];
    		$jihuariqinew = $v['jihuariqi'];
    		$listnew = $this->role->getgoodsAllNewshengchandetails(1,$zunamenew,$jihuariqinew);
    		foreach ($listnew as $kk=>$vv){
    			$sid = $vv['id'];
    			$rowdata = $this->role->geterp_shengcanjihuadate($sid);
    			$listnew[$kk]['y1'] = $rowdata['y1'];
    			$listnew[$kk]['y2'] = $rowdata['y2'];
    			$listnew[$kk]['y3'] = $rowdata['y3'];
    			$listnew[$kk]['y4'] = $rowdata['y4'];
    			$listnew[$kk]['y5'] = $rowdata['y5'];
    			$listnew[$kk]['y6'] = $rowdata['y6'];
    			$listnew[$kk]['y7'] = $rowdata['y7'];
    			$listnew[$kk]['y8'] = $rowdata['y8'];
    			$listnew[$kk]['y9'] = $rowdata['y9'];
    			$listnew[$kk]['y10'] = $rowdata['y10'];
    			$listnew[$kk]['y11'] = $rowdata['y11'];
    			$listnew[$kk]['y12'] = $rowdata['y12'];
    			$listnew[$kk]['y13'] = $rowdata['y13'];
    			$listnew[$kk]['y14'] = $rowdata['y14'];
    			$listnew[$kk]['y15'] = $rowdata['y15'];
    			$listnew[$kk]['y16'] = $rowdata['y16'];
    			$listnew[$kk]['y17'] = $rowdata['y17'];
    			$listnew[$kk]['y18'] = $rowdata['y18'];
    			$listnew[$kk]['y19'] = $rowdata['y19'];
    			$listnew[$kk]['y20'] = $rowdata['y20'];
    			$listnew[$kk]['y21'] = $rowdata['y21'];
    			$listnew[$kk]['y22'] = $rowdata['y22'];
    			$listnew[$kk]['y23'] = $rowdata['y23'];
    			$listnew[$kk]['y24'] = $rowdata['y24'];
    			$listnew[$kk]['y25'] = $rowdata['y25'];
    			$listnew[$kk]['y26'] = $rowdata['y26'];
    			$listnew[$kk]['y27'] = $rowdata['y27'];
    			$listnew[$kk]['y28'] = $rowdata['y28'];
    			$listnew[$kk]['y29'] = $rowdata['y29'];
    			$listnew[$kk]['y30'] = $rowdata['y30'];
    			$listnew[$kk]['y31'] = $rowdata['y31'];
    			$listnew[$kk]['heji'] = $rowdata['heji'];
    			$listnew[$kk]['zengjian'] = $rowdata['zengjian'];
    			$listnew[$kk]['shuoming'] = $rowdata['shuoming'];
    			$listnew[$kk]['danjia'] = $rowdata['danjia'];
    		}
    		$chazhis=0;
	        for ($ii=1;$ii<32;$ii++) {
	             $chazhi=$this->getchanzhi('y'.$ii,$listnew);
            	 $chazhis=$chazhis+$chazhi;
	        }
			$list[$k]['chanliangzhi'] = $chazhis;
		}
		$data["list"] = $list;
		$this->display("goods/goods_list_shengchannew", $data);
	}

	public function goods_add_new_yuanfuliao_excel()
	{
		$kuanhao = isset($_GET['kuanhao']) ? $_GET['kuanhao'] : '';
		$data['kuanhao'] = $kuanhao;
		$this->display("goods/goods_add_new_yuanfuliao_excel", $data);
	}
	public function goods_save_yuanfuliao_excel()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$kuanhao = isset($_POST["kuanhao"]) ? $_POST["kuanhao"] : '';

		$this->role->getjihuariqizunamedelete1guige($kuanhao);
		$this->role->getjihuariqizunamedelete1pinghengbiao($kuanhao);
		
		$excelwendang = isset($_POST["excelwendang"]) ? $_POST["excelwendang"] : '';
		$inputFileName = "./static/uploads/".substr($_POST["excelwendang"], -16);
		date_default_timezone_set('PRC');
		// 读取excel文件
		try {
			$IOFactory = new IOFactory();
			$inputFileType = $IOFactory->identify($inputFileName);
			$objReader = $IOFactory->createReader($inputFileType);
			$objPHPExcelReader = $objReader->load($inputFileName);
		} catch(\Exception $e) {
			die('加载文件发生错误："'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		$reader = $objPHPExcelReader->getWorksheetIterator();

		//循环读取sheet
		foreach($reader as $sheet1) {
			//读取表内容
			$content1 = $sheet1->getRowIterator();
			//逐行处理
			$res_arr1 = array();
			foreach($content1 as $key => $items) {
				$rows1 = $items->getRowIndex();              //行
				$columns1 = $items->getCellIterator();       //列
				$row_arr1 = array();
				//确定从哪一行开始读取
				if($rows1 > 13){
					break;
				}
				//逐列读取
				foreach($columns1 as $head1 => $cell1) {
					//获取cell中数据
					$data1 = $cell1->getValue();
					$row_arr1[] = $data1;
				}
				$res_arr1[] = $row_arr1;
			}
		}
		$arrnew = array();
		for ($i=13; $i<23; $i++){
			$numk = $i - 13;
			if (!empty($res_arr1[2][$i])){
				$arrnew[$numk]['guige'] = $res_arr1[0][$i];
				$arrnew[$numk]['sehao'] = $res_arr1[2][12];
				$arrnew[$numk]['shuzhi'] = $res_arr1[2][$i];
			}
		}

		for ($i=13; $i<23; $i++){
			$numk = $i - 13 + 10;
			if (!empty($res_arr1[3][$i])){
				$arrnew[$numk]['guige'] = $res_arr1[0][$i];
				$arrnew[$numk]['sehao'] = $res_arr1[3][12];
				$arrnew[$numk]['shuzhi'] = $res_arr1[3][$i];
			}
		}

		for ($i=13; $i<23; $i++){
			$numk = $i - 13 + 20;
			if (!empty($res_arr1[4][$i])){
				$arrnew[$numk]['guige'] = $res_arr1[0][$i];
				$arrnew[$numk]['sehao'] = $res_arr1[4][12];
				$arrnew[$numk]['shuzhi'] = $res_arr1[4][$i];
			}
		}

		for ($i=13; $i<23; $i++){
			$numk = $i - 13 + 30;
			if (!empty($res_arr1[5][$i])){
				$arrnew[$numk]['guige'] = $res_arr1[0][$i];
				$arrnew[$numk]['sehao'] = $res_arr1[5][12];
				$arrnew[$numk]['shuzhi'] = $res_arr1[5][$i];
			}
		}

		for ($i=13; $i<23; $i++){
			$numk = $i - 13 + 40;
			if (!empty($res_arr1[6][$i])){
				$arrnew[$numk]['guige'] = $res_arr1[0][$i];
				$arrnew[$numk]['sehao'] = $res_arr1[6][12];
				$arrnew[$numk]['shuzhi'] = $res_arr1[6][$i];
			}
		}

		for ($i=13; $i<23; $i++){
			$numk = $i - 13 + 50;
			if (!empty($res_arr1[7][$i])){
				$arrnew[$numk]['guige'] = $res_arr1[0][$i];
				$arrnew[$numk]['sehao'] = $res_arr1[7][12];
				$arrnew[$numk]['shuzhi'] = $res_arr1[7][$i];
			}
		}

		for ($i=13; $i<23; $i++){
			$numk = $i - 13 + 60;
			if (!empty($res_arr1[8][$i])){
				$arrnew[$numk]['guige'] = $res_arr1[0][$i];
				$arrnew[$numk]['sehao'] = $res_arr1[8][12];
				$arrnew[$numk]['shuzhi'] = $res_arr1[8][$i];
			}
		}

		for ($i=13; $i<23; $i++){
			$numk = $i - 13 + 70;
			if (!empty($res_arr1[9][$i])){
				$arrnew[$numk]['guige'] = $res_arr1[0][$i];
				$arrnew[$numk]['sehao'] = $res_arr1[9][12];
				$arrnew[$numk]['shuzhi'] = $res_arr1[9][$i];
			}
		}

		for ($i=13; $i<23; $i++){
			$numk = $i - 13 + 80;
			if (!empty($res_arr1[10][$i])){
				$arrnew[$numk]['guige'] = $res_arr1[0][$i];
				$arrnew[$numk]['sehao'] = $res_arr1[10][12];
				$arrnew[$numk]['shuzhi'] = $res_arr1[10][$i];
			}
		}

		for ($i=13; $i<23; $i++){
			$numk = $i - 13 + 90;
			if (!empty($res_arr1[11][$i])){
				$arrnew[$numk]['guige'] = $res_arr1[0][$i];
				$arrnew[$numk]['sehao'] = $res_arr1[11][12];
				$arrnew[$numk]['shuzhi'] = $res_arr1[11][$i];
			}
		}

		foreach ($arrnew as $kkk => $vvv) {
			$this->role->role_save12($vvv['guige'], $vvv['sehao'], $vvv['shuzhi'], $kuanhao, time());
		}

		//循环读取sheet
		foreach($reader as $sheet) {
			//读取表内容
			$content = $sheet->getRowIterator();
			//逐行处理
			$res_arr = array();
			foreach($content as $key => $items) {
				$rows = $items->getRowIndex();              //行
				$columns = $items->getCellIterator();       //列
				$row_arr = array();
				//确定从哪一行开始读取
				if($rows < 13){
					continue;
				}
				//逐列读取
				foreach($columns as $head => $cell) {
					//获取cell中数据
					$data = $cell->getValue();
					$row_arr[] = $data;
				}
				$res_arr[] = $row_arr;
			}
		}
		
		for ($i=0; $i<=66; $i++)
		{
			$add_time = time();
			if ($i >= 3){
				if (empty($res_arr[$i][0]) && empty($res_arr[$i][1]) && empty($res_arr[$i][2]) && empty($res_arr[$i][3])){
					continue;
				}
				$hetonghao = $res_arr[0][2];
//				$kuanhao = $res_arr[0][6];
				$riqi = strtotime($res_arr[0][10]);
				$zhishiyongliang = floatval($res_arr[$i][8]) * floatval($res_arr[$i][11]);
				$shijiyongliang = floatval($res_arr[$i][9]) * floatval($res_arr[$i][12]);
				$shengyu = floatval($res_arr[$i][6]) - floatval($zhishiyongliang);
				$this->role->role_saveerp_yuanfuliaopinggheng(
					$res_arr[$i][0],$res_arr[$i][1],$res_arr[$i][2],$res_arr[$i][3],$res_arr[$i][4],$res_arr[$i][5]
					,$res_arr[$i][6],$res_arr[$i][7],$res_arr[$i][8],$res_arr[$i][9],$res_arr[$i][10],$res_arr[$i][11]
					,$res_arr[$i][12],$zhishiyongliang,$shijiyongliang,$shengyu,$res_arr[$i][15],$res_arr[$i][17]
					,$res_arr[$i][18],$hetonghao,$kuanhao,$riqi,$excelwendang,$add_time
				);
			}else{
				$hetonghao = $res_arr[$i][2];
//				$kuanhao = $res_arr[$i][6];
				$riqi = strtotime($res_arr[$i][10]);
				$role_info = $this->role->getroleByname1_zhipinfanhaonew($hetonghao,$kuanhao,$riqi);
				if (!empty($role_info)) {
					continue;
				}
			}
		}
		echo json_encode(array('success' => true, 'msg' => "处理完成。"));
	}
}
