<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {
	private $user = "user";
	private $setting = "setting";
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
			$this->template->write_view('left','BACKEND/left', array('active' => 'setting'));
		}
	}
	
	
	public function addContent() {
		$result = $this->model->getContent($this->setting);
		$data = array(
			'result' => $result
		);
		$this->template->write_view('content','BACKEND/setting/edit',$data);
		$this->template->render();
	}
	
	public function saveContent() {
		if($_POST) {
			$data = array(
				'website_title' => $this->input->post('website_title'),
				'language_admin' => 'en', //$this->input->post('language_admin'),
				'language_site' => $this->input->post('language_site'),
				'facebook_id' => $this->input->post('facebook_id'),
				'facebook_secret' => $this->input->post('facebook_secret'),
				'status' => $this->input->post('status')?1:0,
				'verify_user_email' => $this->input->post('verify_user_email')?1:0,
				'owner_company' => $this->input->post('owner_company'),
				'owner_address' => $this->input->post('owner_address'),
				'phone' => $this->input->post('phone'),
				'fax' => $this->input->post('fax'),
				'email' => $this->input->post('email'),
				'yahoo_support' => $this->input->post('yahoo_support'),
				'skype_support' => $this->input->post('skype_support'),
				'address' => $this->input->post('address'),
				'latitude' => $this->input->post('latitude'),
				'longitude' => $this->input->post('longitude'),
				'product_per_page' => $this->input->post('product_per_page'),
				'article_per_page' => $this->input->post('article_per_page'),
				'row_per_page' => $this->input->post('row_per_page'),
				'comment_per_page' => $this->input->post('comment_per_page'),
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'keywords' => $this->input->post('keywords'),
				'google_analytic_id' => $this->input->post('google_analytic_id'),
				'facebook_url' => $this->input->post('facebook_url'),
				'google_plus' => $this->input->post('google_plus'),
				'twitter_plus' => $this->input->post('twitter_plus'),
				'youtube_url' => $this->input->post('youtube_url'),
				'price_plus' => $this->input->post('price_plus'),
				'usd_to_vnd' => $this->input->post('usd_to_vnd'),
			);
			if($_FILES['images']['name'] != '') {
				if($id != '') {
					$img = $this->model->getContent($this->article, array('id' => $id), 'images');
					if(!empty($img) && !empty($img->images))
						@unlink(BASEFOLDER.'media/'.$img->images);
				}
				$file = $_FILES['images'];
				$ext = explode('.',$file['name']);
				$ext = end($ext);
				$chk_type = array("image/gif","image/jpeg","image/png","image/bmp");
				if(in_array($file['type'],$chk_type,true)) {
					$ext = '.'.$ext;
					$name = str_replace($ext,"",$file['name']);
					$name = SEO($name).'-'.rand(0,999);
					if(move_uploaded_file($file['tmp_name'],BASEFOLDER.'media/'.$name.$ext)){
						$data['images'] = $name.$ext;
					}
				}
			}
			if($this->model->saveContent($this->setting, $data)){
				$this->session->set_flashdata('success', 1);
				header('location:'.PATH_URL.'acp/setting');
			}
		}
	}
	
	public function deleteImageContent() {
		if(!empty($_POST)) {
			$id = $this->input->post('id');
			$img = $this->model->getContent($this->setting, array('id' => $id));
			if(!empty($img->images))
				@unlink(BASEFOLDER.'media/'.$img->images);
			$this->db->where('id',$id);
			if($this->db->update($this->setting, array('images' => "")))
				echo "<img src='".PATH_URL."media/no_images.gif'>";
			exit();
		}
	}
}
