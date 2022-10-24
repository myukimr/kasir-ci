
<?php
defined('BASEPATH') OR exit('No direct scipt access allowes');
/**
 * 
 */
class User_controller extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('username')==NULL){
            redirect('Login_controller','refresh');   
        }
		$this->load->model('User_model');
		$this->load->helper('url');
		$this->load->helper('form');
	}
	
	public function index(){
		$content = $this->cart->contents();
		$data ['user']= $this->User_model->tampilUser();
		$nav ['title']= "User Management";
		$this->load->view('navbar/index_navbar.php',$nav);
		$this->load->view('manajemenUser.php', $data);
		$this->load->view('cart/index_cart.php', array('content' => $content));
	}

	public function tambahUser()
	{
		$password = $this->input->post('password');
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);

		if ($this->User_model->cekUsername()==true){
			$this->session->set_flashdata('errorUsername', 'Username telah terdaftar!');
			redirect('User_controller');	
		}
		else {
			if ($this->input->post('password')==$this->input->post('retype')) {
				if (!$lowercase || !$number || strlen($password)<=7) {
					$this->session->set_flashdata('errorValidasi', 'Password minimal 8 character serta mengandung angka dan huruf!');
					redirect('User_controller');
				}
				else {
					$this->User_model->tambahUser();
					$this->session->set_flashdata('successRegister', 'Register User Berhasil.');
					redirect('User_controller');
				}
			}
			else {
				$this->session->set_flashdata('errorPassword', 'Re-Type password failed!');
				redirect('User_controller');
			}
		}
	}

	public function editUser()
	{
		$id_user = $this->input->post('id_user');
		$this->User_model->editUser($id_user);
		$this->session->set_flashdata('successEdit', 'Data berhasil diedit.');
		redirect('User_controller');
	}

	public function resetPassword()
	{
		$password = $this->input->post('password');
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);

		$id_user = $this->input->post('id_user');
		if ($this->input->post('password')==$this->input->post('retype')) {
			if (!$lowercase || !$number || strlen($password)<=7) {
				$this->session->set_flashdata('errorValidasi', 'Password minimal 8 character serta mengandung angka dan huruf!');
				redirect('User_controller');
			}
			else {
				$this->User_model->resetPassword($id_user);
				$this->session->set_flashdata('successReset', 'Password berhasil direset.');
				redirect('User_controller');
			}
		}
		else {
			$this->session->set_flashdata('errorPassword', 'Re-Type password failed!');
			redirect('User_controller');
		}
	}

	public function hapusUser($id_user)
	{
		$this->User_model->hapusUser($id_user);
		$this->session->set_flashdata('successHapus', 'Data berhasil dihapus.');
		redirect('User_controller');
	}
}
?>
