<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_m extends CI_Model {
public function __construct(){
	parent::__construct();
}



	//insert data to database
	public function insert()
	{
		$data = array('nama_kategori' 		=>	$this->input->post('nama_kategori',true));

		$sql=$this->db->insert('tb_kategori',$data);
		if($sql===true){
			return true;
		}else{
			return false;
		}
	}



//select all data devisi
	public function listAll(){
	
		$this->db->select('*');
		$this->db->from('tb_kategori');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function getId($id=null){
		if ($id) {
    		
    	$this->db->where('tb_kategori.id_kategori',$id);
    	$this->db->select('*');
    	
    
    	
    	$this->db->from('tb_kategori');
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
			$data = array('nama_kategori' 		=> $this->input->post('enama_kategori',true) );
			$this->db->where('id_kategori', $id);
			$sql=$this->db->update('tb_kategori',$data);
			if($sql===true){
				return true;

			}else{
				return false;
			}
		}
	}

	
}

