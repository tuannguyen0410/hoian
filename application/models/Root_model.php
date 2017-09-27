<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Root_model extends CI_Model
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
	
	public function getParentId($table, $id,&$tam='')
	{
		$tam .= $id.',';
		$result = $this->getCategoryId($table, array('parent_id' => $id));
		if(!empty($result)) {
			foreach($result as $k){
				if($k->parent_id == $id) {
					$this->getParentId($table, $k->id,$tam);
				}
			}
		}
		return rtrim($tam,",");
	}
	
	public function getMenuTop($table, $where, $home_lang, $select = null, $parent_id = 0) {
		$this->db->select($select);
		$this->db->where($where);
		$this->db->order_by('order_by', 'asc');
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			
			foreach($query->result() as $row){
				echo '<li data-id = "'.$row->id.'">';
				echo '<a href="'.PATH_URL.$row->links.'" title="'.$row->name.'">'.$row->name.'</a>';
				//$this->getMenuTop($table, array('status' => 1, 'type' => 'menu', 'parent_id' => $row->id), $home_lang, "name$home_lang as name, id, links$home_lang as links, category_id", $row->id);
				echo '</li>';
			}
		}
	}
	
	public function getMenuNav($table, $where, $home_lang, $select = null, $parent_id = 0) {
		$this->db->select($select);
		$this->db->where($where);
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			if($parent_id == 0) {
				$ul = '<ul id="menu-main-menu-1" class="sf-menu gdlr-main-menu">';
				$li = '<li class="menu-item menu-item-type-post_type menu-item-object-page page_item current_page_item menu-item-type-post_type menu-item-object-page current_page_item gdlr-normal-menu">';
			} else {
				$ul = '<ul class="sub-menu">';
				$li = '<li class="menu-item menu-item-type-custom menu-item-object-custom">';
			}
			echo $ul;
			foreach($query->result() as $row){
				echo $li;
				echo '<a href="'.PATH_URL.$row->links.'" title="'.$row->name.'">'.$row->name.'</a>';
				$this->getMenuNav($table, array('status' => 1, 'type' => 'menu', 'parent_id' => $row->id), $home_lang, "name$home_lang as name, id, links$home_lang as links, category_id", $row->id);
				echo "</li>";
			}
			echo '</ul>';
		}
	}
	
	public function getComment($table, $where, $article_id, $links, $parent_id = 0) {
		$this->db->where($where);
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			if($parent_id == 0) {
				$ol = '<ol class="commentlist">';
				$li = 'comment byuser comment-author-gdadmin bypostauthor even thread-even depth-1';
			} else {
				$ol = '<ol class="children">';
				$li = 'comment even depth-2';
			}
			echo $ol;
			foreach($query->result() as $row) {
				$onclick = '"comment-'.$row->id.'", "'.$row->id.'", "respond", "'.$article_id.'"';
				echo "<li class='".$li."' id='li-comment-".$row->id."'>";
					echo "<article id='comment-".$row->id."' class='comment-article'>
							<div class='comment-avatar'>
								<img alt='' src='http://0.gravatar.com/avatar/67b587616031ee8e892e9418558406ed?s=60&#038;d=mm&#038;r=g' srcset='http://0.gravatar.com/avatar/67b587616031ee8e892e9418558406ed?s=120&d=mm&r=g 2x' class='avatar avatar-60 photo' height='60' width='60' />
							</div>
							<div class='comment-body'>
								<header class='comment-meta'>
									<div class='comment-author gdlr-title'>".$row->name."</div>
									<div class='comment-time'>
										<i class='fa fa-clock-o'></i>
										<a href='".PATH_URL.$links."/#comment-".$row->id."'>
											<time>".date('d M Y H:i a', $row->created)."</time>
										</a>
									</div>
									<div class='comment-reply'>
										<i class='fa fa-mail-reply'></i>
										<a rel='nofollow' class='comment-reply-link' href='".PATH_URL.$links."/?replytocom=9#respond' onclick='return addComment.moveForm(".$onclick.")' aria-label='Reply to John Doe'>Reply</a>
									</div>
								</header>
								<section class='comment-content'>
									<p>".$row->content."</p>
								</section>
							</div>
						</article>";
					$this->getComment($table, array('parent_id' => $row->id), $article_id, $links, $row->id);
				echo "</li>";
			}
			echo "</ol>";
		}
	}
	
	public function getCategoryId($table, $where)
    {
        $this->db->select('id, parent_id');
        $this->db->where($where);
        $query = $this->db->get($table);
        if($query->num_rows() > 0) {
            foreach($query->result() as $row){
                $result[] = $row;
            }
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
    
	public function saveContent($table, $data) {
		$id = $this->input->post('id');
		if($id == null) {
			if($this->db->insert($table, $data))
				return true;
		} else {
			$this->db->where('id', $id);
			if($this->db->update($table, $data))
				return true;
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

	public function delRecord($table, $where)
    {
        $img = $this->getContent($table,$where);
        if(!empty($img->images)){
			@unlink(BASEFOLDER.'media/'.$img->images);
		}
        $this->db->where($where);
        if($this->db->delete($table))
			return true;
    }

    public function delListContent($table,$where)
    {
		$result = $this->getContent($table, $where);
		if(!empty($result)) {
			$this->delListImage('images', array('article_id' => $result->id));
			$this->delRecord($table,$where);
		}
		return true;
    }

	public function delListCategory($table,$where) {
		$result = $this->getListContent($table, $where);
		if(!empty($result)) {
			for($i = 0; $i < count($result); $i++) {
				$this->delRecord($table, array('id' => $result[$i]->id));
				$this->delListCategory($table, array('parent_id' => $result[$i]->id));
			}
		}
	}

    public function delListImage($table,$where)
    {
        $result = $this->getListContent($table,$where);
        if(!empty($result)){
            for($i = 0; $i < count($result); $i++){
                $this->delRecord($table,array('id' => $result[$i]->id));
            }
        }
    }
	
	public function search($table, $keyword = null, $limit = null, $page = 0, $where = null)
    {
		if(!empty($limit))
			$this->db->limit($limit, $page);
		if($keyword <> null){
			$this->db->like('name',$keyword);
		}
		if($where <> null)
			$this->db->where($where);
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
				if($where <> null)
					$this->db->where($where);
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