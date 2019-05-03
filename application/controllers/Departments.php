<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Departments_model');
    }
    
    public function index($department_id='')
    {
        if(empty($department_id)){
            //Get Departments
            echo json_encode( $this->Departments_model->get_departments() );
            
        }else{
            //Get Department by ID
            echo json_encode( $this->Departments_model->get_department_by_id( $department_id ) );
        }
        
    }
    
}
