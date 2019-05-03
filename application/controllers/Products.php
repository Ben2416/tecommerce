<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Products_model');
    }
    
    public function index($product_id=''){
        //Get all products
        if(empty($product_id)){
            $products_page = 1;
            $products_per_page = 20;
            $products_description_length = 200;
            echo json_encode( 
                $this->Products_model->get_products_on_catalog(
                    $products_description_length,
                    $products_per_page,
                    $products_page
                ) 
            );
        }else{//Product by ID
            echo json_encode( $this->Products_model->get_product_by_id($product_id) );
        }
    }
    
    public function search($query_string=''){
        //Search Products
        if(!empty($query_string)){
            $query_string = urldecode($query_string);
            $all_words = "on";
            $products_page = 1;
            $products_per_page = 20;
            $products_description_length = 200;
            echo json_encode( $this->Products_model->search_product(
                    $query_string,
                    $all_words,
                    $products_description_length,
                    $products_per_page,
                    $products_page
                ) 
            );
        }else{
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Product ID is empty',
                "field"=>"product_id"
            ));
            echo json_encode($error);exit;
        }
    }
    
    public function inCategory($category_id=''){
        //Get a list of products of categories
        if(!empty($category_id)){
            $products_page = 1;
            $products_per_page = 20;
            $products_description_length = 200;
            echo json_encode(
                $this->Products_model->get_products_in_category(
                    $category_id,
                    $products_description_length,
                    $products_per_page,
                    $products_page
                    )
                );
        }else{
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Product ID is empty',
                "field"=>"product_id"
            ));
            echo json_encode($error);exit;
        }
    }
    
    public function inDepartment($department_id=''){
        //Get a list of products on department
        if(!empty($department_id)){
            $products_page = 1;
            $products_per_page = 20;
            $products_description_length = 200;
            echo json_encode(
                $this->Products_model->get_products_in_department(
                    $department_id,
                    $products_description_length,
                    $products_per_page,
                    $products_page
                    )
                );
        }else{
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Product ID is empty',
                "field"=>"product_id"
            ));
            echo json_encode($error);exit;
        }
    }
    
    public function details($product_id=''){
        //Get details of a product
        if(!empty($product_id))
            echo json_encode( $this->Products_model->get_product_details($product_id) );
        else{
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Product ID is empty',
                "field"=>"product_id"
            ));
            echo json_encode($error);exit;
        }
    }
    
    public function locations($product_id=''){
        //Get locations of a Product
        if(!empty($product_id))
            echo json_encode( $this->Products_model->get_product_locations($product_id) );
        else{
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Product ID is empty',
                "field"=>"product_id"
            ));
            echo json_encode($error);exit;
        }
                
    }
    
    public function reviews($product_id=''){
        if(!empty($product_id)){
            //GET - Get reviews of a Product
            if($this->input->method() == "get"){
                echo json_encode( $this->Products_model->get_product_reviews($product_id) );
            }
            $this->db->close();
            
            //POST- Post reviews of a Product
            if($this->input->method() == "post"){
                if(empty($this->input->post("review"))){
                    $error = array("error" => array("status"=>400, 
                        "code"=>'USR_02', 
                        "message"=>'Review message is empty',
                        "field"=>"review"
                    ));
                    echo json_encode($error);exit;
                }
                if(empty($this->input->post("rating"))){
                    $error = array("error" => array("status"=>400,
                        "code"=>'USR_02',
                        "message"=>'Rating is empty',
                        "field"=>"rating"
                    ));
                    echo json_encode($error);exit;
                }
                
                $customerId = 1;
                $review = $this->input->post('review');
                $rating = $this->input->post('rating');
                
                if( $this->Products_model->create_product_review($customerId, $product_id, $review, $rating) );
                    echo '';
            }
        }else{
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Product ID is empty',
                "field"=>"product_id"
            ));
            echo json_encode($error);//exit;
        }
    }
}
