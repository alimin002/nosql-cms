<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MX_Controller {

	public function __construct()
	{
		// echo 123; die();
		parent::__construct();
		getSession();
		$this->load->model('M_products','m_products');
		// $this->load->model('m_global');
		$this->load->library('log_activitytxt');
	}

	public function index()
	{
		// echo 1234; 
		// die(0);
		$data['title'] = "Produk";
		$data['content'] = "index";
		$data['menu'] = $data['menu'] = $this->m_global->getMenu(1);
		// $data['add'] = $this->m_global->menuAccess($this->session->userdata('user_group_id'),$this->uri->uri_string(),'add');

		$this->load->view('common/page',$data);
	}

	public function getList()
	{
		validateAjax();
		$list = $this->m_products->getData();
		echo json_encode($list);
	}

	public function add()
	{
		validateAjax();
		$data['title'] = "Tambah Produk";
		$data['menu'] = $this->m_global->getMenu(1);
		$this->load->view("products/add",$data);
	}

	public function action_add()
	{
		
		$username=trim($this->input->post('username'));
		$password=trim($this->input->post('password'));
		$first_name=trim($this->input->post('first_name'));
		$last_name=trim($this->input->post('last_name'));
		
		$data=array(

		);

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');

		$json_filename="users.json";
		$field_search=$username;
		$key="username";
		$check_users=$this->m_global->getDataById($json_filename,$field_search,$key);
		// echo "<pre>";
		// print_r($check_users);
		// die();
		if (count($check_users)>0)
		{
			echo $rest=$this->msg_error('Username already exist');
		}

		else if ($this->form_validation->run() == FALSE)
        {
            echo $rest=$this->msg_error('Please input the field!');
        }

        else
        {

			$file_path="database/$json_filename";
			$myfile = fopen($file_path, "r") or die("Unable to open file!");
			$data_file=json_decode(fread($myfile,filesize($file_path)));
			$id_seq =$data_file->data[count($data_file->data)-1]->id_seq;
			// echo $id_seq;
			// die();
			$next_id_seq=$id_seq;
			$next_id_seq = $next_id_seq +1;
			// echo $next_id_seq;
			// die();
			fclose($myfile);
			// echo "<pre>";
			$data_baru=[];
			
			$data_baru=$data_file->data;
			
			array_push($data_baru,(object)[
				"id_seq"=>$next_id_seq,
				"username"=>$username,
													  "password"=>$password,
													  "first_name"=>$first_name,
													  "last_name"=>$last_name
								]);
								
								$json_data_baru=json_encode(["data"=>$data_baru]);
								// echo $json_data_baru;
								// die();
								$myfile = fopen($file_path, "w") or die("Unable to open file!");
								//$txt = "John Doe\n";
								fwrite($myfile,$json_data_baru);
								
								fclose($myfile);
								echo $rest=$this->msg_success('Success add data');
								// die();

	    //    $insert=$this->m_global->insert("master.t_mtr_bus",$data);

			// if ($insert)
			// {
			// 	echo $rest=$this->msg_success('Success add data');
			// }
			// else
			// {
			// 	 echo $rest=$this->msg_error('Failed add data');
			// }
        }

        /* Fungsi Create Log */
        $createdBy   = $this->session->userdata('full_name');
        $logUrl      = site_url().'po/bus/action_add';
        $logMethod   = 'ADD';
        $logParam    = json_encode($data);
        $logResponse = $rest;

        $this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
	}

	function edit($id)
	{
		validateAjax();
		$id = decode($id);
		$json_filename="users.json";
		$field_search=$id;
		$key="id_seq";
		$data["users"]=$this->m_global->getDataById($json_filename,$field_search,$key);
		// echo "<pre>";
		// print_r($data);
		// die();
		// $data['po']=$this->m_global->getData("master.t_mtr_po","where status=1 order by po_name asc");
		// $data['type']=$this->m_global->getData("master.t_mtr_bus_type","where status=1 order by type asc");
		// $data['bus']=$this->m_global->getDataById("master.t_mtr_bus","id_seq=$id")->row();
		$data['title'] = "Edit Users";
		$data['menu'] = $this->m_global->getMenu($this->session->userdata('user_group_id'));
		$this->load->view("products/edit",$data);

	}
	function action_edit()
	{
		$id_seq=trim($this->input->post('id_seq'));
		$username=trim($this->input->post('username'));
		$password=trim($this->input->post('password'));
		$first_name=trim($this->input->post('first_name'));
		$last_name=trim($this->input->post('last_name'));
		
		$data=array(

		);

		$this->form_validation->set_rules('username', 'Username', 'required');
		// $this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');

		$json_filename="users.json";
		$field_search=$id_seq;
		// $old_id_seq=
		$key="id_seq";
		$check_users=$this->m_global->getDataById($json_filename,$field_search,$key);


		$file_pathx="database/users.json";
		$myfilex = fopen($file_pathx, "r") or die("Unable to open file!");
		$data_filex=json_decode(fread($myfilex,filesize($file_pathx)));
		
		$array_datax=json_decode(json_encode($data_filex->data),true);
		// echo "<pre>";
		// print_r(json_decode(json_encode($data_filex->data)),true);
		// print_r($array_datax);
		// echo "<br>";
		// print_r((object)$check_users);
        //  echo "Index:";
		// echo array_search((object)$check_users,$array_datax);
		$i=0;
		foreach($array_datax as $key =>$values){


			if($values==$check_users[0]){
				
				
				unset($array_datax[$i]);
			
			}
			$i++;
		}
		
		// reindex element array
		$array_datax=array_values($array_datax);
		$json_filename="users.json";
		$field_search=$username;
		// $key="username";
		$check_username=$this->m_global->getDataById($json_filename,$field_search,$key);
		// echo "Username<br>";
		// echo "db".$check_username[0]['username']."param :".$username."<br>";

		// echo "Id seq<br>";
		// echo "db".$check_users[0]['id_seq']."param :".$id_seq."<br>";
		
		if ($this->form_validation->run() == FALSE) {
            echo $rest=$this->msg_error('Please input the field!');
        }else{
			$file_path="database/$json_filename";
			
			$data_baru=[];
			
			// echo "<pre>";
			$data_baru=$array_datax;
			
			array_push($data_baru,(object)[
				"id_seq"=>$id_seq,
				"username"=>$username,
													  "password"=>$password,
													  "first_name"=>$first_name,
													  "last_name"=>$last_name
								]);
								// echo "<br>";
								// print_r(array_column($data_baru,'username'));
								
								// echo "count:"; 
								$data_unique=array_unique(array_column($data_baru,'username'));
								// print_r($data_unique);
								// echo count(array_column($data_baru,'username'));
								// die();
								//memastikan tidak ada duplikat username
								if(count(array_column($data_baru,'username'))==count($data_unique)){
									$json_data_baru=json_encode(["data"=>$data_baru]);
								
									$myfile = fopen($file_path, "w") or die("Unable to open file!");
									
									fwrite($myfile,$json_data_baru);
									
									fclose($myfile);
									echo $rest=$this->msg_success('Success Update data');

								}else{
									echo $rest=$this->msg_error('Failed Update data, Username Sudah ada yg menggunakan');
								}
								
								
		}

       		
	}
	
	public function delete($id)
	{
		validateAjax();
		$id = decode($id);

		$id_seq=$id;
		
		
		$data=array(

		);

		

		$json_filename="users.json";
		$field_search=$id_seq;
		// $old_id_seq=
		$key="id_seq";
		$check_users=$this->m_global->getDataById($json_filename,$field_search,$key);


		$file_pathx="database/users.json";
		$myfilex = fopen($file_pathx, "r") or die("Unable to open file!");
		$data_filex=json_decode(fread($myfilex,filesize($file_pathx)));
		
		$array_datax=json_decode(json_encode($data_filex->data),true);
		// echo "<pre>";
		// print_r(json_decode(json_encode($data_filex->data)),true);
		// print_r($array_datax);
		// echo "<br>";
		// print_r($check_users[0]);
		// die();
        //  echo "Index:";
		// echo array_search((object)$check_users,$array_datax);
		$i=0;
		foreach($array_datax as $key =>$values){


			if($values==$check_users[0]){
				
				
				unset($array_datax[$i]);
			
			}
			$i++;
		}
		
		// reindex element array
		$array_datax=array_values($array_datax);
		// $json_filename="users.json";
		// $field_search=$username;
		// $key="username";
		$file_path="database/$json_filename";
			
			$data_baru=[];
			
			// echo "<pre>";
			$data_baru=$array_datax;
			
		
								$data_unique=array_unique(array_column($data_baru,'username'));
								
								$json_data_baru=json_encode(["data"=>$data_baru]);
								
								$myfile = fopen($file_path, "w") or die("Unable to open file!");
								
								fwrite($myfile,$json_data_baru);
								
								fclose($myfile);
								echo $rest=$this->msg_success('Success Delete data');				
	}

	function msg_error($message)
	{
			return	json_encode(array(
				'code' => 101, 
				'header' => 'Error',
				'message' => $message,
				'theme' => 'alert-styled-left bg-danger'));
	}

	function msg_success($message)
	{
			return	json_encode(array(
				'code' => 200, 
				'header' => 'Success',
				'message' => $message,
				'theme' => 'alert-styled-left bg-success'));
	}

	

}

/* End of file Gate_in.php */
/* Location: ./application/controllers/Gate_in.php */