<?php 

class Like extends CI_Model{

	public function like_post($data = null){
		$this->db->insert("likes",$data);
		$id = $this->db->insert_id();
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->first_row('array');
	}


	public function get_likes($post_id){
		$this->db->select("*");
		$this->db->from("likes");
		$this->db->where("post_id", $post_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	// public function count_likes(){
	// 	$this->db->select("*");
	// 	$this->db->from("likes");
	// 	$this->db->where("id", $post_id);
	// 	$query = $this->db->get();
	// 	return count($query);
	// }

	
}

?>