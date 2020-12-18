<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
function __construct(){
	parent::__construct();
	 if(empty($this->session->userdata['email'])){
                redirect(site_url().'auth/login');
            }
	$this->load->model('Kategori_m');

}

	public function index()
	{
		 
		$data = array( 'isi'=>'page/kategori/index');   
      
            $this->load->view('setup/conect',$data);	
}

	//select all data
	public function list_all(){
		$result = array('data' =>array() );
		$data=$this->Kategori_m->listAll();
		foreach ($data as $key => $value) {
			$button='<div class="btn-group">
	             
	             <a type="button" class="btn btn-outline-warning btn-sm" title="klick here on change" onclick="updateKategori('.$value['id_kategori'].')" data-toggle="modal" data-target="#updateModal">  <span class="fa fa-pencil-square-o"></span></a>
	              
	             
	            </div>';
			$result['data'][$key]=array(
				$value['nama_kategori'],				
				$button
			);
		}
		echo json_encode($result);
	}



//insert data
public function insert(){

	
			$valid = array('success' =>false,'messages' => array() );
		$config = array(
			array(
				'field'		=> 'nama_kategori',
				'label'		=>'kategori',
				'rules'		=>'trim|required|max_length[100]'
			)

		 );

		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		if ($this->form_validation->run() === true) {
			$user=$this->Kategori_m->insert();
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
		


		
	}


		public function get_id($id=null){
		 if($id) {
            $data = $this->Kategori_m->getId($id);
            echo json_encode($data);
        }
	}


	public function update($id=null){
		
			 if($id) {
            $validator = array('success' => false, 'messages' => array());

            $config = array(
            array(
            'field' => 'enama_kategori',
            'label' => 'kategori',
            'rules' => 'trim|required|max_length[100]'
            )
          
             
               
           
        );
            $this->form_validation->set_rules($config);
            $this->form_validation->set_error_delimiters('<small class="text-danger control-label ">','</small>');

            if($this->form_validation->run() === true) {

                $edit = $this->Kategori_m->update($id); 

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

}

