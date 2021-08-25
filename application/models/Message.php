<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Model {

    public function __construct() {
		date_default_timezone_set("Asia/Calcutta");
        parent::__construct();
    }
	
	public function sendMail($to, $message, $subject, $mail_type = null, $cc = null, $bcc = null, $attachments = array()) {
		if($mail_type == 'simple'){
			$status = 0;
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html; charset=iso-8859-1';
			// Additional headers
			$headers[] = 'To: <'. $to .'>';
			$headers[] = 'From: Four Square <noreply@foursquarewealthadvisory.com>';
			//$headers[] = 'Cc: birthdayarchive@example.com';
			//$headers[] = 'Bcc: birthdaycheck@example.com';
			
			// Mail it
			if(mail($to, $subject, $message, implode("\r\n", $headers))){
				$status = 1;
			}
			return $status;
		}
		
		$config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.foursquarewealthadvisory.com',
            'smtp_port' => 587,
            'smtp_user' => 'noreply@foursquarewealthadvisory.com',
            'smtp_pass' => 'PDAit2bkQgCo',
            'smtp_crypto' => 'tls',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => 'TRUE',
        );
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('noreply@foursquarewealthadvisory.com', 'Four Square');
		$this->email->to($to);
		//$this->email->cc($cc);
		//$this->email->bcc($bcc);
		//$this->email->attach($attachments);
		$this->email->subject($subject);
		$this->email->message($message);
		$status = $this->email->send();
		
        if ($status) {
          $status = 0;
        } else {
          echo $this->email->print_debugger();
          $status = 0;
        }
        return $status;
    }
	
	public function sendSMS($contact = 0, $message = ''){
		$response['status'] = 'error';
        $response['message'] = '';
		
		if($contact == 0 || $contact==''|| $message == '') {
			return false;
		}
		
		
		
		$message = urlencode($message);
		$authKey = "132605AnLgKYghB583ff9e5";
		$senderId = "CTYRCH";
		$route = "4";
		
		
		$postData = array(
			'authkey' => $authKey,
			'mobiles' => $contact,
			'message' => $message,
			'sender' => $senderId,
			'route' => $route
		);
		
		$url="https://api.msg91.com/api/sendhttp.php";
		
		// init the resource
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
		));
		$output = curl_exec($ch);
		if($output){
			$response['status'] = 'ok';
			$response['message'] = $output;
		}
		curl_close($ch);
		return $response;
		
	}

}
?>