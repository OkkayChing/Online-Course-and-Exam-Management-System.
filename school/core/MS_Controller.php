<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class MS_Controller extends CI_Controller {

   function __construct() {
        parent::__construct();

		$system_data = $this->db->where('brand_id', 1)->get('settings')->row_array();
		
        $currency = $this->db->select('currency.currency_code,currency.currency_symbol')
                        ->from('paypal_settings')
                        ->join('currency', 'currency.currency_id = paypal_settings.currency_id')
                        ->get()->row_array();
        $sys_info = array_merge($system_data , $currency);
        	// echo "<pre/>"; print_r($sys_info); exit();
		$this->load->vars($sys_info);
    }
}