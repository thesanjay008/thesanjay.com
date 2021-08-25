<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('coredata.php');
include_once('header.php');
include_once('easebuzz/easebuzz-lib/easebuzz_payment_gateway.php');

$order_data = $this->restModel->get_current_order($current_user_id);
//print_r($order_data);
if(!empty($order_data)){
	
	$processdata = array(
	  'txnid' => $order_data['order_id'],
	  'order_id' => $order_data['order_id'],
	  'amount' => $order_data['subtotal'],
	  'firstname' => $order_data['first_name'],
	  'lastname' => $order_data['last_name'],
	  'email' => 'thesanjay008@gmail.com',
	  'phone' => '8347519769',
	  'udf1' => 'udf1',
	  'udf2' => 'udf2',
	  'udf3' => 'udf3',
	  'udf4' => 'udf4',
	  'udf5' => 'udf5',
	  'productinfo' => 'Demo Product',
	  'surl' => 'http://foursquarewealthadvisory.com/confirm-order',
	  'furl' => 'http://foursquarewealthadvisory.com/confirm-order',
	  'address1' => 'Anand Nagar',
	  'address2' => 'Prahlad Nagar',
	  'city' => 'Ahmedabad',
	  'state' => 'Gujarat',
	  'country' => 'India',
	  'zipcode' => '380015',
	);
	$MERCHANT_KEY = "K0CDA3XAWB";
	$SALT = "EX1J7RH0SY";
	$ENV = "test";    // setup test enviroment (testpay.easebuzz.in). 
	//$ENV = "prod";   // setup production enviroment (pay.easebuzz.in).
	$easebuzzObj = new Easebuzz($MERCHANT_KEY, $SALT, $ENV);
	$easebuzzObj->initiatePaymentAPI($processdata);
}