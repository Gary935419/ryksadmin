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
        echo json_encode(array('code' => 200,'src' => "http://ryksa.dltqwy.com".$src, 'msg' => "上传成功"));
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
        $data['src'] = "http://www.task.com".$src;
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
                $src[]="http://www.task.com"."/static/upload/".$fileName;
            }
        }
        $data = array();
        $data['src'] = $src;
        echo json_encode(array('code' => 0,'msg' => "上传成功", 'data' => $data));
        return;
    }
}
