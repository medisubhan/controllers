<?php 
class show_data extends CI_Controller{

	function list_badan_usaha(){
		$this->load->model('submit_data_model');
		$data['user_list'] = $this->submit_data_model->get_all_badan_usaha();
		$this->load->library('templateadmin');
		$data['judul']="List Badan Usaha";
		$this->templateadmin->display('admin/listBadanUsaha',$data);
    }

	function detail_admin($id){
		$this->load->model('submit_data_model');
		//echo $id;
		$data['user_list'] = $this->submit_data_model->getById($id);
		$this->load->library('templateadmin');
		$data['judul']="Detail Badan Usaha";
		$data['upload']	= $this->submit_data_model->getupload('data_dokumen_badan_usaha',$id);
		$data['table']=$this->submit_data_model->getupload('pengurus',$id);
		$data['table2']=$this->submit_data_model->getupload('tenaga_kerja',$id);
		$data['table3']=$this->submit_data_model->getupload('peralatan',$id);
		$data['table4']=$this->submit_data_model->getupload('pengalaman',$id);
		$this->templateadmin->display('admin/detailbadanusaha',$data);

	}

	function edit_admin($id){
		$this->load->model('submit_data_model');
		//echo $id;
		$data['user_list'] = $this->submit_data_model->getById($id);
		$this->load->library('templateadmin');
		//$data['judul']="List Badan Usaha";
		$this->templateadmin->display('admin/edit/BadanUsaha',$data);

	}

	function show_badan_usaha(){
		$this->load->model('submit_data_model');
		$email=$this->session->userdata('email');
		$id=$this->session->userdata('id');
		$data['user_list'] = $this->submit_data_model->joinUsahaRegister($email);
		$data['upload']	= $this->submit_data_model->getupload('data_dokumen_badan_usaha',$id);
		$this->load->library('template');
		//$dataa['judul']="View Badan Usaha";
		$this->template->display('members/viewbadanusaha',$data);
	}

	function show_edit_badan_usaha(){
		$this->load->model('submit_data_model');
		$email=$this->session->userdata('email');
		$id=$this->session->userdata('id');
		$data['user_list'] = $this->submit_data_model->joinUsahaRegister($email);
		$data['upload']	= $this->submit_data_model->getupload('data_dokumen_badan_usaha',$id);
		$this->load->library('template');
		//$dataa['judul']="View Badan Usaha";
		$this->template->display('members/BadanUsaha',$data);

	}

	function show_edit_pengurus($id){
		//$id;
		$this->load->model('show_data_model');
		$data['user_list'] = $this->show_data_model->getByIdPengurus($id);
		//print_r($data);
		$this->load->library('template');
		//$dataa['judul']="View Badan Usaha";
		$this->template->display('members/editpengurus',$data);

	}

	function show_edit_pekerja($id){
		//$id;
		$this->load->model('show_data_model');
		$data['user_list'] = $this->show_data_model->getByIdPekerja($id);
		//print_r($data);
		$this->load->library('template');
		//$dataa['judul']="View Badan Usaha";
		$this->template->display('members/edittenagakerja',$data);

	}

	function show_edit_peralatan($id){
		$this->load->model('show_data_model');
		$data['user_list'] = $this->show_data_model->getByIdPeralatan($id);
		//print_r($data);
		$this->load->library('template');
		//$dataa['judul']="View Badan Usaha";
		$this->template->display('members/editperalatan',$data);
    }
		
	
}