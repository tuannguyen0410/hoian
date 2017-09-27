<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_Model extends CI_Model
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
		$order_by = 0;
		$data = array(
			'name' => $this->input->post('txtName'),
			'order_by' => $order_by,
			'type' => 'product',
			'category_id' => $this->input->post('category'),
			'featured' => $this->input->post('featured')?1:0,
			'homepage' => $this->input->post('homepage')?1:0,
			'status' => $this->input->post('status')?1:0,
			'content' => $this->input->post('content'),
			'shortcontent' => $this->input->post('shortcontent'),
			'links' => $this->input->post('links'),
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description'),
			'keywords' => $this->input->post('keywords')
		);
		$images = SEO(cleanUnicode($this->input->post('txtName'))).'-'.rand(0,10000);
		if($id == null) {
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
			$data['updated'] = time();
			if($this->db->insert($table, $data)) {
				$oldId = $this->db->insert_id();
				$gallery_name = $_FILES['gallery']['name'];
				if(!empty($gallery_name)) {
          for($i = 0; $i < count($gallery_name); $i++){
            $gallery['products_id'] = $oldId;
            if($gallery_name[$i] != '') {
							$ext = '.'.end(explode('.',$gallery_name[$i]));
							$type = explode("/",$_FILES['gallery']['type'][$i]);
							if($type[0] != 'image') {
								$this->session->set_flashdata('error_img', 1);
								header('location:'.$_SERVER['HTTP_REFERER']);
								exit;
							}
							if(move_uploaded_file($_FILES['gallery']['tmp_name'][$i],BASEFOLDER.'img_data/'.$images.'-'.$i.$ext))
							{
								$gallery['images'] = $images.'-'.$i.$ext;
								$this->db->insert('images',$gallery);
							}
						}
          }
        }
				$this->saveDigital($oldId);
				$this->saveProducts($oldId);
				return true;
			}
		} else {
			$img = $this->getContent($table,array('id' => $id));
            if(!empty($_FILES['images']['name']))
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
				if(!empty($_FILES['gallery']['name']))
                {
                    $gallery_name = $_FILES['gallery']['name'];
                    for($i = 0; $i < count($gallery_name); $i++){
                        $gallery['products_id'] = $id;
                        if(!empty($gallery_name[$i])) {
							$ext = '.'.end(explode('.',$gallery_name[$i]));
							$type = explode("/",$_FILES['gallery']['type'][$i]);
							if($type[0] != 'image') {
								$this->session->set_flashdata('error_img', 1);
								header('location:'.$_SERVER['HTTP_REFERER']);
								exit;
							}
							if(move_uploaded_file($_FILES['gallery']['tmp_name'][$i],BASEFOLDER.'img_data/'.$images.'-'.$i.$ext))
							{
								$gallery['images'] = $images.'-'.$i.$ext;
								$this->db->insert('images',$gallery);
							}
						}
                    }
                }
				$this->saveDigital($id);
				$this->saveProducts($id);
				return true;
			}
		}
	}

	private function saveDigital($id){
		$table = 'digital_content';
		$category = $this->getListContent('digital');
		if(!empty($category)) {
			for($i = 0; $i < count($category); $i++) {
				$properties = $this->input->post('properties_'.$category[$i]->id);
				$value = $this->input->post('value_'.$category[$i]->id);
				for($j = 0; $j < count($properties); $j++) {
					if($properties[$j] <> null) {
						$digital_content = array(
							'properties' => $properties[$j],
							'value' => $value[$j],
							'products_id' => $id,
							'digital_id' => $category[$i]->id
						);
						$this->db->insert($table,$digital_content);
					}
				}
			}
		}
	}

	private function saveProducts($id) {
		$result = $this->getContent('products', array('article_id' => $id));
		$color = $this->input->post('color_id');
		$feature = $this->input->post('feature_id');
		if(!empty($color))
			$color_id = implode(",",$this->input->post('color_id'));
		else
			$color_id = 0;
		if(!empty($feature))
			$feature_id = implode(",",$this->input->post('feature_id'));
		else
			$feature_id = 0;
		$data = array(
			'article_id' => $id,
			'brand_id' => $this->input->post('brand_id'),
			'code' => $this->input->post('code'),
			'price' => trimPrice($this->input->post('price')),
			'promotion' => $this->input->post('promotion'),
			'sale_price' => $this->input->post('sale_price'),
			'operating_id' => $this->input->post('operating_id'),
			'color_id' => $color_id,
			'feature_id' => $feature_id
		);
		if(!empty($result)) {
			$this->db->where('article_id', $id);
			$this->db->update('products',$data);
		} else {
			$this->db->insert('products',$data);
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
			$this->delProducts('images', array('products_id' => $result->id));
			$this->delProducts('digital_content', array('products_id' => $result->id));
			$this->delProducts('products', array('article_id' => $result->id));
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
