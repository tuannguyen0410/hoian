<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Testimonial extends CI_Controller {
	private $user = "user";
	private $category = 'category';
	private $article = "article";
	private $setting = "setting";
	private $images = "images";
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
				'active' => 'testimonial',
				'category' => 'testimonial'
			);
			$this->template->write_view('left','BACKEND/left',$left);
		}
	}

	public function admincp() {
		$setting = $this->model->getContent($this->setting, null, "row_per_page");
		$data = array(
			'category' => $this->model->getListContent($this->category, array('parent_id' => 0, 'type' => 'page'), "order_by asc", null,null, "name, id"),
			'result' => $this->model->getListContent($this->article,array('type' => 'testimonial'), 'category_id asc, order_by asc, updated desc', null, null, "images,name,name_en,id,status,order_by,category_id,links,homepage,featured")
		);
		$this->template->write_view('content','BACKEND/testimonial/content', $data);
		$this->template->render();
	}

	public function addContent() {
		$id = $this->uri->segment(4);
		if($id == null) {
			$result = null;
		} else {
			$result = $this->model->getContent($this->article, array('id' => $id));
		}
		$data = array(
			'result' => $result,
			'category' => $this->model->getListContent($this->category, array('parent_id' => 0, 'type' => 'testimonial'), "order_by asc", null,null, "name, id")
		);
		$this->template->write_view('content','BACKEND/testimonial/edit',$data);
		$this->template->render();
	}

	public function saveContent() {
		if($_POST) {
			$id = $this->input->post('id');
			if($this->input->post('order_by') != '')
				$order_by = $this->input->post('order_by');
			else
				$order_by = 0;
			$category = $this->input->post('category');
			if(!empty($category))
				$category_id = implode(',',$category);
			else
				$category_id = 0;
			$data = array(
				'name' => trim(addslashes($this->input->post('txtName'))),
				'content' => addslashes($this->input->post('content')),
				'order_by' => $order_by,
				'category_id' => $category_id,
				'type' => 'testimonial',
				'featured' => $this->input->post('featured')?1:0,
				'homepage' => $this->input->post('home')?1:0,
				'status' => $this->input->post('status')?1:0,
				'shortcontent' => trim($this->input->post('shortcontent')),
				'name_en' => trim(addslashes($this->input->post('txtName_en'))),
				'content_en' => trim(addslashes($this->input->post('content_en'))),
				'shortcontent_en' => trim($this->input->post('shortcontent_en'))
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
			if($this->model->saveContent($this->article,$data)){
				if($id == '')
					$id = $this->db->insert_id();
			}
		}
	}
	public function delete() {
		if(isset($_POST['orderButton'])) {
			$this->session->set_flashdata('success', 1);
			header('location:'.PATH_URL.'acp/testimonial');
			exit();
		}
		if(isset($_POST['hideButton'])) {
			$id = $this->input->post('id');
			for($i = 0; $i < count($id); $i++){
				if(!empty($id[$i])) {
					$result = $this->model->getContent($this->article, array('id' => $id[$i]),"status");
					if($result->status == 1) {
						$this->db->where('id',$id[$i]);
						$this->db->update($this->article, array('status' => 0));
					}
				}
			}
			$this->session->set_flashdata('success', 1);
			header('location:'.PATH_URL.'acp/testimonial');
			exit();
		}
		if(isset($_POST['delButton'])) {
			$id = $this->input->post('id');
			for($i = 0; $i < count($id); $i++)
				$this->model->delListContent($this->article, array('id' => $id[$i]));
		} else {
			$id = $this->uri->segment(4);
			$this->model->delListContent($this->article, array('id' => $id));
		}
		$this->session->set_flashdata('success', 1);
		header('location:'.PATH_URL.'acp/testimonial');
	}

	public function searchContent($category) {
		$data = array(
            'category' => $this->model->getListContent($this->category, array('parent_id' => 0, 'type' => 'page'), "order_by asc", null,null, "name, id"),
			'result' => $this->model->getListContent($this->article, "FIND_IN_SET($category,category_id)>0 AND type = 'testimonial'", "order_by asc", null, null, "images,name, id, status, order_by, category_id, links, homepage, featured")
        );
		$this->template->write_view('content','BACKEND/testimonial/content', $data);
		$this->template->render();
	}

	public function delGalleryImage() {
    $id = $this->input->post('id');
    $img = $this->model->getContent($this->images, array('id' => $id));
    if($img->images != '')
      unlink(BASEFOLDER.'media/'.$img->images);
    $this->db->where('id',$id);
    if($this->db->delete($this->images)){
			$img = $this->model->getListContent($this->images, array('article_id' => $img->article_id));
			$html = "";
			if(!empty($img)) {
				foreach($img as $items=>$item) {
					$html .= "<div class='file-preview-frame'>
										<img src='".PATH_URL."media/".$item->images."' class='file-preview-image' style='width:auto;height:110px;'>
										<div class=''file-thumbnail-footer'>
											<div class='file-footer-caption'>".$this->model->getContent($this->article, array('id' => $item->article_id),"name")->name."</div>
											<div class='file-actions'>
												<button type='button' class='kv-file-remove btn btn-xs btn-default' title='Remove file' onclick='delGalleryImage(".$item->id.")'><i class='glyphicon glyphicon-trash text-danger'></i></button>
											</div>
											<div class='clearfix'></div>
										</div>
									</div>";
				}
				$html .= "<div class='clearfix'></div>";
			}
			echo $html;
    } else {
      echo 0;
    }
		exit();
  }

	public function deleteImageContent() {
		if(!empty($_POST)) {
			$id = $this->input->post('id');
			$img = $this->model->getContent($this->article, array('id' => $id));
			if(!empty($img->images))
				@unlink(BASEFOLDER.'media/'.$img->images);
			$this->db->where('id',$id);
			if($this->db->update($this->article, array('images' => "")))
				echo "<img src='".PATH_URL."media/no_images.gif'>";
			exit();
		}
	}

	public function checkLinks()
    {
		$links = $this->input->post('links');
		$id = $this->input->post('id');
        $result = $this->model->getContent($this->article, array('links' => $links, 'id <> ' => $id));

        if(empty($result)) {
			$link = $links;
		} else {
			$link = $this->db->get($this->article)->num_rows().'-'.$this->input->post('links');
		}
		if($id == '') {
			$order_by = (int) $this->db->get_where($this->article, array('type' => 'testimonial'))->num_rows() + 1;
		} else {
			$order_by = $this->model->getContent($this->article, array('id' => $id))->order_by;
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
			$result = $this->model->getContent($this->article, array('id' => $id));
			if($result->$type == 1)
				$data[$type] = 0;
			else
				$data[$type] = 1;

			$this->db->where('id', $id);
			if($this->db->update($this->article, $data))
				echo 1;
			else
				echo 0;
		}
	}

	public function changeOrderBy()
	{
		$id = $this->input->post('id');
		$order_by = $this->input->post('order_by');
		$result = $this->model->getContent($this->article, array('id' => $id));
		$data = array('order_by' => $order_by);
		$this->db->where('id', $id);
		if($this->db->update($this->article, $data))
			echo $order_by;
		else echo 0;
	}
}
