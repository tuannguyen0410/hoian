<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Translate_Model extends CI_Model
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
    
	public function saveContent($table) {
		$id = $this->input->post('id');
		$data = array(
			'name' => trim(addslashes($this->input->post('txtName'))),
			'name_en' => trim(addslashes($this->input->post('txtName_en'))),
            'value' => trim($this->input->post('value'))
		);
        
		if($id == null) {
			if($this->db->insert($table, $data))
				return true;
		} else {
			$this->db->where('id', $id);
			if($this->db->update($table, $data))
				return true;
		}
	}

	public function delete($table, $where)
    {
        $this->db->where($where);
        if($this->db->delete($table))
			return true;
    }

    public function delCategory($table,$where)
    {
		$result = $this->getContent($table, $where);
		$this->delete($table,$where);
		return true;
    }

	public function search($table, $keyword = null) {
			if($keyword <> null){
				$this->db->like('name',$keyword);
			}
			$this->db->where('type','banner');
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
				$this->db->where('type','banner');
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
