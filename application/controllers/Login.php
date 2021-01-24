<?php

/**
 * **********************************************************************
 * サブシステム名  ： TASK
 * 機能名         ：登录
 * 作成者        ： Gary
 * **********************************************************************
 */
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Users_model", 'user');
        header("Content-type:text/html;charset=utf-8");
    }
    /**
     * 登录页面
     */
    public function index()
    {
        $this->load->view('login');
    }
    /**
     * 登录验证
     */
    public function login()
    {
        $name = $_POST['username'];
        $pwd = $_POST['password'];

        $rest = $this->user->isPass($name, $pwd);
        if (!empty($rest)) {
            if ($rest['user_state'] == 2) {
                header("Location: " . RUN . '/login?err=2');
            } else {
                $_SESSION['user_name'] = $rest['username'];
				$_SESSION['rid'] = $rest['rid'];
                header("Location: " . RUN . '/admin');
            }
        } else {
            header("Location: " . RUN . '/login?err=1');
        }
    }
    /**
     * 退出登录
     */
    public function logout()
    {
        unset($_SESSION['user_name']);
		unset($_SESSION['rid']);
        header("Location: " . RUN . '/login');  // 跳转登录页
    }
}
