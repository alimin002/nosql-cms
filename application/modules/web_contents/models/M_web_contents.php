<?php

if (!defined('BASEPATH')){
    exit('No direct script access allowed');
}
class M_web_contents extends CI_Model {

    public $variable;

    public function __construct() {
        parent::__construct();
    }
   
    public function getData(){

        $data = array();
        $search = trim($this->input->post('search'));          
        $page = $this->input->post('page') ? $this->input->post('page') : 1;
        $rows = $this->input->post('rows') ? $this->input->post('rows') : 10;
        $offset = ($page - 1) * $rows;
        $sort = $this->input->post('sort') ? $this->input->post('sort') : 'a.id_seq';
        $order = $this->input->post('order') ? $this->input->post('order') : 'asc';
        $where = " where a.status != -5 ";
        //web_contents_type_name
        if (!empty($search)) {
            $where .= "and(a.nama_t_mtr_pagecontent like '%" . $search . "%' or a.page_code like '%".$search."%')";
        }

        $sql = "select  a.* from t_mtr_pagecontent a                                         
		$where ORDER BY $sort $order";      
        $query = $this->db->query($sql);
        $total_rows = $query->num_rows();
        $sql .= " LIMIT $rows OFFSET $offset";
        $query = $this->db->query($sql);

        $data_rows = array();

        foreach ($query->result_array() as $r) {

            $edit = $this->m_global->menuAccess($this->session->userdata('user_group_id'), 'web_contents', 'edit');
            $delete = $this->m_global->menuAccess($this->session->userdata('user_group_id'), 'web_contents', 'delete');
            $enable_disable = $this->m_global->menuAccess($this->session->userdata('user_group_id'), 'web_contents', 'enable-disable');
            $action = '';

            if ($edit) {
                $action .= '<button class="btn btn-primary btn-sm" onClick="edit(\'' . (encode($r['id_seq'])) . '\')" class="btn btn-nutech-edit" title="Edit" title="Edit"><i class="fa fa-edit"></i></button> ';
            }

            if ($delete) {
                $action .= '<button class="btn btn-danger btn-sm" onClick="deleteData(\'' . (encode($r['id_seq'])) . '\')" class="btn btn-nutech-delete" title="Delete"><i class="fa fa-trash"></i></button>';
            }
            
           
            
            $r['action'] = $action;

            $data_rows[] = $r;
        }

        $data['total'] = $total_rows;
        $data['rows'] = $data_rows;
        $data['sql']=$sql;
        return $data;
    }

    public function select($table, $order) {
        $this->db->query("select * from " . $table . " order by " . $order);
    }
    public function get_web_contents_desc() {
        return $this->db->query("select * from t_mtr_pagecontent where status != -5 order by id_seq desc")->result();        
    }
}

/* End of file M_gatein.php */
/* Location: ./application/models/M_gatein.php */