<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devisi extends CI_Controller {
function __construct(){
	parent::__construct();
	 if(empty($this->session->userdata['email'])){
                redirect(site_url().'auth/login');
            }
	$this->load->model('Devisi_m');

}

	public function index()
	{
		 
		if ($this->session->userdata['level']==='super') {
			$data = array( 'isi'=>'page/devisi/index');   
      
            $this->load->view('setup/conect',$data);	
		}else{
			redirect(base_url().'pengajuan/');
		}
}

	//select all data
	public function list_all(){
		$result = array('data' =>array() );
		$data=$this->Devisi_m->listAll();
		foreach ($data as $key => $value) {
			$button='<div class="btn-group">
	             
	             <a type="button" class="btn btn-outline-warning btn-sm" title="klick here on change" onclick="updateDevisi('.$value['id_devisi'].')" data-toggle="modal" data-target="#updateModal">  <span class="fa fa-pencil-square-o"></span></a>
	              
	             
	            </div>';
			$result['data'][$key]=array(
				$value['nama_devisi'],
				$value['no_tlp'],
				$button
			);
		}
		echo json_encode($result);
	}



//insert data
public function insert(){
	 if ($this->session->userdata['level']==='super') {
	 	# code...

	
			$valid = array('success' =>false,'messages' => array() );
		$config = array(
			array(
				'field'		=> 'nama_devisi',
				'label'		=>'nama devisi',
				'rules'		=>'trim|required|max_length[100]'
			),
			array(
				'field'		=> 'no_tlp',
				'label'		=>'telphone',
				'rules'		=>'trim|required|max_length[15]'
			)

		 );

		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		if ($this->form_validation->run() === true) {
			$user=$this->Devisi_m->insert();
			if ($user===true) {
				$valid['success']=true;
				$valid['messages']="success create data";
			}else{
				$valid['success']=false;
				$valid['messages']="someting wrong...";
			}
		}else{
			$valid['success']=false;
			foreach ($_POST as $key => $value) {
				$valid['messages'][$key]=form_error($key);
			}
		}
		echo json_encode($valid);
	 }else{
	 	redirect(base_url().'pengajuan/');
	 }
		


		
	}


		public function get_id($id=null){
		 if($id) {
            $data = $this->Devisi_m->getId($id);
            echo json_encode($data);
        }
	}


	public function update($id=null){
		if ($this->session->userdata['level']==='super') {
			# code...
			
			 if($id) {
            $validator = array('success' => false, 'messages' => array());

            $config = array(
            array(
            'field' => 'enama_devisi',
            'label' => 'nama devisi',
            'rules' => 'trim|required|max_length[100]'
            ),
             array(
            'field' => 'eno_tlp',
            'label' => 'telphone',
            'rules' => 'trim|required|max_length[15]'
            )
          
             
               
           
        );
            $this->form_validation->set_rules($config);
            $this->form_validation->set_error_delimiters('<small class="text-danger control-label ">','</small>');

            if($this->form_validation->run() === true) {

                $edit = $this->Devisi_m->update($id); 

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
		}else{
			redirect(base_url().'pengajuan/');
		}
		


		
	}

}

