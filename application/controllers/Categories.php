<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Categories_model');
    }
    
    public function index($category_id=''){
        if(empty($category_id)){
            //Get Categories
            echo json_encode( $this->Categories_model->get_categories() );
        }else{
            //Get Category by ID
            echo json_encode( $this->Categories_model->get_category_by_id( $category_id ) );
        }
    }
    
    public function inProduct($product_id=''){
        //Get categories of a product
        if(!empty($product_id))
            echo json_encode( $this->Categories_model->get_product_categories( $product_id ) );
        else 
            echo "no id";
    }
    
    public function inDepartment($department_id=''){
        //Get categories of a department
        if(!empty($department_id))
            echo json_encode( $this->Categories_model->get_department_categories( $department_id ) );
        else 
            echo "no id";
    }
}
