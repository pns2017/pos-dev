<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashier_controller extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('inventory/inventory_model','inventory');
    $this->load->model('customers/customers_model','customers');

    $this->load->model('cashier/cashier_model','cashier');
  }

  public function index()
  { 	
    // $user = $this->session->username;
    // if($user == ''){
    //     redirect('/');
    // }
    // else{
    

    // get products list (SKU and product name) for dropdown on the add stock form
    $data['inventory'] = $this->inventory->get_products_list();
    $data['customers'] = $this->customers->get_customers_list();

    $this->load->helper('url');							
    									
    $data['title'] = 'Transaction Page';					
    $this->load->view('template/dashboard_header');
    $this->load->view('transaction/transaction_view',$data);   
    $this->load->view('template/dashboard_navigation');
    $this->load->view('template/dashboard_footer');
    // }
  }

  public function ajax_list()
  {
    $list = $this->cashier->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $cashier) {
      $no++;
      $row = array();
      $row[] = $cashier->sku;
      $row[] = $cashier->name;
      $row[] = $cashier->quantity;
      $row[] = $cashier->discount;
      $row[] = $cashier->extended;

      //add html for action
      $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Cancel" onclick="cancel('."'".$cashier->sku."'".')"><i class="fa fa-eye"></i> </a>';
    
      $data[] = $row;
    }

    $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->cashier->count_all(),
            "recordsFiltered" => $this->cashier->count_filtered(),
            "data" => $data,
        );
    //output to json format
    echo json_encode($output);
  }
}
