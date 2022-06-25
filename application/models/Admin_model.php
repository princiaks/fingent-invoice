<?php 
class Admin_model extends CI_Model{	

	public function __construct(){ 
		$this->load->database();
	}
	public function add_products($data=array())
	{
		$this->db->trans_start();
		//$this->db->empty_table('tbl_delivery_charge_master'); 
		foreach($data as $insdata)
		{
			$this->db->insert('tbl_item_details',$insdata);
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
			return 0;
		else
		return 1;
	}

	public function get_lists($table,$columns,$limit="",$orderby="")
	{
		if($limit !="")
		{
			$limit='limit '.$limit;
		}
		if($orderby=="")
		{
			$orderby=' order by created_on desc';
		}
	  
		$query   = $this->db->query("SELECT $columns from $table where status != 'Deleted' $orderby $limit");
		$results = $query->result();
		return $results;
	}

}