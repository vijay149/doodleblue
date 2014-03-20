<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {

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
	public function index()
	{	
		if(isset($_GET['verify'])){
			$this->Homemodel->activation();
			$this->load->view('index');
		}else{
			$this->load->view('index');
		}
	}	
	public function login()
	{
		if(isset($_POST['api_key'])!="" && $_POST['key']="0192023a7bbd73250516f069df18b500"){
			$this->Homemodel->web_login();
		}else{
			echo json_encode(array("result"=>"error"));
		}
	}
	public function ajax(){
		if(isset($_POST['login'])){
			$this->Homemodel->login();
		}elseif(isset($_POST['registration'])){
			$this->Homemodel->registration();
		}
	}
	public function change_password()
	{	
		$this->Homemodel->change_password();
		$this->load->view('change_password');
	}
	public function profile()
	{	
		$this->Homemodel->profile();
		$this->load->view('profile');
		
	}
	public function forgot_password(){
		$this->load->view('header',$data);
		$this->load->view('forgot_password');
		$this->load->view('footer');
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */