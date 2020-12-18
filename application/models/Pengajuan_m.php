<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan_m extends CI_Model {
public function __construct(){
	parent::__construct();
}



	//insert data to database
	public function insert()
	{	

		$kode = time();	
		$uprove='';
		   $date = date('Y-m-d');
		$data = array(
					 	'id_pengajuan' 				=> $this->input->post('id_pengajuan',true),
						'deskripsi_pengajuan' 		=> $this->input->post('deskripsi_pengajuan'),
						'id_barang' 				=> $this->input->post('id_barang'),
						'jumlah_pengajuan' 			=> $this->input->post('jumlah_pengajuan',true),						
						'tanggal_pengajuan' 		=> $date,
						'status_pengajuan'			=>$uprove,
						'kode_pengajuan'			=>$kode,
						'id_user'        			=> $this->session->userdata('id_user')
						
						
					);

		$sql=$this->db->insert('tb_pengajuan',$data);
		if($sql===true){
			return true;
		}else{
			return false;
		}
	}

//select all data  pengajuan
	public function listAlls(){
	
		
		$this->db->select('*');
		$this->db->from('tb_pengajuan');
		$this->db->join('tb_devisi','tb_pengajuan.id_user=tb_devisi.id_devisi');
		$this->db->join('tb_pegawai','tb_pengajuan.id_user=tb_pegawai.id_user');
		$this->db->join('tb_barang','tb_pengajuan.id_barang=tb_barang.id_barang');
		$this->db->order_by("tb_pengajuan.id_pengajuan", "asc");
		$query=$this->db->get();
		return $query->result_array();
	}

//select all data  pengajuan order by user
	public function listAll(){
	
		$id = $this->session->userdata['id_user']; 
		$this->db->where('tb_pengajuan.id_user',$id);
		$this->db->select('*');
		$this->db->from('tb_pengajuan');
		$this->db->join('tb_pegawai','tb_pengajuan.id_user=tb_pegawai.id_user');
		$this->db->join('tb_barang','tb_pengajuan.id_barang=tb_barang.id_barang');
		$this->db->order_by("tb_pengajuan.id_pengajuan", "DESC");
		$query=$this->db->get();
		return $query->result_array();
	}

	public function getId($id = FALSE){
		if ($id==FALSE) {
    		
    	$query = $this->db->get('tb_pengajuan');
                return $query->result_array();
    	
    }



    $this->db->select('tb_pengajuan.id_pengajuan,
    				tb_pengajuan.id_barang,
    				tb_pengajuan.status_pengajuan,
    				tb_pengajuan.catatan,
    				tb_barang.nama_barang,
    				tb_pengajuan.deskripsi_pengajuan,
    				tb_pengajuan.jumlah_pengajuan');
   $this->db->join('tb_pegawai','tb_pengajuan.id_user=tb_pegawai.id_user');
   $this->db->join('tb_barang','tb_pengajuan.id_barang=tb_barang.id_barang');
    $query = $this->db->get_where('tb_pengajuan', array('id_pengajuan' => $id));
        return $query->row_array();
	}


	public function update($id=null){
		if ($id) {
			$data = array(
					 	'catatan' 					=> $this->input->post('ecatatan',true),
						'status_pengajuan' 				=> $this->input->post('status')
						
						
						
					);
			$this->db->where('id_pengajuan', $id);
			$sql=$this->db->update('tb_pengajuan',$data);
			if($sql===true){
				return true;

			}else{
				return false;
			}
		}
	}

	public function updateme($id=null){
		if ($id) {
			$uprove='';
		   $date = date('Y-m-d');
			$data = array(
					 	
						'deskripsi_pengajuan' 		=> $this->input->post('deskripsi_pengajuan'),
						'id_barang' 				=> $this->input->post('id_barang'),
						'jumlah_pengajuan' 			=> $this->input->post('jumlah_pengajuan',true),						
						'update_at' 				=> $date,
						'status_pengajuan'			=>$uprove,
						'id_user'        			=> $this->session->userdata('id_user')
						
						
						
					);
			$this->db->where('id_pengajuan', $id);
			$sql=$this->db->update('tb_pengajuan',$data);
			if($sql===true){
				return true;

			}else{
				return false;
			}
		}
	}

	
}

