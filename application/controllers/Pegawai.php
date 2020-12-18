<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {
function __construct(){
	parent::__construct();
	 if(empty($this->session->userdata['email'])){
                redirect(site_url().'auth/login');
            }
	$this->load->model('Pegawai_m');
	$this->load->model('Devisi_m');
}

	public function index()
	{
		 	$all=$this->Pegawai_m->listAll();
		$data = array( 'isi'=>'page/pegawai/index',
						'all'=>$all,   
      					'success'=>'');
            $this->load->view('setup/conect',$data);	
}


	



//insert data
public function insert(){

	
			$valid = array('success' =>false,'messages' => array() );
		$config = array(
			array(
				'field'		=> 'nama_pegawai',
				'label'		=>'nama pegawai',
				'rules'		=>'trim|required|max_length[100]'
			),
			array(
				'field'		=> 'npp',
				'label'		=>'nomor pokok pegawai',
				'rules'		=>'trim|required|max_length[15]'
			),
			array(
				'field'		=> 'id_devisi',
				'label'		=>'',
				'rules'		=>'trim|required'
			)

		 );

		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		if ($this->form_validation->run() === true) {
			$user=$this->Pegawai_m->insert();
			redirect(site_url('pegawai'));
		}else{
			$valid['success']=false;
			foreach ($_POST as $key => $value) {
				$valid['messages'][$key]=form_error($key);
			}
		}
		
		$er=json_encode($valid);
		$devisi=$this->Devisi_m->listAll();
		$data = array( 'isi'=>'page/pegawai/add',
					'devisi'=>$devisi,
					'er'=>$er);   
      
            $this->load->view('setup/conect',$data);

		
	}


		public function get_id($id=null){
		
           
         
            

            $data = $this->Pegawai_m->getId($id);

        if (empty($data))
        {
                show_404();
        }
	$devisi=$this->Devisi_m->listAll();
        $news_item = $this->Pegawai_m->getId($id);
       // $news_item=json_encode($x,);
        $data = array( 'isi'=>'page/pegawai/update', 
        				'devisi'=>$devisi,  
      					'news_item'=>$news_item);
           $this->load->view('setup/conect',$data);

          //  var_dump($data);
            //exit();
     
	}


	public function update($id=null){
		
			 if($id) {
            $validator = array('success' => false, 'messages' => array());

            $config = array(
            array(
            'field' => 'nama_pegawai',
            'label' => 'nama pegawai',
            'rules' => 'trim|required|max_length[100]'
            ),
             array(
            'field' => 'npp',
            'label' => 'npp',
            'rules' => 'trim|required'
            )
          
             
               
           
        );
            $this->form_validation->set_rules($config);
            $this->form_validation->set_error_delimiters('<small class="text-danger control-label ">','</small>');

            if($this->form_validation->run() === true) {

                $edit = $this->Pegawai_m->update($id); 
 				 redirect(site_url('pegawai'));
            } 
            else {
                $validator['success'] = false;
                foreach ($_POST as $key => $value) {
                    $validator['messages'][$key] = form_error($key);    
                }  
				$devisi=$this->Devisi_m->listAll();
				$news_item = $this->Pegawai_m->getId($id);
				// $news_item=json_encode($x,);
				$data = array( 'isi'=>'page/pegawai/update', 
						'devisi'=>$devisi,  
							'news_item'=>$news_item);
				$this->load->view('setup/conect',$data);         
            }

           
        }
		


		
	}

}

