<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
function __construct(){
	parent::__construct();
	 if(empty($this->session->userdata['email'])){
                redirect(site_url().'auth/login');
            }
	$this->load->model('Barang_m');
	$this->load->model('Kategori_m');
}

	public function index()
	{
		 
		 if ($this->session->userdata['level']==='super') {

	
				$all=$this->Barang_m->listAlls();
				$data = array( 'isi'=>'page/barang/index',
				'all'=>$all,   
				'success'=>'');
				$this->load->view('setup/conect',$data);	
		 }else{
		 	redirect(site_url().'pengajuan/');
		 }
		
}


	



//insert data
public function insert(){
				if ($this->session->userdata['level']=='super') {
					
	
			$valid = array('success' =>false,'messages' => array() );
		$config = array(
			array(
				'field'		=> 'kode_barang',
				'label'		=>'kode',
				'rules'		=>'trim|required|max_length[50]|is_unique[tb_barang.kode_barang]'
			),
			array(
				'field'		=> 'nama_barang',
				'label'		=>'nama barang',
				'rules'		=>'trim|required|max_length[200]'
			),
			array(
				'field'		=> 'deskripsi_barang',
				'label'		=>'deskripsi barang',
				'rules'		=>'trim|required'
			),
			array(
				'field'		=> 'id_kategori',
				'label'		=>'',
				'rules'		=>'trim|required'
			),
			array(
				'field'		=> 'jumlah_barang',
				'label'		=>'jumlah',
				'rules'		=>'trim|required'
			),
			array(
				'field'		=> 'harga_beli',
				'label'		=>'hagra',
				'rules'		=>'trim|required'
			),
			array(
				'field'		=> 'tanggal_beli',
				'label'		=>'tanggal',
				'rules'		=>'trim|required'
			),
			array(
				'field'		=> 'status_barang',
				'label'		=>'status',
				'rules'		=>'trim|required'
			),
			array(
				'field'		=> 'garansi',
				'label'		=>'garansi',
				'rules'		=>'trim|required'
			)

		 );

		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		if ($this->form_validation->run() === true) {
			$user=$this->Barang_m->insert();
			redirect(site_url('Barang'));
		}else{
			$valid['success']=false;
			foreach ($_POST as $key => $value) {
				$valid['messages'][$key]=form_error($key);
			}
		}
		
		$er=json_encode($valid);
		$kategori=$this->Kategori_m->listAll();
		$data = array( 'isi'=>'page/Barang/add',
					'kategori'=>$kategori,
					'er'=>$er);   
      
            $this->load->view('setup/conect',$data);
				}else{
					redirect(site_url().'pengajuan/');
				}

		
	}


		public function get_id($id=null){
		
           
         
            

            $data = $this->Barang_m->getId($id);

        if (empty($data))
        {
                show_404();
        }
		$kategori=$this->Kategori_m->listAll();
        $news_item = $this->Barang_m->getId($id);
       // $news_item=json_encode($x,);
        $data = array( 'isi'=>'page/Barang/update', 
        				'kategori'=>$kategori,  
      					'news_item'=>$news_item);
           $this->load->view('setup/conect',$data);

          //  var_dump($data);
            //exit();
     
	}


	public function update($id=null){
		if ($this->session->userdata['level']==='super') {
			 if($id) {
            $validator = array('success' => false, 'messages' => array());

            $config = array(
           array(
				'field'		=> 'kode_barang',
				'label'		=>'kode',
				'rules'		=>'trim|required|max_length[50]'
			),
			array(
				'field'		=> 'nama_barang',
				'label'		=>'nama barang',
				'rules'		=>'trim|required|max_length[200]'
			),
			array(
				'field'		=> 'deskripsi_barang',
				'label'		=>'deskripsi barang',
				'rules'		=>'trim|required'
			),
			array(
				'field'		=> 'id_kategori',
				'label'		=>'',
				'rules'		=>'trim|required'
			),
			array(
				'field'		=> 'jumlah_barang',
				'label'		=>'jumlah',
				'rules'		=>'trim|required'
			),
			array(
				'field'		=> 'harga_beli',
				'label'		=>'hagra',
				'rules'		=>'trim|required'
			),
			array(
				'field'		=> 'tanggal_beli',
				'label'		=>'tanggal',
				'rules'		=>'trim|required'
			),
			array(
				'field'		=> 'status_barang',
				'label'		=>'status',
				'rules'		=>'trim|required'
			),
			array(
				'field'		=> 'garansi',
				'label'		=>'garansi',
				'rules'		=>'trim|required'
			)
          
             
               
           
        );
            $this->form_validation->set_rules($config);
            $this->form_validation->set_error_delimiters('<small class="text-danger control-label ">','</small>');

            if($this->form_validation->run() === true) {

                $edit = $this->Barang_m->update($id); 
 				 redirect(site_url('barang'));
            } 
            else {
                $validator['success'] = false;
                foreach ($_POST as $key => $value) {
                    $validator['messages'][$key] = form_error($key);    
                }  
				$kategori=$this->Kategori_m->listAll();
				$news_item = $this->Barang_m->getId($id);
				// $news_item=json_encode($x,);
				$data = array( 'isi'=>'page/Barang/update', 
						'kategori'=>$kategori,  
							'news_item'=>$news_item);
				$this->load->view('setup/conect',$data);         
            }

           
        }
		}else{
			redirect(base_url().'pengajuan/');
		}
			
		


		
	}

}

