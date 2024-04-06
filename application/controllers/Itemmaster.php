<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Itemmaster extends CI_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->library('upload');
        $this->load->model('Itemmaster_Model');
        $this->load->library('form_validation');
        if (!$this->session->userdata('Email'))
            redirect('Login');
    }
    // itemmaster frontend-----------------------------------------------------------------------------
    public function index(){
        $this->load->view('itemmaster/Itemmaster.php');
    }
    //FetchingData-------------------------------------------------------------------------------------
    public function insert_item(){
        $uploadPath =  base_url() . 'uploads/';
        $this->form_validation->set_rules('i_name', 'Item Name', 'required');
        $this->form_validation->set_rules('i_price', 'Item Price', 'required');
        $this->form_validation->set_rules('i_desc', 'Item Description', 'required');
        $id = $this->input->post('sno');
        $item_name = $this->input->post('i_name');
        $item_price = $this->input->post('i_price');
        $item_desc = $this->input->post('i_desc');
        // $item_image = $this->input->post('image');
        

        $data = array(
            'item_name' => $item_name,
            'item_price' => $item_price,
            'item_desc' => $item_desc,
            // 'item_image' => $item_image,
        );

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        } else {
            if (!empty($_FILES['image']['name'])) {
                $config = array(
                    'file_name' => 'test',
                    'allowed_types' => 'png|jpeg|gif|jpg',
                    'upload_path' =>  'uploads/'
                );
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('image')) {
                    echo $this->upload->display_errors();
                    return;
                }
                $imageData = $this->upload->data();
                $fileName = $imageData['file_name'];
                $data['item_image'] = $fileName;
            }

            // print_R($_FILES);die;
            if (empty($id)) {
                $existingUser = $this->Itemmaster_Model->getItemName($item_name);
                if ($existingUser >= 1) {
                    echo json_encode(array('status' => 'error', 'message' => 'Item already exists'));
                    return;
                }

                if(empty($_FILES['image']['name'])){
                    echo json_encode(array('status' => 'error', 'message' => 'Image is required'));
                    return;
                }

                if (empty($_FILES['image']['name'])) {
                    $this->form_validation->set_rules('image', 'Item Image', 'required', array('required' => 'The %s is required.'));
                }
                // print_R($_FILES['image']['name']);die;
                $this->Itemmaster_Model->create_insert($data);
                echo json_encode(array('code' => 200, 'msg' => 'Inserted Successfully'));
            } else {
                // Check if a file is being uploaded
                if (!empty($_FILES['image']['name'])) {
                    $config = array(
                        'file_name' => 'test',
                        'allowed_types' => 'png|jpeg|gif|jpg',
                        'upload_path' =>  'uploads/'
                    );
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('image')) {
                        echo $this->upload->display_errors();
                        return;
                    }
                    $imageData = $this->upload->data();
                    $fileName = $imageData['file_name'];
                    $data['item_image'] = $fileName;
                }
                    $exitingUpdateRecord = $this->Itemmaster_Model->existingupdate($item_name, $id);
                    if ($exitingUpdateRecord >= 1) {
                    echo json_encode(array('status' => 'error', 'message' => 'Item Already Exists'));
                    return;
                    }

                $this->Itemmaster_Model->itemaddupdate($id, $data);
                echo json_encode(array('code' => 200, 'msg' => 'Updated Successfully'));
            }
        }
    }
    //-------------------------------------------------------------------------------------------------
    public function fetchData(){
        $table = '';
        $post = $this->input->post();
        $order_by = $this->input->post('columnName');
    	$sort_by = $this->input->post('sort_type');

        $searchdatajfh = array(
            'item_name' => $this->input->post('item_Name'),
            'item_price' => $this->input->post('item_Price'),
            'item_desc' => $this->input->post('item_Desc'),
            'item_image' => $this->input->post('image'),
            'page_num' =>  $this->input->post('page_num'),
            'limit' =>  $this->input->post('limit')
        );
        $data = $this->Itemmaster_Model->item_record($searchdatajfh, $order_by, $sort_by);
        $totaldata = $this->Itemmaster_Model->getRecordTotal();
        $pagination = $this->load->view('pagination.php', array('total' => $totaldata, 'limit' => $post['limit']), true);

        // print_R($data['data']);die;
        if (!empty($data['data'])) {
            $i = $post['limit'] * ($post['page_num'] - 1) + 1;
            // $table = '';
            foreach ($data['data'] as $row) {
                $table .= "<tr>";
                $table .= "<td class='p-2 border-r w-10 text-right text-center' style='font-size: 15px; margin-top: 5px; '>" . $i . "</td>";
                $table .= "<td class='p-2 border-r w-10 text-right text-center' style='font-size: 15px; margin-top: 5px; cursor:pointer;' onclick = 'itemupdate($row->id);'>" . ucfirst($row->item_name) . "</td>";
                $table .= "<td class='p-2 border-r w-10 text-right text-right' style='font-size: 15px; margin-top: 5px; '>" . $row->item_price . "</td>";
                $table .= "<td class='p-2 border-r w-10 text-right text-center' style='font-size: 15px; margin-top: 5px; '>" . ucfirst($row->item_desc) . "</td>";
                $table .= '<td class="p-2 border-r w-10 text-right text-center" style="font-size: 15px; margin-top: 5px; "> <img src="' . base_url() . '/uploads/' . $row->item_image . '" width="30" height="20" > </td>';
                $table .= "<td><span onclick = 'itemupdate($row->id);'><a href='#'><i class='bi bi-pencil-square'></i>
        <svg xmlns='http://www.w3.org/2000/svg' width='30' height='20' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16' style='margin-left: 20px;'>
        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
        </svg></a>
        </span></td>";
                $table .= "<td><span onclick = 'itemdelete($row->id);'>
        <a href='#'><i  class='bi bi-trash' ></i>
			<svg xmlns='http://www.w3.org/2000/svg' width='30' height='20' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16' style='margin-left: 20px; color:red;'>
  			<path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z'/>
  			<path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z'/>
			</svg></a>
        </span></td>";
                $table .= "</tr>";
                $i++;
            }
            echo json_encode(array('table' => $table, 'pagi' => $pagination, 'status' => 200));
        } else {
            // $table .= "<tr>";
            $table .= "
			<div class='col-12'>
			<div class='alert alert-primary bg-light text-center col-12' role='alert'>
				No Record Found
			  </div></div>";
            echo json_encode(array('table' => $table, 'pagi' => $pagination, 'status' => 300));
        }
    }

    //DeleteQuery--------------------------------------------------------------------------------------
    // public function itemdelete()
    // {
    //     $id = $this->input->post('id');
    //     $result = $this->Itemmaster_Model->item_data_delete($id);
    //     // echo json_encode($result);
    //     echo json_encode(array('code' => 200, 'msg' => 'Delete Sucessfully'));
    // }

    public function itemdelete(){
    try {
        $id = $this->input->post('id');
        $result = $this->Itemmaster_Model->item_data_delete($id);
        if($result === 1451) {
            echo json_encode(array('code' => 400, 'msg' => 'This item is being used somewhere and cannot be deleted.'));
        } else {
            echo json_encode(array('code' => 200, 'msg' => 'Delete Successfully'));
        }
     } catch (Exception $e) {
        echo json_encode(array('code' => 500, 'msg' => 'Error: ' . $e->getMessage()));
    }
}


    //UpdateQuery--------------------------------------------------------------------------------------
    public function item_data_update()
    {
        $id = $this->input->post('id');
        $result = $this->Itemmaster_Model->itemmaster_update($id);
        echo json_encode($result);
    }
    //GetTotalNumberOfRecord---------------------------------------------------------------------------
    public function getTotalRecords()
    {
        $data = $this->Itemmaster_Model->getRecordTotal();
        echo json_encode($data);
    }
}
