
<?php
defined('BASEPATH') OR exit('No direct scipt access allowes');
/**
 * 
 */
class Login_controller extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('User_model');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('curl');
	}

	public function index(){
		$data ['title']='Login';
		$this->load->view('login', $data);
	}

	public function login(){
		$ceklogin = $this->User_model->getUser();
		$form_response = $this->input->post('g-recaptcha-response');
		$url = "https://www.google.com/recaptcha/api/siteverify";

		$secretkey = "6Lf9Z_AUAAAAABnZsAToZZAzFCGs4TrByKHZQxkT";

		$response = file_get_contents($url."?secret=".$secretkey."&response=".$form_response."&remoteip=".$_SERVER["REMOTE_ADDR"]);

		$data = json_decode($response);
		print_r($data);

		if (isset($data->success) && $data->success=="true") {
		    if ($ceklogin != false) {
				foreach ($ceklogin as $row) {
					$this->session->set_userdata('id_user', $row->id_user);
					$this->session->set_userdata('username', $row->username);
					$this->session->set_userdata('level', $row->level);
					$this->session->set_flashdata('successLogin', 'Login Berhasil, Selamat Datang Kak '.$row->username);
					redirect('Index_controller');
				}
			}
			else {
				$this->session->set_flashdata('errorLogin', 'Username atau Password Salah!');
				redirect('Login_controller');
			}
		}
		else{
		    $this->session->set_flashdata('errorRecaptcha', 'ReCaptcha not solved / an error occured'.$status);
			redirect('Login_controller');
		}
	}

	public function logout(){
		$this->session->unset_userdata('username');
		$this->session->sess_destroy();
		redirect('Login_controller', 'refresh');
	}
}
?>
