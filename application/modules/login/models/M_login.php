<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function check_login($username)
	{
		$file_path="database/users.json";
		$myfile = fopen($file_path, "r") or die("Unable to open file!");
		$data_file=json_decode(fread($myfile,filesize($file_path)));
		// echo "1234";
		// echo "<pre>";
		// print_r($data_file);
		// die();
		//print_r(json_decode($data_file));
		//print_r(json_decode($data_file["data"]));
      //die();
		
		if(count($data_file->data) !=0)
		{
			foreach($data_file->data as $key=>$value){
				if($username==$value->username){
					return $value;
				}
			}
		}
		else
		{
			return false;
		}
	}

	public function checkPriv($menu, $user_group_id)
	{
		return $this->db->query("select * from t_mtr_privilege a
		join t_mtr_menu b on a.menu_id=b.id_seq and upper(b.name)=upper('".$menu."') and b.status=1
		join t_mtr_user_group c on a.user_group_id=c.id_seq and c.id_seq=$user_group_id
		where a.status=1");
	}

}

/* End of file m_login.php */
/* Location: ./application/models/m_login.php */