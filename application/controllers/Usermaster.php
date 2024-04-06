
<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Usermaster extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('Usermaster_Model');
		$this->load->library('encryption');
		// $this->load->library('session');
		if (!$this->session->userdata('Email'))
			redirect('Login');
	}
	// ------------------------------------------------------------------------------------------------
	public function index(){
		$this->load->view('include/header_1');
		$this->load->view('usermaster/usermaster');
		$this->load->view('include/footer_1');
	}
	// ------------------------------------------------------------------------------------------------
	public function getTotalRecords(){
		$data = $this->Usermaster_Model->getRecordTotal();
		echo json_encode($data);
	}
	// ------------------------------------------------------------------------------------------------
	// Insering and Addupdate Query :------------------------------------------------------------------
	public function insertingData(){
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('number', 'Number', 'required|trim|exact_length[10]');

		if ($this->form_validation->run()) {
			$id = $this->input->post('Sno');
			if (empty($id)) {
				if ($this->input->post('password') == "") {
					echo json_encode(array('status' => 'error', 'message' => 'Password Cannot be blank'));
					exit;
				}
				if (strlen($this->input->post('password')) < 7) {
					echo json_encode(array('status' => 'error', 'message' => 'Password should be at least 7 characters long'));
					exit;
				}
				$name = $this->input->post('name');
				$email = $this->input->post('email');
				$number = $this->input->post('number');
				$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
				$existingUser = $this->Usermaster_Model->getUserByEmail($email);
				if ($existingUser >= 1) {
					echo json_encode(array('status' => 'error', 'message' => 'Email already exists'));
					return;
				}
				$existingUser = $this->Usermaster_Model->getUserByNumber($number);
				$data = array(
					'Name' => $name,
					'Email' => $email,
					'Phone' => $number,
					'Password' => $password,
				);
				$insert = $this->Usermaster_Model->insertingDataModel($data);
				// print_R($insert);die;
				echo json_encode(array('code' => 200, 'msg' => 'Inserted Sucessfully'));
			} else {
				if ($this->input->post('password') == " "  &&  $this->input->post('hiddenpassword') == " ") {
					echo json_encode(array('status' => 'error', 'message' => 'Password is required'));
					exit;
				}
				if ($this->input->post('password') == "") {
					$password = $this->input->post('hiddenpassword');
				} elseif ($this->input->post('password') != " ") {
					$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
				}
				if ($this->input->post('password') == "") {
					$password_2 = $this->input->post('hidden_2');
				} elseif ($this->input->post('password') != " ") {
					$password_2 = $this->input->post('password');
				}
				$name = $this->input->post('name');
				$email = $this->input->post('email');
				$number = $this->input->post('number');
				// $password_2 = $this->input->post('hidden_2');

				$exitingUpdateRecord = $this->Usermaster_Model->upDateQuery($email, $id);
				if ($exitingUpdateRecord >= 1) {
					echo json_encode(array('status' => 'error', 'message' => 'Email Already Exists'));
					return;
				}
				$data = array(
					'Sno' => $id,
					'Name' => $name,
					'Email' => $email,
					'Phone' => $number,
					'Password' => $password,
					'Password_2' => $password_2,
				);
				$insertUpdate = $this->Usermaster_Model->insertAddUpdate($id, $data);
				// print_r($insertUpdate);die;
				echo json_encode(array('code' => 200, 'msg' => 'Updated  Sucessfully'));
			}
		}
		else{
			echo json_encode(array('status' => 'error', 'message' => strip_tags(validation_errors())));
		}
	}

	// Fetching Data ----------------------------------------------------------------------------------
	public function fetchingData(){
		$table = '';
		$post = $this->input->post();
		// print_r($post);die;
		$order_by = $this->input->post('columnName');
    	$sort_by = $this->input->post('sort_type');

		$searchingData = array(
			'Name' => $this->input->post('search_name'),
			'Email' => $this->input->post('search_email'),
			'Phone' => $this->input->post('search_number'),
			'page_num' =>  $this->input->post('page_num'),
			'limit' =>  $this->input->post('limit'),
		);
		$data = $this->Usermaster_Model->fetchRecord($searchingData, $order_by, $sort_by);
		$totaldata = $this->Usermaster_Model->getRecordTotal();
		$pagination = $this->load->view('pagination.php', array('total' => $totaldata, 'limit' => $post['limit']), true);
		// print_r($data['data']);die;
		if (!empty($data['data'])) {
			$i = $post['limit'] * ($post['page_num'] - 1) + 1;
			foreach ($data['data'] as $row) {
				$table .= "<tr>";
				$table .= "<td class='p-2 border-r w-10 text-right text-center' style='font-size: 15px; margin-top: 5px; '>" . $i . "</td>";
				$table .= "<td class='p-2 border-r w-10 text-right text-center' style='font-size: 15px; margin-top: 5px; cursor:pointer;' onclick = 'UserEdit($row->Sno);'>" . ucfirst($row->Name) . "</td>";
				$table .= "<td class='p-2 border-r w-10 text-right text-center' style='font-size: 15px; margin-top: 5px; color: black;  cursor:pointer;' onclick = 'UserEdit($row->Sno);'>" . ucfirst($row->Email) . "</td>";
				$table .= "<td class='p-2 border-r w-10 text-right text-center' style='font-size: 15px; margin-top: 5px; color: black;  '>" . $row->Phone . "</td>";
				$table .= "<td><span  onclick = 'UserEdit($row->Sno);'>
					<a href='#'><i class='bi bi-pencil-square'></i>
					<svg xmlns='http://www.w3.org/2000/svg' width='30' height='20' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16' style='margin-left: 20px;'>
					<path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
					<path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
					</svg></a>
				</span> </td>";
				$table .= "<td><span  onclick = 'UserDelete($row->Sno);'>
					<a href='#'><i  class='bi bi-trash' ></i>
					<svg xmlns='http://www.w3.org/2000/svg' width='30' height='20' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16' style='margin-left: 20px; color: red;'>
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

	// --------------Delete Data Query-----------------------------------------------------------------
	public function userdDlt(){
		$id = $this->input->post('id');
		$result = $this->Usermaster_Model->usermaster_delete($id);
		// echo json_encode($result);
		echo json_encode(array('code' => 200, 'msg' => ' Delete Successfully'));
	}
	// -----------------Edit Button -------------------------------------------------------------------
	public function UserEdit(){
		$id = $this->input->post('Sno');
		$result = $this->Usermaster_Model->Usermaster_update($id);
		echo json_encode($result);
		// echo json_encode(array('code'=> 200 , 'msg'=>'Edit Successfully'));
	}
	// ------------------------------------------------------------------------------------------------


}

?>