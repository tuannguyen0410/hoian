<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_Model extends CI_Model
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
	public function saveRecord($table) {
		$id = $this->input->post('id');
		if($this->input->post('order_by') != '')
			$order_by = $this->input->post('order_by');
		else
			$order_by = 0;
		$category_id = $this->input->post('category');
		if(!empty($category_id)){
			$category_id = implode(',',$category_id);
		} else {
			$category_id = 0;
		}
		$data = array(
			'name' => trim(addslashes($this->input->post('txtName'))),
			'order_by' => $order_by,
			'category_id' => $category_id,
			'type' => 'article',
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
            'links_en' => trim($this->input->post('links_en')),
		);
		$images = SEO(cleanUnicode($this->input->post('txtName'))).'-'.rand(0,10000);
		if($id == '') {
			if($_FILES['images']['name'] != '') {
				$ext = '.'.end(explode('.',$_FILES['images']['name']));
				$type = explode("/",$_FILES['images']['type']);
				if($type[0] != 'image') {
					$this->session->set_flashdata('error_img', 1);
					header('location:'.$_SERVER['HTTP_REFERER']);
					exit;
				}
				if(move_uploaded_file($_FILES['images']['tmp_name'],BASEFOLDER.'media/'.$images.$ext)) {
					$data['images'] = $images.$ext;
				}
			}
			$data['created'] = time();
			$data['updated'] = time();
			if($this->db->insert($table, $data)) {
				return true;
			}
		} else {
			$img = $this->getContent($table,array('id' => $id));
            if($_FILES['images']['name'] != '') {
                $ext = '.'.end(explode('.',$_FILES['images']['name']));
				$type = explode("/",$_FILES['images']['type']);
				if($type[0] != 'image') {
					$this->session->set_flashdata('error_img', 1);
					header('location:'.$_SERVER['HTTP_REFERER']);
					exit;
				}
                if($img->images != null)
					unlink(BASEFOLDER.'media/'.$img->images);
				if(move_uploaded_file($_FILES['images']['tmp_name'],BASEFOLDER.'media/'.$images.$ext)) {
					$data['images'] = $images.$ext;
				}
			}
			$this->db->where('id', $id);
			if($this->db->update($table, $data)) {
				return true;
			}
		}
	}
	
	public function chk_image($file,$file_type) {
		$ext = explode('.',$file);
		$ext = end($ext);
		$chk_ext = array("png","gif","jpg","jpge");
		$chk_type = array("image/gif","image/jpeg","image/png","image/bmp");
		if(in_array(strtolower($ext),$chk_ext) == true && in_array(strtolower($file_type),$chk_type) == true) {
			return true;
		} else {
			$this->session->set_flashdata('error_img', 1);
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}
		
	}

	public function resizeImage($path) {
		$config['image_library'] = 'GD2';
		$config['source_image'] = 'media/'.$path;
		$config['create_thumb'] = true;
		$config['maintain_ratio'] = true;
		$config['thumb_marker'] = '';
		$config['width'] = 1000;
		$config['height'] = 1000;
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
	}
    
    public function maxId($table) {
        $this->db->select_max('id');
        $query = $this->db->get($table);
        if($query->num_rows() > 0) {
            foreach($query->result() as $row)
                $result = $row->id + 1;
            if(!empty($result))
                return $result;
            else
                return false;
        }
    }

	public function delete($table, $where)
    {
        $img = $this->getContent($table,$where);
        if(!empty($img)) {
            if(!empty($img->images)){
                unlink(BASEFOLDER.'media/'.$img->images);
            }
        }
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function delCategory($table,$where)
    {
		$result = $this->getContent($table, $where);
		if(!empty($result)) {
			$this->delProducts('images', array('article_id' => $result->id));
			$this->delete($table,$where);
		}
		return true;
    }

    public function delProducts($table,$where)
    {
        $result = $this->getListContent($table,$where);
        if(!empty($result)){
            for($i = 0; $i < count($result); $i++){
                $this->delete($table,array('id' => $result[$i]->id));
            }
        }
    }

	public function search($table, $keyword = null, $limit = null, $page = 0) {
		if(!empty($limit))
			$this->db->limit($limit, $page);
		if($keyword <> null){
			$this->db->like('name',$keyword);
		}
		$this->db->where('type', 'article');
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			foreach($query->result() as $row)
				$result[] = $row;
			if(!empty($result))
				return $result;
			else return false;
		} else {
			$keyword = explode(" ", $keyword);
			for($i = 0; $i < count($keyword); $i++){
				$this->db->or_like('name',$keyword[$i]);
				$this->db->where('type', 'article');
			}	
			$query = $this->db->get($table);
			if($query->num_rows() > 0) {
				foreach($query->result() as $row)
				  $result[] = $row;
				if(!empty($result))
				  return $result;
				else return false;
			}
		}
	}
}
