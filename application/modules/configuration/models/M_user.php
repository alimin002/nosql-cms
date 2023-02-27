<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function check_data($field,$value,$input='')
	{
		if ($input!= '') {
			return $this->db->query('SELECT * FROM t_mtr_user WHERE UPPER('.$field.') = UPPER(\''.$value.'\') AND status=1 AND id_seq != '.$input.'')->result();
		}else{
			return $this->db->query('SELECT * FROM t_mtr_user WHERE UPPER('.$field.') = UPPER(\''.$value.'\') AND status=1')->result();
		}
	}

	public function insert($data)
	{
		return $this->db->insert('t_mtr_user', $data);
	}

	public function get_username($id)
	{
		$qry =  $this->db->query('SELECT username FROM t_mtr_user WHERE id_seq='.$id.'')->row();
		return $qry->username;
	}

	public function update($id,$data)
	{
		$this->db->where('id_seq', $id);
		return $this->db->update('t_mtr_user', $data);
	}

	public function update_password($id,$data)
	{
		$this->db->where('id_seq', $id);
		return $this->db->update('t_mtr_user', $data);
	}

	public function delete($table,$data,$where)
	{
		$this->db->where($where);
		return $this->db->update($table, $data);
	}

	public function get_edit($id)
	{
		return $this->db->query('SELECT * FROM t_mtr_user WHERE id_seq='.$id.'')->result();
	}

	public function get()
	{
		$data = array();
		$search=$this->input->post('search');
		$user_group=decode($this->input->post('user_group'));
		$sortFrom = trim($this->input->post('sortFrom'));
		$sortTo = trim($this->input->post('sortTo'));
		$page = $this->input->post('page') ? $this->input->post('page') : 1;
		$rows = $this->input->post('rows') ? $this->input->post('rows') : 10;
		$offset = ($page - 1) * $rows;
		$sort 		= $this->input->post('sort') ? $this->input->post('sort') : 'U.username';
		$order 		= $this->input->post('order') ? $this->input->post('order') : 'ASC';

		// $where = 'WHERE U.status=1';
		$where = "WHERE U.id_seq is not null and U.status in (1,-1)";

		if(!empty($search))
		{
			$where .= "and (username ilike '%$search%' or group_name ilike '%$search%') " ;
		}

		if (!empty($user_group))
		{
			$where .="and (U.user_group_id=$user_group)";
		}

		$sql =  'SELECT UG.group_name,U.* FROM t_mtr_user U JOIN t_mtr_user_group UG ON UG.id_seq = U.user_group_id '.$where.' ORDER BY '.$sort.' '.$order.'';

		$query = $this->db->query($sql);
		$total_rows = $query->num_rows();
		$sql .= " LIMIT $rows OFFSET $offset";
		$query = $this->db->query($sql);

		$data_rows = array();
	    foreach ($query->result_array() as $r) {
	    	$edit = $this->m_global->menuAccess($this->session->userdata('user_group_id'),'configuration/user','edit');
	    	$change_password = $this->m_global->menuAccess($this->session->userdata('user_group_id'),'configuration/user','change_password');
	    	$delete = $this->m_global->menuAccess($this->session->userdata('user_group_id'),'configuration/user','delete');
	    	$action = '';

	    	if($edit){
	    		$action .= '<button onClick="edit_user(\''.(encode($r['id_seq'])).'\')" class="updated btn bg-angkasa2 btn-icon btn-xs btn-dtgrid" title="Edit">Edit</button> ';
	    	}

	    	if($change_password){
	    		$action .= '<button onClick="change_password(\''.(encode($r['id_seq'])).'\')" class="updated btn bg-angkasa2 btn-icon btn-xs btn-dtgrid" title="Change Password">Reset Password</button> ';
	    	}

	    	if($delete){
	    		if($r['status']=='1')
	    		{	
	    			$action .= '<button onClick="disable_user(\''.(encode($r['id_seq'])).'\','."'Disable'".','."'disable'".')" class="updated btn btn-danger btn-icon btn-xs btn-dtgrid" title="Delete">Disable</button>';
	    		}
	    		else
	    		{
	    			$action .= '<button onClick="disable_user(\''.(encode($r['id_seq'])).'\','."'Enable'".','."'enable'".')" class="updated btn bg-angkasa2 btn-icon btn-xs btn-dtgrid" title="Delete">Enable</button>';	
	    		}
	    	}

	    	if($r['status']=='1')
	    	{
	    		$status='<span>Active</span>';
	    	}
	    	else
	    	{
	    		$status='<span class="">Non Active</span>';	
	    	}

	    	$r['status']=$status; 
	    	$r['full_name']=$r['first_name']." ".$r['last_name'];
	    	$r['id_seq'] 	= encode($r['id_seq']);
	    	$r['action'] 	= $action;
	    	$data_rows[] = $r;
	    }

	    $data['total'] = $total_rows;
		$data['rows'] = $data_rows;

		return $data;
	}

	function getUserValidator($id)
	{
		return $this->db->query("select null as merchant_name, null as lane_id, a.last_name,  a.first_name,  c.po_id, c.shelter_id, null as terminal_id, b.group_name, a.* from t_mtr_user a 
			left join t_mtr_user_group b on a.user_group_id=b.id_seq 
			left join master.t_mtr_user_validator c on a.id_seq=c.user_id
			where a.user_group_id=5  and a.id_seq=$id")->row();
	}
	
	function getUserAll($id)
	{
		return $this->db->query("select b.group_name, a.* 
			from t_mtr_user a 
			left join t_mtr_user_group b on a.user_group_id=b.id_seq 
			where  a.id_seq=$id")->row();
	}

	function insertData($table,$data)
	{
        $this->db->insert($table,$data);
	}

	function updateData($table,$data,$where)
    {
    	
        $this->db->where($where);
        $this->db->update($table,$data);
    }

}

/* End of file M_user.php */
/* Location: ./application/models/M_user.php */