<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	private $user = "user";
	private $category = "category";
	private $product = "product";
	private $setting = "setting";
	private $tags = "tags";
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
			$left = array(
				'active' => 'product'
			);
			$this->template->write_view('left','BACKEND/left', $left);
		}
	}

	public function admincp() {
        $data = array(
			'category' => $this->model->getListContent($this->category, array('parent_id' => 0, 'type' => 'product'), "order_by asc", null,null, "name, id"),
			'result' => $this->model->getListContent($this->product,array('type' => 'product'), 'order_by asc, updated desc', null, null, "images,name,id,status,order_by,category_id,links,homepage,featured")
		);
		$this->template->write_view('content','BACKEND/product/content', $data);
		$this->template->render();
	}

	public function addContent() {
        $id = $this->uri->segment(4);
		if($id == null) {
			$result = null;
		} else {
			$result = $this->model->getContent($this->product, array('id' => $id));
		}
		$data = array(
			'result' => $result,
			'category' => $this->model->getListContent($this->category, array('parent_id' => 0, 'type' => 'page'), "order_by asc", null,null, "name, id")
		);
		$this->template->write_view('content','BACKEND/product/edit',$data);
		$this->template->render();
	}

	public function saveContent() {
		if($_POST) {
			$tags = $this->input->post('tags');
			if(!empty($tags)) {
				$exp_tags = explode(',',$tags);
				foreach($exp_tags as $name) {
					$res = $this->model->getContent($this->tags, array('name' => $name));
					if(empty($res))
						$this->model->saveContent($this->tags, array('name' => trim($name), 'links' => trim(cleanUnicode($name))));
				}
			}
			$id = $this->input->post('id');
			if($this->input->post('order_by') != '')
				$order_by = $this->input->post('order_by');
			else
				$order_by = 0;
			$category_id = $this->input->post('category_id');
			/*if(!empty($category_id)){
				$category_id = implode(',',$category_id);
			} else {
				$category_id = 0;
			}*/
			$data = array(
				'name' => trim(addslashes($this->input->post('txtName'))),
				'order_by' => $order_by,
				'category_id' => $category_id,
				'type' => 'product',
				'featured' => $this->input->post('featured')?1:0,
				'homepage' => $this->input->post('home')?1:0,
				'status' => $this->input->post('status')?1:0,
				'content' => trim(addslashes($this->input->post('content'))),
				'shortcontent' => trim(addslashes($this->input->post('shortcontent'))),
				'links' => trim($this->input->post('links')),
				'title' => trim($this->input->post('title')),
				'description' => trim($this->input->post('description')),
				'keywords' => trim($this->input->post('keywords')),
				'name_en' => trim(addslashes($this->input->post('txtName_en'))),
				'shortcontent_en' => trim(addslashes($this->input->post('shortcontent_en'))),
				'content_en' => trim(addslashes($this->input->post('content_en'))),
				'links_en' => trim('en/'.$this->input->post('links_en')),
				'tags' => trim($tags)
			);
			if($_FILES['images']['name'] != '') {
				if($id != '') {
					$img = $this->model->getContent($this->product, array('id' => $id), 'images');
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
			if($id == '') {
				$data['created'] = time();
				$data['updated'] = time();
			}
			if($this->model->saveContent($this->product, $data, $id)){
				if($id == '')
					$id = $this->db->insert_id();
				echo PATH_URL.'acp/product/edit/'.$id;
			}
		} else {
			header('location:'.PATH_URL.'acp/product');
		}
	}
	public function delete() {
		if(isset($_POST['orderButton'])) {
			$this->session->set_flashdata('success', 1);
			header('location:'.PATH_URL.'acp/product');
			exit();
		}
		if(isset($_POST['hideButton'])) {
			$id = $this->input->post('id');
			for($i = 0; $i < count($id); $i++){
				if(!empty($id[$i])) {
					$result = $this->product_model->getContent($this->product, array('id' => $id[$i]),"status");
					if($result->status == 1) {
						$this->db->where('id',$id[$i]);
						$this->db->update($this->product, array('status' => 0));
					}
				}
			}
			$this->session->set_flashdata('success', 1);
			header('location:'.PATH_URL.'acp/product');
			exit();
		}
		if(isset($_POST['delButton'])) {
			$id = $this->input->post('id');
			for($i = 0; $i < count($id); $i++)
				$this->model->delRecord($this->product, array('id' => $id[$i]));
		} else {
			$id = $this->uri->segment(4);
			$this->model->delRecord($this->product, array('id' => $id));
		}
		$this->session->set_flashdata('success', 1);
		header('location:'.PATH_URL.'acp/product');
	}

	public function searchContent($category) {
        $data = array(
            'category' => $this->model->getListContent($this->category, array('parent_id' => 0, 'type' => 'product'), "order_by asc", null,null, "name, id"),
			'result' => $this->model->getListContent($this->product, "FIND_IN_SET($category,category_id)>0 AND type = 'product'", "order_by asc", null, null, "images,name, id, status, order_by, category_id, links, homepage, featured")
        );
        $this->template->write_view('content','BACKEND/product/content', $data);
        $this->template->render();
	}

	public function deleteImageContent() {
		if(!empty($_POST)) {
			$id = $this->input->post('id');
			$img = $this->model->getContent($this->product, array('id' => $id));
			if(!empty($img->images))
				@unlink(BASEFOLDER.'media/'.$img->images);
			$this->db->where('id',$id);
			if($this->db->update($this->product, array('images' => "")))
				echo "<img src='".PATH_URL."media/no_images.gif'>";
			exit();
		}
	}

	public function checkLinks()
  {
		$links = $this->input->post('links');
		$id = $this->input->post('id');
    $result = $this->model->getContent($this->product, array('links' => $links, 'id <> ' => $id));
    if(empty($result)) {
			$link = $links;
		} else {
			$link = $this->db->get($this->product)->num_rows().'-'.$this->input->post('links');
		}
		if($id == '') {
			$order_by = (int) $this->db->get($this->product)->num_rows() + 1;
		} else {
			$order_by = $this->model->getContent($this->product, array('id' => $id))->order_by;
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
			$result = $this->model->getContent($this->product, array('id' => $id));
			if($result->$type == 1)
				$data[$type] = 0;
			else
				$data[$type] = 1;

			$this->db->where('id', $id);
			if($this->db->update($this->product, $data))
				echo 1;
			else
				echo 0;
		}
	}

	public function changeOrderBy()
	{
		$id = $this->input->post('id');
		$order_by = $this->input->post('order_by');
		$result = $this->model->getContent($this->product, array('id' => $id));
		$data = array('order_by' => $order_by);
		$this->db->where('id', $id);
		if($this->db->update($this->product, $data))
			echo $order_by;
		else echo 0;
	}
}
