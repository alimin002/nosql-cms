<?php

if (!defined('BASEPATH')){
    exit('No direct script access allowed');
}
class Banner extends MX_Controller {

    public function __construct() {
        parent::__construct();
        getSession();
        $this->load->database();
        $this->load->model('M_Banner', "m_Banner");
        $this->load->model('m_global');
        $this->load->helper('global');
        $this->load->library('log_activitytxt');
    }

  

    public function index() {
        $data['title'] = "Banner";
        $data['content'] = "banner/v_banner";
        $data['menu'] = $this->m_global->getMenu($this->session->userdata('user_group_id'));
        $data['add'] = $this->m_global->menuAccess($this->session->userdata('user_group_id'), $this->uri->uri_string(), 'add');
        $this->load->view('common/page', $data); 
    }

    public function getList() {
        validateAjax(); //function definition helper/global_helper.php
        $list = $this->m_Banner->getData();
        echo json_encode($list);
    }



    public function add() {
        validateAjax(); //function definition helper/global_helper.php
        $data['title'] = "Tambah Banner";
        $data['menu'] = $this->m_global->getMenu($this->session->userdata('user_group_id'));
        $this->load->view("banner/add", $data);
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
        $config['upload_path']          = './assets/upload_image/banner';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['file_name']            = "Banner".$name;
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

        $sql="select a.*,a.id_seq as xid_seq from t_mtr_banner a 
              where a.id_seq=$id";
             
        $row=$this->db->query($sql)->row();
        
        $data['data_row_banner'] = $row;
        $data['title'] = "Edit Banner";
        $data['menu'] = $this->m_global->getMenu($this->session->userdata('user_group_id'));
        $this->load->view("banner/edit", $data);
    }

    private function _deleteImage($icon)
    {
            if (($icon != "default.png") && (!empty($icon)))
            {
                    $filename = explode(".", $icon)[0];
                    return array_map('unlink', glob(FCPATH."assets/upload_image/banner/$filename.*"));
            }
    }

    function action_edit() {
        $id = $this->input->post('id_seq');
        $nama_banner = trim($this->input->post('nama_banner'));             
        $deskripsi=$this->input->post('deskripsi');
      
        $kode_banner = trim($this->input->post('kode_banner'));
        $stok = trim($this->input->post('stok'));

                      
        $del_icon = $this->db->query("select a.image_url from t_mtr_banner a where a.id_seq=$id")->row()->image_url;        
        if (!empty($_FILES["icon"]["name"])) {                
                $this->_deleteImage($del_icon);
                $image_name = $id;
                $icon = $this->_uploadImage($image_name);
                $update_icon=base_url('assets/upload_image/banner/'.$icon);
        } else {
                $icon = $this->input->post('old_icon');
                $update_icon=$icon;               
        }
        
       
        $this->validate_image();


        
        $data_banner = array(
            "nama_banner" =>$nama_banner,
            "deskripsi" =>$deskripsi,                
            "image_url" =>$update_icon,
            "status"      => 1,
            "updated_by" => $this->session->userdata('username'),
            "updated_on" => date('Y-m-d H:i:s'),
        );

        $this->form_validation->set_rules('nama_banner', 'Name', 'required'); //function definition sytem/libraries/form_validation.php
        
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required'); 
        if (!$this->form_validation->run()) {
            echo $rest = $this->msg_error('Please input the field!!<br>'. validation_errors());
        } else {
            $table_name='t_mtr_banner';
            $column_uji='nama_banner';
            $value_uji=$nama_banner;
            $id_seq=$id;

            if(count($this->m_global->isDataGanda1PengujianTypeStringOnEdit($table_name,$column_uji,$value_uji,$id_seq))==0){
               

                $update=$this->db->update('t_mtr_banner', $data_banner,"id_seq=$id_seq"); 
              
                if ($update) {
                    echo $rest = $this->msg_success('sukses update data');
                }else{
                   
                    echo $rest = $this->msg_success('gagal update data');
                }     

            }else{
                echo $rest = $this->msg_error('Data gagal update, Data sudah ada');
            }
        }
    }

    function action_add() {
        $nama_banner = trim($this->input->post('nama_banner'));       
        $deskripsi = trim($this->input->post('deskripsi')); 
        $image_url = trim($this->input->post('image_url'));
        $kode_banner= generateCode(6);
        $kode_banner=$kode_banner;
        if (!empty($_FILES["icon"]["name"])) { 
                $image_name = $kode_banner;
                $icon = $this->_uploadImage($image_name);
        }else{
            $icon = "default.png";
        }

       
        

        $data_banner=array(
            "nama_banner"=>$nama_banner,
            "kode_banner"=>$kode_banner,          
            "deskripsi" => $deskripsi,       
            "image_url"=>base_url('assets/upload_image/banner/'.$icon),
            "status"=>1,
            "created_by"=>$this->session->userdata('username'),
            "created_on"=>date('Y-m-d H:i:s'),
        );

        $this->form_validation->set_rules('nama_banner', 'Name', 'required'); //function definition sytem/libraries/form_validation.php
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
       
        if (!$this->form_validation->run()) {
            echo $rest = $this->msg_error('Please input the field!!<br>'. validation_errors());
        } else {
           
            $table_name='t_mtr_banner';
            $column_uji='nama_banner';
            $value_uji=$nama_banner;

            if($this->m_global->isDataGanda1PengujianTypeString($table_name,$column_uji,$value_uji)==0){              
                $insert= $this->db->insert('t_mtr_banner', $data_banner); 
                if ($insert) {
                    echo $rest = $this->msg_success('sukses menambah data');
                }else{
                   
                    echo $rest = $this->msg_error('gagal menambah data');
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

        $delete = $this->db->delete("t_mtr_banner","id_seq=$id");
        if ($delete) {
            echo $rest = $this->msg_success('Success delete data');
        } else {
            echo $rest = $this->msg_error('Failed delete data');
        }

        /* Fungsi Create Log */
        $createdBy = $this->session->userdata('username');
        $logUrl = site_url() . 'banner/delete';
        $logMethod = 'DELETE';
        $logParam = json_encode($data);
        $logResponse = $rest;

        $this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
    }
    
    function disable_user($kode_banner){
        $id = decode($kode_banner);
        $data = array(            
            "status"      => 0,
            "updated_by" => $this->session->userdata('username'),
            "updated_on" => date('Y-m-d H:i:s'),
        );

        
        $update = $this->m_global->update('t_mtr_banner', $data, "kode_banner=$id");
        if ($update) {
            echo $rest = $this->msg_success('Success edit data');
        } else {
            echo $rest = $this->msg_error('failed edit data');
        }

    }
    
    function enable_user($kode_banner){
        $id = decode($kode_banner);
        $data = array(            
            "status"      => 1,
            "updated_by" => $this->session->userdata('username'),
            "updated_on" => date('Y-m-d H:i:s'),
        );

        
        $update = $this->m_global->update('t_mtr_banner', $data, "kode_banner=$id");
        if ($update) {
            echo $rest = $this->msg_success('Success edit data');
        } else {
            echo $rest = $this->msg_error('failed edit data');
        }
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

}

/* End of file Gate_in.php */
/* Location: ./application/controllers/Gate_in.php */