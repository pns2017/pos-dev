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
      $row[] = '<a class="icon-wrap icon-wrap-xs icon-circle bg-danger" href="javascript:void(0)" title="Cancel" onclick="cancel_item('."'".$cashier->sku."'".')"><i class="fa fa-times"></i> </a>';
    
      $data[] = $row;
    }

    // get item count to update
    $item_count = $this->cashier->get_total_items();

    // get subtotal to update
    $subtotal = $this->cashier->get_subtotal();

    $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->cashier->count_all(),
            "recordsFiltered" => $this->cashier->count_filtered(),
            "data" => $data,

            // item count and subtotal inserted into output array
            "subtotal" => $subtotal, 
            "item_count" => $item_count,
        );

    //output to json format
    echo json_encode($output);
  }

  public function ajax_add_to_cart()
  {
      $this->_validate();

      // calculate discount here ---------------------------------------------------------------------------------------

      // calculate extended
      $extended = $this->input->post('quantity') * $this->input->post('item_unit_price');
      $extended_value = number_format((float)$extended, 2, '.', '');

      // check for duplicates
      $duplicates = $this->cashier->get_duplicates($this->input->post('item_sku'));

      // if the sku is already in the cart. just update quantity and extended
      if ($duplicates->num_rows() != 0)
      {
          // add current quantity as well as current extended value
          $this->cashier->update($this->input->post('item_sku'), $this->input->post('quantity'), $extended_value);   
      }
      // if no the same sku found in cart
      else
      {
          $data = array(
              'sku' => $this->input->post('item_sku'),
              'name' => $this->input->post('item_name'),
              'quantity' => $this->input->post('quantity'),
              'unit_price' => $this->input->post('item_unit_price'),
              'discount' => '0',
              'extended' => $extended_value,
          );
          $this->cashier->save($data);
      }

      // get item count to update
      $item_count = $this->cashier->get_total_items();

      // get subtotal to update
      $subtotal = $this->cashier->get_subtotal();


      echo json_encode(array("status" => TRUE, "subtotal" => $subtotal, "item_count" => $item_count));
  }

  // get transaction details when page is reopened with cashier data not removed
  public function ajax_set_transaction()
  {
      // get item count to update
      $item_count = $this->cashier->get_total_items();

      // get subtotal to update
      $subtotal = $this->cashier->get_subtotal();


      echo json_encode(array("status" => TRUE, "subtotal" => $subtotal, "item_count" => $item_count));
  }

  // cancelling an item from cart
  public function ajax_cancel_item($sku)
  {
      $this->cashier->delete_by_id($sku);

      // get item count to update
      $item_count = $this->cashier->get_total_items();

      // get subtotal to update
      $subtotal = $this->cashier->get_subtotal();

      echo json_encode(array("status" => TRUE, "subtotal" => $subtotal, "item_count" => $item_count));
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
              // quantity for items already in cart
              $quantity = 0;
              // check for duplicates
              $duplicates = $this->cashier->get_duplicates($this->input->post('item_sku'));

              // if the sku is already in the cart. get quantity value
              if ($duplicates->num_rows() != 0)
              {
                  $quantity = $this->cashier->get_quantity($this->input->post('item_sku'));
              }

              // validate if allowed (stock out should not be greater than the current in stock value)
              // subtract in stock with the item's quantity already in cart
              $in_stock = $this->inventory->get_in_stock($this->input->post('item_sku'));

              // if greater than the current in stock value
              if ($this->input->post('quantity') > ($in_stock - $quantity))
              {
                $data['inputerror'][] = 'quantity';
                $data['error_string'][] = 'Item quantity to purchase should not be greater than the current In Stock value. If not, check cart for the same item.';
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
