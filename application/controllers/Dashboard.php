<?php

defined ('BASEPATH') OR exit('No direct Script access allowed');

Class Dashboard extends CI_Controller{
    public function __construct(){
        parent :: __construct();
        $this->load->model('Dashboard_Model');
    }



    public function index(){
        $this->load->view('Dashboard.php');
}



// public function index(){
//     $this->load->view('Itemmaster.php');
// }



}


























?>