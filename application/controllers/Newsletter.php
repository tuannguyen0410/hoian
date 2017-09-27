<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends CI_Controller {
	private $user = "user";
	private $newsletter = "newsletter";
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
				'active' => "newsletter"
			);
			$this->template->write_view('left','BACKEND/left', $left);
		}
	}

	public function index() {
		if($this->session->userdata('home_lang') == '_en'){
			$content = "
				<p style='margin-bottom: 20px; font-weight: bold;'>Dear Guest,</p>
				<p>Thank you very much for your registration!</p>
				<p>You are now subscribed and shall receive our regular newsletter and promotion alerts to the email address you provided.</p>
				<p style='font-weight: bold; margin-top: 20px;'>Best regards, <br>CarePlus</p>
				<p style='font-weight: bold;'></p>
			";
		} else {
			$content = "
				<p style='margin-bottom: 20px; font-weight: bold;'>Kính gửi Quý khách,</p>
				<p>Quý khách đã đăng ký thành công!</p>
				<p>Chúng tôi sẽ gửi các thông báo mới nhất và các chương trình ưu đãi đặc biệt tới email của Quý khách. </p>
				<p style='font-weight: bold; margin-top: 20px;'>Trân trọng cảm ơn,<br>CarePlus</p>
			";
		}
		$result = $this->model->getContent($this->newsletter, array('email' => $this->input->post('email')));
		if(!empty($_POST)) { 
			$email = $this->input->post('email');
			$this->load->library('My_email');
			$mail = new PHPMailer(true);
			$mail->IsSMTP();
			$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->Host       = "smtp.emailcyber.com"; // sets the SMTP server
			$mail->Port       = 2525;                    // set the SMTP port for the GMAIL server
			$mail->Username   = "29d6ce18-812b-40af-b02e-a8e67f9a650a"; // SMTP account username
			$mail->Password   = "29d6ce18-812b-40af-b02e-a8e67f9a650a";        // SMTP account password
			$mail->AddAddress("$email", 'Careplus newsletter reply');
			$mail->SetFrom('no-reply@create.vn', 'Careplus newsletter reply');
			$mail->Subject = 'Careplus newsletter reply';
			$mail->MsgHTML($content);
			if($mail->Send()){
				if(empty($result)) {
					$data = array(
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'created' => time(),
						'status' => 0
					);
					if($this->db->insert($this->newsletter, $data)) {
						$this->session->set_flashdata('success','Thank you for subscribe!');
						header('location:'.$_SERVER['HTTP_REFERER']);
					}
				} else {
					$this->session->set_flashdata('success',"$email has been subscribe!");
					header('location:'.$_SERVER['HTTP_REFERER']);
				}
				
			}
		}
	}

	public function admincp() {
		$data = array(
			'result' => $this->model->getListContent($this->newsletter, null, 'created desc')
		);
		$this->template->write_view('content','BACKEND/newsletter/content', $data);
		$this->template->render();
	}

	public function addContent() {
		$id = $this->uri->segment(4);
		if($id == null) {
			$result = null;
		} else {
			$result = $this->model->getContent($this->newsletter, array('id' => $id));
		}
		$data = array(
			'result' => $result
		);
		$this->template->write_view('content','BACKEND/newsletter/edit',$data);
		$this->template->render();
	}

	public function saveContent() {
		if($_POST) {
			$id = $this->input->post('id');
			$order_by = 0;
			$data = array(
				'name' => $this->input->post('txtName'),
				'order_by' => $order_by,
				'category_id' => $this->input->post('category'),
				'type' => 'article',
				'featured' => $this->input->post('featured')?1:0,
				'homepage' => $this->input->post('home')?1:0,
				'status' => $this->input->post('status')?1:0,
				'content' => $this->input->post('content'),
				'shortcontent' => $this->input->post('shortcontent'),
				'links' => $this->input->post('links'),
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'keywords' => $this->input->post('keywords')
			);
			if($this->model->saveContent($this->newsletter,$data)){
				$this->session->set_flashdata('success', 1);
				header('location:'.PATH_URL.'acp/newsletter');
			}
		}
	}
	public function delete() {
		if(isset($_POST['exportXls'])) {
			$result = $this->model->getListContent($this->newsletter);
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle('Newsletter Export');
			//set cell A1 content with some text
			if(!empty($result)) {
				$this->excel->getActiveSheet()->setCellValue('A1', '#');
				$this->excel->getActiveSheet()->setCellValue('B1', 'Name');
				$this->excel->getActiveSheet()->setCellValue('C1', 'Email');
				$this->excel->getActiveSheet()->setCellValue('D1', 'Created');
				$i = 1;
				foreach ($result as $items => $item) {
					$i++;
					$this->excel->getActiveSheet()->setCellValue('A'.$i, $i-1);
					$this->excel->getActiveSheet()->setCellValue('B'.$i, $item->name);
					$this->excel->getActiveSheet()->setCellValue('C'.$i, $item->email);
					$this->excel->getActiveSheet()->setCellValue('D'.$i, date("d/m/Y H:i:s", $item->created));
				}
				$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
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
			$filename=date("d_m_Y").'_newsletter_export.xls'; //save our workbook as this file name
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
				$this->model->delRecord($this->newsletter, array('id' => $id[$i]));
		} else {
			$id = $this->uri->segment(4);
			$this->model->delRecord($this->newsletter, array('id' => $id));
		}
		$this->session->set_flashdata('success', 1);
		header('location:'.PATH_URL.'acp/newsletter');
	}

	public function searchContent() {
		if($_POST){
			$keywords = $this->input->post('keywords');
			$category = $this->input->post("category");
			if(!empty($category)) {
				$result = $this->model->getListContent($this->newsletter, array("category_id" => $category), "order_by asc", null, null);
			} else {
				$result = $this->model->search($this->newsletter,$keywords);
			}
			$data = array(
				'result' => $result
			);
			$this->template->write_view('content','BACKEND/newsletter/content', $data);
			$this->template->render();
		}
	}
}
