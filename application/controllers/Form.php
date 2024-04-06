<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Form extends CI_Controller{

function __construct(){
    parent::__construct();
		$this->load->model('Form_Model');
}


public function index(){
    // $this->load->view('include/header_1');
    
    // $this->load->view('mosh/mosh_nav.php');
    
    // $this->load->view('include/footer_1');
    $this->load->view('mosh/mosh_header.php');
    $this->load->view('mosh/mosh_nav.php');
    $this->load->view('form/form');  
    $this->load->view('mosh/mosh_footer.php');
    
}









}

?>