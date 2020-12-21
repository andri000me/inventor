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
 
                    $message = '
                    <div class="container" style="text-align:center">



                    <div class="card text-center">
                    <div class="card-header">
                    Verifikasi
                    </div>
                    <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">untuk melanjutkan proses pendaftaran silahkan klik.</p>
                    <hr>
                    <a href='.$url.' class="btn btn-warning" target="_blank">NEXT</a>
                    <hr>
                    </div>
                    &nbsp;
                    <div class="card-footer text-muted">
                    TERIMA KASIH
                    </div>
                    </div>

                    </div>
                   ';                    
                  //  $message .= '' . ;      
                   // echo $message; //send this in email
 
            $config = Array(  
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
                    exit;       
                    //echo $message;             
                   
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
                 
                $this->load->view('auth/complete', $data);
                 
            }else{
               
              
            $password = $this->input->post('password');
            $pass = password_hash($password, PASSWORD_DEFAULT);
            $post = [                
                'password' => $pass,
                'id_user'=>$user_info->id_user,
            ];
           // $insert = $this->Users_m->register("users", $data);
             $insert = $this->user_model->updateUserInfo($post);
            if($insert){
               $this->session->set_flashdata('flash_message', 'welcome');
                redirect(site_url().'masuk');
               
            }
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
               
                    $email = $this->input->post('email');
            $pass = htmlspecialchars($this->input->post('password'));

            // CEK KE DATABASE BERDASARKAN EMAIL
            $cek_login = $this->user_model->checkLogin($email); 
                
            if($cek_login == FALSE)
            {
                 $this->session->set_flashdata('flash_message', 'We cant find your email address');
                redirect(site_url().'masuk');
            
            } else {
            
                if(password_verify($pass, $cek_login->password)){
                    
                      foreach($cek_login as $key=>$val){
                    $this->session->set_userdata($key, $val);
                }
                    
                   $data  = array('x' => 'Presensi Dosen',
                           
                           'isi'=>'page/home' );
 
   
      
           $this->load->view('setup/conect',$data);
                        
                } else {
                     $this->session->set_flashdata('flash_message', 'someting wrong, check mail or password');
                    redirect(site_url().'masuk');
                }
            }
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
                $url = site_url() . 'auth/reset_password/token/' . $qstring;
                $link = '<a href="' . $url . '">' . $url . '</a>';
               
                $message = '
                        <div class="container" style="text-align:center">



                        <div class="card text-center">
                        <div class="card-header">
                        Verifikasi
                        </div>
                        <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">untuk melanjutkan proses ini silahkan klik .</p>
                        <hr
                        <a href='.$url.' class="btn btn-warning" target="_blank">NEXT</a>
                        <hr>
                        </div>
                        <div class="card-footer text-muted">
                        TERIMA KASIH
                        </div>
                        </div>

                        </div>
                        ';                    
               
               // $message .= ' ' . $link;            
 
               // echo $message; //send this through mail
 
                   $config = Array(  
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
                    $this->email->cc('johansantri@gmail.com');   //sesuaikan
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
                    exit;                    
                  //  echo $message;
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
                               
               
                 $password = $this->input->post('password');
            $pass = password_hash($password, PASSWORD_DEFAULT);
            $cleanPost = [                
                'password' => $pass,
                'id_user'=>$user_info->id_user,
            ];
           // $insert = $this->Users_m->register("users", $data);
             $insert = $this->user_model->updatePassword($cleanPost);
            if($insert){
                $this->session->set_flashdata('flash_message', 'welcome');
                redirect(site_url().'masuk');
               
            }




            }
        }
       
    public function base64url_encode($data) {
      return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
 
    public function base64url_decode($data) {
      return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }  

   

      
 
       
}