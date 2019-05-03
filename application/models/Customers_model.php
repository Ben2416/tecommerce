<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers_model extends CI_Model {
    
    public function get_customer($customer_id){
        //Return a customer
        $query = $this->db->query("CALL customer_get_customer(".$customer_id.")");
        return $query->result();
    }
    
    public function add_customer($name, $email, $password){
        $data = array(
            'inName' => $this->security->xss_clean($name),
            'inEmail' => $this->security->xss_clean($email),
            'inPassword'=> $this->security->xss_clean($password)
        );
        $ac_proc = "CALL customer_add(?,?,?)";
        $query = $this->db->query($ac_proc, $data);
        
        if($query !== NULL)
            return $query->result_array()[0]['LAST_INSERT_ID()'];
        else 
            return 0;
    }
    
    public function get_login_info($email){
        $data = array( 
            'inEmail' => $this->security->xss_clean($email) 
        );
        $gli_proc = "CALL customer_get_login_info(?)";
        $query = $this->db->query($gli_proc, $data);
        return $query->result();
    }
    
    public function update_customer_address($cid, $add1, $add2, $city, $regn, $pcod, $ctry, $srid){
        $data = array(
            'inCustomerId' => $cid,
            'inAddress1' => $this->security->xss_clean($add1),
            'inAddress2' => $this->security->xss_clean($add2),
            'inCity' => $this->security->xss_clean($city),
            'inRegion' => $this->security->xss_clean($regn),
            'inPostalCode' => $pcod,
            'inCountry' => $this->security->xss_clean($ctry),
            'inShippingRegionId' => $srid
        );
        $upadd_proc = "CALL customer_update_address(?,?,?,?,?,?,?,?)";
        $query = $this->db->query($upadd_proc, $data);
        if($query !== NULL)
            return 1;//$query->result_array();
        else 
            return 0;
    }
    
    public function update_customer_credit_card($customer_id, $credit_card){
        $data = array(
            'inCustomerId' => $customer_id,
            'inCreditCard' => $this->security->xss_clean($credit_card)
        );
        $upcc_proc = "CALL customer_update_credit_card(?,?)";
        $query = $this->db->query($upcc_proc, $data);
        if($query !== NULL)
            return 1;
        else 
            return 0;
    }
    
    
    
}