<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stripe extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Stripe_model');
    }
    
    public function charge(){
        //This method receive a front-end payment and create a charge
        
    }
    
    public function webhooks() {
        //Endpoint that provide a synchronization
        
    }
}
