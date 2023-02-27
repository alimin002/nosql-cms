<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('bcrypt');
    $this->load->model('m_login');
    $this->load->library('log_activitytxt');
 
  }

  public function index()
  {
    
 
    //print_r($this->session->all_userdata());
    
    if ($this->session->userdata('is_logged_in') == 1)
    {
      //check apakah user mempunyai hak akses ke dashbord
      redirect('dashboard','refresh');
    }

    $data['title'] = "Login";
    $this->load->view('index',$data);
                
  }

  public function captcha()
  {
    $this->load->view('captcha_v2');
  }

  public function do_login()
  {
    $this->load->library('session');

    $this->form_validation->set_rules('username','username','required');
    $this->form_validation->set_rules('password','password','required');
    //$this->form_validation->set_rules('captcha','Captcha','required');
    if($this->form_validation->run() == false){
      if ($this->form_validation->run('username') == false) {
        echo json_encode(array(
          'code' => 100, 
          'header' => 'Error!',
          'theme' => 'alert-styled-left bg-danger',
          'message' => 'Please input the field!'
        ));
      }
    }else{
      $username= $this->input->post('username');
        // $password= $this->db->escape_like_str(strtoupper(md5($this->input->post('password'))));
        $password=$this->input->post('password');
        // $this->load->model('m_login');
        $check = $this->m_login->check_login($username);
 
        if($check){
          if($check->username==$username && $check->password==$password){
            $data = array(
              'username' => $check->username,
              'user_id' => encode($check->id_seq),
              'is_logged_in'=>1,
              'full_name'=>$check->first_name. ' '.$check->last_name,
            );
            $this->session->set_userdata($data);

            echo $res=json_encode(array(
              'code' => 0, 
              'message' => 'Success',
              'data' => site_url('dashboard')
            ));
 
          }
          else
          {
            echo $res=json_encode(array(
              'code' => 101, 
              'header' => 'Error!',
              'message' => 'Wrong password',
              'theme' => 'alert-styled-left bg-danger'
            ));
          }
        }else{
          echo $res=json_encode(array(
            'code' => 101, 
            'header' => 'Error!',
            'message' => "User can't found",
            'theme' => 'alert-styled-left bg-danger',
          ));
        }     
            

            }
  
    
        
  }

  public function logout()
  {
    
    $this->session->sess_destroy();
  
    redirect('login','refresh');
  }
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */