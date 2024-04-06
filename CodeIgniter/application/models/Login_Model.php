<?php
class Login_Model extends CI_Model{

 function login($email){
    $this->db->select('*');
    $this->db->from('usermaster');
    $this->db->where('Email', $email);
    $this->db->limit(1);
    $query = $this->db->get()->result_array() ;
    return $query;
  }
}
