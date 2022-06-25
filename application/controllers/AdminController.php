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
	
	 // For Listing Items
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

	 // For Adding Items To Database
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
	
}
