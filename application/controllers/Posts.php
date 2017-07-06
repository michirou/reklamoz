<?php

class Posts extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model("User");
		$this->load->model("Post");
		$this->load->model("Like");
	}

	public function dashboard(){
		$data["view"] = "post/dashboard";
		$this->load->view("layout.php",$data);
	}

	public function submit_content(){
		$data = $this->input->post();
		date_default_timezone_set("hongkong");
		$data["timestamp"] = date("Y-m-d H:i:s");
		$data["user_id"] = $_SESSION["logged_in"]["id"];
		// print_r($data);
		$post = $this->Post->submit_post($data);
		print_r($post);
	}

	public function get_posts(){
		$posts = $this->Post->get_all_posts();
		//only shows user_id but username is needed;
		// print_r($posts);

		foreach($posts as $key=>$post){
			$posts[$key]["user"] = $this->User->get_user_detail($post["user_id"]);
			$posts[$key]["likes"] = $this->Like->get_likes($post["id"]);
		}

		print_r(json_encode($posts));
	}

	public function test(){
		print_r($_SESSION["logged_in"]);
	}

	public function like(){
		$data['post_id'] = $this->input->post('id');
		$data['user_id'] = $_SESSION['logged_in']["id"];
		$user = $this->Like->like_post($data);
		$likes = $this->Like->get_likes($data["post_id"]);
		print_r($likes);
	}

}
?>