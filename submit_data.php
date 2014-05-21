<?php
class Submit_Data extends CI_Controller{
	
	function submitBadanUsaha(){
		$this->load->model('submit_data_model');
		$id=$this->session->userdata('id');
		

		$data = array(			
			'nama_badan_usaha' => $this->input->post('badanUsaha'),
			'alamat' => $this->input->post('inputAlamat'),
			'provinsi' => $this->input->post('provinsi'),
			'kabupaten_kota' => $this->input->post('kabupaten'),
			'kode_pos' => $this->input->post('kodePos'),
			'telephone' => $this->input->post('tlp'),
			'fax' => $this->input->post('fax'),
			'email' => $this->input->post('email'),
			'website' => $this->input->post('website'),
			'npwp' => $this->input->post('npwp'),
			'domisili' => $this->input->post('domisili'),
			'siup' => $this->input->post('siup'),
			'tdp' => $this->input->post('tdp'),
			'mnjMutu' => $this->input->post('manajemenMutu'),
			'mnjMutuu' => $this->input->post('manajemenMutuu'),
			'npwp_pkp' => $this->input->post('npwpPkp'),
			'id_reg' =>$id,
		);

		//print_r($data);


		//cek apakah data yg dikirim dari form kosong
		//cek apakah data sudah ada sebelummya di database
		//jika data sudah ada langsung alihkan ke halaman viewbadan usaha
		
		$this->submit_data_model->UpdateBadanUsaha($id,$data);
	
		

		$email=$this->session->userdata('email');
		$id=$this->session->userdata('id');
		$data['user_list'] = $this->submit_data_model->joinUsahaRegister($email);
		$data['upload']	= $this->submit_data_model->getupload('data_dokumen_badan_usaha',$id);
		$this->load->library('template');
		//$dataa['judul']="View Badan Usaha";
		$this->template->display('members/viewbadanusaha',$data);
	}

	function submitKualifikasi(){


	}

	function submitAdministrasi(){
		$this->load->model('submit_data_model');

	}

	function submitPengurus(){
	
		$this->load->library('template');
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		$this->form_validation->set_message('required', 'Data Harus Diisi');
		$this->form_validation->set_message('numeric', 'Data Harus Angka');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('tgl_lahir', 'tanggal lahir', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('no_ktp', 'no ktp', 'required|numeric');
		$this->form_validation->set_rules('jabatan', 'jabatan', 'required');
		$this->form_validation->set_rules('pendidikan', 'pendidikan', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('submit_data_model');
			$id_reg=$this->session->userdata('email');
			$data['user_list'] = $this->submit_data_model->joinUsahaRegister($id_reg);
			$this->template->display('members/pengurus',$data);
		}
		else
		{
		
		
		
		$this->load->model('submit_data_model');
		$id_reg=$this->session->userdata('id');
		$email=$this->session->userdata('email');
		
		

		$data = array(			
			'nama' => $this->input->post('nama'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'alamat' => $this->input->post('alamat'),
			'jabatan' => $this->input->post('jabatan'),
			'pendidikan' => $this->input->post('pendidikan'),
			'no_ktp' => $this->input->post('no_ktp'),
			'id_badan_usaha' =>$id_reg,
		);
		
		
		//ganti (isset($success)) dengan  ($this->session->flashdata('message')) pada view
		$this->submit_data_model->insertpengurus($data);    

       $this->session->set_flashdata('message', 'anda berhasil menginput data');
		redirect('/welcome/members/viewpengurus', 'refresh');
		
		}
	}
	function updatePengurus(){
		$email=$this->session->userdata('email');
		$id_reg=$this->session->userdata('id');
		$this->load->model('submit_data_model');
		$id=$this->input->post('id');
		//echo $id;
		$data = array(			
			'nama' => $this->input->post('nama'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'alamat' => $this->input->post('alamat'),
			'jabatan' => $this->input->post('jabatan'),
			'pendidikan' => $this->input->post('pendidikan'),
			'no_ktp' => $this->input->post('no_ktp'),
			'id_badan_usaha' =>$id_reg,
		);

		//print_r($data);

		$this->submit_data_model->updatePengurus($id,$data);

		$data['success']="Selamat anda Berhasil";
		$data['user_list'] = $this->submit_data_model->joinUsahaRegister($email);
		$data['success']="View Pengurus";
		$data['table']=$this->submit_data_model->getupload('pengurus',$id_reg);
		
		$this->template->display('members/viewpengurus',$data);

	}

	function submit_peralatan(){
		$this->load->library('template');
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		$this->form_validation->set_message('required', 'Data Harus Diisi');
		$this->form_validation->set_message('max_length[4]', 'Harus Menggunakan format Tahun contoh 1992');
		$this->form_validation->set_message('numeric', 'Harus Menggunakan angka');
		$this->form_validation->set_rules('jenis', 'jenis', 'required');
		$this->form_validation->set_rules('kapasitas', 'kapasitas', 'required');
		$this->form_validation->set_rules('merk', 'merk', 'required');
		$this->form_validation->set_rules('tahun', 'tahun', 'required|numeric|max_length[4]');
		$this->form_validation->set_rules('kondisi', 'kondisi', 'required');
		$this->form_validation->set_rules('lokasi', 'lokasi', 'required');
		$this->form_validation->set_rules('jumlah', 'jumlah', 'required|numeric');
		$this->form_validation->set_rules('harga', 'harga', 'required|numeric');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('submit_data_model');
			$id_reg=$this->session->userdata('email');
			$data['user_list'] = $this->submit_data_model->joinUsahaRegister($id_reg);
			$this->template->display('members/peralatan',$data);
		}
		else
		{
			
		
	
		$this->load->model('submit_data_model');
		$id_reg=$this->session->userdata('id');
		$email=$this->session->userdata('email');
		

		$data = array(			
			'jenis' => $this->input->post('jenis'),
			'kapasistas' => $this->input->post('kapasitas'),
			'merk' => $this->input->post('merk'),
			'tahun' => $this->input->post('tahun'),
			'kondisi' => $this->input->post('kondisi'),
			'lokasi' => $this->input->post('lokasi'),
			'jumlah' => $this->input->post('jumlah'),
			'harga' => $this->input->post('harga'),
			'id_badan_usaha' =>$id_reg
		);
		
		
		//ganti (isset($success)) dengan  ($this->session->flashdata('message')) pada view
		$this->submit_data_model->insertdata($data,'peralatan');         
		$this->session->set_flashdata('message', 'anda berhasil menginput data');
		redirect('/welcome/members/viewperalatan', 'refresh');
		}
			
	}

	function update_peralatan(){
		$email=$this->session->userdata('email');
		$id_reg=$this->session->userdata('id');
		$this->load->model('submit_data_model');
		$id=$this->input->post('id');
		$data = array(			
			'jenis' => $this->input->post('jenis'),
			'kapasistas' => $this->input->post('kapasitas'),
			'merk' => $this->input->post('merk'),
			'tahun' => $this->input->post('tahun'),
			'kondisi' => $this->input->post('kondisi'),
			'lokasi' => $this->input->post('lokasi'),
			'jumlah' => $this->input->post('jumlah'),
			'harga' => $this->input->post('harga'),
			'id_badan_usaha' =>$id_reg,
		);
		//print_r($data);

		$this->submit_data_model->updatePeralatan($id,$data);

		$data['success']="Selamat anda Berhasil";
		$data['user_list'] = $this->submit_data_model->joinUsahaRegister($email);
		$data['success']="View Peralatan";
		$data['table']=$this->submit_data_model->getupload('peralatan',$id_reg);
		
		$this->template->display('members/viewperalatan',$data);
	}

function submit_tenaga_kerja(){
		$this->load->library('template');
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		$this->form_validation->set_message('required', 'Data Harus Diisi');
		$this->form_validation->set_message('numeric', 'Harus Menggunakan angka');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('tgl_lahir', 'tanggal lahir', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('no_ktp', 'no ktp', 'required|numeric');
		$this->form_validation->set_rules('bidang', 'bidang', 'required');
		$this->form_validation->set_rules('pjt', ' pjt', 'required');
		$this->form_validation->set_rules('pjb', ' pjb', 'required');
		$this->form_validation->set_rules('no_registrasi', 'no registrasi', 'required');
		$this->form_validation->set_rules('jenis_sertifikat', 'jenis sertifikat', 'required');
		$this->form_validation->set_rules('pendidikan', 'pendidikan', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('submit_data_model');
			$id_reg=$this->session->userdata('email');
			$data['user_list'] = $this->submit_data_model->joinUsahaRegister($id_reg);
			$this->template->display('members/tenagakerja',$data);
		}
		else
		{
	
		$this->load->model('submit_data_model');
		$id_reg=$this->session->userdata('id');
		
		$email=$this->session->userdata('email');
		

		$data = array(			
			'nama' => $this->input->post('nama'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'alamat' => $this->input->post('alamat'),
			'no_ktp' => $this->input->post('no_ktp'),
			'bidang' => $this->input->post('bidang'),
			'pjt' => $this->input->post('pjt'),
			'pjb' => $this->input->post('pjb'),
			'no_registrasi' => $this->input->post('no_registrasi'),
			'jenis_serikat' => $this->input->post('jenis_sertifikat'),
			'pendidikan' => $this->input->post('pendidikan'),
			'id_badan_usaha' =>$id_reg,
		);
		
		
		//ganti (isset($success)) dengan  ($this->session->flashdata('message')) pada view
		$this->submit_data_model->insertdata($data,'tenaga_kerja');        
        $this->session->set_flashdata('message', 'anda berhasil menginput data');
		redirect('/welcome/members/viewtenagakerja', 'refresh');
	}
	}

	function update_tenaga_kerja(){
		$this->load->model('submit_data_model');
		$id_reg=$this->session->userdata('id');
		$this->load->library('template');
		$email=$this->session->userdata('email');
		$id=$this->input->post('id');
		//echo $id;
		$data = array(			
			'nama' => $this->input->post('nama'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'alamat' => $this->input->post('alamat'),
			'no_ktp' => $this->input->post('no_ktp'),
			'bidang' => $this->input->post('bidang'),
			'pjt' => $this->input->post('pjt'),
			'pjb' => $this->input->post('pjb'),
			'no_registrasi' => $this->input->post('no_registrasi'),
			'jenis_serikat' => $this->input->post('jenis_sertifikat'),
			'pendidikan' => $this->input->post('pendidikan'),
			'id_badan_usaha' =>$id_reg,
		);
		//print_r($data);
		$this->submit_data_model->updateTenagaKerja($id,$data);

		$data['success']="Selamat anda Berhasil";
		$data['user_list'] = $this->submit_data_model->joinUsahaRegister($email);
		$data['success']="View Tenaga Kerja";
		$data['table']=$this->submit_data_model->getupload('tenaga_kerja',$id_reg);
		
		$this->template->display('members/viewtenagakerja',$data);

	}
	function submit_pengalaman(){
		$this->load->library('template');
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		$this->form_validation->set_message('required', 'Data Harus Diisi');
		$this->form_validation->set_message('numeric', 'Harus Menggunakan angka');
		$this->form_validation->set_message('max_length[4]', 'Harus Menggunakan format Tahun contoh 1992');
		$this->form_validation->set_rules('tahun_proyek', 'tahun', 'required|numeric|max_length[4]');
		$this->form_validation->set_rules('nama_proyek', 'nama', 'required');
		$this->form_validation->set_rules('nilai_proyek', 'nilai', 'required|numeric');
		$this->form_validation->set_rules('kotrak_nomor', 'kontrak', 'required|numeric');
		$this->form_validation->set_rules('nkpk_nomor', 'nkpk', 'required|numeric');
		$this->form_validation->set_rules('berita_acara_no', 'berita acara', 'required');
		$this->form_validation->set_rules('berita_acara_tgl', 'berita acara', 'required');
		$this->form_validation->set_rules('pemberi_tugas', 'pemberi tugas', 'required');
		$this->form_validation->set_rules('bidang_kualifikasi', 'bidang', 'required');
		$this->form_validation->set_rules('kontrak', 'kontrak', 'required');
		$this->form_validation->set_rules('mulai', 'mulai', 'required');
		$this->form_validation->set_rules('selesai', 'selesai', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('submit_data_model');
			$id_reg=$this->session->userdata('email');
			$data['user_list'] = $this->submit_data_model->joinUsahaRegister($id_reg);
			$this->template->display('members/pengalaman',$data);
		}
		else
		{
	
		$this->load->model('submit_data_model');
		$id_reg=$this->session->userdata('id');
		$email=$this->session->userdata('email');
		

		$data = array(			
			'tahun_proyek' => $this->input->post('tahun_proyek'),
			'nama_proyek' => $this->input->post('nama_proyek'),
			'nilai_proyek' => $this->input->post('nilai_proyek'),
			'kotrak_nomor' => $this->input->post('kotrak_nomor'),
			'nkpk_nomor' => $this->input->post('nkpk_nomor'),
			'berita_acara_no' => $this->input->post('berita_acara_no'),
			'berita_acara_tgl' => $this->input->post('berita_acara_tgl'),
			'pemberi_tugas' => $this->input->post('pemberi_tugas'),
			'bidang_kualifikasi' => $this->input->post('bidang_kualifikasi'),
			'kontrak' => $this->input->post('kontrak'),
			'mulai' => $this->input->post('mulai'),
			'selesai' => $this->input->post('selesai'),
			'id_badan_usaha' =>$id_reg
		);
		
		
		//ganti (isset($success)) dengan  ($this->session->flashdata('message')) pada view
		$this->submit_data_model->insertdata($data,'pengalaman');
		$this->session->set_flashdata('message', 'anda berhasil menginput data');
		redirect('/welcome/members/viewpengalaman', 'refresh');
			
	}
	}

}