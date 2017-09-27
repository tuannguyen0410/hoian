<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
	private $user = "user";
	private $contact = "contact";
	private $setting = "setting";
	private $faqs = "faqs";
	private $article = "article";
	private $category = "category";
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
				'active' => "contact"
			);
			$this->template->write_view('left','BACKEND/left', $left);
		} else {
			$this->template->set_template("home");
            if($this->uri->segment(1) == 'en') {
                $this->session->set_userdata('home_lang','_en');
                $this->lang->load('en',"english");
            } else {
                $this->session->set_userdata('home_lang','');
                $this->lang->load("vi","vietnam");
            }
            $home_lang = $this->session->userdata('home_lang');
			$banner_header = $this->model->getContent($this->category, array('links' => 'header','type' => 'page', 'parent_id' => 0),"id");
			$header = array(
				'menu' => $this->model->getListContent($this->category, array('status' => 1, 'type' => 'page', 'parent_id' => 0), 'order_by asc', null, null, "id, links$home_lang as links"),
				'setting' => $this->model->getContent($this->setting, null, "phone, email, fax, owner_company, address, latitude, longitude"),
                'home_lang' => $home_lang,
                'banner_header' => $this->model->getListContent($this->article, array('status' => 1, 'category_id' => $banner_header->id), 'order_by asc', null, null, "name$home_lang as name, content$home_lang as content")
			);
			$this->template->write_view('header','FRONTEND/header',$header);
			$banner_footer = $this->model->getContent($this->category, array('links' => 'footer','type' => 'page', 'parent_id' => 0),"id");
			$footer = array(
				'block_footer' => $this->model->getListContent($this->article, array('status' => 1, 'category_id' => $banner_footer->id), 'order_by asc', null, null, "name$home_lang as name, content$home_lang as content")
			);
			$this->template->write_view('footer','FRONTEND/footer',$footer);
		}
	}

	public function index() {
        $home_lang = $this->session->userdata('home_lang');
		$contact_id = $this->model->getContent($this->category, array('links' => 'contact','type' => 'page', 'parent_id' => 0),"id");
		$data = array(
			'result' => $this->model->getListContent($this->article, array('category_id' => $contact_id->id, 'status' => 1), 'order_by asc', null, null, "name$home_lang as name, content$home_lang as content"),
			'faqs' => $this->model->getListContent($this->faqs, array('type' => 'faqs', 'status' => 1), 'order_by asc', null, null, "name$home_lang as name, content$home_lang as content")
		);
        $this->template->write('title','Contact Us');
		$this->template->write_view('content','FRONTEND/contact/content',$data);
		$this->template->render();
	}

	public function send(){
		if(isset($_POST['sendContact']) && isset($_POST['txtName']) && isset($_POST['txtMessage'])) {
			$data = array(
				'name' => $this->input->post('txtName'),
				'email' => $this->input->post('txtEmail'),
				'address' => $this->input->post('txtAddress'),
				'phone' => $this->input->post('txtPhone'),
				'content' => $this->input->post('txtMessage'),
				'created' => time(),
				'status' => 0
			);
			
			if($this->db->insert($this->contact, $data)){
				$this->session->set_flashdata('contact',1);
				$this->session->set_userdata('ori_contact',1);
			}

			
			$info_s = $this->model->getContent($this->setting, null, "email,website_title");
			
			$html = '<div style="width:100%">
		                <h3>CONTACT INFO</h3>
		            	<div style="padding-left: 10px;">
		                	<p>Name: '.$data['name'].'</p>
		                	<p>Email: '.$data['email'].'</p>
		                	<p>Address: '.$data['address'].'</p>
		                	<p>Phone: '.$data['phone'].'</p>
		                	<p>Message: '.$data['content'].'</p>          
		                </div>           
		            </div>';
			$this->load->library('My_email');
			$mail = new PHPMailer(true);
			$mail->IsSMTP();
			$mail->SMTPDebug = 0; // enables SMTP debug information
			$mail->SMTPAuth = true; // enable SMTP authentication
			
			$mail->Host = 'smtp.sendgrid.net'; // sets the SMTP server
			$mail->Port = '587'; // Set the SMTP port
			$mail->Username = 'saigonadventure'; // SMTP account username
			$mail->Password = 'j-QE*F4cj4cmv6z'; // SMTP account password
			
			$mail->AddAddress($info_s->email, $info_s->website_title.' Contact Form: '.$data['email']);
			$mail->AddReplyTo($data['email'], 'Reply to: ');
			// //$mail->AddCC($info_s->email);
			$mail->SetFrom("no-reply@saigonadventure.com", $info_s->website_title.' Contact Form: '.$data['email']);
			$mail->Subject = $info_s->website_title.' Contact Form: '.$data['email'];
			$mail->MsgHTML($html);
			$mail->Send();		   
		}else{
			$this->session->set_userdata('ori_contact',2);
		}
		header('location:'.$_SERVER['HTTP_REFERER']);
	}

	public function admincp() {
		$data = array(
			'result' => $this->model->getListContent($this->contact, null, 'created desc', null)
		);
		$this->template->write_view('content','BACKEND/contact/content', $data);
		$this->template->render();
	}

	public function addContent() {
		$id = $this->uri->segment(4);
		$result = $this->model->getContent($this->contact, array('id' => $id));
		$data = array(
			'result' => $result
		);
		$this->template->write_view('content','BACKEND/contact/edit',$data);
		$this->template->render();
	}

	public function saveContent() {
		if($_POST) {
			$data = array(
				'status' => $this->input->post('status')?1:0
			);
			if($this->model->saveContent($this->contact,$data)){
				$this->session->set_flashdata('success', 1);
				header('location:'.PATH_URL.'acp/contact');
			}
		}
	}
	public function delete() {
		if(isset($_POST['exportXls'])) {
			$result = $this->model->getListContent($this->contact);
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle('Contact Export');
			//set cell A1 content with some text
			if(!empty($result)) {
				$this->excel->getActiveSheet()->setCellValue('A1', '#');
				$this->excel->getActiveSheet()->setCellValue('B1', 'Name');
				$this->excel->getActiveSheet()->setCellValue('C1', 'Email');
				$this->excel->getActiveSheet()->setCellValue('D1', 'Created');
				$this->excel->getActiveSheet()->setCellValue('E1', 'Content');
				$i = 1;
				foreach ($result as $items => $item) {
					$i++;
					$this->excel->getActiveSheet()->setCellValue('A'.$i, $i-1);
					$this->excel->getActiveSheet()->setCellValue('B'.$i, $item->name);
					$this->excel->getActiveSheet()->setCellValue('C'.$i, $item->email);
					$this->excel->getActiveSheet()->setCellValue('D'.$i, date("d/m/Y H:i:s", $item->created));
					$this->excel->getActiveSheet()->setCellValue('E'.$i, $item->content);
				}
				$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
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
			$filename=date("d_m_Y").'_contact_export.xls'; //save our workbook as this file name
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
		if(isset($_POST['delButton'])) {
			$id = $this->input->post('id');
			for($i = 0; $i < count($id); $i++)
				$this->model->delRecord($this->contact, array('id' => $id[$i]));
		} else {
			$id = $this->uri->segment(4);
			$this->model->delRecord($this->contact, array('id' => $id));
		}
		$this->session->set_flashdata('success', 1);
		header('location:'.PATH_URL.'acp/contact');
	}

	public function searchContent() {
		if($_POST){
			$keywords = $this->input->post('keywords');
			$category = $this->input->post("category");
			if(!empty($category)) {
				$result = $this->model->getListContent($this->contact, array("category_id" => $category), "order_by asc", null, null);
			} else {
				$result = $this->model->search($this->contact,$keywords);
			}
			$data = array(
				'result' => $result
			);
			$this->template->write_view('content','BACKEND/contact/content', $data);
			$this->template->render();
		}
	}
}
