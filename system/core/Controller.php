<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {
    protected $membertoken;
    protected $memberinfo;
    protected $memberid;
    protected $appid = 'wxa3011b96e56a8e18';
    protected $secret = 'f0e43e8b6221198b5e16c42add2c282e';
    //商户支付密钥
    protected $pay_KEY = 'FSKEPj7eHARPgmdAL5T8KtBPofhLq6JY';
    //应用ID
    protected $pay_appid="wxa6f4b6f8bf75d380";
    //商户号
    protected $pay_mch_id="1563304301";
    //设备号
    protected $pay_device_info = "WEB";
	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}
    public function display($view,$data=array()){
        $data['user_name'] = $_SESSION['user_name'];
        $this->load->view($view,$data);
    }

    /**
     * 设置返回参数为json
     * $param $errcode 返回标志
     *  200:操作成功  201:操作失败
     * $param $errmsg 错误信息
     * $param $data 信息对象
     */
    public function back_json($errcode = 200, $errmsg ='',$data = array()){
        $result = array();
        $result['errcode'] = $errcode;
        $result['errmsg'] = $errmsg;
        $result['data'] = (object)$data;
//        header('Content-Type:text/html; charset=json');
        header('Content-Type:application/json; charset=utf-8');
        exit(json_encode($result));
    }
    /**
     * 返回页面分页
     */
    public function getpage($page,$allpage,$iswh=array()){
        if($allpage==1) {
            return "";
        }
        $wh="?";
        foreach ($iswh as $key => $value) {
            if($key!="page") {
                $wh.=$key."=".$value."&";
            }
        }
        $number='';
        if($allpage<6) {
            for ($i=1; $i <$allpage+1 ; $i++) {
                if($i==$page) {
                    $number.='<span class="current">'.$i.'</span>';
                } else {
                    $number.='<a class="num" href="'.$wh.'page='.$i.'">'.$i.'</a>';
                }
            }
        } else {
            if($page<4) {
                for ($i=1; $i <6 ; $i++) {
                    if($i==$page) {
                        $number.='<span class="current">'.$i.'</span>';
                    } else {
                        $number.='<a class="num" href="'.$wh.'page='.$i.'">'.$i.'</a>';
                    }
                }
            } else if($page>$allpage-3) {
                for ($i=$allpage-4; $i <$allpage+1 ; $i++) {
                    if($i==$page) {
                        $number.='<span class="current">'.$i.'</span>';
                    } else {
                        $number.='<a class="num" href="'.$wh.'page='.$i.'">'.$i.'</a>';
                    }
                }
            } else {
                for ($i=$page-2; $i <$page+3 ; $i++) {
                    if($i==$page) {
                        $number.='<span class="current">'.$i.'</span>';
                    } else {
                        $number.='<a class="num" href="'.$wh.'page='.$i.'">'.$i.'</a>';
                    }
                }
            }
        }
        $html='<div>
					    <a class="prev" href="'.$wh.'page='.($page>1?$page-1:1).'">上一页</a>
					    '.$number.'
					    <a class="next" href="'.$wh.'page='.($allpage>$page?$page+1:$allpage).'">下一页</a>
				</div>';
        return $html;
    }
}
