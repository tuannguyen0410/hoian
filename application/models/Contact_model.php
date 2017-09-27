<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_Model extends CI_Model
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
			'status' => $this->input->post('status')?1:0
		);
		$this->db->where('id', $id);
		if($this->db->update($table, $data)) {
			return true;
		}
	}
	
	public function resizeImage($path) {
		$config['image_library'] = 'GD2';
		$config['source_image'] = 'img_data/'.$path;
		$config['create_thumb'] = true;
		$config['maintain_ratio'] = true;
		$config['thumb_marker'] = '';
		$config['width'] = 1000;
		$config['height'] = 1000;
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
	}
	
	public function delete($table, $where)
    {
        $img = $this->getContent($table,$where);
        if(!empty($img)) {
            if(!empty($img->images)){
                unlink(BASEFOLDER.'img_data/'.$img->images);
            }
        }
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function delCategory($table,$where)
    {
		$result = $this->getContent($table, $where);
		if(!empty($result)) {
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
	
	public function search($table, $keyword = null, $limit = null, $page = 0)
    {
		if(!empty($limit))
			$this->db->limit($limit, $page);
		if($keyword <> null){
			$this->db->like('name',$keyword);
		}
        $query = $this->db->get($table);
        if($query->num_rows() > 0)
        {
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
            if($query->num_rows() > 0)
            {
                foreach($query->result() as $row)
                    $result[] = $row;
                if(!empty($result))
                    return $result;
                else return false;
            }
        }
    }
}