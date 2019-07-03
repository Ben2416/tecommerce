<?php
use Restserver\Libraries\Rest_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Departments extends CI_Controller {
    
    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }
    
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->__resTraitConstruct();
        $this->load->model('Departments_model');
    }
    
    public function index_get($department_id='')
    {
        //Get Departments
        //echo json_encode( $this->Departments_model->get_departments() );
        $response =  $this->Departments_model->get_departments() ;
        $this->response($response, 200);
       
    }
    
    public function department_get($department_id=''){
        $did = (!empty($this->get('department_id')))?$this->get('department_id'): $department_id;
        if(empty($did) || !is_numeric($did)){
            //Get Departments
            //echo json_encode( $this->Departments_model->get_departments() );
            $response = array(
                "code"=>'USR_02',
                "message"=>'Department ID is invalid',
                "field"=>"department_id",
                "status"=>"500"
            );
            $this->response($response, 400);
        }else{
            //Get Department by ID
            //echo json_encode( $this->Departments_model->get_department_by_id( $department_id ) );
            $response = $this->Departments_model->get_department_by_id( $did );
            $this->response($response, 200);
        }
        
    }
    
}
