<?php 

class User extends CI_Model{

	public function add_user($data = null){
		$this->db->insert("users",$data);
		$id = $this->db->insert_id();
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->first_row('array');
	}

	public function get_user($data = null){
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("username",$data["username"]);
		$this->db->where("password",$data["password"]);
		$query = $this->db->get();
		return $query->first_row("array");
	}

	public function get_user_detail($user_id){
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where('id',$user_id);
		$user = $this->db->get();


		return $user->first_row("array");
	}

	public function check_exists($username = null){
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("username",$username);
		$query = $this->db->get();
		return $query->first_row("array");
	}

	public function update_password($user_id, $new_password){
		$this->db->set('password', $new_password);
		$this->db->where("id", $user_id);
		$this->db->update("users");
	}
	
}

?>