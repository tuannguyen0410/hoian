<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Translate extends CI_Controller {
	private $user = "user";
	private $translate = 'translate';
	private $setting = "setting";
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
			$this->template->write_view('left','BACKEND/left', array('active' => 'translate'));
		}
	}

	public function admincp() {
        $data = array(
			'result' => $this->model->getListContent($this->translate,null, 'id desc', null, null)
		);
		$this->template->write_view('content','BACKEND/translate/content', $data);
		$this->template->render();
	}

	public function addContent() {
		$id = $this->uri->segment(4);
		if($id == null)
			$result = null;
		else
			$result = $this->model->getContent($this->translate, array('id' => $id));
		$data = array(
			'result' => $result
		);
		$this->template->write_view('content','BACKEND/translate/edit',$data);
		$this->template->render();
	}

	public function saveContent() {
       
		if(!empty($_POST)) {
            $id = $this->input->post('id');
            $value = $this->input->post('value');
            $result = $this->model->getContent($this->translate, array('value' => $value));
            if(!empty($result)) {
				$id = $result->id;
				$this->session->set_flashdata('success', 1);
				header('location:'.PATH_URL.'acp/translate/edit/'.$id);
				exit();
			}
			$data = array(
				'name' => trim(addslashes($this->input->post('txtName'))),
				'name_en' => trim(addslashes($this->input->post('txtName_en'))),
				'value' => trim($this->input->post('value'))
			);
            if($this->model->saveContent($this->translate, $data)){
				if($id == '')
					$id = $this->db->insert_id();
				$path_en = BASEFOLDER."application/language/english/en_lang.php";
				$this->write_file($path_en,'name_en');
				$path_vi = BASEFOLDER."application/language/vietnam/vi_lang.php";
				$this->write_file($path_vi,'name');
			}
            $this->session->set_flashdata('success', 1);
            header('location:'.PATH_URL.'acp/translate/edit/'.$id);
		}
	}
    
    private function write_file($path,$name){
        $this->load->helper('file');
        if(is_file($path))
            chmod($path, 0666);
        $result = $this->model->getListContent($this->translate);
        $data = "<?php"."\n";
        if(!empty($result)) {
            for($i = 0; $i < count($result); $i++) {
                $data .= "define('".$result[$i]->value."','".$result[$i]->$name."');"."\n";
            }
        }
        $data .= "?>";
        write_file($path, $data);
    }
    
	public function delete() {
		if(isset($_POST['delButton'])) {
			$id = $this->input->post('id');
			for($i = 0; $i < count($id); $i++)
				$this->model->delRecord($this->translate, array('id' => $id[$i]));
		} else {
			$id = $this->uri->segment(4);
			$this->model->delRecord($this->translate, array('id' => $id));
		}
        $path_en = BASEFOLDER."application/language/english/en_lang.php";
        $this->write_file($path_en,'name_en');
        $path_vi = BASEFOLDER."application/language/vietnam/vi_lang.php";
        $this->write_file($path_vi,'name');
		$this->session->set_flashdata('success', 1);
		header('location:'.PATH_URL.'acp/translate');
	}
    
    public function changeValue() {
		if($_POST) {
			$id = $this->input->post('id');
			$name = trim($this->input->post('name'));
			$val = trim($this->input->post('val'));
			$this->db->where('id', $id);
			if($this->db->update($this->translate, array("$name" => "$val"))) {
                $path_en = BASEFOLDER."application/language/english/en_lang.php";
                $this->write_file($path_en,'name_en');
                $path_vi = BASEFOLDER."application/language/vietnam/vi_lang.php";
                $this->write_file($path_vi,'name');
            }
			else
				echo 0;
		}
	}
}
