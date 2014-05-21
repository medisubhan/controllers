<?php class email extends CI_Controller(){
	
	function index(){
		$this->load->library('email');
    	$this->email->from('hikkmi@admin.com', 'A. Sir');
    	$this->email->to('d.medisubhan@gmail.com');
 
   		$this->email->subject('Email Testing');
    	$this->email->message('Testing the email class, Like a SIR!.');
 
    	$this->email->send();
	} 
}