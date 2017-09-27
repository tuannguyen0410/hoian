<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
	private $user = "user";
	private $category = 'category';
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
			$left = array(
				'active' => 'menu'
			);
			$this->template->write_view('left','BACKEND/left', $left);
		}
	}

	public function admincp() {
		$data = array(
			'result' => $this->model->getListContent($this->category,array('type' => 'menu'), 'order_by asc', null, null, "name, name_en, id, category_id, parent_id, order_by, status")
		);
		$this->template->write_view('content','BACKEND/menu/content', $data);
		$this->template->render();
	}

	public function addContent() {
		$id = $this->uri->segment(4);
		if($id == null)
			$result = null;
		else
			$result = $this->model->getContent($this->category, array('id' => $id));
		$data = array(
			'result' => $result,
			'category' => $this->model->getListContent($this->category, array('parent_id' => 0, 'type' => 'menu','status' => 1), "order_by asc", null,null, "name, id"),
			'page' => $this->model->getListContent($this->category, array('parent_id' => 0, 'type' => 'page','status' => 1), "order_by asc", null,null, "name, id")
		);
		$this->template->write_view('content','BACKEND/menu/edit',$data);
		$this->template->render();
	}

	public function saveContent() {
		if(!empty($_POST)) {
			$id = $this->input->post('id');
			$category = $this->input->post('category');
			if(!empty($category)){
				$category_id = implode(',',$category);
			}else{
				$category_id= 0;
			}
			$parent_id = $this->input->post('parent_id');
			if($parent_id = ''){
				$parent_id = 0;
			}
			$data = array(
				'name' => trim(addslashes($this->input->post('txtName'))),
				'order_by' => $this->input->post('order_by'),
				'parent_id' => $parent_id,
				'category_id' => $category_id,
				'type' => "menu",
				'status' => $this->input->post('status')?1:0,
				'links' => $this->input->post('links'),
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'keywords' => $this->input->post('keywords'),
				'name_en' => trim(addslashes($this->input->post('txtName_en'))),
				'links_en' => trim('en/'.$this->input->post('links_en')),
			);
			if($this->model->saveContent($this->category,$data)){
                if($id == '')
                    $id = $this->db->insert_id();
				$this->session->set_flashdata('success', 1);
				header('location:'.PATH_URL.'acp/menu/edit/'.$id);
			}
		}
	}
	public function delete() {
		if(isset($_POST['orderButton'])) {
			$this->session->set_flashdata('success', 1);
			header('location:'.PATH_URL.'acp/menu');
			exit();
		}
		if(isset($_POST['hideButton'])) {
			$id = $this->input->post('id');
			for($i = 0; $i < count($id); $i++){
				if(!empty($id[$i])) {
					$result = $this->model->getContent($this->category, array('id' => $id[$i]),"status");
					if($result->status == 1) {
						$this->db->where('id',$id[$i]);
						$this->db->update($this->category, array('status' => 0));
					}
				}
			}
			$this->session->set_flashdata('success', 1);
			header('location:'.PATH_URL.'acp/menu');
			exit();
		}
		if(isset($_POST['delButton'])) {
			$id = $this->input->post('id');
			for($i = 0; $i < count($id); $i++)
				$this->model->delListCategory($this->category, array('id' => $id[$i]));
		} else {
			$id = $this->uri->segment(4);
			$this->model->delListCategory($this->category, array('id' => $id));
		}
		$this->session->set_flashdata('success', 1);
		header('location:'.PATH_URL.'acp/menu');
	}

	public function searchContent() {
		if($_POST){
			$keywords = $this->input->post('keywords');
			$result = $this->model->search($this->category,$keywords);
			$data = array(
				'result' => $result
			);
			$this->template->write_view('content','BACKEND/menu/content', $data);
			$this->template->render();
		}
	}

	public function deleteImageContent() {
		if(!empty($_POST)) {
			$id = $this->input->post('id');
			$img = $this->model->getContent($this->category, array('id' => $id));
			if(!empty($img->images))
				@unlink(BASEFOLDER.'img_data/'.$img->images);
			$this->db->where('id',$id);
			if($this->db->update($this->category, array('images' => "")))
				echo "<img src='".PATH_URL."img_data/no_images.gif'>";
			exit();
		}
	}

	public function checkLinks()
    {
		$links = $this->input->post('links');
		$id = $this->input->post('id');
        $result = $this->model->getContent($this->category, array('links' => $links, 'id <> ' => $id));

        if(empty($result)) {
			$link = $links;
		} else {
			$link = $this->db->get($this->category)->num_rows().'-'.$this->input->post('links');
		}
		if($id == '') {
			$order_by = (int) $this->db->get_where($this->category,array('type' => 'menu'))->num_rows() + 1;
		} else {
			$order_by = $this->model->getContent($this->category, array('id' => $id))->order_by;
		}
		$result_array = array(
			'links' => $link,
			'order_by' => $order_by
		);
		echo json_encode($result_array);
    }

	public function updateStatus() {
		if($_POST) {
			$id = $this->input->post('id');
			$type = $this->input->post('type');
			$result = $this->model->getContent($this->category, array('id' => $id));
			if($result->$type == 1)
				$data[$type] = 0;
			else
				$data[$type] = 1;

			$this->db->where('id', $id);
			if($this->db->update($this->category, $data))
				echo 1;
			else
				echo 0;
		}
	}

	public function changeOrderBy()
	{
		$id = $this->input->post('id');
		$order_by = $this->input->post('order_by');
		$result = $this->model->getContent($this->category, array('id' => $id));
		$data = array('order_by' => $order_by);
		$this->db->where('id', $id);
		if($this->db->update($this->category, $data))
			echo $order_by;
		else echo 0;
	}
}
