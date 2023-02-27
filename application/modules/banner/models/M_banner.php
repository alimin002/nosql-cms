<?php

if (!defined('BASEPATH')){
    exit('No direct script access allowed');
}
class M_banner extends CI_Model {

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
        //banner_type_name
        if (!empty($search)) {
            $where .= "and(a.nama_banner like '%" . $search . "%' or a.kode_banner like '%".$search."%')";
        }

        $sql = "select  a.*,a.id_seq as xid_seq from t_mtr_banner a                                               
		$where ORDER BY $sort $order";      
        $query = $this->db->query($sql);
        $total_rows = $query->num_rows();
        $sql .= " LIMIT $rows OFFSET $offset";
        $query = $this->db->query($sql);

        $data_rows = array();

        foreach ($query->result_array() as $r) {

            $edit = $this->m_global->menuAccess($this->session->userdata('user_group_id'), 'banner', 'edit');
            $delete = $this->m_global->menuAccess($this->session->userdata('user_group_id'), 'banner', 'delete');
            $enable_disable = $this->m_global->menuAccess($this->session->userdata('user_group_id'), 'banner', 'enable-disable');
            $action = '';

            if ($edit) {
                $action .= '<button class="btn btn-primary btn-sm" onClick="edit(\'' . (encode($r['xid_seq'])) . '\')" class="btn btn-nutech-edit" title="Edit" title="Edit"><i class="fa fa-edit"></i></button> ';
            }

            if ($delete) {
                $action .= '<button class="btn btn-danger btn-sm" onClick="deleteData(\'' . (encode($r['xid_seq'])) . '\')" class="btn btn-nutech-delete" title="Delete"><i class="fa fa-trash"></i></button>';
            }
            
            if($r["status"]==1){
                $slider_status="<span class='label label-success'>Aktif</span>";
                
            }else{
                $slider_status="<span class='label label-danger'>Tidak aktif</span>";
            }
            $r["slider_status"]=$slider_status;
            
            $src = $r["image_url"];
            
            $r['gambar'] ="<center><img width='100' height='70'  src='$src'/></center>";


            
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
    public function get_banner_desc() {
        return $this->db->query("select * from t_mtr_banner where status != -5 order by id_seq desc")->result();        
    }
}

/* End of file M_gatein.php */
/* Location: ./application/models/M_gatein.php */