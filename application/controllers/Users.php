<?php

class Users extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model("Post");
		$this->load->model("User");
	}
	
	public function signup_page(){
		$data["view"] = "user/signup";
		$this->load->view("layout.php",$data);
	}

	public function signup(){
		$data = $this->input->post();
		// print_r($data);
		unset($data["confirm_password"]);
		$data["password"] = hash("md5",$data["password"]);

		$exists=$this->User->check_exists($data["username"]);
		if(isset($exists)){
			print_r("user_exists");
		} else {
		// //add this user if doesnt exists
			$user = $this->User->add_user($data);
			print_r("user_saved");
		}
	}

	public function login_page(){
		// print_r("r u alive?");
		$data["view"] = "user/login";
		// $data = [];
		$this->load->view("layout.php",$data);
	}

	public function hash_password($raw_password){
		$hashed_password = hash("md5",$raw_password);
		return $hashed_password;
	}

	public function login(){
		$data = $this->input->post();
		// print_r($data);
		$data["password"] = $this->hash_password($data["password"]);
		// //hashing is repeated -- create a function
		$user = $this->User->get_user($data);
		print_r($user);
		if(!is_null($user)){
			$_SESSION["logged_in"] = $user;
			redirect("/posts/dashboard","refresh");
		}else{
			$data["error"] = "You entered a wrong username or password";
			$data["view"] = "user/login";
			$this->load->view("layout.php",$data);
		}
	}


	public function profile(){
		$user_id = $this->uri->segment('3');
		$user = $this->User->get_user_detail($user_id);
		$posts = $this->Post->get_user_posts($user_id);
		
		$data['view'] = "user/profile";
		$data['user'] = $user;
		$data['posts'] = $posts;
		$this->load->view("layout.php", $data);
	}

	public function log_out(){
		session_destroy();
		$data['view'] = "user/login";
		$this->load->view("layout.php", $data);
	}


	public function settings(){
		$user_id = $_SESSION['logged_in']["id"];
		$user = $this->User->get_user_detail($user_id);

		$data['view'] = "user/settings";

		// $user["password"]
		$data['user'] = $user;
		$this->load->view("layout.php", $data);
	}

	public function change_password(){
		$data = $this->input->post();

		$old_password = $this->hash_password($data["old_password"]);
		
		if($old_password == $data["password"]){
			$new_password = $this->hash_password($data["new_password"]);
			$user = $this->User->update_password($_SESSION['logged_in']["id"], $new_password);

			print_r("success");
		}


	}

	// public function logout(){
	// 	//destroy session
	// }
}

?>