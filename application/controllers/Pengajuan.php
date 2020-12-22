<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan extends CI_Controller {
function __construct(){
	parent::__construct();
	 if(empty($this->session->userdata['email'])){
                redirect(site_url().'auth/login');
            }
	$this->load->model('Pengajuan_m');
	$this->load->model('Barang_m');
}

	public function index()
	{
		if ($this->session->userdata['level']==='super') {
			
		 	$all=$this->Pengajuan_m->listAlls();
		$data = array( 'isi'=>'page/pengajuan/index',
						'all'=>$all,   
      					'success'=>'');
           $this->load->view('setup/conect',$data);	
		//var_dump($all);
		//exit();
		}else{

		 	$all=$this->Pengajuan_m->listAll();
		$data = array( 'isi'=>'page/pengajuan/index',
						'all'=>$all,   
      					'success'=>'');
           $this->load->view('setup/conect',$data);	
		//var_dump($data);
		//exit();
		}
}


	



//insert data
public function insert(){

	
			$valid = array('success' =>false,'messages' => array() );
		$config = array(
			
			array(
				'field'		=> 'id_barang',
				'label'		=>'id_barang',
				'rules'		=>'trim|required'
			),
			array(
				'field'		=> 'deskripsi_pengajuan',
				'label'		=>'deskripsi pengajuan',
				'rules'		=>'trim|required'
			),
			
			array(
				'field'		=> 'jumlah_barang',
				'label'		=>'jumlah',
				'rules'		=>'trim|required'
			)

		 );

		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		if ($this->form_validation->run() === true) {
			$user=$this->Pengajuan_m->insert();
			redirect(site_url('pengajuan'));
		}else{
			$valid['success']=false;
			foreach ($_POST as $key => $value) {
				$valid['messages'][$key]=form_error($key);
			}
		}
		
		$er=json_encode($valid);
		$barang=$this->Barang_m->listAll();
		$data = array( 'isi'=>'page/pengajuan/add',
					'barang'=>$barang,
					'er'=>$er);   
      
            $this->load->view('setup/conect',$data);

		
	}

        //admin
		public function get_id($id=null){
		
           
         
            if ($id) {
            	# code...
            $data = $this->Pengajuan_m->getId($id);
             echo json_encode($data);
            }
      
     
	}
    //user
	public function getid($id=null)
	{
		 $data = $this->Pengajuan_m->getId($id);

        if (empty($data))
        {
                show_404();
        }
        $barang=$this->Barang_m->listAll();
        $news_item = $this->Pengajuan_m->getId($id);
       // $news_item=json_encode($x,);
        $data = array( 'isi'=>'page/pengajuan/update', 
                        'barang'=>$barang,       				 
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
            'field' => 'ecatatan',
            'label' => 'note',
            'rules' => 'trim|required|max_length[100]'
            )
          
             
               
           
        );
            $this->form_validation->set_rules($config);
            $this->form_validation->set_error_delimiters('<small class="text-danger control-label ">','</small>');

            if($this->form_validation->run() === true) {

                $edit = $this->Pengajuan_m->update($id); 

                if($edit === true) {
                    $validator['success'] = true;
                    $validator['messages'] = "Successfully updated";
                } else {
                    $validator['success'] = false;
                    $validator['messages'] = "Error while updating the infromation";
                }           
            } 
            else {
                $validator['success'] = false;
                foreach ($_POST as $key => $value) {
                    $validator['messages'][$key] = form_error($key);    
                }           
            }

            echo json_encode($validator);
        }
		


		
	}

	public function updateme($id=null){
		
			 if($id) {
            $validator = array('success' => false, 'messages' => array());

            $config = array(
            array(
            'field' => 'deskripsi_pengajuan',
            'label' => 'note',
            'rules' => 'trim|required|max_length[200]'
            ),
            array(
            'field' => 'id_barang',
            'label' => 'barang ',
            'rules' => 'trim|required'
            ),
             array(
            'field' => 'jumlah_barang',
            'label' => 'jumlah ',
            'rules' => 'trim|required'
            )

          
             
               
           
        );
            $this->form_validation->set_rules($config);
            $this->form_validation->set_error_delimiters('<small class="text-danger control-label ">','</small>');

            if($this->form_validation->run() === true) {

                $edit = $this->Pengajuan_m->updateme($id); 

                if($edit === true) {
                    $validator['success'] = true;
                    $validator['messages'] = "Successfully updated";
                } else {
                    $validator['success'] = false;
                    $validator['messages'] = "Error while updating the infromation";
                }           
            } 
            else {
                $validator['success'] = false;
                foreach ($_POST as $key => $value) {
                    $validator['messages'][$key] = form_error($key);    
                }           
            }

            redirect(base_url().'pengajuan/');
        }
		
        

		
	}

}

