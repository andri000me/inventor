<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasbord extends CI_Controller {
function __construct(){
	parent::__construct();
	 if(empty($this->session->userdata['email'])){
                redirect(site_url().'auth/login');
            }

}
	public function index()
	{
		$data = array( 'isi'=>'page/home' );
 
   
      
            $this->load->view('setup/conect',$data);	
        }
}
