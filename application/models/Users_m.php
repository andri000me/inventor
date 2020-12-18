<?php
class Users_m extends CI_Model {
 
    public $status;
    public $level;
   
    function __construct(){
        // Call the Model constructor
        parent::__construct();        
        $this->status = $this->config->item('status');
        $this->level = $this->config->item('level');
    }    
   
    public function insertUser($d)
    {  
            $string = array(
                'nama_pegawai'=>$d['nama_pegawai'],               
                'email'=>$d['email'],
                'level'=>$this->level[0],
                'status'=>$this->status[0]
            );
            $q = $this->db->insert_string('tb_pegawai',$string);            
            $this->db->query($q);
            return $this->db->insert_id();
    }
   
    public function isDuplicate($email)
    {    
        $this->db->get_where('tb_pegawai', array('email' => $email), 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;        
    }
   
    public function insertToken($id_user)
    {  
        $token = substr(sha1(rand()), 0, 30);
        $date = date('Y-m-d');
       
        $string = array(
                'token'=> $token,
                'id_user'=>$id_user,
                'created'=>$date
            );
        $query = $this->db->insert_string('tb_tokens',$string);
        $this->db->query($query);
        return $token . $id_user;
       
    }
   
    public function isTokenValid($token)
    {
       $tkn = substr($token,0,30);
       $uid = substr($token,30);      
       
        $q = $this->db->get_where('tb_tokens', array(
            'tb_tokens.token' => $tkn,
            'tb_tokens.id_user' => $uid), 1);                        
               
        if($this->db->affected_rows() > 0){
            $row = $q->row();            
           
            $created = $row->created;
            $createdTS = strtotime($created);
            $today = date('Y-m-d');
            $todayTS = strtotime($today);
           
            if($createdTS != $todayTS){
                return false;
            }
           
            $user_info = $this->getUserInfo($row->id_user);
            return $user_info;
           
        }else{
            return false;
        }
       
    }    
   
    public function getUserInfo($id)
    {
        $q = $this->db->get_where('tb_pegawai', array('id_user' => $id), 1);  
        if($this->db->affected_rows() > 0){
            $row = $q->row();
            return $row;
        }else{
            error_log('no user found getUserInfo('.$id.')');
            return false;
        }
    }
   
    public function updateUserInfo($post)
    {
        $data = array(
               'password' => $post['password'],
               'terakhir_masuk' => date('Y-m-d h:i:s A'),
               'status' => $this->status[1]
            );
        $this->db->where('id_user', $post['id_user']);
        $this->db->update('tb_pegawai', $data);
        $success = $this->db->affected_rows();
       
        if(!$success){
            error_log('Unable to updateUserInfo('.$post['id_user'].')');
            return false;
        }
       
        $user_info = $this->getUserInfo($post['id_user']);
        return $user_info;
    }
   
    public function checkLogin($post)
    {
        $this->load->library('password');      
        $this->db->select('*');
        $this->db->where('email', $post['email']);
        $query = $this->db->get('tb_pegawai');
        $userInfo = $query->row();
       
        if(!$this->password->validate_password($post['password'], $userInfo->password)){
            error_log('Unsuccessful login attempt('.$post['email'].')');
            return false;
        }
       
        $this->updateLoginTime($userInfo->id_user);
       
        unset($userInfo->password);
        return $userInfo;
    }
   
    public function updateLoginTime($id)
    {
        $this->db->where('id_user', $id);
        $this->db->update('tb_pegawai', array('terakhir_masuk' => date('Y-m-d h:i:s A')));
        return;
    }
   
    public function getUserInfoByEmail($email)
    {
        $q = $this->db->get_where('tb_pegawai', array('email' => $email), 1);  
        if($this->db->affected_rows() > 0){
            $row = $q->row();
            return $row;
        }else{
            error_log('no user found getUserInfo('.$email.')');
            return false;
        }
    }
   
    public function updatePassword($post)
    {  
        $this->db->where('id_user', $post['id_user']);
        $this->db->update('tb_pegawai', array('password' => $post['password']));
        $success = $this->db->affected_rows();
       
        if(!$success){
            error_log('Unable to updatePassword('.$post['id_user'].')');
            return false;
        }        
        return true;
    }
        public function hitungUsr(){
    $this->db->select('COUNT(id_user) as total');
        
        $this->db->from('tb_pegawai');
        $query=$this->db->get();
        return $query->row_array();
}

      
   
}