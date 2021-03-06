<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashier_model extends CI_Model {

	var $table = 'cashier';
	var $column_order = array('sku','name','quantity','unit_price','discount','extended',null); //set column field database for datatable orderable
	var $column_search = array('sku','name'); //set column field database for datatable searchable those included are searchable
	var $order = array('id' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		return $query->result();
	}

	// check for duplicates in the database table for validation - sku
    function get_duplicates($sku)
    {   
        $this->db->from($this->table);
        $this->db->where('sku',$sku);

        $query = $this->db->get();

        return $query;
    }

    // get current quantity of an item for validation
	function get_quantity($sku)
	{
		$this->db->select('quantity');
		$this->db->from($this->table);
		$this->db->where('sku',$sku);
		$query = $this->db->get();

		$row = $query->row();

		return $row->quantity;
	}

	// get subtotal of items in the cart
	function get_subtotal()
	{
	    $this->db->select_sum('extended');
	    $this->db->from($this->table);
	    $query = $this->db->get();

	    $extended = $query->row()->extended;

	    if ($extended != '')
	    {
			$extended = '$ ' . number_format($extended, 2, '.', ',');	    	
	    }

	    return $extended;
	}

	// get total number of items in the cart 
	function get_total_items()
	{
	    $this->db->select_sum('quantity');
	    $this->db->from($this->table);
	    $query = $this->db->get();

	    return $query->row()->quantity;
	}

	function count_filtered()
	{
        $this->_get_datatables_query();

        $query = $this->db->get();
        return $query->num_rows();		
	}

	public function count_all()
	{
        $this->db->from($this->table);
        return $this->db->count_all_results();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	// update quantity and extended
	public function update($sku, $quantity, $extended)
	{
		$this->db->where('sku',$sku);
		$this->db->set('quantity', 'quantity + ' . (int) $quantity, FALSE);
		$this->db->set('extended', 'extended + ' . (int) $extended, FALSE);
		$this->db->update($this->table);

		return $this->db->affected_rows();
	}

	public function delete_by_id($sku)
	{
		$this->db->where('sku', $sku);
		$this->db->delete($this->table);
	}

	public function truncate_cashier()
	{
		$this->db->from($this->table);
		$this->db->truncate(); 
	}
}
