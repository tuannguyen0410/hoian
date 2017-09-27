<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Tour extends CI_Controller {
	private $user = "user";
	private $category = 'category';
	private $article = "article";
	private $info = "info";
	private $book = "book";
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
				'active' => 'tour',
				'slug' => $this->uri->segment(3)
				);
			$this->template->write_view('left','BACKEND/left', $left);
		}
	}

	public function admincp() {
		$setting = $this->model->getContent($this->setting, null, "row_per_page");
		$data = array(
			'category' => $this->model->getListContent($this->category, array('parent_id' => 0, 'type' => 'tour'), "order_by asc", null,null, "name, id"),
			'result' => $this->model->getListContent($this->article,array('type' => 'tour'), 'category_id asc, order_by asc, updated desc', null, null, "images,name,name_en,id,status,order_by,category_id,links,homepage,featured, title")
			); 
		$this->template->write_view('content','BACKEND/tour/content', $data);
		$this->template->render();
	}

	public function book() {
		$setting = $this->model->getContent($this->setting, null, "row_per_page");
		$this->db->select('info.id,info.lastname,info.firstname,info.email,info.phone,info.price,info.currency,info.status,book.info_id,book.name,book.date');
		$this->db->from('info');
		$this->db->join('book' ,'book.info_id = info.id');
		$this->db->order_by("id", "desc");
		// $this->db->where('book.info_id = info.id');
		$q = $this->db->get(); 
		$result = $q->result();
		// $result = $this->model->getListContent($this->info, null,  'id desc', null, null, "*");
		// var_dump($result);exit();

		$data = array(
			'status' => array( 0 => 'Cancel', 1 => 'Waiting', 2 => 'Paid', 3 => 'Finish'),
			'result' => $result
			);
		$this->template->write_view('content','BACKEND/tour/book', $data);
		$this->template->render();
	}
	
	public function book_view() {
		$id = $this->uri->segment(4);
		if($id == null) {
			$result = null;
			$book = null;
		} else {
			$result = $this->model->getContent($this->info, array('id' => $id));
			$book = $this->model->getListContent($this->book, array('info_id' => $id));
		}
		$data = array(
			'status' => array( 0 => 'Cancel', 1 => 'Waiting', 2 => 'Paid', 3 => 'Finish'),
			'result' => $result,
			'book' => $book, 
			);
		if($_POST){
			$this->db->where('id', $id);
			$this->db->update($this->info, array('status' => $_POST['status']));

			header('location:'.PATH_URL.'acp/tour/book_view/'.$id);
		}
		$this->template->write_view('content','BACKEND/tour/book_view', $data);
		$this->template->render();
	}

	public function addContent() {  
		$id = $this->uri->segment(4);
		if($id == null) {
			$result = null;
			$img = null;
		} else {
			$result = $this->model->getContent($this->article, array('id' => $id));
			$img = $this->model->getListContent($this->images, array('article_id' => $id));
		}
		$data = array(
			'result' => $result,
			'images' => $img,
			'category' => $this->model->getListContent($this->category, array('parent_id' => 0, 'type' => 'tour'), "order_by asc", null,null, "name, id")
			);
		$this->template->write_view('content','BACKEND/tour/edit',$data);
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
				'shortcontent' => addslashes($this->input->post('itinerary')),
				'content' => addslashes($this->input->post('inclusion')),
				'title' => trim(addslashes($this->input->post('price'))),
				'keywords' => trim(addslashes($this->input->post('departures'))),
				'description' => trim(addslashes($this->input->post('description'))),
				'order_by' => $order_by,  
				'category_id' => $category_id,
				'type' => 'tour',
				'featured' => $this->input->post('featured')?1:0,
				'homepage' => $this->input->post('home')?1:0,
				'status' => $this->input->post('status')?1:0,
				'links' => trim($this->input->post('links')),
				'name_en' => trim(addslashes($this->input->post('txtName_en'))),
				'content_en' => trim(addslashes($this->input->post('content_en'))),
				'shortcontent_en' => trim(addslashes($this->input->post('txtAddress_en'))),
				'links_en' => trim($this->input->post('links_en'))
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
			if($id == '') {
				$data['created'] = time();
				$data['updated'] = time();
			}
			if($this->model->saveContent($this->article,$data)){
				if($id == '')
					$id = $this->db->insert_id();
				$gallery_name = $_FILES['gallery']['name'];
				$chk_type = array("image/gif","image/jpeg","image/png","image/bmp");
				for($i = 0; $i < count($gallery_name); $i++){
					if($gallery_name[$i] != '') {
						$fext = explode('.',$gallery_name[$i]);
						$ext = '.'.end($fext);
						$type1 = $_FILES['gallery']['type'][$i];
						if(in_array($type1,$chk_type)) {
							$name = str_replace($ext,"",$gallery_name[$i]);
							$name = SEO($name).'-'.rand(0,999);
							if(move_uploaded_file($_FILES['gallery']['tmp_name'][$i],BASEFOLDER.'media/'.$name.$ext)) {
								$gallery['images'] = $name.$ext;
								$gallery['article_id'] = $id;
								$this->db->insert('images',$gallery);
							}
						}
					}
				}
				echo PATH_URL.'acp/tour/edit/'.$id;
			}
		}
	}
	public function delete() {
		if(isset($_POST['exportXls'])) {
			$this->db->select('info.id,info.lastname,info.firstname,info.email,info.phone,info.price,info.currency,info.status,book.info_id,book.name,book.date');
			$this->db->from('info');
			$this->db->join('book' ,'book.info_id = info.id');
			$this->db->order_by("id", "desc");
			$q = $this->db->get(); 
			$result = $q->result();
		

			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle('Book Export');
			//set cell A1 content with some text
			if(!empty($result)) {
				$this->excel->getActiveSheet()->setCellValue('A1', '#');
				$this->excel->getActiveSheet()->setCellValue('B1', 'Book by');
				$this->excel->getActiveSheet()->setCellValue('C1', 'Price');
				$this->excel->getActiveSheet()->setCellValue('D1', 'Email');
				$this->excel->getActiveSheet()->setCellValue('E1', 'Phone');
				$this->excel->getActiveSheet()->setCellValue('F1', 'Tour Name');
				$this->excel->getActiveSheet()->setCellValue('G1', 'Date');
				$this->excel->getActiveSheet()->setCellValue('H1', 'Status');

				$i = 1;
				foreach ($result as $items => $item) {
					$i++;
					$this->excel->getActiveSheet()->setCellValue('A'.$i, $i-1);
					$this->excel->getActiveSheet()->setCellValue('B'.$i, $item->firstname.$item->lastname);
					$this->excel->getActiveSheet()->setCellValue('C'.$i, ($item->currency == 1)? '$'.number_format($item->price):number_format($item->price).' VND');
					$this->excel->getActiveSheet()->setCellValue('D'.$i,  $item->email);
					$this->excel->getActiveSheet()->setCellValue('E'.$i, $item->phone);
					$this->excel->getActiveSheet()->setCellValue('F'.$i, $item->name);
					$this->excel->getActiveSheet()->setCellValue('G'.$i, $item->date);
					$this->excel->getActiveSheet()->setCellValue('H'.$i,($item->status == 1)? 'Waiting':' Paid');

				}
				$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
			} else {
				$this->excel->getActiveSheet()->setCellValue('A1', 'No Value');
				//change the font size
				$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
				//make the font become bold
				$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				//merge cell A1 until D1
				$this->excel->getActiveSheet()->mergeCells('A1:D1');
				//set aligment to center for that merged cell (A1 to D1)
				$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			$filename=date("d_m_Y").'_book_export.xls'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache

			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');
			exit();
		}
		if(isset($_POST['orderButton'])) {
			$this->session->set_flashdata('success', 1);
			header('location:'.PATH_URL.'acp/tour');
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
			header('location:'.PATH_URL.'acp/tour');
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
		header('location:'.PATH_URL.'acp/tour');
	}

	public function searchContent($category) {
		$data = array(
			'category' => $this->model->getListContent($this->category, array('parent_id' => 0, 'type' => 'tour'), "order_by asc", null,null, "name, id"),
			'result' => $this->model->getListContent($this->article, "FIND_IN_SET($category,category_id)>0 AND type = 'tour'", "order_by asc", null, null, "images,name, id, status, order_by, category_id, links, homepage, featured, title")
			);
		$this->template->write_view('content','BACKEND/tour/content', $data);
		$this->template->render();
	}

	public function delGalleryImage() {
		$id = $this->input->post('id');
		$img = $this->model->getContent($this->images, array('id' => $id));
		if($img->images != '')
			@unlink(BASEFOLDER.'media/'.$img->images);
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
		$order_by = (int) $this->db->get_where($this->article, array('type' => 'tour'))->num_rows() + 1;
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
