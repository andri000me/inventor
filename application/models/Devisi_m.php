<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devisi_m extends CI_Model {
public function __construct(){
	parent::__construct();
}



	//insert data to database
	public function insert()
	{
		$data = array('nama_devisi' 		=>	$this->input->post('nama_devisi',true) ,
					 'no_tlp' 		=> $this->input->post('no_tlp',true));

		$sql=$this->db->insert('tb_devisi',$data);
		if($sql===true){
			return true;
		}else{
			return false;
		}
	}



//select all data devisi
	public function listAll(){
	
		$this->db->select('*');
		$this->db->from('tb_devisi');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function getId($id=null){
		if ($id) {
    		
    	$this->db->where('tb_devisi.id_devisi',$id);
    	$this->db->select('*');
    	
    
    	
    	$this->db->from('tb_devisi');
    	$query=$this->db->get();
    	return $query->row_array();
    	if ($query===true) {
    		return true;
    	}else{
    		return false;
    	}
    }
	}
	public function update($id=null){
		if ($id) {
			$data = array('nama_devisi' 		=> $this->input->post('enama_devisi',true) ,
					 	'no_tlp' 		=> $this->input->post('eno_tlp',true)
					 	);
			$this->db->where('id_devisi', $id);
			$sql=$this->db->update('tb_devisi',$data);
			if($sql===true){
				return true;

			}else{
				return false;
			}
		}
	}

	
}

