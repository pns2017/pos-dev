<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashier_controller extends CI_Controller {

 public function index()
   { 	
    // $user = $this->session->username;
    // if($user == ''){
    //     redirect('/');
    // }
    // else{

   	  $this->load->helper('url');							
   													
   	  $data['title'] = 'Transaction Page';					
      $this->load->view('template/dashboard_header');
      $this->load->view('transaction/transaction_view',$data);   
      $this->load->view('template/dashboard_navigation');
      $this->load->view('template/dashboard_footer');
    // }
   }
}
