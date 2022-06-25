<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct()
    {
        parent::__construct();
        $data = array();

		$this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->database();
        $this->load->model('admin_model');	 
		
     }

     public function index()
     {
	
		$this->load->view('admin/header');
		$this->load->view('admin/navbar');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');
		
     }
	
	 public function item_list()
	 {
		$data=array();
		$table_name='tbl_item_details';
		$columns='*';
		$data['itemlist']=$this->admin_model->get_lists($table_name,$columns);
		$this->load->view('admin/header');
		//$this->load->view('admin/navbar');
		$this->load->view('admin/itemlist',$data);
		$this->load->view('admin/footer');

	 }

	 public function add_products()
	 {
		 $data=array();
		 $products=$this->input->post();
		 for($i=0;$i<count($products['name']);$i++)
		 {
			 $data[$i]['name']=$products['name'][$i];
			 $data[$i]['quantity']=$products['quantity'][$i];
			 $data[$i]['price']=$products['price'][$i];
			 $data[$i]['tax']=$products['tax'][$i];
			 $data[$i]['actualtotal']=floatval($products['quantity'][$i]*$products['price'][$i]);
			 $tax=  floatval($data[$i]['actualtotal']*$data[$i]['tax']/100);
			 $data[$i]['taxvalue']=$tax;
			 $data[$i]['total']= floatval($data[$i]['actualtotal']+$tax);
			
		 }
		 $result=$this->admin_model->add_products($data);
		 $response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Adding Item(s) Failed','redirect'=>'');
		 if($result)
		 $response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Item(s) Added Successfully','redirect'=>'adminpanel');
		 echo json_encode($response);
	 }




	 ////////////////////////////////////
	 public function user_login()
	 {
		 $username=$this->input->post('username');
		 $password=$this->input->post('password');
	 
		 $sucess=$this->admin_model->check_user_exist($username,md5($password),"'admin','franchise_admin'");
		 if($sucess==1)
		 {
 
			 $response=array('success'=>$sucess,'redirect_url'=>base_url().'adminpanel/dashboard');
		 }
		 else
		 {
			 $response=array('success'=>$sucess,'redirect_url'=>'');
		 }
		 echo json_encode($response);
		 die();
	 }
	
	 public function logout()
	 {
		 $user_data = $this->session->all_userdata();
		 foreach ($user_data as $key => $value) {
				 $this->session->unset_userdata($key);
		 }
		 $this->session->sess_destroy();
		 redirect('adminpanel');
	 }
	 public function dashboard()
	 {
		$customer_address=array();
		$count=$this->admin_model->get_dashboard_count();
		$table_name='tbl_order_details';
		$columns='id,customer_id,order_time,order_total,status,order_type,delivery_boy_id,request_address,customer_address';
		$limit=20;
		$list=$this->admin_model->get_lists($table_name,$columns,$limit);
		foreach($list as $index=>$value)
		{
			
			$value->status=$this->admin_model->get_status_name($value->status);
			$value->customer_details=$this->site_model->get_single_item_withid('*',$value->customer_id,'tbl_user_details');
			/* if($value->order_type =='service')
			{
				$value->customer_address=$value->request_address;
			}
			else
			{
				$customer_address=$this->site_model->get_user_address($value->customer_id,$value->customer_address);
				if($customer_address)
				{
					$value->customer_address=$customer_address->address;	
				}
			} */

		}
		
		$data['order_list']=$list;
		$data['dash_count']=$count;
		$this->load->view('admin/header');
		$this->load->view('admin/navbar');
		$this->load->view('admin/dashboard',$data);
		$this->load->view('admin/footer'); 
	 }
	 
	 public function get_order_count()
	{
		$order_count=$this->admin_model->get_order_count();
		$this->session->set_userdata('neworder',0);
		if($this->session->userdata('order_count'))
		{
			if($order_count > $this->session->userdata('order_count'))
			{
				$this->session->set_userdata('order_count',$order_count);
				$this->session->set_userdata('neworder',1);
				echo 1;
			}
			else
			{
				echo 0;
			}

		}
		else{
			$this->session->set_userdata('order_count',$order_count);
		}
		
		
	}

	 public function service_page($page_name,$id="",$param1="",$param2="")
	 {
		$data=array();
		if($id)
		{
			$id=$id;
		}
		if($page_name=='add-service-category')
		{
			if($id != "")
			{
			$single['table']='tbl_service_categories';
			$single['columnlist']='*';
			$single['where']='id='.$id;	
			$single['type']='servicecategory';
			$data['update']=$this->admin_model->get_single_view($single);
			}
			 $table_name='tbl_service_categories';
			 $columns='id,name,image_url,link';
			 $limit=1000;
			 $data['servicecategorylist']=$this->admin_model->get_lists($table_name,$columns,$limit);
		}
		else if($page_name=='add-subservice-category')
		{
			if($id != "")
			{
			$single['table']='tbl_sub_service_categories';
			$single['columnlist']='*';
			$single['where']='id='.$id;	
			$single['type']='subservicecategory';
			$data['update']=$this->admin_model->get_single_view($single);
			}
			$table_name='tbl_service_categories';
			$columns='id,name';
			$limit=100;
			$where=" and sub_service_status=1";
			$data['servicecategories']=$this->admin_model->get_lists($table_name,$columns,$limit,$where);
			 $table_name='tbl_sub_service_categories';
			 $columns='id,service_category_id,name,image_url,link';
			 $limit=100;
			 $data['subservicecategorylist']=$this->admin_model->get_lists($table_name,$columns,$limit);
			 if($data['subservicecategorylist'])
			 {
				 foreach($data['subservicecategorylist'] as $index=>$value)
				 {
					$value->service_category_id=$this->admin_model->get_name($value->service_category_id,'tbl_service_categories');
				 }
			 }
		}
		
		$this->load->view('admin/header');
		$this->load->view('admin/navbar');
		$this->load->view('admin/'.$page_name,$data);
		$this->load->view('admin/footer');
	 }
	 public function food_page($page_name,$id="",$param1="",$param2="")
	 {
		$data=array();
		if($id)
		{
			$id=$id;
		}
		if($page_name=='add-master-category')
		{
			if($id != "")
			{
			$single['table']='tbl_food_category_master';
			$single['columnlist']='*';
			$single['where']='id='.$id;	
			$single['type']='foodmastercategory';
			$data['update']=$this->admin_model->get_single_view($single);
			}
			 $table_name='tbl_food_category_master';
			 $columns='id,name,image_url';
			 $limit=100;
			 $data['mastercategorylist']=$this->admin_model->get_lists($table_name,$columns,$limit);
		}
		
		else if($page_name=='add-restaurant')
		{
			if($id != "")
			{
			$single['table']='tbl_restaurant_details';
			$single['columnlist']='*';
			$single['where']='id='.$id;	
			$single['type']='restaurant';
			$data['update']=$this->admin_model->get_single_view($single);
			}
			$table_name='tbl_restaurant_details';
			$columns='id,name';
			$data['restaurantslist']=$this->admin_model->get_lists($table_name,$columns);
			
		}
		else if($page_name=="restaurants-list")
		{
			$table_name='tbl_restaurant_details';
			$columns='*';
			$limit=100;
			$orderby='ORDER BY field(featured_status,1) DESC';
			$data['restaurantslist']=$this->admin_model->get_lists($table_name,$columns,$limit,$orderby);
		}
		else if($page_name=="add-food-variants")
		{
			$data['product_type']='food';
			$page_name='add-variants';
			$data['page_title']="Food Variants";
			if($id != "")
			{
			$single['table']='tbl_variants_master';
			$single['columnlist']='*';
			$single['where']='id='.$id;	
			$single['type']='variants';
			$data['update']=$this->admin_model->get_single_view($single);
			}
			 $table_name='tbl_variants_master';
			 $columns='id,name';
			 $limit=100;
			 $where=" and product_type='food'";
			 $data['variantslist']=$this->admin_model->get_lists($table_name,$columns,$limit,$where);

		}
		else if($page_name=="update-delivery-charge")
		{
			$table_name='tbl_delivery_charge_master';
			$columns='*';
			$data['deliverycharges']=$this->admin_model->get_lists($table_name,$columns);
   
		}
		
		else if($page_name=="add-restaurant-products")
		{

			$data['restaurant_id']="";
			if($id != "")
			{
				$rid=$id;
				if($param1=="update")
				{
					$single['table']='tbl_food_products';
					$single['columnlist']='*';
					$single['where']='id='.$id;	
					$single['type']='foodproducts';
					$data['update']=$this->admin_model->get_single_view($single);
					$data['restaurant_name']=$this->admin_model->get_name($data['update']['data'][0]->restaurant_id,'tbl_restaurant_details');
					$rid=$data['update']['data'][0]->restaurant_id;
				}
				else
				{
					$data['restaurant_id']=$id;
					$data['restaurant_name']=$this->admin_model->get_name($id,'tbl_restaurant_details');
				}
				$table_name='tbl_food_category_master';
				$columns='id,name';
				$data['categories']=$this->admin_model->get_lists($table_name,$columns);
				$table_name='tbl_food_deals';
				$columns='id,name';
				$where=" and deal_type='food'";
				$data['deals']=$this->admin_model->get_lists($table_name,$columns,"",$where);
				$table_name='tbl_food_addons';
				$columns='id,name';
				$where=" and restaurant_id=".$rid;
				$data['addonlist']=$this->admin_model->get_lists($table_name,$columns,'',$where);
			}
			
		}
		else if($page_name=="restaurant-products-list")
		{
			
			if($id != "")
			{
				$data['restaurant_name']=$this->admin_model->get_name($id,'tbl_restaurant_details');
				$data['restaurant_id']=$id;
				$table_name='tbl_food_products';
				$columns='*';
				$limit="";
				$where=" and restaurant_id=".$id;
				$data['foodlist']=$this->admin_model->get_lists($table_name,$columns,$limit,$where);
				foreach($data['foodlist'] as $index=>$value)
				{
					if($value->food_category_id)
					{
						$value->food_category_id=$this->admin_model->get_name($value->food_category_id,'tbl_food_category_master');
					}
					
				}
				
			}
		}
		else if($page_name=="add-restaurant-addons")
		{

			$data['restaurant_id']="";
			if($id != "")
			{
				if($param1=="update")
				{
					$single['table']='tbl_food_addons';
					$single['columnlist']='*';
					$single['where']='id='.$id;	
					$single['type']='foodaddons';
					$data['update']=$this->admin_model->get_single_view($single);
					$data['restaurant_name']=$this->admin_model->get_name($data['update']['data'][0]->restaurant_id,'tbl_restaurant_details');
				}
				else
				{
					$data['restaurant_id']=$id;
					$data['restaurant_name']=$this->admin_model->get_name($id,'tbl_restaurant_details');
				}
			
			}
		}
		else if($page_name=="restaurant-addons-list")
		{
			
			if($id != "")
			{
				$data['restaurant_name']=$this->admin_model->get_name($id,'tbl_restaurant_details');
				$data['restaurant_id']=$id;
				$table_name='tbl_food_addons';
				$columns='*';
				$limit="";
				$where=" and restaurant_id=".$id;
				$data['addonlist']=$this->admin_model->get_lists($table_name,$columns,$limit,$where);
			
			}
		}
		
		
		$this->load->view('admin/header');
		$this->load->view('admin/navbar');
		$this->load->view('admin/'.$page_name,$data);
		$this->load->view('admin/footer');
	 }
	 public function grocery_page($page_name,$id="")
	 {
		 $data=array();
		 if($id)
		 {
			 $id=$id;
		 }
		 if($page_name=="add-grocery-category")
		 {
			if($id != "")
			{
			$single['table']='tbl_grocery_categories';
			$single['columnlist']='*';
			$single['where']='id='.$id;	
			$single['type']='groceryrcategory';
			$data['update']=$this->admin_model->get_single_view($single);
			}
			 $table_name='tbl_grocery_categories';
			 $columns='id,name,image_url';
			 $limit=100;
			 $data['grocerycategorylist']=$this->admin_model->get_lists($table_name,$columns,$limit); 
		 }
		 else if($page_name=="add-measuring-unit")
		 {
			// $data['product_type']='grocery';
			if($id != "")
			{
			$single['table']='tbl_variants_master';
			$single['columnlist']='*';
			$single['where']='id='.$id;	
			$single['type']='variants';
			$data['update']=$this->admin_model->get_single_view($single);
			}
			 $table_name='tbl_variants_master';
			 $columns='id,name';
			 $limit=100;
			//  $where=" and product_type='grocery'";
			 $data['unitlist']=$this->admin_model->get_lists($table_name,$columns,$limit);
		 }
		 else if($page_name=="add-grocery-products")
		 {
			if($id != "")
			{
			$single['table']='tbl_grocery_products';
			$single['columnlist']='*';
			$single['where']='id='.$id;	
			$single['type']='groceryrproduct';
			$data['update']=$this->admin_model->get_single_view($single);
			}
			 $table_name='tbl_grocery_categories';
			 $columns='id,name';
			 $limit="";
			 $data['grocerycategorylist']=$this->admin_model->get_lists($table_name,$columns,$limit); 

			 $table_name='tbl_food_deals';
			$columns='id,name';
			$where=" and deal_type='grocery'";
			$data['deals']=$this->admin_model->get_lists($table_name,$columns,"",$where);
			//  $table_name='tbl_variants_master';
			//  $columns='id,name';
			//  $limit="";
			//  $data['unitlist']=$this->admin_model->get_lists($table_name,$columns,$limit); 

		 }
		 else if($page_name=='grocery-products-list')
		 {
			$table_name='tbl_grocery_products';
			$columns='*';
			$limit="";
			$orderby='ORDER BY field(top_deals_status,1) DESC';
			$data['grocerylist']=$this->admin_model->get_lists($table_name,$columns,$limit,$orderby);
			foreach($data['grocerylist'] as $index=>$value)
				{
					if($value->grocery_category_id)
					{
						$value->grocery_category_id=$this->admin_model->get_name($value->grocery_category_id,'tbl_grocery_categories');
					}
					
				}
		 }
		 $this->load->view('admin/header');
		 $this->load->view('admin/navbar');
		 $this->load->view('admin/'.$page_name,$data);
		 $this->load->view('admin/footer');
	 }
	public function settings_page($page_name,$type="",$id="")
	{
		$data=array();
		if($id)
		{
			$id=$id;
		}
		if($page_name=='add-slider')
		{	$slidertypes=array('main','food','grocery','service');
			if(in_array($type,$slidertypes))
			{
				$data['slider_type']=$type;
			if($id != "")
			{
			$single['table']='tbl_slider_details';
			$single['columnlist']='*';
			$single['where']='id='.$id;	
			$single['type']='slider';
			$data['update']=$this->admin_model->get_single_view($single);
			}
			 $table_name='tbl_slider_details';
			 $columns='*';
			 $limit="";
			 $where=" and slider_type='$type'";
			 $data['sliderlist']=$this->admin_model->get_lists($table_name,$columns,$limit,$where);
			}
			else
			{
				redirect('page_not_found');
			} 
		}
		if($page_name=='add-offers')
		{	$offer_type=array('main','food','grocery','service');
			if(in_array($type,$offer_type))
			{
				$data['offer_type']=$type;
			if($id != "")
			{
			$single['table']='tbl_offer_details';
			$single['columnlist']='*';
			$single['where']='id='.$id;	
			$single['type']='offers';
			$data['update']=$this->admin_model->get_single_view($single);
			}
			 $table_name='tbl_offer_details';
			 $columns='*';
			 $limit="";
			 $where=" and offer_type='$type'";
			 $data['offerlist']=$this->admin_model->get_lists($table_name,$columns,$limit,$where);
			}
			else
			{
				redirect('page_not_found');
			} 
		}
		else if($page_name=='add-pomo-deals')
		{
			$data['deal_type']=$type;
			if($id != "")
			{
			$single['table']='tbl_food_deals';
			$single['columnlist']='*';
			$single['where']='id='.$id;
			$single['type']=$type.'deals';
			$data['update']=$this->admin_model->get_single_view($single);
			}
			 $table_name='tbl_food_deals';
			 $columns='*';
			 $limit=100;
			 $where=" and deal_type='$type'";
			 $data['dealslist']=$this->admin_model->get_lists($table_name,$columns,$limit,$where);
		}
		else if($page_name=='orders')
		{
		$page_name=$type.'-orders';	
		$data['dash_count']=$this->admin_model->get_service_dashcount($type);
			if($id != "")
			{
			$single['table']='tbl_order_details';
			$single['columnlist']='*';
			$single['where']='id='.$id;
			$single['type']=$type.'orders';
			$data['update']=$this->admin_model->get_single_view($single);
			}
			 $table_name='tbl_order_details';
			 $columns='*';
			 $limit=500;
			 $where=" and order_type='$type'  order by created_on desc";
			
			 $data['orderlist']=$this->admin_model->get_lists($table_name,$columns,$limit,$where);
			 if($data['orderlist'])
			 {
				 foreach($data['orderlist'] as $index=>$value)
				 {
					$value->status=$this->admin_model->get_status_name($value->status);
					$value->customer_details=$this->site_model->get_single_item_withid('*',$value->customer_id,'tbl_user_details');
				 }
			 }
		}
		$this->load->view('admin/header');
		$this->load->view('admin/navbar');
		$this->load->view('admin/'.$page_name,$data);
		$this->load->view('admin/footer');
	}
	 
	public function under_construction()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/navbar');
		$this->load->view('admin/under-construction');
		$this->load->view('admin/footer');
	}

public function add_area()
{
		$data=array();
		$data['name']=$this->input->post('name');
		$data['status']=$this->input->post('status');
		$result= $this->admin_model->insert_area($data);
		echo json_encode($result);
}
public function update_area()
{
		$data=array();
		$data['id']=$this->input->post('id');
		$data['name']=$this->input->post('name');
		$data['status']=$this->input->post('status');
		$result= $this->admin_model->update_area($data);
		echo json_encode($result);
}

	public function add_service_category()
	{
			$data['image_url']=$this->image_upload($_FILES['image_url'],'service-category-images','SERCAT');
			$data['name']=$this->input->post('name');
			if($this->input->post('link'))
			$data['link']=strtolower(preg_replace('/[^A-Za-z0-9\-]/', '',str_replace(' ','-',$this->input->post('link'))));
			$data['sub_service_status']=$this->input->post('sub_service_status');
			$data['status']=$this->input->post('status');
			$data['created_by']=$this->session->userdata('user_id');
			$result= $this->admin_model->insert_service_category($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Service Category Adding Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Service Category Added Successfully','redirect'=>'adminpanel/add-service-category');
			echo json_encode($response);
	}
	public function update_service_category()
	{
			if($_FILES['image_url']['name'])
			{
				$data['image_url']=$this->image_upload($_FILES['image_url'],'service-category-images','SERCAT');	
			}
			else
			{
				$data['image_url']=$this->input->post('old_image');
			}
	
			$data['id']=$this->input->post('id');
			$data['name']=$this->input->post('name');
			if($this->input->post('link'))
			$data['link']=strtolower(preg_replace('/[^A-Za-z0-9\-]/', '',str_replace(' ','-',$this->input->post('link'))));
			//$data['link']=strtolower(str_replace(' ','-',$this->input->post('link')));
			$data['sub_service_status']=$this->input->post('sub_service_status');
			$data['status']=$this->input->post('status');
			$data['created_by']=$this->session->userdata('user_id');
			$result= $this->admin_model->update_service_category($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Service Category Updation Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Service Category Updated Successfully','redirect'=>'adminpanel/add-service-category');
			echo json_encode($response);

	}
	public function add_subservice_category()
	{	
			$data['image_url']=$this->image_upload($_FILES['image_url'],'subservice-category-images','SUBSERCAT');
			$data['name']=$this->input->post('name');
			if($this->input->post('link'))
			$data['link']=strtolower(preg_replace('/[^A-Za-z0-9\-]/', '',str_replace(' ','-',$this->input->post('link'))));
			//$data['link']=strtolower(str_replace(' ','-',$this->input->post('link')));
			$data['service_category_id']=$this->input->post('service_category_id');
			$data['status']=$this->input->post('status');
			$data['description']=$this->input->post('description');
			$data['rate_chart']=$this->input->post('rate_chart');
			$data['created_by']=$this->session->userdata('user_id');
			$result= $this->admin_model->insert_subservice_category($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Sub-service Category Adding Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Sub-service Category Added Successfully','redirect'=>'adminpanel/add-subservice-category');
			echo json_encode($response);
	}
	public function update_subservice_category()
	{
		//post tinymce text editor content not working
	/* 	print_r($_POST); exit; */
			if($_FILES['image_url']['name'])
			{
				$data['image_url']=$this->image_upload($_FILES['image_url'],'subservice-category-images','SUBSERCAT');	
			}
			else
			{
				$data['image_url']=$this->input->post('old_image');
			}
	
			$data['id']=$this->input->post('id');
			$data['name']=$this->input->post('name');
			if($this->input->post('link'))
			$data['link']=strtolower(preg_replace('/[^A-Za-z0-9\-]/', '',str_replace(' ','-',$this->input->post('link'))));
			//$data['link']=strtolower(str_replace(' ','-',$this->input->post('link')));
			$data['service_category_id']=$this->input->post('service_category_id');
			$data['status']=$this->input->post('status');
			$data['description']=$this->input->post('description');
			$data['rate_chart']=$this->input->post('rate_chart');
			$data['created_by']=$this->session->userdata('user_id');
			$result= $this->admin_model->update_subservice_category($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Sub-service Category Updation Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Sub-service Category Updated Successfully','redirect'=>'adminpanel/add-subservice-category');
			echo json_encode($response);

	}
	public function add_master_category()
	{
	
			$data['image_url']=$this->image_upload($_FILES['image_url'],'master-category-images','MASCAT');
			$data['name']=$this->input->post('name');
			$data['slug']=$this->input->post('slug');
			$data['status']=$this->input->post('status');
			$data['created_by']=$this->session->userdata('user_id');
			$result= $this->admin_model->insert_master_category($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Master Category Addig Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Master Category Added Successfully','redirect'=>'adminpanel/add-master-category');
			echo json_encode($response);

	}
	public function update_master_category()
	{
			if($_FILES['image_url']['name'])
			{
				$data['image_url']=$this->image_upload($_FILES['image_url'],'master-category-images','MASCAT');	
			}
			else
			{
				$data['image_url']=$this->input->post('old_image');
			}
	
			$data['id']=$this->input->post('id');
			$data['name']=$this->input->post('name');
			$data['slug']=$this->input->post('slug');
			$data['status']=$this->input->post('status');
			$data['created_by']=$this->session->userdata('user_id');
			$result= $this->admin_model->update_master_category($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Master Category Updation Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Master Category Updated Successfully','redirect'=>'adminpanel/add-master-category');
			echo json_encode($response);
	}
	
	public function add_grocery_category()
	{
	
			$data['image_url']=$this->image_upload($_FILES['image_url'],'grocery-category-images','GROCCAT');
			$data['name']=$this->input->post('name');
			$data['slug']=$this->input->post('slug');
			$data['status']=$this->input->post('status');
			$data['created_by']=$this->session->userdata('user_id');
			$result= $this->admin_model->insert_grocery_category($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Grocery Category Adding Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Grocery Category Added Successfully','redirect'=>'adminpanel/add-grocery-category');
			echo json_encode($response);

	}
	public function update_grocery_category()
	{
			if($_FILES['image_url']['name'])
			{
				$data['image_url']=$this->image_upload($_FILES['image_url'],'grocery-category-images','GROCCAT');	
			}
			else
			{
				$data['image_url']=$this->input->post('old_image');
			}
	
			$data['id']=$this->input->post('id');
			$data['name']=$this->input->post('name');
			$data['slug']=$this->input->post('slug');
			$data['status']=$this->input->post('status');
			$data['created_by']=$this->session->userdata('user_id');
			$result= $this->admin_model->update_grocery_category($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Grocery Category Updation Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Grocery Category Updated Successfully','redirect'=>'adminpanel/add-grocery-category');
			echo json_encode($response);

	}
	public function add_grocery_products()
	{
		$products=$this->input->post();
		$data['image_url']=$this->image_upload($_FILES['image_url'],'grocery-product-images','GROCERY');
		$data['name']=$products['name'];
		$data['slug']=$this->input->post('slug');
		$data['grocery_category_id']=$products['grocery_category_id'];
		$data['description']=$products['description'];
		$data['price_description']=$products['price_description'];
		$data['order_limit']=$products['order_limit'];
		$data['status']=$products['status'];
		$data['created_by']=$this->session->userdata('user_id');
		$data['mrp']=$products['mrp'];
		$data['coins']=$products['coins'];
		if(isset($products['deal_id']))
		{
		$data['deal_id']=$products['deal_id'];;	
		}
		$data['selling_price']=$products['selling_price'];
		if($data['mrp'] >$data['selling_price'])
			{
				$data['discount']= round(((($data['mrp'])-($data['selling_price']))/($data['mrp']))*100);
			}
		$product_id= $this->admin_model->insert_grocery_product($data);
	
		$response=array('success'=>$product_id,'status'=>'error','title'=>'Failed!!','msg'=>'Product Adding Failed','redirect'=>'');
		if($product_id)
		$response=array('success'=>$product_id,'status'=>'success','title'=>'Success!!','msg'=>'Product Added Successfully','redirect'=>'adminpanel/grocery-products-list');
		echo json_encode($response);

	}
	public function update_grocery_products()
	{
		if($_FILES['image_url']['name'])
			{
				$data['image_url']=$this->image_upload($_FILES['image_url'],'grocery-product-images','GROCERY');	
			}
			else
			{
				$data['image_url']=$this->input->post('old_image');
			}
		$products=$this->input->post();
		$data['id']=$products['id'];
		$data['name']=$products['name'];
		$data['slug']=$this->input->post('slug');
		$data['grocery_category_id']=$products['grocery_category_id'];
		$data['description']=$products['description'];
		$data['price_description']=$products['price_description'];
		$data['order_limit']=$products['order_limit'];
		$data['status']=$products['status'];
		$data['created_by']=$this->session->userdata('user_id');
		$data['mrp']=$products['mrp'];
		$data['coins']=$products['coins'];
		if(isset($products['deal_id']))
		{
		$data['deal_id']=$products['deal_id'];;	
		}
		$data['selling_price']=$products['selling_price'];
		if($data['mrp'] >$data['selling_price'])
			{
				$data['discount']= round(((($data['mrp'])-($data['selling_price']))/($data['mrp']))*100);
			}
		$product_id= $this->admin_model->update_grocery_product($data);
	
		$response=array('success'=>$product_id,'status'=>'error','title'=>'Failed!!','msg'=>'Product Adding Failed','redirect'=>'');
		if($product_id)
		$response=array('success'=>$product_id,'status'=>'success','title'=>'Success!!','msg'=>'Product Added Successfully','redirect'=>'adminpanel/grocery-products-list');
		echo json_encode($response);
	}
	public function add_restaurant()
	{
			$this->db->trans_start();
			$data['image_url']=$this->image_upload($_FILES['image_url'],'restaurant-images','RESTRNT');
			$user['name']=$data['name']=$this->input->post('name');
			$data['slug']=$this->input->post('slug');
			$data['tags']=$this->input->post('tags');
			$user['username']=$user['mobile']=$data['mobile_no']=$this->input->post('mobile_no');
			$user['password']=sha1($user['mobile']);
			$user['email_id']=$data['email_id']=$this->input->post('email_id');
			$user['role']='restaurant';
			$data['address']=$this->input->post('address');
			$data['loc_latitude']=$this->input->post('loc_latitude');
			$data['loc_longitude']=$this->input->post('loc_longitude');
			if($this->input->post('nearest_restaurants'))
			{
			$data['nearest_restaurants']=json_encode($this->input->post('nearest_restaurants'));
			}
			$data['opening_time']=$this->input->post('opening_time');
			$data['closing_time']=$this->input->post('closing_time');
			
			$data['status']=$this->input->post('status');
			$data['created_by']=$this->session->userdata('user_id');
			$usernameres=$this->admin_model->check_mobile_exist($user['mobile']);
			if($usernameres)
			{
				$response=array('success'=>0,'status'=>'error','title'=>'Failed!!','msg'=>'Mobile No Already Exist. Restaurant Adding Failed','redirect'=>'');	
			}
			else
			{
			$data['user_id']=$this->admin_model->insert_user($user);
			$result= $this->admin_model->insert_restaurant($data);
			
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Restaurant Adding Failed','redirect'=>'');
			if($result && $data['user_id'])
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Restaurant Added Successfully','redirect'=>'adminpanel/restaurants-list');
			}
			$this->db->trans_complete();
			echo json_encode($response);
	}
	public function update_restaurant()
	{
			$this->db->trans_start();
			if($_FILES['image_url']['name'])
			{
				$data['image_url']=$this->image_upload($_FILES['image_url'],'restaurant-images','RESTRNT');	
			}
			else
			{
				$data['image_url']=$this->input->post('old_image');
			}
			$data['id']=$this->input->post('id');
			$user['id']=$this->input->post('user_id');
			$oldmobile=$this->input->post('old_mobile');
			$user['name']=$data['name']=$this->input->post('name');
			$data['slug']=$this->input->post('slug');
			$data['tags']=$this->input->post('tags');
			//$data['slug']=strtolower(preg_replace('/[^A-Za-z0-9\-]/', '',str_replace(' ','-',$data['name'])));
			$user['username']=$user['mobile']=$data['mobile_no']=$this->input->post('mobile_no');
			$user['password']=sha1($user['mobile']);
			$user['email_id']=$data['email_id']=$this->input->post('email_id');
			$user['role']='restaurant';
			$data['address']=$this->input->post('address');
			$data['loc_latitude']=$this->input->post('loc_latitude');
			$data['loc_longitude']=$this->input->post('loc_longitude');
			if($this->input->post('nearest_restaurants'))
			{
			$data['nearest_restaurants']=json_encode($this->input->post('nearest_restaurants'));
			}
			$data['opening_time']=$this->input->post('opening_time');
			$data['closing_time']=$this->input->post('closing_time');
			$data['status']=$this->input->post('status');
			$data['created_by']=$this->session->userdata('user_id');
			if($oldmobile != $user['mobile'])
			{
			$usernameres=$this->admin_model->check_mobile_exist($user['mobile']);
			if($usernameres)
			{
				$response=array('success'=>0,'status'=>'error','title'=>'Failed!!','msg'=>'Mobile No Already Exist. Restaurant Adding Failed','redirect'=>'');	
			}
			else
			{
			$result1=$this->admin_model->update_user($user);
			$result= $this->admin_model->update_restaurant($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Restaurant Updation Failed','redirect'=>'');
			if($result && $result1)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Restaurant Updated Successfully','redirect'=>'adminpanel/restaurants-list');
			}
			}
			else
			{
			
			$result1=$this->admin_model->update_user($user);
			$result= $this->admin_model->update_restaurant($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Restaurant Updation Failed','redirect'=>'');
			if($result && $result1)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Restaurant Updated Successfully','redirect'=>'adminpanel/restaurants-list');
			}
			$this->db->trans_complete();
			echo json_encode($response);
	}
	public function add_promocode()
	{
			$data=array();
			$data['promo_code']=$this->input->post('promo_code');
			
			$check=$this->admin_model->check_promocode($data['promo_code']);
			if($check=='1')
			{
				$result='existing';
			}
			else if($check=='0')
			{
			$data['promo_category']=$this->input->post('promo_category');
			$data['value']=$this->input->post('value');
			$data['no_of_usage']=$this->input->post('no_of_usage');
			$data['min_order']=$this->input->post('min_order');
			$data['max_discount']=$this->input->post('max_discount');
			$data['status']=$this->input->post('status');
			$data['offer_id']=$this->input->post('offer_id');
			$result= $this->admin_model->insert_promocode($data);
			}
			
			echo $result;
			/* $response=array('success'=>$result,'status'=>'error','msg'=>'Slider Adding Failed','redirect'=>'adminpanel/add-slider');
			if($result)
			$response=array('success'=>$result,'status'=>'success','msg'=>'Slider Added Successfully','redirect'=>'adminpanel/add-slider');
			echo json_encode($response); */
	}

	public function update_promocode()
	{
			$data=array();
			$data['promo_code']=$this->input->post('promo_code');
			$data['id']=$this->input->post('id');
			$data['promo_category']=$this->input->post('promo_category');
		
			$data['value']=$this->input->post('value');
			$data['no_of_usage']=$this->input->post('no_of_usage');
			$data['min_order']=$this->input->post('min_order');
			$data['max_discount']=$this->input->post('max_discount');
			$data['status']=$this->input->post('status');
			$data['offer_id']=$this->input->post('offer_id');
			$result= $this->admin_model->update_promocode($data);
			
			echo $result;
			/* $response=array('success'=>$result,'status'=>'error','msg'=>'Slider Adding Failed','redirect'=>'adminpanel/add-slider');
			if($result)
			$response=array('success'=>$result,'status'=>'success','msg'=>'Slider Added Successfully','redirect'=>'adminpanel/add-slider');
			echo json_encode($response); */
	}
	public function add_slider()
    {
			$data['image_url']=$this->image_upload($_FILES['image_url'],'slider-images','SLIDER');	
			$data['name']=$this->input->post('name');
			$data['description']=$this->input->post('description');
			$data['link']=$this->input->post('link');
			$data['status']=$this->input->post('status');
			$data['slider_type']=$this->input->post('slider_type');
			$data['created_by']=$this->session->userdata('user_id');
			$result= $this->admin_model->insert_slider($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Slider Adding Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Slider Added Successfully','redirect'=>'adminpanel/add-slider/'.$data['slider_type']);
			echo json_encode($response);
    }

	public function update_slider()
    {
		if($_FILES['image_url']['name'])
		{
		
			$data['image_url']=$this->image_upload($_FILES['image_url'],'slider-images','SLIDER');
		}
		else
		{
			$data['image_url']=$this->input->post('old_image');
		}
			$data['id']=$this->input->post('id');
			$data['name']=$this->input->post('name');
			$data['link']=$this->input->post('link');
			$data['status']=$this->input->post('status');
			$data['slider_type']=$this->input->post('slider_type');
			$data['created_by']=$this->session->userdata('user_id');
			$result= $this->admin_model->update_slider($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Slider Updation Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Slider Updated Successfully','redirect'=>'adminpanel/add-slider/'.$data['slider_type']);
			echo json_encode($response);
    }
	public function add_pomo_deals()
	{
		$data['image_url']=$this->image_upload($_FILES['image_url'],'pomo-deals-images','DEALS');
		$data['name']=$this->input->post('name');
		$data['slug']=$this->input->post('slug');
		$data['home_status']=0;
		if($this->input->post('home_status'))
			{
			$data['home_status']=$this->input->post('home_status');	
			}
		$data['status']=$this->input->post('status');
		$data['deal_type']=$this->input->post('deal_type');
		$data['created_by']=$this->session->userdata('user_id');
		$result= $this->admin_model->insert_pomo_deals($data);
		$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'New Deals Addig Failed','redirect'=>'');
		if($result)
		$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'New Deals Added Successfully','redirect'=>'adminpanel/add-pomo-deals/'.$data['deal_type']);
		echo json_encode($response);
	}
	public function update_pomo_deals()
	{
			if($_FILES['image_url']['name'])
			{
				$data['image_url']=$this->image_upload($_FILES['image_url'],'pomo-deals-images','DEALS');
			}
			else
			{
				$data['image_url']=$this->input->post('old_image');
			}
	
			$data['id']=$this->input->post('id');
			$data['name']=$this->input->post('name');
			$data['slug']=$this->input->post('slug');
			$data['home_status']=0;
			if($this->input->post('home_status'))
			{
			$data['home_status']=$this->input->post('home_status');	
			}
		
			$data['status']=$this->input->post('status');
			$data['deal_type']=$this->input->post('deal_type');
			$data['created_by']=$this->session->userdata('user_id');
			$result= $this->admin_model->update_pomo_deals($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Deals Updation Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Deals Updated Successfully','redirect'=>'adminpanel/add-pomo-deals/'.$data['deal_type']);
			echo json_encode($response);
	}
	public function add_restaurant_products()
    {
			$products=$this->input->post();
			$data['image_url']=$this->image_upload($_FILES['image_url'],'food-product-images','FOOD');
			$data['name']=$products['name'];
			$data['slug']=$products['slug'];
			$data['food_category_id']=$products['food_category_id'];
			$data['description']=$products['description'];
			$data['order_limit']=$products['order_limit'];
			$data['veg_nonveg_status']=$products['veg_nonveg_status'];
			$data['status']=$products['status'];
			$data['created_by']=$this->session->userdata('user_id');
			$data['mrp']=$products['mrp'];
			$data['coins']=$products['coins'];
			$data['offer_status']="normal";
			/* if(isset($products['offer_status']))
			{
			$data['offer_status']=$products['offer_status'];	
			} */
			if(isset($products['deal_id']))
			{
			$data['deal_id']=$products['deal_id'];;	
			}
		
			$data['selling_price']=$products['selling_price'];
			if($data['mrp'] >$data['selling_price'])
				{
					$data['discount']= round(((($data['mrp'])-($data['selling_price']))/($data['mrp']))*100);
				}
			if($this->input->post('addons'))
			{
				$data['addons']=json_encode($products['addons']);
			}
			$data['opening_time']=$this->input->post('opening_time');
			$data['closing_time']=$this->input->post('closing_time');
			$data['restaurant_id']=$products['restaurant_id'];
			$product_id= $this->admin_model->insert_restaurant_product($data);
		
			$response=array('success'=>$product_id,'status'=>'error','title'=>'Failed!!','msg'=>'Product Adding Failed','redirect'=>'');
			if($product_id)
			$response=array('success'=>$product_id,'status'=>'success','title'=>'Success!!','msg'=>'Product Added Successfully','redirect'=>'adminpanel/restaurant-products-list/'.$this->admin_model->get_name($products['restaurant_id'],'tbl_restaurant_details')."/".$data['restaurant_id']);
			echo json_encode($response);
    }

	public function update_restaurant_products()
    {
		if($_FILES['image_url']['name'])
		{
			$data['image_url']=$this->image_upload($_FILES['image_url'],'food-product-images','FOOD');
		}
		else
		{
			$data['image_url']=$this->input->post('old_image');
		}
			$products=$this->input->post();
			$data['id']=$products['id'];
			$data['name']=$products['name'];
			$data['slug']=$products['slug'];
			$data['food_category_id']=$products['food_category_id'];
			
			$data['description']=$products['description'];
			$data['order_limit']=$products['order_limit'];
			$data['veg_nonveg_status']=$products['veg_nonveg_status'];
			$data['status']=$products['status'];
			$data['created_by']=$this->session->userdata('user_id');
			$data['mrp']=$products['mrp'];
			$data['coins']=$products['coins'];
			$data['offer_status']="normal";	
			if(isset($products['deal_id']))
			{
			$data['deal_id']=$products['deal_id'];;	
			}
		
			$data['selling_price']=$products['selling_price'];
			if($data['mrp'] >$data['selling_price'])
				{
					$data['discount']= round(((($data['mrp'])-($data['selling_price']))/($data['mrp']))*100);
				}
			if($this->input->post('addons'))
			{
				$data['addons']=json_encode($products['addons']);
			}
			$data['restaurant_id']=$products['restaurant_id'];
			$data['opening_time']=$this->input->post('opening_time');
			$data['closing_time']=$this->input->post('closing_time');
			$result= $this->admin_model->update_restaurant_product($data);
		
				$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Product Updation Failed','redirect'=>'');
				if($result)
				$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Product Updated Successfully','redirect'=>'adminpanel/restaurant-products-list/'.$this->admin_model->get_name($products['restaurant_id'],'tbl_restaurant_details')."/".$data['restaurant_id']);
				echo json_encode($response);
    }
	public function add_restaurant_addons()
	{
			$products=$this->input->post();
			$data['image_url']=$this->image_upload($_FILES['image_url'],'food-addons-images','ADDONS');
			$data['name']=$products['name'];
			$data['description']=$products['description'];
			$data['order_limit']=$products['order_limit'];
			$data['status']=$products['status'];
			$data['created_by']=$this->session->userdata('user_id');
			$data['mrp']=$products['mrp'];
			$data['selling_price']=$products['selling_price'];
			if($data['mrp'] >$data['selling_price'])
				{
					$data['discount']= round(((($data['mrp'])-($data['selling_price']))/($data['mrp']))*100);
				}
			$data['restaurant_id']=$products['restaurant_id'];
			$product_id= $this->admin_model->insert_restaurant_addons($data);
		
			$response=array('success'=>$product_id,'status'=>'error','title'=>'Failed!!','msg'=>'Addon Adding Failed','redirect'=>'');
			if($product_id)
			$response=array('success'=>$product_id,'status'=>'success','title'=>'Success!!','msg'=>'Addon Added Successfully','redirect'=>'adminpanel/restaurant-addons-list/'.$this->admin_model->get_name($products['restaurant_id'],'tbl_restaurant_details')."/".$data['restaurant_id']);
			echo json_encode($response);
	}
	public function update_restaurant_addons()
    {
		if($_FILES['image_url']['name'])
		{
			$data['image_url']=$this->image_upload($_FILES['image_url'],'food-addons-images','ADDONS');
		}
		else
		{
			$data['image_url']=$this->input->post('old_image');
		}
			$products=$this->input->post();
			$data['id']=$products['id'];
			$data['name']=$products['name'];
			$data['description']=$products['description'];
			$data['order_limit']=$products['order_limit'];
			$data['status']=$products['status'];
			$data['created_by']=$this->session->userdata('user_id');
			$data['mrp']=$products['mrp'];
			$data['selling_price']=$products['selling_price'];
			if($data['mrp'] >$data['selling_price'])
			{
				$data['discount']= round(((($data['mrp'])-($data['selling_price']))/($data['mrp']))*100);
			}
			$data['restaurant_id']=$products['restaurant_id'];
			$result= $this->admin_model->update_restaurant_addons($data);
		
				$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Product Updation Failed','redirect'=>'');
				if($result)
				$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Addon Updated Successfully','redirect'=>'adminpanel/restaurant-addons-list/'.$this->admin_model->get_name($products['restaurant_id'],'tbl_restaurant_details')."/".$data['restaurant_id']);
				echo json_encode($response);
    }
	public function add_offers()
    {
			$data['image_url']=$this->image_upload($_FILES['image_url'],'offer-images','OFFER');
			$data['name']=$this->input->post('name');
			$data['slug']=$this->input->post('slug');
			$data['offer_type']=$this->input->post('offer_type');
			$data['offer_url']=$this->input->post('offer_url');
			$data['description']=$this->input->post('description');
			$data['status']=$this->input->post('status');
			$data['created_by']=$this->session->userdata('user_id');
			$result= $this->admin_model->insert_offer($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Offer Adding Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Offer Added Successfully','redirect'=>'adminpanel/add-offers/'.$data['offer_type']);
			echo json_encode($response);
    }
	public function update_offers()
    {
		if($_FILES['image_url']['name'])
		{
			$data['image_url']=$this->image_upload($_FILES['image_url'],'offer-images','OFFER');
		}
		else
		{
			$data['image_url']=$this->input->post('old_image');
		}
			$data['id']=$this->input->post('id');
			$data['name']=$this->input->post('name');
			$data['slug']=$this->input->post('slug');
			$data['offer_type']=$this->input->post('offer_type');
			$data['offer_url']=$this->input->post('offer_url');
			$data['description']=$this->input->post('description');
			$data['status']=$this->input->post('status');
			$data['created_by']=$this->session->userdata('user_id');
			$result= $this->admin_model->update_offer($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Offer Updation Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Offer Updated Successfully','redirect'=>'adminpanel/add-offers/'.$data['offer_type']);
			echo json_encode($response);
    }
	

	public function add_unit()
	{
	
			$data=array();
			$data['name']=$this->input->post('name');
			$data['status']=$this->input->post('status');
			$data['created_by']=$this->session->userdata('user_id');
			$result= $this->admin_model->insert_variants($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Variants Adding Failed','redirect'=>'');
			// $redirect='adminpanel/add-food-variants';
			// if($data['poduct_type']=='grocery')
			$redirect='adminpanel/add-measuring-unit';
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Variants Added Successfully','redirect'=>$redirect);
			echo json_encode($response);
	}
	public function update_unit()
	{
	
			$data=array();
			$data['id']=$this->input->post('id');
			$data['name']=$this->input->post('name');
			// $data['product_type']=$this->input->post('product_type');
			$data['status']=$this->input->post('status');
			$data['created_by']=$this->session->userdata('user_id');
			$result= $this->admin_model->update_variants($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Variants Updation Failed','redirect'=>'');
			// $redirect='adminpanel/add-food-variants';
			// if($data['poduct_type']=='grocery')
			$redirect='adminpanel/add-measuring-unit';
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Variants Updated Successfully','redirect'=>$redirect);
			echo json_encode($response);

	}


public function image_upload($image,$directory,$path_prefix)
{
		
		$this->load->library('upload');
		
		if (!is_dir('uploads/'.$directory)) {
			mkdir('uploads/'.$directory, 0777, TRUE);		   
		}
			$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
			$config['upload_path'] = 'uploads/'.$directory;
			$this->load->library('upload',$config);

			$ext = explode(".",$image['name']);
			$imagename=$path_prefix.'_'.strtotime('now').rand(0,9);
			$_FILES['file']['name']=$imagename.".".$ext[1];
			$_FILES['file']['type']=$image['type'];
			$_FILES['file']['tmp_name']=$image['tmp_name'];
			$_FILES['file']['size']=$image['size'];
			$this->upload->initialize($config);
			$this->upload->do_upload('file');
			$uploadData=$this->upload->data();
			$image_url=$uploadData['file_name'];
			return $image_url;
}

public function update_promocode_status()
	{
		$status=$this->input->post('status');
		if($status=="Hidden")
		{
			$data['status']="Visible";
		}
		else if($status=="Visible")
		{
			$data['status']="Hidden";
		}
		$data['id']=$this->input->post('promo_id');
		$result=$this->admin_model->update_promocode_status($data);
	}

	public function update_product_visibility()
	{
		$data['visibility']=$this->input->post('visibility');
		$data['id']=$this->input->post('product_id');
		$result=$this->admin_model->update_product_visibility($data);
	}

	public function single_view($type,$id)
	{
		$imagepath="";
	
		if($type=='restaurant-product')
		{
			$data['table']='tbl_food_products';
			$data['columnlist']='*';
			$data['where']='id='.$id;
		}
	
		else if($type=='offers')
		{	
			$page_name='update-offer';
			$data['table']='offer_details';
			$data['columnlist']=array('id','name','status','description','image_url');
			$data['where']='id='.$id;
			$imagepath="offer-images";

		}
	
		$data['type']=$type;
		$result=$this->admin_model->get_single_view($data);

		$result['page_name']=$page_name;
		$result['image']=$imagepath;
		/* print_r($result); exit; */
		if(isset($result['data'][0]->category))
		{
			$result['data'][0]->category=$this->admin_model->get_category_name($result['data'][0]->category);
		}
		if(isset($result['data'][0]->area))
		{
			$result['data'][0]->area=$this->admin_model->get_area_name($result['data'][0]->area);
		}
		$result['type']=$data['type'];
		$this->load->view('admin/header');
		$this->load->view('admin/navbar');
        $this->load->view('admin/single-view',$result);
		$this->load->view('admin/footer');
	}
	public function delete_item()
	{
		$data=array();
		$redirect="";
		$type=$this->input->post('type');
		$data['id']=$this->input->post('id');
		if($type=="master_category")
		{
			$data['table']="tbl_food_category_master";
			$redirect=base_url().'adminpanel/add-master-category';
		}
		else if($type=='food-deals')
		{
			$data['table']="tbl_food_deals";
			$redirect=base_url().'adminpanel/add-pomo-deals/food';
		}
		else if($type=='grocery-deals')
		{
			$data['table']="tbl_food_deals";
			$redirect=base_url().'adminpanel/add-pomo-deals/grocery';
		}
		else if($type=="measuring-unit")
		{
			$data['table']="tbl_variants_master";
			$redirect=base_url().'adminpanel/add-measuring-unit';
		}

		else if($type=="service_category")
		{
			$data['table']="tbl_service_categories";
			$redirect=base_url().'adminpanel/add-service-category';
		}
		
		else if($type=="food-slider")
		{
			$data['table']="tbl_slider_details";
			$redirect=base_url().'adminpanel/add-slider/food';
		}
		else if($type=="main-slider")
		{
			$data['table']="tbl_slider_details";
			$redirect=base_url().'adminpanel/add-slider/main';
		}
		else if($type=="grocery-slider")
		{
			$data['table']="tbl_slider_details";
			$redirect=base_url().'adminpanel/add-slider/grocery';
		}
		else if($type=="service-slider")
		{
			$data['table']="tbl_slider_details";
			$redirect=base_url().'adminpanel/add-slider/service';
		}
		else if($type=="food-offers")
		{
			$data['table']="tbl_offer_details";
			$redirect=base_url().'adminpanel/add-offers/food';
		}
		else if($type=="main-offers")
		{
			$data['table']="tbl_offer_details";
			$redirect=base_url().'adminpanel/add-offers/main';
		}
		else if($type=="grocery-offers")
		{
			$data['table']="tbl_offer_details";
			$redirect=base_url().'adminpanel/add-offers/grocery';
		}
	
	
	
		else if($type=="subservice_category")
		{
			$data['table']="tbl_sub_service_categories";
			$redirect=base_url().'adminpanel/add-subservice-category';
		}
		else if($type=="grocery-product")
		{
			$data['table']= "tbl_grocery_products";
			$redirect=base_url().'adminpanel/grocery-products-list';
		}
		else if($type=="restaurant")
		{
			$data['table']=array('tbl_restaurant_details'=>'id',
			'tbl_food_products'=>'restaurant_id',
			'tbl_food_addons'=>'restaurant_id',
			'tbl_food_offer_details'=>'restaurant_id');
			$redirect=base_url().'adminpanel/restaurants-list';
		}
		else if($type=="restaurant-product")
		{
			$ids=explode("-",$data['id']);
			$data['id']=$ids[0];
			$data['table']="tbl_food_products";
			$redirect=base_url().'adminpanel/restaurant-products-list/'.$this->admin_model->get_name($ids[1],'tbl_restaurant_details')."/".$ids[1];
		}
		else if($type=="restaurant-addons")
		{
			$ids=explode("-",$data['id']);
			$data['id']=$ids[0];
			$data['table']="tbl_food_addons";
			$redirect=base_url().'adminpanel/restaurant-addons-list/'.$this->admin_model->get_name($ids[1],'tbl_restaurant_details')."/".$ids[1];
		}
		else if($type=="delivery_charge")
		{
			$data['table']="tbl_delivery_charge_details";
			$redirect=base_url().'adminpanel/add-delivery-charge';
		}
	
		$result=$this->admin_model->delete_item($data);
		if($result)
		{
			$success=1;
		}
		else
		{
			$success=0;
		}
	
		echo json_encode(array('success'=>$success,'redirect_url'=>$redirect));

	
	}
	
	public function update_product_status()
	{
		$data['id']=$this->input->post('prod_id');
		$data['status']=$this->input->post('status');
		$this->admin_model->update_product_status($data);
	}

	public function is_username_email_existing()
	{
		$error=1;   
		$email_id=$this->input->post('email_id');
		$emailres=$this->admin_model->check_user_email_exist($email_id);
		
		$username=$this->input->post('username');
		$usernameres=$this->admin_model->check_username_exist($username);
      if($emailres==0 && $usernameres==0)
      {
         $error=0;
      }
		echo json_encode(array('email_id'=>$emailres,'username'=>$usernameres,'error'=>$error));
	}
	

	public function customer_profile($name,$customer_id)
	{
		$data['customer_details']=$this->admin_model->get_single_customer($customer_id);
		$this->load->view('admin/header');
		$this->load->view('admin/navbar');
        $this->load->view('admin/user-profile',$data);
		$this->load->view('admin/footer');
	}
	public function order_details($order_id)
	{
		$data=array();
		$data=$this->admin_model->get_single_order($order_id);
	
		$this->load->view('admin/header');
		$this->load->view('admin/navbar');
        $this->load->view('admin/order-details',$data);
		$this->load->view('admin/footer');
	
	}

	public function service_details($order_id)
	{
		$data=array();
		$data=$this->admin_model->get_single_order($order_id);
	
		$this->load->view('admin/header');
		$this->load->view('admin/navbar');
        $this->load->view('admin/service-request-details',$data);
		$this->load->view('admin/footer');
	}

	public function update_service_request()
	{
		$data['pomo_remarks']=$this->input->post('remarks');
		$data['pomo_coins']=$this->input->post('pomo_coins');
		$data['order_total']=$this->input->post('total_payment');
		$data['id']=$this->input->post('order_id');
		echo $result=$this->admin_model->update_service_request($data);
	}
	public function update_order_details()
	{
		$data=array(
			'status'=>$this->input->post('status'),
			'id'=>$this->input->post('id')
		);
		$this->admin_model-> update_order_details($data);

	}

	public function update_order_status()
	{
		$this->db->trans_start();
		$data=array(
			'status'=>$this->input->post('status'),
			'id'=>$this->input->post('id')
		);
		$result=$this->admin_model-> update_order_status($data);
		if($result)
		{
		$this->site_model-> update_order_statusdetails(array('order_id'=>$data['id'],'status_id'=>$data['status']));
		}
		$this->db->trans_complete();
		echo $result;
	}
	
	public function get_order_report_result()
	{
		$data['from']=$this->input->post('fromdate');
		$data['to']=$this->input->post('todate');
		$data['agent_id']=$this->input->post('agent_id');
		$data['customer_id']=$this->input->post('customer_id');
		$data['payment_type']=$this->input->post('payment_type');
		/* print_r($data); exit; */
		$report_result=$this->admin_model->get_order_report($data);
		
		echo json_encode(array('result'=>$report_result));
	
	}
	public function get_customer_report_result()
	{
		$data['from']=$this->input->post('fromdate');
		$data['to']=$this->input->post('todate');
		$data['customer_id']=$this->input->post('customer_id');
		$report_result=$this->admin_model->get_customer_report($data);
		
		echo json_encode(array('result'=>$report_result));
	
	}

	public function get_collection_report_result()
	{
		$data['from']=$this->input->post('fromdate');
		$data['to']=$this->input->post('todate');
		$data['agent_id']=$this->input->post('agent_id');
		$report_result=$this->admin_model->get_collection_report($data);
		
		echo json_encode(array('result'=>$report_result));
	
	}
	
	public function get_product_list()
	{
		$table=$this->input->post('table');
		$table_name=$table;
		$columns='id,name';
		$productlist=$this->admin_model->get_lists($table_name,$columns);
		echo json_encode(array('productlist'=>$productlist));
	}
	public function change_status()
	{
		$data['table']=$this->input->post('table');
		$data['col']=$this->input->post('col');
		$data['ids']=$this->input->post('ids');
		$result=$this->admin_model->change_status($data);
		$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Process Failed','redirect'=>'');
		if($result)
		$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Process Successfull','redirect'=>'');
		echo json_encode($response);
	}

	public function update_visibility()
	{
		$data['table']=$this->input->post('table');
		$data['col']=$this->input->post('col');
		$data['ids']=$this->input->post('ids');
		$result=$this->admin_model->update_visibility($data);
		$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Process Failed','redirect'=>'');
		if($result)
		$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Process Successfull','redirect'=>'');
		echo json_encode($response);
	}

	public function update_delivery_charge()
	{
		$data=array();
		$charge=$this->input->post();
		/* $data['range_from']=$charge['range_from'];
		$data['range_to']=$charge['range_to'];
		$data['charge']=$charge['charge']; */
		for($i=0;$i<count($charge['range_from']);$i++)
		{
			$data[$i]['range_from']=$charge['range_from'][$i];
			$data[$i]['range_to']=$charge['range_to'][$i];
			$data[$i]['charge']=$charge['charge'][$i];

		}
		$result=$this->admin_model->update_delivery_charge($data);
		$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Delivery Charge Updation Failed','redirect'=>'');
		if($result)
		$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Delivery Charge(s) Updated','redirect'=>'');
		echo json_encode($response);
	}

	
}
