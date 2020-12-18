<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_m extends CI_Model {
public function __construct(){
	parent::__construct();
}



	//insert data to database
	public function insert()
	{
		$data = array('kode_barang' 					=>	$this->input->post('kode_barang',true) ,
					 	'nama_barang' 					=> $this->input->post('nama_barang',true),
						'deskripsi_barang' 				=> $this->input->post('deskripsi_barang'),
						'id_kategori' 					=> $this->input->post('id_kategori',true),
						'jumlah_barang' 				=> $this->input->post('jumlah_barang',true),
						'harga_beli' 					=> $this->input->post('harga_beli',true),
						'tanggal_beli' 					=> $this->input->post('tanggal_beli',true),
						'status_barang' 				=> $this->input->post('status_barang',true),
						'garansi' 						=> $this->input->post('garansi',true),
						 'id_user'        	=> $this->session->userdata('id_user')
					);

		$sql=$this->db->insert('tb_barang',$data);
		if($sql===true){
			return true;
		}else{
			return false;
		}
	}



//select all data devisi
	public function listAll(){
			
		$this->db->select('*');
		$this->db->from('tb_barang');
		$this->db->join('tb_kategori','tb_barang.id_kategori=tb_kategori.id_kategori');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function getId($id = FALSE){
		if ($id==FALSE) {
    		
    	$query = $this->db->get('tb_barang');
                return $query->result_array();
    	
    }
   $this->db->join('tb_kategori','tb_barang.id_kategori=tb_kategori.id_kategori');
    $query = $this->db->get_where('tb_barang', array('id_barang' => $id));
        return $query->row_array();
	}


	public function update($id=null){
		if ($id) {
			$data = array('kode_barang' 			=>	$this->input->post('kode_barang') ,
					 'nama_barang' 					=> $this->input->post('nama_barang'),
						'deskripsi_barang' 			=> $this->input->post('deskripsi_barang'),
						'id_kategori' 				=> $this->input->post('id_kategori'),
						'jumlah_barang' 			=> $this->input->post('jumlah_barang'),
						'harga_beli' 				=> $this->input->post('harga_beli'),
						'tanggal_beli' 				=> $this->input->post('tanggal_beli'),
						'status_barang' 			=> $this->input->post('status_barang'),
						'garansi' 					=> $this->input->post('garansi'),
						 'id_user'        	=> $this->session->userdata('id_user')
					);
			$this->db->where('id_barang', $id);
			$sql=$this->db->update('tb_barang',$data);
			if($sql===true){
				return true;

			}else{
				return false;
			}
		}
	}

	
}

