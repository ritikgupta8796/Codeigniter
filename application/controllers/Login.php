<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Login_Model');
		if ($this->session->userdata('Login'))
			redirect('dashboard');
	}

	public function index()
	{
		$this->load->view('Login.php');
		// echo "hello";
	}

	// public function checkuserpassword()
	// {
	// 	// print_r($_POST);die;
	// 	$email = $this->input->post('email');
	// 	$password = $this->input->post('password');
	// 	$res = $this->Login_Model->login($email);
	// 	// print_r($res);die;
	// 	// print_r($res[0]['password_2']);die;ss
	// 	// $passwordhash   = password_hash($_POST['password'], PASSWORD_DEFAULT);
	// 	if (($password == $res[0]['password_2'] )) {
	// 		$this->session->set_userdata('Email', $email);
	// 		echo  json_encode(array('code' => 200, 'msg' => 'login'));
	// 	}
	// 	// else if (($password == $res[0]['Password'] )) {
	// 	// 	$this->session->set_userdata('Email', $email);
	// 	// 	echo  json_encode(array('status' => true, 'msg' => 'login'));
	// 	// }

	// 	else {
	// 		echo  json_encode(array('code' => 'error', 'msg' => 'Invalid Credential'));
	// 	}
	// }


// ======================================================
// this is right code

	public function checkuserpassword(){
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    $res = $this->Login_Model->login($email);
	// print_R($res);die;
    if (!empty($res) && $password == $res[0]['password_2'] ) {
        $this->session->set_userdata('Email', $email);
        echo json_encode(array('code' => 200, 'msg' => 'login'));
    } elseif (empty($res)) {
        echo json_encode(array('code' => 'error', 'msg' => 'Invalid Email'));
    } else {
        echo json_encode(array('code' => 'error', 'msg' => 'Invalid Password'));
    }
}


// ===========================================================

// public function checkuserpassword()
// {
//     $email = $this->input->post('email');
//     $password = $this->input->post('password');
//     $res = $this->Login_Model->login($email);
//     if (!empty($res) && (password_verify($password, $res[0]['Password']) || $password == $res[0]['password_2'] || password_verify($password, $res[0]['password_2']))) {
//         $this->session->set_userdata('Email', $email);
//         echo json_encode(array('code' => 200, 'msg' => 'login'));
//     } elseif (empty($res)) {
//         echo json_encode(array('code' => 'error', 'msg' => 'Invalid Email'));
//     } else {
//         echo json_encode(array('code' => 'error', 'msg' => 'Invalid Password'));
//     }
// }

// public function checkuserpassword()
// {
//     $email = $this->input->post('email');
//     $password = $this->input->post('password');
//     $res = $this->Login_Model->login($email);
//     if (!empty($res)) {
//         $hashedPassword = $res[0]['Password'];
//         if (password_verify($password, $hashedPassword)) {
//             $this->session->set_userdata('Email', $email);
//             echo json_encode(array('code' => 200, 'msg' => 'login'));
//         } else {
//             echo json_encode(array('code' => 'error', 'msg' => 'Invalid Password'));
//         }
//     } else {
//         echo json_encode(array('code' => 'error', 'msg' => 'Invalid Email'));
//     }
// }


	public function logout(){
		//removing session
		$this->session->unset_userdata('Email');
		redirect(base_url('Login'));
	}
}
