<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faqs extends CI_Controller {
	private $user = "user";
	private $category = "category";
	private $faqs = "faqs";
	public function __construct(){
		parent::__construct();
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
			$this->template->write_view('left','BACKEND/left', array('active' => 'faqs'));
		}
	}

	public function admincp() {
		$data = array(
			'result' => $this->model->getListContent($this->faqs,array('type' => 'faqs'), 'order_by asc', null, null)
		);
		$this->template->write_view('content','BACKEND/faqs/content', $data);
		$this->template->render();
	}

	public function addContent() {
		$id = $this->uri->segment(4);
		if($id == null) {
			$result = null;
		} else {
			$result = $this->model->getContent($this->faqs, array('id' => $id));
		}
		$data = array(
			'result' => $result
		);
		$this->template->write_view('content','BACKEND/faqs/edit',$data);
		$this->template->render();
	}

	public function saveContent() {
		if(!empty($_POST)) {
            $id = $this->input->post('id');
			if($this->input->post('order_by') != '')
				$order_by = $this->input->post('order_by');
			else
				$order_by = 0;
			$data = array(
				'name' => trim(addslashes($this->input->post('txtName'))),
				'order_by' => $order_by,
				'type' => 'faqs',
				'homepage' => $this->input->post('home')?1:0,
				'status' => $this->input->post('status')?1:0,
				'content' => addslashes($this->input->post('content')),
				'name_en' => trim(addslashes($this->input->post('txtName_en'))),
				'content_en' => addslashes($this->input->post('content_en'))
			);
			if($this->model->saveContent($this->faqs, $data)){
                if($id == '')
                    $id = $this->db->insert_id();
				$this->session->set_flashdata('success', 1);
				header('location:'.PATH_URL.'acp/faqs/edit/'.$id);
			}
		}
	}
	public function delete() {
		if(isset($_POST['orderButton'])) {
			$this->session->set_flashdata('success', 1);
			header('location:'.PATH_URL.'acp/faqs');
			exit();
		}
		if(isset($_POST['hideButton'])) {
			$id = $this->input->post('id');
			for($i = 0; $i < count($id); $i++){
				if(!empty($id[$i])) {
					$result = $this->model->getContent($this->faqs, array('id' => $id[$i]),"status");
					if($result->status == 1) {
						$this->db->where('id',$id[$i]);
						$this->db->update($this->faqs, array('status' => 0));
					}
				}
			}
			$this->session->set_flashdata('success', 1);
			header('location:'.PATH_URL.'acp/faqs');
			exit();
		}
		if(isset($_POST['delButton'])) {
			$id = $this->input->post('id');
			for($i = 0; $i < count($id); $i++)
				$this->model->delRecord($this->faqs, array('id' => $id[$i]));
		} else {
			$id = $this->uri->segment(4);
			$this->model->delRecord($this->faqs, array('id' => $id));
		}
		$this->session->set_flashdata('success', 1);
		header('location:'.PATH_URL.'acp/faqs');
	}

	public function searchContent() {
		if($_POST){
			$keywords = $this->input->post('keywords');
			$category = $this->input->post("category");
			if(!empty($category)) {
				$result = $this->model->getListContent($this->faqs, array("category_id" => $category), "order_by asc", null, null);
			} else {
				$result = $this->model->search($this->faqs,$keywords);
			}
			$data = array(
				'result' => $result,
				'category' => $this->model->getListContent($this->category, array('parent_id' => 0,'type' => 'article'), "order_by asc", null,null, "name, id"),
			);
			$this->template->write_view('content','BACKEND/faqs/content', $data);
			$this->template->render();
		}
	}

	public function deleteImageContent() {
		if(!empty($_POST)) {
			$id = $this->input->post('id');
			$img = $this->model->getContent($this->faqs, array('id' => $id));
			if(!empty($img->images))
				@unlink(BASEFOLDER.'img_data/'.$img->images);
			$this->db->where('id',$id);
			if($this->db->update($this->faqs, array('images' => "")))
				echo "<img src='".PATH_URL."img_data/no_images.gif'>";
			exit();
		}
	}

	public function checkLinks()
    {
		$links = $this->input->post('links');
		$id = $this->input->post('id');
        $result = $this->model->getContent($this->faqs, array('links' => $links, 'id <> ' => $id));

        if(empty($result)) {
			$link = $links;
		} else {
			$link = $this->db->get($this->faqs)->num_rows().'-'.$this->input->post('links');
		}
		if($id == '') {
			$order_by = (int) $this->db->get($this->faqs)->num_rows() + 1;
		} else {
			$order_by = $this->model->getContent($this->faqs, array('id' => $id))->order_by;
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
			$result = $this->model->getContent($this->faqs, array('id' => $id));
			if($result->$type == 1)
				$data[$type] = 0;
			else
				$data[$type] = 1;

			$this->db->where('id', $id);
			if($this->db->update($this->faqs, $data))
				echo 1;
			else
				echo 0;
		}
		exit();
	}

	public function changeOrderBy()
	{
		$id = $this->input->post('id');
		$order_by = $this->input->post('order_by');
		$result = $this->model->getContent($this->faqs, array('id' => $id));
		$data = array('order_by' => $order_by);
		$this->db->where('id', $id);
		if($this->db->update($this->faqs, $data))
			echo $order_by;
		else echo 0;
		exit();
	}
}
