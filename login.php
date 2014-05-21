<?php
class login extends CI_Controller{

	function construct() 
	{
		
	}
	function index(){
		$this->load->view('login');
	}

	function validate_credentials() {
		$this->load->model('register_model');
	 	$user = $this->input->post('email');
  		$pass = $this->input->post('password');
		
  		$query = $this->register_model->validate($user,$pass);
		
		
		
  		if($query->num_rows == 1)
  		{
			$row=$query->row();
			$arraysession=array(
								'id' =>$row->id,
								'user' => $user,
								'email'=>$row->email,
								'level' => $row->level);
			$this->session->set_userdata($arraysession);
			if($this->session->userdata('level') == "admin") {
				
				//$this->load->library('templateadmin');
				//$data['judul']="List Badan Usaha";
				//$this->templateadmin->display('admin/listBadanUsaha',$data);
				redirect('show_data/list_badan_usaha');
			}
			else {
			$this->load->model('submit_data_model');
			$id_reg=$this->session->userdata('email');
			$id=$this->session->userdata('id');
			$data['user_list'] = $this->submit_data_model->joinUsahaRegister($id_reg);
			$data['upload']	= $this->submit_data_model->getupload('data_dokumen_badan_usaha',$id);
			$this->load->library('template');
			
			//$dataa['judul']="View Badan Usaha";
			$this->template->display('members/viewbadanusaha',$data);
			 }
  		}else{
			$error['error'] = 'Maaf email atau password anda salah';
  			$this->load->view('login',$error);
  		}
	 
	}

	

	function logout()
 	{
  		$this->session->sess_destroy();
  		$this->index();
 	}
}