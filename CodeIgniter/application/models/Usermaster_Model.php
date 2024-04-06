
<?php

class Usermaster_Model extends CI_Model
{

    // Inserting Function :----------------------------------------------------------------------------
    public function insertingDataModel($data)
    {
        $query = $this->db->insert('usermaster', $data);
        return $query;
    }
    // Fetching Data && Searching :---------------------------------------------------------------------------------
    public function fetchRecord($search, $order_by, $sort_by){

        $pageNum = isset($search['page_num']) ? $search['page_num'] : '';
        $limit = isset($search['limit']) ? $search['limit'] : '';
        $offset = (intval($pageNum) - 1) * intval($limit);
        $this->db->select('*');
        $this->db->from('usermaster');
        if (!empty($search['Name'])) {
            $this->db->like('Name', $search['Name']);
        }
        if (!empty($search['Email'])) {
            $this->db->like('Email', $search['Email']);
        }
        if (!empty($search['Phone'])) {
            $this->db->like('Phone', $search['Phone']);
        }
        if (!empty($order_by)) {
            $this->db->order_by($order_by, $sort_by);
        }
        $tempdb = clone $this->db;
        $count = $tempdb->count_all_results();

        $this->db->limit($limit, $offset);
        $query = $this->db->get()->result();
        // print_r($this->db->last_query());die;
        return array('data' => $query, 'count' => $count);
    }
    // Delete Data :-----------------------------------------------------------------------------------
    public function usermaster_delete($id)
    {
        $this->db->where('Sno', $id);
        $this->db->delete('usermaster');
        return true;
    }
    // checking email function :-----------------------------------------------------------------------
    public function getUserByEmail($email)
    {
        $this->db->select('Email');
        $this->db->from('usermaster');
        $this->db->where('Email', $email);
        return $this->db->get()->num_rows();
    }

    public function upDateQuery($email, $id){
       $this->db->where('Email', $email);
       $this->db->where('Sno !=', $id);
       $this->db->from('usermaster');
       return $this->db->count_all_results();
    }


    public function getUserByNumber($number){
        $this->db->where('Phone', $number);
        $this->db->from('usermaster');
        return $this->db->count_all_results();
     }


    //  public function getUserByNumber(){

    //  }

    // UpdateQueryWhereId IsNotEmpty-------------------------------------------------------------------
    public function insertAddUpdate($id, $data)
    {
        $this->db->where('Sno', $id);
        $this->db->update('usermaster', $data);
        $query = $this->db->get('usermaster');
        return $query->result();
    }
    //OnclickEditUpdateFunction------------------------------------------------------------------------
    public function Usermaster_update($id)
    {
        $this->db->select('*');
        $this->db->from('usermaster');
        $this->db->where('Sno', $id);
        $data = $this->db->get();
        return $data->result();
    }
    // ------------------------------------------------------------------------------------------------
    public function getRecordTotal()
    {
        $this->db->select('count(Sno) as total');
        $this->db->from('usermaster');
        $data = $this->db->get()->row();
        // print_r($data);die;
        return $data;
    }
    // ------------------------------------------------------------------------------------------------
    public function getUserById($id)
    {
        $this->db->where('Sno', $id);
        $query = $this->db->get('usermaster');
        return $query->row();
    }


}









?>