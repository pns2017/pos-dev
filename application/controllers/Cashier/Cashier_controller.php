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
    $this->load->view('template/dashboard_header',$data);
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
      $row[] = $cashier->unit_price;
      $row[] = $cashier->discount;
      $row[] = $cashier->extended;

      //add html for action
      $row[] = '<a class="icon-wrap icon-wrap-xs icon-circle bg-danger" href="javascript:void(0)" title="Cancel" onclick="cancel('."'".$cashier->sku."'".')"><i class="fa fa-times"></i> </a>';
    
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

  public function ajax_add_to_cart()
  {
      $this->_validate();

      // calculate extended
      $extended = $this->input->post('quantity') * $this->input->post('item_unit_price');
      $extended_value = number_format((float)$extended, 2, '.', '');

      $data = array(
              'sku' => $this->input->post('item_sku'),
              'name' => $this->input->post('item_name'),
              'quantity' => $this->input->post('quantity'),
              'unit_price' => $this->input->post('item_unit_price'),
              'discount' => $this->input->post(0),
              'extended' => $this->input->post($extended_value),
          );
      $insert = $this->cashier->save($data);
      echo json_encode(array("status" => TRUE));
  }

  private function _validate()
  {
      $data = array();
      $data['error_string'] = array();
      $data['inputerror'] = array();
      $data['status'] = TRUE;

      // validation for quantity
      if($this->input->post('quantity') == '')
      {
        $data['inputerror'][] = 'quantity';
        $data['error_string'][] = 'Quantity is required';
        $data['status'] = FALSE;
      }
      else
      {
        // if not a number
        if (!is_numeric($this->input->post('quantity')))
        {
          $data['inputerror'][] = 'quantity';
          $data['error_string'][] = 'Quantity should be a number';
          $data['status'] = FALSE;  
        }
        else
        {
          // if not int
          if (!is_int($this->input->post('quantity') + 0))
          {
            $data['inputerror'][] = 'quantity';
            $data['error_string'][] = 'Quantity should be an integer';
            $data['status'] = FALSE;  
          }
          else
          {
            // if equal to 0
            if ($this->input->post('quantity') == 0)
            {
              $data['inputerror'][] = 'quantity';
              $data['error_string'][] = 'Quantity should not be equal to 0';
              $data['status'] = FALSE;  
            }
            // if more than 0 (positive value)
            else
            {
              // validate if allowed (stock out should not be greater than the current in stock value)
              $in_stock = $this->inventory->get_in_stock($this->input->post('item_sku'));

              // if greater than the current in stock value
              if ($this->input->post('quantity') > $in_stock)
              {
                $data['inputerror'][] = 'quantity';
                $data['error_string'][] = 'Quantity should not be greater than the current In Stock value';
                $data['status'] = FALSE;  
              }             
            }
          }
        }
      }

      if($data['status'] === FALSE)
      {
          echo json_encode($data);
          exit();
      }
  }
}
