<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_Model extends CI_Model
{
	public function getListContent($table, $where = null, $order_by = null, $limit = null, $page = null, $select = null) {
		if($select <> null)
			$this->db->select($select);
		if($where <> null)
			$this->db->where($where);
		if($order_by <> null)
			$this->db->order_by($order_by);
		if($limit <> null)
			$this->db->limit($limit, $page);
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			foreach($query->result() as $row)
				$result[] = $row;
			if(!empty($result))
				return $result;
			else
				return false;
		}
	}
	public function getContent($table, $where = null, $select = null) {
		if($select <> null)
			$this->db->select($select);
		if($where <> null)
			$this->db->where($where);
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			foreach($query->result() as $row)
				$result = $row;
			if(!empty($result))
				return $result;
			else
				return false;
		}
	}
	public function saveContent($table) {
		$id = $this->input->post('id');
		$data = array(
			'website_title' => $this->input->post('website_title'),
			'language_admin' => $this->input->post('language_admin'),
			'language_site' => $this->input->post('language_site'),
			'facebook_id' => $this->input->post('facebook_id'),
			'facebook_secret' => $this->input->post('facebook_secret'),
			'status' => $this->input->post('status')?1:0,
			'verify_user_email' => $this->input->post('verify_user_email')?1:0,
			'owner_company' => $this->input->post('owner_company'),
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
		);
		$images = "logo";
		if(empty($id)) {
			if($_FILES['images']['name'] != '')
			{
				$ext = '.'.end(explode('.',$_FILES['images']['name']));
				$type = explode("/",$_FILES['images']['type']);
				if($type[0] != 'image') {
					$this->session->set_flashdata('error_img', 1);
					header('location:'.$_SERVER['HTTP_REFERER']);
					exit;
				}
				if(move_uploaded_file($_FILES['images']['tmp_name'],BASEFOLDER.'img_data/'.$images.$ext)) {
					$data['images'] = $images.$ext;
				}
			}
			if($this->db->insert($table,$data)){
				$this->session->set_userdata('lange',$this->input->post('language_admin'));
				return true;
			}
		} else {
			$img = $this->getContent($table,array('id' => $id));
      if($_FILES['images']['name'] != '')
      {
        $ext = '.'.end(explode('.',$_FILES['images']['name']));
				$type = explode("/",$_FILES['images']['type']);
				if($type[0] != 'image') {
					$this->session->set_flashdata('error_img', 1);
					header('location:'.$_SERVER['HTTP_REFERER']);
					exit;
				}
        if($img->images != null)
					unlink(BASEFOLDER.'img_data/'.$img->images);
				if(move_uploaded_file($_FILES['images']['tmp_name'],BASEFOLDER.'img_data/'.$images.$ext)) {
					$data['images'] = $images.$ext;
				}

            }
			$this->db->where('id',$id);
			if($this->db->update($table, $data)){
				$this->session->set_userdata('lange',$this->input->post('language_admin'));
				return true;
			}
		}
	}
}
