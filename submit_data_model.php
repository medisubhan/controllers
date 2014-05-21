<?php 
class Submit_data_model extends CI_Model{

	public function __construct(){
        parent::__construct();
    }

	function insertBadanUsaha($data){	
		  $this->db->insert('data_badan_usaha', $data);
	}
	function insertpengurus($data){	
		  $this->db->insert('pengurus', $data);
			
	}
	function insert_register($data){	
		  $this->db->insert('register', $data);
	}

	function get_all_badan_usaha(){
		$query = $this->db->get('data_badan_usaha');
		return $query->result();
	}

	function getById($id_reg){
		$this->db->where('id', $id_reg);
		$query = $this->db->get('data_badan_usaha');
		return $query->result();
	}

	function getByIdRegister($id_reg){
		$this->db->where('id', $id_reg);
		$query = $this->db->get('register');
		return $query->result();
	}

	function joinUsahaRegister($mail){
		 $query = $this->db->query("select A.id, B.nama_badan_usaha,A.alamat,A.kabupaten_kota,A.kode_pos,A.telephone,A.fax,B.email,A.website,A.npwp from data_badan_usaha as A join register as B on A.email = B.email where A.email='$mail' AND B.email='$mail'");
		 return $query->result();

		 //print_r($query);

	}

	function getupload($table,$id){
		$this->db->where('id_badan_usaha', $id);
		$query = $this->db->get($table);
		return $query->result();
	}
	
	function getbyemail($email,$table){
		$this->db->where('email', $email);
		$query = $this->db->get($table);
		return $query->result();
	}

	function UpdateBadanUsaha($id,$data){
		//print_r($id);
		$this->db->where('id_reg', $id);
        $this->db->update('data_badan_usaha', $data);	
         //$this->db->affected_rows()
         //return $query->result();
	}

	

	function updatePengurus($id,$data){
		$this->db->where('id', $id);
        $this->db->update('pengurus', $data);
	}

	function insertPeralatan($data){	
		  $this->db->insert('peralatan', $data);
	}
	function insertPengalaman($data){	
		  $this->db->insert('pengalaman', $data);
	}

	function insertTenagaKerja($data){
		$this->db->insert('tenaga_kerja', $data);
	}

	function updateTenagaKerja($id,$data){
		$this->db->where('id', $id);
        $this->db->update('tenaga_kerja', $data);		
	}

	function updatePeralatan($id,$data){
		$this->db->where('id', $id);
        $this->db->update('peralatan', $data);		
	}
}



            
              
             
        
        
        

 
  

        
