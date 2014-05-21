<?php

class Upload extends CI_Controller {

 
			
 

function delete_image(){
		$id_member	= $this->uri->segment(3);
		$field	= array($this->uri->segment(4) =>"");
		$id=$this->session->userdata('id');
		$this->load->model('show_data_model');
		$this->load->library('template');
		
		if ($id==$id_member){
					$id_reg=$this->session->userdata('email');
					$this->show_data_model->update_img($field,'data_dokumen_badan_usaha',$id);
					$this->load->model('submit_data_model');
					$data['user_list'] = $this->submit_data_model->joinUsahaRegister($id_reg);
					$data['path']	= $this->submit_data_model->getupload('data_dokumen_badan_usaha',$id);
					$data['delete'] ="Data Telah Berhasil Di Delete";
					unset($id_member);
					$this->template->display('members/uploadbadanusaha',$data);
		}
		else {
			$error['error']	= "maaf anda harus login dulu";
			$this->load->view('login',$error);
		}

		
		
	
	}

function upload_gambar()
{
	//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    // Has the form been posted?
    if (isset($_POST['submit']))
    {
	
        // Load the library - no config specified here
        $this->load->library('upload');
		$this->load->model('show_data_model');
		$this->load->helper('array');
		$this->load->library('template');
		$id_reg=$this->session->userdata('id');
		$email=$this->session->userdata('email');
			
 
        // Check if there was a file uploaded - there are other ways to
        // check this such as checking the 'error' for the file - if error
        // is 0, you are good to code
        if (!empty($_FILES['Domisili']['name']))
        {
            // Specify configuration for File 1
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size'] = '10000';
			$config['file_name'] = "Domisili-".$id_reg."-".$email.".jpg";
            //$config['max_width']  = '1024';
            //$config['max_height']  = '768';
			
 
            // Initialize config for File 1
            $this->upload->initialize($config);
 
            // Upload file 1
            if ($this->upload->do_upload('Domisili'))
            {
                $data	= array('upload_data'	=>$this->upload->data());
				$data = array(
				'domisili'=>$this->upload->file_name
					);
				$this->show_data_model->update_img($data,'data_dokumen_badan_usaha',$id_reg);	
			}
 
			
        }
        
 
        
		
		
        // Do we have a second file?
        if (!empty($_FILES['SIUP']['name']))
        {
            // Config for File 2 - can be completely different to file 1's config
            // or if you want to stick with config for file 1, do nothing!
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size'] = '10000';
            //$config['max_width']  = '1024';
            //$config['max_height']  = '768';
			$config['file_name'] = "SIUP-".$id_reg."-".$email.".jpg";
 
            // Initialize the new config
            $this->upload->initialize($config);
 
            // Upload the second file
            if ($this->upload->do_upload('SIUP'))
            {
                $data['upload_data'] = $this->upload->data();
				$data = array(
				'siup'=>$this->upload->file_name
					);
				$this->show_data_model->update_img($data,'data_dokumen_badan_usaha',$id_reg);	
            }
            else
            {
                $data['error'] = $this->upload->display_errors();
				$this->template->display('members/uploadbadanusaha',$data);
            }
 
        }
		        if (!empty($_FILES['TDP']['name']))
        {
            // Config for File 2 - can be completely different to file 1's config
            // or if you want to stick with config for file 1, do nothing!
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size'] = '10000';
            //$config['max_width']  = '1024';
            //$config['max_height']  = '768';
			$config['file_name'] = "TDP-".$id_reg."-".$email.".jpg";
 
            // Initialize the new config
            $this->upload->initialize($config);
 
            // Upload the second file
            if ($this->upload->do_upload('TDP'))
            {
                $data['upload_data'] = $this->upload->data();
				$data = array(
				'tdp'=>$this->upload->file_name
					);
				$this->show_data_model->update_img($data,'data_dokumen_badan_usaha',$id_reg);	
            }
            else
            {
               $data['error'] = $this->upload->display_errors();
				$this->template->display('members/uploadbadanusaha',$data);
            }
 
        }
		        if (!empty($_FILES['Sert1']['name']))
        {
            // Config for File 2 - can be completely different to file 1's config
            // or if you want to stick with config for file 1, do nothing!
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size'] = '10000';
            //$config['max_width']  = '1024';
            //$config['max_height']  = '768';
			$config['file_name'] = "Sert.Manj-".$id_reg."-".$email.".jpg";
 
            // Initialize the new config
            $this->upload->initialize($config);
 
            // Upload the second file
            if ($this->upload->do_upload('Sert1'))
            {
                $data['upload_data'] = $this->upload->data();
				$data = array(
				'sert1'=>$this->upload->file_name
					);
				$this->show_data_model->update_img($data,'data_dokumen_badan_usaha',$id_reg);	
            }
            else
            {
                $data['error'] = $this->upload->display_errors();
				$this->template->display('members/uploadbadanusaha',$data);
            }
 
        }
		        if (!empty($_FILES['Sert2']['name']))
        {
            // Config for File 2 - can be completely different to file 1's config
            // or if you want to stick with config for file 1, do nothing!
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size'] = '10000';
            //$config['max_width']  = '1024';
            //$config['max_height']  = '768';
			$config['file_name'] = "Sert.Manj3-".$id_reg."-".$email.".jpg";
 
            // Initialize the new config
            $this->upload->initialize($config);
 
            // Upload the second file
            if ($this->upload->do_upload('Sert2'))
            {
                $data['upload_data'] = $this->upload->data();
				$data = array(
				'sert2'=>$this->upload->file_name
					);
				$this->show_data_model->update_img($data,'data_dokumen_badan_usaha',$id_reg);	
            }
            else
            {
                $data['error'] = $this->upload->display_errors();
				$this->template->display('members/uploadbadanusaha',$data);
            }
 
        }
		        if (!empty($_FILES['NPWP']['name']))
        {
            // Config for File 2 - can be completely different to file 1's config
            // or if you want to stick with config for file 1, do nothing!
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size'] = '10000';
            //$config['max_width']  = '1024';
            //$config['max_height']  = '768';
			$config['file_name'] = "NPWP_PKP-".$id_reg."-".$email.".jpg";
 
            // Initialize the new config
            $this->upload->initialize($config);
 
            // Upload the second file
            if ($this->upload->do_upload('NPWP'))
            {
                $data['upload_data'] = $this->upload->data();
				$data = array(
				'npwp_pkp'=>$this->upload->file_name
					);
				$this->show_data_model->update_img($data,'data_dokumen_badan_usaha',$id_reg);
				
            }
            else
            {
                $data['error'] = $this->upload->display_errors();
				$this->template->display('members/uploadbadanusaha',$data);
            }
 
        }	
					//menampilkan data badan usaha
					$this->load->model('submit_data_model');
					$id_reg=$this->session->userdata('email');
					$data['user_list'] = $this->submit_data_model->joinUsahaRegister($id_reg);
					//menampilkan data yang telah diupload
					$id=$this->session->userdata('id');
					$data['path']	= $this->submit_data_model->getupload('data_dokumen_badan_usaha',$id);
					$data['upload']	=	"Data Telah Berhasil Diupload"; 
					$this->template->display('members/uploadbadanusaha',$data);
	}
    else
    {
		$data['error'] = $this->upload->display_errors();
        $this->load->view("members/uploadbadanusaha");
    }
}
	
}
