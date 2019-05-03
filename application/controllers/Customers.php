<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Customers_model');
    }
    
    public function updateCustomer($customer_id=''){
        //PUT - Update a Customer
    }
    
    public function customer($customer_id=''){
         //GET - Get a customer by ID. The customer is getting by Token
    }
    
    
    public function index(){
        //POST- Register a Customer
        $name = 'ben onabe';//$this->input->post('name');
        $email = 'me@tec.co';//$this->input->post('email');
        $password = 'sfasde323';//$this->input->post('password');
        
        if(empty($name)){//username is required
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Name is required',
                "field"=>"name"
            ));
            echo json_encode($error);exit;
        }elseif(empty($email)){//email is required
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Email is required',
                "field"=>"email"
            ));
            echo json_encode($error);exit;
        }elseif(!valid_email($email)){//email is valid
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'The Email is invalid',
                "field"=>"email"
            ));
            echo json_encode($error);exit;
        }elseif( $this->check_email_exists( $email ) ){//email exists
            $error = array("error" => array("status"=>400,
                "code"=>'USR_03',
                "message"=>'Email already exists',
                "field"=>"email"
            ));
            echo json_encode($error);exit;
        }elseif(empty($password)){//password is required
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Password is required',
                "field"=>"password"
            ));
            echo json_encode($error);exit;
        }else{
            $add_cust = $this->Customers_model->add_customer($name, $email, $password);
            if( $add_cust != 0 ){
                $this->db->close();
                $get_cust = $this->Customers_model->get_customer($add_cust);
                $schema  = array("schema" => $get_cust[0]);
                $output = array("customer" => $schema, "accessToken" => "Bearer dfajiodjfai", "expires_in" => "24h");
                echo json_encode($output) ;
            }else echo 'df';
        }
    }
    
    
    public function login(){
        //Sign in in the Shopping
       
        if($this->input->post()){
            $email = 'me@tec.co';//$this->input->post('email');
            $password = 'sfasde323';//$this->input->post('password');
            if(!valid_email($email)){//email is valid
                $error = array("error" => array("status"=>400,
                    "code"=>'USR_02',
                    "message"=>'The Email is invalid',
                    "field"=>"email"
                ));
                echo json_encode($error);exit;
            }elseif(empty($password)){//password is required
                $error = array("error" => array("status"=>400,
                    "code"=>'USR_02',
                    "message"=>'Password is required',
                    "field"=>"password"
                ));
                echo json_encode($error);exit;
            }else{
                $get_cust_info = $this->Customers_model->get_login_info($email);
                if(!empty($get_cust_info)){
                    //validate password
                    if($password === $get_cust_info[0]->password){//valid email and password
                        $this->db->close();
                        $get_cust = $this->Customers_model->get_customer($get_cust_info[0]->customer_id);
                        $schema  = array("schema" => $get_cust[0]);
                        $output = array("customer" => $schema, "accessToken" => "Bearer dfajiodjfai", "expires_in" => "24h");
                        echo json_encode($output) ;
                    }else{//invalid password
                        $error = array("error" => array("status"=>400,
                            "code"=>'USR_01',
                            "message"=>"The Email or Password is invalid",
                            "field"=>"password"
                        ));
                        echo json_encode($error);exit;
                    }
                }else{//invalid email
                    $error = array("error" => array("status"=>400,
                        "code"=>'USR_05',
                        "message"=>"The Email doesn't exist",
                        "field"=>"email"
                    ));
                    echo json_encode($error);exit;
                }
            }
        }
    }
    
    public function facebook(){
        //Sign in with a facebook login token
    }
    
    public function address(){
        //Update the address from customer
        $cust = 1;//$this->input->post("customer_id");
        $add1 = 'prison road';//$this->input->post("address_1");
        $add2 = 'pasali';//$this->input->post("address_2");
        $city = 'kuje';//$this->input->post("city");
        $regn = 'africa';//$this->input->post("region");
        $pcod = '23481';//$this->input->post("postal_code");
        $ctry = 'Nigeria';//$this->input->post("country");
        $srid = 1;//$this->input->post("shipping_region_id");
        
        if(empty($add1)){
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Address is empty',
                "field"=>"address_1"
            ));
            echo json_encode($error);exit;
        }elseif(empty($city)){
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'City is empty',
                "field"=>"city"
            ));
            echo json_encode($error);exit;
        }elseif(empty($regn)){
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Region is empty',
                "field"=>"region"
            ));
            echo json_encode($error);exit;
        }elseif(empty($pcod)){
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Postal Code is empty',
                "field"=>"postal_code"
            ));
            echo json_encode($error);exit;
        }elseif(empty($ctry)){
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Country is empty',
                "field"=>"country"
            ));
            echo json_encode($error);exit;
        }elseif(empty($srid)){
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Shipping Region ID is empty',
                "field"=>"shipping_region_id"
            ));
            echo json_encode($error);exit;
        }else{
            $up_addr = $this->Customers_model->update_customer_address($cust, $add1, $add2, $city, $regn, $pcod, $ctry, $srid);
            if( $up_addr != 0 ){
                $this->db->close();
                $get_cust = $this->Customers_model->get_customer($cust);
                $schema  = array("schema" => $get_cust[0]);
                $output = array("customer" => $schema, "accessToken" => "Bearer dfajiodjfai", "expires_in" => "24h");
                echo json_encode($output) ;
            }else echo 'df';
        }
        
    }
    
    public function creditCard(){
        //Update the address from customer
        
        $cust = 1;//$this->input->post("customer_id");
        $ccard = "4960382811327856";//$this->input->post("credit_card");
        if(empty($ccard)){
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Credit Card is empty',
                "field"=>"credit_card"
            ));
            echo json_encode($error);exit;
        }else{
            $up_cc = $this->Customers_model->update_customer_credit_card($cust, $ccard);
            if( $up_cc != 0 ){
                $this->db->close();
                $get_cust = $this->Customers_model->get_customer($cust);
                $schema  = array("schema" => $get_cust[0]);
                $output = array("customer" => $schema, "accessToken" => "Bearer dfajiodjfai", "expires_in" => "24h");
                echo json_encode($output) ;
            }else echo 'df';
        }
    }
    
    public function check_email_exists($email){
        $where_array = array( 'email' => $email );
        $this->db->where($where_array);
        $switch = $this->db->count_all_results("customer");
        if ($switch != NULL){
            return true;
        }else{
            return false;
        }
    }
    
}
