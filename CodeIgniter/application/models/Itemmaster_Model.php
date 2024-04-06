<?php

Class Itemmaster_Model extends CI_Model
{
//InsertingQuery-----------------------------------------------------------------------------------
public function create_insert($data){
    $query = $this->db->insert('itemmaster', $data);
    // print_r($this->db->last_query());die;
    return $query;
}
// ------------------------------------------------------------------------------------------------
// public function item_record($searchdatajfh = array(), $order_by, $sort_by){

public function item_record($searchdatajfh, $order_by, $sort_by){
    $pageNum = isset($searchdatajfh['page_num']) ? $searchdatajfh['page_num'] : '';
    $limit = isset($searchdatajfh['limit']) ? $searchdatajfh['limit'] : '';
    $offset = (intval($pageNum) - 1) * intval($limit);
    $this->db->select('*');
    $this->db->from('itemmaster');

    if(!empty($searchdatajfh['item_name'])){
        $this->db->like('item_name', $searchdatajfh['item_name']);
    }
    if(!empty($searchdatajfh['item_price'])){
        $this->db->like('item_price', $searchdatajfh['item_price']);
    }
    if(!empty($searchdatajfh['item_desc'])){
        $this->db->like('item_desc', $searchdatajfh['item_desc']);
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
    //ItemDataDelete-----------------------------------------------------------------------------------

    // public function item_data_delete($id){

    //     $this->db->where('id', $id);
    //     $this->db->delete('itemmaster');
    //     // print_r($this->db->last_query());die;
    //     return 1;
    // }

public function item_data_delete($id){
    $this->db->where('id', $id);
    $this->db->delete('itemmaster');

    $error = $this->db->error();
    if ($error['code'] == 0) {
        return 1;
    } elseif ($error['code'] == 1451) {
        return 1451;
    }
}

//ItemDataDisplayUpadte----------------------------------------------------------------------------
public function itemmaster_update($id){
    $this->db->select('id, item_name, item_price, item_desc,item_image');
    $this->db->from('itemmaster');
    $this->db->where('id', $id);
    $data = $this->db->get();
    return $data->result();
    $this->db->get();
}
// ItemDataUpdat-----------------------------------------------------------------------------------
public function itemaddupdate($id, $data){
    $this->db->where('id', $id);
    $this->db->update('itemmaster', $data);
    // print_r($data);die;
    $query = $this->db->get('itemmaster');
    // print_r($query);die;
    return $query->result();
}
public function getRecordTotal(){
    $this->db->select('count(id) as total');
    $this->db->from('itemmaster');
    $data = $this->db->get()->row();
//    print_r($data);die;
    return $data;
}



public function getItemName($item_name)
{
    $this->db->select('item_name');
    $this->db->from('itemmaster');
    $this->db->where('item_name', $item_name);
    return $this->db->get()->num_rows();
}


public function existingupdate($item_name, $id){
    $this->db->where('item_name', $item_name);
    $this->db->where('id !=', $id);
    $this->db->from('itemmaster');
    return $this->db->count_all_results();
    // print_r($h);die;
 }


}

?>