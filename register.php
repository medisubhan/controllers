<?php
class Register extends CI_Controller{

	function register_form(){
		 $this->load->view('regristrasi'); 
	}

	function register_member(){
		
		
		$this->load->library('form_validation');
		$this->form_validation->set_message('required', 'data harus di isi');
        $this->form_validation->set_rules('nama_badan_usaha', 'Nama Badan Usaha', 'trim|required|callback_badan_usaha_check');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_rules('nama', 'nama', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback_email_check');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('regristrasi'); 
		}else {
		
		$new_member_insert_data = array(
		   'nama_badan_usaha' => $this->input->post('nama_badan_usaha'),
		   'nama' => $this->input->post('nama'),
		   'email' => $this->input->post('email'),   
		   'password' => md5($this->input->post('password')) 
			//'password' => $this->input->post('password') 		   
		);
	   
	   //print_r($new_member_insert_data);
	  $insert = $this->db->insert('register', $new_member_insert_data);
	  
	  $this->load->model('submit_data_model');
	  //insert table nama badan usaha
	  $email = $this->input->post('email');
	  $query = $this->submit_data_model->getbyemail($email,'register');
	  foreach ($query as $row)
		{
			$id = $row->id;
		}
	  $new_member_insert_data_badan = array(
		   'nama_badan_usaha' => $this->input->post('nama_badan_usaha'),
		   'email' => $email,
		   'id_reg'	=> 	$id
		   
		);
		
	  $insert_badan	= $this->db->insert('data_badan_usaha', $new_member_insert_data_badan);
	  
	  
	  //insert table data dokumen
	  $new_member_insert_data_dokumen = array(
		   'id_badan_usaha' => $id 
		);
	  $insert_dokumen	= $this->db->insert('data_dokumen_badan_usaha', $new_member_insert_data_dokumen);
	  $this->load->view('succes_page');
		}
	}
	
	public function badan_usaha_check($str)
	{
		
		$this->load->model('register_model');
		
  		$query = $this->register_model->cek_user('nama_badan_usaha',$str);
		if ($query->num_rows() > 0)
		{
			
			//$row = $query->row();
			//echo $row->nama_badan_usaha;
			$this->form_validation->set_message('badan_usaha_check', 'maaf nama badan usaha telah terpakai');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
		public function email_check($str)
	{
		
		$this->load->model('register_model');
		
  		$query = $this->register_model->cek_user('email',$str);
		if ($query->num_rows() > 0)
		{
			$this->form_validation->set_message('email_check', 'maaf email  telah terpakai');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	

}