<?php 

class Post extends CI_Model{

	public function submit_post($data = null){
		$this->db->insert("posts",$data);

		$id = $this->db->insert_id();
		$this->db->select("*");
		$this->db->from("posts");
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->first_row('array');
	}

	public function get_all_posts(){
		$this->db->from("posts");
		$this->db->order_by("timestamp","desc");
		$query = $this->db->get();

		// $this->db->select("*");
		// $this->db->from("users");
		// $this->db->where("users.id=")
		// $user = $this->db->get();

		return $query->result_array();
	}

	public function get_user_posts($user_id = null){
		$this->db->from("posts");
		$this->db->where("user_id", $user_id);
		$this->db->order_by("timestamp","desc");
		$query = $this->db->get();

		return $query->result_array();
	}
	
}

?>