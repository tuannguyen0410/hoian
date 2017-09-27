<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admincp_Model extends CI_Model
{
	public function login($table, $where)
	{
		if(!empty($where))
			$this->db->where($where);
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			foreach($query->result() as $row)
				$result = $row->passwords;
			if(!empty($result))
				return $result;
			else return false;
		}
	}
	public function getListContent($table, $where = null, $order_by = null, $limit = null, $page = null,$select = null) {
		if($select <> null)
			$this->db->select($select);
		if($where <> null)
			$this->db->where($where);
		if($order_by <> null)
			$this->db->order_by($order_by);
		if($limit <> null && $page <> null)
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
}