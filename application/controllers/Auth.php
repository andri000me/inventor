<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Auth extends CI_Controller {
       
        public $status;
        public $level;
   
        function __construct(){
            parent::__construct();
            $this->load->model('Users_m', 'user_model', TRUE);
         
            $this->load->library('form_validation');    
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->status = $this->config->item('status');
            $this->level = $this->config->item('level');
            
        }      
   
    public function index()
    {  
            if(empty($this->session->userdata['email'])){
                redirect(site_url().'masuk');
            }
           
            
           
            
            $data  = array('x' => 'Presensi Dosen',
                           
                           'isi'=>'page/home' );
 
   
      
           $this->load->view('setup/conect',$data);
         
          
                    
    }
       
       
        public function sigup()
        {
             
            $this->form_validation->set_rules('nama_pegawai', 'first name', 'required');
               
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');    
                       
            if ($this->form_validation->run() == FALSE) {  
                 
               
                $this->load->view('auth/register');
                
               
            }else{                
                if($this->user_model->isDuplicate($this->input->post('email'))){
                    $this->session->set_flashdata('flash_message', 'User email already exists');
                    redirect(site_url().'masuk');
                }else{
                   
                    $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
                    $id = $this->user_model->insertUser($clean);
                    $token = $this->user_model->insertToken($id);                                    
                    $qstring = $this->base64url_encode($token);                    
                    $url = site_url() . 'auth/complete/token/' . $qstring;
                    $link = '<a href="' . $url . '">' . $url . '</a>';
 
                    $message = '<!doctype html>
                    <html lang="en">
                    <head>
                    <!-- Required meta tags -->
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

                    <!-- Bootstrap CSS -->
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

                    <title>Hello, world!</title>
                    </head>
                    <body>
                    <div class="container" style="text-align:center">



                    <div class="card text-center">
                    <div class="card-header">
                    Verifikasi
                    </div>
                    <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href='.$url.' class="btn btn-primary" target="_blank">NEXT</a>
                    </div>
                    <div class="card-footer text-muted">
                    TERIMA KASIH
                    </div>
                    </div>

                    </div>
                    <!-- Optional JavaScript -->
                    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                    </body>
                    </html>';                    
                  //  $message .= '' . ;      
                   // echo $message; //send this in email
 
          /*  $config = Array(  
                    'protocol' => 'smtp',  
                    'smtp_host' => 'ssl://smtp.googlemail.com',  
                    'smtp_port' => 465,  
                    'smtp_user' => 'semuake@gmail.com',   //email google
                    'smtp_pass' => 'johansantri21',   //passsword google
                    'mailtype' => 'html',  
                    'charset' => 'iso-8859-1'  
                    );  
                    $this->load->library('email', $config);  
                    $this->email->set_newline("\r\n");  
                    $this->email->from(($this->input->post('email',TRUE)), ($this->input->post('nama_pegawai',TRUE)));  
                    $this->email->to($this->input->post('email',TRUE));  
                    $this->email->cc('johansantri@gmail.com');   //email sesuaikan
                    $this->email->subject('registration process');  
                    $this->email->message($message);  
                    if (!$this->email->send()) { 
                     $this->session->set_flashdata('flash_message', 'sory, mail server is under repair');
                   redirect(site_url().'masuk'); //redirect();
                    }else{  
                     $this->session->set_flashdata('flash_message', 'success, check your mail for verification');
                     return  
                     
                     redirect(site_url().'masuk'); //redirect();
                    }  
                    exit; */      
                    echo $message;             
                   
                };              
            }
        }
       
       
        protected function _islocal(){
            return strpos($_SERVER['HTTP_HOST'], 'local');
        }
       
        public function complete()
        {                                  
            $token = base64_decode($this->uri->segment(4));      
            $cleanToken = $this->security->xss_clean($token);
           
            $user_info = $this->user_model->isTokenValid($cleanToken); //either false or array();          
           
            if(!$user_info){
                $this->session->set_flashdata('flash_message', 'Token is invalid or expired');
                redirect(site_url().'masuk');
            }            
            $data = array(
                'nama_pegawai'=> $user_info->nama_pegawai,
                'email'=>$user_info->email,
                'id_user'=>$user_info->id_user,
                'token'=>$this->base64url_encode($token)
            );
           
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');              
           
            if ($this->form_validation->run() == FALSE) {  
                 
                $this->load->view('backand/auth/complete', $data);
                 
            }else{
               
                $this->load->library('password');                
                $post = $this->input->post(NULL, TRUE);
               
                $cleanPost = $this->security->xss_clean($post);
               
                $hashed = $this->password->create_hash($cleanPost['password']);                
                $cleanPost['password'] = $hashed;
                unset($cleanPost['passconf']);
                $userInfo = $this->user_model->updateUserInfo($cleanPost);
               
                if(!$userInfo){
                    $this->session->set_flashdata('flash_message', 'There was a problem updating your record');
                    redirect(site_url().'masuk');
                }
               
                unset($userInfo->password);
               
                foreach($userInfo as $key=>$val){
                    $this->session->set_userdata($key, $val);
                }
                redirect(site_url().'auth/');
               
            }
        }
       
        public function login()
        {
             if(empty($this->session->userdata['email'])){
               

            }else{
                 redirect(site_url().'auth/');
            } 

            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');    
            $this->form_validation->set_rules('password', 'Password', 'required');
           
            if($this->form_validation->run() == FALSE) {
               
                
                $this->load->view('auth/login');
                
            }else{
               
                $post = $this->input->post();  
                $clean = $this->security->xss_clean($post);
               
                $userInfo = $this->user_model->checkLogin($clean);
               
                if(!$userInfo){
                    $this->session->set_flashdata('flash_message', 'The login was unsucessful');
                    redirect(site_url().'masuk');
                }                
                foreach($userInfo as $key=>$val){
                    $this->session->set_userdata($key, $val);
                }
                redirect(site_url().'dasbord/');
            }
           
        }
       
        public function logout()
        {
            $this->session->sess_destroy();
            redirect(site_url().'');
        }
       
        public function forgot()
        {
             
           
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
           
            if($this->form_validation->run() == FALSE) {
               
                
                $this->load->view('auth/login');
                             
            }else{
                $email = $this->input->post('email');  
                $clean = $this->security->xss_clean($email);
                $userInfo = $this->user_model->getUserInfoByEmail($clean);
               
                if(!$userInfo){
                    $this->session->set_flashdata('flash_message', 'We cant find your email address');
                    redirect(site_url().'masuk');
                }  
               
                if($userInfo->status != $this->status[1]){ //if status is not approved
                    $this->session->set_flashdata('flash_message', 'Your account is not in approved status');
                    redirect(site_url().'masuk');
                }
               
                //build token
               
                $token = $this->user_model->insertToken($userInfo->id_user);                        
                $qstring = $this->base64url_encode($token);                  
                $url = site_url() . 'reset_password/token/' . $qstring;
                $link = '<a href="' . $url . '">' . $url . '</a>';
               
                $message = '<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  <div class="container" style="text-align:center">
  
   

    <div class="card text-center">
  <div class="card-header">
    Verifikasi
  </div>
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href='.$url.' class="btn btn-primary" target="_blank">NEXT</a>
  </div>
  <div class="card-footer text-muted">
    TERIMA KASIH
  </div>
</div>

</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>';                    
               
               // $message .= ' ' . $link;            
 
               // echo $message; //send this through mail
 
               /*    $config = Array(  
                    'protocol' => 'smtp',  
                    'smtp_host' => 'ssl://mail.bessproject.com',  
                    'smtp_port' => 465,  
                    'smtp_user' => 'no_replay@bessproject.com',   //email google
                    'smtp_pass' => 'OO,Jm^QeP)M_',   //passsword google
                    'mailtype' => 'html',  
                    'charset' => 'iso-8859-1'  
                    );
                    $this->load->library('email', $config);  
                    $this->email->set_newline("\r\n");  
                    $this->email->from(($this->input->post('email',TRUE)), ($this->input->post('nama_pegawai',TRUE)));  
                    $this->email->to($this->input->post('email',TRUE));  
                    $this->email->cc('kirimcek@gmail.com');   //sesuaikan
                    $this->email->subject('reset your password');  
                    $this->email->message($message);  
                     if (!$this->email->send()) { 
                     $this->session->set_flashdata('flash_message', 'sory, mail server is under repair');
                   redirect(site_url().'masuk'); //redirect();
                    }else{  
                     $this->session->set_flashdata('flash_message', 'success, check your mail for verification');
                     return  
                     
                     redirect(site_url().'masuk'); //redirect();
                    }  
                    exit;                  */  
                    echo $message;
               };
            
           
        }
       
        public function reset_password()
        {
            $token = $this->base64url_decode($this->uri->segment(4));                  
            $cleanToken = $this->security->xss_clean($token);
           
            $user_info = $this->user_model->isTokenValid($cleanToken); //either false or array();              
           
            if(!$user_info){
                $this->session->set_flashdata('flash_message', 'Token is invalid or expired');
                redirect(site_url().'masuk');
            }            
            $data = array(
                'nama_pegawai'=> $user_info->nama_pegawai,
                'email'=>$user_info->email,
//                'user_id'=>$user_info->id,
                'token'=>$this->base64url_encode($token)
            );
           
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');              
           
            if ($this->form_validation->run() == FALSE) {  
               
                
                $this->load->view('auth/reset', $data);
                
            }else{
                               
                $this->load->library('password');                
                $post = $this->input->post(NULL, TRUE);                
                $cleanPost = $this->security->xss_clean($post);                
                $hashed = $this->password->create_hash($cleanPost['password']);                
                $cleanPost['password'] = $hashed;
                $cleanPost['id_user'] = $user_info->id_user;
                unset($cleanPost['passconf']);                
                if(!$this->user_model->updatePassword($cleanPost)){
                    $this->session->set_flashdata('flash_message', 'There was a problem updating your password');
                }else{
                    $this->session->set_flashdata('flash_message', 'Your password has been updated');
                }
                redirect(site_url().'masuk');                
            }
        }
       
    public function base64url_encode($data) {
      return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
 
    public function base64url_decode($data) {
      return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }  

   

      
 
       
}