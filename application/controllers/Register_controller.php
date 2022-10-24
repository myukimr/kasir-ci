
<?php
defined('BASEPATH') OR exit('No direct scipt access allowes');
/**
 * 
 */
class Register_controller extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('User_model');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
	}

	public function index(){
		$data ['title']='Register';
		$this->load->view('register', $data);
	}

	public function register(){
		$password = $this->input->post('password');
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);

		if ($this->User_model->cekUsername()==true){
			$this->session->set_flashdata('errorUsername', 'Username telah terdaftar!');
			redirect('Register_controller');	
		}
		else {
			if ($this->input->post('password')==$this->input->post('retype')) {
				if (!$lowercase || !$number || strlen($password)<=7) {
					$this->session->set_flashdata('errorValidasi', 'Password minimal 8 character serta mengandung angka dan huruf!');
					redirect('Register_controller');
				}
				else {
					$this->User_model->tambahUser();
					$this->session->set_flashdata('successRegister', 'Register User Berhasil.');
					redirect('Register_controller');
				}
			}
			else {
				$this->session->set_flashdata('errorPassword', 'Re-Type password failed!');
				redirect('Register_controller');
			}
		}	
	}
}
?>
