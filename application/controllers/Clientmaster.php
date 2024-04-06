<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientmaster extends CI_Controller{

public function __construct(){
    parent ::__construct();
    $this->load->model('Clientmaster_Model');
    if(!$this->session->userdata('Email'))
	redirect('Login');
}
// ------------------------------------------------------------------------------------------------
public function index(){
    $country = $this->Clientmaster_Model->getcountries();
    $data = [];
    $data['countries'] = $country;
    $this->load->view('Clientmaster.php', $data);
        // $this->load->view('include/footer_1');
}
// TotalNumberOfRecord-----------------------------------------------------------------------------
public function getTotalRecords(){
    $data = $this->Clientmaster_Model->getRecordTotal();
    echo json_encode($data);
}
// GetStateFunction--------------------------------------------------------------------------------
public function getstate(){
    $country_id = $this->input->post('country_id');
    $states = $this->Clientmaster_Model->getstateofcountry($country_id);
    $data = [];
    $data['states'] = $states;
    $statestring = $this->load->view('states-select', $data, true);
    $response['states'] = $statestring;
    echo json_encode($response);
}
//GetCitiesFunction--------------------------------------------------------------------------------
public function getcities(){
    $state_id = $this->input->post('state_id');
    $cities = $this->Clientmaster_Model->getcitiesofcountry($state_id);
    $data = [];
    $data['cities'] = $cities;
    $citiestring = $this->load->view('cities-select', $data, true);
    $response['cities'] = $citiestring;
    echo json_encode($response);
}
// --------------------------------insertQuery && Update ------------------------------------------
public function create_2(){
    $this->form_validation->set_rules('client_add_name', 'Client Name', 'required|trim');
    $this->form_validation->set_rules('client_add_email', 'Client Email', 'required|trim');
    $this->form_validation->set_rules('client_add_phone', 'Client Phone Number', 'required|trim');
    $this->form_validation->set_rules('client_add_address', 'Client Address', 'required|trim');
    $this->form_validation->set_rules('country', 'Client Country', 'required|trim');
    $this->form_validation->set_rules('state', 'Client State', 'required|trim');
    $this->form_validation->set_rules('city', 'Client City', 'required|trim');

    if($this->form_validation->run()){
        $id =$this->input->post('client_id');
        if (empty($id)){
        // $id = $this->input->post('client_id');
        // print_r($id);die;
        $name = $this->input->post('client_add_name');
        $email = $this->input->post('client_add_email');
        $phone = $this->input->post('client_add_phone');
        $address = $this->input->post('client_add_address');
        $country = $this->input->post('country');
        $state = $this->input->post('state');
        $city = $this->input->post('city');

        $existClientEmail = $this->Clientmaster_Model->getUserByEmail($email);
        if($existClientEmail >= 1){
            echo json_encode(array('status' => 'error', 'message' => 'Email already exists'));
            return;
        }

        $existingUser = $this->Clientmaster_Model->getUserByNumber($phone);
        if (strlen($phone) !== 10) {
            echo json_encode(array('status' => 'error', 'message' => 'Invalid phone number. Phone number should have 10 digits.'));
            return;
        }

    $data = array(
        'id' => $id,
        'client_name' => $name,
        'client_email' =>$email,
        'client_phone' => $phone,
        'client_address' => $address,
        'client_country' => $country,
        'client_state' => $state,
        'client_city' => $city
    );
    $insert = $this->Clientmaster_Model->createData($data);
    // echo json_encode($insert);
    echo json_encode(array('code'=> 200 , 'msg'=>'Inserted Sucessfully' ));
    }
    else{
        // $id = $this->input->post('client_id');
        $name = $this->input->post('client_add_name');
        $email = $this->input->post('client_add_email');
        $phone = $this->input->post('client_add_phone');
        $address = $this->input->post('client_add_address');
        $country = $this->input->post('country');
        $state = $this->input->post('state');
        $city = $this->input->post('city');
        $exitingUpdateRecord = $this->Clientmaster_Model->upDateQuery($email, $id);
				// print_R($exitingUpdateRecord);die;
				if ($exitingUpdateRecord >= 1) {
					echo json_encode(array('status' => 'error', 'message' => 'Email Already Exists'));
					return;
				}

    $data = array(
        'id' => $id,
        'client_name' => $name,
        'client_email' =>$email,
        'client_phone' => $phone,
        'client_address' => $address,
        'client_country' => $country,
        'client_state' => $state,
        'client_city' => $city
    );
    // print_r('Update query');die;
    $update = $this->Clientmaster_Model->clientmasterUpdateAdd($id,$data);
    // print_r($id);die;
    // echo json_encode($update);
    echo json_encode(array('code'=> 200 , 'msg'=>'Updated  Sucessfully' ));
        }
    }
}
//DisplayTheData fetchData-------------------------------------------------------------------------
public function fetch_data(){
    $table = '';
    $post = $this->input->post();
    $order_by = $this->input->post('columnName');
    $sort_by = $this->input->post('sort_type');

    $search_params = array(
        'client_name' => $this->input->post('c_search_name'),
        'client_email' => $this->input->post('c_search_email'),
        'client_phone' => $this->input->post('c_search_phone'),
        'page_num' =>  $this->input->post('page_num'),
        'limit' =>  $this->input->post('limit')
    );
    $data = $this->Clientmaster_Model->record($search_params, $order_by, $sort_by);
    $totaldata = $this->Clientmaster_Model->getRecordTotal();
    $pagination = $this->load->view('pagination.php', array('total' => $totaldata, 'limit' => $post['limit']), true);
    // print_r($data['data']);die;
    if(!empty($data['data'])){
    $i = $post['limit'] * ($post['page_num'] - 1) + 1;
    // $table = '';
    foreach($data['data'] as $row){
        $table .= "<tr>";
        $table .= "<td class='p-2 border-r w-10 text-right text-center' style='font-size: 15px; margin-top: 5px;  '>".$i."</td>";
        $table .= "<td class='p-2 border-r w-10 text-right text-center' style='font-size: 15px; margin-top: 5px;  cursor:pointer;' onclick = 'clientupdate($row->id);'>". ucfirst($row->client_name). "</td>";
        $table .= "<td class='p-2 border-r w-10 text-right text-center' style='font-size: 15px; margin-top: 5px;  cursor:pointer;' onclick = 'clientupdate($row->id);'>". ucfirst($row->client_email). "</td>";
        $table .= "<td class='p-2 border-r w-10 text-right text-center' style='font-size: 15px; margin-top: 5px;  '>". $row->client_phone. "</td>";
        $table .= "<td class='p-2 border-r w-10 text-right text-center' style='font-size: 15px; margin-top: 5px;  '>". ucfirst($row->client_address). "</td>";
        $table .= "<td class='p-2 border-r w-10 text-right text-center' style='font-size: 15px; margin-top: 5px;  '>". ucfirst($row->names). "</td>";
        $table .= "<td class='p-2 border-r w-10 text-right text-center' style='font-size: 15px; margin-top: 5px;  '>". ucfirst($row->name). "</td>";
        $table .= "<td class='p-2 border-r w-10 text-right text-center' style='font-size: 15px; margin-top: 5px;  '>". ucfirst($row->city_name). "</td>";

        $table .= "<td><span  onclick = 'clientupdate($row->id);'><a href='#'><i class='bi bi-pencil-square'></i>
            <svg xmlns='http://www.w3.org/2000/svg' width='30' height='20' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16' style='margin-left: 20px;'>
            <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
            <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
            </svg></a></span></td>";
        $table .= "<td><span  onclick = 'clientdelete($row->id);'><a href='#'><i  class='bi bi-trash' ></i>
			<svg xmlns='http://www.w3.org/2000/svg' width='30' height='20' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16' style='margin-left: 20px; color:red;'>
  			<path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z'/>
  			<path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z'/>
			</svg></a></span></td>";
        $table .= "</tr>";
        $i++;
   }

			echo json_encode(array('table' => $table, 'pagi' => $pagination,'status'=>200));
		} else {
			// $table .= "<tr>";
			$table .= "<tr><td colspan='9'  style='text-align:center;'>No Record Found</td></tr>";   // class='alert alert-primary bg-light'
			echo json_encode(array('table' => $table, 'pagi' => $pagination ,'status'=>200));
		}
	}
//DeleteQuery--------------------------------------------------------------------------------------
// public function clientdelete(){
//     $id = $this->input->post('id');
//     $result = $this->Clientmaster_Model->clientmaster_delete($id);
//     echo json_encode(array('code' => 200, 'msg' => ' Delete Successfully'));
//     // echo json_encode($result);
// }

public function clientdelete(){
    try {
        $id = $this->input->post('id');
        $result = $this->Clientmaster_Model->clientmaster_delete($id);
        if($result === 1451) {
            echo json_encode(array('code' => 400, 'msg' => 'This Client Name is being used somewhere and cannot be deleted.'));
        } else {
            echo json_encode(array('code' => 200, 'msg' => 'Delete Successfully'));
        }
     } catch (Exception $e) {
        echo json_encode(array('code' => 500, 'msg' => 'Error: ' . $e->getMessage()));
    }
}

//UpdateQuery--------------------------------------------------------------------------------------
public function clientupdate(){
    // print_r($_POST);die;
    $id = $this->input->post('id');
    $result = $this->Clientmaster_Model->clientmaster_update($id);
    echo json_encode($result);
    // echo json_encode(array('code'=> 200 , 'msg'=>'Delete  Sucessfully' ));
}

};

?>