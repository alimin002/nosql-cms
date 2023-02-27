<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_global extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getMenu($user_group_id)
	{


		$file_path="database/menu.json";
		$myfile = fopen($file_path, "r") or die("Unable to open file!");
		$data_file=json_decode(fread($myfile,filesize($file_path)));
		return $data_file;
		// $query = $this->db->query("SELECT M.id,M.parent_id,M.name,M.slug,M.icon FROM t_mtr_privilege P
		// 	JOIN t_mtr_menu M ON M.id = P.menu_id AND P.status = 1
		// 	JOIN t_mtr_menu_detail MD ON MD.menu_id = M.id
		// 	JOIN t_mtr_user U ON U.user_group_id = P.user_group_id
		// 	JOIN t_mtr_menu_action MA ON MA.id = MD.action_id AND MA.name = 'view'
		// 	WHERE U.user_group_id = $user_group_id");
		// $query = $this->db->query("SELECT DISTINCT(M.id_seq),P.menu_id,M.parent_id,M.name,M.slug,M.icon,M.menu_order FROM t_mtr_privilege P
		// 	JOIN t_mtr_menu M ON M.id_seq = P.menu_id AND P.status = 1 AND M.status = 1
		// 	JOIN t_mtr_menu_detail MD ON MD.id_seq = P.menu_detail_id AND MD.status = 1
		// 	JOIN t_mtr_user U ON U.user_group_id = P.user_group_id
		// 	JOIN t_mtr_menu_action MA ON MA.id_seq = MD.action_id AND MA.name = 'view'
		// 	WHERE U.user_group_id = $user_group_id ORDER BY M.menu_order");
		
		// $data = array();

		// foreach ($query->result() as $key => $value) {
		// 	$value->action = $this->menuAction($user_group_id,$value->id_seq);
		// 	$data[$value->parent_id][]=$value; 
		// }

		// return $data;

		// return $query->result();
	}

	public function menuAction($user_group_id,$menu_id)
	{
		$data = array();
		$query = $this->db->query("SELECT DISTINCT(MA.id_seq),M.menu_order, MA.name AS action FROM t_mtr_privilege P JOIN t_mtr_menu M ON M.id_seq = P.menu_id AND P.status = 1 AND M.status = 1 AND M.id_seq = $menu_id JOIN t_mtr_menu_detail MD ON MD.menu_id = M.id_seq AND MD.status = 1 JOIN t_mtr_user U ON U.user_group_id = P.user_group_id JOIN t_mtr_menu_action MA ON MA.id_seq = MD.action_id WHERE U.user_group_id = $user_group_id ORDER BY M.menu_order ASC");

		foreach ($query->result() as $key => $value) {
			$data[] = $value->action;
		}

		return $data;
	}

	public function menuAccess($user_group_id,$slug,$action)
	{
		// $query = $this->db->query("SELECT DISTINCT(M.id),P.menu_id,M.parent_id,M.name,M.slug,M.icon,M.order,P.status FROM t_mtr_privilege P
		// 	LEFT JOIN t_mtr_menu M ON M.id = P.menu_id AND P.status = 1 AND M.status = 1  AND M.slug = '$slug' JOIN t_mtr_menu_detail MD ON MD.menu_id = M.id AND MD.status = 1 AND P.status =1 JOIN t_mtr_user U ON U.user_group_id = P.user_group_id JOIN t_mtr_menu_action MA ON MA.id = MD.action_id AND MA.name = '$action' WHERE U.user_group_id = $user_group_id AND P.status=1 ORDER BY M.order ASC");
		$query = $this->db->query("SELECT DISTINCT
			( M.id_seq ),
			P.menu_id,
			M.parent_id,
			M.NAME,
			M.slug,
			M.icon,
			M.menu_order,
			P.status
			FROM
			t_mtr_privilege P
			JOIN t_mtr_menu_detail MD ON MD.menu_id = P.menu_id AND P.menu_detail_id = MD.id_seq
			AND MD.status = 1 
			AND P.status = 1
			JOIN t_mtr_user U ON U.user_group_id = P.user_group_id
			JOIN t_mtr_menu_action MA ON MA.id_seq = MD.action_id 
			AND MA.NAME = '$action' 
			JOIN t_mtr_menu M ON M.id_seq = P.menu_id
			AND P.status = 1 
			AND M.status = 1 
			AND M.slug = '$slug'
			WHERE
			U.user_group_id = $user_group_id 
			AND P.status = 1
			ORDER BY
			M.menu_order ASC");
		return $query->result();
	}


	function getData($table,$order)
	{
		return $this->db->query("select * from $table $order")->result();
	}

	function getDataById($json_filename,$field_search,$key)
	{
		
		$file_path="database/$json_filename";
		$myfile = fopen($file_path, "r") or die("Unable to open file!");
		$data_file=json_decode(fread($myfile,filesize($file_path)));
		$array_file=json_decode(json_encode($data_file),true);

		$key=$key;
		$value=$field_search;
		$result = $this->mysearch($array_file, $key, $value);
		return $result;
	}

	function insert($table,$data)
	{
		$this->db->trans_begin();

        $this->db->insert($table,$data);

        if($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } 
        else 
        {
            $this->db->trans_commit();
            return true;
        }
	}

	public function update($table,$data,$where)
    {
    	$this->db->trans_begin();
        $this->db->where($where);
        $this->db->update($table,$data);

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                return FALSE;
        }
        else
        {
                $this->db->trans_commit();
                return TRUE;
        }
    }

    public function deleteData($table,$where)
    {
    	$this->db->trans_begin();
    	$this->db->query("delete from $table where $where");

    	if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                return FALSE;
        }
        else
        {
                $this->db->trans_commit();
                return TRUE;
        }
    }

    public function masterDisable($table,$id,$data)
    {
    	$this->db->where('id_seq', $id);
		return $this->db->update($table, $data);
    }


    public function operator()
	{
		return $this->db->query('SELECT operator_name, operator_code FROM master."t_mtr_operator" WHERE status = 1 ORDER BY operator_name asc')->result();
	}

	public function getOperators($code)

	{
		return $this->db->query("select operator_name, operator_code from master.t_mtr_operator where perum_code = '$code' and status = 1 order by operator_name asc")->result();
	}
	
	public function getOperator($code)
	{
		return $this->db->query("select operator_name, operator_code from master.t_mtr_operator where operator_code = '$code' and status = 1")->result();
	}


	public function getPerumCode($usercode)
	{
		$query = $this->db->query("select * from master.t_mtr_user_perum where user_code = '$usercode' and status = 1");
		return $code = $query->row()->perum_code;
	}

	public function getOperatorCode($usercode)
	{
		$query = $this->db->query("select * from master.t_mtr_user_operator where user_code = '$usercode' and status = 1");               
		return $code = $query->row()->operator_code;
	}

	public function getOperatorList()
	{
		$user_code = $this->session->userdata('user_code');
		$group_code = $this->session->userdata('group_code');

		if ($group_code == "PERUM") 
		{
			$code = $this->m_global->getPerumCode($user_code);
			$operators = $this->m_global->getOperators($code);
			if (empty($operators)) {
				redirect('login/logout','refresh');
			} else {
				return $operators;
			}
		}

		else if ($group_code == 'OPERATOR')
		{
			$code = $this->m_global->getOperatorCode($user_code);
			$operators = $this->m_global->getOperator($code);
			if (empty($operators)) {
				redirect('login/logout','refresh');
			} else {
				return $operators;
			}

		}
		else
		{
			return $operators = $this->m_global->operator();
		}
	}

	public function getAuthCode()
	{	
		$user_code = $this->session->userdata('user_code');
		$group_code = $this->session->userdata('group_code');

		if ($group_code == "PERUM") 
		{
			return $code = $this->m_global->getPerumCode($user_code);	
		}

		else if ($group_code == 'OPERATOR')
		{
			return $code = $this->m_global->getOperatorCode($user_code);
		}
		else
		{
			return '';
		}
	}

	public function isDataGanda1PengujianTypeString($table_name,$column_uji,$value_uji){
        //test
        $sql="select a.$column_uji  from $table_name a where a.$column_uji='$value_uji'";
		$result=$this->db->query($sql)->result();
		if (empty($result)) {
			return 0;
		}else{
			return count($result);
		}
       

	}
	
	public function isDataGanda1PengujianTypeStringOnEdit($table_name,$column_uji,$value_uji,$id_seq){
        //test
        $sql="select a.$column_uji  from $table_name a where a.$column_uji='$value_uji' and id_seq !=$id_seq";
		$result=$this->db->query($sql)->result();
		// echo "<pre>";
		// print_r($result);
		if (empty($result)) {
			//return 0;
			return [];
		}else{
			return count($result);
		}

    }

	public function mysearch($array, $key, $value)
	{
		$results = array();

		if (is_array($array)) {
			if (isset($array[$key]) && $array[$key] == $value) {
				$results[] = $array;
			}

			foreach ($array as $subarray) {
				$results = array_merge($results, $this->mysearch($subarray, $key, $value));
			}
		}

		return $results;
	}


}

/* End of file M_global.php */
/* Location: ./application/models/M_global.php */