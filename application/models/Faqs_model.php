<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faqs_Model extends CI_Model
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
		$images = SEO(cleanUnicode($this->input->post('txtName'))).'-'.rand(0,10000);
		if($id == '') {
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
					$this->resizeImage($images.$ext);
				}
			}
			$data['created'] = time();
			if($this->db->insert($table, $data)) {
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
					$this->resizeImage($images.$ext);
					$data['images'] = $images.$ext;
				}

            }
			$this->db->where('id', $id);
			if($this->db->update($table, $data)) {
				return true;
			}
		}
	}

	public function delete($table, $where) {
    $img = $this->getContent($table,$where);
    if(!empty($img)) {
      if(!empty($img->images)){
        unlink(BASEFOLDER.'img_data/'.$img->images);
      }
    }
    $this->db->where($where);
    $this->db->delete($table);
  }

  public function delCategory($table,$where) {
		$result = $this->getContent($table, $where);
		if(!empty($result)) {
			$this->delete($table,$where);
		}
		return true;
  }

	public function search($table, $keyword = null, $limit = null, $page = 0) {
			if(!empty($limit))
				$this->db->limit($limit, $page);
			if($keyword <> null){
				$this->db->like('name',$keyword);
			}
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
