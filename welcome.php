<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	private $limit=10;

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 function __construct()
	{
		parent::__construct();
		
		
	}
	 
	public function index()
	{
		
		$this->load->view('login');
	}
    function register()
        {
           $this->load->view('regristrasi'); 
        }
	function members($id)
	{
		if($this->session->userdata('user') == TRUE & isset($id)) {
			
				$this->load->library('template');
				if ($id =='BadanUsaha'){
					$data['judul']="Data Badan Usaha";
					$this->template->display('members/BadanUsaha',$data);
				}
				else if($id =='administrasi'){
				
					$data['judul']="Data Administrasi";
					$this->template->display('members/administrasi',$data);
				}
				else if($id =='viewadministrasi'){
					$this->load->model('submit_data_model');
					$id_reg=$this->session->userdata('email');
					$data['user_list'] = $this->submit_data_model->joinUsahaRegister($id_reg);
					$data['judul']="View Administrasi";
					$this->template->display('members/viewadministrasi',$data);
				}
				else if($id =='viewbadanusaha'){
					$this->load->model('submit_data_model');
					$id_reg=$this->session->userdata('email');
					$data['user_list'] = $this->submit_data_model->joinUsahaRegister($id_reg);
					$data['judul']="View Badan Usaha";
					$this->template->display('members/viewbadanusaha',$data);
				}
				else if($id =='uploadbadanusaha'){
					$this->load->model('submit_data_model');
					$id_reg=$this->session->userdata('email');
					$data['user_list'] = $this->submit_data_model->joinUsahaRegister($id_reg);
					$id=$this->session->userdata('id');
					$data['path']	= $this->submit_data_model->getupload('data_dokumen_badan_usaha',$id);
					$data['judul']="Upload Badan Usaha";
					$this->template->display('members/uploadbadanusaha',$data);
				}
				else if($id =='kualifikasi'){
					$data['judul']="Data Kualifikasi";
					$this->template->display('members/kualifikasi',$data);
				}
				else if($id =='viewklasifikasi'){
					$this->load->model('submit_data_model');
					$id_reg=$this->session->userdata('email');
					$data['user_list'] = $this->submit_data_model->joinUsahaRegister($id_reg);
					$data['judul']="View Klasifikasi";
					$this->template->display('members/viewklasifikasi',$data);
				}
				else if($id =='pengurus'){
					$this->load->model('submit_data_model');
					$id_reg=$this->session->userdata('email');
					$data['user_list'] = $this->submit_data_model->joinUsahaRegister($id_reg);
					$data['judul']="Data Pengurus";
					$this->template->display('members/pengurus',$data);
				}
				else if($id =='viewpengurus'){
					$this->load->model('submit_data_model');
					$id_reg=$this->session->userdata('email');
					$id_badan=$this->session->userdata('id');
					$data['user_list'] = $this->submit_data_model->joinUsahaRegister($id_reg);
					$data['judul']="View Pengurus";
					$data['table']=$this->submit_data_model->getupload('pengurus',$id_badan);
					$this->template->display('members/viewpengurus',$data);
				}
				else if($id =='keuangan'){
					$data['judul']="Data Keuangan";
					$this->template->display('members/keuangan',$data);
				}
				else if($id =='viewkeuangan'){
					$this->load->model('submit_data_model');
					$id_reg=$this->session->userdata('email');
					$data['user_list'] = $this->submit_data_model->joinUsahaRegister($id_reg);
					$data['judul']="View Keuangan";
					$this->template->display('members/viewkeuangan',$data);
				}
				else if($id =='tenagakerja'){
					$this->load->model('submit_data_model');
					$id_reg=$this->session->userdata('email');
					$data['user_list'] = $this->submit_data_model->joinUsahaRegister($id_reg);
					
					$data['judul']="Data Tenaga Kerja";
					$this->template->display('members/tenagakerja',$data);
				}
				else if($id =='viewtenagakerja'){
					$this->load->model('submit_data_model');
					$email=$this->session->userdata('email');
					$id_reg=$this->session->userdata('id');
					$data['user_list'] = $this->submit_data_model->joinUsahaRegister($email);
					$data['table']=$this->submit_data_model->getupload('tenaga_kerja',$id_reg);
					$data['judul']="View Tenaga Kerja";
					$this->template->display('members/viewtenagakerja',$data);
				}
				else if($id =='peralatan'){
					$this->load->model('submit_data_model');
					$data['judul']="Data Peralatan";
					$id_reg=$this->session->userdata('email');
					$data['user_list'] = $this->submit_data_model->joinUsahaRegister($id_reg);
					$this->template->display('members/peralatan',$data);
				}
				else if($id =='viewperalatan'){
					$this->load->model('submit_data_model');
					$email=$this->session->userdata('email');
					$id_reg=$this->session->userdata('id');
					$data['user_list'] = $this->submit_data_model->joinUsahaRegister($email);
					$data['judul']="View Peralatan";
					$data['table']=$this->submit_data_model->getupload('peralatan',$id_reg);
					$this->template->display('members/viewperalatan',$data);
				}
				else if($id =='pengalaman'){
					$this->load->model('submit_data_model');
					$data['judul']="Data Pengalaman";
					$email=$this->session->userdata('email');
					$id_reg=$this->session->userdata('id');
					$data['user_list'] = $this->submit_data_model->joinUsahaRegister($email);
					$this->template->display('members/pengalaman',$data);
				}
				else if($id =='viewpengalaman'){
					$this->load->model('submit_data_model');
					$email=$this->session->userdata('email');
					$id_reg=$this->session->userdata('id');
					$data['user_list'] = $this->submit_data_model->joinUsahaRegister($email);
					$data['table']=$this->submit_data_model->getupload('pengalaman',$id_reg);
					$data['judul']="View Pengalaman";
					$this->template->display('members/viewpengalaman',$data);
				}
			
			
		}
		else 
		{
			echo "maaf anda belum login";
		}
        
	}
	
function admin($id ,$offset=0,$order_column='id',$order_type='asc')
	{
	if($this->session->userdata('level') == "admin" & isset($id)) {	
		//constructor awal untuk pagination
		if(empty($offset)) $offset=0;
		if(empty($order_column)) $order_column='id';
		if(empty($order_type)) $order_type='asc';
		
		
		
       
            $this->load->library('templateadmin');
            if ($id =='list'){
				$data['judul']="List Badan Usaha";
                $this->templateadmin->display('admin/listBadanUsaha',$data);
            }
			else if ($id =='approval'){
				$this->load->model('register_model');
				$this->load->library('templateadmin');
				$siswas=$this->register_model->get_paged_list($this->limit,$offset,$order_column,$order_type)->result();
				
				
			
				$config['base_url']= site_url('welcome/admin/approval');
				$config['total_rows']=$this->register_model->count_all();
				$config['per_page']=$this->limit;
				$config['uri_segment']=4;
				$this->pagination->initialize($config);
				$data['pagination']=$this->pagination->create_links();
				$data['judul']="Approval";
				$data['offset']=$offset;
				$data['new_order']=($order_type=='asc'?'desc':'asc');
				$data['query']=$siswas;
				$this->templateadmin->display('admin/approval',$data);
            }
			else if ($id =='detail'){
				$data['judul']="Detail Badan Usaha";
                $this->templateadmin->display('admin/detailbadanusaha',$data);
            }
			else if ($id =='editbadanusaha'){
				$data['judul']="Edit Data Badan Usaha";
                $this->templateadmin->display('admin/edit/BadanUsaha',$data);
            }
			else if ($id =='edituploadbadanusaha'){
				$data['judul']="Edit Upload Badan Usaha";
                $this->templateadmin->display('admin/edit/uploadbadanusaha',$data);
            }
			else if ($id =='editkualifikasi'){
				$data['judul']="Edit Data Kualifikasi";
                $this->templateadmin->display('admin/edit/kualifikasi',$data);
            }
			else if ($id =='editadministrasi'){
				$data['judul']="Edit Data Administrasi";
                $this->templateadmin->display('admin/edit/administrasi',$data);
            }
			else if ($id =='editpengurus'){
				$data['judul']="Edit Data Pengurus";
                $this->templateadmin->display('admin/edit/pengurus',$data);
            }
			else if ($id =='editkeuangan'){
				$data['judul']="Edit Data Keuangan";
                $this->templateadmin->display('admin/edit/keuangan',$data);
            }
			else if ($id =='edittenagakerja'){
				$data['judul']="Edit Data Tenaga Kerja";
                $this->templateadmin->display('admin/edit/tenagakerja',$data);
            }
			else if ($id =='editperalatan'){
				$data['judul']="Edit Data Peralatan";
                $this->templateadmin->display('admin/edit/peralatan',$data);
            }
			else if ($id =='editpengalaman'){
				$data['judul']="Edit Data Pengalaman";
                $this->templateadmin->display('admin/edit/pengalaman',$data);
            }
			
        }
        else {
            echo "maaf anda belum login";
        }
        
	}
	function select() {
		
		
		
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */