<?php

/**
 * **********************************************************************
 * サブシステム名  ： TASK
 * 機能名         ：系统设置
 * 作成者        ： Gary
 * **********************************************************************
 */
class Set extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        $this->load->model('Set_model', 'set');
        header("Content-type:text/html;charset=utf-8");
    }
    /**
     * 设置修改页
     */
    public function set_edit()
    {
        $set_info1 = $this->set->getsetById1(1);
		$set_info2 = $this->set->getsetById1(2);
		$set_info3 = $this->set->getsetById1(3);
		$set_info4 = $this->set->getsetById1(4);

        $data['price1'] = $set_info1['price1'];
		$data['price2'] = $set_info1['price2'];
		$data['price3'] = $set_info1['price6'];
		$data['content1'] = $set_info1['content1'];

		$data['price4'] = $set_info2['price1'];
		$data['price5'] = $set_info2['price2'];
		$data['price6'] = $set_info2['price3'];
		$data['price7'] = $set_info2['price4'];
		$data['price8'] = $set_info2['price5'];
		$data['price9'] = $set_info2['price6'];

		$data['price10'] = $set_info3['price1'];
		$data['price11'] = $set_info3['price6'];
		$data['price12'] = $set_info3['price2'];

		$data['price13'] = $set_info4['price11'];
		$data['price14'] = $set_info4['price9'];
		$data['price15'] = $set_info4['price10'];
		$data['price16'] = $set_info4['price8'];
		$data['price17'] = $set_info4['km1'];
		$data['price18'] = $set_info4['kg1'];
		$data['price19'] = $set_info4['km2'];
        $this->display("set/set_edit", $data);
    }
    /**
     * 设置修改提交
     */
    public function set_save_edit()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
        $price1 = isset($_POST["price1"]) ? $_POST["price1"] : '';
		$price2 = isset($_POST["price2"]) ? $_POST["price2"] : '';
		$price3 = isset($_POST["price3"]) ? $_POST["price3"] : '';

		$price4 = isset($_POST["price4"]) ? $_POST["price4"] : '';
		$price5 = isset($_POST["price5"]) ? $_POST["price5"] : '';
		$price6 = isset($_POST["price6"]) ? $_POST["price6"] : '';
		$price7 = isset($_POST["price7"]) ? $_POST["price7"] : '';
		$price8 = isset($_POST["price8"]) ? $_POST["price8"] : '';
		$price9 = isset($_POST["price9"]) ? $_POST["price9"] : '';

		$price10 = isset($_POST["price10"]) ? $_POST["price10"] : '';
		$price11 = isset($_POST["price11"]) ? $_POST["price11"] : '';
		$price12 = isset($_POST["price12"]) ? $_POST["price12"] : '';

		$price13 = isset($_POST["price13"]) ? $_POST["price13"] : '';
		$price14 = isset($_POST["price14"]) ? $_POST["price14"] : '';
		$price15 = isset($_POST["price15"]) ? $_POST["price15"] : '';
		$price16 = isset($_POST["price16"]) ? $_POST["price16"] : '';
		$price17 = isset($_POST["price17"]) ? $_POST["price17"] : '';
		$price18 = isset($_POST["price18"]) ? $_POST["price18"] : '';
		$price19 = isset($_POST["price19"]) ? $_POST["price19"] : '';
        $this->set->set_save_edit($price1,$price2,$price3);
		$this->set->set_save_edit1($price4,$price5,$price6,$price7,$price8,$price9);
		$this->set->set_save_edit2($price10,$price11,$price12);
		$this->set->set_save_edit3($price13,$price14,$price15,$price16,$price17,$price18,$price19);
		$content1 = isset($_POST["content1"]) ? $_POST["content1"] : '';
		$this->set->set_save_edit4($content1);
		echo json_encode(array('success' => true, 'msg' => "操作成功。"));
		return;
    }
	/**
	 * 设置修改页
	 */
	public function set_edit_new()
	{
		$set_info1 = $this->set->set_edit_new();

		$data['price'] = $set_info1['price'];
		$data['days'] = $set_info1['days'];

		$this->display("set/set_edit_new", $data);
	}
	/**
	 * 设置修改提交
	 */
	public function set_save_edit_new()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$price = isset($_POST["price"]) ? $_POST["price"] : '';
		$days = isset($_POST["days"]) ? $_POST["days"] : '';

		$this->set->set_save_edit_new($price,$days);

		echo json_encode(array('success' => true, 'msg' => "操作成功。"));
		return;
	}
    /**
     * 广告列表页
     */
    public function advertisement_list()
    {

        $aname = isset($_GET['aname']) ? $_GET['aname'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allpage = $this->set->getadvertisementAllPage($aname);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->set->getadvertisementAllNew($page, $aname);
        $data["list"] = $list;
        $data["aname"] = $aname;
        $this->display("set/advertisement_list", $data);
    }
    /**
     * 广告添加页
     */
    public function advertisement_add()
    {
        $this->display("set/advertisement_add");
    }
    /**
     * 广告添加提交
     */
    public function advertisement_save()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
            return;
        }

        $aname = isset($_POST["aname"]) ? $_POST["aname"] : '';
        $aimg = isset($_POST["aimg"]) ? $_POST["aimg"] : '';
        $add_time = time();

        $advertisement_info = $this->set->getadvertisementByname($aname);
        if (!empty($advertisement_info)) {
            echo json_encode(array('error' => true, 'msg' => "该广告名称已经存在。"));
            return;
        }
        $result = $this->set->advertisement_save($aname, $aimg, $add_time);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }
    /**
     * 广告删除
     */
    public function advertisement_delete()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        if ($this->set->advertisement_delete($id)) {
            echo json_encode(array('success' => true, 'msg' => "删除成功"));
            return;
        } else {
            echo json_encode(array('success' => false, 'msg' => "删除失败"));
            return;
        }
    }
    /**
     * 广告修改页
     */
    public function advertisement_edit()
    {
        $aid = isset($_GET['aid']) ? $_GET['aid'] : 0;
        $advertisement_info = $this->set->getadvertisementById($aid);
        if (empty($advertisement_info)) {
            echo json_encode(array('error' => true, 'msg' => "数据错误"));
            return;
        }
        $data = array();
        $data['aname'] = $advertisement_info['aname'];
        $data['aimg'] = $advertisement_info['aimg'];
        $data['aid'] = $aid;
        $this->display("set/advertisement_edit", $data);
    }
    /**
     * 广告修改提交
     */
    public function advertisement_save_edit()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
        $aname = isset($_POST["aname"]) ? $_POST["aname"] : '';
        $aimg = isset($_POST["aimg"]) ? $_POST["aimg"] : '';
        $aid = isset($_POST["aid"]) ? $_POST["aid"] : '';
        $advertisement_info = $this->set->getadvertisementById2($aname, $aid);
        if (!empty($advertisement_info)){
            echo json_encode(array('error' => false, 'msg' => "该类型名称已经存在"));
            return;
        }

        $result = $this->set->advertisement_save_edit($aid,$aname,$aimg);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }
}
