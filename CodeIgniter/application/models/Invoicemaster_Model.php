<?php

Class Invoicemaster_Model extends CI_Model{

// client Name Search -----------------------------------------------------------------------------:
public function getClientRecords($searchclient){
    $this->db->select('clientmaster.id, client_name, client_email, client_phone, CONCAT(countries.`names`, " ", states.name, " ", clientmaster.client_city) AS address');
    $this->db->from('clientmaster');
    $this->db->join('countries', 'countries.id = clientmaster.client_country');
    $this->db->join('states', 'states.id = clientmaster.client_state');
    $this->db->like('client_name', $searchclient);
    $query = $this->db->get();
    // print_r($query);die;
    return $query->result_array();
}
// ------------------------------------------------------------------------------------------------:
public function getItemRecords($searchItem){
    $this->db->select('id ,item_name,item_price');
    $this->db->from('itemmaster');
    $this->db->like('item_name', $searchItem);
    $query = $this->db->get();
    return $query->result_array();
}
// ------------------------------------------------------------------------------------------------
public function insert_invoicemaster($data) {
    $this->db->insert('invoicemaster', $data);
    return $this->db->insert_id();
}
// ------------------------------------------------------------------------------------------------
public function update_invoicemaster($invoiceid, $data){
    $this->db->where('id', $invoiceid);
    $this->db->update('invoicemaster', $data);
    return true;
}
// ------------------------------------------------------------------------------------------------
public function insert_invoice_details($data) {
    $this->db->insert('invoice_details', $data);
    return true;
}

// ================================================================================================
public function invoice_record($search_params, $order_by, $sort_by){
    $pageNum = isset($search_params['page_num']) ? $search_params['page_num'] : '';
    $limit = isset($search_params['limit']) ? $search_params['limit'] : '';
    $offset = (intval($pageNum) - 1) * intval($limit);

    $this->db->select('invoicemaster.id, DATE_FORMAT(invoicemaster.invoice_date, "%d-%m-%Y")AS invoice_date, clientmaster.client_name, clientmaster.client_email, CONCAT(countries.`names`, " ",states.name, " ",cities.name) AS address, invoicemaster.total_amount');
    $this->db->from('invoicemaster');
    $this->db->join('clientmaster', 'invoicemaster.Client_id = clientmaster.id');
    $this->db->join('states', 'states.id=clientmaster.client_state');
    $this->db->join('cities', 'cities.id = clientmaster.client_city');
    $this->db->join('countries', 'countries.id=clientmaster.client_country');

    if(!empty($search_params['client_name'])){
        $this->db->like('client_name', $search_params['client_name']);
    }
    if(!empty($search_params['client_email'])){
        $this->db->like('client_email', $search_params['client_email']);
    }

    if (!empty($order_by)) {
        $this->db->order_by($order_by, $sort_by);
    }
    $tempdb = clone $this->db;
    $count = $tempdb->count_all_results();
    // $this->db->order_by("client_name", "asc");
    $this->db->limit($limit, $offset);
    $query = $this->db->get()->result();
    // print_r($this->db->last_query());die;
    return array('data' => $query, 'count' => $count);
}
// ------------------------------------------------------------------------------------------------
public function Invoicemaster_update($result){
    $this->db->select('t1.id ,t2.id AS client_id , t2.client_name,t2.client_email,t2.client_phone, CONCAT(t5.`names`  ," ", t3.name, " ", t4.name ," ", t2.client_address) AS address ,t1.total_amount,t1.invoice_date');
    $this->db->from('invoicemaster t1');
    $this->db->join('clientmaster t2', 't1.Client_id=t2.id');
    $this->db->join('states t3', 't3.id=t2.client_state');
    $this->db->join('cities t4', 't4.id=t2.client_city');
    $this->db->join('countries t5', 't5.id=t2.client_country');
    $this->db->where('t1.id', $result);
    $query1 = $this->db->get();

    $this->db->select('t3.id AS item_id , t3.item_name,t3.item_price,t1.total_amount, t2.*, (t3.item_price * t2.item_qty) AS common_amount');
    $this->db->from('invoicemaster t1');
    $this->db->join('invoice_details t2',  't1.id=t2.invoice_id');
    $this->db->join('itemmaster t3', 't2.item_id = t3.id');
    $this->db->where('t1.id', $result);
    $query2 = $this->db->get();
    // print_r($this->db->last_query()); die;
    $data['cleint_data']= $query1->result_array();
    $data['item_data']= $query2->result_array();
    return $data;
}
// ------------------------------------------------------------------------------------------------
public function EditInvoice($data){
    $this->db->select('invoicemaster.id, invoicemaster.invoice_date, clientmaster.client_name,clientmaster.client_email,clientmaster.client_phone,clientmaster.client_address,CONCAT(countries.`names`, " ",states.name, " " ,clientmaster.client_city) AS address,invoicemaster.total_amount , invoice_details.*, itemmaster.item_name,invoicemaster.invoice_date');
    $this->db->from('invoicemaster');
    $this->db->join('clientmaster', 'invoicemaster.Client_id = clientmaster.id');
    $this->db->join('countries', 'countries.id=clientmaster.client_country');
    $this->db->join('states', 'states.id=clientmaster.client_state');
    $this->db->join('invoice_details', 'invoice_details.invoice_id = invoicemaster.id');
    $this->db->join('itemmaster', 'invoice_details.item_id = itemmaster.id');
    $this->db->where('invoice_id', $data['id']);
    $data = $this->db->get()->result_array();
    return  array($data);
}
// ------------------------------------------------------------------------------------------------
public function getRecordTotal(){
    $this->db->select('count(id) as total');
    $this->db->from('invoicemaster');
    $data = $this->db->get()->row();
    return $data;
}
// ------------------------------------------------------------------------------------------------
public function  delete_invoice_details($invoiceid){
    $this->db->where('invoice_id', $invoiceid);
    $this->db->delete('invoice_details');
    return 1;
}

    public function invoicemaster_delete($invoiceid){
        $this->db->where('invoice_id', $invoiceid);
        $this->db->delete('invoice_details');

        $this->db->where('id', $invoiceid);
        $this->db->delete('invoicemaster');

        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');

        $this->db->where('id', $invoiceid);
        $this->db->delete('invoicemaster');

        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
    }



    public function nextInvoice(){
        $this->db->select('id');
        $this->db->order_by('id', 'desc');
        $this->db->limit('1');
        $query = $this->db->get('invoicemaster')->row();
        return $query;
    }






}


?>