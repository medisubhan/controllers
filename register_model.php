<?php
class Register_model extends CI_Model{

	private $table_name='register';
	
	function validate($user,$pass)
 	{
  		$this->db->where('email', $user);
  		$this->db->where('password', md5($pass));
		//$this->db->where('password',$pass);
  		$query = $this->db->get('register');
		$result = $query;
		/*foreach($result->result()as $row){
			echo $row->nama_badan_usaha;
			echo $row->password;
			
		}*/
  		
   			return $result;
  		
	}
	function cek_user($field,$data){
	//echo $data;
		$this->db->select($field);
		$this->db->where($field,$data);
		$query = $this->db->get('register');
  		 	return $query;
   			
	}

  	function create_member()
 	{
	  	$new_member_insert_data = array(
		   'nama_badan_usaha' => $this->input->post('nama_badan_usaha'),
		   'nama' => $this->input->post('nama'),
		   'email' => $this->input->post('email'),   
		   'password' => md5($this->input->post('password'))      
		);
	   
	  $insert = $this->db->insert('register', $new_member_insert_data);
	  return $insert;
 	}
	
	function select_approval() {
		
		$ambil = $this->db->get('register');
		if($ambil->num_rows() > 0)
		{
			foreach($ambil->result() as $baris)
			{
			$hasil[] = $baris;
				}
			return $hasil;
		}

	}
	public function ambil_register($num, $offset){
		$this->db->order_by('id', 'ASC');
		$data = $this->db->get('register', $num, $offset);
		return $data->result();
	 }
	function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc'){
		
		if(empty($order_column)|| empty($order_type))
			$this->db->order_by($this->primary_key,'asc');
		else
			$this->db->order_by($order_column,$order_type);
		return $this->db->get($this->table_name,$limit,$offset);
	}
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
			$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
}
