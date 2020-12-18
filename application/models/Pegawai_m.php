<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_m extends CI_Model {
public function __construct(){
	parent::__construct();
}



	//insert data to database
	public function insert()
	{
		$data = array('nama_pegawai' 		=>	$this->input->post('nama_pegawai',true) ,
					 'npp' 					=> $this->input->post('npp',true),
						'id_devisi' 		=> $this->input->post('id_devisi',true),);

		$sql=$this->db->insert('tb_pegawai',$data);
		if($sql===true){
			return true;
		}else{
			return false;
		}
	}



//select all data devisi
	public function listAll(){
	
		$this->db->select('*');
		$this->db->from('tb_pegawai');
		$this->db->join('tb_devisi','tb_pegawai.id_devisi=tb_devisi.id_devisi');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function getId($id = FALSE){
		if ($id==FALSE) {
    		
    	$query = $this->db->get('tb_pegawai');
                return $query->result_array();
    	
    }
   $this->db->join('tb_devisi','tb_pegawai.id_devisi=tb_devisi.id_devisi');
    $query = $this->db->get_where('tb_pegawai', array('id_user' => $id));
        return $query->row_array();
	}


	public function update($id=null){
		if ($id) {
			$data = array('nama_pegawai' 		=> $this->input->post('nama_pegawai') ,
					 	'npp' 		=> $this->input->post('npp'),
					 	'id_devisi' 		=> $this->input->post('id_devisi')
					 	);
			$this->db->where('id_user', $id);
			$sql=$this->db->update('tb_pegawai',$data);
			if($sql===true){
				return true;

			}else{
				return false;
			}
		}
	}

	
}

