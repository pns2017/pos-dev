<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

   public function index()
   {
   	  $data['title'] = "Sales";
      $this->load->view('template/dashboard_header', $data);
      $this->load->view('template/dashboard_sidebar');
      $this->load->view('sales/sales_view');
      $this->load->view('template/dashboard_footer');
   }
}
