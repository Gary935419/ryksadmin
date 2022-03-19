<?php

/**
 * **********************************************************************
 * サブシステム名  ： TASK
 * 機能名         ：上传
 * 作成者        ： Gary
 * **********************************************************************
 */
class Upload extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['user_name'])) {
			header("Location:" . RUN . '/login/logout');
		}
		header("Content-type:text/html;charset=utf-8");
	}
	function GetRandStr($length){
		$str='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$len=strlen($str)-1;
		$randstr='';
		for($i=0;$i<$length;$i++){
			$num=mt_rand(0,$len);
			$randstr .= $str[$num];
		}
		return $randstr;
	}

	/**
	 * 单图片上传
	 */
	public function pushFIle(){
		$src="";
		$_swap = time();
		$number=$this->GetRandStr(2);
		$_swap = $_swap.$number;
		$fileName = $_swap.".".substr(strrchr($_FILES['file']['name'], '.'), 1);
		move_uploaded_file($_FILES['file']["tmp_name"], "./static/uploads/".$fileName);
		if (file_exists("./static/uploads/".$fileName)) {
			$src="/static/uploads/".$fileName;
		}
		echo json_encode(array('code' => 200,'src' => "https://ryksa.dltqwy.com".$src, 'msg' => "上传成功"));
		return;
	}
	/**
	 * pdf上传
	 */
	public function pushFIlePdf(){
		$src="";
		$_swap = time();
		$number=$this->GetRandStr(2);
		$_swap = $_swap.$number;
		$fileName = $_swap.".".substr(strrchr($_FILES['file']['name'], '.'), 1);
		move_uploaded_file($_FILES['file']["tmp_name"], "./static/uploads/".$fileName);
		if (file_exists("./static/uploads/".$fileName)) {
			$src="/static/uploads/".$fileName;
		}
		echo json_encode(array('code' => 200,'src' => "https://ryksa.dltqwy.com".$src, 'msg' => "上传成功"));
		return;
	}
	/**
	 * 富文本单图片上传
	 */
	public function pushFIletextarea(){
		$src="";
		$_swap = time();
		$fileName = $_swap.".".substr(strrchr($_FILES['file']['name'], '.'), 1);
		move_uploaded_file($_FILES['file']["tmp_name"], "./static/uploads/".$fileName);
		if (file_exists("./static/uploads/".$fileName)) {
			$src="/static/uploads/".$fileName;
		}
		$data = array();
		$data['src'] = "https://ryksa.dltqwy.com".$src;
		echo json_encode(array('code' => 0,'msg' => "上传成功", 'data' => $data));
		return;
	}
	/**
	 * 多图片上传
	 */
	public function pushFIles(){

		$count=sizeof($_FILES['file']['name']);
		$src=array();
		for ($i=0;$i<$count;$i++) {
			$_swap = time()."_".$i;
			$fileName = $_swap.".".substr(strrchr($_FILES['file']['name'][$i], '.'), 1);
			move_uploaded_file($_FILES['file']["tmp_name"][$i], "./static/upload/".$fileName);
			if (file_exists("./static/upload/".$fileName)) {
				$src[]="https://ryksa.dltqwy.com"."/static/upload/".$fileName;
			}
		}
		$data = array();
		$data['src'] = $src;
		echo json_encode(array('code' => 0,'msg' => "上传成功", 'data' => $data));
		return;
	}
	public function upload_img()
	{
		$img = isset($_POST["img"]) ? $_POST["img"] : '';
		$src = $this->base64_image_content($img);
		$data = array();
		$data['src'] = $src;
		echo json_encode(array('code' => 0,'msg' => "上传成功", 'data' => $data));
		return;
	}
	public function base64_image_content($base64_image_content){
		//匹配出图片的格式
		if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
			$type = $result[2];
			$fileName=date('Y-m-d',time());
			$new_file = "./static/uploads/".$fileName;
			if(!file_exists($new_file)){
				//检查是否有该文件夹，如果没有就创建，并给予最高权限
				mkdir($new_file, 0700);
			}
			$picname=mt_rand(0,99).time().".{$type}";
			$new_file = $new_file.$picname;
			if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
				$src = "/static/uploads/".$fileName.$picname;
				return "https://ryksa.dltqwy.com".$src;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}
