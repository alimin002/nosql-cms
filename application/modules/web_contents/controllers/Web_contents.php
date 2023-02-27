<?php

if (!defined('BASEPATH')){
    exit('No direct script access allowed');
}
class Web_contents extends MX_Controller {

    public function __construct() {
        parent::__construct();
        getSession();
        $this->load->database();
        $this->load->model('M_web_contents', "m_web_contents");
        $this->load->model('m_global');
        $this->load->helper('global');
        $this->load->library('log_activitytxt');
    }

  

    public function index() {
        $data['title'] = "Kontent Web";
        $data['content'] = "web_contents/v_web_contents";
        $data['menu'] = $this->m_global->getMenu($this->session->userdata('user_group_id'));
        $data['add'] = $this->m_global->menuAccess($this->session->userdata('user_group_id'), $this->uri->uri_string(), 'add');
        $this->load->view('common/page', $data); 
    }

    public function getList() {
        validateAjax(); //function definition helper/global_helper.php
        $list = $this->m_web_contents->getData();
        echo json_encode($list);
    }



    public function add() {
        validateAjax(); //function definition helper/global_helper.php
        $data['title'] = "Tambah Web Konten";
        $data['menu'] = $this->m_global->getMenu($this->session->userdata('user_group_id'));
        $this->load->view("web_contents/add", $data);
    }

    public function validate_image() {
    $check = TRUE;
    $error = "";
    if ((!isset($_FILES['icon'])) || $_FILES['icon']['size'] == 0) {
        $error = 'The icon field is required';
        $check = TRUE;
    }
    else if (isset($_FILES['icon']) && $_FILES['icon']['size'] != 0) {
        $allowedExts = array("gif", "jpeg", "jpg", "png", "JPG", "JPEG", "GIF", "PNG");
        $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
        $extension = pathinfo($_FILES["icon"]["name"], PATHINFO_EXTENSION);
        $detectedType = exif_imagetype($_FILES['icon']['tmp_name']);           
        if (!in_array($detectedType, $allowedTypes)) {
            $error = 'Invalid Image Content!';
            $check = FALSE;
        }
        if(filesize($_FILES['icon']['tmp_name']) > 1000000) {
            $error = 'The Image file size shoud not exceed 1MB!';
            $check = FALSE;
        }
        if(!in_array($extension, $allowedExts)) {
            $error = "Invalid file extension {$extension}";
            $check = FALSE;
        }
    }
    $validate['check'] = $check;
    $validate['msg'] = $error;
    return $validate;
}

    private function _uploadImage($name)
    {
        $config['upload_path']          = './assets/upload_image/products';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['file_name']            = "Products".$name;
        $config['overwrite']            = true;
        // $config['max_size']             = 1024; 
        $config['max_size']             = 50000; 

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('icon')) {
            $data = $this->upload->data(); 
                    return $data['file_name'];

        }	    
        else {
            return 'default.png';
        }
    }
  

    function edit($id) {
        validateAjax();
       
        $id = decode($id);

        $sql="select a.*  from t_mtr_pagecontent a
              where a.id_seq=$id";
             
        $row=$this->db->query($sql)->row();
        
        $data['data_row_pagecontent'] = $row;
        $data['title'] = "Edit Konten";
        $data['menu'] = $this->m_global->getMenu($this->session->userdata('user_group_id'));
        $this->load->view("web_contents/edit", $data);
    }

    private function _deleteImage($icon)
    {
            if (($icon != "default.png") && (!empty($icon)))
            {
                    $filename = explode(".", $icon)[0];
                    return array_map('unlink', glob(FCPATH."assets/vm/img/$filename.*"));
            }
    }

    function action_edit() {
        $id = $this->input->post('id_seq');
        $page_name = trim($this->input->post('page_name'));       
        $page_content = trim($this->input->post('page_content'));
        $page_code = generateCode(12);
       
        $data_content=array(
            "page_name"=>$page_name,
            "page_content"=>$page_content,
            "status"=>1,
            "created_by"=>$this->session->userdata('username'),
            "created_on"=>date('Y-m-d H:i:s'),              
        );

       
       
        $this->form_validation->set_rules('page_name', 'Nama Konten', 'required'); //function definition sytem/libraries/form_validation.php
        $this->form_validation->set_rules('page_content', 'Konten', 'required'); //function definition sytem/libraries/form_validation.php

        if (!$this->form_validation->run()) {
            echo $rest = $this->msg_error('Please input the field!!<br>'. validation_errors());
        } else {
            $table_name='t_mtr_pagecontent';
            $column_uji='page_name';
            $value_uji=$page_name;
            $id_seq=$id;
            //echo count($this->m_global->isDataGanda1PengujianTypeStringOnEdit($table_name,$column_uji,$value_uji,$id_seq))."<br>";
            if(count($this->m_global->isDataGanda1PengujianTypeStringOnEdit($table_name,$column_uji,$value_uji,$id_seq))==0){
               

                $insert=$this->db->update('t_mtr_pagecontent', $data_content,"id_seq=$id_seq"); 
               
                //echo $this->db->qu

                if ($insert) {
                    echo $rest = $this->msg_success('Edit data Sukses');
                }else{
                    
                    echo $rest = $this->msg_error('Data gagal diedit, harap coba lagi beberapa saat lagi');
                }     

            }else{
                echo $rest = $this->msg_error('Data gagal edit nama konten sudah ada');
            }
        }
    }

    function action_add() {
       
        $page_name = trim($this->input->post('page_name'));       
        $page_content = trim($this->input->post('page_content'));
        $page_code = generateCode(12);
       
        $data_content=array(
            "page_code"=>$page_code,
            "page_name"=>$page_name,
            "page_content"=>$page_content,
            "status"=>1,
            "created_by"=>$this->session->userdata('username'),
            "created_on"=>date('Y-m-d H:i:s'),              
        );

       
       
        $this->form_validation->set_rules('page_name', 'Nama Konten', 'required'); //function definition sytem/libraries/form_validation.php
        $this->form_validation->set_rules('page_content', 'Konten', 'required'); //function definition sytem/libraries/form_validation.php
       

        if (!$this->form_validation->run()) {
            echo $rest = $this->msg_error('Please input the field!!<br>'. validation_errors());
        } else {
           
            $table_name='t_mtr_pagecontent';
            $column_uji='page_name';
            $value_uji=$page_name;

            if($this->m_global->isDataGanda1PengujianTypeString($table_name,$column_uji,$value_uji)==0){
              
                $insert = $this->db->insert('t_mtr_pagecontent', $data_content); 
                if($insert){
                    echo $rest = $this->msg_success('Berhasil di tambahkan');
                }else{
                    echo $rest = $this->msg_err('gagal di tambahkan harap ulangi lagi bberapa saat, atau hubungi tim teknis untuk perbaikan');
                }

                
            }else{
                echo $rest = $this->msg_success('gagal menambah data kendaraan sudah ada');
            }
        }
    }

    public function delete($id) {
        validateAjax();
        $id = decode($id);
        //echo $id; die();
        $data = array(
            'status' => -5,
            'updated_by' => $this->session->userdata('username'),
            'updated_on' => date('Y-m-d H:i:s'),
        );

        $delete = $this->db->delete("t_mtr_pagecontent","id_seq=$id");
        if ($delete) {
            echo $rest = $this->msg_success('Success delete data');
        } else {
            echo $rest = $this->msg_error('Failed delete data');
        }

        /* Fungsi Create Log */
        $createdBy = $this->session->userdata('username');
        $logUrl = site_url() . 'web_contents/delete';
        $logMethod = 'DELETE';
        $logParam = json_encode($data);
        $logResponse = $rest;

        $this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
    }
    


    function msg_error($message) {
        return json_encode(array(
            'code' => 101,
            'header' => 'Error',
            'message' => $message,
            'theme' => 'alert-styled-left bg-danger'));
    }

    function msg_success($message) {
        return json_encode(array(
            'code' => 200,
            'header' => 'Success',
            'message' => $message,
            'theme' => 'alert-styled-left bg-success'));
    }

    public function upload_ckeditor(){
		
		$config['upload_path'] = './assets/ckupload';
		$config['encrypt_name'] = TRUE;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';

		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('upload')) {
			
			$res=$this->msg_error("Failed upload image");
		} else{
	
			$res=$this->msg_error("Success upload image");
		}

		/* Fungsi Create Log */
		$createdBy   = $this->session->userdata('full_name');
        $logUrl      = site_url().'device_monitoring/upload';
        $logMethod   = 'UPLOAD';
        $logParam    = '';
        $logResponse = $res;

        $this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);

	}

    public function file_browser(){		
            $data['fileList'] = glob('./assets/ckupload/*');
            $data['title'] = "browse image";
            $this->load->view("common/file_browser", $data);
    }

}

/* End of file Gate_in.php */
/* Location: ./application/controllers/Gate_in.php */