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






	public function insert_user($data=array())
	{
		$result= $this->db->insert('tbl_user_details',$data);
		return $this->db->insert_id();
	}
	public function update_user($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('tbl_user_details',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	
	public function insert_area($data=array())
	{
		$result= $this->db->insert('area_master',$data);
		return $result;
	}
	public function update_area($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('area_master',$data);
		return $result;
	}
	
	public function insert_service_category($data=array())
	{
		$result= $this->db->insert('tbl_service_categories',$data);
		return $result;
	}
	public function update_service_category($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('tbl_service_categories',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function insert_subservice_category($data=array())
	{
		$result= $this->db->insert('tbl_sub_service_categories',$data);
		return $result;
	}
	public function update_subservice_category($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('tbl_sub_service_categories',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function insert_master_category($data=array())
	{
		$result= $this->db->insert('tbl_food_category_master',$data);
		return $result;
	}
	public function update_master_category($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('tbl_food_category_master',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
		
	}
	public function insert_pomo_deals($data=array())
	{
		$result= $this->db->insert('tbl_food_deals',$data);
		return $result;
	}
	public function update_pomo_deals($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('tbl_food_deals',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
		
	}
	
	public function insert_grocery_category($data=array())
	{
		$result= $this->db->insert('tbl_grocery_categories',$data);
		return $result;
	}
	public function update_grocery_category($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('tbl_grocery_categories',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
		
	}
	public function insert_restaurant($data=array())
	{
		$result= $this->db->insert('tbl_restaurant_details',$data);
		return $result;
	}
	public function update_restaurant($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('tbl_restaurant_details',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	
	public function insert_restaurant_product($data=array())
	{
		$result= $this->db->insert('tbl_food_products',$data);
		return $this->db->insert_id();
	}
	public function update_restaurant_product($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('tbl_food_products',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function insert_grocery_product($data=array())
	{
		$result= $this->db->insert('tbl_grocery_products',$data);
		return $this->db->insert_id();
	}
	public function update_grocery_product($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('tbl_grocery_products',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function insert_restaurant_addons($data=array())
	{
		if($data)
		{
		$result= $this->db->insert('tbl_food_addons',$data);
		return $this->db->insert_id();
	
		}
	}
	public function update_restaurant_addons($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('tbl_food_addons',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function insert_product_secondary($data=array())
        {
            $result= $this->db->insert('product_secondary_details',$data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        public function update_product_secondary($data=array())
        {
            $this->db->where('id', $data['id']);
            $result= $this->db->update('product_secondary_details',$data);
            return $result;
        }
	
        public function update_product_visibility($data=array())
        {
            $this->db->where('id', $data['id']);
            $result= $this->db->update('product_details',$data);
            return $result;
        }
        public function delete_product_secondary($data=array())
        {
            if($data)
            {
                $delids=implode(",",$data['delids']);
                $this->db->query("update product_secondary_details set status='Deleted' where id NOT IN (".$delids.") and product_id=".$data['product_id']);
            }
        }
	public function insert_slider($data=array())
	{
		$result= $this->db->insert('tbl_slider_details',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function update_slider($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('tbl_slider_details',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function insert_offer($data=array())
	{
		$result= $this->db->insert('tbl_offer_details',$data);
		return $this->db->insert_id();
	}
	public function update_offer($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('tbl_offer_details',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function insert_addon($data=array())
	{
		$result= $this->db->insert('addon_details',$data);
		return $result;
	}
	public function update_addon($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('addon_details',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function insert_variants($data=array())
	{
		$result= $this->db->insert('tbl_variants_master',$data);
		return $result;
	}
	public function update_variants($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('tbl_variants_master',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	
	public function insert_promocode($data=array())
	{
		$result= $this->db->insert('promocode_details',$data);
		return $result;
	}
	public function update_promocode($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('promocode_details',$data);
		return $result;
	}
	public function check_promocode($promo_code)
	{
		$result   = $this->db->where(array('promo_code'=>$promo_code))->get('promocode_details')->result_array();
		if( count($result) > 0)
		{
		   return 1;
		}
		else
		{
			return 0;
		}
	}
	public function check_user_exist($username,$password,$allowedroles)
	{
      
	$query=$this->db->query("select * from tbl_user_details where username='$username' and password='$password' and role in (".$allowedroles.")");
	$result=$query->row();
	if($result)
	{   
	$userdata=array(
		  
			'pomo_username'=>$result->username,
			'pomo_display_name'=>$result->name,
			'pomo_email_id'=>$result->email_id,
			'pomo_role'=>$result->role,
			'pomo_latitude'=>$result->loc_latitude,
			'pomo_longitude'=>$result->loc_longitude
	);

	$this->session->set_userdata('userdata',$userdata);
	$this->session->set_userdata('user_id',$result->id);
  
	return 1;
	}
	else
	{
	return 0;
	}
	}
	
	public function get_arealist()
	{
		$data=array();
		$query   = $this->db->query("SELECT id,name FROM area_master where status !='Deleted'");
		$results = $query->result();
		if($results)
		{
		foreach ($results as $row)
		{
		$data[$row->id]=$row->name;
		}
		}
	   return $data;

	}
	

	public function get_name($id,$table)
	{
		$this->db->select('name')
        ->from($table)
        ->where('id',$id); 
		$result=$this->db->get()->row();
		
		if($result)
		return $result->name;
		else
		return null;
	}

	public function get_dashboard_count()
	{
		$result=array();
		$qry=$this->db->query("select count(*) as total_order,
		count(if(order_type='food',1,null)) as food_order,
		count(if(order_type='grocery',1,null)) as grocery_order,
		count(if(order_type='service',1,null)) as service_order
		from tbl_order_details");
		$result=$qry->row();
		/* $qry=$this->db->query("select count(*) as boys from delivery_boy_details where status !='Deleted'");
		$result->boys=($qry->row())->boys; */
		return $result;
	}

	public function get_service_dashcount($type)
	{
		$result=array();
		if($type=='service')
		{
			$qry=$this->db->query("select count(*) as total_order,
			count(if(status='6',1,null)) as request_confirmed,
			count(if(status='8',1,null)) as request_completed,
			count(if(status='10',1,null)) as request_cancelled
			from tbl_order_details where order_type='".$type."'");
		}
		else if($type=='food')
		{
			$qry=$this->db->query("select count(*) as total_order,
			count(if(status='1',1,null)) as order_confirmed,
			count(if(status='9',1,null)) as cancelled_order,
			count(if(status='4',1,null)) as delivered
			from tbl_order_details where order_type='".$type."'");
		}
		else if($type=='grocery')
		{
			$qry=$this->db->query("select count(*) as total_order,
			count(if(status='1',1,null)) as order_confirmed,
			count(if(status='9',1,null)) as cancelled_order,
			count(if(status='4',1,null)) as delivered
			from tbl_order_details where order_type='".$type."'");
		}
		
		$result=$qry->row();
		/* $qry=$this->db->query("select count(*) as boys from delivery_boy_details where status !='Deleted'");
		$result->boys=($qry->row())->boys; */
		return $result;
	}

	public function update_promocode_status($data="")
	{
		if($data)
		{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('promocode_details',$data);
		return $result; 
		}
	}
	public function get_single_view($data=array())
	{
		$result=array();
		if($data)
		{
		if($data['type']=='products' || $data['type']=='customer' || $data['type']=='agent')
		{
			$this->db->where($data['where'][0]);
			$this->db->select($data['columnlist'][0]);
			$query = $this->db->get($data['table'][0]);
			$result['data']=$query->result();

		   
		   

			$this->db->where($data['where'][1]);
			$this->db->select($data['columnlist'][1]);
			$query = $this->db->get($data['table'][1]);
			$result['data2']=$query->result();

		   /*  print_r($result['data2']); exit; */
		   

		}  
		else
		{ 
			$this->db->where($data['where']);
			$this->db->select($data['columnlist']);
			$query = $this->db->get($data['table']);
			$result['data']=$query->result();
		  
		}
		}
	  
		return $result;
	}
	public function get_single_customer($customerid)
	{
		$query=$this->db->query("select * from customer_details where user_id='".$customerid."' and status !='Deleted'");
		$results=$query->result();
		return $results;
	}
	public function get_customer_name($customerid)
	{
		$query=$this->db->query("select concat(first_name,' ',last_name) as name from customer_details where id=".$customerid." and status !='Deleted'");
		$results=$query->row();
		return $results->name;
	}
	/* 	public function get_agent_name($id)
	{
		$query   = $this->db->query("SELECT concat(first_name,' ',last_name) as name from agent_details where id=$id");
		$results = $query->row();
		if($results)
		{
			return $results->name;
		}
		else
		{
			return null;
		}

	} */
	public function get_single_agent($agentid)
	{
		$query=$this->db->query("select * from agent_details where user_id=".$agentid." and status !='Deleted'");
		$results=$query->result();
		return $results;
	}
	public function get_display_name($user_id)
	{
		$query   = $this->db->query("SELECT display_name as name from user_details where id='$user_id'");
		$results = $query->row();
		if($results)
		{
			return $results->name;
		}
		else
		{
			return null;
		}

	}
	public function get_single_order($order_id)
	{
		$data=array();
		$data['order_details']  = $this->db->select("*")->from('tbl_order_details')->where('id',$order_id)->get()->row();
		if($data['order_details'])
		{
			$data['customer_details']=$this->db->select('*')->from('tbl_user_details')->where('id',$data['order_details']->customer_id)->get()->row();
			if($data['order_details']->order_type !='service')
			{
			$data['shipping_details']=$this->db->select('*')->from('tbl_user_address_details')->where('user_id',$data['order_details']->customer_id)->where('id',$data['order_details']->customer_address)->get()->row();
			$data['item_details']=$this->site_model->get_ordered_items($order_id);
			}
			else
			{
				$data['order_details']->sub_service_id=$this->get_name($data['order_details']->sub_service_id,'tbl_sub_service_categories');
			}

			$data['status']=$this->get_status_name($data['order_details']->status);
			$data['status_list']=$this->get_status_list($data['order_details']->order_type);
			
		if($data['order_details']->order_type=="food")
		{
		foreach($data['item_details'] as $index=>$value)
		{
			$value->restaurant_id=$this->get_name($value->restaurant_id,'tbl_restaurant_details');
		}
		}
		}
		
		
	
		return $data;
	}
	public function get_status_list($type)
	{
		if($type=='service')
		{
			$where=" where type='service'";
		}
		else if($type=="all")
		{
			$where="";
		}
		else
		{
			$where=" where type !='service'";
		}
		$query   = $this->db->query("SELECT id,name from tbl_status_master $where order by priority");
		$results = $query->result();
		return $results;
	}
	public function get_statusupdate_list($order_id)
	{
		$query   = $this->db->query("SELECT tbl_order_status_update.status_id,tbl_order_status_update.updated_on,tbl_status_master.name from tbl_order_status_update join tbl_status_master on tbl_status_master.id=tbl_order_status_update.status_id where tbl_order_status_update.order_id=$order_id order by tbl_status_master.priority");
		$results = $query->result();
		return $results;
	}
	public function delete_item($data=array())
	{
		if(is_array($data['table']))
		{
			foreach($data['table'] as $index=>$value)
			{
			$this->db->where($value, $data['id']);
			$result= $this->db->update($index,array('status'=>'Deleted'));
			}
		}
		else
		{
		$this->db->where('id', $data['id']);
		$result= $this->db->update($data['table'],array('status'=>'Deleted'));
		}
		return $result;

	}
	public function update_product_status($data)
	{
		$this->db->where('id', $data['id']); 
		$this->db->update('product_details', array('status'=>$data['status']));
	}

	public function update_service_request($data)
	{
		$this->db->where('id', $data['id']); 
		$this->db->update('tbl_order_details', $data);	
		if($this->db->affected_rows() >= 0)
		return 1;
		else
		return 0;
	}
	public  function get_order_count()
    {
        $result=$this->db->query("select count(*) as order_count from tbl_order_details" )->row();
       
        return $result->order_count;
    }


	public function check_user_email_exist($email="")
	{
		   $query=$this->db->query("select id from tbl_user_details where email_id='".$email."'");
		   $results=$query->row();
		   if($results)
		   {
				   return 1;
		   }
		   else
		   {
				   return 0;
		   }
	}
	public function check_username_exist($username="")
	{
		   $query=$this->db->query("select id from tbl_user_details where username='".$username."'");
		   $results=$query->row();
		   if($results)
		   {
				   return 1;
		   }
		   else
		   {
				   return 0;
		   }
	}
	public function check_mobile_exist($mobile="")
	{
		   $query=$this->db->query("select id from tbl_user_details where mobile='".$mobile."'");
		   $results=$query->row();
		   if($results)
		   {
				   return 1;
		   }
		   else
		   {
				   return 0;
		   }
	}
	public function delete_user($user_id,$role,$other_table="")
	{
		$sucess=1;
		$this->db->trans_start();
		$query=$this->db->query("update  user_details set status='Deleted' where id=".$user_id." and role='".$role."'");
		if($this->db->affected_rows()>0)
		{
			$sucess=1;
		}
		else
		{
			$sucess=0;
		}
		
		if($other_table)
		{
			$query=$this->db->query("update  ".$other_table." set status='Deleted' where user_id=".$user_id);
			if($this->db->affected_rows() >0)
			{
				$sucess=1;
			}
			else
			{
				$sucess=0;
			}
			
		}
		$this->db->trans_complete();
		echo $sucess;
		
	}
	public function update_order_details($data=array())
	{
		$this->db->where('id', $data['id']);
		$this->db->update('tbl_order_details', array('status'=>$data['status']));
	}
	public function update_order_status($data=array())
	{
		$this->db->where('id', $data['id']);
		$this->db->update('tbl_order_details', array('status'=>$data['status']));
		if($data['status']==8 || $data['status']==4)
		{
        $this->db->query("UPDATE tbl_user_coindetails
		JOIN tbl_order_details
		ON tbl_user_coindetails.user_id = tbl_order_details.customer_id
 SET    tbl_user_coindetails.coin_count = tbl_user_coindetails.coin_count+tbl_order_details.pomo_coins
 WHERE tbl_order_details.id=".$data['id']);
		}
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function  get_carted_product_list($order_id)
	{
	$query   = $this->db->query("SELECT id,cart_id,product_image,product_id,product_name,product_count,product_price,product_total,type from carted_item_details where order_id=$order_id");

	$data = $query->result();
	return $data;
	}

	public function get_all_customers($agent_id="")
	{
		$extrawhere="";
		if($agent_id !="")
		{
			$extrawhere=" and agent_id=".$agent_id;
		}
		$query=$this->db->query("SELECT user_id,concat(first_name,' ',last_name) as name from customer_details where status !='Deleted' $extrawhere");
		$results=$query->result();
		return $results;
	}
	
	public function get_order_report($data=array())
	{
		if(!$data)
		{
		$query1=$this->db->query("select sum(order_total) as total,sum(cart_total) as subtotal,sum(tax_amount) as tax_amount,sum(discount) as discount,COUNT(*) as count from tbl_order_details WHERE status='4' limit 100");
		$query2=$this->db->query("select id,order_no,customer_id,agent_id,items,area,discount,tax_amount,cart_total,order_total,order_time,payment_type from tbl_order_details where status='4' limit 100");
		}
		else
		{
		   
			$where="status='4'";
			if($data['from']=="")
			{
				$data['from']=date("Y-m-d");
			}
		  
			if($data['to']=="")
			{
				$data['to']=date("Y-m-d");
			}
		  
			$where="status='4' and (order_time BETWEEN '".$data['from']."%' AND '".$data['to']."%')";
			if($data['agent_id'] !="")
			{
			$where=$where." and agent_id=".$data['agent_id'];    
			}
			if($data['customer_id'] !="")
			{
			$where=$where." and customer_id=".$data['customer_id'];    
			}
			if($data['payment_type'] !="")
			{
			$where=$where." and payment_type='".$data['payment_type']."'";    
			}
			$query1=$this->db->query("select sum(order_total) as total,sum(cart_total) as subtotal,sum(tax_amount) as tax_amount,sum(discount) as discount,COUNT(*) as count from tbl_order_details WHERE $where  limit 100");
			$query2=$this->db->query("select id,order_no,customer_id,agent_id,items,area,discount,tax_amount,cart_total,order_total,order_time,payment_type from tbl_order_details where $where limit 100");
		}
		$results['ordertotals'] = $query1->result();
		$results['orderlists']=$query2->result();
		if($results['orderlists'])
		{
			foreach($results['orderlists'] as $index=>$value)
		{
			$value->customer_name=$this->get_display_name($value->customer_id);
			if($value->agent_id !=1)
			{
			$value->agent_name=$this->get_display_name($value->agent_id);
			}
			else
			{
				$value->agent_name='Admin';	
			}
			
			if($value->items !='')
		{
			$items=json_decode($value->items);
			$array=array();
			$i=0;
			foreach($items as $item)
			{
				$array[$i]=$item->name;
				$i++;
			}
			$items=array_unique($array);
			$value->items=$items;
		}
		}
		}
		return $results;
	}
	public function get_collection_report($data=array(),$agent_id="")
	{
		$where="";
		if($agent_id !="")
		{
			$where=" and customer_details.agent_id=".$agent_id;
		}
		if(!$data)
		{
		$query1=$this->db->query("select sum(customer_details.payment_amount) as received,sum(package_details.offer_price) as total,sum(package_details.offer_price) - sum(customer_details.payment_amount) as pending from customer_details join package_details on package_details.id=customer_details.package_id  WHERE customer_details.status !='Deleted' $where limit 100 ");

		$query2=$this->db->query("select customer_details.id,customer_details.user_id,customer_details.payment_amount,customer_details.payment_status,package_details.offer_price from customer_details join package_details on package_details.id=customer_details.package_id where customer_details.status !='Deleted'$where limit 100 ");
		}
		else
		{
		   
			$where="customer_details.status !='Deleted'";
			if($data['from']=="")
			{
				$data['from']=date("Y-m-d");
			}
		  
			if($data['to']=="")
			{
				$data['to']=date("Y-m-d");
			}
		  
			$where="customer_details.status !='Deleted' and (customer_details.created_on BETWEEN '".$data['from']."%' AND '".$data['to']."%')";
			if($data['agent_id'] !="")
			{
			$where=$where." and customer_details.agent_id=".$data['agent_id'];    
			}
			
			$query1=$this->db->query("select sum(customer_details.payment_amount) as received,sum(package_details.offer_price) as total,sum(package_details.offer_price) - sum(customer_details.payment_amount) as pending from customer_details join package_details on package_details.id=customer_details.package_id  WHERE $where limit 100");
			$query2=$this->db->query("select customer_details.id,customer_details.user_id,customer_details.payment_amount,customer_details.payment_status,package_details.offer_price from customer_details join package_details on package_details.id=customer_details.package_id where $where limit 100");
		}
		$results['colltotals'] = $query1->result();
		$results['collectionlist']=$query2->result();
		if($results['collectionlist'])
		{
			foreach($results['collectionlist'] as $index=>$value)
		{
			$value->customer_name=$this->get_display_name($value->user_id);
		
		}
		}
		return $results;
	
	}
	public function get_customer_report($data=array())
	{
		
		if(!$data)
		{
		$query=$this->db->query("select * , concat(first_name,' ',last_name) as name  from customer_details where status !='Deleted' limit 100");
		}
		else
		{
			$where="status !='Deleted'";
			if($data['from']=="")
			{
				$data['from']=date("Y-m-d");
			}
		  
			if($data['to']=="")
			{
				$data['to']=date("Y-m-d");
			}
		  
			$where=$where." and (created_on BETWEEN '".$data['from']."%' AND '".$data['to']."%')";
		
			if($data['customer_id'] !="")
			{
			$where=" status !='Deleted' and user_id=".$data['customer_id'];    
			}
			
			$query=$this->db->query("select *, concat(first_name,' ',last_name) as name from customer_details where $where limit 100");
		}
		$results['customerlist']=$query->result();
		
		if($results['customerlist'])
		{
			foreach($results['customerlist'] as $index=>$value)
		{
			if($value->agent_id !=1)
			{
			$value->agent_name=$this->get_display_name($value->agent_id);
			}
			else
			{
				$value->agent_name='Admin';	
			}
			if($value->area_id != "")
			{
				//$value->area_id=$this->get_area_name($value->area_id);
			}
			
		}
		}
		return $results;
	}
	
	public function change_status($data=array())
	{
		$this->db->trans_start();
		foreach($data['ids'] as $ids)
		{
			$this->db->query('UPDATE tbl_'.$data['table'].'  SET '.$data['col'].'= IF(
			'.$data['col'].' =1, 0,1) WHERE id = '.$ids);
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			return 0;
		}
		else
		{
		return 1;
		}	
		
	}
	public function update_visibility($data=array())
	{
		$this->db->trans_start();
		foreach($data['ids'] as $ids)
		{
			$this->db->query('UPDATE tbl_'.$data['table'].'  SET visibility='.$data['col'].' WHERE id = '.$ids);
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			return 0;
		}
		else
		{
		return 1;
		}	
	}
	

	public function get_status_name($statusid)
	{
		$result="";
		if($statusid)
		{
		$result=$this->db->select('name')->from('tbl_status_master')->where('id',$statusid)->get()->row()->name;
		}
		return $result;
	}


}