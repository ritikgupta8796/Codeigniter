<?php

class Clientmaster_Model extends CI_Model
{

public function createData($data){
    $query = $this->db->insert('clientmaster', $data);
    return $query;
}
//GetCountriesFetching-----------------------------------------------------------------------------
public function getcountries(){
    $country = $this->db->get('countries')->result_array();
    return $country;
}
//GetCountryToState--------------------------------------------------------------------------------
public function getstateofcountry($country_id){
    $this->db->where('country_id', $country_id);
    $states = $this->db->get('states')->result_array();
    return $states;
}
//------------------------------------------------------------------------------------------------
public function getcitiesofcountry($state_id){
    $this->db->where('state_id', $state_id);
    $cities = $this->db->get('cities')->result_array();
    // echo $this->db->last_query();
    return $cities;
}
// -------------------Fetch the record & Searching-------------------------------------------------
public function record($search, $order_by, $sort_by){
    $pageNum = isset($search['page_num']) ? $search['page_num'] : '';
    $limit = isset($search['limit']) ? $search['limit'] : '';
    $offset = (intval($pageNum) - 1) * intval($limit);

    $this->db->select('clientmaster.id, clientmaster.client_name, clientmaster.client_email, clientmaster.client_phone, clientmaster.client_address, countries.names, states.name, cities.name as city_name');
    $this->db->from('clientmaster');
    $this->db->join('countries', 'countries.id = clientmaster.client_country');
    $this->db->join('states', 'states.id = clientmaster.client_state');
    $this->db->join('cities', 'cities.id = clientmaster.client_city');

    if(!empty($search['client_name'])){
        $this->db->like('client_name',$search['client_name']);
    }
    if(!empty($search['client_email'])){
        $this->db->like('client_email', $search['client_email']);
    }
    if(!empty($search['client_phone'])){
        $this->db->like('client_phone',$search['client_phone']);
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
// ---------------------Delete---------------------------------------------------------------------
// public function clientmaster_delete($id){
//     $this->db->where('id', $id);
//     $this->db->delete('clientmaster');
//     return true;
// }

public function clientmaster_delete($id){
    $this->db->where('id', $id);
    $this->db->delete('clientmaster');

    $error = $this->db->error();
    if ($error['code'] == 0) {
        return 1;
    } elseif ($error['code'] == 1451) {
        return 1451;
    }
}
// ---------------------update---------------------------------------------------------------------
public function clientmasterUpdateAdd($id, $data){
    $this->db->where('id', $id);
    $this->db->update('clientmaster', $data);
    $query = $this->db->get('clientmaster');
    return $query->result();
}
//Update------------------------------------------------------------------------------------------>
public function clientmaster_update($id){
    $this->db->select('clientmaster.id, clientmaster.client_name, clientmaster.client_email, clientmaster.client_phone, clientmaster.client_address, countries.id as contid, states.id as  stateid, cities.id as citiid');
    $this->db->from('clientmaster');
    $this->db->join('countries', 'countries.id = clientmaster.client_country');
    $this->db->join('states', 'states.id = clientmaster.client_state');
    $this->db->join('cities', 'cities.id = clientmaster.client_city');
    $this->db->where('clientmaster.id', $id);
    $data = $this->db->get();
    return $data->result();
}
//TotalNumberOfRecord------------------------------------------------------------------------------
public function getRecordTotal(){
    $this->db->select('count(id) as total');
    $this->db->from('clientmaster');
    $data = $this->db->get()->row();
    return $data;
}
// ------------------------------------------------------------------------------------------------

public function getUserByEmail($email)
    {
        $this->db->select('client_email');
        $this->db->from('clientmaster');
        $this->db->where('client_email', $email);
        return $this->db->get()->num_rows();
    }


    public function upDateQuery($email, $id){
        $this->db->where('client_email', $email);
        $this->db->where('id !=', $id);
        $this->db->from('clientmaster');
        return $this->db->count_all_results();
     }

     
     public function getUserByNumber($phone){
        $this->db->where('client_phone', $phone);
        // $this->db->where('Sno !=', $id);
        $this->db->from('clientmaster');
        return $this->db->count_all_results();
     }


}
?>