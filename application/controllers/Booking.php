<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {
	private $user = "user";
	private $booking = "booking";
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
			$this->template->write_view('left','BACKEND/left', array('active' => 'booking'));
		}
	}

	public function admincp() {
		$data = array(
			'result' => $this->model->getListContent($this->booking, null, 'created desc')
		);
		$this->template->write_view('content','BACKEND/booking/content', $data);
		$this->template->render();
	}

	public function addContent() {
		$id = $this->uri->segment(4);
		$result = $this->model->getContent($this->booking, array('id' => $id));
		$data = array(
			'result' => $result
		);
		$this->template->write_view('content','BACKEND/booking/edit',$data);
		$this->template->render();
	}

	public function saveContent() {
		if($_POST) {
			$data = array(
				'status' => $this->input->post('status')?1:0
			);
			if($this->model->saveContent($this->booking,$data)){
				$this->session->set_flashdata('success', 1);
				header('location:'.PATH_URL.'acp/booking');
			}
		}
	}
	public function delete() {
		if(isset($_POST['exportXls'])) {
			$result = $this->model->getListContent($this->booking);
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle('booking Export');
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
			$filename=date("d_m_Y").'_booking_export.xls'; //save our workbook as this file name
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
				$this->model->delRecord($this->booking, array('id' => $id[$i]));
		} else {
			$id = $this->uri->segment(4);
			$this->model->delRecord($this->booking, array('id' => $id));
		}
		$this->session->set_flashdata('success', 1);
		header('location:'.PATH_URL.'acp/booking');
	}

	public function searchContent() {
		if($_POST){
			$keywords = $this->input->post('keywords');
			$category = $this->input->post("category");
			if(!empty($category)) {
				$result = $this->model->getListContent($this->booking, array("category_id" => $category), "order_by asc", null, null);
			} else {
				$result = $this->model->search($this->booking,$keywords);
			}
			$data = array(
				'result' => $result
			);
			$this->template->write_view('content','BACKEND/booking/content', $data);
			$this->template->render();
		}
	}
}
