<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_users extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	

	public function getData()
	{
		$data = array();
		// $search = trim(strtoupper($this->db->escape_like_str($this->input->post('search'))));
		$search=trim($this->input->post('search'));
		
		
		$page = $this->input->post('page') ? $this->input->post('page') : 1;
		$rows = $this->input->post('rows') ? $this->input->post('rows') : 10;
		$offset = ($page - 1) * $rows;
		$sort 		= $this->input->post('sort') ? $this->input->post('sort') : 'b.id_seq';
		$order 		= $this->input->post('order') ? $this->input->post('order') : 'asc';

		// jika ada penambahan user group selain user cms maka kondisi di sini di tambahkan
		$file_path="database/users.json";
		$myfile = fopen($file_path, "r") or die("Unable to open file!");
		$data_file=json_decode(fread($myfile,filesize($file_path)));
		
		$array_data=json_decode(json_encode($data_file->data),true);
        // echo "<pre>";
		// print_r($array_data);
		// die();
		if (!empty($search)) {
			$data_terfilter=$this->mysearch($array_data,"username",$search);
			$array_data=$data_terfilter;
        }

		$data_rows = array();
	    foreach ($array_data as $r) {
			// print_r((array)$r);
			// die();
	    	// $edit = $this->m_global->menuAccess($this->session->userdata('user_group_id'),'po/bus','edit');
	    	// $delete = $this->m_global->menuAccess($this->session->userdata('user_group_id'),'po/bus','delete');
	    	$action = '';

	    	// if($edit){
	    		$action .= '<button onClick="edit(\''.(encode($r['id_seq'])).'\')" class="updated btn bg-nutech btn-icon btn-xs btn-dtgrid" title="Edit">Edit</button> ';
	    	// }

	    	// if($delete){
	    		$action .= '<button onClick="deleteData(\''.(encode($r['id_seq'])).'\')" class="updated btn btn-danger btn-icon btn-xs btn-dtgrid" title="Delete">Delete</button>';
	    	// };
	    	// $r['action']=(array)$action;
			$r["action"]=$action;
			// echo "<pre>";
			// print_r($r);
			// die();
	    	$data_rows[] =$r;
			// die();
	    }

	    $data['total'] = count($data_file->data);
		$data['rows'] = $data_rows;
		return $data;
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


	public function select($table,$order)
	{
		$this->db->query("select * from ".$table." order by ".$order);
	}

}

/* End of file M_gatein.php */
/* Location: ./application/models/M_gatein.php */