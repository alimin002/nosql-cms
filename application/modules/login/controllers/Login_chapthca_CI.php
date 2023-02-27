<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('bcrypt');
		$this->load->model('m_login');
		$this->load->library('log_activitytxt');
		$this->load->helper(['captcha']);
	}

	public function index()
	{
                //die();
		if ($this->session->userdata('is_logged_in') == 1)
		{
			//check apakah user mempunyai hak akses ke dashbord
			$user_group_id=$this->session->userdata('user_group_id');
			$checkPriv=$this->m_login->checkPriv('Dashboard',$user_group_id)->num_rows();

			if($checkPriv>0)
			{
				redirect('dashboard','refresh');
			}
			else
			{
				$checkPrivDashPo=$this->m_login->checkPriv('Dashboard PO',$user_group_id)->num_rows();
				if($checkPrivDashPo>0)
				{
					redirect('dashboard/po','refresh');
				}
				else
				{
					redirect('profile','refresh');	
				}
			}
		}
		/*  CAPTCHA  STARTS */
		if(!is_dir('./assets/captch_img/'))
		{
			mkdir('./assets/captch_img/','0777',true);
		}

		$config = array(
           'img_url'		=> base_url() . 'assets/captch_img/',
           'img_path'		=> 'assets/captch_img/',
           'img_height'		=> 45,
           'word_length'	=> 5,
           'img_width' 		=> '200',
           'font_size' 		=> 10
            );

        $captcha_new  = create_captcha($config);
        unset($_SESSION['captcha']);
        $captcha_word = $captcha_new['word'];
        $this->session->set_userdata('captcha', $captcha_word);
        $data['captchaImage'] = $captcha_new['image'];
		/* CAPTCHA ENDS */

		$data['title'] = "Login";
		$this->load->view('index',$data);
                
	}

	public function do_login()
	{

		$this->form_validation->set_rules('username','username','required');
		$this->form_validation->set_rules('password','password','required');
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
			$captcha         = $this->input->post('captcha');
			$captcha_session = $this->session->userdata('captcha');
			if ($captcha == $captcha_session) 
			{
				// $username= $this->db->escape_like_str($this->input->post('username'));
				$username= $this->input->post('username');
				// $password= $this->db->escape_like_str(strtoupper(md5($this->input->post('password'))));
				$password= strtoupper(md5($this->input->post('password')));
				// $this->load->model('m_login');
				$check = $this->m_login->check_login($username);
				if($check){
					if($this->bcrypt->compare($password,$check->password)){
						$data = array(
							'user_group_id' => $check->user_group_id,
							'username' => $check->username,
							'user_id' => encode($check->id_seq),
							'group_name' => $check->group_name,
							'group_code' => $check->group_code,
							'user_code' => $check->user_code,
							'is_logged_in'=>1,
							'full_name'=>$check->first_name. ' '.$check->last_name,
						);
						$this->session->set_userdata($data);

						$checkPriv=$this->m_login->checkPriv('Dashboard',$check->user_group_id)->num_rows();

						if($checkPriv>0)
						{
							echo $res=json_encode(array(
								'code' => 0, 
								'message' => 'Success',
								'data' => site_url('dashboard')
							));
						}
						else
						{
							$checkPrivDashPo=$this->m_login->checkPriv('Dashboard PO',$check->user_group_id)->num_rows();
							if($checkPrivDashPo>0)
							{
								echo $res=json_encode(array(
									'code' => 0, 
									'message' => 'Success',
									'data' => site_url('dashboard/po')
								));	
							}
							else {
								echo $res=json_encode(array(
									'code' => 0, 
									'message' => 'Success',
									'data' => site_url('profile')
								));
							}	
						}
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
            else
            {
            	echo json_encode(array(
					'code' => 100, 
					'header' => 'Error!',
					'theme' => 'alert-styled-left bg-danger',
					'message' => 'Chaptcha Wrong'
				));
            }
            	var_dump($captcha);
            	var_dump($captcha_session);
		}

		/* Fungsi Create Log */
        // $createdBy   = $username;
        // $logUrl      = site_url().'login/login';
        // $logMethod   = 'login';
        // $logParam    = json_encode($check);
        // $logResponse = $res;

        // $this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
	}

	public function captcha_refresh()
        {
           $config = array(
            'img_url'     => base_url() . 'assets/captch_img/',
            'img_path'    => 'assets/captch_img/',
            'img_height'  => 45,
            'word_length' => 5,
            'img_width'   => '200',
            'font_size'   => 10
           );
        $captcha_new = create_captcha($config);
        unset($_SESSION['captcha']);
        $captcha_word = $captcha_new['word'];
        $this->session->set_userdata('captcha', $captcha_word);
        echo $captcha_new['image'];
    }

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login','refresh');
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */