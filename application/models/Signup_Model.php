<?php 

class Signup_Model extends CI_Model{

    // function __construct();


public function insertingDataModel($data)
    {
        // echo "dsfjd";die;
        $query = $this->db->insert('usermaster', $data);
        return $query;
    }

    public function checkMailExit($email){
        $this->db->select('Email');
        $this->db->from('usermaster');
        $this->db->where('Email', $email);
        return $this->db->get()->num_rows();
    }

    // public function checkNumberExit($number){
    //     $this->db->select('Number');
    //     $this->db->from('usermaster');
    //     $this->db->where('Number', $number);
    //     return $this->db->count_all_result();
    // }



}

?>