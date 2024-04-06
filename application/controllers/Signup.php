<?php

defined('BASEPATH') or exit ('No direct script access allowed');

class Signup extends CI_Controller{

    public function __construct(){
        
        parent::__construct();
        $this->load->model('Signup_Model');


        // $user_data = array(
        //     'Email' => $user_email,
        //     'Password' => $new_user_id
            
        // );
        // $this->session->set_userdata($user_data);
        // redirect('');
    }

    public function index(){
        $this->load->view('Signup/index');
    }


    public function inserationData(){
        $this->form_validation->set_rules('Name', 'Name', 'required|trim');
        $this->form_validation->set_rules('Email', 'Email', 'required|trim');
        $this->form_validation->set_rules('Number', 'Phone', 'required|trim|exact_length[10]');
        
        if ($this->form_validation->run()) {

            $id = $this->input->post('Sno');
            if(empty($id)){
                if($this->input->post('Password') == ""){
                    echo json_encode(array('status' => 'error', 'message' => 'Password can not be blank'));
                    exit;
                }
                // if($this->input->post('password') < 7 ){
                //     echo json_encode(array('status' => 'error', 'message' => 'Password should be atleast 7 character.'));
                //     exit;
                // }
                $name = $this->input->post('Name');
                $email = $this->input->post('Email');
				$number = $this->input->post('Number');
				$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                $existingUser = $this->Signup_Model->checkMailExit($email);
				if ($existingUser >= 1) {
					echo json_encode(array('status' => 'error', 'message' => 'Email already exists'));
					return;
				}
				// $existingUser = $this->Signup_Model->checkNumberExit($number);
				
				$data = array(
					'Name' => $name,
					'Email' => $email,
					'Phone' => $number,
					'password' => $password,
				);
				$insert = $this->Signup_Model->insertingDataModel($data);
				// print_R($insert);die;
				echo json_encode(array('code' => 200, 'msg' => 'Inserted Sucessfully'));

            }
        }
    }







}

?>