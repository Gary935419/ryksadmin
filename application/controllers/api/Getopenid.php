<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * **********************************************************************
 * サブシステム名  ： TASK
 * 機能名         ：openid
 * 作成者        ： Gary
 * **********************************************************************
 */
class Getopenid extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // 加载数据库类
        $this->load->model('Member_model', 'member');
    }
    /**
     * 获取openid
     */
    public function index(){
        //验证loginCode是否传递
        if (!isset($_POST['loginCode']) || empty($_POST['loginCode'])) {
            $this->back_json(201, '未传递loginCode');
        }
        $loginCode = $_POST['loginCode'];
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=' . $this->appid . '&secret=' . $this->secret . '&grant_type=authorization_code&js_code=' . $loginCode;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //禁止调用时就输出获取到的数据
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $result = curl_exec($ch);
        curl_close($ch);
        $this->back_json(L('SUCCESS_CODE'), '', json_decode($result, true));
    }

    /**
     * 清除数据
     */
    public function deleteall(){
        $this->member->deleteall();
        $this->back_json(200, '清除完毕', array());
    }
}
