<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['user_name'])) {
			header("Location:" . RUN . '/login/logout');
		}
		$this->load->model('Users_model', 'users');
		$this->load->model('Order_model', 'order');
		header("Content-type:text/html;charset=utf-8");
	}
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
		$data["ordercount1"] = $this->order->getOrder1Count();
		$data["ordercount2"] = $this->order->getOrder2Count();
		$data["ordercount3"] = $this->order->getOrder3Count();
		$data["ordercount4"] = $this->order->getOrder4Count();
		$data["ordercount5"] = $this->order->getOrder5Count();
		$data["ordercount6"] = $this->order->getOrder6Count();
        $this->load->view('welcome_message',$data);
    }
}
