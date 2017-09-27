<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Intro extends CI_Controller {
	private $user = "user";
	private $contact = "contact";
	private $setting = "setting";
	private $faqs = "faqs";
	private $ourtour = "ourtour";
	private $article = "article";
	private $category = "category";
	public function __construct(){
		parent::__construct();
		$this->load->model('home_model','model');
		$this->load->library('session');
		$this->load->library('pagination');
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
			$this->template->write_view('left','BACKEND/left');
		} else {
			$this->template->set_template("home");
            if($this->uri->segment(1) == 'en') {
                $this->session->set_userdata('home_lang','_en');
                $this->lang->load('en',"english");
            } else {
                $this->session->set_userdata('home_lang','');
                $this->lang->load("vi","vietnam");
            }
            $home_lang = $this->session->userdata('home_lang');
			$banner_header = $this->model->getContent($this->category, array('links' => 'header','type' => 'page', 'parent_id' => 0),"id");
			$header = array(
				'menu' => $this->model->getListContent($this->category, array('status' => 1, 'type' => 'page', 'parent_id' => 0), 'order_by asc', null, null, "id, links$home_lang as links"),
				'setting' => $this->model->getContent($this->setting, null, "phone, email, fax, owner_company, address, latitude, longitude"),
                'home_lang' => $home_lang,
                'banner_header' => $this->model->getListContent($this->article, array('status' => 1, 'category_id' => $banner_header->id), 'order_by asc', null, null, "name$home_lang as name, content$home_lang as content")
			);
			$this->template->write_view('header','FRONTEND/header',$header);
			$banner_footer = $this->model->getContent($this->category, array('links' => 'footer','type' => 'page', 'parent_id' => 0),"id");
			$footer = array(
				'block_footer' => $this->model->getListContent($this->article, array('status' => 1, 'category_id' => $banner_footer->id), 'order_by asc', null, null, "name$home_lang as name, content$home_lang as content")
			);
			$this->template->write_view('footer','FRONTEND/footer',$footer);
		}
	}

	public function index() {
        $home_lang = $this->session->userdata('home_lang');
		$intro = $this->model->getContent($this->category, array('links' => 'about-us','type' => 'page', 'parent_id' => 0),"id");
		$data = array(
			'result' => $this->model->getListContent($this->article, array('category_id' => $intro->id, 'status' => 1,'type' => 'banner'), 'order_by asc', null, null, "name$home_lang as name, images,content$home_lang as content"),
			'banner_intro' => $this->model->getListContent($this->category, array('category_id' => $intro->id, 'status' => 1,'parent_id' => 0, 'type' => 'banner'), 'order_by asc', null, null, "name$home_lang as name, images,id"),
			'doctor' => $this->model->getListContent($this->article, array('type' => 'doctor', 'status' => 1), 'order_by asc, id asc', null, null, "name$home_lang as name, shortcontent$home_lang as shortcontent, content$home_lang as content, images")
		);
        $this->template->write('title','About Us');
        $this->template->write('description','About Us');
        $this->template->write('keywords','About Us');
		$this->template->write_view('content','FRONTEND/intro/content',$data);
		$this->template->render();
	}
}
